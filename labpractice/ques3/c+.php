<?php
// Mode: c+ (read/write - create if missing, no auto truncate)
$data = ["id" => 1, "name" => "Aster", "role" => "Developer"];
$filePath = __DIR__ . "/user.json";
$existing = [];

if (file_exists($filePath)) {
    $content = file_get_contents($filePath);
    $decoded = json_decode($content, true);
    if (is_array($decoded)) {
        $existing = $decoded;
    }
}

$existing[] = $data;
$json = json_encode($existing, JSON_PRETTY_PRINT);
$file = fopen($filePath, "c+");

if ($file) {
    ftruncate($file, 0);
    rewind($file);
    fwrite($file, $json);
    fclose($file);
    echo "Data written after manual truncate.";
} else {
    echo "Could not open user.json.";
}
?>
