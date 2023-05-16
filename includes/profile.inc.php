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

    // Current User Data
    $userProfilePicture = $user->getProfilePicture();

    // New Form Values
    $profileUserName = $_POST['profileUserName']; // Form Full Name

    if (empty($profileUserName)) {
        $profileUserName = $userName; // If no new name entered, use current name
    }

    $image = $userProfilePicture; // Use current image by default

    if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === 0) {
        // If a new image was uploaded, use it instead
        $image = file_get_contents($_FILES['profilePicture']['tmp_name']);
    }

    if ($userName == $profileUserName && $image == $userProfilePicture) {
        // No changes
        unset($_SESSION['editProfileSubmit']);
        header('location: ../profile/profile.php?id='.$userId);
    } else {
        // There were changes
        updateData($conn, $userId, $profileUserName, $image);
        $user->setName($profileUserName);
        $user->setProfilePicture($image);
        unset($_SESSION['editProfileSubmit']);
        header('location: ../profile/profile.php?id='.$userId);
    }
}

