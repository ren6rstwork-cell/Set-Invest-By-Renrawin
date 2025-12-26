<?php
session_start();
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - SET INVEST BY RENRAWIN</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Sarabun:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .payment-section {
            padding: 80px 0;
            background-color: var(--bg-body);
            min-height: calc(100vh - 80px); /* Adjust for navbar */
        }
        
        .payment-container {
            background-color: var(--bg-card);
            padding: 40px;
            border-radius: var(--border-radius);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 0 auto;
        }

        .payment-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .payment-header h1 {
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .order-summary {
            background-color: var(--bg-accent);
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .amount {
            color: var(--text-accent);
            font-size: 1.5rem;
        }

        .payment-methods {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .method-btn {
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            background: white;
            cursor: pointer;
            font-family: var(--font-body);
            font-size: 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .method-btn.active, .method-btn:hover {
            border-color: var(--primary-color);
            background-color: var(--bg-accent);
            color: var(--primary-color);
        }

        .method-content {
            display: none;
            padding: 20px;
            border: 1px solid #eee;
            border-radius: 8px;
            animation: fadeIn 0.5s ease;
        }

        .method-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Bank Transfer Styling */
        .bank-details {
            text-align: center;
        }
        .bank-logo {
            width: 80px;
            margin: 0 auto 15px;
            /* Placeholder for KBank logo color */
            height: 80px;
            background-color: #138f2d;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: bold;
        }
        .account-number {
            font-size: 1.5rem;
            color: var(--primary-color);
            font-weight: 700;
            margin: 10px 0;
            letter-spacing: 1px;
        }

        /* Credit Card Form */
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: var(--font-body);
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
    </style>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <a href="SIBR-Index.php" class="logo">SET INVEST <span>BY RENRAWIN</span></a>
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

    <div class="payment-section">
        <div class="container">
            <div class="payment-container">
                <div class="payment-header">
                    <h1>ชำระค่าสมัครเรียน</h1>
                    <p>กรุณาเลือกช่องทางการชำระเงินเพื่อเข้าถึงเนื้อหาคอร์สเรียน</p>
                </div>

                <div class="order-summary">
                    <span>ค่าสมัครเรียน (Lifetime Access)</span>
                    <span class="amount">1.00 THB</span>
                </div>

                <div class="payment-methods">
                    <button class="method-btn active" onclick="showMethod('bank')">
                        <i class="fa-solid fa-building-columns"></i> โอนเงินผ่านธนาคาร
                    </button>
                    <button class="method-btn" onclick="showMethod('card')">
                        <i class="fa-regular fa-credit-card"></i> บัตรเครดิต / เดบิต
                    </button>
                </div>

                <!-- Bank Transfer Content -->
                <div id="bank" class="method-content active">
                    <div class="bank-details">
                        <div class="bank-logo">K</div>
                        <h3>ธนาคารกสิกรไทย (KBank)</h3>
                        <p class="account-number">185-1-75283-4</p>
                        <p><strong>ชื่อบัญชี:</strong> RENRAWIN NUANIN</p>
                        <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">
                        <p class="text-secondary" style="font-size: 0.9rem;">เมื่อโอนเงินแล้ว กรุณาแจ้งสลิปการโอนผ่านทาง LINE หรือช่องทางติดต่อ</p>
                    </div>
                </div>

                <!-- Card Content -->
                <div id="card" class="method-content">
                    <form onsubmit="event.preventDefault(); alert('ระบบตัดบัตรเครดิตยังไม่เปิดใช้งานในขณะนี้ (Demo Msg)');">
                        <div class="form-group">
                            <label>หมายเลขบัตร (Card Number)</label>
                            <input type="text" placeholder="xxxx xxxx xxxx xxxx" maxlength="19">
                        </div>
                        <div class="form-group">
                            <label>ชื่อบนบัตร (Cardholder Name)</label>
                            <input type="text" placeholder="RENRAWIN NUANIN">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>วันหมดอายุ (Expiry Date)</label>
                                <input type="text" placeholder="MM/YY">
                            </div>
                            <div class="form-group">
                                <label>CVV</label>
                                <input type="text" placeholder="123" maxlength="3">
                            </div>
                        </div>
                        <button type="submit" class="cta-button" style="width: 100%;">ชำระเงิน 1.00 THB</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        function showMethod(method) {
            // Hide all
            document.querySelectorAll('.method-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.method-btn').forEach(el => el.classList.remove('active'));
            
            // Show selected
            document.getElementById(method).classList.add('active');
            
            // Highlight button (simple logic for demo)
            const btnIndex = method === 'bank' ? 0 : 1;
            document.querySelectorAll('.method-btn')[btnIndex].classList.add('active');
        }
    </script>
</body>
</html>
