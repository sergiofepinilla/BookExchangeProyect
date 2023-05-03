<?php require_once '../header/header.php' ?>
<?php require_once '../navbar/navbar.php' ?>
<div class="container text-white p-3 border border-danger border-5 bg-dark mt-5 mb-5">
    <div class="row">
        <div class="col col-12 col-lg-8 ">
            <h1>Carrito</h1>
            <hr>
            <div id="listaProductos">
            </div>
        </div>
        <div class="col border-start border-2 p-5">
            <div id="ticket">

            </div>
            <div id="emptyStuff" class="text-center fw-bold">
                No hay nada en el carrito
            </div>
            <hr>
            <div id="totalAmount" class="d-flex justify-content-between fw-bold">
                <p>TOTAL</p>
                <p id="total" class="fw-bold">0</p>
            </div>
            <button id="checkOut" class="btn btn-outline-danger w-100 text-white fw-bold">Realizar la compra</button>
        </div>
    </div>
</div>
<?php require_once '../footer/upper_footer.php' ?>
<script src="../navbar/navbar.js"></script>
<script src="cart.js"></script>
<?php require_once '../footer/footer_links.php' ?>