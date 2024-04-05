<?php

require_once "app/basedatos/conexion.php";

class InicioControlador
{
    private $id;
    private $conn;
    private $becadoSession;


    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
        $this->becadoSession = obtenerSesión("becado");
    }

    public function set_id($id)
    {
        $this->id = $id;
    }

    public function index()
    {
        verificarSesion();
        verificarRol("becado");
        $becado_modelo = new Becado($this->conn);
        $reporte_modelo = new Reporte($this->conn);
        if ($this->becadoSession == null) {
            $proyecto = null;
        } else {
            $proyecto = $becado_modelo->obtener_proyecto_del_becado($this->becadoSession["id"]);
        }
        if ($proyecto != null) {
            $id_proyecto = $proyecto["id"];
            $reporte = $reporte_modelo->obtener_reporte($id_proyecto);
            $months = array();
            foreach ($reporte as $r) {
                array_push($months, $r["mes"]);
            }
            $integrantes = $becado_modelo->obtener_integrantes_proyecto($proyecto["id"]);
            $cantidad_integrantes = $becado_modelo->obtener_cantidad_de_integrantes_proyecto($proyecto["id"]);
        } else {
            $integrantes = null;
            $cantidad_integrantes = 0;
            $months = null;
        }
        cargar_vista("inicio", "index", ["proyecto" => $proyecto, "integrantes" => $integrantes, "total_integrantes" => $cantidad_integrantes, "mes_reporte" => $months]);
    }
}
