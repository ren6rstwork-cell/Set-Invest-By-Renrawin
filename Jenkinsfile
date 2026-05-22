pipeline {
    agent any

    stages {
        stage('Deploy Full-Stack System') {
            steps {
                sh '''
                docker rm -f sibr-web-container sibr-db-container || true

                docker run -d --name sibr-db-container \
                  --network sibr-net \
                  -e MYSQL_ROOT_PASSWORD=root_password \
                  -e MYSQL_DATABASE=invest_db \
                  -p 3306:3306 \
                  mysql:8.0

                docker run -d --name sibr-web-container \
                  --network sibr-net \
                  -p 8000:80 \
                  php:8.1-apache

                sleep 5

                docker cp ${WORKSPACE}/. sibr-web-container:/var/www/html/

                docker exec sibr-web-container bash -c "docker-php-ext-install mysqli pdo pdo_mysql"

                docker exec sibr-web-container bash -c "cat > /etc/apache2/sites-enabled/000-default.conf << 'APACHEEOF'
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html
    <Directory /var/www/html>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
        DirectoryIndex SIBR-Index.php index.php index.html
    </Directory>
    ErrorLog \${APACHE_LOG_DIR}/error.log
    CustomLog \${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
APACHEEOF"

                docker exec sibr-web-container chmod -R 755 /var/www/html
                docker restart sibr-web-container
                '''
            }
        }
    }
}
