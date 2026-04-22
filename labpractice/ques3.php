// ===== Mode: r =====

<?php
// Mode: r (read only - writing is not allowed)
$data = ["id" => 1, "name" => "Aster", "role" => "Developer"];
$json = json_encode($data, JSON_PRETTY_PRINT);
$file = fopen("user.json", "r");

if ($file) {
    echo "Mode r: File opened in read-only mode. fwrite() cannot be used in this mode.";
    fclose($file);
} else {
    echo "Mode r: Could not open user.json. File may not exist.";
}
?>


// ===== Mode: w =====

<?php
// Mode: w (write - overwrite file)
$data = ["id" => 1, "name" => "Aster", "role" => "Developer"];
$json = json_encode($data, JSON_PRETTY_PRINT);
$file = fopen("user.json", "w");

if ($file) {
    fwrite($file, $json);
    fclose($file);
    echo "Mode w: Data written. Existing file content was overwritten.";
} else {
    echo "Mode w: Could not open user.json.";
}
?>


// ===== Mode: a =====

<?php
// Mode: a (append - add data at end of file)
$data = ["id" => 1, "name" => "Aster", "role" => "Developer"];
$json = json_encode($data, JSON_PRETTY_PRINT);
$file = fopen("user.json", "a");

if ($file) {
    fwrite($file, $json . PHP_EOL);
    fclose($file);
    echo "Mode a: Data appended to the end of the file.";
} else {
    echo "Mode a: Could not open user.json.";
}
?>


// ===== Mode: r+ =====

<?php
// Mode: r+ (read/write - file must exist, no auto truncate)
$data = ["id" => 1, "name" => "Aster", "role" => "Developer"];
$json = json_encode($data, JSON_PRETTY_PRINT);
$file = fopen("user.json", "r+");

if ($file) {
    ftruncate($file, 0);
    rewind($file);
    fwrite($file, $json);
    fclose($file);
    echo "Mode r+: Data written after manual truncate.";
} else {
    echo "Mode r+: Could not open user.json. File may not exist.";
}
?>


// ===== Mode: w+ =====

<?php
// Mode: w+ (read/write - overwrite file)
$data = ["id" => 1, "name" => "Aster", "role" => "Developer"];
$json = json_encode($data, JSON_PRETTY_PRINT);
$file = fopen("user.json", "w+");

if ($file) {
    fwrite($file, $json);
    fclose($file);
    echo "Mode w+: Data written. Existing file content was overwritten.";
} else {
    echo "Mode w+: Could not open user.json.";
}
?>


// ===== Mode: a+ =====

<?php
// Mode: a+ (read/write - append at end of file)
$data = ["id" => 1, "name" => "Aster", "role" => "Developer"];
$json = json_encode($data, JSON_PRETTY_PRINT);
$file = fopen("user.json", "a+");

if ($file) {
    fwrite($file, $json . PHP_EOL);
    fclose($file);
    echo "Mode a+: Data appended to the end of the file.";
} else {
    echo "Mode a+: Could not open user.json.";
}
?>


// ===== Mode: x =====

<?php
// Mode: x (write - create new file, fail if file exists)
$data = ["id" => 1, "name" => "Aster", "role" => "Developer"];
$json = json_encode($data, JSON_PRETTY_PRINT);
$file = @fopen("user.json", "x");

if ($file) {
    fwrite($file, $json);
    fclose($file);
    echo "Mode x: New file created and data written.";
} else {
    echo "Mode x: Failed. user.json already exists.";
}
?>


// ===== Mode: x+ =====

<?php
// Mode: x+ (read/write - create new file, fail if file exists)
$data = ["id" => 1, "name" => "Aster", "role" => "Developer"];
$json = json_encode($data, JSON_PRETTY_PRINT);
$file = @fopen("user.json", "x+");

if ($file) {
    fwrite($file, $json);
    fclose($file);
    echo "Mode x+: New file created and data written.";
} else {
    echo "Mode x+: Failed. user.json already exists.";
}
?>


// ===== Mode: c =====

<?php
// Mode: c (write - create if missing, no auto truncate)
$data = ["id" => 1, "name" => "Aster", "role" => "Developer"];
$json = json_encode($data, JSON_PRETTY_PRINT);
$file = fopen("user.json", "c");

if ($file) {
    ftruncate($file, 0);
    rewind($file);
    fwrite($file, $json);
    fclose($file);
    echo "Mode c: Data written after manual truncate.";
} else {
    echo "Mode c: Could not open user.json.";
}
?>


// ===== Mode: c+ =====

<?php
// Mode: c+ (read/write - create if missing, no auto truncate)
$data = ["id" => 1, "name" => "Aster", "role" => "Developer"];
$json = json_encode($data, JSON_PRETTY_PRINT);
$file = fopen("user.json", "c+");

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
