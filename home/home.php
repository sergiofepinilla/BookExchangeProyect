<?php require_once '../header/header.php'; ?>
<?php require_once '../navbar/navbar.php'; ?>
<div class="container mt-4 mb-4">
    <img src="../assets/img/carousel/envio_pink.png" class="img-fluid w-100 custom-card-border-2 rounded" alt="Imagen Envio Gratis" />
</div>
<div class="container">
    <!--separador-->
    <div class="mt-5 mb-5 mx-auto custom-hr"> </div>
    <!--separador-->

    <!--Ultimos Productos Container-->
    <div class="container mb-4 mt-2 col-12 d-block">
        <div class="row mb-2">
            <div class="col">
                <h2 class="">Ultimos Libros...</h2>
            </div>
            <div class="col d-flex justify-content-end">
                <a href="../shop/shop.php" class="align-self-center custom-link">Ver todos los libros...</a>
            </div>
        </div>
        <!--Book Row Container-->
        <div id="productCarouselLg" class="carousel slide d-none d-lg-block" data-bs-ride="carousel">
            <div class="carousel-inner" id="carouselInnerLg">
                <!-- Aquí se insertarán los elementos del carrusel para pantallas grandes -->
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#productCarouselLg" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#productCarouselLg" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Carousel para pantallas pequeñas (md y menores) -->
        <div id="productCarouselSm" class="carousel slide d-lg-none" data-bs-ride="carousel">
            <div class="carousel-inner" id="carouselInnerSm">
                <!-- Aquí se insertarán los elementos del carrusel para pantallas pequeñas -->
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#productCarouselSm" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#productCarouselSm" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!--Ultimos Productos Container FIN-->
        <div class="mt-5 mb-5 mx-auto custom-hr"> </div>
        <?php require_once '../carousel/second_carousel.php'; ?>
        <div class="mt-5 mb-5 mx-auto custom-hr d-none d-md-block"> </div>
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
            <div id="recommendedCarouselLg" class="carousel slide d-none d-lg-block" data-bs-ride="carousel">
                <div class="carousel-inner" id="recommendedCarouselInnerLg">
                    <!-- Aquí se insertarán los elementos del carrusel para pantallas grandes -->
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#recommendedCarouselLg" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#recommendedCarouselLg" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <!-- Carousel para pantallas pequeñas (md y menores) -->
            <div id="recommendedCarouselSm" class="carousel slide d-lg-none" data-bs-ride="carousel">
                <div class="carousel-inner" id="recommendedCarouselInnerSm">
                    <!-- Aquí se insertarán los elementos del carrusel para pantallas pequeñas -->
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#recommendedCarouselSm" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#recommendedCarouselSm" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- Libros recomendados Container FIN -->
        <div class="mt-5 mb-5 mx-auto custom-hr"> </div>
        <?php if (isset($_GET['insert']) && $_GET['insert'] === 'success') { ?>
            <!-- Modal Libro Introducido  -->
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content custom-card-border-2 rounded">
                        <div class="modal-header dark-theme custom-text">
                            <h5 class="modal-title" id="successModalLabel">Éxito</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body dark-theme custom-text">
                            <p class="fw-bold fs-5">El libro se ha introducido correctamente.</p>
                        </div>
                        <div class="modal-footer dark-theme">
                            <button type="button" class="fw-bold btn btn-lg dark-theme text-white custom-card-border" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Libro Introducido  -->
        <?php } ?>
        <!--Cookies-->
        <div id="cookie-notification" class="container alert custom-text dark-theme alert-dismissible fade show fixed-bottom custom-card-border-2" role="alert" style="display: none;">
            <div class="container">
                <div class="row flex-column flex-lg-row">
                    <div class="col-lg mb-2 mb-lg-0">
                        <p>Este sitio web utiliza cookies para mejorar la experiencia del usuario. Al continuar navegando, aceptas nuestra política de cookies.</p>
                    </div>
                    <div class="col-lg-auto text-center text-lg-right">
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