<?php
require "config.php";

function addColumnIfMissing($conn, $table, $column, $definition) {
    $check_sql = "SELECT 1 FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ? AND COLUMN_NAME = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ss", $table, $column);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows === 0) {
        $alter_sql = "ALTER TABLE {$table} ADD COLUMN {$column} {$definition}";
        if ($conn->query($alter_sql) !== TRUE) {
            throw new Exception("Error adding column '{$column}': " . $conn->error);
        }
    }
}

// SQL to create the users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'user',
    verified TINYINT(1) DEFAULT 0,
    verified_at DATETIME NULL,
    verification_token VARCHAR(255) NULL,
    verification_expires DATETIME NULL,
    reset_token VARCHAR(255) NULL,
    reset_expires DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

try {
    if ($conn->query($sql) !== TRUE) {
        throw new Exception("Error creating table: " . $conn->error);
    }

    addColumnIfMissing($conn, "users", "verified_at", "DATETIME NULL");
    addColumnIfMissing($conn, "users", "verification_token", "VARCHAR(255) NULL");
    addColumnIfMissing($conn, "users", "verification_expires", "DATETIME NULL");

    echo "Table 'users' is ready for email verification.";
} catch (Exception $e) {
    echo $e->getMessage();
}

$conn->close();
?>