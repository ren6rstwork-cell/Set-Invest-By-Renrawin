pipeline {
    agent any
    
    // เรียกใช้ระบบ Docker Tool ผ่านปลั๊กอินโดยตรงเพื่อแก้ปัญหาเรื่องสิทธิ์
    environment {
        DOCKER_IMAGE_DB  = 'mysql:8.0'
        DOCKER_IMAGE_WEB = 'php:8.1-apache'
    }

    stages {
        stage('Clean Old System') {
            steps {
                echo '🗑️ ล้างระบบเก่าเพื่อเคลียร์พอร์ต...'
                // สั่งตัดไฟผ่านคำสั่งในโปรเจกต์โดยตรง
                sh 'docker rm -f sibr-web-container sibr-db-container || true'
            }
        }

        stage('Deploying via Jenkins Plugin') {
            steps {
                echo '🚀 สั่งรันระบบใหม่ด้วยสิทธิ์ที่ถูกต้อง...'
                
                // 1. สั่งรัน MySQL แบบระบุสิทธิ์ผ่านเน็ตเวิร์ก
                sh 'docker run -d --name sibr-db-container --network sibr-net -e MYSQL_ROOT_PASSWORD=root_password -e MYSQL_DATABASE=invest_db -p 3306:3306 -v $(pwd)/database.sql:/docker-entrypoint-initdb.d/database.sql mysql:8.0'
                
                // 2. สั่งรัน PHP Apache
                sh 'docker run -d --name sibr-web-container --network sibr-net -p 8000:80 -v $(pwd):/var/www/html php:8.1-apache'
                
                // 3. ติดตั้ง Driver ฐานข้อมูล
                sh 'sleep 5 && docker exec sibr-web-container bash -c "docker-php-ext-install mysqli pdo pdo_mysql"'
                sh 'docker restart sibr-web-container'
            }
        }
    }
}
