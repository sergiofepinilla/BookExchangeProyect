<?php require_once '../header/header.php' ?>
<?php require_once '../navbar/navbar.php' ?>

<?php require_once '../navbar/navbar.php';
if (isset($_SESSION['user'])) {
  echo '<img src="../assets/img/403.png" alt="forbidden" class="bg-danger w-100">';
  include_once "../footer/footer.php";
  exit();
} ?>
<div class="container mt-5 mb-5 ">
  <section>
    <div class="container-fluid mb-5 mt-5">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="https://www.go.ooo/img/bg-img/Login.jpg" class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <form action="../includes/login.inc.php" method="POST">
            <!-- Email Input -->
            <div class="form-outline mb-4">
              <label class="form-label" for="form3Example3">Direccion de correo</label>
              <input type="text" id="form3Example3" class="form-control form-control-lg" placeholder="Introduce el correo electronico" name="uid" maxlength="69" />
            </div>

            <!-- Password Input -->
            <div class="form-outline mb-3">
              <label class="form-label" for="form3Example4">Contraseña</label>
              <input type="password" id="form3Example4" class="form-control form-control-lg" placeholder="Introduce la contraseña" name="pwd" maxlength="69" />
            </div>

            <?php if (isset($_GET['error'])) {
              if ($_GET['error'] == 'emptyFields') {
                echo '<p class="text-danger">Hay campos vacios</p>';
              } else if ($_GET['error'] == 'submitFailed') {
                echo '<p class="text-danger">Consulta fallida</p>';
              } else if ($_GET['error'] == 'stmtFailed') {
                echo '<p class="text-danger">Error Interno</p>';
              } else if ($_GET['error'] == 'wrongLogin') {
                echo '<p class="text-danger">Nombre o contraseña incorrectos</p>';
              } else if ($_GET['error'] == 'wrongPass') {
                echo '<p class="text-danger">Contraseña incorrecta</p>';
              }
            }
            ?>

            <div class="d-flex justify-content-between align-items-center">
              <!-- Checkbox -->
              <div class="form-check mb-0">
                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                <label class="form-check-label" for="form2Example3">
                  Recuerdame
                </label>
              </div>
              <a href="#!" class="text-body">¿Olvidaste la contraseña?</a>
            </div>

            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;" name="login-submit">Inicias Sesión</button>
              <p class="small fw-bold mt-2 pt-1 mb-0">¿No tienes una cuenta? <a href="../signup/signup.php" class="link-danger">Registrate</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
<?php require_once '../footer/upper_footer.php' ?>
<script src="../navbar/navbar.js"></script>
<?php require_once '../footer/footer_links.php' ?>