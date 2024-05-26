<?php
// Database connection parameters
$db_host = "127.0.0.1"; // Change this to your database host
$db_username = "lux"; // Change this to your database username
$db_password = "khera"; // Change this to your database password
$db_name = "donut_db"; // Change this to your database name

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
