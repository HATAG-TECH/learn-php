// example of login with hardcoded credentials
<!-- <?php
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

 -->



 

 // example of login with multiple users and roles
 <?php
session_start();

$users = [
    ["username" => "hatag", "password" => "1234", "role" => "admin"],
    ["username" => "john", "password" => "1111", "role" => "user"],
    ["username" => "sara", "password" => "2222", "role" => "user"]
];

if(isset($_POST["login"])){

    $username = $_POST["username"];
    $password = $_POST["password"];

    $foundUser = null;

    foreach($users as $user){
        if($user["username"] === $username && $user["password"] === $password){
            $foundUser = $user;
            break;
        }
    }

    if($foundUser){
        $_SESSION["username"] = $foundUser["username"];
        $_SESSION["role"] = $foundUser["role"];

        if($foundUser["role"] === "admin"){
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
