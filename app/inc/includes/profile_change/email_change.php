<div class="container site-font-color">
    <form class="card card-bg  shadow-2-strong card-registration mt-3 p- col-md-6" style="border-radius: 15px;"
        action="" method="post">
        <div class="container ">
            <div>
                <h1 class="h3 mt-4">Change Email</h1>
            </div>
            <div class="form-floating col-md-12">
                <input type="email" class="form-control mb-3 shadow" name="newEmail" id="newEmail"
                    placeholder="Neue Email" required>
                <label class="" for="newEmail">New Mail Adress</label>
            </div>
            <div class="form-floating col-md-12">
                <input type="email" class="form-control mb-3 shadow" name="confirmEmail" id="confirmEmail"
                    placeholder="Email bestätigen" required>
                <label class="" for="confirmEmail">Confirm Email</label>
            </div>
            <div class="my-2">
                <button class="btn btn-lg secondary-bg-color btn-block secondary-color" type="reset">Reset</button>
                <button class="btn btn-lg secondary-bg-color btn-block secondary-color" type="submit">Confirm</button>
            </div>
        </div>
    </form>
</div>

<div class="container mt-4 h4 site-font-color">
    <?php
        if(isset($_POST["newEmail"]) && !empty($_POST["newEmail"])
        && isset($_POST["confirmEmail"]) && !empty($_POST["confirmEmail"])) {

            $newEmail = $_POST["newEmail"];
            $username = $currentUser['username'];
            $duplicateEmail = mysqli_query($db_obj, "SELECT * FROM users WHERE useremail = '$newEmail' ");

            if (isset($_POST["newEmail"]) && isset($_POST["confirmEmail"]) && $_POST['newEmail']!= $_POST['confirmEmail']) {
                echo 'Deine eingegebene Email stimmt nicht überein!';
            } elseif(mysqli_num_rows($duplicateEmail) > 0) {
                echo "Email schon registriert!";
            } else {
                $db_obj = new mysqli($host, $user, $password, $database);

                $sql = "UPDATE users SET useremail=(?) WHERE username='$username'";

                $stmt = $db_obj->prepare($sql);
                $stmt-> bind_param('s', $newEmail);

                if ($stmt->execute()) {
                    echo "<script>location.href='redirect_page.php?type=profile'</script>";
                } else {
                    echo "Error ";
                }
                $stmt->close();
                $db_obj->close();
            }
        }
    ?>
</div>