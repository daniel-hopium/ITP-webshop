<!DOCTYPE html>
<html lang="en">
<head>
    <title>Finanzübersicht</title>

    <?php 
        include '../includes/head.php';
        if(!isset($_SESSION['username'])  || ($_SESSION['username'] != 'admin')) header('Location: home.php');
        require_once ('../../config/dbaccess.php');
    ?>
    
</head>
<body class="d-flex flex-column min-vh-100">

<div class = "container site-font-color text-center" >
  <h1 class="h1 mt-5">Finanzübersicht:</h1>
   

  <div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div>
		<canvas id="monthly-sales-chart" style="height: 400px; width: 100%;"></canvas>
	</div>

	<script>
		// Data for the chart
		const data = {
			labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
			datasets: [{
				label: 'Sales',
				data: [500, 700, 1000, 800, 1200, 1500, 1700, 1900, 1800, 1500, 1000, 700],
				backgroundColor: 'rgba(54, 162, 235, 0.5)',
				borderColor: 'rgb(54, 162, 235)',
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





<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {

var dps = []; // dataPoints
var chart = new CanvasJS.Chart("chartContainer", {
	title :{
		text: "Dynamic Data"
	},
	data: [{
		type: "line",
		dataPoints: dps
	}]
});

var xVal = 0;
var yVal = 100; 
var updateInterval = 1000;
var dataLength = 20; // number of dataPoints visible at any point

var updateChart = function (count) {

	count = count || 1;

	for (var j = 0; j < count; j++) {
		yVal = yVal +  Math.round(5 + Math.random() *(-5-5));
		dps.push({
			x: xVal,
			y: yVal
		});
		xVal++;
	}

	if (dps.length > dataLength) {
		dps.shift();
	}

	chart.render();
};

updateChart(dataLength);
setInterval(function(){updateChart()}, updateInterval);

}
</script>
</head>



</div>

<?php
 include '../includes/footer.php';
?>
    
</body>
</html>