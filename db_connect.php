<?php
$servername = "sibr-db-container";
$username = "root";
$password = "root_password";
$dbname = "invest_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
