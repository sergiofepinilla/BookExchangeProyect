<?php require_once '../header/header.php' ?>
<?php require_once '../navbar/navbar.php' ?>
    <div class="container p-3 border border-danger border-5 mt-5 mb-5" style="background: black;">
        <div class="mb-3 text-white">
            <div class="row g-2">
                <div id="carouselExampleControls" class="carousel slide col-8" data-bs-ride="carousel">
                    <div class="carousel-inner" id="imgContainer">

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="col-4 p-0">
                    <div class="card-body">
                        <a class="text-danger" id="categoria">Fantasia</a>
                        <h3 class="card-title fs-1 fw-bold" id="nombre">Libro de Prueba</h3>
                        <p class="fs-4" id="precio">9.99€</p>
                        <hr>
                        <button class="btn btn-outline-danger w-100" id="btnCart">COMPRAR</button>
                        <hr>
                        <p id="descripcion">Esto es una descripción de prueba para los libros de la tienda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once '../footer/upper_footer.php' ?>
<script src="../navbar/navbar.js"></script>
<script src="product.js"></script>
<?php require_once '../footer/footer_links.php' ?>