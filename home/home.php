<?php require_once '../header/header.php' ?>
<?php require_once '../navbar/navbar.php' ?>
<?php require_once '../carousel/main_carousel.php' ?>
<div class="container">


<!--separador-->
<hr class="w-75 mt-5 mb-5 mx-auto">
<!--separador-->

<!--Ultimos Productos Container-->
<div class="container mb-4 mt-2">
    <div class="row mb-2">
        <div class="col">
            <h2 class="">Ultimos Libros...</h2>
        </div>
        <div class="col d-flex justify-content-end">
            <a href="" class="align-self-center text-dark custom-link">Ver todos los libros recomendados...</a>
        </div>
    </div>
    <!--Book Row Container-->
    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner" id="carouselInner">
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!--Ultimos Productos Container FIN-->
<hr class="w-75 mt-5 mb-5 mx-auto">
<?php require_once '../carousel/second_carousel.php' ?>
<hr class="w-75 mt-5 mb-5 mx-auto">
<!-- Libros recomendados Container -->
<div class="container">
    <div class="row mb-2 mt-2">
        <div class="col">
            <h2 class="">Libros recomendados...</h2>
        </div>
        <div class="col d-flex justify-content-end">
            <a href="" class="align-self-center text-dark custom-link">Ver todos los libros recomendados</a>
        </div>
    </div>
    <!-- Libros recomendados Row Container -->
    <div id="recommendedCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner" id="recommendedCarouselInner">
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#recommendedCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#recommendedCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
</div>
<!-- Libros recomendados Container FIN -->

<div class="container">
    <hr class ="mt-5 mb-5 mx-auto">
</div>

<!--Cookies-->
<div id="cookie-notification" class="alert alert-info alert-dismissible fade show" role="alert" style="display: none;">
    <p>Este sitio web utiliza cookies para mejorar la experiencia del usuario. Al continuar navegando, aceptas nuestra política de cookies.</p>
    <button id="accept-cookies" class="btn btn-primary">Aceptar</button>
    <button id="reject-cookies" class="btn btn-secondary">Rechazar</button>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<!--Cookies-->

<?php include_once "../newsletter/newsletter.php"; ?>
</div>
</div>

<?php require_once '../footer/upper_footer.php' ?>
</div>
<script src="../navbar/navbar.js"></script>
<script src="home.js"></script>
<?php require_once '../footer/footer_links.php' ?>