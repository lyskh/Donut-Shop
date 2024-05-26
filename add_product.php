<?php
// Include database connection code
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $product_name = $_POST["product_name"];
    $category = $_POST["category"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];

    // SQL query to insert data into the database
    $sql = "INSERT INTO products (product_name, category, quantity, price) VALUES ('$product_name', '$category', $quantity, $price)";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Reload the page to display the newly added product
        echo "<meta http-equiv='refresh' content='0'>"; // This will reload the page after 0 seconds
        header("Location: inventory.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>
