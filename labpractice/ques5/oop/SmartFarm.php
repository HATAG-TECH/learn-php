<?php
require_once "db.php";

class SmartFarm {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // 📥 Insert sensor data
    public function insertSensorData($plot, $temp, $hum, $soil) {
        $sql = "INSERT INTO sensor_data (plot_id, temperature, humidity, soil_moisture)
                VALUES ('$plot', $temp, $hum, $soil)";

        if ($this->conn->query($sql)) {
            return "Sensor data inserted successfully!";
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    // 📊 Get latest 10 readings
    public function getLatestData() {
        $sql = "SELECT * FROM sensor_data ORDER BY timestamp DESC LIMIT 10";
        return $this->conn->query($sql);
    }

    // 📈 Get averages per plot
    public function getAverageData() {
        $sql = "SELECT 
                    plot_id,
                    AVG(temperature) AS avg_temp,
                    AVG(humidity) AS avg_humidity,
                    AVG(soil_moisture) AS avg_soil
                FROM sensor_data
                GROUP BY plot_id";

        return $this->conn->query($sql);
    }

    public function __destruct() {
        $this->conn->close();
    }
}
?>