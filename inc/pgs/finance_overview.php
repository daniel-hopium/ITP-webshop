<!DOCTYPE html>
<html lang="en">

<head>
  <title>Finanzübersicht</title>

  <?php
        include '../includes/head.php';
  if(!isset($_SESSION['username'])  || ($_SESSION['username'] != 'admin')) {
      header('Location: home.php');
  }
  require_once('../../config/dbaccess.php');
  ?>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="d-flex flex-column min-vh-100">

  <div class="container site-font-color text-center">
    <h1 class="h1 my-5">Finanzübersicht:</h1>




    <h1 class="h3 text-start">Monatliche Verkäufe</h1>
    <div>
      <canvas id="monthly-sales-chart" style="height: 400px; width: 100%;"></canvas>
    </div>

    <h1 class="h3 text-start mt-4">Täglich Verkäufe im Jänner</h1>
    <div>
      <canvas id="myChart2" style="height: 400px; width: 100%;"></canvas>
    </div>

    <script>
      // Data for the chart
      const data = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
          'November', 'December'
        ],
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


    <script>
      console.log("test");
      document.addEventListener('DOMContentLoaded', function() {
        // Your chart code goes here
        // Get a reference to the canvas element
        var ctx1 = document.getElementById('myChart2').getContext('2d');
        console.log(ctx1);
        // Define the dataset for the line chart
        var data = {
          labels: ['Jan 1', 'Jan 2', 'Jan 3', 'Jan 4', 'Jan 5', 'Jan 6', 'Jan 7', 'Jan 8', 'Jan 9', 'Jan 10',
            'Jan 11', 'Jan 12', 'Jan 13', 'Jan 14', 'Jan 15', 'Jan 16', 'Jan 17', 'Jan 18', 'Jan 19', 'Jan 20',
            'Jan 21', 'Jan 22', 'Jan 23', 'Jan 24', 'Jan 25', 'Jan 26', 'Jan 27', 'Jan 28', 'Jan 29', 'Jan 30',
            'Jan 31'
          ],
          datasets: [{
            label: 'Daily Sales',
            data: [200, 300, 500, 400, 600, 700, 900, 800, 1000, 1200, 1500, 1300, 1400, 1700, 2000, 1900,
              2200, 2500, 2300, 2400, 2600, 2800, 3000, 2800, 3200, 3500, 3400, 3600, 3800, 4000, 3800
            ],
            backgroundColor: 'rgb(54, 162, 235, 1)',
            borderColor: 'rgb(54, 162, 235, 1)',
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





    <h1 class="h3 text-start mt-4">Tägliche Verkäufe Jahresübersicht</h1>
    <div class="table-responsive p-0" id="table">

      <table class="table table-striped table-hover ">
        <thead>
          <tr>
            <th>Day</th>
            <th>January</th>
            <th>February</th>
            <th>March</th>
            <th>April</th>
            <th>May</th>
            <th>June</th>
            <th>July</th>
            <th>August</th>
            <th>September</th>
            <th>October</th>
            <th>November</th>
            <th>December</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>$100</td>
            <td>$110</td>
            <td>$120</td>
            <td>$130</td>
            <td>$140</td>
            <td>$150</td>
            <td>$160</td>
            <td>$170</td>
            <td>$180</td>
            <td>$190</td>
            <td>$200</td>
            <td>$210</td>
          </tr>
          <tr>
            <td>2</td>
            <td>$120</td>
            <td>$120</td>
            <td>$130</td>
            <td>$140</td>
            <td>$150</td>
            <td>$160</td>
            <td>$170</td>
            <td>$180</td>
            <td>$190</td>
            <td>$200</td>
            <td>$210</td>
            <td>$220</td>
          </tr>
          <tr>
            <td>3</td>
            <td>$130</td>
            <td>$130</td>
            <td>$130</td>
            <td>$140</td>
            <td>$150</td>
            <td>$160</td>
            <td>$170</td>
            <td>$180</td>
            <td>$190</td>
            <td>$200</td>
            <td>$210</td>
            <td>$220</td>
          </tr>
          <tr>
            <td>4</td>
            <td>$130</td>
            <td>$130</td>
            <td>$130</td>
            <td>$140</td>
            <td>$150</td>
            <td>$160</td>
            <td>$170</td>
            <td>$180</td>
            <td>$190</td>
            <td>$200</td>
            <td>$210</td>
            <td>$220</td>
          </tr>
          <tr>
            <td>5</td>
            <td>$130</td>
            <td>$130</td>
            <td>$130</td>
            <td>$140</td>
            <td>$150</td>
            <td>$160</td>
            <td>$170</td>
            <td>$180</td>
            <td>$190</td>
            <td>$200</td>
            <td>$210</td>
            <td>$220</td>
          </tr>
          <tr>
            <td>6</td>
            <td>$130</td>
            <td>$130</td>
            <td>$130</td>
            <td>$140</td>
            <td>$150</td>
            <td>$160</td>
            <td>$170</td>
            <td>$180</td>
            <td>$190</td>
            <td>$200</td>
            <td>$210</td>
            <td>$220</td>
          </tr>
          <tr>
            <td>7</td>
            <td>$130</td>
            <td>$130</td>
            <td>$130</td>
            <td>$140</td>
            <td>$150</td>
            <td>$160</td>
            <td>$170</td>
            <td>$180</td>
            <td>$190</td>
            <td>$200</td>
            <td>$210</td>
            <td>$220</td>
          </tr>
          <tr>
            <td>8</td>
            <td>$130</td>
            <td>$130</td>
            <td>$130</td>
            <td>$140</td>
            <td>$150</td>
            <td>$160</td>
            <td>$170</td>
            <td>$180</td>
            <td>$190</td>
            <td>$200</td>
            <td>$210</td>
            <td>$220</td>
          </tr>
          <tr>
            <td>9</td>
            <td>$130</td>
            <td>$130</td>
            <td>$130</td>
            <td>$140</td>
            <td>$150</td>
            <td>$160</td>
            <td>$170</td>
            <td>$180</td>
            <td>$190</td>
            <td>$200</td>
            <td>$210</td>
            <td>$220</td>
          </tr>
          <tr>
            <td>10</td>
            <td>$130</td>
            <td>$130</td>
            <td>$130</td>
            <td>$140</td>
            <td>$150</td>
            <td>$160</td>
            <td>$170</td>
            <td>$180</td>
            <td>$190</td>
            <td>$200</td>
            <td>$210</td>
            <td>$220</td>
          </tr>
          <tr>
            <td>11</td>
            <td>$130</td>
            <td>$130</td>
            <td>$130</td>
            <td>$140</td>
            <td>$150</td>
            <td>$160</td>
            <td>$170</td>
            <td>$180</td>
            <td>$190</td>
            <td>$200</td>
            <td>$210</td>
            <td>$220</td>
          </tr>
          <tr>
            <td>12</td>
            <td>$130</td>
            <td>$130</td>
            <td>$130</td>
            <td>$140</td>
            <td>$150</td>
            <td>$160</td>
            <td>$170</td>
            <td>$180</td>
            <td>$190</td>
            <td>$200</td>
            <td>$210</td>
            <td>$220</td>
          </tr>
          <tr>
            <td>13</td>
            <td>$130</td>
            <td>$130</td>
            <td>$130</td>
            <td>$140</td>
            <td>$150</td>
            <td>$160</td>
            <td>$170</td>
            <td>$180</td>
            <td>$190</td>
            <td>$200</td>
            <td>$210</td>
            <td>$220</td>
          </tr>
          <tr>
            <td>14</td>
            <td>$130</td>
            <td>$130</td>
            <td>$130</td>
            <td>$140</td>
            <td>$150</td>
            <td>$160</td>
            <td>$170</td>
            <td>$180</td>
            <td>$190</td>
            <td>$200</td>
            <td>$210</td>
            <td>$220</td>
          </tr>
          <tr>
            <td>15</td>
            <td>$130</td>
            <td>$130</td>
            <td>$130</td>
            <td>$140</td>
            <td>$150</td>
            <td>$160</td>
            <td>$170</td>
            <td>$180</td>
            <td>$190</td>
            <td>$200</td>
            <td>$210</td>
            <td>$220</td>
          </tr>
          <tr>
            <td>16</td>
            <td>$130</td>
            <td>$130</td>
            <td>$130</td>
            <td>$140</td>
            <td>$150</td>
            <td>$160</td>
            <td>$170</td>
            <td>$180</td>
            <td>$190</td>
            <td>$200</td>
            <td>$210</td>
            <td>$220</td>
          </tr>
          <tr>
            <td>17</td>
            <td>$130</td>
            <td>$130</td>
            <td>$130</td>
            <td>$140</td>
            <td>$150</td>
            <td>$160</td>
            <td>$170</td>
            <td>$180</td>
            <td>$190</td>
            <td>$200</td>
            <td>$210</td>
            <td>$220</td>
          </tr>
          <tr>
            <td>18</td>
            <td>$130</td>
            <td>$130</td>
            <td>$130</td>
            <td>$140</td>
            <td>$150</td>
            <td>$160</td>
            <td>$170</td>
            <td>$180</td>
            <td>$190</td>
            <td>$200</td>
            <td>$210</td>
            <td>$220</td>
          </tr>
          <tr>
            <td>19</td>
            <td>$130</td>
            <td>$130</td>
            <td>$130</td>
            <td>$140</td>
            <td>$150</td>
            <td>$160</td>
            <td>$170</td>
            <td>$180</td>
            <td>$190</td>
            <td>$200</td>
            <td>$210</td>
            <td>$220</td>
          </tr>
          <tr>
            <td>20</td>
            <td>$130</td>
            <td>$130</td>
            <td>$130</td>
            <td>$140</td>
            <td>$150</td>
            <td>$160</td>
            <td>$170</td>
            <td>$180</td>
            <td>$190</td>
            <td>$200</td>
            <td>$210</td>
            <td>$220</td>
          </tr>
          <tr>
            <td>21</td>
            <td>$130</td>
            <td>$130</td>
            <td>$130</td>
            <td>$140</td>
            <td>$150</td>
            <td>$160</td>
            <td>$170</td>
            <td>$180</td>
            <td>$190</td>
            <td>$200</td>
            <td>$210</td>
            <td>$220</td>
          </tr>

          <!-- add more rows for each day of the month -->
        </tbody>
      </table>

    </div>

  </div>

  <?php
 include '../includes/footer.php';
  ?>

</body>

</html>