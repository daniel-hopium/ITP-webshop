<!DOCTYPE html>
<html lang="en">

<head>
    <title>Startseite</title>

    <?php
    include '../includes/head.php';
    ?>

</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container-fluid p-0">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active border border-dark">
                    <img src=".\..\..\res\img/inprogress.jpg" class="d-block w-100 " alt="...">
                    <div class="carousel-caption d-none d-md-block ">
                        <h4></h4>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src=".\..\..\res\img/inprogress.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h4 class=""></h4>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src=".\..\..\res\img/inprogress.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h4></h4>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="container-fluid ">
        <div class="container card text-white shadow bg-brown my-5  ">
            <div class="card-body<">
                <h1 class="h1 text-center  ">NEUE FERNSEHER IM ANGEBOT</h1>
                <img class="img-fluid rounded" alt="Image" src=".\..\..\res\img\new_product_01.jpg">
                <div class="my-2 fs-5">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt nobis aspernatur animi,
                        distinctio architecto quam accusantium maxime asperiores suscipit mollitia dolor molestias,
                        explicabo necessitatibus nemo cum similique nam perferendis iure.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum soluta dolorum animi qui deserunt
                        beatae odio consectetur saepe natus praesentium optio, blanditiis cumque unde eos ratione? Velit
                        eaque repudiandae inventore.</p>
                    <p>ONLY 5999 BUCKS </p>
                </div>
            </div>
        </div>
    </div>

    <?php
 include '../includes/footer.php';
    ?>

</body>

</html>