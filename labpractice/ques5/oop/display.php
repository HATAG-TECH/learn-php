<?php
require_once "SmartFarm.php";

$farm = new SmartFarm();

$result = $farm->getLatestData();

echo "<h2>Latest Sensor Readings (OOP)</h2>";

echo "<table border='1'>
<tr>
<th>ID</th>
<th>Plot</th>
<th>Temperature</th>
<th>Humidity</th>
<th>Soil Moisture</th>
<th>Timestamp</th>
</tr>";

while ($row = $result->fetch_assoc()) {
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