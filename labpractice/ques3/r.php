<?php
// Mode: r (read only - writing is not allowed)
$data = ["id" => 1, "name" => "Aster", "role" => "Developer"];
$json = json_encode($data, JSON_PRETTY_PRINT);
$file = fopen(__DIR__ . "/user.json", "r");

if ($file) {
    echo "File opened in read-only mode. Writing with fwrite() is not allowed, so user.json stays unchanged and valid.";
    fclose($file);
} else {
    echo "Could not open user.json. The file may not exist.";
}
?>
