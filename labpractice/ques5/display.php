<?php
include "db.php";

$sql = "SELECT * FROM sensor_data ORDER BY timestamp DESC LIMIT 10";
$result = mysqli_query($conn, $sql);

echo "<h2>Latest Sensor Readings</h2>";

echo "<table border='1' cellpadding='8'>
<tr>
<th>ID</th>
<th>Plot</th>
<th>Temperature (°C)</th>
<th>Humidity (%)</th>
<th>Soil Moisture (%)</th>
<th>Timestamp</th>
</tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['plot_id']}</td>
    <td>{$row['temperature']}</td>
    <td>{$row['humidity']}</td>
    <td>{$row['soil_moisture']}</td>
    <td>{$row['timestamp']}</td>
    </tr>";
}

echo "</table>";

mysqli_close($conn);
?>
