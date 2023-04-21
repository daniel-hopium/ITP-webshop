<?php
$active_page = basename($_SERVER['SCRIPT_NAME']);
?>

<link href='https://fonts.googleapis.com/css?family=Alex Brush' rel='stylesheet'>

<nav class="navbar sticky-top navbar-expand-sm navbar-dark ">
    <div class="container justify-content-center">
        <a href='#' class="navbar-brand mb-0 h1 ">
            <img class="d-inline-block align top" src="https://icons.iconarchive.com/icons/iconka/business-finance/256/handshake-icon.png" width="30" height="30"></a>
        <a href='landing_page.php' class="navbar-brand mb-0 h1 mt-2" id="shopName" style="font-family:'Alex Brush'; font-size: 25px;">Nix Für Arme Shop</a>
        <button type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" class="navbar-toggler" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="news.php" class="nav-link <?php if ($active_page == 'news.php') echo 'fw-bold active disabled'; ?>">
                        News
                    </a>
                </li>
                <li class="nav-item">
                    <a href="contact.php" class="nav-link <?php if ($active_page == 'contact.php') echo 'fw-bold active disabled'; ?>">
                        Kontakt
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="faq.php" class="nav-link <?php if ($active_page == 'faq.php') echo 'fw-bold active disabled'; ?>">
                        FAQ
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="login.php" class="nav-link  <?php if ($active_page == 'login.php') echo 'fw-bold active disabled'; ?>">
                        Login
                    </a>
                </li>
            
            </ul>
            <form class="d-flex ms-auto my-2 my-lg-0" id="search-form"">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="search-input">
                <button class="btn btn-outline-success btn btn-danger" type="submit">Search</button>
            </form>
            <div id="results-container"></div>
        </div>
    </div>
</nav>

<script src="scripts.js"></script>