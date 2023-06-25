<!DOCTYPE html>
<html lang="en">

<head>
    <title>Inquiry Overview</title>

    <?php
        include '../includes/head.php';
    if(!isset($_SESSION['username'])  || ($_SESSION['username'] != 'admin')) {
        header('Location: home.php');
    }
    ?>

</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container site-font-color">
        <h1 class="h1 mt-5 text-center">Inquiry Overview:</h1>

        <?php
        require_once('../../config/dbaccess.php');

    $userID = $currentUser['id'];
    $db_obj = new mysqli($host, $user, $password, $database);
                    
    $sql =  "SELECT * FROM contact_query ORDER BY ID DESC";
    $result = $db_obj->query($sql);

    while ($row = $result->fetch_assoc()) {

        $field1name = $row["id"];
        $field2name = $row["created"];
        $field3name = $row["name"];
        $field4name = $row["email"];
        $field5name = $row["subject"];
        $field6name = $row["message"];

        echo "
            <div class='accordion-item'>
                <h2 class='accordion-header' id='panelsStayOpen-headingOne'>
                    <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#panelsStayOpen-collapseOne' aria-expanded='false' aria-controls='panelsStayOpen-collapseOne'>
                    <strong class='me-1'>ID:</strong>  $field1name <strong class='ms-3 me-2'>Submission Date:</strong> $field2name 
                </button>
                </h2>
                <div id='panelsStayOpen-collapseOne' class='accordion-collapse collapse' aria-labelledby='panelsStayOpen-headingOne'>
                    <div class='accordion-body'>
                        <strong class='h2'>Subject: $field5name</strong> <br>
                        <strong>Name:</strong> $field3name <strong>Email:</strong> $field4name <br> 
                        $field6name 
                    </div>
                </div>
            </div>";
    }
    ?>
    </div>

    <?php
    include '../includes/footer.php';
    ?>
</body>
</html>
