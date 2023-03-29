<!DOCTYPE html>
<html lang="en">
<head>
    <title>Neue Reservierung</title>

    <?php 
        include '../includes/head.php';
        if(!isset($_SESSION['username'])) header('Location: home.php');
    ?>
         
</head>
<body class="d-flex flex-column min-vh-100">
    <?php
    require_once ('../../config/dbaccess.php');

    $db_obj = new mysqli($host, $user, $password, $database);
    
    $availability_suite = true;
    $availability_single_room = true;
    $availability_double_room = true;
    $availability_parking_open = true;
    $availability_parking_roofed = true;
    
    $sql = mysqli_query($db_obj, "SELECT `id` FROM `reservations` WHERE type='suite' AND availability='available'");
    if($result = mysqli_num_rows($sql) == 0)
    {
        $availability_suite = false;
    }
    
    $sql = mysqli_query($db_obj, "SELECT `id` FROM `reservations` WHERE type='single_room' AND availability='available'");
    if (mysqli_num_rows($sql) == 0) 
    {
        $availability_single_room = false;
    }
    
    $sql = mysqli_query($db_obj, "SELECT `id` FROM `reservations` WHERE type='double_room' AND availability='available'");
    if(mysqli_num_rows($sql) == 0)
    {
        $availability_double_room = false;
    }
    
    $sql = mysqli_query($db_obj, "SELECT `id` FROM `reservations` WHERE type='parking_open' AND availability='available'");
    if(mysqli_num_rows($sql) == 0)
    {
        $availability_parking_open = false;
    }
    
    $sql = mysqli_query($db_obj, "SELECT `id` FROM `reservations` WHERE type='parking_roofed' AND availability='available'");
    if(mysqli_num_rows($sql) == 0)
    {
        $availability_parking_roofed = false;
    }
    ?>

    <div class = "container site-font-color " >
        <h1 class="h1 mt-5 text-center">Neue Reservierung:</h1>
        <div class="container p-0 my-5 col-md-10">
            <form action="new_reservation.php" method="POST">
                <div class="form-floating mt-2 col-md-12 shadow">
                    <select class="form-select"  name="room" id="room"  required>
                        <?php 
                        if ($availability_suite) {
                            echo "<option value='suite'>Luxus-Suite (250€/Nacht)</option>";} else echo "<option  disabled value='suite'>Luxus-Suite (ausgebucht)</option>";
                        if ($availability_single_room) {
                            echo "<option value='single_room'>Einzelzimmer (100€/Nacht)</option>";} else echo "<option disabled value='single_room'>Einzelzimmer (ausgebucht)</option>";
                        if ($availability_double_room) {
                            echo "<option value='double_room'>Doppelzimmer (160/Nacht)</option>";} else echo "<option disabled value='double_room'>Doppelzimmer (ausgebucht)</option>";
                        ?>
                    </select>
                        <label class="" for="room">Zimmerart</label>
                </div>
        
                <div class="row mt-2">
                    <div class="form-floating col-md-6">
                        <input type="date" class="form-control mb-2 shadow" name="dateArrival" id="dateArrival" min='<?php echo date("Y-m-d")?>' required>
                        <label class="ms-2" for="dateArrival">Anreisedatum</label>
                    </div>
                    <div class="form-floating col-md-6">
                        <input type="date" class="form-control mb-2 shadow" name="dateDeparture" id="dateDeparture" required>
                        <label class="ms-2" for="dateDeparture">Abreisedatum</label>
                    </div>
                </div>

                <div class="row mt-0">
                    <div class="form-floating col-md-6">
                        <select class="form-select shadow"  name="menu" id="menu"  required>
                            <option value="noMenu">Kein Frühstück</option>
                            <option value="breakfast">Frühstück (10€/Tag)</option>
                            <option value="fullBoard">Vollpension (25€/Tag)</option>
                        </select>
                        <label class="ms-2" for="menu">Frühstück</label>
                    </div>

                    <div class="form-floating  col-md-6">
                        <select class="form-select shadow "  name="parkingSpot" id="parkingSpot"  required>
                            <option value="no_parking">Kein Parkplatz</option>
                        <?php 
                        if ($availability_parking_open) {
                            echo "<option value='parking_open'>Parkplatz, ohne Überdachung (10€/Nacht)</option>";} else echo "<option disabled value='openParking'>Parkplatz, ohne Überdachung (ausgebucht)</option>";
                        if ($availability_parking_roofed) {
                            echo "<option value='parking_roofed'>Parkplatz, überdacht (25€/Nacht)</option>";} else echo "<option disabled value='closedParking'>Parkplatz, überdacht (ausgebucht)</option>";
                    
                        ?>
                        </select>
                        <label class="ms-2" for="parkingSpot">Parkplatz</label>
                    </div>
                </div>
                <div class="form-floating mt-2 col-md-3">
                    <select class="form-select shadow"  name="pets" id="pets" required >
                        <option value="false">Nein</option>
                        <option value="true">Ja</option>
                        
                    </select>
                    <label class="" for="pets">Haustiere</label>
                </div>
                <div class="my-2">
                    <button class="btn btn-primary btn-light shadow me-1" type="reset" >Zurücksetzen</button>
                    <button class="btn btn-primary btn-light shadow" type="submit">Bestätigen</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container text-center h2 site-font-color">

    <?php
        if (isset($_POST["dateArrival"]) && isset($_POST["dateArrival"]) && $_POST['dateArrival'] >= $_POST['dateDeparture'])
        {
            echo 'Ungültiges An- und Abreiseverhältnis!';
        }
        else {
        
            if(isset($_POST["dateArrival"]) && !empty($_POST["dateArrival"])
                && isset($_POST["dateDeparture"]) && !empty($_POST["dateDeparture"])
                && isset($_POST["room"]) && !empty($_POST["room"])
                && isset($_POST["menu"]) && !empty($_POST["menu"])
                && isset($_POST["parkingSpot"]) && !empty($_POST["parkingSpot"])
                && isset($_POST["pets"]) && !empty($_POST["pets"])) 
            {


                    //create $db_obj, create sql statement, prepare it and bind the variables to it
                    $db_obj = new mysqli($host, $user, $password, $database);

                    $room = $_POST["room"];
                    $dateArrival = $_POST["dateArrival"];
                    $dateDeparture = $_POST["dateDeparture"];
                    $menu = $_POST["menu"];
                    $parkingSpot = $_POST["parkingSpot"];
                    $pets = $_POST["pets"];
                
                    $userID = $currentUser['id']; // comes from checkIfAdmin


                    $sql = mysqli_query($db_obj, "SELECT `id` FROM `reservations` WHERE type='$room' AND availability='available'");
                    $sql = $sql->fetch_assoc(); 
                    $availableID = $sql['id'];
                    

                    $sql = "UPDATE reservations SET userID=(?), date_arrival=(?), date_departure=(?), menu=(?), has_pets=(?), availability='unavailable' WHERE id='$availableID'";

                    
                    $stmt = $db_obj->prepare($sql);

                    $stmt-> bind_param( 'issss', $userID, $dateArrival, $dateDeparture, $menu, $pets);

                if($parkingSpot != 'no_parking')
                {
                    $sql2 = mysqli_query($db_obj, "SELECT `id` FROM `reservations` WHERE type='$parkingSpot' AND availability='available'");
                    $sql2 = $sql2->fetch_assoc(); 
                    $availableID2 = $sql2['id'];
                    

                    $sql2 = "UPDATE reservations SET userID=(?), date_arrival=(?), date_departure=(?), availability='unavailable' WHERE id='$availableID2'";

                    
                    $stmt2 = $db_obj->prepare($sql2);

                    $stmt2-> bind_param( 'iss', $userID, $dateArrival, $dateDeparture);

                    $stmt2->execute();
                    $stmt2->close();
                }

                if ($stmt->execute()) { echo "<script>location.href='redirect_page.php?type=reservation'</script>"; } else { echo "Error"; }
                $stmt->close(); $db_obj->close();
                }
            }
    echo "</div>";

    include '../includes/footer.php';
    ?>
    
</body>
</html>