<!-- Style vorerst in php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Elektronik-Webshop</title>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">


    <?php
        include '../includes/head.php';
    ?>


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
                    <img src="https://via.placeholder.com/400x300/2D2D2D/FFFFFF/?text=Beispielbild" class="card-img-top"
                        alt="Computer">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-3">Computer</h2>
                        <p class="card-text">Hier finden Sie eine große Auswahl an Desktop-PCs für Ihr Zuhause oder
                            Büro, mit hoher Leistung und zuverlässiger Qualität.</p>
                        <a href="prod_display.php?category_id=1" class="btn btn-primary">Kategorie ansehen</a>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/400x300/2D2D2D/FFFFFF/?text=Beispielbild" class="card-img-top"
                        alt="Smartphones">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-3">Laptop</h2>
                        <p class="card-text">Entdecken Sie unsere breite Palette an leichten und tragbaren Laptops für
                            unterwegs, mit langen Akkulaufzeiten und schnellen Prozessoren.</p>
                        <a href="prod_display.php?category_id=2" class="btn btn-primary">Kategorie ansehen</a>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/400x300/2D2D2D/FFFFFF/?text=Beispielbild" class="card-img-top"
                        alt="Fernseher">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-3">Tablet</h2>
                        <p class="card-text">Erleben Sie die Freiheit und Flexibilität unserer Tablets, mit
                            kristallklaren Bildschirmen und schnellen Prozessoren.</p>
                        <a href="prod_display.php?category_id=3" class="btn btn-primary">Kategorie ansehen</a>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/400x300/2D2D2D/FFFFFF/?text=Beispielbild" class="card-img-top"
                        alt="Konsolen">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-3">Drucker</h2>
                        <p class="card-text">Wählen Sie aus unseren hochwertigen Druckern für Zuhause oder Büro, die
                            alle Ihre Anforderungen erfüllen.</p>
                        <a href="prod_display.php?category_id=4" class="btn btn-primary">Kategorie ansehen</a>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/400x300/2D2D2D/FFFFFF/?text=Beispielbild" class="card-img-top"
                        alt="Netzwerk">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-3">Kopfhörer</h2>
                        <p class="card-text">Tauchen Sie ein in Ihre Musik oder genießen Sie kristallklare Anrufe mit
                            unseren hochwertigen Kopfhörern.</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <a href="prod_display.php?category_id=5" class="btn btn-primary">Kategorie ansehen</a>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card h-100">
                    <a href="prod_display.php?category_id=6" class="stretched-link"></a>
                    <img src="https://via.placeholder.com/400x300/2D2D2D/FFFFFF/?text=Beispielbild" class="card-img-top"
                        alt="Netzwerk">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-3">Lautsprecher</h2>
                        <p class="card-text">Erleben Sie eine beeindruckende Klangqualität mit unseren leistungsstarken
                            und vielseitigen Lautsprechern für Zuhause oder unterwegs.</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <p class="mb-0">Weitere Details anzeigen</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap 5 JS (optional) -->

    <?php
  include '../includes/footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>