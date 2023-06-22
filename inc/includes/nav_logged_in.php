<?php
$active_page = basename($_SERVER['SCRIPT_NAME']);
include '../../config/check_if_admin.php';
include '../../config/check_shoppingcart_amount.php';
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href='https://fonts.googleapis.com/css?family=Alex Brush' rel='stylesheet'>


<nav class="navbar sticky-top navbar-expand-sm navbar-dark  " id="nav-primary">

    <div class="container ">
        <a href='#' class="navbar-brand mb-0 h1">
            <img class="d-inline-block align top" src="https://icons.iconarchive.com/icons/iconka/business-finance/256/handshake-icon.png" width="20" height="20">
        </a>
        <a href='home.php' class="navbar-brand mb-0 h1 mt-2" id="shopName" style="font-family:'Alex Brush'; font-size: 20px;">Nix Für Arme Shop</a>
        <button type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" class="navbar-toggler" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav align-items-center col-9">
                <li class="nav-item col-12 ">
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
            <ul class="navbar-nav align-items-center  ms-auto">
                <li class="nav-item ">
                    <div class="container ">
                        <a href="userProfile.php" class="">
                            <i class="fa-solid fa-user fa-xl " style="color: #ffffff;"></i>
                    </div>
                </li>

                <li class="nav-item">
                    <div class="container">
                        <div class=" position-relative ">
                            <a href="shoppingcart.php">
                                <?php
                                if ($currentShoppingcartAmount != 0) {
                                    echo '
                                    <span
                                        class="  badge position-absolute mt-1 start-100 translate-middle shadow p-1 border border-dark tertiary-bg-color rounded-circle"
                                        id="shopping-cart-amount">';
                                    echo $currentShoppingcartAmount;
                                    echo '
                                    </span>
                                ';
                                }
                                ?>
                                <i class="fa-solid fa-cart-shopping fa-xl" style="color: #ffffff;"></i>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
</nav>

<nav id="nav-secondary" class="navbar  navbar-expand-sm navbar-dark  ">
    <div class="container ">
        <ul class="navbar-nav">

            <?php if ($role == 'administrator') {
                echo "
                <li class='nav-item dropdown'>
                    <a href='' class='nav-link dropdown-toggle' id='navbarDropdown1' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                        Administration
                    </a>
                    <ul class='dropdown-menu' aria-labelledby='navbarDropdown1'>
                        <li><a href='product_adminpage.php' class='dropdown-item'>Produktverwaltung</a></li>
                        <li><a href='product_upload.php' class='dropdown-item'>Produktupload</a></li>
                        <li><a href='finance_overview.php' class='dropdown-item'>Finanzübersicht</a></li>
                        <li><a href='user_overview.php' class='dropdown-item'>Userverwaltung</a></li>
                        <li><a href='contact_overview.php' class='dropdown-item'>Anfragenverwaltung</a></li>
                        <li><a href='order_overview.php' class='dropdown-item'>Bestellübersicht</a></li>
                    </ul>
                </li>";
            }
            ?>
            <?php if ($role == 'seller') {
                echo "
                <li class='nav-item dropdown'>
                    <a href='' class='nav-link dropdown-toggle' id='navbarDropdown1' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                        Administration
                    </a>
                    <ul class='dropdown-menu' aria-labelledby='navbarDropdown1'>
                        <li><a href='product_sellerpage.php' class='dropdown-item'>Produktverwaltung</a></li>
                        <li><a href='product_upload.php' class='dropdown-item'>Produktupload</a></li>
                        <li><a href='finance_overview_seller.php' class='dropdown-item'>Verkaufsübersicht</a></li>
                    </ul>
                </li>";
            }
            ?>

            <?php if ($role == 'administrator') {
                echo "
                    <li class='nav-item dropdown'>
                        <a href='' class='nav-link dropdown-toggle' id='navbarDropdown2' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                            News
                        </a>
                        <ul class='dropdown-menu' aria-labelledby='navbarDropdown2'>
                            <li><a href='newsBlog.php' class='dropdown-item'>Post News Blog</a></li>
                            <li><a href='newsBlog_user.php' class='dropdown-item'>News Blog</a></li>
                            
                        </ul>
                    </li>";
            }
            ?>

            <?php if ($role == 'customer' || $role == 'seller') {
                echo "
                    <li class='nav-item dropdown'>
                        <a href='' class='nav-link dropdown-toggle' id='navbarDropdown3' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                            News
                        </a>
                        <ul class='dropdown-menu' aria-labelledby='navbarDropdown3'>
                            <li><a href='newsBlog_user.php' class='dropdown-item'>News Blog</a></li>
                        </ul>
                    </li>";
            }
            ?>

            <li class="nav-item dropdown">
                <a href="" class="nav-link dropdown-toggle" id="navbarDropdown4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Produkte
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown4">
                    <li><a href="prod_display.php" class="dropdown-item">Alle Produkte</a></li>
                    <li><a href="prod_categories.php" class="dropdown-item">Produkte nach Kategorien</a></li>
                </ul>
            </li>
            <li class="nav-item ">
                <a href="logout.php" class="nav-link  <?php if ($active_page == 'logout.php') {
                                                            echo 'fw-bold active ';
                                                        } ?>">
                    Abmelden
                </a>
            </li>

        </ul>
    </div>
</nav>


</div>