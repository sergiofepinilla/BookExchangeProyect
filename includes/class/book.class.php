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
    private $descripcion;
    private $imagen;
    private $userId;

    function __construct($titulo, $isbn, $autor, $editorial, $genero, $estado, $precio, $descripcion, $imagen, $userId)
    {
        $this->titulo = $titulo;
        $this->isbn = $isbn;
        $this->autor = $autor;
        $this->editorial = $editorial;
        $this->genero = $genero;
        $this->estado = $estado;
        $this->precio = $precio;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen;
        $this->userId = $userId;
    }

    public function insertar()
    {
        $conn = Connection::getConnection();

        $stmt = $conn->prepare("INSERT INTO libros_venta (titulo, isbn, autor, editorial, genero, estado, precio, descripcion, imagen,id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssdssi", $this->titulo, $this->isbn, $this->autor, $this->editorial, $this->genero, $this->estado, $this->precio, $this->descripcion, $this->imagen, $this->userId);

        $result = $stmt->execute();

        $stmt->close();
        $conn->close();

        return $result;
    }
}
