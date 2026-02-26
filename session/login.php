<?php
session_start();

// Hardcoded correct login (for learning)
$correct_username = "hatag";
$correct_password = "1234";

if(isset($_POST["login"])){

    $username = $_POST["username"];
    $password = $_POST["password"];

    if($username === $correct_username && $password === $correct_password){

        $_SESSION["username"] = $username; // store in session
        header("Location: dashboard.php");
        exit();
    }
    else{
        $error = "Invalid login!";
    }
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Login Page</h2>

<form method="post">
    Username: <input type="text" name="username"><br><br>
    Password: <input type="password" name="password"><br><br>
    <input type="submit" name="login" value="Login">
</form>

<?php
if(isset($error)){
    echo "<p style='color:red;'>$error</p>";
}
?>

</body>
</html>