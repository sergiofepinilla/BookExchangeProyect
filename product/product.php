<?php require_once '../header/header.php' ?>
<?php require_once '../navbar/navbar.php' ?>
<div class="container mt-5 mb-5">
    <div class="row ">
        <div class="col-4 d-flex flex-column align-items-center me-2 bg-light border" style="border-radius: 15px;">
            <div id="imgContainer" class="mt-3  d-flex align-items-center justify-content-center  my-auto" style="height: 200px; width: 100%;"></div>
            <div class="row mt-2 p-4">
            <h5 class="text-center">Información del Vendedor</h5>
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body">
                   
                        <div class="row align-items-center">
                            <div id="profilePicture" class="col-auto d-flex align-items-center">
                                <!-- Aquí va el contenido de la foto del vendedor -->
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <h1 class="mb-2 text-dark" id="usu_vendedor">Vendedor</h1>
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
                                    <button type="button" class="btn btn-success w-100">Ver Perfil</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col border bg-light " style="border-radius: 15px;">
            <div class="card-body">
                <a class="text-danger" id="genero">Fantasia</a>
                <h3 class="card-title fs-1 fw-bold" id="titulo">Libro de Prueba</h3>
                <hr>
                <p id="autor">Autor.</p>
                <p id="genero_name">Fantasia</p>
                <p id="isbn">ISBN.</p>
                <p id="editorial">Editorial.</p>
                <p id="estado">Estado.</p>
                <hr>
                <p id="descripcion">Descripción.</p>
        
            </div>
            <hr>
            <p class="fs-4 text-end" id="precio">9.99€</p>
            <button class="btn btn-outline-danger w-100 mb-3" id="buyBtn">COMPRAR</button>
            <p id="removeProductLink" style="display:none;" class="mt-2 text-center"><a href="#">¿Deseas retirar tu producto de la tienda?</a></p>
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
