<?php
include 'db_connection.php';

// Check if product ID is provided
if (!isset($_GET['id'])) {
  header("Location: display_products.php");
  exit();
}

// Get the product ID from the URL
$product_id = $_GET['id'];

// Retrieve the product information from the database
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = mysqli_query($connection, $sql);

// Check if the product exists
if (mysqli_num_rows($result) != 1) {
  header("Location: display_products.php");
  exit();
}

// Fetch product data
$row = mysqli_fetch_assoc($result);

// Close the database connection
$connection->close();
?>
