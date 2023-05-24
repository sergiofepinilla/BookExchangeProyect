<?php require_once '../header/header.php'; ?>
<?php require_once '../navbar/navbar.php'; ?>
<?php require_once '../carousel/main_carousel.php'; ?>
<div class="container">


    <!--separador-->
    <div class="mt-5 mb-5 mx-auto custom-hr"> </div>
    <!--separador-->

    <!--Ultimos Productos Container-->
    <div class="container mb-4 mt-2">
        <div class="row mb-2">
            <div class="col">
                <h2 class="">Ultimos Libros...</h2>
            </div>
            <div class="col d-flex justify-content-end">
                <a href="../shop/shop.php" class="align-self-center custom-link">Ver todos los libros...</a>
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
    <div class="mt-5 mb-5 mx-auto custom-hr"> </div>
    <?php require_once '../carousel/second_carousel.php'; ?>
    <div class="mt-5 mb-5 mx-auto custom-hr"> </div>
    <!-- Libros recomendados Container -->
    <div class="container">
        <div class="row mb-2 mt-2">
            <div class="col">
                <h2 class="">Libros recomendados...</h2>
            </div>
            <div class="col d-flex justify-content-end">
                <a href="" class="align-self-center custom-link" id="recommended_shop">Ver todos los libros recomendados...</a>
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

<div class="mt-5 mb-5 mx-auto custom-hr"> </div>

<!--Cookies-->
<div id="cookie-notification" class="container alert custom-text dark-theme alert-dismissible fade show fixed-bottom custom-card-border-2" role="alert" style="display: none;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <p>Este sitio web utiliza cookies para mejorar la experiencia del usuario. Al continuar navegando, aceptas nuestra política de cookies.</p>
            </div>
            <div class="col-auto">
                <button id="accept-cookies" class="btn primary-btn custom-text cookie-btn">Aceptar</button>
                <button id="reject-cookies" class="btn secondary-btn custom-text cookie-btn">Rechazar</button>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>
<!--Cookies-->

<?php include_once "../newsletter/newsletter.php"; ?>
</div>
</div>

<?php require_once '../footer/upper_footer.php'; ?>
</div>
<script src="../navbar/navbar.js"></script>
<script src="home.js"></script>
<?php require_once '../footer/footer_links.php'; ?>
