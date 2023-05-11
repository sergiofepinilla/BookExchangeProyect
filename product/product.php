<?php require_once '../header/header.php' ?>
<?php require_once '../navbar/navbar.php' ?>
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-4 ">
            <div id="imgContainer" class="d-flex align-items-center justify-content-center" style="height: 100%;">
            </div>
        </div>
        <div class="col-8 border">
            <div class="card-body">
                <a class="text-danger" id="genero">Fantasia</a>
                <h3 class="card-title fs-1 fw-bold" id="titulo">Libro de Prueba</h3>
                <hr>
                <p id="autor">Autor.</p>
                <p id="isbn">ISBN.</p>
                <p id="editorial">Editorial.</p>
                <p id="estado">Estado.</p>
                <hr>
                <p id="descripcion">Descripción.</p>
                <hr>
                <h5>Información del Vendedor</h5>
                <div class="container h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col col-md-9 col-lg-7 col-xl-5 w-100">
                            <div class="card" style="border-radius: 15px;">
                                <div class="card-body p-4">
                                    <div class="d-flex text-black  d-flex justify-content-center align-items-center h-100">
                                        <div class="">
                                            <div class=" d-flex justify-content-center align-items-center h-100" id="profilePicture"></div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h1 class="mb-2 text-dark" id="usu_vendedor">Vendedor</h1>
                                            <div class="card bg-light mb-3">
                                                <div class="card-header bg-primary text-white">
                                                    <h5 class="card-title mb-0">Estadísticas de usuario</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="text-center">
                                                                <p class="h5 mb-1">Libros en venta</p>
                                                                <p class="h4 mb-0">5</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="text-center">
                                                                <p class="h5 mb-1">Libros vendidos</p>
                                                                <p class="h4 mb-0">25</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="text-center">
                                                                <p class="h5 mb-1">Puntuación</p>
                                                                <div class="d-flex justify-content-center align-items-center mb-0">
                                                                    <p class="h1 mb-0 me-1">5</p>
                                                                    <i class="bi bi-star-fill fs-3 text-warning"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex pt-1">
                                                <a href="" id="usu_vendedor_link" class="w-100">
                                                <button type="button" class="btn btn-success w-100">Ver Perfil</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <p class="fs-4 text-end" id="precio">9.99€</p>
                <button class="btn btn-outline-danger w-100" id="buyBtn">COMPRAR</button>
                <p id="removeProductLink" style="display:none;" class="mt-2 text-center"><a href="#">¿Deseas retirar tu producto de la tienda?</a></p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <hr>
    <h1>También te puede interesar...</h1>
</div>
<?php 
    echo "<script>let currentUserId = undefined;";
    if(isset($userId)){
    echo "currentUserId = $userId;";
    } 
    echo "</script>";
    ?>
<?php echo "<script>var sellerUserId;</script>"; ?>
<?php require_once '../footer/upper_footer.php' ?>
<script src="../navbar/navbar.js"></script>
<script src="product.js"></script>
<?php require_once '../footer/footer_links.php' ?>