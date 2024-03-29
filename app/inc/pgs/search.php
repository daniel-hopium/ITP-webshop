<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search page</title>
    <style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    main {
        flex: 1;
    }

    .card-container {
        display: flex;
        justify-content: center;
    }

    .card {
        min-height: 600px;
    }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php
    // Database connection
    $host = "localhost";
    $user = "webshop_user";
    $password = "admin";
    $database = "webshop";

    $conn = new mysqli($host, $user, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    include '../includes/head.php';

    if (isset($_POST['submit-search'])) {
        $search = mysqli_real_escape_string($conn, $_POST['search']);
    
        // Redirect to "newsBlog_user.php" page if search query matches "news blog"
        if (strtolower($search) == "news blog") {
            echo '<script>window.location.href = "newsBlog_user.php";</script>';
            exit();
        }
        if (strtolower($search) == "products") {
            echo '<script>window.location.href = "prod_display.php";</script>';
            exit();
        }
    
        if (strtolower($search) == "category") {
            echo '<script>window.location.href = "prod_categories.php";</script>';
            exit();
        }
    }
    
    ?>

    <main>
        <div class="container site-font-color">
            <div class="row mt-4 card-container">
                <div class="card card-bg shadow-2-strong card-registration mt-3 p-2 flex-column "
                    style="border-radius: 15px; max-width: 600px;">
                    <div>
                        <h1 style="text-align: center">Search page</h1>
                        <br>
                        <div id="results-container" style="margin-left: 20px;">
                            <?php
                            if (isset($_POST['submit-search'])) {
                                $search = mysqli_real_escape_string($conn, $_POST['search']);


                                $sql = "(SELECT created, title, content, NULL as category_name, NULL as contact_name, 
                                NULL as email, NULL as subject, NULL as message, NULL as name, NULL as surname, NULL as username, NULL as useremail, 
                                'news blog' as type, 'blog_news' as source FROM blog_news WHERE created LIKE '%$search%' OR title LIKE '%$search%' OR content LIKE '%$search%')
        UNION 
        (SELECT NULL as created, NULL as title, NULL as content, name AS category_name, NULL as contact_name, NULL as email, NULL as subject, NULL as message, NULL as name, NULL as surname, NULL as username, NULL as useremail, 'categories' as type, 'categories' as source FROM categories WHERE name LIKE '%$search%')
        UNION 
        (SELECT created, NULL as title, NULL as content, NULL as category_name, name AS contact_name, email, subject, message, NULL as name, NULL as surname, NULL as username, NULL as useremail, 'contact_query' as type, 'contact_query' as source FROM contact_query WHERE created LIKE '%$search%' OR name LIKE '%$search%' OR email LIKE '%$search%' OR subject LIKE '%$search%' OR message LIKE '%$search%')
        UNION
        (SELECT id as created, name as title, description as content, price as category_name, NULL as contact_name, NULL as email, NULL as subject, NULL as message, NULL as name, NULL as surname, NULL as username, NULL as useremail, 'products' as type, 'products' as source FROM products WHERE name LIKE '%$search%' OR description LIKE '%$search%')
        UNION
        (SELECT NULL as created, NULL as title, NULL as content, NULL as category_name, NULL as contact_name, NULL as email, NULL as subject, NULL as message, name, surname, username, useremail, 'users' as type, 'users' as source FROM users WHERE name LIKE '%$search%' OR surname LIKE '%$search%' OR username LIKE '%$search%' OR useremail LIKE '%$search%')";


                                $result = mysqli_query($conn, $sql);
                                $queryResults = mysqli_num_rows($result);

                                if ($queryResults > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        if ($row['source'] == 'blog_news') {
                                            echo "<div>
                                    <h3>News Blog</h3>
                                    <h3>" . $row['title'] . "</h3>
                                    <p>" . $row['content'] . "</p>
                                    <p>Created: " . $row['created'] . "</p>
                                    <p>Type: " . $row['type'] . "</p>
                                            </div>";
                                        } elseif ($row['source'] == 'categories') {
                                            echo "<div>
                                    <h3>Categories</h3>
                                    <p>" . $row['category_name'] . "</p>
                                    <p>Type: " . $row['type'] . "</p>
                                            </div>";
                                        } elseif ($row['source'] == 'contact_query') {
                                            echo "<div>
                                    <h3>Contact Query</h3>
                                    <p>Created: " . $row['created'] . "</p>
                                    <p>Name: " . $row['contact_name'] . "</p>
                                    <p>Email: " . $row['email'] . "</p>
                                    <p>Subject: " . $row['subject'] . "</p>
                                    <p>Message: " . $row['message'] . "</p>
                                    <p>Type: " . $row['type'] . "</p>
                                            </div>";
                                        } elseif ($row['source'] == 'news') {
                                            echo "<div>
                                    <h3>News</h3>
                                    <h3>" . $row['title'] . "</h3>
                                    <p>" . $row['content'] . "</p>
                                    <p>Created: " . $row['created'] . "</p>
                                    <p>Type: " . $row['type'] . "</p>
                                            </div>";
                                        } elseif ($row['source'] == 'products') {
                                            //$id = $row['created'];
                                            echo "<div>
                                    <h3>Products</h3>";

                                            echo '<div class="col mb-4">';
                                            echo '<div class="card h-100">';
                                            echo '<img src="https://via.placeholder.com/400x300/2D2D2D/FFFFFF/?text=' . $row['title'] . '" class="card-img-top" alt="' . $row['title'] . '">';
                                            echo '<div class="card-body bg-light">';
                                            echo '<h2 class="card-title text-center mb-3">' . $row['title'] . '</h2>';
                                            echo '<p class="card-text">' . $row['content'] . '</p>';
                                            echo '<form method="post" action="addtocart.php">';
                                            echo '<a href="prod_details.php?id=' . @$row['created'] . '" class="btn btn-lg secondary-bg-color btn-block secondary-color ms-auto">Details ansehen</a>';
                                            echo '<div class="input-group my-1">';
                                            echo '<label class="input-group-text" for="quantity-' . $row['created'] . '">Quantity:</label>';
                                            echo '<input type="number" class="form-control" id="quantity-' . $row['created'] . '" name="quantity" min="1" value="1">';
                                            echo '</div>';
                                            echo '<input type="hidden" name="product_id" value="' . $row['created'] . '">';
                                            echo '<button type="submit" class="btn btn-lg secondary-bg-color btn-block secondary-color">Zum Warenkorb hinzufügen</button>';
                                            echo '</form>';
                                            echo '<span class="text-end h4">€ ' . number_format($row['category_name'], 2, ',', '.') . '</span>';
                                            echo '</div></div></div>';
                                        } elseif ($row['source'] == 'users') {
                                            echo "<div>
                                    <h3>Users</h3>
                                    <p>Name: " . $row['name'] . "</p>
                                    <p>Surname: " . $row['surname'] . "</p>
                                    <p>Username: " . $row['username'] . "</p>
                                    <p>Email: " . $row['useremail'] . "</p>
                                    <p>Type: " . $row['type'] . "</p>
                                            </div>";
                                        }
                                    }
                                } else {
                                    echo "There are no results matching your search!";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <br>
    <br>
    <?php include '../includes/footer.php'; ?>
</body>

</html>