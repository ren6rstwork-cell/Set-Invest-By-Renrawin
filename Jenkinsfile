pipeline {
    agent any

    stages {
        stage('Deploy Full-Stack System') {
            steps {
                echo '🚀 สั่งรันระบบ Full-Stack แบบเมาท์สิทธิ์ตรงเข้าโครงสร้างหลัก...'
                
                sh '''
                # 1. เคลียร์ตู้เก่าที่ค้างอยู่ทิ้งไป
                docker rm -f sibr-web-container sibr-db-container || true
                
                # 2. รัน MySQL ดึงไฟล์ sql ไปรอไว้ที่จุด Init
                docker run -d --name sibr-db-container --network sibr-net \
                  -e MYSQL_ROOT_PASSWORD=root_password \
                  -e MYSQL_DATABASE=invest_db \
                  -p 3306:3306 \
                  --volumes-from jenkins \
                  -v jenkins_home:/var/jenkins_home \
                  mysql:8.0 bash -c "sleep 2 && cp ${WORKSPACE}/database.sql /docker-entrypoint-initdb.d/ && docker-entrypoint.sh mysqld"
                
                # 3. รัน PHP Web โดยดึงเนื้อหาจาก Workspace ใน Jenkins ไปครอบลงโฟลเดอร์ของ Apache ตรงๆ
                docker run -d --name sibr-web-container --network sibr-net \
                  -p 8000:80 \
                  --volumes-from jenkins \
                  -v jenkins_home:/var/jenkins_home \
                  -v ${WORKSPACE}:/var/www/html \
                  php:8.1-apache
                  
                # 4. รอระบบเว็บนิ่ง แล้วสั่งเปิดไดรเวอร์และปลดสิทธิ์ให้อ่านไฟล์ได้ทันที
                sleep 5
                docker exec sibr-web-container chmod -R 777 /var/www/html
                docker exec sibr-web-container bash -c "docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli pdo_mysql"
                
                # 5. รีสตาร์ตตู้เว็บเพื่อให้ระบบทั้งหมดเริ่มทำงานแบบสมบูรณ์
                docker restart sibr-web-container
                '''
            }
        }
    }
}
