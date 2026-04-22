<?php
// Mode: a+ (read/write - append at end of file)
$data = ["id" => 1, "name" => "Habtamu", "role" => "Developer"];
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
$file = fopen($filePath, "a+");
$ok = false;

if ($file) {
    // In append mode, adding only a newline keeps current JSON valid.
    fwrite($file, PHP_EOL);
    fclose($file);
    // Save the updated valid JSON array.
    if (file_put_contents($filePath, $json) !== false) {
        $ok = true;
    }
}

if ($ok) {
    echo "Data appended to the end of the file.";
} else {
    echo "Could not open user.json.";
}
?>
