<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Financial Overview</title>

  <?php
  include '../includes/head.php';
  if(($role != 'administrator')) {
    header('Location: home.php');
    exit();
  }
  
  require_once('../../config/dbaccess.php');
  ?>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>


<?php 
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection to the database failed: " . $conn->connect_error);
}

// Retrieve monthly sales of the last 12 months
$monthlySalesQuery = "SELECT DATE_FORMAT(order_date, '%Y-%m') AS month, SUM(total_price) AS total_sales
                     FROM new_orders
                     WHERE order_date >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)
                     GROUP BY DATE_FORMAT(order_date, '%Y-%m')";

$monthlySalesResult = $conn->query($monthlySalesQuery);
$monthlySalesData = array();

while ($row = $monthlySalesResult->fetch_assoc()) {
    $month = date('F', strtotime($row['month'])); // Convert month number to month name
    $monthlySalesData['labels'][] = $month;
    $monthlySalesData['datasets'][0]['data'][] = $row['total_sales'];
}

// Retrieve daily sales of the last 30 days
$dailySalesQuery = "SELECT DATE(order_date) AS day, SUM(total_price) AS total_sales
                   FROM new_orders
                   WHERE order_date >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
                   GROUP BY DATE(order_date)";

$dailySalesResult = $conn->query($dailySalesQuery);
$dailySalesData = array();

while ($row = $dailySalesResult->fetch_assoc()) {
    $day = date('F j', strtotime($row['day'])); // Convert date to month name and day
    $dailySalesData['labels'][] = $day;
    $dailySalesData['datasets'][0]['data'][] = $row['total_sales'];
}

// Retrieve daily sales of the last 365 days
$dailySalesQueryYear = "SELECT DATE(order_date) AS day, SUM(total_price) AS total_sales
                       FROM new_orders
                       WHERE order_date >= DATE_SUB(CURDATE(), INTERVAL 365 DAY)
                       GROUP BY DATE(order_date)
                       ORDER BY DATE(order_date)";

$dailySalesResultYear = $conn->query($dailySalesQueryYear);
$dailySalesDataYear = array();
$cumulativeSum = 0;

while ($row = $dailySalesResultYear->fetch_assoc()) {
    $day = date('F j', strtotime($row['day'])); // Convert date to month name and day
    $cumulativeSum += $row['total_sales'];
    $dailySalesDataYear['labels'][] = $day;
    $dailySalesDataYear['datasets'][0]['data'][] = $cumulativeSum;
}
?>



<body class="d-flex flex-column min-vh-100">

  <div class="container site-font-color text-center">
    <h1 class="h1 my-5 primary-color">Complete Financial Overview:</h1>




    <h1 class="h3 text-start primary-color">Monthly Sales of the Last 12 Months</h1>
    <div>
      <canvas id="monthly-sales-chart" style="height: 400px; width: 100%;"></canvas>
    </div>

    <h1 class="h3 text-start mt-4 primary-color">Daily Sales of the Last 30 Days</h1>
    <div>
      <canvas id="myChart2" style="height: 400px; width: 100%;"></canvas>
    </div>

    <h1 class="h3 text-start mt-4 primary-color">Cumulative Sales of the Last 365 Days</h1>
    <div>
      <canvas id="myChart3" style="height: 400px; width: 100%;"></canvas>
    </div>

    <script>
      // Data for the chart
      const data = {
        labels: <?= json_encode($monthlySalesData['labels']) ?>,
        datasets: [{
          label: 'Monthly Sales',
          data: <?= json_encode($monthlySalesData['datasets'][0]['data']) ?>,
          backgroundColor: '#0d3359b5',
          borderColor: '#0d3359',
          borderWidth: 1
        }]
      };

      // Configuration options for the chart
      const options = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      };

      // Create a new bar chart
      const ctx = document.getElementById('monthly-sales-chart').getContext('2d');
      const chart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: options
      });
    </script>


    <script>
      
      document.addEventListener('DOMContentLoaded', function() {
        // Your chart code goes here
        // Get a reference to the canvas element
        var ctx1 = document.getElementById('myChart2').getContext('2d');
        console.log(ctx1);
        // Define the dataset for the line chart
        var data = {
          labels: <?= json_encode($dailySalesData['labels']) ?>,
          datasets: [{
            label: 'Daily Sales',
            data: <?= json_encode($dailySalesData['datasets'][0]['data']) ?>,
            backgroundColor: '#0d3359b5',
            borderColor: '#0d3359',
            borderWidth: 1
          }]
        };

        // Define the options for the line chart
        var options = {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        };

        // Create a new line chart instance
        var myChart2 = new Chart(ctx1, {
          type: 'line',
          data: data,
          options: options
        });
      });
    </script>

<script>
      
      document.addEventListener('DOMContentLoaded', function() {
        // Your chart code goes here
        // Get a reference to the canvas element
        var ctx1 = document.getElementById('myChart3').getContext('2d');
        console.log(ctx1);
        // Define the dataset for the line chart
        var data = {
          labels: <?= json_encode($dailySalesDataYear['labels']) ?>,
          datasets: [{
            label: 'Daily Sales',
            data: <?= json_encode($dailySalesDataYear['datasets'][0]['data']) ?>,
            backgroundColor: '#0d3359b5',
            borderColor: '#0d3359',
            borderWidth: 1
          }]
        };

        // Define the options for the line chart
        var options = {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        };

        // Create a new line chart instance
        var myChart2 = new Chart(ctx1, {
          type: 'line',
          data: data,
          options: options
        });
      });
    </script>

<?php
// Retrieve $dailySalesDataYear from the database or wherever it is stored

// Prepare the data
$labels = array_keys($dailySalesDataYear);
$datasets = [];

// Iterate over each month
foreach ($dailySalesDataYear as $monthData) {
    $salesData = [];

    // Iterate over each day
    foreach ($labels as $day) {
        $sales = $monthData[$day] ?? 0;
        $salesData[] = $sales;
    }

    // Create a dataset array
    $dataset = [
        'label' => reset($monthData), // Use the month name as the label
        'data' => $salesData,
        'fill' => false
    ];

    $datasets[] = $dataset;
}
?>
  </div>

  <?php
 include '../includes/footer.php';
  ?>

</body>

</html>
