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
<!-- USER FIX -->

<div class="container border boder-5 border-white mt-5 mb-5 rounded inf-nav ">
    <!-- Perfil -->
    <div class="row card-body inf-nav rounded inf-nav custom-text">
        <div class="d-flex text-black flex-column flex-md-row">
            <div class="me-3 mb-md-0 flex">
                <div id="profileImageContainer" class="profileImageContainer"></div>
                <!-- IMAGE EDITING-->
                <?php if (isset($_POST["editProfileSubmit"])) : ?>
                    <form action="../includes/profile.inc.php" method="POST" enctype="multipart/form-data" class="d-flex justify-content-center">
                        <div class="row">
                            <div class="col">
                                <input type="file" name="profilePicture" id="profilePicture" class="custom-file-input" style="display:none;" accept="image/*">
                                <label class="custom-file-label btn primary-btn mt-2" for="profilePicture">Cambiar imagen</label>
                            </div>
                        </div>

                    <?php endif; ?>
            </div>
            <div class="flex-grow-1 ms-3 ms-md-0 mt-3 mt-md-0">
                <div class="card-body">
                    <!-- Start of Profile Details -->
                    <div class="row">
                        <?php if (isset($userId) && $userId == $_GET['id']) { ?>
                            <div class="col-12 col-md-4">
                                <strong>Nombre Completo:</strong>
                            </div>
                        <?php } ?>
                        <div class="col-12 col-md-8">
                            <?php if (isset($_POST["editProfileSubmit"])) : ?>
                                <div class="col-8">
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
                    <div class="row">
                        <?php if (isset($userId) && $userId == $_GET['id']) { ?>
                            <div class="col-12 col-md-4">
                                <strong>Correo electrónico:</strong>
                            </div>
                            <div class="col-12 col-md-8">
                                <span id="correo"></span>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <strong>Apodo:</strong>
                        </div>
                        <div class="col-12 col-md-8">
                            <span class="mt-2" id="apodo"></span>
                        </div>
                    </div>
                    <!-- End of Profile Details -->
                </div>
            </div>
        </div>
    </div>

    <!-- Libros en venta -->
    <div class="row text-dark bg-light rounded ">
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
        <div class="row inf-nav mt-3 mb-3 ">
            <div class="col d-flex justify-content-end">
                <!-- EDIT OR SAVE BUTTON -->
                <?php if (isset($_POST["editProfileSubmit"])) : ?>
                    <button type="submit" class="btn btn-lg primary-btn" name="saveProfileSubmit">Guardar cambios</button>
                <?php else : ?>
                    <form action="profile.php?id=<?php echo $userId ?>" method="POST">
                        <button type="submit" class="btn btn-lg primary-btn" name="editProfileSubmit">Editar Perfil</button>
                    <?php endif; ?>
                    </form>
            </div>
        <?php } ?>
        </form>

        </div>
        <!-- Editar perfil -->
</div>
<!-- VALORACIONES / COMENTARIOS -->

<div class="container mb-5">
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
                    <?php if (isset($userId) && $userId == $_GET['id']) { ?>
                        <button class="btn btn-success btn-lg me-3" onclick="window.location.href='../bookform/book_form.php'">
                            <i class="bi bi-book me-1"></i> Subir Libro
                        </button>
                    <?php } ?>
                </div>
                <!--Ultimos Productos Container-->
                <div class="container mb-4">
                    <!--Book Row Container-->
                    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" id="carouselInner"></div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <!--Ultimos Productos Container FIN-->
            </div>
            <div id="signup" class="tab-pane">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h2 class="mt-3">Valoraciones de los usuarios</h2>
                </div>
                <!-- Aquí es donde se cargarán las valoraciones -->
                <div id="reviewsContainer" class="mt-4"></div>
            </div>
        </div>
    </div>
</div>
<!-- VALORACIONES / COMENTARIOS FIN-->
<?php require_once "../footer/upper_footer.php"; ?>
<script src="../navbar/navbar.js"></script>
<script src="profile.js"></script>
<?php require_once "../footer/footer_links.php"; ?>