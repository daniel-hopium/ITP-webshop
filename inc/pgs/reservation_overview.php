<!DOCTYPE html>
<html lang="en">
<head>
    <title>Meine Buchungen</title>

    <?php 
        include '../includes/head.php';
        if(!isset($_SESSION['username'])  || ($_SESSION['username'] != 'admin')) header('Location: home.php');
        require_once ('../../config/dbaccess.php');
    ?>
    
</head>
<body class="d-flex flex-column min-vh-100">

    <div class = "container site-font-color text-center" >
        <h1 class="h1 mt-5">Reservierungsverwaltung:</h1>

        <?php 
        $userID = $currentUser['id'];
        $db_obj = new mysqli($host, $user, $password, $database);
                    
        $sql =  "SELECT * FROM reservations WHERE type NOT IN ('parking_open','parking_roofed') AND userID IS NOT NULL ORDER BY created DESC";
        $result = $db_obj->query($sql);

        echo '<div class="table-responsive">
        <table class="table table-striped"> 
        <tr class="h6"> 
            <td>Kundennummer</td> 
            <td>Zimmernummer</td> 
            <td>Einreichdatum</td> 
            <td>Unterkunft</td> 
            <td>Parkplatz</td> 
            <td>Menü</td> 
            <td>Haustiere</td> 
            <td>Ankunftsdatum</td> 
            <td>Abfahrtsdatum</td> 
            <td></td> 
        </tr>';

    while ($row = $result->fetch_assoc()) 
    {
        
        $field0name = $row["userID"];
        $field1name = $row["id"];
        $field2name = $row["created"];
        $field3name = $row["type"];
            $sqlParking =  "SELECT type FROM reservations WHERE created='$field2name' AND userID IS NOT NULL AND type NOT IN('suite', 'single_room', 'double_room')";
            $field4name = $db_obj->query($sqlParking);
            $field4name = $field4name->fetch_assoc();
            if($field4name == NULL) 
                $field4name = "no_parking";
            else 
                $field4name = $field4name["type"];
            

        $field5name = $row["menu"]; 
        $field6name = $row["has_pets"];  
        $field7name = $row["date_arrival"];
        $field8name = $row["date_departure"];
        $field9name = "<a class='site-font-color' href='reservation_overview.php?date=$field2name' method='GET'>löschen</a";
        
        echo '<tr> 
                    <td>'.$field0name.'</td> 
                    <td>'.$field1name.'</td> 
                    <td>'.$field2name.'</td> 
                    <td>'.$field3name.'</td> 
                    <td>'.$field4name.'</td> 
                    <td>'.$field5name.'</td>
                    <td>'.$field6name.'</td>
                    <td>'.$field7name.'</td>
                    <td>'.$field8name.'</td>
                    <td>'.$field9name.'</td>
                </tr>';        
    }

    echo "</table></div>";

    if(isset($_GET['date']))
    {
        $created = $_GET['date'];

        $null = NULL;
        $sql = "UPDATE reservations SET userID=(?), date_arrival=(?), date_departure=(?), menu=(?), has_pets=(?), availability='available' WHERE created='$created'";
                
        $stmt = $db_obj->prepare($sql);

        $stmt-> bind_param( 'sssss',$null , $null, $null, $null, $null);

        if ($stmt->execute()) 
        { echo "<script>location.href='reservation_overview.php'</script>"; } else { echo "Error"; }
        $stmt->close(); $db_obj->close();
    }   
    ?>
  
    </div>

<?php
 include '../includes/footer.php';
?>  
</body>
</html>