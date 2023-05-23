<?php
if (isset($_POST['signup-submit'])) {

    include_once 'dbh.inc.php';
    include_once 'functions.inc.php';
    include_once 'class/user.class.php';
    $conn = Connection::getConnection();
    
    $signupName = $_POST['signupName'];
    $signupNick = $_POST['signupNick'];
    $signupEmail = $_POST['signupEmail'];
    $signupPwd = $_POST['signupPwd'];
    $signupRepwd = $_POST['signupRepwd'];

    if (checkEmptyValuesSignUp($signupName, $signupNick, $signupEmail, $signupPwd, $signupRepwd) !== false) {
        header('location: ../signup/signup.php?error=emptyFields');
        exit();
    }

    if (invalidEmail($signupEmail) !== false) {
        header('location: ../signup/signup.php?error=invalidEmail');
        exit();
    }

    if (matchPwd($signupPwd, $signupRepwd) !== false) {
        header('location: ../signup/signup.php?error=noMatchPwd');
        exit();
    }

    if (uidExists($conn, $signupNick, $signupEmail) !== false) {
        header('location: ../signup/signup.php?error=emailExist');
        exit();
    }

    if (isUserBlocked($conn, $signupEmail) !== false) {
        header('location: ../signup/signup.php?error=userBlocked');
        exit();
    }

    $user = User::createUser($conn, $signupNick, $signupEmail, $signupName, $signupPwd);


    if ($user) {
        session_start();
        $_SESSION["user"] = serialize($user);
        header("location: ../home/home.php");
    } else {
        header("location: ../signup/signup.php?error=signupFailed");
    }

} else {
    header('location: ../signup/login.php?error=submitFailed');
    exit();
}
?>
