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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Collect form data
  $product_id = $_POST["product_id"];
  $product_name = $_POST["product_name"];
  $category = $_POST["category"];
  $quantity = $_POST["quantity"];
  $price = $_POST["price"];

  // SQL query to update the product information
  $sql = "UPDATE products SET product_name = '$product_name', category = '$category', quantity = $quantity, price = $price WHERE id = $product_id";

  // Execute the query
  if ($connection->query($sql) === TRUE) {
    echo "Product updated successfully";
    // Redirect back to the product listing page
    header("Location: display_products.php");
    exit();
  } else {
    echo "Error updating product: " . $connection->error;
  }
}

// Close database connection
$connection->close();
?>
