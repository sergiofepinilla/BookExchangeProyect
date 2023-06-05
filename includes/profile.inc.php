<?php
if (isset($_POST['saveProfileSubmit'])) {
    include_once 'class/dbh.inc.php';
    include_once 'functions.inc.php';
    include_once 'class/user.class.php';
    $conn = Connection::getConnection();

    session_start();
    $user = unserialize($_SESSION["user"]);
    $userId = $user->getId();
    $userName = $user->getName();

    $userProfilePicture = $user->getProfilePicture();

    $profileUserName = $_POST['profileUserName'];

    if (empty($profileUserName)) {
        $profileUserName = $userName;
    }

    $image = $userProfilePicture;

    if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === 0) {
        $image = file_get_contents($_FILES['profilePicture']['tmp_name']);
    }
    // No Hay Cambios
    if ($userName == $profileUserName && $image == $userProfilePicture) {
        unset($_SESSION['editProfileSubmit']);
        header('location: ../profile/profile.php?id=' . $userId);
    } else {
        //Hay Cambios
        updateData($conn, $userId, $profileUserName, $image);
        $user->setName($profileUserName);
        $user->setProfilePicture($image);
        $_SESSION["user"] = serialize($user);
        unset($_SESSION['editProfileSubmit']);
        header('location: ../profile/profile.php?id=' . $userId);
    }
}
