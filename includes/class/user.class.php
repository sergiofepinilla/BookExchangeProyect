<?php
class User
{
    private $id;
    private $nick;
    private $userType;
    private $email;
    private $name;
    private $password;
    private $profilePicture;

    public function __construct($id, $nick, $userType, $email, $name, $password,$profilePicture)
    {
        $this->id = $id;
        $this->nick = $nick;
        $this->userType = $userType;
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
        $this->profilePicture = $profilePicture;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNick()
    {
        return $this->nick;
    }

    public function getUserType()
    {
        return $this->userType;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getProfilePicture()
    {
        return $this->profilePicture;
    }

    public function setName($name)
{
    $this->name = $name;
}

public function setProfilePicture($profilePicture)
{
    $this->profilePicture = $profilePicture;
}

    public static function createUser($conn, $nick, $email, $name, $password)
    {

        $type = 1;
        $sql = "INSERT INTO usuarios (apodo, tipo, correo) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sis", $nick, $type, $email);
        $stmt->execute();
        $id = $stmt->insert_id;

        $defaultProfilePic = file_get_contents(__DIR__ . '/../../assets/img/userimg/profile.png');
        $sql = "INSERT INTO datos_usuario (id_usuario, nombre,foto_perfil) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $id, $name, $defaultProfilePic);
        $stmt->execute();


        $sql = "INSERT INTO claves (id_usuario, clave) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("is", $id, $hashedPassword);
        $stmt->execute();

        return new User($id, $nick, $type, $email, $name, $hashedPassword, null, null, null, null, null);
    }

    public static function authenticate($conn, $username, $password)
    {
        $sql = "SELECT id FROM usuarios WHERE apodo = ? OR correo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return null;
        }

        $id = $result->fetch_assoc()['id'];
        $user = new User($id, null, null, null, null, null, null);
        $user->loadUserById($conn, $id);

        $hashedPwd = $user->getPassword();

        if (password_verify($password, $hashedPwd)) {
            return $user;
        } else {
            return null;
        }
    }
    public static function login($username, $password)
    {
        $conn = Connection::getConnection();
        $user = User::authenticate($conn, $username, $password);

        if (!$user) {
            return null;
        }

        return $user;
    }

    public function loadUserById($conn, $id)
    {
        $sql = "SELECT id, apodo, tipo, correo, nombre, clave,foto_perfil FROM usuarios JOIN datos_usuario ON usuarios.id = datos_usuario.id_usuario JOIN claves ON usuarios.id = claves.id_usuario WHERE usuarios.id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $userData = $result->fetch_assoc();

        $this->id = $userData['id'];
        $this->nick = $userData['apodo'];
        $this->userType = $userData['tipo'];
        $this->email = $userData['correo'];
        $this->name = $userData['nombre'];
        $this->password = $userData['clave'];
        $this->profilePicture = $userData['foto_perfil'];
    }

    function signupUser($conn, $signupName, $signupNick, $signupEmail, $signupPassword)
    {
        // Crear un nuevo objeto User
        $user = User::createUser($conn, $signupNick, $signupEmail, $signupName, $signupPassword);
        if ($user) {
            $user->loadUserById($conn, $user->getId());
            session_start();
            $_SESSION["user"] = serialize($user);
            header("location: ../home/home.php");
        } else {
            header("location: ../signup/signup.php?error=signupFailed");
        }
    }
}
