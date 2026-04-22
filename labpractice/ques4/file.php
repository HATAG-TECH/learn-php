<?php
$fname = $_POST["fname"] ?? "";
$lname = $_POST["lname"] ?? "";
$mail = $_POST["email"] ?? "";

$filePath = __DIR__ . "/guest.txt";
$fh = fopen($filePath, "w+");

if (!$fh) {
    echo "The info is not saved, the file doesn't exist.";
} else {
    fwrite($fh, $fname . "\t" . $lname . "\t" . $mail . "\t");
    fclose($fh);
    echo "<br>Your data is saved!!<br>";
}
?>
