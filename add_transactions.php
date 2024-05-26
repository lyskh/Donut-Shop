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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $product_id = $_POST["product_id"];
    $transaction_type = $_POST["transaction_type"];
    $quantity_change = $_POST["quantity_change"];
    $transaction_date = date("Y-m-d H:i:s"); // Current date and time

    // Prepare SQL statement to insert data
    $sql = "INSERT INTO transactions (product_id, transaction_type, quantity_change, transaction_date) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters to the prepared statement
    $stmt->bind_param("issi", $product_id, $transaction_type, $quantity_change, $transaction_date);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Transaction inserted successfully
        echo "Transaction added successfully.";
    } else {
        // Error inserting transaction
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
