<?php
class Libro
{
    private $titulo;
    private $isbn;
    private $autor;
    private $editorial;
    private $genero;
    private $estado;
    private $precio;
    private $cambio;
    private $envio;
    private $descripcion;
    private $imagen;
    private $userId;

    function __construct($titulo, $isbn, $autor, $editorial, $genero, $estado, $precio, $cambio, $envio, $descripcion, $imagen, $userId)
    {
        $this->titulo = $titulo;
        $this->isbn = $isbn;
        $this->autor = $autor;
        $this->editorial = $editorial;
        $this->genero = $genero;
        $this->estado = $estado;
        $this->precio = $precio;
        $this->cambio = $cambio;
        $this->envio = $envio;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen;
        $this->userId = $userId;
    }

    public function insertar()
    {
        $conn = Connection::getConnection();

        $stmt = $conn->prepare("INSERT INTO libros_venta (titulo, isbn, autor, editorial, genero, estado, precio, cambio, envio, descripcion, imagen,id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssdiissi", $this->titulo, $this->isbn, $this->autor, $this->editorial, $this->genero, $this->estado, $this->precio, $this->cambio, $this->envio, $this->descripcion, $this->imagen, $this->userId);

        $result = $stmt->execute();

        $stmt->close();
        $conn->close();

        return $result;
    }


    public function imprimir()
    {
        echo "Titulo: " . $this->titulo . "<br>";
        echo "ISBN: " . $this->isbn . "<br>";
        echo "Autor: " . $this->autor . "<br>";
        echo "Editorial: " . $this->editorial . "<br>";
        echo "Género: " . $this->genero . "<br>";
        echo "Estado: " . $this->estado . "<br>";
        echo "Precio: " . $this->precio . "<br>";
        echo "Cambio: " . $this->cambio . "<br>";
        echo "Envío: " . $this->envio . "<br>";
        echo "Descripción: " . $this->descripcion . "<br>";
        echo "UserId: " . $this->userId . "<br>";
    }
}
