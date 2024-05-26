<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventory System</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
</head>
<body>
  <!-- Header -->
  <?php include 'header.php'; ?>
    
  <!-- Sidebar Card -->
  <?php include 'sidebar.php'; ?>

  <!-- Page content -->
  <?php include 'contents.php'; ?>


  <script>

// Inventory Chart
var inventoryChart = new Chart(document.getElementById('inventoryChart').getContext('2d'), {
  type: 'bar',
  data: {
    labels: ['Donuts', 'Coffee', 'Pastries', 'Non-cofee'],
    datasets: [{
      label: 'Products Sold',
      data: [100, 150, 200, 60],
      backgroundColor: [
        'rgba(255, 99, 132, 0.5)',  // Red
        'rgba(54, 162, 235, 0.5)',  // Blue
        'rgba(255, 206, 86, 0.5)',  // Yellow
        'rgba(75, 192, 192, 0.5)'   // Green
      ],
      borderColor: [
        'rgba(255, 99, 132, 1)',    // Red
        'rgba(54, 162, 235, 1)',    // Blue
        'rgba(255, 206, 86, 1)',    // Yellow
        'rgba(75, 192, 192, 1)'     // Green
      ],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});


   // Stocks Chart
var stocksChart = new Chart(document.getElementById('stocksChart').getContext('2d'), {
  type: 'line',
  data: {
    labels: ['January', 'February', 'March', 'April', 'May'],
    datasets: [{
      label: 'Won Stocks',
      data: [100, 120, 90, 123, 140],
      backgroundColor: 'rgba(54, 162, 235, 0.2)', // Transparent gradient effect
      borderColor: 'rgba(54, 162, 235, 1)',
      borderWidth: 1,
      lineTension: 0.3 // Adjust the line tension for a smoother curve
    },
    {
      label: 'Lost Stocks',
      data: [80, 110, 78, 90, 110],
      backgroundColor: 'rgba(255, 99, 132, 0.2)', // Transparent gradient effect
      borderColor: 'rgba(255, 99, 132, 1)',
      borderWidth: 1,
      lineTension: 0.3 // Adjust the line tension for a smoother curve
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});


    
  </script>
</body>
</html>
