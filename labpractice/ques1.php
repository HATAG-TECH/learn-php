<?php
// Step 1: Read the JSON file (use full path of this folder)
$jsonData = file_get_contents(__DIR__ . "/data.json");

if ($jsonData === false) {
	echo "Unable to read data.json";
	exit;
}

// Step 2: Decode JSON into a PHP associative array
$dataArray = json_decode($jsonData, true);

if (!is_array($dataArray)) {
	echo "Invalid JSON format in data.json";
	exit;
}

// Step 3: Access and display each student's data
foreach ($dataArray as $studentId => $student) {
	echo strtoupper($studentId) . ":<br>";
	echo "Name: " . ($student["name"] ?? "N/A") . "<br>";
	echo "Age: " . ($student["age"] ?? "N/A") . "<br>";
	echo "City: " . ($student["city"] ?? "N/A") . "<br><br>";
}
?>