<?php
include "db.php";

// Simulated IoT sensor data
$plot_id = "Livestock-1";
$temperature = 28.3;
$humidity = 62;
$soil_moisture = 40;

$sql = "INSERT INTO sensor_data (plot_id, temperature, humidity, soil_moisture)
        VALUES ('$plot_id', $temperature, $humidity, $soil_moisture)";

if (mysqli_query($conn, $sql)) {
    echo "✅ Sensor data inserted successfully!";
} else {
    echo "❌ Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>