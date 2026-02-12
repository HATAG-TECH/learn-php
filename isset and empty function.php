<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="isset and empty function.php" method="post" >
        <label for="username">username:</label>
        <input type="text" name="username" id="username"> <br>
         <label for="password">password:</label>
        <input type="text" name="password" id="password">
        <input type="submit" name="login" value="log in">
    </form>
</body>
</html>
<?php
if(isset($_POST["login"])){

    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check both empty FIRST
    if(empty($username) && empty($password)){
        echo "Username and Password are missing <br>";
    }
    elseif(empty($username)){
        echo "Username is missing <br>";
    }
    elseif(empty($password)){
        echo "Password is missing <br>";
    }
    else{
        echo "Login successful <br>";
        echo "Username: {$username} <br>";
        echo "Password: {$password} <br>";
    }
}
?>
