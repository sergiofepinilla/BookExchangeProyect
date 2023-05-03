<?php
function checkEmptyValues($name, $email, $uid, $pwd, $pwdRepeat)
{
    $result = null;
    if (
        empty($name) ||
        empty($email) ||
        empty($uid) ||
        empty($pwd) ||
        empty($pwdRepeat)
    ) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function checkEmptyValuesLogin($uid, $pwd)
{
    $result = null;
    if (empty($uid) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function checkEmptyValuesContact($contactName, $contactEmail, $contactText)
{
    $result = null;
    if (empty($contactName) || empty($contactEmail) || empty($contactText)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function checkEmptyValuesSignUp(
    $signupName,
    $signupNick,
    $signupEmail,
    $signupPwd,
    $signupRepwd
) {
    $result = null;
    if (
        empty($signupName) ||
        empty($signupNick) ||
        empty($signupEmail) ||
        empty($signupPwd) ||
        empty($signupRepwd)
    ) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidUid($uid)
{
    $result = null;

    if (!preg_match("/^[a-zA-Z0-9]*$/", $uid)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}
function invalidEmail($email)
{
    $result = null;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}
function matchPwd($pwd, $pwdRepeat)
{
    $result = null;
    if ($pwd !== $pwdRepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function uidExists($conn, $uid, $email)
{
    $sql = 'SELECT US.id as id, US.tipo as userType, US.apodo as nick,
    US.correo as email, P.id_usuario as userIdPassword, P.clave as userPassword, 
    D.nombre as fullname, D.genero as gender, D.fecha_nacimiento as datebirth, 
    D.direccion as address, D.pais as country, D.foto_perfil as pfp 
    FROM usuarios US
    INNER JOIN claves P ON US.id = P.id_usuario
    INNER JOIN datos_usuario D on US.id = D.id_usuario
    WHERE apodo = ? OR correo = ?;';


    $stmt = mysqli_stmt_init($conn);
    $result = null;

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../login/login.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $uid, $email);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        // Crear un objeto User a partir de los datos obtenidos
        $user = new User($row['id'], $row['userType'], $row['nick'], $row['email'], $row['fullname'], $row['userPassword'],
            $row['gender'], $row['datebirth'], $row['country'], $row['address'], $row['pfp']);
        return $user;
    } else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}


function saveTicket($conn, $contactName, $contactEmail, $contactText)
{
    $sql = "INSERT INTO contacto (nombre_completo,correo,descripcion) VALUES (?,?,?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $contactName, $contactEmail, $contactText);
    $stmt->execute();
}


function updateData(
    $conn,
    $userId,
    $profileUserName,
    $profileAddress,
    $profileGender,
    $profileCounty,
    $profileBirthDay,
    $image
) {
    $sql = "UPDATE datos_usuario INNER JOIN usuarios ON datos_usuario.id_usuario = usuarios.id SET datos_usuario.nombre = ?,
     datos_usuario.genero = ?, datos_usuario.fecha_nacimiento = ?, datos_usuario.direccion = ?, datos_usuario.pais = ?,
      datos_usuario.foto_perfil = ? WHERE usuarios.id = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssssssi",
        $profileUserName,
        $profileGender,
        $profileBirthDay,
        $profileAddress,
        $profileCounty,
        $image,
        $userId
    );
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION["fullname"] = $profileUserName;
        $_SESSION["gender"] = $profileGender;
        $_SESSION["datebirth"] = $profileBirthDay;
        $_SESSION["country"] = $profileCounty;
        $_SESSION["address"] = $profileAddress;
        $_SESSION["pfp"] = $image;
        return true; // Se realizaron cambios
    } else {
        return false; // No se realizaron cambios
    }
}
