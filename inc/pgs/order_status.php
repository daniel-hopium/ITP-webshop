<?php
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

<!DOCTYPE html>
<html lang="en">

<head>
<?php
        include '../includes/head.php'; ?>
        
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestellübersicht</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/es6-promise/4.2.8/es6-promise.auto.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-control-geocoder/1.13.1/Control.Geocoder.js"></script>


    <!-- Einbinden von Leaflet CSS und JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>



    <!-- Wichtig!!! PROGRESS BAR -->
    <style>
        .progress-bar {
            transition: width 2s;
        }

        .progress-bar.animated {
            animation: progress-bar-stripes 2s linear infinite;
        }

        #map {
            height: 400px;
            width: 100%;
        }
    </style>

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
                                if ($row["status"] == "shipped" || $row["status"] == "delivered") {
                                    echo "<button id='mapButton-{$row["id"]}' class='btn btn-success mb-1'>Auf Karte anzeigen</button>";
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


                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mapModalLabel">Karte anzeigen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>

</body>
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
    let map;
    let geocoder = L.Control.Geocoder.nominatim();

    $("button[id^='mapButton']").click(function() {
        $('#mapModal').modal('show');
    });

    $('#mapModal').on('shown.bs.modal', function() {
        var mapHeight = $('#mapModal .modal-body').height();

        if (map != undefined) {
            map.remove();
        }

        map = L.map('map').setView([48.2082, 16.3738], 13);

        $('#map').height(mapHeight);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);
        map.invalidateSize();

        // Punkt A
        var addressA = "Höchstädtpl. 6, 1200 Wien";
        geocoder.geocode(addressA, function(results) {
            var latLng = results[0].center;
            var markerA = L.marker(latLng).addTo(map);
            markerA.bindPopup('Punkt A: ' + addressA).openPopup();
        });

        // Punkt B
        var addressB = "Siccardsburggasse 27, 1100 Wien";
        geocoder.geocode(addressB, function(results) {
            var latLng = results[0].center;
            var markerB = L.marker(latLng).addTo(map);
            markerB.bindPopup('Punkt B: ' + addressB).openPopup();
        });
    });
</script>

<?php
include '../includes/footer.php';
?>


</html>