<?php
include "db.php";

$result = mysqli_query($conn, "SELECT * FROM sensor_data ORDER BY timestamp DESC LIMIT 10");

echo "<h2>Latest Sensor Readings</h2>";

echo "<table border='1'>
<tr>
<th>ID</th>
<th>Plot</th>
<th>Temperature</th>
<th>Humidity</th>
<th>Soil Moisture</th>
<th>Time</th>
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
?>