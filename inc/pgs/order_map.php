<!DOCTYPE html>
<html>

<head>
    <!-- Einbinden von Bootstrap CSS und JS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>

    <!-- Einbinden von Leaflet CSS und JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <style>
        #mapid {
            height: 400px;
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mapModalLabel">Karte von Wien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="mapid"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Modal anzeigen
        var myModal = new bootstrap.Modal(document.getElementById('mapModal'), {
            keyboard: false
        });

        myModal.show();

        // Karte initialisieren
        var map = L.map('mapid').setView([48.2082, 16.3738], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);
    </script>
</body>

</html>