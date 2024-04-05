<?php

require "app/basedatos/conexion.php";

class ComunidadesControlador
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
        $comunidad_modelo = new Comunidad($this->conn);
        $comunidades = $comunidad_modelo->obtener_comunidades();
        cargar_vista("comunidades", "index", ["comunidades" => $comunidades]);
    }

    public function agregar()
    {
        verificarSesion();
        verificarRol("admin");
        $comunidad_modelo = new Comunidad($this->conn);

        if (!isset($_POST["nombre"]) || !isset($_POST["nombre_comunidad"]) || !isset($_POST["_token"])) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Todos los campos son obligatorios", "url" => null]);
            return;
        }

        $token = htmlspecialchars($_POST["_token"]);
        $nombre_comunidad = htmlspecialchars($_POST["nombre_comunidad"]);

        if (validarToken($token) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Token no válido", "url" => null]);
            return;
        }

        $buscar = $comunidad_modelo->obtener_comunidad_por_nombre($nombre_comunidad);
        if ($buscar) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "La comunidad ya existe", "url" => "comunidades"]);
            exit;
        }

        $insert = $comunidad_modelo->agregar_comunidad($nombre_comunidad);
        if ($insert) {
            echo json_encode(["title" => "¡ÉXITO!", "status" => "success", "message" => "Comunidad agregada correctamente", "url" => "comunidades"]);
        } else {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Error al agregar la comunidad", "url" => "comunidades"]);
        }
    }

    public function eliminar()
    {
        verificarSesion();
        verificarRol("admin");
        $comunidad_modelo = new Comunidad($this->conn);
        $becado_modelo = new Becado($this->conn);

        if (!isset($_POST["id"]) || !isset($_POST["_token"])) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Todos los campos son obligatorios", "url" => null]);
            return;
        }

        $token = htmlspecialchars($_POST["_token"]);
        $id = htmlspecialchars($id = $_POST["id"]);

        if (validarToken($token) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Token no válido", "url" => null]);
            return;
        }

        if (validarId($id) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "ID no válido", "url" => null]);
            return;
        }

        $becados = $becado_modelo->obtener_becados_por_comunidad($id);
        if ($becados) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "No se puede eliminar la comunidad porque tiene becados asociados", "url" => "comunidades"]);
            exit;
        }

        $delete = $comunidad_modelo->eliminar_comunidad($id);
        if ($delete) {
            echo json_encode(["title" => "¡ÉXITO!", "status" => "success", "message" => "Comunidad eliminada correctamente", "url" => "comunidades"]);
        } else {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Error al eliminar la comunidad", "url" => "comunidades"]);
        }
    }

    public function obtener_comunidad()
    {
        verificarSesion();
        verificarRol("admin");
        $comunidad_modelo = new Comunidad($this->conn);

        if (!isset($_POST["id"])) {
            echo json_encode(["status" => "error", "message" => "ID no válido"]);
            return;
        }

        $id = htmlspecialchars($_POST["id"]);
        if (validarId($id) == false) {
            echo json_encode(["status" => "error", "message" => "Token no válido"]);
            return;
        }

        $comunidad = $comunidad_modelo->obtener_comunidad_por_id($id);
        if ($comunidad) {
            echo json_encode(["status" => "success", "comunidad" => $comunidad]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al obtener la comunidad"]);
        }
    }

    public function editar()
    {
        verificarSesion();
        verificarRol("admin");
        $comunidad_modelo = new Comunidad($this->conn);

        if (!isset($_POST["id_comunidad"]) || !isset($_POST["nombre_comunidad"]) || !isset($_POST["_token"])) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Todos los campos son obligatorios", "url" => null]);
            return;
        }

        $token = htmlspecialchars($_POST["_token"]);
        $id = htmlspecialchars($_POST["id_comunidad"]);
        $nombre_comunidad = htmlspecialchars($_POST["nombre_comunidad"]);

        if (validarToken($token) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Token no válido", "url" => null]);
            return;
        }

        $update = $comunidad_modelo->actualizar_comunidad($id, $nombre_comunidad);
        if ($update) {
            echo json_encode(["title" => "¡ÉXITO!", "status" => "success", "message" => "Comunidad editada correctamente", "url" => "comunidades"]);
        } else {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Error al editar la comunidad", "url" => "comunidades"]);
        }
    }
}
