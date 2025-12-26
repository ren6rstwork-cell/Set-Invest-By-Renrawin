<?php include('db_connect.php'); ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SET INVEST BY RENRAWIN</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Sarabun:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body class="auth-page">
    <div class="auth-container">
        <h2>สมัครสมาชิก</h2>
        <form action="register_db.php" method="post">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>
            
            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Username" required>

            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email" required>

            <label for="password">Password</label>
            <input type="password" name="password_1" placeholder="Password" required>

            <label for="password_2">Confirm Password</label>
            <input type="password" name="password_2" placeholder="Confirm Password" required>

            <button type="submit" name="reg_user" class="cta-button">Register</button>
            
            <p>เป็นสมาชิกแล้ว? <a href="login.php">เข้าสู่ระบบ</a></p>
        </form>
    </div>
</body>
</html>
