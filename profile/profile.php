<?php require_once "../header/header.php"; ?>
<?php require_once "../navbar/navbar.php"; ?>

<?php if (!isset($_GET["id"])) {
    echo '<img src="../assets/img/403.png" alt="forbidden" class="bg-danger w-100">';
    include_once "../footer/footer.php";
    exit();
} ?>

<?php if (isset($_POST["editProfileSubmit"])) { ?>
    <!-- EDIT VERSION -->
    <section>
        <div class="container py-5">
            <!-- TITULO TARJETA -->
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4 border border-danger">
                        <h1>Editar Perfil</h1>
                    </nav>
                </div>
            </div>
            <!-- DIV CONTENEDOR IMAGEN/DATOS -->
            <div class=" row ">
                <!-- DIV CONTENEDOR IMAGEN -->
                <div class=" col-lg-4 ">
                    <div class=" card mb-4 border-danger">
                        <div class=" card-body text-center">
                            <?php if ($userProfilePicture == "") { ?>
                                <img src="../assets/img/userimg/profile.png" class="rounded-circle img-fluid" style="width: 150px; height: 150px;">
                            <?php } else {
                                $image_data = base64_encode(
                                    $userProfilePicture
                                );
                                $image_type = "jpeg";
                                // Cambiar según el tipo de imagen almacenado en la base de datos
                                echo '<img src="data:image/' .
                                    $image_type .
                                    ";base64," .
                                    $image_data .
                                    '" class="rounded-circle img-fluid " style="width: 150px; height: 150px;">';
                            } ?>
                            <h5 class="my-3"><?php echo $userNick; ?></h5>
                            <p class="text-muted mb-1"><?php echo $userEmail; ?></p>
                            <form action="../includes/profile.inc.php" method="POST" enctype="multipart/form-data">
                                <div class="d-flex justify-content-center mb-2">
                                    <!-- CAMBIAR IMAGEN BTN -->
                                    <input type="file" name="profilePicture" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" style="display:none;" accept="image/*">
                                    <label class="custom-file-label btn   btn-primary" for="inputGroupFile01">Cambiar imagen</label>
                                    <!-- SAVE CHANGES BTN -->
                                    <button type="submit" class="btn   btn-primary ms-2" name="saveProfileSubmit">Guardar cambios</button>
                                </div>
                        </div>
                    </div>
                </div>
                <!-- DIV CONTENEDOR DATOS -->
                <div class="col-lg-8">
                    <div class="card mb-4 border border-danger">
                        <div class="card-body">
                            <!-- FULL NAME FIELD -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Nombre</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" maxlength="30" name="profileUserName" class="form-control no-border bg " value="<?php echo $userName; ?>" placeholder="Introduce un nuevo nombre de usuario...">
                                </div>
                            </div>
                            <hr>
                            <!-- EMAILFIELD -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Correo</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $userEmail; ?></p>
                                </div>
                            </div>
                            <hr>

                            </form>
                        </div>
                    </div>
                </div>
    </section>
<?php } else { ?>
    <!-- DATA VERSION -->
    <section>
        <div class="container py-5">
            <!-- TITULO TARJETA -->
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4 border border-danger">
                        <h1>Perfil de Usuario</h1>
                    </nav>
                </div>
            </div>
            <!-- DIV CONTENEDOR IMAGEN/DATOS -->
            <div class="row">
                <!-- DIV CONTENEDOR IMAGEN -->
                <div class="col-lg-4">
                    <div class=" card mb-4 border-danger">
                        <div class="card-body text-center">
                            <?php if ($userProfilePicture == "") { ?>
                                <img src="../assets/img/userimg/profile.png" class="rounded-circle img-fluid" style="width: 150px; height: 150px;">
                            <?php } else {
                                $image_data = base64_encode(
                                    $userProfilePicture
                                );
                                $image_type = "jpeg";
                                // Cambiar según el tipo de imagen almacenado en la base de datos
                                echo '<img src="data:image/' .
                                    $image_type .
                                    ";base64," .
                                    $image_data .
                                    '" class="rounded-circle img-fluid " style="width: 150px; height: 150px;">';
                            } ?>
                            <h5 class="my-3" id="nombre">
                            </h5>
                            <p class="text-muted mb-1" id="email"></p>
                            <!-- FORM EDIT PROFILE -->
                            <form action="profile.php" method="POST">
                                <div class="d-flex justify-content-center mb-2">
                                    <button type="submit" class="btn btn-primary" name="editProfileSubmit">Editar Perfil</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- DIV CONTENEDOR DATOS -->
                <div class="col-lg-8">
                    <div class="card mb-4 border border-danger">
                        <div class="card-body">
                            <!-- FULL NAME FIELD -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $userName; ?></p>
                                </div>
                            </div>
                            <hr>
                            <!-- EMAIL FIELD -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $userEmail; ?></p>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
    </section>
    <!-- VALORACIONES / COMENTARIOS -->
    <div class="container mb-5">
        <h1>Productos y Valoraciones</h1>
        <hr>
        <div class="container mt-5">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#login" id="booksTabLink">Libros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#signup">Valoraciones</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="login" class="tab-pane active">
                    <div class="col-md-12 d-flex justify-content-between align-items-center">
                        <h2 class="mt-3">Libros en Venta</h2>
                        <button class="btn btn-success btn-lg me-3" onclick="window.location.href='../bookform/book_form.php'">
                            <i class="bi bi-book me-1"></i> Subir Libro
                        </button>
                    </div>

                    <!--Ultimos Productos Container-->
                    <div class="container mb-4">
                        <!--Book Row Container-->
                        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner" id="carouselInner">
                            </div>
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
                    <form>

                </div>
                <div id="signup" class="tab-pane">
                    <h2 class="mt-3">Valoraciones y Comentarios</h2>
                    <form>
                        <div class="text-center text-lg-start mt-4 pt-2">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- VALORACIONES / COMENTARIOS FIN-->
<?php } ?>
<?php require_once "../footer/upper_footer.php"; ?>
<script src="../navbar/navbar.js"></script>
<script src="profile.js"></script>
<?php require_once "../footer/footer_links.php"; ?>