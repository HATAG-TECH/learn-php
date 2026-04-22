<?php
// Mode: c+ (read/write - create if missing, no auto truncate)
$data = ["id" => 1, "name" => "Aster", "role" => "Developer"];
$json = json_encode($data, JSON_PRETTY_PRINT);
$file = fopen(__DIR__ . "/user.json", "c+");

if ($file) {
    ftruncate($file, 0);
    rewind($file);
    fwrite($file, $json);
    fclose($file);
    echo "Mode c+: Data written after manual truncate.";
} else {
    echo "Mode c+: Could not open user.json.";
}
?>
