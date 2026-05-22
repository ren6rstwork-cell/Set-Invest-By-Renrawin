pipeline {
    agent any

    stages {
        stage('Deploy Full-Stack System') {
            steps {
                echo '🚀 สั่งรันระบบ Full-Stack ผ่าน Local Docker Client ตัวใหม่...'
                
                sh '''
                docker rm -f sibr-web-container sibr-db-container || true
                
                docker run -d --name sibr-db-container --network sibr-net \
                  -e MYSQL_ROOT_PASSWORD=root_password \
                  -e MYSQL_DATABASE=invest_db \
                  -p 3306:3306 \
                  -v /var/jenkins_home/workspace/SIBR-Pipeline/database.sql:/docker-entrypoint-initdb.d/database.sql \
                  mysql:8.0
                
                docker run -d --name sibr-web-container --network sibr-net \
                  -p 8000:80 \
                  -v /var/jenkins_home/workspace/SIBR-Pipeline:/var/www/html \
                  php:8.1-apache
                  
                sleep 7
                docker exec sibr-web-container bash -c "docker-php-ext-install mysqli pdo pdo_mysql"
                docker restart sibr-web-container
                '''
            }
        }
    }
}
