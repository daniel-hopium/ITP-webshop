<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestellübersicht</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Wichtig!!! PROGRESS BAR -->
    <style>
        .progress-bar {
            transition: width 2s;
        }

        .progress-bar.animated {
            animation: progress-bar-stripes 2s linear infinite;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <?php
    include '../includes/head.php';
    ?>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h2>Bestellübersicht</h2>
                <button id="statusButton" class="btn btn-primary mb-3">Sim. starten</button>
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>Bestellnummer</th>
                            <th>Produkt</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once('../../config/dbaccess.php');

                        // Create connection
                        $conn = new mysqli($host, $user, $password, $database);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Select order status and product name from the database
                        $sql = "SELECT new_orders.id, products.name, products.price, new_orders.status FROM new_orders INNER JOIN products ON new_orders.product_id = products.id";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr data-id='{$row["id"]}' data-toggle='collapse' data-target='#collapse-{$row["id"]}' class='accordion-toggle'>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["name"] . "</td>";
                                echo "<td><span class='badge badge-" . getBadgeColor($row["status"]) . "'>" . $row["status"] . "</span></td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<td colspan='6' class='hiddenRow'>";
                                echo "<div class='accordian-body collapse' id='collapse-{$row["id"]}'>";

                                // additional information
                                echo "<p>Produkt: " . $row["name"] . "</p>";
                                echo "<p>Preis: " . $row["price"] . "</p>";
                                echo "<p>Status: " . $row["status"] . "</p>";
                                if ($row["status"] == "pending" || $row["status"] == "processing") {
                                    echo "<button id='cancelButton-{$row["id"]}' class='btn btn-danger mb-1'>Bestellung Stornieren</button>";
                                }
                                // progress bar
                                echo "<div class='progress'>";
                                echo "<div id='progress-{$row["id"]}' class='progress-bar progress-bar-striped progress-bar-animated bg-" . getProgressBarColor($row["status"]) . "' role='progressbar' style='width: " . getStatusPercentage($row["status"]) . "%' aria-valuenow='" . getStatusPercentage($row["status"]) . "' aria-valuemin='0' aria-valuemax='100'></div>";
                                echo "</div>";

                                echo "</div>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "0 results";
                        }

                        $conn->close();

                        function getBadgeColor($status)
                        {
                            switch ($status) {
                                case "pending":
                                    return "primary";
                                case "processing":
                                    return "warning";
                                case "shipped":
                                    return "info";
                                case "delivered":
                                    return "success";
                                case "cancelled":
                                    return "danger";
                                default:
                                    return "secondary";
                            }
                        }

                        function getStatusPercentage($status)
                        {
                            switch ($status) {
                                case "pending":
                                    return 25;
                                case "processing":
                                    return 50;
                                case "shipped":
                                    return 75;
                                case "delivered":
                                    return 100;
                                case "cancelled":
                                    return 100;
                                default:
                                    return 0;
                            }
                        }

                        function getProgressBarColor($status)
                        {
                            switch ($status) {
                                case "pending":
                                    return "primary";
                                case "processing":
                                    return "warning";
                                case "shipped":
                                    return "info";
                                case "delivered":
                                    return "success";
                                case "cancelled":
                                    return "danger";
                                default:
                                    return "secondary";
                            }
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const statuses = ["pending", "processing", "shipped", "delivered", "cancelled"];
        let currentStatus = 0;

        let selectedOrderId = null;

        $("table tr").click(function() {
            selectedOrderId = $(this).data("id");
            console.log(selectedOrderId);
        });

        $("button[id^='cancelButton']").click(function() {
            var id = $(this).attr('id').split('-')[1];
            $.ajax({
                url: 'update_status.php',
                type: 'POST',
                data: {
                    id: id,
                    status: "cancelled"
                },
                success: function(response) {
                    console.log(`Order cancellation: ${response}`);
                    location.reload();
                }
            });
        });


        document.getElementById("statusButton").addEventListener("click", () => {
            if (selectedOrderId !== null) {
                setInterval(updateStatus, 10000);
            } else {
                alert("Please select an order first.");
            }
        });

        function updateStatus() {
            $.ajax({
                url: 'update_status.php',
                type: 'POST',
                data: {
                    id: selectedOrderId,
                    status: statuses[currentStatus]
                },
                success: function(response) {
                    console.log(`Status update: ${response}`);
                    currentStatus++;
                    if (currentStatus >= statuses.length) {
                        currentStatus = 0;
                    }
                }
            });
        }
    </script>

    <?php
    include '../includes/footer.php';
    ?>
</body>

</html>