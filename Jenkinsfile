pipeline {
    agent any

    stages {
        stage('Deploy Full-Stack System') {
            steps {
                echo '🚀 สั่งรันระบบ Full-Stack ด้วยการดึงข้อมูลจาก Volume ท่อตรง...'
                
                sh '''
                docker rm -f sibr-web-container sibr-db-container || true
                
                # 1. รัน MySQL DB โดยดึงไฟล์ฐานข้อมูลผ่าน Volume ของ Jenkins Home โดยตรง
                docker run -d --name sibr-db-container --network sibr-net \
                  -e MYSQL_ROOT_PASSWORD=root_password \
                  -e MYSQL_DATABASE=invest_db \
                  -p 3306:3306 \
                  --volumes-from jenkins \
                  -v jenkins_home:/var/jenkins_home \
                  mysql:8.0 bash -c "cp /var/jenkins_home/workspace/SIBR-Pipeline/database.sql /docker-entrypoint-initdb.d/ && docker-entrypoint.sh mysqld"
                
                # 2. รัน PHP Web โดยแชร์ไฟล์โค้ด (Workspace) ส่งตรงมาจากตู้ Jenkins เลย ไม่ผ่าน Mac
                docker run -d --name sibr-web-container --network sibr-net \
                  -p 8000:80 \
                  --volumes-from jenkins \
                  -w /var/jenkins_home/workspace/SIBR-Pipeline \
                  php:8.1-apache bash -c "ln -s /var/jenkins_home/workspace/SIBR-Pipeline /var/www/html/sibr && sed -i 's|/var/www/html|/var/jenkins_home/workspace/SIBR-Pipeline|g' /etc/apache2/sites-available/000-default.conf && apache2-foreground"
                  
                sleep 7
                docker exec sibr-web-container bash -c "docker-php-ext-install mysqli pdo pdo_mysql"
                docker restart sibr-web-container
                '''
            }
        }
    }
}
