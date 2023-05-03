<?php
class ModeloProductos
{
    private $conn;

    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }

    public function select($id)
    {
        $sql = "SELECT * FROM productos WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function selectAll()
    {
        $sql = "SELECT * FROM productos";
        $result = $this->conn->query($sql);
        $rows = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        echo json_encode($rows);
    }
}
