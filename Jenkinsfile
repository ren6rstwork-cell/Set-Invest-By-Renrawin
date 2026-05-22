pipeline {
    agent any

    stages {
        stage('Deploy Full-Stack System') {
            steps {
                echo '🚀 สั่งรันระบบ Full-Stack แบบคลีนและเสถียรที่สุด...'
                
                sh '''
                # 1. ล้างตู้เก่า
                docker rm -f sibr-web-container sibr-db-container || true
                
                # 2. รัน MySQL และนำเข้าฐานข้อมูล
                docker run -d --name sibr-db-container --network sibr-net \
                  -e MYSQL_ROOT_PASSWORD=root_password \
                  -e MYSQL_DATABASE=invest_db \
                  -p 3306:3306 \
                  --volumes-from jenkins \
                  -v jenkins_home:/var/jenkins_home \
                  mysql:8.0 bash -c "sleep 2 && cp /var/jenkins_home/workspace/SIBR-Pipeline/database.sql /docker-entrypoint-initdb.d/ && docker-entrypoint.sh mysqld"
                
                # 3. รัน PHP Web โดยดึงไฟล์ Workspace เข้าไปทำงานตรงๆ 
                docker run -d --name sibr-web-container --network sibr-net \
                  -p 8000:80 \
                  --volumes-from jenkins \
                  -v jenkins_home:/var/jenkins_home \
                  -w /var/jenkins_home/workspace/SIBR-Pipeline \
                  php:8.1-apache bash -c "sed -i 's|/var/www/html|/var/jenkins_home/workspace/SIBR-Pipeline|g' /etc/apache2/sites-available/000-default.conf && apache2-foreground"
                  
                # 4. ใช้ท่าสั่งติดตั้งไดรเวอร์แบบปลอดภัย (เคลียร์แคชก่อนรัน)
                sleep 5
                docker exec sibr-web-container bash -c "docker-php-ext-enable mysqli pdo_mysql || (apt-get update && apt-get install -y libmariadb-dev && docker-php-ext-install mysqli pdo pdo_mysql)"
                
                # 5. รีสตาร์ตตู้เว็บเพื่อให้ระบบทั้งหมดเริ่มทำงาน
                docker restart sibr-web-container
                '''
            }
        }
    }
}
