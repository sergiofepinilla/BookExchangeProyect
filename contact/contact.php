<?php require_once "../header/header.php"; ?>
<?php require_once "../navbar/navbar.php";
if (isset($_SESSION['user']) && $userType == 2) {
    echo '<script>window.location.href = "../home/home.php";</script>';
    echo '<img src="../assets/img/403.png" alt="forbidden" class="dark-theme w-100">';
    require_once "../footer/upper_footer.php";
    echo '<script src="../navbar/navbar.js"></script>';
    require_once "../footer/footer_links.php";
    exit();
}
?>
<!--CONTACT INICIO-->
<div class="container mt-3 text-center text-md-start">
    <h2>¿Dónde nos encontramos?</h2>
    <div class="custom-hr w-100"></div>
</div>
<div class="container map-container mb-3 mb-lg-0">
    <iframe class="w-100 mt-4 custom-card-border-2" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3030.1277515822867!2d-4.014140323417795!3d40.58293544550607!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4175ec9f68fe3d%3A0xcdea945e27ea5e5b!2sIES%20Infanta%20Elena!5e0!3m2!1ses!2ses!4v1681394605391!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<div class="container mb-5">
    <div class="row">
        <div class="col-12 col-lg-6 mb-3 mt-3">
            <form action="../includes/contact.inc.php" method="POST">
                <div class="col-12 d-flex justify-content-center d-lg-block">
                    <h2 class="title mt-2 text-center">Contacta con nosotros</h2>
                </div>
                <div class="custom-hr mb-4"></div>
                <?php
                if (isset($_SESSION["contactSuccess"])) { ?>
                    <div class=" alert alert-success alert-dismissible fade show" role="alert">
                        <p>Gracias por contactarnos. Tu consulta se ha enviado <strong>correctamente</strong>.</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php }
                unset($_SESSION["contactSuccess"]);
                ?>
                <?php if (isset($_GET["error"])) {
                    if ($_GET["error"] == "emptyFields") {
                        echo "<p class='text-danger'>There are empty fields</p>";
                    } elseif ($_GET["error"] == "invalidEmail") {
                        echo "<p class='text-danger'>Invalid email</p>";
                    }
                } ?>
                <div class="mb-3 mt-2">
                    <label for="nombreContacto" class="form-label custom-text">
                        <strong>Nombre Completo *</strong>
                    </label>
                    <input type="text" maxlength="50" class="form-control" id="nombreContacto" aria-describedby="nombreContacto" name="contactName" required <?php if (isset($_SESSION["user"])) {
                                                                                                                                                                    echo "value='" . $userName . "'";
                                                                                                                                                                } ?>>
                    <div id="nombreContacto" class="form-text custom-text">Este nombre se usara para ponernos en contacto con usted.</div>
                </div>
                <div class="mb-3">
                    <label for="emailInput" class="form-label custom-text">
                        <strong>E-mail *</strong>
                    </label>
                    <input type="email" maxlength="50" class="form-control" id="emailInput" name="contactEmail" required <?php if (isset($_SESSION["user"])) {
                                                                                                                                echo "value='" . $userEmail . "'";
                                                                                                                            } ?>>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label custom-text">
                        <strong>Comentario *</strong>
                    </label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Describe brevemente la razón de contacto..." name="contactText" required></textarea>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                    <label class="form-check-label custom-text" for="exampleCheck1">
                        <strong>Consiento el tratamiento de mis datos.</strong> BookExchange tratará sus datos con la finalidad de contestar a sus consultas, dudas o reclamaciones. Puede ejercer sus derechos de acceso, rectificación, supresión, portabilidad, limitación y oposición, como le informamos en nuestra <a href="" class="text-primary">Política de Privacidad</a> y <a href="" class="text-primary">Aviso Legal.</a>
                    </label>
                </div>
                <button type="submit" class="fw-bold btn dark-theme custom-text custom-card-border mt-3" name="contact-submit">Enviar</button>
            </form>
        </div>
        <div class="col-12 col-lg-6 mb-3 mt-3">
            <div class="col-12 d-flex justify-content-center d-lg-block">
                <h2 class="title mt-2 text-center custom-text">Datos de contacto</h2>
            </div>
            <div class="custom-hr mb-4"></div>
            <!-- BookExchange Datos de contacto Superior-->
            <div class="row text-center">
                <div class="col-6 ">
                    <div class="col-12 ">
                        <label class="form-label custom-text ">
                            <strong>BookExchange (Madrid)</strong>
                        </label>
                        <div class="col 12 custom-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill text-danger" viewBox="0 0 16 16">
                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                            </svg>
                            <strong>Dirección</strong>
                        </div>
                        <p class="custom-text">&emsp;Calle Falsa 123</p>
                    </div>
                    <div class="col-12 custom-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill text-success" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                        </svg>
                        <strong>Teléfono</strong>
                        <p>&emsp;+34 666 999 666</p>
                    </div>
                    <div class="col-12 custom-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill text-warning" viewBox="0 0 16 16">
                            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z" />
                        </svg>
                        <strong>Correo Electrónico</strong>
                        <p>&emsp;bookExchange@gmail.com</p>
                    </div>
                    <div class="col-12 custom-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill text-secondary" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                        </svg>
                        <strong>Horario</strong>
                        <p>&emsp;10:00-18:00</p>
                    </div>
                </div>
                <!-- BookExchange Datos de contacto Inferior-->
                <div class="col-6 ">
                    <div class="col-12">
                        <label class="form-label custom-text">
                            <strong>BookExchange (Barcelona)</strong>
                        </label>
                        <div class="col 12 custom-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill text-danger" viewBox="0 0 16 16">
                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                            </svg>
                            <strong>Dirección</strong>
                        </div>
                        <p class="custom-text">&emsp;Calle Falsa 123</p>
                    </div>
                    <div class="col-12 custom-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill text-success" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                        </svg>
                        <strong>Teléfono</strong>
                        <p>&emsp;+34 666 999 666</p>
                    </div>
                    <div class="col-12 custom-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill text-warning" viewBox="0 0 16 16">
                            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z" />
                        </svg>
                        <strong>Correo Electrónico</strong>
                        <p>&emsp;bookExchange@gmail.com</p>
                    </div>
                    <div class="col-12 custom-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill text-secondary" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                        </svg>
                        <strong>Horario</strong>
                        <p>&emsp;10:00-18:00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--CONTACT FIN -->
<?php require_once "../footer/upper_footer.php"; ?>
<script src="../navbar/navbar.js"></script>
<?php require_once "../footer/footer_links.php"; ?>