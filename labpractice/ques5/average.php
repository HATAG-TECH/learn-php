<?php
include "db.php";

$sql = "SELECT 
            plot_id,
            AVG(temperature) AS avg_temp,
            AVG(humidity) AS avg_humidity,
            AVG(soil_moisture) AS avg_soil
        FROM sensor_data
        GROUP BY plot_id";

$result = mysqli_query($conn, $sql);

echo "<h2>Average Sensor Data per Plot</h2>";

echo "<table border='1' cellpadding='8'>
<tr>
<th>Plot</th>
<th>Avg Temperature (°C)</th>
<th>Avg Humidity (%)</th>
<th>Avg Soil Moisture (%)</th>
</tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
    <td>{$row['plot_id']}</td>
    <td>{$row['avg_temp']}</td>
    <td>{$row['avg_humidity']}</td>
    <td>{$row['avg_soil']}</td>
    </tr>";
}

echo "</table>";

mysqli_close($conn);
?>
