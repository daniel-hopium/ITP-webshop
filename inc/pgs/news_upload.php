<!DOCTYPE html>
<html lang="en">
<head>
    <title>Beitragsverwaltung</title>

    <?php
        include '../includes/head.php';
        require_once ('../../config/dbaccess.php');
        if(!isset($_SESSION['username'])  || ($_SESSION['username'] != 'admin')) header('Location: home.php');
    ?>  
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container mt-3 mb-3 site-font-color">
        <h1 class="h1 mt-5">Beitragsverwaltung</h1>
        <form action="news_upload.php" method="POST" enctype="multipart/form-data">
            <div class="form-floating col-md-6">
                <input type="text" class="form-control mb-3 shadow" name="title" id="title" placeholder="Titel" required>
                <label class="" for="title">Titel</label>
            </div>
            <div class="form-floating mb-3 col-md-10">
                <textarea class="form-control shadow" name="text" id="text" rows="10" placeholder="Text" style="height: 300px"></textarea>
                <label for="text" class="form-label">Text</label>
            </div>
            <div class="row ">
                <div class="col-12 col-lg-8">
                    <div class=" py-3">
                    <input type="file" name="file" class="form-control shadow site-font-color btn-primary" >
                    </div>
                </div>    
                <div class="col-12 col-lg-2">
                    <div class=" py-3">
                    <input type="submit" name="submit" value="Hochladen" class="form-control shadow site-font-color btn-primary" ></div>  
                    </div>
                </div>
            </div>      
        </form> 
    </div>

    <div class="container">   
    <?php
        
        if(isset($_POST["title"]) && !empty($_POST["title"])
        && isset($_POST["text"]) && !empty($_POST["text"])) 
        {
        
            $db_obj = new mysqli($host, $user, $password, $database);
            $sql = "INSERT INTO `news` (`title`, `text`, `img_directory`)VALUES (?, ?, ?)";

            $stmt = $db_obj->prepare($sql);

            $stmt-> bind_param( 'sss', $title, $text, $img_directory);
            
            $title = $_POST["title"];
            $text = $_POST["text"];
            $img_directory = NULL;
            $img_check = True;

        if(isset($_FILES["name"]))
        {
        
            $file = $_FILES['file'];
            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png');

            if(in_array($fileActualExt, $allowed)){ // checks if it has allowed format
                if($fileError === 0) {
                    if($fileSize < 1e+7){ // 10mb max size

                        $fileNameNew = uniqid('', true).".".$fileActualExt; // new file name via uniqid

                        $fileDestination = $_SERVER["DOCUMENT_ROOT"] . "\uploads\\news\\".$fileNameNew;
                        
                        move_uploaded_file($fileTmpName, $fileDestination);

                        $img_directory = ".\..\..\uploads\\news\\$fileNameNew"; // img directory for database

                        $file = $fileDestination; 
                        $max_resolution= 800;

                        // resize function  
                        // to make it work you need to enable GD in php settings
                         if(file_exists($file)){
                         
                             if($fileActualExt == 'jpeg' || $fileActualExt == 'jpg'){
                                $original_image = imagecreatefromjpeg($file); // 
                             }
                             else 
                             {
                                $original_image = imagecreatefrompng($file);
                             }
                         
                             //resolution
                             $original_width = imagesx($original_image);
                             $original_height = imagesy($original_image);
                         
                             // case 1
                                $ratio = $max_resolution / $original_width;
                                $new_width = $max_resolution;
                                $new_height = $original_height * $ratio;
                         
                             // case 2
                             if ($new_height > $max_resolution){
                                $ratio = $max_resolution / $original_height;
                                $new_height = $max_resolution;
                                    $new_width = $original_width * $ratio;
                             }
                         
                             if($original_image)
                             {
                         
                                 $new_image = imagecreatetruecolor($new_width, $new_height);
                                 imagecopyresampled($new_image,$original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
                         
                                     if ($fileActualExt == 'jpeg' || $fileActualExt == 'jpg') 
                                     {
                                        imagejpeg($new_image,$file,90);
                                     }
                                     else 
                                     {
                                        imagepng($new_image, $file);
                                     }              
                             }
                         
                        }
                            
                    } 
                    else 
                    {
                        echo "<h1 class='h4'>Dein Upload ist zu groß!</h1>";
                        $img_check = False;
                    }
                } 
                else 
                {
                    echo "<h1 class='h4'>Ein Fehler beim Upload ist aufgetreten!</h1>";
                    $img_check = False;
                }
            } 
            else 
            {
                echo "<h1 class='h4'>Falscher Datentyp!</h1>";
                $img_check = False;
            }
        }

        if ($img_check && $stmt->execute()) { echo "<h1 class='h4'>Beitrag erfolgreich hochgeladen!</h1>"; } else { echo "Error"; }
                $stmt->close(); $db_obj->close(); 
    }

    // overview
    $userID = $currentUser['id'];
    $db_obj = new mysqli($host, $user, $password, $database);
                
    $sql =  "SELECT id, created, title FROM news ORDER BY id DESC";
    $result = $db_obj->query($sql);

    echo '<div class="table-responsive col-md-10">
    <table class="table table-striped"> 
    <tr class="h6"> 
        <td>ID</td> 
        <td>Veröffentlichungsdatum</td> 
        <td>Titel</td> 
        <td></td> 
    </tr>';

    while ($row = $result->fetch_assoc()) 
    {
            //print_r($row);
        $field1name = $row["id"];
        $field2name = $row["created"];
        $field3name = $row["title"];
        $field4name = "<a class='site-font-color' href='news_upload.php?news=$field1name' method='GET'>löschen</a>";

        echo '<tr> 
                    <td>'.$field1name.'</td> 
                    <td>'.$field2name.'</td> 
                    <td>'.$field3name.'</td> 
                    <td>'.$field4name.'</td> 
                </tr>';
                
    }
    echo "</table></div>"; 

    if(isset($_GET['news']))
    {
        $news_id = $_GET['news'];
        
        $null = NULL;
        $stmt = "DELETE FROM news WHERE id='$news_id'";
        mysqli_query($db_obj, $stmt);    
        
        echo "<script>location.href='news_upload.php'</script>";
        $db_obj->close();
    }   
    ?>
    </div>

    <?php 
        include '../includes/footer.php';
    ?>
</body>
</html>