<?php require_once '../header/header.php' ?>
<?php require_once '../navbar/navbar.php' ?>
<img src="../assets/img/no-result.JPG" alt="" id="no-results-image" class="w-75 mt-5 mb-5 mx-auto rounded" style="display:none">
<div class="container mt-5 mb-5" id="bookContainer">
    <div class="row p-4 p-md-0">

        <div class="col-12 col-md-4 d-flex flex-column align-items-center me-2 dark-theme custom-text custom-card-border-2 mb-4 mb-md-0 " style="border-radius: 15px;">
            <h3 class="card-title fs-1 fw-bold limit-text text-center mt-3" id="titulo">Libro de Prueba</h3>
            <div class="custom-hr mb-3"></div>
            <div id="imgContainer" class="mt-3  d-flex align-items-center justify-content-center  my-auto" style="height: 200px; width: 100%;"></div>
            <div class="row mt-2 p-4">
                <h5 class="text-center">Información del Vendedor</h5>

                <div class="card dark-theme " style="border-radius: 15px;">
                    <div class="card-body">

                        <div class="row align-items-center flex-nowrap">
                            <div id="profilePicture" class="col-auto d-flex align-items-center">
                            </div>
                            <div class="col-auto d-flex align-items-start w-100">
                                <h2 class="mb-2 custom-text fw-bold" id="usu_vendedor">Vendedor</h2>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-end">
                            <div class="col-auto d-flex align-items-center rating-container">
                                <p class="star-rating" id="user_rating"></p>
                                <p id="review_count"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex align-items-center">
                                <a href="" id="usu_vendedor_link" class="w-100">
                                    <button type="button" class="fw-bold btn btn-lg dark-theme custom-text custom-card-border w-100">Ver Perfil</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-7  dark-theme custom-text custom-card-border-2 " style="border-radius: 15px;">
            <div class="card-body">
                <h3 class="card-title fs-1 fw-bold limit-text text-center text-md-start">Información del Libro</h3>
                <div class="custom-hr w-100 mb-4"></div>
                <p id="autor" class="limit-text">Autor.</p>
                <p id="genero_name" class="limit-text">Fantasia</p>
                <p id="isbn" class="limit-text">ISBN.</p>
                <p id="editorial" class="limit-text">Editorial.</p>
                <p id="estado" class="limit-text">Estado.</p>
                <p id="descripcion" class="limit-text">Descripción:</p>

            </div>
            <div class="custom-hr w-100 mb-4"></div>
            <p class="fs-4 text-end" id="precio">9.99€</p>
            <button type="button" class="fw-bold btn btn-lg dark-theme custom-text custom-card-border w-100 mb-4 mb-md-0" id="comprarButton">Comprar</button>

            <!-- Modal -->
            <div class="modal fade" id="comprarModal" tabindex="-1" aria-labelledby="comprarModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content dark-theme custom-text custom-card-border-2">
                        <div class="modal-header">
                            <h5 class="modal-title" id="comprarModalLabel">Completar la Compra</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Loading Message -->
                            <div id="loadingMessage" style="display: none;">
                                <div class="d-flex align-items-center">
                                    <div class="spinner-border text-primary me-3" role="status">
                                        <span class="sr-only">Cargando...</span>
                                    </div>
                                    <p class="mb-0 ml-2">Verificando Credenciales...</p>
                                </div>
                            </div>

                            <!-- Success Message -->
                            <div id="successMessage" style="display: none;">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill bi-lg custom-text me-3"></i>
                                    <p class="mb-0 ml-2">La compra se ha completado con éxito</p>
                                </div>
                            </div>

                            <div class="col" id="purchease_form">
                                <h4 class="mb-3">Dirección de envio</h4>
                                <form class="needs-validation" novalidate="">
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <label for="firstName" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="firstName" placeholder="Nombre *">
                                            <div class="invalid-feedback">
                                                Se requiere un nombre válido.
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="lastName" class="form-label">Apellido</label>
                                            <input type="text" class="form-control" id="lastName" placeholder="Apellido *">
                                            <div class="invalid-feedback">
                                                Se requiere apellido válido.
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="address" class="form-label">Dirección</label>
                                            <input type="text" class="form-control" id="address" placeholder="Calle..." >
                                            <div class="invalid-feedback">
                                                Por favor introduce tu direccion de envio.
                                                Please enter your shipping address.
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="address2" class="form-label">Dirección 2 <span class="text-muted">(Opcional)</span></label>
                                            <input type="text" class="form-control" id="address2" placeholder="Apartamento...">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="country" class="form-label">Cominudad Autónoma</label>
                                            <select class="form-select" id="country" >
                                                <option value="">Elige...</option>
                                                <option>Andalucía</option>
                                                <option>Aragón</option>
                                                <option>Asturias</option>
                                                <option>Baleares</option>
                                                <option>Canarias</option>
                                                <option>Cantabria</option>
                                                <option>Castilla y León</option>
                                                <option>Castilla-La Mancha</option>
                                                <option>Cataluña</option>
                                                <option>Extremadura</option>
                                                <option>Galicia</option>
                                                <option>La Rioja</option>
                                                <option>Madrid</option>
                                                <option>Murcia</option>
                                                <option>Navarra</option>
                                                <option>País Vasco</option>
                                                <option>Valencia</option>
                                                <option>Ceuta</option>
                                                <option>Melilla</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Selecciona un país válido.
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="zip" class="form-label">Código postal</label>
                                            <input type="text" class="form-control" id="zip" placeholder="" >
                                            <div class="invalid-feedback">
                                                Código postal requerido.
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="same-address">
                                        <label class="form-check-label" for="same-address">La dirección de envío es la misma que mi dirección de facturación</label>
                                    </div>
                                    <hr class="my-4">
                                    <h4 class="mb-3">Pago</h4>
                                    <div class="my-3">
                                    </div>
                                    <div class="row gy-3">
                                        <div class="col-md-6">
                                            <label for="cc-name" class="form-label">Nombre en la tarjeta</label>
                                            <input type="text" class="form-control" id="cc-name" placeholder="" >
                                            <div class="invalid-feedback">
                                                Se requiere el nombre en la tarjeta
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cc-number" class="form-label">Número de tarjeta de crédito</label>
                                            <input type="text" class="form-control" id="cc-number" placeholder="" >
                                            <div class="invalid-feedback">
                                                Se requiere número de tarjeta de crédito
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="cc-expiration" class="form-label">Vencimiento</label>
                                            <input type="text" class="form-control" id="cc-expiration" placeholder="" >
                                            <div class="invalid-feedback">
                                                Fecha de vencimiento requerida
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="cc-cvv" class="form-label">CVV</label>
                                            <input type="text" class="form-control" id="cc-cvv" placeholder="" >
                                            <div class="invalid-feedback">
                                                Código de seguridad requerido
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <button class="w-100 btn btn-lg dark-theme custom-text custom-card-border " type="submit" id="buyBtn">Completar el pago</button>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn inf-nav custom-text" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL FIN -->


            <p id="removeProductLink" style="display:none;" class="mt-2 text-center"><a href="#">¿Deseas retirar tu producto de la tienda?</a></p>
        </div>
    </div>
</div>

<!-- Libros recomendados Container -->
<div class="container mb-3 d-none d-md-block" id="recommendedContainer ">
    <div class="row mb-2 mt-2">
        <div class="col">
            <h1>También te puede interesar...</h1>
        </div>
        <div class="col d-flex justify-content-end">
            <a href="" class="align-self-center text-dark custom-link" id="recommended_shop">
                <h2>Ver todos los libros recomendados...</h2>
            </a>
        </div>
    </div>
    <!-- Libros Recomendados Row Container -->
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

<!-- Libros Recomendados Container FIN -->
</div>
<?php
echo "<script>let currentUserId = undefined;";
if (isset($userId)) {
    echo "currentUserId = $userId;";
}
echo "</script>";
?>
<?php echo "<script>var sellerUserId;</script>"; ?>
<?php require_once '../footer/upper_footer.php' ?>
<script src="../navbar/navbar.js"></script>
<script src="product.js"></script>
<?php require_once '../footer/footer_links.php' ?>