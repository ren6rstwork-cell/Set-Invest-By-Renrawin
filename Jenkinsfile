pipeline {
    agent any

    stages {
        stage('Clean Old Containers') {
            steps {
                echo '🗑️ กำลังล้างตู้เดิมของโปรเจกต์นี้ออกเพื่อป้องกันพอร์ตชน...'
                sh 'docker rm -f sibr-web-container sibr-db-container || true'
            }
        }

        stage('Deploy Full-Stack PHP & MySQL') {
            steps {
                echo '🚀 Jenkins กำลังสั่งสตาร์ตระบบเว็บลงทุนตัวใหม่...'
                
                // 1. รันตู้ฐานข้อมูล MySQL เข้าไปใน Network แยกเฉพาะ
                sh 'docker run -d --name sibr-db-container --network sibr-net -e MYSQL_ROOT_PASSWORD=root_password -e MYSQL_DATABASE=invest_db -p 3306:3306 -v $(pwd)/database.sql:/docker-entrypoint-initdb.d/database.sql mysql:8.0'
                
                // 2. รันตู้ PHP และสั่งติดตั้ง Driver สำหรับต่อฐานข้อมูล
                sh '''
                docker run -d --name sibr-web-container --network sibr-net -p 8000:80 -v $(pwd):/var/www/html php:8.1-apache
                sleep 5
                docker exec sibr-web-container bash -c "docker-php-ext-install mysqli pdo pdo_mysql && apache2-foreground &"
                '''
            }
        }
    }
}
