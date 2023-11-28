<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <title>User</title>

    <?php
   include '../includes/head.php';
    if(!isset($_SESSION['username'])  || ($_SESSION['username'] != 'admin')) {
        header('Location: home.php');
    }
    require_once('../../config/dbaccess.php');

    $customerID = $_GET['user'];
 
    $db_obj = new mysqli($host, $user, $password, $database);
                
    $sql =  "SELECT * FROM users WHERE id='$customerID'";
    $result = $db_obj->query($sql);
    $result = $result->fetch_assoc();

    $status = $result['status'];
    $formOfAdress = $result['form_of_adress'];
    $name = $result['name'];
    $surname = $result['surname'];
    $old_username = $result['username'];
    $old_useremail = $result['useremail'];
    $birthdate = $result['birth_date'];
    $has_newsletter = $result['has_newsletter'];
    ?>
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container site-font-color">
        <form class="card card-bg  shadow-2-strong card-registration mt-3 p-2" style="border-radius: 15px;" action=""
            method="post">
            <div class="container ">
                <div>
                    <h1 class="h3 mt-4">User Editing</h1>
                </div>
                <div class=" form-floating form-label select-label shadow col-md-3 ">
                    <select name="formOfAdress" id="floatingSelect" class="form-select">
                        <option selected
                            value='<?php echo $formOfAdress ?>'>
                            <?php echo $formOfAdress ?>
                        </option>
                        <option label="Mr" value="Mr">Mr</option>
                        <option label="Mrs" value="Mrs">Mrs</option>
                        <option label="Other" value="Other">Other</option>
                    </select>
                    <label for="floatingSelect">Title</label>
                </div>
                <div class="row">
                    <div class="form-floating col-md-6">
                        <input type="text" class="form-control mb-3 shadow" name="name" id="name"
                            value="<?php echo $name ?>" required>
                        <label class="ms-2" for="floatingSurname">First Name</label>
                    </div>
                    <div class="form-floating col-md-6">
                        <input type="text" class="form-control mb-3 shadow" name="surname" id="surname"
                            value="<?php echo $surname ?>" required>
                        <label class="ms-2" for="floatingName">Last Name</label>
                    </div>
                </div>

                <div class="row">
                    <div class="form-floating col-md-6">
                        <input type="email" class="form-control mb-3 shadow" name="email" id="email"
                            value="<?php echo $old_useremail ?>"
                            required>
                        <label class="ms-2" for="email">Email</label>
                    </div>

                </div>
                <div class="row">

                    <div class="form-floating col-md-6">
                        <input type="text" minlength="4" class="form-control mb-3 shadow" name="username" id="username"
                            value="<?php echo $old_username ?>"
                            required>
                        <label class="ms-2" for="username">Username</label>
                    </div>
                    <div class="form-floating col-md-6">
                        <input type="date" class="form-control mb-3 shadow" name="birthdate" id="birthdate"
                            min="1930-01-01"
                            value="<?php echo $birthdate ?>">
                        <label class="ms-2" for="birthdate">Birth Date</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-floating col-md-6">
                        <input type="password" minlength="8" class="form-control mb-3 shadow" name="password" id="password">
                        <label class="ms-2" for="password">Password</label>
                    </div>
                    <div class=" form-floating form-label select-label  col-md-6">
                        <select name="status" id="status" class="form-select">
                            <option selected
                                value='<?php echo $status ?>'>
                                <?php echo $status ?>
                            </option>
                            <option label="Active" value="active">Active</option>
                            <option label="Inactive" value="inactive">Inactive</option>
                        </select>
                        <label class="ms-2" for="status">Status</label>
                    </div>

                </div>
                <div class=" form-floating form-label select-label  col-md-3">
                    <select name="newsletter" id="newsletter" class="form-select">
                        <option selected
                            value='<?php echo $has_newsletter ?>'>
                            <?php echo $has_newsletter ?>
                        </option>
                        <option label="No" value="false">No</option>
                        <option label="Yes" value="true">Yes</option>
                    </select>
                    <label class="" for="newsletter">Newsletter</label>
                </div>

                <button class="btn btn-primary btn-light shadow" type="submit">Save Changes</button>
            </div>
    </div>
    </form>
    </div>

    <?php


if (isset($_POST["status"]) && !empty($_POST["status"])
    && isset($_POST["formOfAdress"]) && !empty($_POST["formOfAdress"])
    && isset($_POST["name"]) && !empty($_POST["name"])
    && isset($_POST["surname"]) && !empty($_POST["surname"])
    && isset($_POST["username"]) && !empty($_POST["username"])
    && isset($_POST["email"]) && !empty($_POST["email"])
    && isset($_POST["birthdate"]) && !empty($_POST["birthdate"])
    && isset($_POST["newsletter"]) && !empty($_POST["newsletter"])) {

    //create $db_obj, create sql statement, prepare it and bind the variables to it
    $db_obj = new mysqli($host, $user, $password, $database);

    $sql = "UPDATE users SET status=(?), form_of_adress=(?), name=(?), surname=(?), username=(?), password=(?), useremail=(?), birth_date=(?), has_newsletter=(?) WHERE id='$customerID'";

    $stmt = $db_obj->prepare($sql);

    $stmt->bind_param('sssssssss', $status, $formOfAdress, $name, $surname, $username, $password, $email, $birthdate, $has_newsletter);

    $status = $result['status'];
    $formOfAdress = $_POST["formOfAdress"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $birthdate = $_POST["birthdate"];
    $has_newsletter = $_POST["newsletter"];


    if (empty($_POST["password"])) {
        
        $password = $result['password'];
        
    } else {
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    }

    $duplicateEmail = mysqli_query($db_obj, "SELECT * FROM users WHERE useremail = '$email' ");
    $duplicateUsername = mysqli_query($db_obj, "SELECT * FROM users WHERE username = '$username'");
    if ((mysqli_num_rows($duplicateEmail) > 0) && $email != $old_useremail) {
        echo "Email already registered!";
    } elseif ((mysqli_num_rows($duplicateUsername) > 0) && $username != $old_username) {
        echo "Username already registered!";
    } else {
        if ($stmt->execute()) {
            echo "<script>location.href='redirect_page.php?type=userchange'</script>";
        } else {
            echo "Error";
        }
        $stmt->close();
        $db_obj->close();
    }
}
"</div>";

    include '../includes/footer.php';
    ?>
</body>

</html>
