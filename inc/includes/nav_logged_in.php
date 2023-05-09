<?php
$active_page = basename($_SERVER['SCRIPT_NAME']);
include '../../config/check_if_admin.php';
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href='https://fonts.googleapis.com/css?family=Alex Brush' rel='stylesheet'>

<nav class="navbar sticky-top navbar-expand-sm navbar-dark  ">
    <div class="container ">
        <a href='#' class="navbar-brand mb-0 h1">
            <img class="d-inline-block align top"
                src="https://icons.iconarchive.com/icons/iconka/business-finance/256/handshake-icon.png" width="30"
                height="30">
        </a>
        <a href='home.php' class="navbar-brand mb-0 h1 mt-2" id="shopName"
            style="font-family:'Alex Brush'; font-size: 25px;">Nix Für Arme Shop</a>
        <button type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" class="navbar-toggler"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">

                <?php if ($role == 'administrator') {
                    echo "
                <li class='nav-item dropdown'>
                    <a href='#' class='nav-link dropdown-toggle' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                        Administration
                    </a>
                    <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                        <li><a href='product_adminpage.php' class='dropdown-item'>Produktverwaltung</a></li>
                        <li><a href='product_upload.php' class='dropdown-item'>Produktupload</a></li>
                        <li><a href='finance_overview.php' class='dropdown-item'>Finanzübersicht</a></li>
                        <li><a href='user_overview.php' class='dropdown-item'>Userverwaltung</a></li>
                        <li><a href='contact_overview.php' class='dropdown-item'>Anfragenverwaltung</a></li>
                    </ul>
                </li>";
                }
?>

                <?php if ($role == 'administrator') {
                    echo "
                <li class='nav-item dropdown'>
                    <a href='#' class='nav-link dropdown-toggle' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                        News
                    </a>
                    <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                        <li><a href='newsBlog.php' class='dropdown-item'>Post News Blog</a></li>
                        <li><a href='newsBlog_user.php' class='dropdown-item'>News Blog</a></li>
                        
                    </ul>
                </li>";
                }
?>

                <?php if ($role == 'customer' || $role == 'seller') {
                    echo "
                <li class='nav-item dropdown'>
                    <a href='#' class='nav-link dropdown-toggle' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                        News
                    </a>
                    <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                        <li><a href='newsBlog_user.php' class='dropdown-item'>News Blog</a></li>
                    </ul>
                </li>";
                }
?>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Produkt
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a href="prod_categories.php" class="dropdown-item">Produktkategorien</a></li>
                        <li><a href="prod_display.php" class="dropdown-item">Produktdisplay</a></li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="logout.php" class="nav-link  <?php if ($active_page == 'logout.php') {
                        echo 'fw-bold active ';
                    } ?>">
                        Abmelden
                    </a>
                </li>
                <li>
                    <div class="d-inline-flex position-relative">
                        <a href="shoppingcart.php">
                            <span
                                class="  badge position-absolute mt-1 start-100 translate-middle shadow p-1 border border-dark bg-danger rounded-circle"
                                id="shopping-cart-amount">

                            </span>
                            <img class="" src=" ../../res/img/shopping-cart.png" alt="Avatar"
                                style="width: 45px; height: 45px;">
                        </a>
                    </div>
                </li>

        </div>
        <form class="d-flex ms-auto my-2 my-lg-0" method="post" action="search.php">
            <input class="form-control me-2" type="text" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn btn-light" type="submit" name="submit-search">Search</button>
        </form>
        <a href="userProfile.php">
            <img class="rounded shadow-4 float-end" src="../../res/img/profile-picture.png" alt="Avatar"
                style="width: 50px; height: 50px;">
        </a>
</nav>
</div>