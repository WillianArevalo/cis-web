<?php

require_once "app/basedatos/conexion.php";

class DashboardControlador
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
        verificarSesion();
        verificarRol("admin");
        $proyecto_modelo = new Proyecto($this->conn);
        $becado_modelo = new Becado($this->conn);
        $comunidad_modelo = new Comunidad($this->conn);
        $total = $proyecto_modelo->cantidad_proyectos();
        $total_becados = $becado_modelo->cantidad_becados();
        $total_comunidades = $comunidad_modelo->cantidad_comunidades();
        cargar_vista("Dashboard", "index", ["total_proyectos" => $total["cantidad"], "total_becados" => $total_becados["cantidad"], "total_comunidades" => $total_comunidades["cantidad"]]);
    }
}
