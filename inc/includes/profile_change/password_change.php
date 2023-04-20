<div class = "container site-font-color" >
    <form class="card card-bg  shadow-2-strong card-registration mt-3 p- col-md-6" style="border-radius: 15px;"  action="" method="post">
        <div class="container ">
            <div>
                <h1 class="h3 mt-4">Passwort ändern</h1>
            </div>
                <div class="form-floating col-md-12">
                    <input type="password" class="form-control mb-3 shadow" name="oldPassword" id="oldPassword" placeholder="Altes Passwort" required>
                    <label class="" for="oldPassword">Altes Passwort</label>
                </div>
                <div class="form-floating col-md-12">
                    <input type="password" minlength="8"class="form-control mb-3 shadow" name="newPassword" id="newPassword" placeholder="Neues Passwort" required>
                    <label class="" for="newPassword">Neues Passwort</label>
                </div>
                <div class="form-floating col-md-12">
                    <input type="password" minlength="8"class="form-control mb-3 shadow" name="confirmPassword" id="confirmPassword" placeholder="Passwort bestätigen" required>
                    <label class="" for="confirmPassword">Passwort bestätigen</label>
                </div>
            <div class="my-2">
                <button class="btn btn-primary btn-light shadow me-1" type="reset" >Zurücksetzen</button>
                <button class="btn btn-primary btn-light shadow" type="submit">Bestätigen</button>
            </div>
        </div>
    </form>
</div>

<div class="container mt-4 h4 site-font-color">
    <?php
    
    if (isset($_POST["newPassword"]) && isset($_POST["confirmPassword"]) && $_POST['newPassword']!= $_POST['confirmPassword'])
    {
        echo 'Passwörter stimmen nicht überein!';
    }
    else if(isset($_POST["newPassword"]) && isset($_POST["oldPassword"]) && $_POST["newPassword"] == $_POST['oldPassword'])
    {
        echo "Dein altes und neues Passwort sind gleich. Bitte nimm ein neues Passwort!";
    }
    else if(isset($_POST["oldPassword"]) && !empty($_POST["oldPassword"])
        && isset($_POST["newPassword"]) && !empty($_POST["newPassword"])) 
    {
    
        $oldPassword = $_POST["oldPassword"];
        $newPassword = $_POST["newPassword"];
        $username = $currentUser['username'];
        $hashvalue= ($currentUser['password']);

        if(password_verify($oldPassword, $hashvalue)) 
        {
            
            $_POST["newPassword"] = password_hash($_POST["newPassword"], PASSWORD_DEFAULT);
            
    
            $db_obj = new mysqli($host, $user, $password, $database);

            $sql = "UPDATE users SET password=(?) WHERE username='$username'";

            $stmt = $db_obj->prepare($sql);
            $stmt-> bind_param( 's', $newPassword);

            if ($stmt->execute()) { echo "<script>location.href='redirect_page.php?type=profile'</script>"; } 
            else { echo "Error"; }
            $stmt->close(); $db_obj->close();
        } 
        else {
                echo "Falsches Passwort. Versuche es bitte nochmal!";
        }
    }
    ?>
</div>