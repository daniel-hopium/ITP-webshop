<!DOCTYPE html>
<html lang="en">
<head>
    <title>FAQ</title>

  <?php 
      include '../includes/head.php';
  ?>
    
</head>
<body class="d-flex flex-column min-vh-100 ">
<div class = "container " >
    
    <div class="card card-bg shadow-2-strong card-registration mt-3 p-2 flex-column col-md-8" style="border-radius: 15px; ">
      <h1 class=" my-3 site-font-color">FAQ</h1>
      <div class="site-font-color">
        <h3 class="">Wie kann ein Hotelzimmer buchen?</h3>
        
        <?php echo isset($_SESSION['username']) ?  '<p>Gehen sie auf die Navigationsleiste und klicken Sie auf Reservierungen -> Neue Reservierung oder klicken Sie  <a href="new_reservation.php" class="site-font-color ">hier...</a></p>' : '<p>Um etwas buchen zu können, müssen Sie sich zuerst einloggen.</p>
        <p>Zum Einloggen, klicken sie <a href="login.php" class="site-font-color ">hier...</a></p>';
        ?>
      </div>

      <div class="site-font-color">
        <h3 class="">Was sind unsere Öffnungszeiten?</h3>
        <p>Wir haben rund um die Uhr geöffnet. Montag bis Sonntag, das ganze Jahr über.</p>
        <p>Check-In aber erst ab 14 Uhr.</p>
      </div>

      <div class="site-font-color">
        <h3>Stornierkosten?</h3>
        <p>Bis zu 14 Tage vor Ihrem Besuch werden 90% Ihrer Gebühren storniert. Danach werden 50% der Gebüren zurückerstattet, bis 7 Tage vor Ihrer Ankunft.</p>
        <p>Ab einer Woche können wir Ihnen leider kein Geld mehr zurückerstatten.</p>
      </div>

      <div class="site-font-color">
        <h3>Wie Sie uns Kontaktieren können</h3>
        <p>Schreiben Sie uns eine E-mail mit Ihren Anliegen. Am besten benutzen Sie unser <a href="contact.php" class=" site-font-color">Kontaktformular</a>!
        <p>Oder rufen Sie uns gerne unter: +43 1 345 67 89</p>
        <p>Wir freuen uns auf Sie!</p>
      </div>

      <div class="site-font-color">
        <h3>Wo befinden wir uns?</h3>
        <iframe class="img-fluid mw-75 mb-2 shadow border " src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5321.6453507752385!2d16.22457287401032!3d48.17149876991389!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476da71ac9d9b465%3A0xab92553a27c2a90e!2sRasthaus%20Rohrhaus!5e0!3m2!1sde!2sat!4v1673815959769!5m2!1sde!2sat" width="550" height="550" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>

</div>

<?php
 include '../includes/footer.php';
?>
    
</body>
</html>