<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kontakt</title>

    <?php
        include '../includes/head.php';
    ?>

</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container site-font-color">
        <div class="card card-bg shadow-2-strong card-registration mt-3 p-2 flex-column "
            style="border-radius: 15px; max-width: 600px;">
            <h1 class="h1">Kontakt</h1>
            <form class="" action="contact.php" method="post">
                <div class="form-floating col-md-12 shadow">
                    <input type="text" class="form-control mb-3" name="name" id="floatingName" placeholder="Name"
                        required>
                    <label class="" for="floatingName">Name</label>
                </div>
                <div class="form-floating col-md-12 shadow">
                    <input type="email" class="form-control mb-3" name="email" id="email" placeholder="Email" required>
                    <label class="" for="email">Email</label>
                </div>
                <div class="form-floating col-md-12 shadow">
                    <input type="text" class="form-control mb-3" name="subject" id="subject" placeholder="Thema"
                        required>
                    <label class="" for="subject">Thema</label>
                </div>
                <div class="form-floating col-md-12 shadow">
                    <textarea class="form-control mb-3" placeholder="Nachricht" name="message" id="message"
                        style="height: 100px" required></textarea>
                    <label for="message">Nachricht</label>
                </div>
                <button class="btn btn-primary mb-3 shadow col-md-3 site-font-color" type="submit"
                    name="submit">Abschicken</button>
            </form>
        </div>
    </div>

    <?php

    if (isset($_POST['submit'])) {

        $db_obj = new mysqli($host, $user, $password, $database);

        $sql = "INSERT INTO `contact_query` (`name`, `email`, `subject`, `message`)
        VALUES (?, ?, ?, ?)";
        
        $stmt = $db_obj->prepare($sql);
        $stmt-> bind_param('ssss', $name, $email, $subject, $message);

        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        if ($stmt->execute()) {
            echo "<script>location.href='redirect_page.php?type=contact'</script>";
        } else {
            echo "Error";
        }
        $stmt->close();
        $db_obj->close();
    }

    include '../includes/footer.php';
    ?>

</body>
</html>