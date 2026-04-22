<?php
require_once "SmartFarm.php";

$farm = new SmartFarm();

// Simulated IoT data
$plots = ["Livestock-1", "Soil-1", "Ankober-1", "Shewarobit-1"];
$plot = $plots[array_rand($plots)];

$temp = rand(24, 36) + (rand(0, 9) / 10);
$hum = rand(45, 85);
$soil = rand(20, 70);

echo $farm->insertSensorData($plot, $temp, $hum, $soil);
?>