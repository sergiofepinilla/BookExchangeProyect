<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  include_once 'dbh.inc.php';
  include_once 'class/user.class.php';
  include_once 'class/book.class.php';
  $conn = Connection::getConnection();

  session_start();
  $user = unserialize($_SESSION["user"]);
  $userId = $user->getId();

  $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
  $isbn = isset($_POST['isbn']) ? $_POST['isbn'] : '';
  $autor = isset($_POST['autor']) ? $_POST['autor'] : '';
  $editorial = isset($_POST['editorial']) ? $_POST['editorial'] : '';
  $genero = isset($_POST['genero']) ? $_POST['genero'] : '';
  $estado = isset($_POST['estado']) ? $_POST['estado'] : '';
  $precio = isset($_POST['precio']) ? $_POST['precio'] : '';
  $cambio = isset($_POST['cambio']) ? 1 : 0;
  $envio = isset($_POST['envio']) ? 1 : 0;
  $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';


  if (empty($autor)) {
    $autor = "Desconocido";
  }
  if (empty($isbn)) {
    $isbn = "Desconocido";
  }
  if (empty($editorial)) {
    $editorial = "Desconocido";
  }

  if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
    if ($_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
      // Obtener la imagen cargada
      $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
    }
  } else {
    echo "error";
  }

  $libro = new Libro($nombre, $isbn, $autor, $editorial, $genero, $estado, $precio, $cambio, $envio, $descripcion, $imagen, $userId);

  if ($libro->insertar()) {
    header("location: ../home/home.php");
  } else {
    echo "Error al añadir el libro. Por favor, inténtelo de nuevo más tarde.";
  }
}
