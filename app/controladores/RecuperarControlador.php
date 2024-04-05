<?php

require_once "app/basedatos/conexion.php";

class RecuperarControlador
{

    private $id;
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function set_id($id)
    {
        $this->id = $id;
    }

    public function index()
    {
        cargar_vista("reset_password", "index", [], true, false);
    }
}
