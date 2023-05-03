<?php
class ModeloTipo
{
    private $conn;

    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }

    public function select($id)
    {
        $sql = "SELECT * FROM tipo WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
