<?php
session_start();
session_destroy();
session_start(); // Start new session to prevent session fixation
header("Location: secure login.php");
exit();
?>