<?php
session_start();

// Protect page
if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Welcome <?php echo $_SESSION["username"]; ?> 🎉</h2>

<p>You are successfully logged in.</p>

<a href="logout.php">Logout</a>

</body>
</html>