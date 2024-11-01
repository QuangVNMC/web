<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quan_ly_thiet_bi";

// Kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
