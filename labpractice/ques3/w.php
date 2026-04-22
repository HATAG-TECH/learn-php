<?php
// Mode: w (write - overwrite file)
$data = ["id" => 1, "name" => "Habtamu", "role" => "Developer"];
$json = json_encode([$data], JSON_PRETTY_PRINT);
$file = fopen(__DIR__ . "/user.json", "w");

if ($file) {
    fwrite($file, $json);
    fclose($file);
    echo "Data written. Existing content was overwritten.";
} else {
    echo "Could not open user.json.";
}
?>
