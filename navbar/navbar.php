<?php require_once "../includes/class/user.class.php";
session_start();

if (isset($_SESSION["user"])) {
    $user = unserialize($_SESSION["user"]);
    $userId = $user->getId();
    $userNick = $user->getNick();
    $userType = $user->getUserType();
    $userEmail = $user->getEmail();
    $userName = $user->getName();
    $userProfilePicture = $user->getProfilePicture();
}
?>
<!-- Primera navbar (superior) con logo y barra de búsqueda -->
<nav class="navbar navbar-expand-lg bg dark-theme">
    <div class="container">
        <div class="d-flex d-lg-none w-100">
            <!-- TOGGLER BUTTON -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 2.5A.5.5 0 0 1 1.5 2h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5zm0 5A.5.5 0 0 1 1.5 7h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5zm0 5A.5.5 0 0 1 1.5 12h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5z" />
                </svg>
            </button>

            <!-- LOGO FOR MOBILE -->
            <a href="../home/home.php" class="d-flex align-items-center">
                <img src="../assets/img/logo/logo.png" class="w-75 ms-3" alt="Logo">
            </a>
        </div>

        <!-- LOGO FOR DESKTOP -->
        <a href="../home/home.php" class="w-25 d-none d-lg-flex align-items-center me-2">
            <img src="../assets/img/logo/logo.png" class="w-100" alt="Logo">
        </a>

        <!-- SEARCH BAR FOR DESKTOP -->
        <div class="d-none d-lg-flex justify-content-center align-items-center flex-grow-1">
            <div class="input-group">
                <input class="form-control dark-theme" placeholder="Busca por autor, título, género, ISBN" id="searchBar">
                <button class="btn btn-outline-light" id="btnSearch"><i class="bi bi-search"></i></button>
            </div>
        </div>

        <!-- SEARCH BAR FOR MOBILE -->
        <div class="d-flex d-lg-none justify-content-center align-items-center w-100 mt-3">
            <div class="input-group">
                <input class="form-control dark-theme" placeholder="Busca por autor, título, género, ISBN" id="searchBar2">
                <button class="btn btn-outline-light" id="btnSearch2"><i class="bi bi-search"></i></button>
            </div>
        </div>
    </div>
    <div class="container d-lg-none mt-3">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-4">
                <li class="nav-item ">
                    <a class="nav-link text-white fw-bold " href="../home/home.php">Inicio</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-white fw-bold " href="../shop/shop.php">Tienda</a>
                </li>
                <?php if (isset($_SESSION["user"])) { ?>
                    <?php if ($userType == 2) { ?>
                        <li>
                            <a class="nav-link text-white fw-bold " href="../admin/admin.php">Administrar</a>
                        </li>
                    <?php } ?>
                <?php } ?>
                <?php if (!isset($_SESSION["user"]) || $userType != 2) { ?>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold " href="../contact/contact.php">Contacto</a>
                    </li>
                <?php } ?>

                <?php if (isset($_SESSION["user"])) { ?>
                    <?php if ($userType != 2) { ?>
                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold " href="../purchase_history/purchase_history.php">Historial</a>
                        </li>
                    <?php } ?>
                <?php } ?>

                <?php if (!isset($_SESSION["user"])) { ?>
                    <li class="nav-item d-lg-none">
                        <a class="nav-link text-white fw-bold" href="../login/login.php">Iniciar Sesion</a>
                    </li>
                    <li class="nav-item d-lg-none">
                        <a class="nav-link text-white fw-bold " href="../signup/signup.php">Registrarse</a>
                    </li>
                <?php } ?>
                <?php if (isset($_SESSION["user"])) { ?>
                    <li class="nav-item d-lg-none">
                        <a class="nav-link text-white fw-bold" href="../profile/profile.php?id=<?php echo $userId; ?>">Perfil</a>
                    </li>
                    <li class="nav-item d-lg-none">
                        <a class="nav-link text-white fw-bold " href="../home/logout.php">Cerrar Sesion</a>
                    </li>

                <?php } ?>
            </ul>

            <?php if (!isset($_SESSION["user"])) { ?>
                <div class="button-container me-2 d-none d-lg-block">
                    <a href="../signup/signup.php" class="btn me-3 fw-bold primary-btn">Registrarse</a>
                    <a href="../login/login.php" class="btn me-3 fw-bold primary-btn"> Inicar Sesión</a>
                </div>

            <?php } else { ?>
                <?php if ($userType != 2) { ?>
                    <a href="../bookform/book_form.php" class="fw-bold btn btn-lg dark-theme text-white custom-card-border me-3 mt-2 mt-lg-0 mb-2 mb-lg-0">
                        <i class="bi bi-book me-1"> Subir Libro</i>
                    </a>
                <?php } ?>
                <div class="button-container me-2 d-none d-lg-block">
                    <div class="dropdown">
                        <button class="border border-white btn btn-lg btn-outline-white text-white dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person"></i>
                        </button>
                        <ul class="dropdown-menu border-dark dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <?php if ($userType != 2) { ?>
                                <li><a class="dropdown-item " href="../profile/profile.php?id=<?php echo $userId; ?>">Perfil</a></li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            <?php } ?>
                            <li>
                                <a class="dropdown-item " href="../home/logout.php">
                                    <p>Cerrar Sesión</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>
    <!-- NAVBAR LINKS -->

</nav>

<!-- Segunda navbar (inferior) con el resto de los botones -->
<nav class="navbar navbar-expand-lg navbar-light inf-nav d-none d-lg-flex">
    <div class="container">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-4">
            <li class="nav-item ">
                <a class="nav-link text-white fw-bold " href="../home/home.php">Inicio</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link text-white fw-bold " href="../shop/shop.php">Tienda</a>
            </li>
            <?php if (isset($_SESSION["user"])) { ?>
                <?php if ($userType == 2) { ?>
                    <li>
                        <a class="nav-link text-white fw-bold " href="../admin/admin.php">Administrar</a>
                    </li>
                <?php } ?>
            <?php } ?>
            <?php if (!isset($_SESSION["user"]) || $userType != 2) { ?>
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold " href="../contact/contact.php">Contacto</a>
                </li>
            <?php } ?>

            <?php if (isset($_SESSION["user"])) { ?>
                <?php if ($userType != 2) { ?>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold " href="../purchase_history/purchase_history.php">Historial</a>
                    </li>
                <?php } ?>
            <?php } ?>

            <?php if (!isset($_SESSION["user"])) { ?>
                <li class="nav-item d-lg-none">
                    <a class="nav-link text-white fw-bold" href="../login/login.php">Iniciar Sesion</a>
                </li>
                <li class="nav-item d-lg-none">
                    <a class="nav-link text-white fw-bold " href="../signup/signup.php">Registrarse</a>
                </li>
            <?php } ?>
            <?php if (isset($_SESSION["user"])) { ?>
                <?php if ($userType == 2) { ?>
                    <li class="nav-item d-lg-none">
                        <a class="nav-link text-white" href="../admin/admin.php?admin=users">Administrar Usuarios</a>
                    </li>
                    <li class="nav-item d-lg-none">
                        <a class="nav-link text-white" href="../admin/admin.php?admin=products">Administrar Productos</a>
                    </li>
                <?php } ?>
                <li class="nav-item d-lg-none">
                    <a class="nav-link text-white fw-bold" href="../profile/profile.php?id=<?php echo $userId; ?>">Perfil</a>
                </li>
                <li class="nav-item d-lg-none">
                    <a class="nav-link text-white fw-bold " href="../home/logout.php">Cerrar Sesion</a>
                </li>

            <?php } ?>
        </ul>

        <?php if (!isset($_SESSION["user"])) { ?>
            <div class="button-container me-2 d-none d-lg-block">
                <a href="../signup/signup.php" class="btn me-3 fw-bold primary-btn">Registrarse</a>
                <a href="../login/login.php" class="btn me-3 fw-bold primary-btn"> Inicar Sesión</a>
            </div>

        <?php } else { ?>
            <?php if ($userType != 2) { ?>
                <a href="../bookform/book_form.php" class="fw-bold btn btn-lg dark-theme custom-text custom-card-border me-3 mt-2 mt-lg-0 mb-2 mb-lg-0">
                    <i class=" bi bi-book me-1"> Subir Libro</i>
                </a>
            <?php } ?>
            <div class="button-container me-2 d-none d-lg-block">
                <div class="dropdown">
                    <button class="dark-theme custom-card-border btn btn-lg text-white dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person"></i>
                    </button>
                    <ul class="dropdown-menu border-dark " aria-labelledby="dropdownMenuButton">
                        <?php if ($userType != 2) { ?>
                            <li><a class="dropdown-item " href="../profile/profile.php?id=<?php echo $userId; ?>">Perfil</a></li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        <?php } ?>
                        <li>
                            <a class="dropdown-item " href="../home/logout.php">
                                <p>Cerrar Sesión</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        <?php } ?>
    </div>
</nav>