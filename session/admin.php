<?php
session_start();
if (!isset($_SESSION['username']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Admin Panel 👑</h2>
<p>Welcome Admin <?= htmlspecialchars($_SESSION['username']) ?></p>
<a href="real login and signup/profile.php">Edit Profile</a> | <a href="logout.php">Logout</a>
</body>
</html>