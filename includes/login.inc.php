<?php
if (isset($_POST["login-submit"])) {
    include_once "dbh.inc.php";
    include_once "functions.inc.php";
    include_once "class/user.class.php";
    $conn = Connection::getConnection();
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];

    if (checkEmptyValuesLogin($uid, $pwd) !== false) {
        header("location: ../login/login.php?error=emptyFields");
        exit(); // para el script
    }

    $user = User::login($uid, $pwd);

    if (!$user) {
        header("location: ../login/login.php?error=wrongLogin");
        exit();
    } else {
        // Iniciar sesión y crear la variable de sesión
        session_start();
        $_SESSION["user"] = serialize($user);

        // Redirigir a la página de inicio
        header("location: ../home/home.php");
        exit();
    }
} else {
    header("location: ../login/login.php?error=submitFailed");
    exit();
}
