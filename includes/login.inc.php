<?php
if (isset($_POST["login-submit"])) {
    include_once "class/dbh.inc.php";
    include_once "functions.inc.php";
    include_once "class/user.class.php";
    $conn = Connection::getConnection();
    $uid = $_POST["uid"];
    $pwd = $_POST["pwd"];

    if (checkEmptyValuesLogin($uid, $pwd) !== false) {
        header("location: ../login/login.php?error=emptyFields");
        exit();
    }

    $user = User::login($uid, $pwd);

    if (!$user) {
        header("location: ../login/login.php?error=wrongLogin");
        exit();
    } else {
        session_start();
        $_SESSION["user"] = serialize($user);

        header("location: ../home/home.php");
        exit();
    }
} else {
    header("location: ../login/login.php?error=submitFailed");
    exit();
}
