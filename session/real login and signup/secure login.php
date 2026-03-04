<?php
session_start();
require "config.php";

if(isset($_POST["login"])){

    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1){

        $user = $result->fetch_assoc();

        // THIS IS THE MAGIC LINE
        if(password_verify($password, $user["password"])){

            $_SESSION["username"] = $user["username"];
            $_SESSION["role"] = $user["role"];

            if($user["role"] === "admin"){
                header("Location: ../admin.php");
            } else {
                header("Location: ../dashboard.php");
            }
            exit();
        }
        else{
            $error = "Invalid password!";
        }
    }
    else{
        $error = "User not found!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>