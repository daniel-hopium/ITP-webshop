<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Electronics Webshop</title>
    <?php
    include '../includes/head.php';
    ?>
    <style>
    .card-img-top {
        height: 300px;
        object-fit: cover;
    }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container py-4">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
            <div class="col mb-4">
                <div class="card h-100">
                    <img src="https://www.pcspecialist.at/images/landing/pcs/gaming-pc-bundles/bundles-visual.jpg"
                        class="card-img-top" alt="Computer">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-3">Computers</h2>
                        <p class="card-text">Here you will find a wide selection of desktop computers for your home or
                            office, with high performance and reliable quality.</p>
                        <a href="prod_display.php?category_id=1"
                            class="btn secondary-bg-color btn-block secondary-color">View Category</a>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card h-100">
                    <img src="https://assets2.razerzone.com/images/pnx.assets/7fb8deac5d3c73e360bc687ed62be6cf/gaming-laptops-og-image.png"
                        class="card-img-top" alt="Laptops">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-3">Laptops</h2>
                        <p class="card-text">Discover our wide range of lightweight and portable laptops for on-the-go,
                            with long battery life and fast processors.</p>
                        <a href="prod_display.php?category_id=2"
                            class="btn secondary-bg-color btn-block secondary-color">View Category</a>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card h-100">
                    <img src="https://images.pexels.com/photos/1334597/pexels-photo-1334597.jpeg?cs=srgb&dl=pexels-josh-sorenson-1334597.jpg&fm=jpg"
                        class="card-img-top" alt="Tablets">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-3">Tablets</h2>
                        <p class="card-text">Experience the freedom and flexibility of our tablets, with crystal-clear
                            screens and fast processors.</p>
                        <a href="prod_display.php?category_id=3"
                            class="btn secondary-bg-color btn-block secondary-color">View Category</a>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card h-100">
                    <img src="https://i.pcmag.com/imagery/roundups/01Wsuw14K02wrCTGIwg8xA8-15..v1620845330.jpg"
                        class="card-img-top" alt="Printers">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-3">Printers</h2>
                        <p class="card-text">Choose from our high-quality printers for home or office that meet all your
                            needs.</p>
                        <a href="prod_display.php?category_id=4"
                            class="btn secondary-bg-color btn-block secondary-color">View Category</a>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card h-100">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS9PQ0ipzO1Ft_XNO17CijXyNZYK7izZyHK_w&usqp=CAU"
                        class="card-img-top" alt="Headphones">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-3">Headphones</h2>
                        <p class="card-text">Immerse yourself in your music or enjoy crystal-clear calls with our
                            high-quality headphones.</p>
                        <a href="prod_display.php?category_id=5"
                            class="btn secondary-bg-color btn-block secondary-color">View Category</a>
                    </div>
                </div>
            </div>
            <div class="col mb-4">
                <div class="card h-100">
                    <img src="https://images.pexels.com/photos/2651794/pexels-photo-2651794.jpeg?cs=srgb&dl=pexels-marinko-krsmanovic-2651794.jpg&fm=jpg"
                        class="card-img-top" alt="Speakers">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-3">Speakers</h2>
                        <p class="card-text">Experience impressive sound quality with our powerful and versatile
                            speakers for home or on-the-go.</p>
                        <a href="prod_display.php?category_id=6"
                            class="btn secondary-bg-color btn-block secondary-color">View Category</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include '../includes/footer.php';
    ?>

</body>

</html>