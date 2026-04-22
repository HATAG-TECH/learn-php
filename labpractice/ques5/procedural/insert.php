<?php
include "db.php";

$plots = ["Livestock-1", "Soil-1", "Ankober-1", "Shewarobit-1"];
$plot_id = $plots[array_rand($plots)];

$temperature = rand(24, 36) + (rand(0, 9) / 10);
$humidity = rand(45, 85);
$soil_moisture = rand(20, 70);

$sql = "INSERT INTO sensor_data (plot_id, temperature, humidity, soil_moisture)
        VALUES ('$plot_id', $temperature, $humidity, $soil_moisture)";

if (mysqli_query($conn, $sql)) {
    echo "Inserted: $plot_id | {$temperature}°C | {$humidity}% | {$soil_moisture}%";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>