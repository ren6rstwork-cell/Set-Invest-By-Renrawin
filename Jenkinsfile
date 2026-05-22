pipeline {
    agent any

    stages {
        stage('Deploy Full-Stack System') {
            steps {
                echo '🚀 สั่งรันระบบ Full-Stack ผ่านพาธไดนามิกที่ถูกต้อง...'
                
                sh '''
                # 1. ล้างตู้เก่าออกไปก่อน
                docker rm -f sibr-web-container sibr-db-container || true
                
                # 2. รัน MySQL ดึงไฟล์ sql ผ่านตัวแปร ${WORKSPACE} ที่ Jenkins กำหนดให้จริง
                docker run -d --name sibr-db-container --network sibr-net \
                  -e MYSQL_ROOT_PASSWORD=root_password \
                  -e MYSQL_DATABASE=invest_db \
                  -p 3306:3306 \
                  --volumes-from jenkins \
                  -v jenkins_home:/var/jenkins_home \
                  mysql:8.0 bash -c "sleep 3 && cp ${WORKSPACE}/database.sql /docker-entrypoint-initdb.d/ && docker-entrypoint.sh mysqld"
                
                # 3. รัน PHP Web โดยให้ชี้ DocumentRoot ไปที่ตัวแปร ${WORKSPACE} จริงของรอบนั้นๆ
                docker run -d --name sibr-web-container --network sibr-net \
                  -p 8000:80 \
                  --volumes-from jenkins \
                  -v jenkins_home:/var/jenkins_home \
                  -w ${WORKSPACE} \
                  php:8.1-apache bash -c "sed -i 's|/var/www/html|${WORKSPACE}|g' /etc/apache2/sites-available/000-default.conf && apache2-foreground"
                  
                # 4. เรียกเปิดใช้งาน Extension ฐานข้อมูล
                sleep 5
                docker exec sibr-web-container bash -c "docker-php-ext-enable mysqli pdo_mysql || (apt-get update && apt-get install -y libmariadb-dev && docker-php-ext-install mysqli pdo pdo_mysql)"
                
                # 5. รีสตาร์ตตู้เว็บเพื่อเคลียร์คอนฟิก
                docker restart sibr-web-container
                '''
            }
        }
    }
}
