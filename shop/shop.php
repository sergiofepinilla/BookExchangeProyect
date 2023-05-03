<?php require_once '../header/header.php' ?>
<?php require_once '../navbar/navbar.php' ?>
<body>
    <div class="container mt-3">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-dark bg-black">
    <div class="container-fluid bg-light border border-3">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Categorias
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-scrollable" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="./shop.php?category=1">Headtsets</a></li>
                    <li><a class="dropdown-item" href="./shop.php?category=2">Keyboards</a></li>
                    <li><a class="dropdown-item" href="./shop.php?category=3">Mice</a></li>
                    <li><a class="dropdown-item" href="./shop.php?category=4">Clothes</a></li>
                    <li><a class="dropdown-item" href="./shop.php?category=5">Accesories</a></li>
                    <li><a class="dropdown-item" href="./shop.php?category=6">Digital products</a></li>
                    <li><a class="dropdown-item" href="./shop.php?category=7">Historia</a></li>
                    <li><a class="dropdown-item" href="./shop.php?category=8">Negocios y finanzas</a></li>
                    <li><a class="dropdown-item" href="./shop.php?category=9">Autoayuda</a></li>
                    <li><a class="dropdown-item" href="./shop.php?category=10">Libros de cocina, comida y vino</a></li>
                    <li><a class="dropdown-item" href="./shop.php?category=11">Salud, bienestar y dieta</a></li>
                    <li><a class="dropdown-item" href="./shop.php?category=12">Viajes</a></li>
                    <li><a class="dropdown-item" href="./shop.php?category=13">Arte y fotografía</a></li>
                    <li><a class="dropdown-item" href="./shop.php?category=14">Libros infantiles</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="./shop.php" id="clear">X Mostrar Todos</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav></div>
        <div class="row">
            <div class="col">
                <div class="row pt-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4" id="container">
                </div>
            </div>
        </div>
    </div>

<?php require_once '../footer/upper_footer.php' ?>
<script src="../navbar/navbar.js"></script>
<script src="shop.js"></script>
<?php require_once '../footer/footer_links.php' ?>
