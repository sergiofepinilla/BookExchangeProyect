<?php

require_once "modeloProductos.php";
class Productos
{
    private $id;
    private $name;
    private $description;
    private $quantity;
    private $price;
    private $image;
    private $category;

    public function __construct($id)
    {
        $mod = new ModeloProductos();
        $res = $mod->select($id);
        $this->id = $id;
        $this->name = $res["nombre"];
        $this->description = $res["descripcion"];
        $this->quantity = $res["cantidad"];
        $this->price = $res["precio"];
        $this->image = $res["imagen"];
        $this->category = $res["categoria"];
    }
}
