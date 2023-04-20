<!-- Style vorerst in php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Elektronik-Webshop</title>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        .card {
            height: 100%;
        }

        .card-body {
            display: flex;
            flex-direction: column;
        }

        .card-text {
            text-align: left;
            flex-grow: 1;
        }

        .btn {
            align-self: flex-start;
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <h1 class="text-center mb-4">Willkommen im Elektronik-Webshop</h1>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
            <div class="col mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/400x300/2D2D2D/FFFFFF/?text=Beispielbild" class="card-img-top" alt="Computer">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-3">Computer</h2>
                        <p class="card-text">Entdecken Sie unsere Auswahl an Desktop-PCs, Laptops und Zubehör.</p>
                        <a href="prod_display.php" class="btn btn-primary">Kategorie ansehen</a>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/400x300/2D2D2D/FFFFFF/?text=Beispielbild" class="card-img-top" alt="Smartphones">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-3">Smartphones</h2>
                        <p class="card-text">Finden Sie Ihr perfektes Smartphone mit unseren Top-Marken und Modellen.</p>
                        <a href="prod_display.php" class="btn btn-primary">Kategorie ansehen</a>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/400x300/2D2D2D/FFFFFF/?text=Beispielbild" class="card-img-top" alt="Fernseher">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-3">Fernseher</h2>
                        <p class="card-text">Erleben Sie TV-Unterhaltung in atemberaubender Qualität mit unseren Fernsehern.</p>
                        <a href="prod_display.php" class="btn btn-primary">Kategorie ansehen</a>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/400x300/2D2D2D/FFFFFF/?text=Beispielbild" class="card-img-top" alt="Konsolen">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-3">Konsolen</h2>
                        <p class="card-text">Entdecken Sie die neuesten Spielekonsolen und das passende Zubehör.</p>
                        <a href="prod_display.php" class="btn btn-primary">Kategorie ansehen</a>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/400x300/2D2D2D/FFFFFF/?text=Beispielbild" class="card-img-top" alt="Netzwerk">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-3">Netzwerk</h2>
                        <p class="card-text">Entdecken Sie unsere Auswahl an Netzwerkgeräten und Zubehör.</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <a href="prod_display.php" class="btn btn-primary">Kategorie ansehen</a>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card h-100">
                    <a href="prod_display.php" class="stretched-link"></a>
                    <img src="https://via.placeholder.com/400x300/2D2D2D/FFFFFF/?text=Beispielbild" class="card-img-top" alt="Netzwerk">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-3">Zubehör</h2>
                        <p class="card-text">Entdecken Sie unsere große Auswahl an Zubehör für alle Ihre elektronischen Geräte.</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <p class="mb-0">Weitere Details anzeigen</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap 5 JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>