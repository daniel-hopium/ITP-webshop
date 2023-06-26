<?php
// Old values
$street = $currentUser['street'];
$city = $currentUser['city'];
$state = $currentUser['state'];
$zip = $currentUser['zip_code'];
$country = $currentUser['country'];
?>

<div class="container site-font-color">
    <form class="card card-bg shadow-2-strong card-registration mt-3 p- col-md-6" style="border-radius: 15px;"
        action="" method="post">
        <div class="container">
            <div>
                <h1 class="h3 mt-4">Change User Data</h1>
            </div>
            <div class="form-floating col-md-6">
                        <input value="<?php echo $street ?>" type="text" class="form-control mb-3 shadow" name="street" id="street" placeholder="Street" required>
                        <label class="ms-2" for="street"   >Street</label>
                    </div>
                    <div class="form-floating col-md-6">
                        <input value="<?php echo $city ?>" type="text" class="form-control mb-3 shadow" name="city" id="city" placeholder="City" required>
                        <label class="ms-2" for="city"   >City</label>
                    </div>
                    <div class="form-floating col-md-6">
                        <input value="<?php echo $state ?>" type="text" class="form-control mb-3 shadow" name="state" id="state" placeholder="State" required>
                        <label class="ms-2" for="state"   >State</label>
                    </div>
                    <div class="form-floating col-md-6">
                        <input value="<?php echo $zip ?>" type="text" class="form-control mb-3 shadow" name="zip" id="zip" placeholder="Zip" required>
                        <label class="ms-2" for="zip"   >Zip Code</label>
                    </div>
                    <div class="form-floating col-md-6">
                        <input value="<?php echo $country ?>" type="text" class="form-control mb-3 shadow" name="country" id="country" placeholder="Country" required>
                        <label class="ms-2" for="country"   >Country</label>
                    </div>
                    
            </div>

            <div class="m-2">
                <button class="btn btn-lg secondary-bg-color btn-block secondary-color" type="reset">Reset</button>
                <button class="btn btn-lg secondary-bg-color btn-block secondary-color" type="submit">Confirm</button>
            </div>
        </div>
    </form>
</div>

<div class="container mt-4 h4 site-font-color">
    <?php
        if(isset($_POST["street"]) && !empty($_POST["street"])
            && isset($_POST["city"]) && !empty($_POST["city"])
            && isset($_POST["zip"]) && !empty($_POST["zip"])
            && isset($_POST["country"]) && !empty($_POST["country"])
            && isset($_POST["state"]) && !empty($_POST["state"])) {

            $street = $_POST["street"];
            $city = $_POST["city"];
            $country = $_POST["country"];
            $state = $_POST["state"];
            $zip = $_POST["zip"];
            $userid = $currentUser['user_id'];

            $db_obj = new mysqli($host, $user, $password, $database);
            $sql = "UPDATE address SET street=(?), city=(?), zip_code=(?), country=(?), state=(?)  WHERE user_id='$userid'";
            $stmt = $db_obj->prepare($sql);
            $stmt->bind_param('sssss', $street, $city, $zip, $country, $state);

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
