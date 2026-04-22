<?php
// Database connection file

$host = "localhost";
$user = "root";
$password = "";
$dbname = "smart_farm";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>