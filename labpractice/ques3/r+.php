<?php
// Mode: r+ (read/write - file must exist, no auto truncate)
$data = ["id" => 1, "name" => "Aster", "role" => "Developer"];
$json = json_encode($data, JSON_PRETTY_PRINT);
$file = fopen(__DIR__ . "/user.json", "r+");

if ($file) {
    ftruncate($file, 0);
    rewind($file);
    fwrite($file, $json);
    fclose($file);
    echo "Mode r+: Data written after manual truncate.";
} else {
    echo "Mode r+: Could not open user.json. The file may not exist.";
}
?>
