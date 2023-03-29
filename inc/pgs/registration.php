<!doctype html>
<html lang="en">
  <head>
    <title>Registrierung</title>

  <?php
   include '../includes/head.php';
   require_once ('../../config/dbaccess.php');
  ?> 
  
  </head>
  <body class="d-flex flex-column min-vh-100">
    <div class="container site-font-color">
        <form class="card card-bg  shadow-2-strong card-registration mt-3 p-2" style="border-radius: 15px;"  action="" method="post">
            <div class="container ">
                <div>
                    <h1 class="h3 mt-4">Registrierung</h1>
                </div>
                <div class=" form-floating form-label select-label shadow">
                    <select name="formOfAdress" id="floatingSelect" class="form-select" >
                        <option label="Herr" value="Herr">Herr</option>
                        <option label="Frau" value="Frau">Frau</option>
                        <option label="Divers" value="Divers">Frau</option>
                    </select>
                    <label for="floatingSelect">Anrede</label>
                </div>
                <div class="row">
                    <div class="form-floating col-md-6">
                        <input type="text" class="form-control mb-3 shadow" name="name" id="name" placeholder="Vorname"required>
                        <label class="ms-2" for="floatingSurname">Vorname</label>
                    </div>
                    <div class="form-floating col-md-6">
                        <input type="text" class="form-control mb-3 shadow" name="surname" id="surname" placeholder="Nachname" required>
                        <label class="ms-2"for="floatingName">Nachname</label>
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-floating col-md-6">
                        <input type="email" class="form-control mb-3 shadow" name="email" id="email" placeholder="Email" required>
                        <label class="ms-2" for="email">Email</label>
                    </div>
                    <div class="form-floating col-md-6">
                        <input type="email" class="form-control mb-3 shadow" name="emailConfirmation" id="emailConfirmation" placeholder="Email bestätigen" required>
                        <label class="ms-2" for="email">Email bestätigen</label>
                    </div>
                </div>
                <div class="row">

                    <div class="form-floating col-md-6">
                            <input type="text" minlength="4"class="form-control mb-3 shadow" name="username" id="username" placeholder="username" required>
                            <label class="ms-2" for="username">Username</label>
                        </div>
                    <div class="form-floating col-md-6">
                        <input type="date" class="form-control mb-3 shadow" name="birthdate" id="birthdate" min="01-01-1930" max='<?php echo date("Y-m-d")?>'>
                        <label class="ms-2" for="birthdate" >Geburtsdatum</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-floating col-md-6">
                        <input type="password" minlength="8" class="form-control mb-3 shadow" name="password" id="password" placeholder="Passwort" required>
                        <label class="ms-2" for="password">Passwort</label>
                    </div>
                    
                    <div class="form-floating col-md-6">
                        <input type="password" minlength="8" class="form-control mb-3 shadow" name="passwordConfirmation" id="passwordConfirmation" placeholder="Passwort bestätigen" required>
                        <label class="ms-2" for="passwordConfirmation">Passwort bestätigen</label>
                    </div>
                </div>
                
                <div>
                    <p>Möchten Sie unseren Newsletter abbonieren?</p>
                    <label for="true">Ja</label>
                    <input class="radio" type="radio" id="true" name="newsletter" value="true" required>
                    <label for="false">Nein</label>
                    <input type="radio" id="false" name="newsletter" value="false" required>
                </div>
                <div class="my-2">
                    <button class="btn btn-primary btn-light shadow me-1" type="reset" >Zurücksetzen</button>
                    <button class="btn btn-primary btn-light shadow" type="submit">Registrieren</button>
                </div>
            </div>

            <div class="container mb-3">
                Schon registriert? <a class="site-font-color" href="login.php">Login</a>
            </div>
        </form>
    </div>
  

    <?php
    if (isset($_POST["email"]) && isset($_POST["emailConfirmation"]) && $_POST['email']!= $_POST['emailConfirmation'])
    {
        echo 'Sie haben zwei verschiedene Email-Adressen eingegeben!';
    }
    else if (isset($_POST["password"]) && isset($_POST["passwordConfirmation"]) && $_POST['password']!= $_POST['passwordConfirmation'])
    {
        echo 'Passwörter stimmen nicht überein!';
    }
    else 
    {
    
        if(isset($_POST["formOfAdress"]) && !empty($_POST["formOfAdress"])
            && isset($_POST["name"]) && !empty($_POST["name"])
            && isset($_POST["surname"]) && !empty($_POST["surname"])
            && isset($_POST["username"]) && !empty($_POST["username"])
            && isset($_POST["email"]) && !empty($_POST["email"])
            && isset($_POST["birthdate"]) && !empty($_POST["birthdate"])
            && isset($_POST["password"]) && !empty($_POST["password"])
            && isset($_POST["newsletter"]) && !empty($_POST["newsletter"])) 
        {

            $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);

            //create $db_obj, create sql statement, prepare it and bind the variables to it
            $db_obj = new mysqli($host, $user, $password, $database);
            
            $sql = "INSERT INTO `users` (`form_of_adress`, `name`, `surname`, `username`, `password`, `useremail`, `birth_date`, `has_newsletter`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $db_obj->prepare($sql);

            $stmt-> bind_param( 'ssssssss', $formOfAdress, $name, $surname, $username, $password, $email, $birthdate, $has_newsletter);

            $formOfAdress = $_POST["formOfAdress"];
            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $email = $_POST["email"];
            $birthdate = $_POST["birthdate"];
            $has_newsletter = $_POST["newsletter"];
        

            $duplicateEmail = mysqli_query($db_obj, "SELECT * FROM users WHERE useremail = '$email' ");
            $duplicateUsername = mysqli_query($db_obj, "SELECT * FROM users WHERE username = '$username'");
            if(mysqli_num_rows($duplicateEmail) > 0)
            {
                echo "Email schon registriert!";
            } else if (mysqli_num_rows($duplicateUsername) > 0) 
            {
            echo "Username schon registriert!";
            }
            else 
            {

            if ($stmt->execute()) { echo "<script>location.href='redirect_page.php?type=registration'</script>"; } else { echo "Error"; }
                $stmt->close(); $db_obj->close();
            }
        }
    }
    "</div>";

    include '../includes/footer.php';
    ?>
</body>
</html>