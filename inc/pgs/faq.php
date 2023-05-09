<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kontakt</title>

    <?php
        include '../includes/head.php';
    ?>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }
    </style>
</head>


<section class="py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="display-1">Hilfe</h1>
            <p class="lead text-muted">Here you can get help if you are lost on our website!</p>
        </div>
    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-12">
            <h2>Bedienungsanleitung</h2>
            <p>Mit Hilfe des Nav-Bars können sie rasch navigieren.<br> Klicken sie dazu einfach auf die gewünschte
                Kategorie.</p>
            <p>Um sich zu registrieren, wählen sie "Registrieren".</p>
            <p>Um sich zu ein Zimmer zu reservieren, wählen sie "Zimmerreservierung".</p>
            <p>Falls sie sich an- oder abmelden wollen, klicken sie auf ihr Profilbild in der rechten oberen Ecke.</p>
            <p>Falls sie Administrator sind, tun sie mir leid "F".</p>
        </div>
        <div class="col-lg-6 col-12">
            <h2>FAQs</h2>
            <p><b>Wie bekomme ich mein Geld zurück? </b><br /> Gar nicht.</p>
            <p><b>Hab ich eine garantie mein Zimmer zu erhalten? </b><br /> Nein.</p>
            <p><b>Gibt es Wartungszeiten, währenddessen Admins nicht zugreifen können? </b><br /> Ja, Mo-Fr 8-20 Uhr.
            </p>
            <p><b>Werden meine Daten vertraulich behandelt? </b><br /> Ja, werden sie.</p>
            <p><b>War die vorherige Antwort eine Lüge? </b><br /> Ja, war sie.</p>
        </div>
    </div>
</div>


<?php
include '../includes/footer.php';
    ?>

</body>

</html>