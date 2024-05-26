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

// Initialize an empty array to store product data
$product_data = array();

// Fetch product data from the database
while ($row = mysqli_fetch_assoc($result)) {
    $product_data[] = array(
        'product_name' => $row['product_name'],
        'quantity' => $row['quantity']
    );
}

// Convert PHP array to JavaScript array
$product_data_json = json_encode($product_data);

// Close connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <title>Inventory Management System</title>
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
        width: 100%;
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
  <!-- Include Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
<header class="bg-dark sticky-header mb-4">
        <div class="container-fluid">

        </div>
      </header>
  <div class="container">
    <div class="sidebar">
    <?php include 'sidebar.php'; ?>
    </div>

    <div class="content col-lg-6">
      <div class="card1">

      <h2>Add New Product</h2>
      <br>
      <form action="add_product.php" method="POST">
        <!-- Form fields -->
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required>

        <label for="category">Category:</label>
        <select id="category" name="category" required style="width: calc(100% - 22px);">
          <option value="Donuts">Donuts</option>
          <option value="Coffee">Coffee</option>
          <option value="Pastries">Pastries</option>
          <option value="Pastries">Non-coffee</option>
        </select>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>

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
  <br>
  <div class="col-lg-10">
      <!-- Display Products Table -->
      <?php include 'display_products.php'; ?>
    </div>

    <script>
  // JavaScript code for creating a pie chart using Chart.js
  // Use the product data fetched from PHP to populate the chart
  var productData = <?php echo $product_data_json; ?>;

  // Extract product names and quantities from product data
  var productNames = productData.map(function(item) {
    return item.product_name;
  });
  var productQuantities = productData.map(function(item) {
    return item.quantity;
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
</script>
  </div>
</body>
</html>
