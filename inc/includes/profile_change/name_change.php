<?php
// Old values
$formOfAdress = $currentUser['form_of_adress'];
$name = $currentUser['name'];
$surname = $currentUser['surname'];
$birthdate = $currentUser['birth_date'];
$has_newsletter = $currentUser['has_newsletter'];
?>

<div class="container site-font-color">
    <form class="card card-bg shadow-2-strong card-registration mt-3 p- col-md-6" style="border-radius: 15px;"
        action="" method="post">
        <div class="container">
            <div>
                <h1 class="h3 mt-4">Change User Data</h1>
            </div>
            <div class="form-floating form-label select-label shadow">
                <select name="formOfAdress" id="floatingSelect" class="form-select">
                    <option selected
                        value='<?php echo $formOfAdress ?>'>
                        <?php echo $formOfAdress ?>
                    </option>
                    <option label="Herr" value="Herr">Mr.</option>
                    <option label="Frau" value="Frau">Mrs.</option>
                    <option label="Divers" value="Divers">Other</option>
                </select>
                <label for="floatingSelect">Salutation</label>
            </div>
            <div class="form-floating col-md-12">
                <input type="text" class="form-control mb-3 shadow" name="name" id="name"
                    value="<?php echo $name ?>" required>
                <label class="" for="name">Name</label>
            </div>
            <div class="form-floating col-md-12">
                <input type="text" class="form-control mb-3 shadow" name="surname" id="surname"
                    value="<?php echo $surname ?>" required>
                <label class="" for="surname">Surname</label>
            </div>
            <div class="row">
                <div class="form-floating col-md-6">
                    <input type="date" class="form-control mb-3 shadow" name="birthdate" id="birthdate" min="1930-01-01"
                        value="<?php echo $birthdate ?>">
                    <label class="ms-2" for="birthdate">Birthdate</label>
                </div>
                <div class="form-floating form-label select-label col-md-6">
                    <select name="newsletter" id="newsletter" class="form-select">
                        <option selected
                            value='<?php echo $has_newsletter ?>'>
                            <?php echo $has_newsletter ?>
                        </option>
                        <option label="No" value="false">No</option>
                        <option label="Yes" value="true">Yes</option>
                    </select>
                    <label class="ms-2" for="newsletter">Newsletter</label>
                </div>
            </div>

            <div class="my-2">
                <button class="btn btn-primary btn-light shadow me-1" type="reset">Reset</button>
                <button class="btn btn-primary btn-light shadow" type="submit">Confirm</button>
            </div>
        </div>
    </form>
</div>

<div class="container mt-4 h4 site-font-color">
    <?php
        if(isset($_POST["name"]) && !empty($_POST["name"])
            && isset($_POST["surname"]) && !empty($_POST["surname"])
            && isset($_POST["formOfAdress"]) && !empty($_POST["formOfAdress"])
            && isset($_POST["birthdate"]) && !empty($_POST["birthdate"])
            && isset($_POST["newsletter"]) && !empty($_POST["newsletter"])) {

            $formOfAdress = $_POST["formOfAdress"];
            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $birth_date = $_POST["birthdate"];
            $has_newsletter = $_POST["newsletter"];
            $username = $currentUser['username'];

            $db_obj = new mysqli($host, $user, $password, $database);
            $sql = "UPDATE users SET name=(?), surname=(?), form_of_adress=(?), birth_date=(?), has_newsletter=(?)  WHERE username='$username'";
            $stmt = $db_obj->prepare($sql);
            $stmt->bind_param('sssss', $name, $surname, $formOfAdress, $birth_date, $has_newsletter);

            if ($stmt->execute()) {
                echo "<script>location.href='redirect_page.php?type=profile'</script>";
            } else {
                echo "Error";
            }
            $stmt->close();
            $db_obj->close();

        }
    ?>
</div>
