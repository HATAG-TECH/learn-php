<?php
session_start();
require "config.php";

if(isset($_POST["login"])){

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1){

        $user = $result->fetch_assoc();

        $_SESSION["username"] = $user["username"];
        $_SESSION["role"] = $user["role"];

        if($user["role"] === "admin"){
            header("Location: admin.php");
        } else {
            header("Location: dashboard.php");
        }
        exit();
    }
    else{
        $error = "Invalid login!";
    }
}
?>