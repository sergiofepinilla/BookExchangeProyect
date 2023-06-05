<?php require_once "../header/header.php"; ?>
<?php require_once "../navbar/navbar.php"; ?>
<?php if (!isset($_GET["id"])) {
    echo '<img src="../assets/img/403.png" alt="forbidden" class="bg-danger w-100">';
    include_once "../footer/footer.php";
    exit();
    } ?>
<div class="container mt-3 mt-md-5">
    <h1>Perfil de Usuario</h1>
    <div class="custom-hr w-100"></div>
</div>
<img src="../assets/img/no-result.JPG" alt="" id="no-results-image" class="w-75 mt-5 mb-5 mx-auto" style="display:none">
<!-- USER -->
<div class="container custom-card-border-2 rounded mt-5 mb-5 rounded dark-theme " id="user-info">
<!-- Perfil -->
<div class="row card-body rounded dark-theme custom-text">
    <div class="d-flex text-black flex-column flex-md-row">
        <div class="me-3 mb-md-0 ">
            <div class="d-flex justify-content-center">
                <div id="profileImageContainer" class="profileImageContainer"></div>
            </div>
            <!-- EDITAR IMAGEN-->
            <?php if (isset($_POST["editProfileSubmit"])) : ?>
            <form action="../includes/profile.inc.php" method="POST" enctype="multipart/form-data" class="d-flex justify-content-center">
                <div class="row">
                    <div class="col-12 mt-2">
                        <input type="file" name="profilePicture" id="profilePicture" class="custom-file-input " style="display:none;" accept="image/*">
                        <label class="custom-file-label fw-bold btn dark-theme custom-text custom-card-border mt-3" for="profilePicture">Cambiar imagen</label>
                    </div>
                </div>
                <?php endif; ?>
        </div>
        <div class="flex-grow-1 ms-3 ms-md-0 mt-3 mt-md-0 ">
        <div class="card-body ">
        <!-- Estadísticas -->
        <?php if (isset($userId) && $userId == $_GET['id']) { ?>
        <div class="row mb-2">
        <?php } else { ?>
        <div class="row mt-5">
        <?php }; ?>
        <div class="col-12 col-md-8 text-center text-md-start">
        <h1 class="mt-2" id="apodo"></h1>
        </div>
        </div>
        <div class="row mb-2  text-center text-md-start">
        <?php if (isset($userId) && $userId == $_GET['id']) { ?>
        <div class="col-12 col-md-4">
        <strong>Nombre Completo:</strong>
        </div>
        <?php } ?>
        <div class="col-md-8 text-center text-md-start d-flex justify-content-center justify-content-md-start">
        <?php if (isset($_POST["editProfileSubmit"])) : ?>
        <div class="col-8 ">
        <input type="text" name="profileUserName" class="form-control" value="<?php echo $user->getName(); ?>">
        </div>
        <?php else : ?>
        <?php if (isset($userId) && $userId == $_GET['id']) { ?>
        <div class="col-8">
        <span id="nombre"></span>
        </div>
        <?php } ?>
        <?php endif; ?>
        </div>
        </div>
        <div class="row mb-2  text-center text-md-start">
        <?php if (isset($userId) && $userId == $_GET['id']) { ?>
        <div class="col-12 col-md-4">
        <strong>Correo electrónico:</strong>
        </div>
        <div class="col-md-8  text-center text-md-start">
        <span id="correo"></span>
        </div>
        <?php } ?>
        </div>
        <div class="row mb-2  text-center text-md-start">
        <?php if (isset($userId) && $userId == $_GET['id']) { ?>
        <div class="col-12 col-md-4">
        <strong>Nombre de usuario:</strong>
        </div>
        <div class="col-md-8  text-center text-md-start">
        <span id="user_name"></span>
        </div>
        <?php } ?>
        </div>
        <!-- Estadísticas Fin -->
        </div>
        </div>
        </div>
    </div>
    <!-- Libros en venta -->
    <div class="row custom-text inf-nav rounded ">
    <div class="card-body">
    <div class="row">
    <div class="col-md-4">
    <div class="text-center">
    <p class="h5 mb-1">Libros en venta</p>
    <p class="h4 mb-0" id="libros_en_venta">0</p>
    </div>
    </div>
    <div class="col-md-4">
    <div class="text-center">
    <p class="h5 mb-1">Libros vendidos</p>
    <p class="h4 mb-0" id="libros_vendidos">0</p>
    </div>
    </div>
    <div class="col-md-4">
    <div class="text-center">
    <p class="h5 mb-1">Puntuación</p>
    <div class="d-flex justify-content-center align-items-center mb-0">
    <p class="h1 mb-0 me-1" id="puntuacion"></p>
    <i class="bi bi-star-fill fs-3 text-warning"></i>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- Libros en venta -->
    <?php if (isset($userId) && $userId == $_GET['id']) { ?>
    <div class="row dark-theme mt-3 mb-3 ">
    <div class="col d-flex justify-content-end">
    <!-- EDIT OR SAVE BUTTON -->
    <?php if (isset($_POST["editProfileSubmit"])) : ?>
    <button type="submit" class="fw-bold btn btn-lg dark-theme custom-text custom-card-border" name="saveProfileSubmit">Guardar cambios</button>
    <?php else : ?>
    <form action="profile.php?id=<?php echo $userId ?>" method="POST">
    <button type="submit" class="fw-bold btn btn-lg dark-theme custom-text custom-card-border" name="editProfileSubmit">Editar Perfil</button>
    <?php endif; ?>
    </form>
    </div>
    <?php } ?>
    </form>
    </div>
    <!-- Editar perfil -->
</div>
<!-- VALORACIONES / COMENTARIOS -->
<div class="container mb-5" id="user-reviews">
    <h1>Libros y Valoraciones</h1>
    <div class="custom-hr w-100"></div>
    <div class="container mt-5">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#login" id="booksTabLink">Libros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#signup" id="reviewsTabLink">Valoraciones</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="login" class="tab-pane active">
                <div class="col-md-12 d-flex justify-content-between align-items-center mb-3">
                    <h2 class="mt-3">Libros en Venta</h2>
                </div>
                <!--Productos Usuario Container-->
                <div id="no_book_div" style="display:none">
                    <h3>Este usuario no tiene ningún libro disponible</h3>
                </div>
                <div class="container mb-4" id="book_div">
                    <!--Book Row Container-->
                    <div id="productCarouselLarge" class="carousel slide d-none d-lg-block" data-bs-ride="carousel">
                        <div class="carousel-inner" id="carouselInnerLarge"></div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarouselLarge" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarouselLarge" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <div id="productCarouselSmall" class="carousel slide d-block d-lg-none" data-bs-ride="carousel">
                        <div class="carousel-inner" id="carouselInnerSmall"></div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarouselSmall" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarouselSmall" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <!--Productos Usuario Container FIN-->
            </div>
            <div id="signup" class="tab-pane">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h2 class="mt-3">Valoraciones de los usuarios</h2>
                </div>
                <!-- Valoraciones Container -->
                <div id="reviewsContainer" class="mt-3 mb-4"></div>
                <div id="no-reviews-div" class="mt-3 mb-4" style="display:none">
                    <h3>Este Usuario no tiene valoraciones.</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- VALORACIONES / COMENTARIOS FIN-->
<?php require_once "../footer/upper_footer.php"; ?>
<script src="../navbar/navbar.js"></script>
<script src="profile.js"></script>
<?php require_once "../footer/footer_links.php"; ?>