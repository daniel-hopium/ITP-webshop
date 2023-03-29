<!DOCTYPE html>
<html lang="en">
<head>
    <title>Meine Reservierungen</title>

    <?php 
        include '../includes/head.php';
        if(!isset($_SESSION['username'])) header('Location: home.php');
    ?>
    
</head>
<body class="d-flex flex-column min-vh-100">

<div class = "container site-font-color text-center" >
    <h1 class="h1 mt-5">Meine Reservierungen:</h1>

<?php 
    require_once ('../../config/dbaccess.php');

    $userID = $currentUser['id'];
    $db_obj = new mysqli($host, $user, $password, $database);
                
    $sql =  "SELECT * FROM reservations WHERE userID=$userID AND type NOT IN ('parking_open','parking_roofed') ORDER BY created DESC";
    $result = $db_obj->query($sql);
    
    echo '<div class="table-responsive">
    <table class="table table-striped"> 
    <tr class="h6"> 
        <td>Zimmernummer</td> 
        <td>Einreichdatum</td> 
        <td>Unterkunft</td> 
        <td>Parkplatz</td> 
        <td>Menü</td> 
        <td>Haustiere</td> 
        <td>Ankunftsdatum</td> 
        <td>Abfahrtsdatum</td> 
    </tr>';

  while ($row = $result->fetch_assoc()) 
  {
    
    $field1name = $row["id"];
    $field2name = $row["created"];
    $field3name = $row["type"];
    
        $sqlParking =  "SELECT type FROM reservations WHERE created='$field2name' AND type NOT IN('suite', 'single_room', 'double_room')";
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

      echo '<tr> 
                <td>'.$field1name.'</td> 
                <td>'.$field2name.'</td> 
                <td>'.$field3name.'</td> 
                <td>'.$field4name.'</td> 
                <td>'.$field5name.'</td>
                <td>'.$field6name.'</td>
                <td>'.$field7name.'</td>
                <td>'.$field8name.'</td>
            </tr>';
            
  }
  echo "</table></div>"; 
?>     
</div>

<?php
 include '../includes/footer.php';
?>
    
</body>
</html>