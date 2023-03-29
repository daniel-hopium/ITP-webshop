<!DOCTYPE html>
<html lang="en">
<head>
    <title>News</title>

  <?php 
      include '../includes/head.php';
      require_once ('../../config/dbaccess.php');
  ?>
    
</head>
<body class="d-flex flex-column min-vh-100 ">
  <div class = "container " >
      <h1 class=" my-3 site-font-color">Unsere Neuigkeiten</h1>

  <?php 
    
    $db_obj = new mysqli($host, $user, $password, $database);
              
    $sql =  "SELECT * FROM news ORDER BY id DESC ";
    $result = $db_obj->query($sql);

    while ($row = $result->fetch_array()) 
    { //_assoc works, _object not
    
      echo "<div class='card my-2 site-font-color'>";
      echo "<h5 class='card-header'>" . $row['title'] . "</h5>";

      $img_directory = $row['img_directory'];
      if($img_directory != NULL){
        echo "<div class='my-1' style='width: 90%; ;
        height: 300px;'><img class=' img-fluid col-lg-12 mx-2' src='$img_directory' alt='Hier sollte ein Bild erscheinen' style='width: 100%; 
        height: 100%;
        object-fit: contain;'></div>"."<br>";
      }

      echo "<div class='card-body'><p class='card-text'>Veröffentlicht: " . $row['created'] . "</p>";
      echo "<p class='card-text'>".$row['text'] . "</p><br>";
      echo "</div></div>";
    }

  ?>
  </div>

  <?php
  include '../includes/footer.php';
  ?>
</body>
</html>