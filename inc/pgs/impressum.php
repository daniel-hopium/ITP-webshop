<!DOCTYPE html>
<html lang="en">

<head>
  <title>Impressum</title>

  <?php
  include '../includes/head.php';
  ?>
</head>

<body class="d-flex flex-column min-vh-100">
  <div class="container site-font-color">
    <div class="row">
      <div class="col-lg-8">
        <div class="card card-bg shadow-2-strong card-registration mt-3 p-2 flex-column" style="border-radius: 15px;">
          <div>
            <h1 class="ms-3 my-3">Imprint</h1>
          </div>

          <ul class="list-group list-group-flush">
            <li class="list-group-item bg-transparent site-font-color">
              <h6><b>Webshop</b></h6>
            </li>
            <li class="list-group-item bg-transparent site-font-color">Limited Liability Company</li>
            <li class="list-group-item bg-transparent site-font-color">Mariahilferstrasse 212, 1140 Vienna</li>
            <li class="list-group-item bg-transparent site-font-color">Tel: +43 1 345 67 89</li>
            <li class="list-group-item bg-transparent site-font-color">Fax: +41 1 345 67 89 99</li>
            <li class="list-group-item bg-transparent site-font-color"><a class="site-font-color" href="mailto:info@nfa-shop.at">info@nfa-shop.at</a></li>
            <li class="list-group-item bg-transparent site-font-color"></li>
          </ul>
          <ul class="list-group list-group-flush">
            <li class="list-group-item bg-transparent site-font-color"></li>
            <li class="list-group-item bg-transparent site-font-color">VAT No: ATU12345678</li>
            <li class="list-group-item bg-transparent site-font-color">FN: 123456a</li>
            <li class="list-group-item bg-transparent site-font-color">Commercial Court: Vienna</li>
            <li class="list-group-item bg-transparent site-font-color">Member of ÖHV and WKO</li>
            <li class="list-group-item bg-transparent site-font-color"></li>
          </ul>
          <ul class="list-group list-group-flush">
            <li class="list-group-item bg-transparent site-font-color"></li>
            <li class="list-group-item bg-transparent ms-0 site-font-color">
              <h6>Professional Law:</h6>
            </li>
            <li class="list-group-item bg-transparent site-font-color">Trade Regulation: <a class="site-font-color" href="www.ris.bka.gv.at">www.ris.bka.gv.at</a></li>
            <li class="list-group-item bg-transparent site-font-color">District Administration Vienna</li>
            <li class="list-group-item bg-transparent site-font-color">Consumers have the opportunity to submit complaints to the EU's online dispute resolution platform: <a class="site-font-color" href="http://ec.europa.eu/odr">http://ec.europa.eu/odr</a>.</li>
            <li class="list-group-item bg-transparent site-font-color">You can also send any complaints to the email address provided above.</li>
            <li class="list-group-item bg-transparent site-font-color"></li>
          </ul>

        </div>

        <div class="container my-4">
          <h3 class="site-font-color">Shop Management</h3>
          <div class="row mx-1">
            <div class="col-9 col-md-3 img-fluid">
              <img class="img-fluid" width="200" src="./../..\res\img/impressum.jpg">
              <figcaption class="figure-caption site-font-color fw-bold">Daniel</figcaption>
            </div>
            <div class="col-9 col-md-3 img-fluid ">
              <img class="img-fluid" width="200" src="./../..\res\img/impressum.jpg">
              <figcaption class="figure-caption site-font-color fw-bold">Rafael</figcaption>
            </div>
            <div class="col-9 col-md-3 img-fluid ">
              <img class="img-fluid" width="200" src="./../..\res\img/impressum.jpg">
              <figcaption class="figure-caption site-font-color fw-bold">Elias</figcaption>
            </div>
            <div class="col-9 col-md-3 img-fluid ">
              <img class="img-fluid" width="200" src="./../..\res\img/impressum.jpg">
              <figcaption class="figure-caption site-font-color fw-bold">Hiep</figcaption>
            </div>
            <div class="col-9 col-md-3 img-fluid ">
              <img class="img-fluid" width="200" src="./../..\res\img/impressum.jpg">
              <figcaption class="figure-caption site-font-color fw-bold">Duong</figcaption>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <h3 class="site-font-color mt-5">Delivery Check</h3>
        <div id="map" class="site-font-color"></div>
      </div>

    </div>
  </div>

  <?php
  include '../includes/footer.php';
  ?>
  <!-- Include Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <style>
    #map {
      height: 500px;
      margin-top: 20px;
      border-radius: 15px;
    }
  </style>

  <!-- Include Leaflet JS -->
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

  <script>
    var map = L.map('map').setView([48.198232, 16.346632], 15); // Set the initial view to Mariahilferstrasse 116, 1070 Vienna
    var fixedLocation = L.latLng(48.198232, 16.346632); // Mariahilferstrasse 116, 1070 Vienna
    var marker1 = L.marker(fixedLocation).addTo(map);
    var marker2 = null;
    var polyline = null;

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var clickListener = function(e) {
      if (marker2 === null) {
        marker2 = L.marker(e.latlng).addTo(map);
        polyline = L.polyline([fixedLocation, marker2.getLatLng()], {
          color: 'blue'
        }).addTo(map);
        var distance = fixedLocation.distanceTo(marker2.getLatLng());
        var deliveryTime = calculateDeliveryTime(distance);
        alert('The distance is: ' + distance.toFixed(2) + ' meters\n' +
          'The delivery time is: ' + deliveryTime + ' days');
      } else {
        // Remove the existing marker2 and polyline
        marker2.removeFrom(map);
        polyline.removeFrom(map);
        marker2 = null;
        polyline = null;
      }
    };

    map.on('click', clickListener);

    marker1.on('mouseover', function(e) {
      var address = 'Our Location'; // Insert the address of the first point here
      marker1.bindPopup(address).openPopup();
    });

    marker1.on('mouseout', function(e) {
      marker1.closePopup();
    });

    function calculateDeliveryTime(distance) {
      if (distance < 5000) {
        return 1;
      } else if (distance < 10000) {
        return 2;
      } else {
        return 3;
      }
    }
  </script>

</body>

</html>
