pipeline {
    // ใช้สิทธิ์ของ docker agent โดยตรง ปลั๊กอินจะเคลียร์เรื่อง Permission กับ Mac ให้เอง
    agent {
        docker { 
            image 'php:8.1-apache'
            args '-v /var/run/docker.sock:/var/run/docker.sock'
        }
    }

    stages {
        stage('Deploy Full-Stack System') {
            steps {
                echo '🚀 สั่งรันระบบใหม่ผ่าน Docker Socket ในบริบทที่ปลอดภัย...'
                
                // สั่งรันผ่าน Docker โดยตรงด้วยสิทธิ์ที่ปลั๊กอินจัดการให้
                sh '''
                docker rm -f sibr-web-container sibr-db-container || true
                
                docker run -d --name sibr-db-container --network sibr-net \
                  -e MYSQL_ROOT_PASSWORD=root_password \
                  -e MYSQL_DATABASE=invest_db \
                  -p 3306:3306 \
                  -v $(pwd)/database.sql:/docker-entrypoint-initdb.d/database.sql \
                  mysql:8.0
                
                docker run -d --name sibr-web-container --network sibr-net \
                  -p 8000:80 \
                  -v $(pwd):/var/www/html \
                  php:8.1-apache
                  
                sleep 5
                docker exec sibr-web-container bash -c "docker-php-ext-install mysqli pdo pdo_mysql"
                docker restart sibr-web-container
                '''
            }
        }
    }
}
