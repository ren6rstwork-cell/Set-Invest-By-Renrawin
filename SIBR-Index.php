<?php 
session_start(); 
if(!isset($_SESSION['username'])) {
   // Ensure session is started for auth check
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SET INVEST BY RENRAWIN - Mastering SET Invest</title>
    <meta name="description"
        content="วางแผนเทรด เลือกหุ้นเป็น จัดพอร์ตได้จริง คอร์สเรียนออนไลน์การลงทุนในตลาดหลักทรัพย์">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Sarabun:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <a href="#" class="logo">SET INVEST <span>BY RENRAWIN</span></a>
            <div class="nav-links">
                <?php if (isset($_SESSION['username'])) : ?>
                    <span style="margin-right: 15px; color: var(--text-primary);">Welcome, <strong><?php echo $_SESSION['username']; ?></strong></span>
                    <a href="logout.php" class="cta-button nav-cta" style="background-color: #d9534f;">Logout</a>
                <?php else : ?>
                    <a href="login.php" class="cta-button nav-cta">เข้าสู่ระบบ</a>
                <?php endif ?>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <div class="container hero-content">
            <div class="hero-text">
                <h1>พื้นฐานการลงทุนในตลาดหุ้นไทยให้แน่น พร้อมกลยุทธ์ทำกำไรอย่างยั่งยืน</h1>
                <p>ไม่ใช่แค่ "ซื้อตาม" แต่คือการ "เข้าใจหัวใจของตลาด" ตั้งแต่ดัชนีพื้นฐาน
                    ไปจนถึงเทคนิคการเลือกหุ้นระดับโลก และการบริหารความเสี่ยงอย่างมืออาชีพ</p>
                <a href="payment.php" class="cta-button hero-cta" style="text-decoration: none; display: inline-block;">สมัครเรียนเลยวันนี้</a>
            </div>
            <div class="hero-image">
                <img src="unnamed.jpg" alt="Investment Growth Illustration"
                    style="border-radius: var(--border-radius); box-shadow: 0 15px 40px rgba(0,0,0,0.1);">
            </div>
        </div>
    </header>

    <!-- Course Modules Section -->
    <section class="modules" id="course-content">
        <div class="container">
            <h2 class="section-title">เนื้อหาคอร์สเรียน</h2>
            <div class="modules-grid">
                <!-- Module 1 -->
                <div class="module-card">
                    <div class="module-number">01</div>
                    <h3>ทำความรู้จักกับตลาดหุ้นไทย (Understanding SET)</h3>
                    <ul>
                        <li>เรียนรู้ดัชนีราคาหุ้นตลาดหลักทรัพย์ฯ (SET Index) ทั้งความหมายและการอ่านค่าสีเขียว-แดง</li>
                        <li>เจาะลึกดัชนีสำคัญ (SET50, SET100, SETHD, sSET, SETTHSI, mai)</li>
                        <li>เข้าใจรอบการทบทวนรายชื่อหุ้นในดัชนีทุกๆ 6 เดือน</li>
                    </ul>
                </div>

                <!-- Module 2 -->
                <div class="module-card">
                    <div class="module-number">02</div>
                    <h3>เลือกกลยุทธ์ที่ใช่สำหรับคุณ (Investment Strategies)</h3>
                    <ul>
                        <li>"รู้เขา รู้เรา รบร้อยครั้ง ชนะร้อยครั้ง": ค้นหาสไตล์การลงทุนที่เหมาะกับคุณ</li>
                        <li><strong>Market Timing:</strong> จับจังหวะตลาด หาจุดซื้อถูก ขายแพง</li>
                        <li><strong>DCA:</strong> เน้นวินัย ออมหุ้น เหมาะกับคนไม่มีเวลา</li>
                    </ul>
                </div>

                <!-- Module 3 -->
                <div class="module-card">
                    <div class="module-number">03</div>
                    <h3>เทคนิคการเลือกหุ้นฉบับมือโปร (Stock Selection)</h3>
                    <ul>
                        <li>รู้จักหุ้น 6 ประเภทตามแนวคิด "ปีเตอร์ ลินซ์" (Peter Lynch)</li>
                        <li><strong>Top Down:</strong> วิเคราะห์จาก Mega Trend -> อุตสาหกรรม -> หุ้น</li>
                        <li><strong>Bottom Up:</strong> เฟ้นหาหุ้นพื้นฐานดี (ROE, Margin สูง)</li>
                    </ul>
                </div>

                <!-- Module 4 -->
                <div class="module-card">
                    <div class="module-number">04</div>
                    <h3>การจัดพอร์ตและการบริหารความเสี่ยง (Portfolio Management)</h3>
                    <ul>
                        <li>จำนวนหุ้นที่เหมาะสม (4-10 ตัว) เพื่อกระจายความเสี่ยง</li>
                        <li>การกระจายการลงทุนในหลายอุตสาหกรรม</li>
                        <li>กลยุทธ์การขาย: Stop Loss และ Rebalance พอร์ต</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Key Highlights Section -->
    <section class="highlights">
        <div class="container">
            <h2 class="section-title">จุดเด่นของคอร์ส</h2>
            <div class="highlights-grid">
                <div class="highlight-item">
                    <i class="fa-solid fa-map"></i>
                    <h3>สร้างแผนการลงทุนที่ดี</h3>
                    <p>เพราะหัวใจสำคัญที่สุดของการลงทุนคือการมีแผน</p>
                </div>
                <div class="highlight-item">
                    <i class="fa-solid fa-chart-line"></i>
                    <h3>เน้นนำไปใช้จริง</h3>
                    <p>สอนให้เข้าใจว่าเมื่อไหร่ควรซื้อ และสำคัญกว่านั้นคือ "เมื่อไหร่ควรขาย"</p>
                </div>
                <div class="highlight-item">
                    <i class="fa-solid fa-sliders"></i>
                    <h3>ปรับตามไลฟ์สไตล์</h3>
                    <p>ไม่ว่าคุณจะมีเงินก้อนหรือเงินเย็นรายเดือน ก็มีวิธีที่เหมาะสมให้เลือกใช้</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Analogy Section -->
    <section class="analogy">
        <div class="container">
            <div class="analogy-content">
                <div class="analogy-text">
                    <h2>การลงทุนก็เหมือน "การขับรถทางไกล"</h2>
                    <ul class="analogy-list">
                        <li>
                            <strong>SET Index</strong> คือ <em>ป้ายบอกทาง</em> บอกสภาพถนน
                        </li>
                        <li>
                            <strong>DCA / Market Timing</strong> คือ <em>วิธีการขับขี่</em> (ขับเรื่อยๆ หรือ เร่งแซง)
                        </li>
                        <li>
                            <strong>เลือกหุ้น 6 ประเภท</strong> คือ <em>การเลือกประเภทรถ</em> ให้เหมาะกับเส้นทาง
                        </li>
                        <li>
                            <strong>จัดพอร์ต & Stop Loss</strong> คือ <em>เข็มขัดนิรภัย & ยางอะไหล่</em>
                            เพื่อความปลอดภัย
                        </li>
                    </ul>
                </div>
                <!-- Visual placeholder for car/road graphic -->
                <div class="analogy-visual">
                    <i class="fa-solid fa-car-side"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer & CTA -->
    <footer class="footer">
        <div class="container footer-content">
            <div class="footer-cta">
                <h2>อย่าเริ่มลงทุนด้วยความไม่รู้...</h2>
                <p>ให้ความรู้สร้างความมั่นใจก่อนวางเงินในสนามจริง</p>
                <a href="payment.php" class="cta-button primary-cta" style="text-decoration: none; display: inline-block;">ลงทะเบียนเรียนตอนนี้</a>
            </div>
            <div class="footer-copy">
                <p>&copy; 2024 SET INVEST BY RENRAWIN. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>