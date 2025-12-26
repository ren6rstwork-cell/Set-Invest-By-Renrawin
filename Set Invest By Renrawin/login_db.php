<?php
session_start();
include('db_connect.php');

$errors = array();

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('location: SIBR-Index.php');
            } else {
                array_push($errors, "Wrong username/password combination");
                header("location: login.php?error=Wrong username/password combination");
            }
        } else {
            array_push($errors, "Wrong username/password combination");
            header("location: login.php?error=Wrong username/password combination");
        }
    } else {
        header("location: login.php?error=" . $errors[0]);
    }
}
?>
