<?php
$active_page = basename($_SERVER['SCRIPT_NAME']);
require_once '../../config/check_if_admin.php';
?>

<link href='https://fonts.googleapis.com/css?family=Alex Brush' rel='stylesheet'>

<nav class="navbar sticky-top navbar-expand-sm navbar-dark">
    <div class="container justify-content-center">
        <a href='#' class="navbar-brand mb-0 h1">
            <img class="d-inline-block align top"
                src="https://icons.iconarchive.com/icons/iconka/business-finance/256/handshake-icon.png" width="30"
                height="30"></a>
        <a href='home.php' class="navbar-brand mb-0 h1 mt-2" id="shopName"
            style="font-family:'Alex Brush'; font-size: 25px;">Not For Poor Shop</a>
        <button type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" class="navbar-toggler"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a href="" class="nav-link dropdown-toggle" id="navbarDropdown4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Products
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown4">
                        <li><a href="prod_display.php" class="dropdown-item">All Products</a></li>
                        <li><a href="prod_categories.php" class="dropdown-item">Products by Category</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="newsBlog_user.php" class="nav-link <?php if ($active_page == 'newsBlog_user.php') {
                        echo 'fw-bold active disabled';
                    } ?>">
                        News
                    </a>
                </li>
                <li class="nav-item">
                    <a href="contact.php" class="nav-link <?php if ($active_page == 'contact.php') {
                        echo 'fw-bold active disabled';
                    } ?>">
                        Contact
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="help.php" class="nav-link <?php if ($active_page == 'faq.php') {
                        echo 'fw-bold active disabled';
                    } ?>">
                        Help
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="login.php" class="nav-link  <?php if ($active_page == 'login.php') {
                        echo 'fw-bold active disabled';
                    } ?>">
                        Login
                    </a>
                </li>
            </ul>
        </div>
        </li>
        <ul class="navbar-nav  col-6">
                <li class="nav-item  ">
                    <div class="input-group ">
                        <form class="d-flex col-12" method="post" action="search.php">
                            <input id="search-input" type="text" class="form-control form-control-sm" name="search" placeholder="Search" aria-describedby="search-button" />
                            <button id="search-button" name="submit-search" type="submit" class="btn bg-light btn-sm">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
    </div>
</nav>

<script src="scripts.js"></script>
