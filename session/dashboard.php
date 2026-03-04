<?php
session_start();
if (!isset($_SESSION['username']) || ($_SESSION['role'] ?? '') !== 'user') {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>User Dashboard</h2>
<p>Welcome <?= htmlspecialchars($_SESSION['username']) ?></p>
<a href="real login and signup/profile.php">Edit Profile</a> | <a href="logout.php">Logout</a>
</body>
</html>