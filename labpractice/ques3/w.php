<?php
// Mode: w (write - overwrite file)
$data = ["id" => 1, "name" => "Aster", "role" => "Developer"];
$json = json_encode([$data], JSON_PRETTY_PRINT);
$file = fopen(__DIR__ . "/user.json", "w");

if ($file) {
    fwrite($file, $json);
    fclose($file);
    echo "Mode w: Data written. Existing content was overwritten.";
} else {
    echo "Mode w: Could not open user.json.";
}
?>
