<?php
session_start();
session_destroy();
header("Location: secure login.php");
exit();
?>