<?php require_once '../header/header.php' ?>
<?php require_once '../navbar/navbar.php' ?>

<?php
if (isset($_SESSION['user'])) {
  echo '<script>window.location.href = "../home/home.php";</script>';
  echo '<img src="../assets/img/403.png" alt="forbidden" class="dark-theme w-100">';
  require_once "../footer/upper_footer.php";
  echo '<script src="../navbar/navbar.js"></script>';
  require_once "../footer/footer_links.php";
  exit();
} ?>
<div class="container mt-5 mb-5">
  <section>
    <div class="container-fluid mb-5 mt-5">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-8 col-lg-6 rounded  p-md-5">
          <h2>Registro</h2>
          <div class="custom-hr w-100 mb-3 mt-3"></div>
          <form action="../includes/signup.inc.php" method="POST" id="signupForm">
            <!-- Nombre completo input -->
            <div class="form-outline mb-4">
              <label class="form-label custom-text" for="signupName">
                Nombre Completo
              </label>
              <input type="text" id="signupName" class="form-control form-control-lg" placeholder="Introduce el nombre completo" name="signupName" maxlength="30 " required />
            </div>
            <!-- Nombre de usuario input -->
            <div class="form-outline mb-4">
              <label class="form-label custom-text" for="signupNick">
                Nombre de Usuario
              </label>
              <input type="text" id="signupNick" class="form-control form-control-lg" placeholder="Introduce el nombre de usuario" name="signupNick" maxlength="16" required />
            </div>
            <!-- Correo electrónico input -->
            <div class="form-outline mb-4">
              <label class="form-label custom-text" for="signupEmail">
                Correo Electronico
              </label>
              <input type="text" id="signupEmail" class="form-control form-control-lg" placeholder="Introduce el correo electrónico" name="signupEmail" maxlength="69" required />
            </div>
            <!-- Contraseña input -->
            <div class="form-outline mb-4">
              <label class="form-label custom-text" for="signupPwd">
                Contraseña
              </label>
              <input type="password" id="signupPwd" class="form-control form-control-lg" placeholder="Introduce la contraseña" name="signupPwd" maxlength="69" required />
            </div>
            <!-- Repetir contraseña input -->
            <div class="form-outline mb-4">
              <label class="form-label custom-text" for="signupRepwd">
                Repita la contraseña
              </label>
              <input type="password" id="signupRepwd" class="form-control form-control-lg" placeholder="Repite la contraseña" name="signupRepwd" maxlength="69" required />
            </div>

            <?php if (isset($_GET["error"])) {
             if ($_GET["error"] == "emailExist") {
                echo
                "<p class='text-danger'>El apodo o el correo ya existen</p>";
              } elseif ($_GET["error"] == "stmtFailed") {
                echo
                "<p class='text-danger'>Error interno</p>";
              } elseif ($_GET["error"] == "invalidEmail") {
                echo
                "<p class='text-danger'>Email Invalido</p>";
              } elseif ($_GET["error"] == "userBlocked") {
                echo
                "<p class='text-danger'>El usuario está bloqueado</p>";
              }
            } ?>

            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" class="fw-bold btn btn-lg dark-theme custom-text custom-card-border" style="padding-left: 2.5rem; padding-right: 2.5rem;" name="signup-submit">
                Registrarse
              </button>
              <p class="small fw-bold mt-2 pt-1 mb-5 custom-text">
                ¿Ya tienes una cuenta?
                <a href="../login/login.php" class="accent-color">
                  Iniciar Sesion
                </a>
              </p>
            </div>
            <input type="hidden" name="signup-submit" value="1">
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

<script src="signup.js"></script>
<?php require_once '../footer/upper_footer.php' ?>
<script src="../navbar/navbar.js"></script>
<?php require_once '../footer/footer_links.php' ?>