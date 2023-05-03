<?php

require_once "modeloTipo.php";
class Tipo
{
    private $id;
    private $descripcion;

    public function __construct($id, $descripcion = "")
    {
        $this->id = $id;
        if (empty($descripcion)) {
            $mod = new ModeloTipo();
            $this->descripcion = $mod->select($id)["descripcion"];
        } else {
            $this->descripcion = $descripcion;
        }
    }


    /* GETTER & SETTER */

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
}
