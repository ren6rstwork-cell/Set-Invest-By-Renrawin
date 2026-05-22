pipeline {
    agent any

    stages {
        stage('Deploy Full-Stack System') {
            steps {
                echo '🚀 สั่งการผ่านท่อ Socket ของสิทธิ์ Root...'
                
                // สั่งล้างตู้เก่าและรันตู้ใหม่โดยใช้สิทธิ์ของตัวโปรแกรมโดยตรง
                sh '''
                /usr/bin/docker rm -f sibr-web-container sibr-db-container || true
                
                /usr/bin/docker run -d --name sibr-db-container --network sibr-net \
                  -e MYSQL_ROOT_PASSWORD=root_password \
                  -e MYSQL_DATABASE=invest_db \
                  -p 3306:3306 \
                  -v /var/jenkins_home/workspace/SIBR-Pipeline/database.sql:/docker-entrypoint-initdb.d/database.sql \
                  mysql:8.0
                
                /usr/bin/docker run -d --name sibr-web-container --network sibr-net \
                  -p 8000:80 \
                  -v /var/jenkins_home/workspace/SIBR-Pipeline:/var/www/html \
                  php:8.1-apache
                  
                sleep 7
                /usr/bin/docker exec sibr-web-container bash -c "docker-php-ext-install mysqli pdo pdo_mysql"
                /usr/bin/docker restart sibr-web-container
                '''
            }
        }
    }
}
