<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  echo "Nombre del libro: " . (isset($_POST['nombre']) ? $_POST['nombre'] : '') . "<br>";
  echo "ISBN: " . (isset($_POST['isbn']) ? $_POST['isbn'] : '') . "<br>";
  echo "Autor: " . (isset($_POST['autor']) ? $_POST['autor'] : '') . "<br>";
  echo "Editorial: " . (isset($_POST['editorial']) ? $_POST['editorial'] : '') . "<br>";
  echo "Género: " . (isset($_POST['genero']) ? $_POST['genero'] : '') . "<br>";
  echo "Estado del libro: " . (isset($_POST['estado']) ? $_POST['estado'] : '') . "<br>";
  echo "Precio: " . (isset($_POST['precio']) ? $_POST['precio'] : '') . "<br>";
  echo "Acepta cambios: " . (isset($_POST['cambio']) ? 'Sí' : 'No') . "<br>";
  echo "Realiza envíos: " . (isset($_POST['envio']) ? 'Sí' : 'No') . "<br>";
  echo "Descripción: " . (isset($_POST['descripcion']) ? $_POST['descripcion'] : '') . "<br>";
}
?>