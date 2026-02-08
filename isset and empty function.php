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
// $username= $_POST["username"];
// $password= $_POST["password"];
// echo "Username: {$username} <br>";
// echo "Password: {$password} <br>";



// foreach($_POST as $key => $value){
//     echo "{$key} = {$value} <br>";
// }

if(isset($_POST["login"])){
    $username= $_POST["username"];
    $password= $_POST["password"];
    if(empty($username)){
        echo "username is missing";
    }
    elseif(empty($password)){
         echo "password is missing";

    }
    else{
        echo "username and password is inserted <br>";
        echo "username: {$username} <br>";
        echo "password: {$password} <br>";
    
    }
}


?>