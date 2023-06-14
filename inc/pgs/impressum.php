<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login</title>

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
            <h1 class="ms-3 my-3">Impressum</h1>
          </div>

          <ul class="list-group list-group-flush">
            <li class="list-group-item bg-transparent site-font-color">
              <h6><b>Webshop</b></h6>
            </li>
            <li class="list-group-item bg-transparent site-font-color">Gesellschaft mit beschränkter Haftung</li>
            <li class="list-group-item bg-transparent site-font-color">Mariahilferstrasse 212, 1140 Wien</li>
            <li class="list-group-item bg-transparent site-font-color">Tel: +43 1 345 67 89</li>
            <li class="list-group-item bg-transparent site-font-color">Fax +41 1 345 67 89 99</li>
            <li class="list-group-item bg-transparent site-font-color"><a class="site-font-color" href="mailto:info@nfa-shop.at">info@nfa-shop.at</a></li>
            <li class="list-group-item bg-transparent site-font-color"></li>
          </ul>
          <ul class="list-group list-group-flush">
            <li class="list-group-item bg-transparent site-font-color"></li>
            <li class="list-group-item bg-transparent site-font-color">UID-Nr: ATU12345678</li>
            <li class="list-group-item bg-transparent site-font-color">FN: 123456a</li>
            <li class="list-group-item bg-transparent site-font-color">FB-Gericht: Gerichtsstand Wien</li>
            <li class="list-group-item bg-transparent site-font-color">Mitglied von ÖHV und WKO</li>
            <li class="list-group-item bg-transparent site-font-color"></li>
          </ul>
          <ul class="list-group list-group-flush">
            <li class="list-group-item bg-transparent site-font-color"></li>
            <li class="list-group-item bg-transparent ms-0 site-font-color">
              <h6>Berufsrecht:</h6>
            </li>
            <li class="list-group-item bg-transparent site-font-color">Gewerbeordnung: <a class="site-font-color" href="www.ris.bka.gv.at">www.ris.bka.gv.at</a></li>
            <li class="list-group-item bg-transparent site-font-color">Bezirkshaupmannschaft Wien</li>
            <li class="list-group-item bg-transparent site-font-color">Verbraucher haben die Möglichkeit, Beschwerden an die Online-Streitbeilegungsplattform der EU zu richten: <a class="site-font-color" href="http://ec.europa.eu/odr">http://ec.europa.eu/odr</a>.</li>
            <li class="list-group-item bg-transparent site-font-color">Sie können allfällige Beschwerde auch an die oben angegebene E-Mail-Adresse richten.</li>
            <li class="list-group-item bg-transparent site-font-color"></li>
          </ul>

        </div>

        <div class="container my-4">
          <h3 class="site-font-color">Shopleitung</h3>
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
        <h3 class="site-font-color mt-5">Liefercheck</h3>
        <div id="map" class="site-font-color"></div>
      </div>

    </div>
  </div>

  <?php
  include '../includes/footer.php';
  ?>
  <!-- Leaflet CSS einbinden -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <style>
    #map {
      height: 500px;
      margin-top: 20px;
      border-radius: 15px;
    }
  </style>

  <!-- Leaflet CSS einbinden -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <style>
    #map {
      height: 500px;
      margin-top: 20px;
      border-radius: 15px;
    }
  </style>

  <!-- Leaflet JS einbinden -->
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

  <script>
    var map = L.map('map').setView([48.198232, 16.346632], 15); // Set the initial view to Mariahilferstrasse 116, 1070 Wien
    var fixedLocation = L.latLng(48.198232, 16.346632); // Mariahilferstrasse 116, 1070 Wien
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
        alert('Die Distanz beträgt: ' + distance.toFixed(2) + ' Meter\n' +
          'Die Lieferzeit beträgt: ' + deliveryTime + ' Tage');
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
      var address = 'Unser Standort'; // Hier die Adresse des ersten Punktes einfügen
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