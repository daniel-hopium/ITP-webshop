<div class="container site-font-color">
    <form class="card card-bg  shadow-2-strong card-registration mt-3 p- col-md-6" style="border-radius: 15px;"
        action="" method="post">
        <div class="container ">
            <div>
                <h1 class="h3 mt-4">Change Userdata</h1>

                <div class="form-floating col-md-12">
                    <input type="text" minlength="4" class="form-control mb-3 shadow" name="newUsername"
                        id="newUsername" placeholder="Neuer Username" required>
                    <label class="" for="newUsername">New Username</label>
                </div>
                <div class="form-floating col-md-12">
                    <input type="text" minlength="4" class="form-control mb-3 shadow" name="confirmUsername"
                        id="confirmUsername" placeholder="Username bestätigen" required>
                    <label class="" for="confirmUsername">Confirm Username</label>
                </div>

                <div class="my-2">
                    <button class="btn btn-lg secondary-bg-color btn-block secondary-color" type="reset">Reset</button>
                    <button class="btn btn-lg secondary-bg-color btn-block secondary-color" type="submit">Confirm</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="container mt-4 h4 site-font-color">
    <?php
    if(isset($_POST["newUsername"]) && isset($_POST["confirmUsername"])) {
        $newUsername = $_POST["newUsername"];
        $username = $currentUser['username'];
        $duplicateUsername = mysqli_query($db_obj, "SELECT * FROM users WHERE username = '$newUsername'");

        if ($_POST['newUsername']!= $_POST['confirmUsername']) {
            echo 'Deine eingegebene Usernamen stimmt nicht überein!';
        } elseif (mysqli_num_rows($duplicateUsername) > 0) {
            echo "Username schon registriert!";
        } elseif(!empty($_POST["newUsername"]) && !empty($_POST["confirmUsername"])) {

            $db_obj = new mysqli($host, $user, $password, $database);
            $sql = "UPDATE users SET username=(?) WHERE username='$username'";
            $stmt = $db_obj->prepare($sql);
            $stmt-> bind_param('s', $newUsername);

            if ($stmt->execute()) {
                echo "<script>location.href='logout.php?'</script>";
            } else {
                echo "Error";
            }
            $stmt->close();
            $db_obj->close();
        }
    }
    ?>
</div>