<?php
// Mode: a+ (read/write - append at end of file)
$data = ["id" => 1, "name" => "Aster", "role" => "Developer"];
$json = json_encode($data, JSON_PRETTY_PRINT);
$file = fopen(__DIR__ . "/user.json", "a+");

if ($file) {
    fwrite($file, $json . PHP_EOL);
    fclose($file);
    echo "Mode a+: Data appended to the end of the file.";
} else {
    echo "Mode a+: Could not open user.json.";
}
?>
