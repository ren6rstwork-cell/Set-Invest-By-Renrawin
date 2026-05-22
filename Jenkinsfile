pipeline {
    agent {
        node {
            label ''
        }
    }
    
    // บังคับให้ Jenkins ใช้สิทธิ์ Root ในการรันคำสั่ง Shell ทุกขั้นตอน
    options {
        timeout(time: 1, unit: 'HOURS')
    }

    stages {
        stage('Clean Old System') {
            steps {
                echo '🗑️ ล้างระบบเก่าเพื่อเคลียร์พอร์ต...'
                // ใช้ sudo ภายใน หรือรันดื้อๆ ผ่านท่อที่ระบุผู้ใช้ระดับราก
                sh 'whoami'
                sh 'docker rm -f sibr-web-container sibr-db-container || true'
            }
        }

        stage('Deploying via Jenkins') {
            steps {
                echo '🚀 สั่งรันระบบใหม่ด้วยสิทธิ์ที่ถูกต้อง...'
                
                // 1. รัน MySQL DB
                sh 'docker run -d --name sibr-db-container --network sibr-net -e MYSQL_ROOT_PASSWORD=root_password -e MYSQL_DATABASE=invest_db -p 3306:3306 -v $(pwd)/database.sql:/docker-entrypoint-initdb.d/database.sql mysql:8.0'
                
                // 2. รัน PHP Web
                sh 'docker run -d --name sibr-web-container --network sibr-net -p 8000:80 -v $(pwd):/var/www/html php:8.1-apache'
                
                // 3. เปิดการทำงาน Driver ฐานข้อมูล
                sh 'sleep 5 && docker exec sibr-web-container bash -c "docker-php-ext-install mysqli pdo pdo_mysql"'
                sh 'docker restart sibr-web-container'
            }
        }
    }
}
