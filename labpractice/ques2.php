<?php
// Data to write
$data = [
	"employees" => [
		["firstName" => "John", "lastName" => "Doe"],
		["firstName" => "Anna", "lastName" => "Smith"],
		["firstName" => "Peter", "lastName" => "Jones"]
	]
];

// Convert to JSON
$jsonData = json_encode($data, JSON_PRETTY_PRINT);

if ($jsonData === false) {
	echo "Failed to encode data into JSON.";
	exit;
}

// Write into a JSON file in the same folder as this script
$filePath = __DIR__ . "/employees.json";
$bytes = file_put_contents($filePath, $jsonData);

if ($bytes === false) {
	echo "Failed to write data into employees.json.";
} else {
	echo "Data successfully written to employees.json";
}
?>