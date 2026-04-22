<?php
// Question 5: Smart Agriculture IoT (DBU research centers)

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Update these if your MySQL setup is different.
$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "smart_agri";

$message = "";
$error = "";

function h(string $v): string {
    return htmlspecialchars($v, ENT_QUOTES, "UTF-8");
}

try {
    $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS);
    $conn->set_charset("utf8mb4");

    // Create database (if not exists), then select it.
    $conn->query("CREATE DATABASE IF NOT EXISTS `$DB_NAME` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $conn->select_db($DB_NAME);

    // Table to store sensor readings.
    $createTableSql = <<<SQL
CREATE TABLE IF NOT EXISTS sensor_readings (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  center VARCHAR(32) NOT NULL,
  plot VARCHAR(64) NOT NULL,
  soil_moisture DECIMAL(8,2) NOT NULL,
  temperature DECIMAL(8,2) NOT NULL,
  humidity DECIMAL(8,2) NOT NULL,
  recorded_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  INDEX idx_plot_time (plot, recorded_at),
  INDEX idx_center_time (center, recorded_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
SQL;
    $conn->query($createTableSql);

    // Insert new reading from a simple HTML form.
    if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["action"] ?? "") === "insert") {
        $center = trim((string)($_POST["center"] ?? ""));
        $plot = trim((string)($_POST["plot"] ?? ""));
        $soilMoisture = (float)($_POST["soil_moisture"] ?? 0);
        $temperature = (float)($_POST["temperature"] ?? 0);
        $humidity = (float)($_POST["humidity"] ?? 0);

        $allowedCenters = ["Livestock", "Soil", "Shewarobit", "Ankober"];
        if (!in_array($center, $allowedCenters, true)) {
            throw new RuntimeException("Invalid center selected.");
        }
        if ($plot === "") {
            throw new RuntimeException("Plot is required.");
        }

        $stmt = $conn->prepare(
            "INSERT INTO sensor_readings (center, plot, soil_moisture, temperature, humidity) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("ssddd", $center, $plot, $soilMoisture, $temperature, $humidity);
        $stmt->execute();
        $stmt->close();

        $message = "New sensor reading inserted successfully.";
    }

    // Latest 10 readings
    $latestRows = [];
    $res = $conn->query(
        "SELECT id, center, plot, soil_moisture, temperature, humidity, recorded_at
         FROM sensor_readings
         ORDER BY recorded_at DESC, id DESC
         LIMIT 10"
    );
    $latestRows = $res->fetch_all(MYSQLI_ASSOC);
    $res->free();

    // Averages per plot
    $avgRows = [];
    $res2 = $conn->query(
        "SELECT plot,
                ROUND(AVG(temperature), 2) AS avg_temperature,
                ROUND(AVG(humidity), 2) AS avg_humidity,
                ROUND(AVG(soil_moisture), 2) AS avg_soil_moisture,
                COUNT(*) AS total_readings
         FROM sensor_readings
         GROUP BY plot
         ORDER BY plot ASC"
    );
    $avgRows = $res2->fetch_all(MYSQLI_ASSOC);
    $res2->free();
} catch (Throwable $e) {
    $error = $e->getMessage();
} finally {
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question Five - Smart Agriculture IoT</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .wrap { max-width: 980px; margin: 0 auto; }
        .card { border: 1px solid #ddd; border-radius: 8px; padding: 16px; margin-bottom: 16px; }
        .row { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; }
        label { display: block; font-weight: 600; margin-bottom: 6px; }
        input, select { width: 100%; padding: 8px; border: 1px solid #bbb; border-radius: 6px; }
        button { padding: 10px 14px; border: 0; border-radius: 6px; background: #0b5ed7; color: #fff; cursor: pointer; }
        button:hover { background: #094db1; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f7f7f7; }
        .msg { padding: 10px; border-radius: 6px; margin-bottom: 12px; }
        .ok { background: #e8f5e9; border: 1px solid #c8e6c9; }
        .err { background: #ffebee; border: 1px solid #ffcdd2; }
        code { background: #f4f4f4; padding: 2px 6px; border-radius: 4px; }
        @media (max-width: 700px) { .row { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
<div class="wrap">
    <div class="card">
        <h2>DBU Smart Agriculture IoT (Sensor Readings)</h2>
        <p>
            This page creates a MySQL database <code><?php echo h($DB_NAME); ?></code> and a table
            <code>sensor_readings</code>, inserts new readings, displays the latest 10 readings, and shows averages per plot.
        </p>
    </div>

    <?php if ($message !== ""): ?>
        <div class="msg ok"><?php echo h($message); ?></div>
    <?php endif; ?>
    <?php if ($error !== ""): ?>
        <div class="msg err"><?php echo h($error); ?></div>
    <?php endif; ?>

    <div class="card">
        <h3>Insert New Sensor Reading</h3>
        <form method="post" action="">
            <input type="hidden" name="action" value="insert">
            <div class="row">
                <div>
                    <label for="center">Research Center</label>
                    <select id="center" name="center" required>
                        <option value="Livestock">Livestock</option>
                        <option value="Soil">Soil</option>
                        <option value="Shewarobit">Shewarobit</option>
                        <option value="Ankober">Ankober</option>
                    </select>
                </div>
                <div>
                    <label for="plot">Plot (e.g., Plot-1, Plot-A)</label>
                    <input id="plot" name="plot" type="text" required>
                </div>
                <div>
                    <label for="soil_moisture">Soil Moisture (%)</label>
                    <input id="soil_moisture" name="soil_moisture" type="number" step="0.01" required>
                </div>
                <div>
                    <label for="temperature">Temperature (°C)</label>
                    <input id="temperature" name="temperature" type="number" step="0.01" required>
                </div>
                <div>
                    <label for="humidity">Humidity (%)</label>
                    <input id="humidity" name="humidity" type="number" step="0.01" required>
                </div>
            </div>
            <div style="margin-top: 12px;">
                <button type="submit">Insert Reading</button>
            </div>
        </form>
    </div>

    <div class="card">
        <h3>Latest 10 Readings</h3>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Center</th>
                <th>Plot</th>
                <th>Soil Moisture</th>
                <th>Temperature</th>
                <th>Humidity</th>
                <th>Recorded At</th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($latestRows)): ?>
                <tr><td colspan="7">No readings yet. Insert one above.</td></tr>
            <?php else: ?>
                <?php foreach ($latestRows as $r): ?>
                    <tr>
                        <td><?php echo h((string)$r["id"]); ?></td>
                        <td><?php echo h((string)$r["center"]); ?></td>
                        <td><?php echo h((string)$r["plot"]); ?></td>
                        <td><?php echo h((string)$r["soil_moisture"]); ?></td>
                        <td><?php echo h((string)$r["temperature"]); ?></td>
                        <td><?php echo h((string)$r["humidity"]); ?></td>
                        <td><?php echo h((string)$r["recorded_at"]); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="card">
        <h3>Average Temperature, Humidity, and Soil Moisture (Per Plot)</h3>
        <table>
            <thead>
            <tr>
                <th>Plot</th>
                <th>Avg Temperature (°C)</th>
                <th>Avg Humidity (%)</th>
                <th>Avg Soil Moisture (%)</th>
                <th>Total Readings</th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($avgRows)): ?>
                <tr><td colspan="5">No readings yet.</td></tr>
            <?php else: ?>
                <?php foreach ($avgRows as $a): ?>
                    <tr>
                        <td><?php echo h((string)$a["plot"]); ?></td>
                        <td><?php echo h((string)$a["avg_temperature"]); ?></td>
                        <td><?php echo h((string)$a["avg_humidity"]); ?></td>
                        <td><?php echo h((string)$a["avg_soil_moisture"]); ?></td>
                        <td><?php echo h((string)$a["total_readings"]); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="card">
        <h3>SQL Used (Table Creation)</h3>
        <pre style="white-space: pre-wrap; margin: 0;"><?php echo h($createTableSql ?? ""); ?></pre>
    </div>
</div>
</body>
</html>

