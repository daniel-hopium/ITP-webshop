<!doctype html>
<html lang="en">

<head>
    <title>Registration</title>

    <?php
    include '../includes/head.php';
    require_once('../../config/dbaccess.php');
    ?>

</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container site-font-color">
        <form class="card card-bg shadow-2-strong card-registration mt-3 p-2" style="border-radius: 15px;" action="" method="post">
            <div class="container">
                <div>
                    <h1 class="h3 mt-4">Registration</h1>
                </div>
                <div class="form-floating form-label select-label shadow">
                    <select name="formOfAddress" id="floatingSelect" class="form-select">
                        <option label="Mr" value="Mr">Mr</option>
                        <option label="Ms" value="Ms">Ms</option>
                        <option label="Other" value="Other">Other</option>
                    </select>
                    <label for="floatingSelect">Title</label>
                </div>
                <div class="row">
                    <div class="form-floating col-md-6">
                        <input type="text" class="form-control mb-3 shadow" name="name" id="name" placeholder="First Name" required>
                        <label class="ms-2" for="floatingSurname">First Name</label>
                    </div>
                    <div class="form-floating col-md-6">
                        <input type="text" class="form-control mb-3 shadow" name="surname" id="surname" placeholder="Last Name" required>
                        <label class="ms-2" for="floatingName">Last Name</label>
                    </div>
                </div>

                <div class="row">
                    <div class="form-floating col-md-6">
                        <input type="email" class="form-control mb-3 shadow" name="email" id="email" placeholder="Email" required>
                        <label class="ms-2" for="email">Email</label>
                    </div>
                    <div class="form-floating col-md-6">
                        <input type="email" class="form-control mb-3 shadow" name="emailConfirmation" id="emailConfirmation" placeholder="Confirm Email" required>
                        <label class="ms-2" for="email">Confirm Email</label>
                    </div>
                </div>
                <div class="row">

                    <div class="form-floating col-md-6">
                        <input type="text" minlength="4" class="form-control mb-3 shadow" name="username" id="username" placeholder="Username" required>
                        <label class="ms-2" for="username">Username</label>
                    </div>
                    <div class="form-floating col-md-6">
                        <input type="date" class="form-control mb-3 shadow" name="birthdate" id="birthdate" min="1930-01-01" max="<?php echo date('Y-m-d') ?>">
                        <label class="ms-2" for="birthdate">Birthdate</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-floating col-md-6">
                        <input type="password" minlength="8" class="form-control mb-3 shadow" name="password" id="password" placeholder="Password" required>
                        <label class="ms-2" for="password">Password</label>
                    </div>

                    <div class="form-floating col-md-6">
                        <input type="password" minlength="8" class="form-control mb-3 shadow" name="passwordConfirmation" id="passwordConfirmation" placeholder="Confirm Password" required>
                        <label class="ms-2" for="passwordConfirmation">Confirm Password</label>
                    </div>
                </div>

                <div>
                    <p>Would you like to subscribe to our newsletter?</p>
                    <label for="true">Yes</label>
                    <input class="radio" type="radio" id="true" name="newsletter" value="true" required>
                    <label for="false">No</label>
                    <input type="radio" id="false" name="newsletter" value="false" required>
                </div>
                <div class="my-2">
                    <button class="btn btn-primary btn-light shadow me-1" type="reset">Reset</button>
                    <button class="btn btn-primary btn-light shadow" type="submit">Register</button>
                </div>
            </div>

            <div class="container mb-3">
                Already registered? <a class="site-font-color" href="login.php">Login</a>
            </div>
        </form>
    </div>


    <?php
    if (isset($_POST["email"]) && isset($_POST["emailConfirmation"]) && $_POST['email'] != $_POST['emailConfirmation']) {
        echo 'You have entered two different email addresses!';
    } elseif (isset($_POST["password"]) && isset($_POST["passwordConfirmation"]) && $_POST['password'] != $_POST['passwordConfirmation']) {
        echo 'Passwords do not match!';
    } else {

        if (isset($_POST["formOfAddress"]) && !empty($_POST["formOfAddress"]) && isset($_POST["name"]) && !empty($_POST["name"]) && isset($_POST["surname"]) && !empty($_POST["surname"]) && isset($_POST["username"]) && !empty($_POST["username"]) && isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["birthdate"]) && !empty($_POST["birthdate"]) && isset($_POST["password"]) && !empty($_POST["password"]) && isset($_POST["newsletter"]) && !empty($_POST["newsletter"])) {

            $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);

            //create $db_obj, create sql statement, prepare it and bind the variables to it
            $db_obj = new mysqli($host, $user, $password, $database);

            $sql = "INSERT INTO `users` (`form_of_address`, `name`, `surname`, `username`, `password`, `user_email`, `birth_date`, `has_newsletter`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $db_obj->prepare($sql);

            $stmt->bind_param('ssssssss', $formOfAddress, $name, $surname, $username, $password, $email, $birthdate, $has_newsletter);

            $formOfAddress = $_POST["formOfAddress"];
            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $email = $_POST["email"];
            $birthdate = $_POST["birthdate"];
            $has_newsletter = $_POST["newsletter"];


            $duplicateEmail = mysqli_query($db_obj, "SELECT * FROM users WHERE user_email = '$email' ");
            $duplicateUsername = mysqli_query($db_obj, "SELECT * FROM users WHERE username = '$username'");
            if (mysqli_num_rows($duplicateEmail) > 0) {
                echo "Email already registered!";
            } elseif (mysqli_num_rows($duplicateUsername) > 0) {
                echo "Username already registered!";
            } else {

                if ($stmt->execute()) {
                    echo "<script>location.href='redirect_page.php?type=registration'</script>";
                } else {
                    echo "Error";
                }
                $stmt->close();
                $db_obj->close();
            }
        }
    }
    "</div>";

    include '../includes/footer.php';
    ?>
</body>

</html>
