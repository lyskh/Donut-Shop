<?php
// Establish database connection
$servername = "127.0.0.1"; // Change this to your MySQL server hostname
$username = "lux"; // Change this to your MySQL username
$password = "khera"; // Change this to your MySQL password
$database = "donut_db"; // Change this to your MySQL database name

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Query to select the sum of quantity changes for each product
$query = "SELECT product_id, SUM(quantity_change) AS total_quantity FROM transactions GROUP BY product_id";
$result = mysqli_query($connection, $query);



// Debugging: Display the SQL query result
if (!$result) {
    echo "Error: " . $query . "<br>" . mysqli_error($connection);
} else {
    echo "SQL Query executed successfully. <br>";
}


// Initialize an empty array to store product data
$product_data = array();

// Fetch product data from the database
while ($row = mysqli_fetch_assoc($result)) {
    echo "Product ID: " . $row['product_id'] . ", Total Quantity: " . $row['total_quantity'] . "<br>";
    // Push each row to the product_data array
    $product_data[] = $row;
}

// Convert PHP array to JSON format
$product_data_json = json_encode($product_data);
echo "Product Data JSON: " . $product_data_json . "<br>";

// Convert PHP array to JSON format
$product_data_json = json_encode($product_data);
echo "Product Data JSON: " . $product_data_json . "<br>";

// Convert PHP array to JSON format
$product_data_json = json_encode($product_data);
echo "Product Data JSON: " . $product_data_json . "<br>";


// Close connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title>Transactions</title>
  <style>
     body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #fff;
      }
  
      h2 {
        margin-bottom: 20px;
      }
  
      .container {
        display: flex;
        
      }
  
      .sidebar {
        width: 200px;
        margin-right: 100px;
      }
  
      .content {
        flex-grow: 1;
      }
      .card1 {
        background: linear-gradient(to bottom, ##ECF0F1 );
        border: 1px solid #ccc;
        width: 580px;
        height: 550px;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        margin-left: 38px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        }
      form {
        background-color: #fff;
        width: 500px;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
      }
  
      form label {
        display: block;
        margin-bottom: 5px;
      }
  
      form input[type="text"],
      form input[type="number"],
      form select {
        width: calc(100% - 22px); /* Adjust for input padding and border */
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
      }
  
      form input[type="submit"] {
        background-color: #343a40;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
      }
  
      form input[type="submit"]:hover {
        background-color: #0056b3;
      }
  
      table {
        width: 83%;
        border-collapse: collapse;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: 1px solid #ddd; /* Table border */
        margin-left: 225px;
      }

      table th,
      table td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        border: 1px solid #ddd; /* Cell border */
        text-align: center;
      }

      table th {
        background-color: #343a40;
        color: #fff;
        border: none; /* Black border color for header */
      }

      table tr:nth-child(even) {
        background-color: #f2f2f2;
      }

      .actions {
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .actions a {
        margin: 0 5px; /* Adjust spacing between icons */
        color: #343a40;
        text-decoration: none;
      }

      .actions a:hover {
        color: #0056b3;
      }

      #pieChart {
        max-width: 500px;
        max-height: 450px;
        margin: 1 1; /* Center the pie chart */
      }
  </style>
</head>
<body>
<div class="container">
    <div class="sidebar">
    <?php include 'sidebar.php'; ?>
    </div>

    <div class="content col-lg-6">
      <div class="card1">

      <h2>Add Transaction</h2>
      <br>
      <form action="add_transactions.php" method="POST">
    <!-- Form fields -->
    <label for="product_id">Product ID:</label>
    <input type="text" id="product_id" name="product_id" required>

    <label for="transaction_type">Transaction Type:</label>
    <select id="transaction_type" name="transaction_type" required style="width: calc(100% - 22px);">
        <option value="In">Sales</option>
        <option value="Out">Purchase</option>
        <option value="Back">Return</option>
        <option value="Set">Adjustments</option>
    </select>

    <label for="quantity_change">Quantity Change:</label>
    <input type="number" id="quantity_change" name="quantity_change" required>

    <label for="transaction_date">Transaction Date:</label>
    <input type="date" id="transaction_date" name="transaction_date" required>

    <input type="submit" value="Add">
</form>
    </div>
    </div>
      <div class="col-lg-6">
      <div class="card1">
        <h2>Pie Chart</h2>
        <canvas id="pieChart" width="400" height="400"></canvas>
      </div>
    </div>

  </div>

  <h2>Transactions</h2>

  <table>
  <tr>
    <th>Transaction ID</th>
    <th>Product ID</th>
    <th>Transaction Type</th>
    <th>Quantity Change</th>
    <th>Transaction Date</th>
    <th>Total Quantity</th>
  </tr>
  
  <?php
  // Check if there are rows in the result set
  if (count($product_data) > 0) {
    // Output data of each row
    foreach ($product_data as $row) {
        echo "<tr>";
        echo "<td>" . $row["product_id"] . "</td>";
        echo "<td>" . $row["total_quantity"] . "</td>";
        echo "</tr>";
    } // This brace should be closed here

    // Moved this part outside the previous loop
    if (mysqli_num_rows($result) > 0) {
      // Output data of each row
      while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row["transaction_id"] . "</td>";
          echo "<td>" . $row["product_id"] . "</td>";
          echo "<td>" . $row["transaction_type"] . "</td>";
          echo "<td>" . $row["quantity_change"] . "</td>";
          echo "<td>" . $row["transaction_date"] . "</td>";
          echo "<td>" . $row["total_quantity"] . "</td>"; // Added total quantity here
          echo "</tr>";
      }
    } else {
      echo "<tr><td colspan='6'>0 results</td></tr>"; // Changed colspan to 6 to match the number of columns
    }
  } else {
      echo "<tr><td colspan='6'>0 results</td></tr>"; // Changed colspan to 6 to match the number of columns
  }
  ?>
</table>


<script>
    // Use the product data fetched from PHP to populate the chart
    var productData = <?php echo $product_data_json; ?>;
    
    if (productData.length > 0) {
        // Extract product names and quantities from product data
        var productNames = productData.map(function(item) {
            return item.product_id;
        });
        var productQuantities = productData.map(function(item) {
            return item.total_quantity;
        });

        // Create the data object for the pie chart
        var data = {
            labels: productNames,
            datasets: [{
                data: productQuantities,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'] // You can customize colors here
            }]
        };

        // Get the canvas element
        var ctx = document.getElementById('pieChart').getContext('2d');

        // Create the pie chart
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: data
        });
    }
</script>


</body>
</html>
