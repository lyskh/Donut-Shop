<?php
// Establish database connection
$servername = "127.0.0.1";
$username = "lux";
$password = "khera";
$database = "donut_db";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Query to select products
$query = "SELECT * FROM products";
$result = mysqli_query($connection, $query);

// Display products in a table
if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    echo "<table border='1'>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['product_id']}</td>
                <td>{$row['product_name']}</td>
                <td>{$row['category']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['price']}</td>
                <td class='actions'>
                    <a href='update_product.php?id={$row['product_id']}'><i class='fas fa-edit'></i></a>
                    <a href='delete_product.php?id={$row['product_id']}'><i class='fas fa-trash-alt'></i></a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$connection->close();
?>
