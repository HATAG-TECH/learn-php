
// This file is for the dashboard page that users see after logging in. It checks if the user is logged in by verifying the session variable. If not, it redirects them to the login page. If they are logged in, it displays a welcome message and a logout link.
<!-- <?php
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
 -->

// example of role-based access control
 <?php
session_start();

if(!isset($_SESSION["username"]) || $_SESSION["role"] !== "user"){
    header("Location: login.php");
    exit();
}
?>

<h2>User Dashboard</h2>
<p>Welcome <?php echo $_SESSION["username"]; ?></p>
<a href="logout.php">Logout</a>