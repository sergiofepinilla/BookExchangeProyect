<?php
if (isset($_POST['saveProfileSubmit'])) {
    include_once 'dbh.inc.php';
    include_once 'functions.inc.php';
    include_once 'class/user.class.php';
    $conn = Connection::getConnection();

    session_start();
    $user = unserialize($_SESSION["user"]);
    $userId = $user->getId();
    $userName = $user->getName();
    

    //Current User Data
    $userProfilePicture;
    // New Form Values
    $profileUserName = $_POST['profileUserName']; //Form Full Name

    if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === 0) {
        if ($_FILES['profilePicture']['error'] == UPLOAD_ERR_OK) {
            $image = file_get_contents($_FILES['profilePicture']['tmp_name']);
        }
    } else {
        $image = $userProfilePicture;
    }

    if (
        $userName == $profileUserName &&
        $image == $userProfilePicture
    ) {
        // No ha habido cambios
        unset($_SESSION['editProfileSubmit']);
        header('location: ../profile/profile.php?id='.$userId);
    } else {
        // Ha habido cambios
        updateData($conn, $userId, $profileUserName, $image);
        unset($_SESSION['editProfileSubmit']);
        header('location: ../profile/profile.php?id='.$userId);
    }
}
