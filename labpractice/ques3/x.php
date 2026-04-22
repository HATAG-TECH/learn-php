<?php
// Mode: x (write - create new file, fail if file exists)
$data = ["id" => 1, "name" => "Aster", "role" => "Developer"];
$json = json_encode([$data], JSON_PRETTY_PRINT);
$file = @fopen(__DIR__ . "/user.json", "x");

if ($file) {
    fwrite($file, $json);
    fclose($file);
    echo "New file created and data written.";
} else {
    echo "Failed. user.json already exists.";
}
?>
