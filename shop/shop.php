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
                                <li><a class="dropdown-item" href="./shop.php?category=1">Acción y aventura</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=2">Biografía</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=3">Ciencia ficción</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=4">Crimen y misterio</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=5">Cuento de hadas</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=6">Ensayo</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=7">Fantasía</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=8">Ficción histórica</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=9">Ficción literaria</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=10">Horror y terror</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=11">Humor</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=12">Infantil y juvenil</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=13">Memorias</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=14">Narrativa</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=15">Novela gráfica</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=16">Novela negra</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=17">Novela romántica</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=18">Poesía</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=19">Política</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=20">Realismo mágico</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=21">Religión y espiritualidad</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=22">Sátira</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=23">Teatro</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=24">Thriller y suspense</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=25">Viajes y aventuras</a></li>
                                <li><a class="dropdown-item" href="./shop.php?category=26">Otros</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="./shop.php" id="clear">X Mostrar Todos</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="row">
            <div class="col">
                <h1 id="category-header"></h1> <!-- Aquí es donde se insertará el encabezado -->
                <div class="row pt-3 row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4" id="container">
                </div>
            </div>
        </div>
    </div>

    <?php require_once '../footer/upper_footer.php' ?>
    <script src="../navbar/navbar.js"></script>
    <script src="shop.js"></script>
    <?php require_once '../footer/footer_links.php' ?>