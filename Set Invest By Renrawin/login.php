<?php include('db_connect.php'); ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SET INVEST BY RENRAWIN</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Sarabun:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body class="auth-page">
    <div class="auth-container">
        <h2>เข้าสู่ระบบ</h2>
        <form action="login_db.php" method="post">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            
            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Username" required>

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit" name="login_user" class="cta-button">Login</button>
            
            <p>ยังไม่เป็นสมาชิก? <a href="register.php">สมัครเลย</a></p>
        </form>
    </div>
</body>
</html>
