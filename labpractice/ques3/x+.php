<?php
// Mode: x+ (read/write - create new file, fail if file exists)
$data = ["id" => 1, "name" => "Aster", "role" => "Developer"];
$json = json_encode([$data], JSON_PRETTY_PRINT);
$file = @fopen(__DIR__ . "/user.json", "x+");

if ($file) {
    fwrite($file, $json);
    fclose($file);
    echo "Mode x+: New file created and data written.";
} else {
    echo "Mode x+: Failed. user.json already exists.";
}
?>
