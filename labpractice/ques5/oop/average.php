<?php
require_once "SmartFarm.php";

$farm = new SmartFarm();

$result = $farm->getAverageData();

echo "<h2>Average Sensor Data per Plot (OOP)</h2>";

echo "<table border='1'>
<tr>
<th>Plot</th>
<th>Avg Temperature</th>
<th>Avg Humidity</th>
<th>Avg Soil Moisture</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
    <td>{$row['plot_id']}</td>
    <td>{$row['avg_temp']}</td>
    <td>{$row['avg_humidity']}</td>
    <td>{$row['avg_soil']}</td>
    </tr>";
}

echo "</table>";
?>