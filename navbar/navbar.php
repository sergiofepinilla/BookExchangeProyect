<?php require_once "../includes/class/user.class.php";
session_start();
?>
<!-- Primera navbar (superior) con logo y barra de búsqueda -->
<nav class="navbar navbar-expand-lg bg bg-white">
    <div class="container">
        <a href="../home/home.php" class="w-25 d-flex align-items-center me-2">
            <img src="../assets/img/logo/logo1.png" class="w-100 d-none d-lg-flex" alt="Logo">
            <img src="../assets/img/logo/logo1.png" class="d-lg-none w-100" alt="Logo">
        </a>

        <!-- SEARCH BAR -->

        <div class="d-flex justify-content-center align-items-center flex-grow-1">
            <input class="form-control me-2 w-100" placeholder="Busca por autor, título, género, ISBN" id="searchBar">
            <button class="btn btn-outline-danger" id="btnSearch"><i class="bi bi-search"></i></button>
        </div>
        <!-- CARRITO -->
        <a class="border border-danger btn mx-3 btn-outline-danger text-danger position-relative" href="../cart/cart.php">
            <i class="bi bi-cart2"></i>
            <span class="position-absolute 
                    top-0 start-100 translate-middle 
                    badge rounded-pill bg-danger" id="cartCount"></span>
        </a>
    </div>
</nav>


<!-- Segunda navbar (inferior) con el resto de los botones -->
<nav class="navbar navbar-expand-lg navbar-light bg-danger">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-4">
                <li class="nav-item ">
                    <a class="nav-link text-white" href="../home/home.php">Inicio</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-white" href="../shop/shop.php">Tienda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../contact/contact.php">Contacto</a>
                </li>

                <?php if (!isset($_SESSION["user"])) { ?>
                    <li class="nav-item d-lg-none">
                        <a class="nav-link text-white" href="../signup/signup.php">Registrarse</a>
                    </li>
                    <li class="nav-item d-lg-none">
                        <a class="nav-link text-white" href="../login/login.php">Iniciar Sesion</a>
                    </li>
                <?php } else {

                    $user = unserialize($_SESSION["user"]);

                    $userId = $user->getId();
                    $userNick = $user->getNick();
                    $userType = $user->getUserType();
                    $userEmail = $user->getEmail();
                    $userName = $user->getName();
                    $userProfilePicture = $user->getProfilePicture();
                ?>
                    <?php if ($userType == 2) { ?>

                        <li class="nav-item d-lg-none">
                            <a class="nav-link text-white" href="../admin/admin.php?admin=users">Administrar Usuarios</a>
                        </li>
                        <li class="nav-item d-lg-none">
                            <a class="nav-link text-white" href="../admin/admin.php?admin=products">Administrar Productos</a>
                        </li>

                    <?php } ?>
                    <li class="nav-item d-lg-none">
                    <a href="../profile/profile.php?id=<?php echo $userId; ?>">Perfil</a>
                    </li>
                    <li class="nav-item d-lg-none">
                        <a class="nav-link text-white" href="../home/logout.php">Cerrar Sesion</a>
                    </li>
                <?php } ?>
            </ul>

            <?php if (!isset($_SESSION["user"])) { ?>
                <div class="button-container me-2 d-none d-lg-block">
                    <a href="../signup/signup.php"><button class="btn  text-white" type="button">Registrarse</button></a>
                    <a href="../login/login.php"><button class="btn text-white" type="button">Iniciar Sesion</button></a>
                </div>

            <?php } else { ?>
                <button class="btn btn-success btn-lg me-3 border border-white" onclick="window.location.href='../bookform/book_form.php'">
                    <i class="bi bi-book me-1"></i> Subir Libro
                </button>

                <div class="button-container me-2 d-none d-lg-block">
                    <div class="dropdown">
                        <button class="border border-white btn btn-outline-white text-white dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person"></i>
                        </button>
                        <ul class="dropdown-menu border-dark " aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item " href="../profile/profile.php?id=<?php echo $userId; ?>">Perfil</a></li>
                            <?php if ($userType == 2) { ?>
                                <a class="dropdown-item " href="../admin/admin.php?admin=users">Administrar Usuarios</a>
                                <a class="dropdown-item " href="../admin/admin.php?admin=products">Administrar Productos </a>
                            <?php } ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item " href="../home/logout.php">
                                    <p>Cerrar Sesión</p>
                                </a></li>
                        </ul>
                    </div>
                </div>

            <?php } ?>

            <div class="d-flex justify-content-end order-0 order-lg-1">
                <?php if (!isset($_SESSION["user"])) { ?>
                    <a href="../login/login.php" class="d-lg-none">
                        <button class="btn btn-outline-danger " type="button">
                            <i class="bi bi-person "></i>
                        </button>
                    </a>
                <?php } else { ?>
                    <a href="../profile/profile.php" class="d-lg-none">
                        <button class="btn btn-outline-danger " type="button">
                            <i class="bi bi-person "></i>
                        </button>
                    </a>
                <?php } ?>

            </div>
        </div>
    </div>
</nav>