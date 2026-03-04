<?php
require "config.php";

// Example: Update one user
$newPassword = password_hash("1234", PASSWORD_DEFAULT);

$sql = "UPDATE users SET password = ? WHERE username = 'hatag'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $newPassword);
$stmt->execute();

echo "Password updated!";
?>