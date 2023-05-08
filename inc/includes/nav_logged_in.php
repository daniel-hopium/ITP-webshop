<?php
$active_page = basename($_SERVER['SCRIPT_NAME']);
include '../../config/check_if_admin.php';
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href='https://fonts.googleapis.com/css?family=Alex Brush' rel='stylesheet'>

<nav class="navbar sticky-top navbar-expand-sm navbar-dark ">
    <div class="container">
        <a href='#' class="navbar-brand mb-0 h1">
            <img class="d-inline-block align top" src="https://icons.iconarchive.com/icons/iconka/business-finance/256/handshake-icon.png" width="30" height="30">
        </a>
        <a href='home.php' class="navbar-brand mb-0 h1 mt-2" id="shopName" style="font-family:'Alex Brush'; font-size: 25px;">Nix Für Arme Shop</a>
        <button type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" class="navbar-toggler" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">

                <?php if ($role == 'administrator') echo "
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
                </li>"
                ?>

                <?php if ($role == 'administrator') echo "
                <li class='nav-item dropdown'>
                    <a href='#' class='nav-link dropdown-toggle' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                        News
                    </a>
                    <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                        <li><a href='newsBlog.php' class='dropdown-item'>Post News Blog</a></li>
                        <li><a href='newsBlog_user.php' class='dropdown-item'>News Blog</a></li>
                        
                    </ul>
                </li>"
                ?>

                <?php if ($role == 'customer' || $role == 'seller') echo "
                <li class='nav-item dropdown'>
                    <a href='#' class='nav-link dropdown-toggle' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                        News
                    </a>
                    <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                        <li><a href='newsBlog_user.php' class='dropdown-item'>News Blog</a></li>
                    </ul>
                </li>"
                ?>

                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Produkt
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a href="prod_categories.php" class="dropdown-item">Produktkategorien</a></li>
                        <li><a href="prod_display.php" class="dropdown-item">Produktdisplay</a></li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="faq.php" class="nav-link <?php if ($active_page == 'faq.php') echo 'fw-bold active '; ?>">
                        FAQ
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="logout.php" class="nav-link  <?php if ($active_page == 'logout.php') echo 'fw-bold active '; ?>">
                        Abmelden
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="shoppingcart.php" class="nav-link <?php if($active_page == 'shoppingcart.php') echo 'fw-bold active '; ?>">
                    Shopping Cart
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="userProfile.php" class="nav-link  <?php if ($active_page == 'userProfile.php') echo 'fw-bold active '; ?>">
                        Mein Profil
                    </a>
                </li>

        </div>
        <form class="d-flex ms-auto my-2 my-lg-0" id="search-form" method=" get" action="search.php">
            <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" id="search-input">
            <button class="btn border border-dark btn btn-light shadow" type="submit">Search</button>
        </form>
        <div id="results-container"></div>
    </div>
</nav>
</div>