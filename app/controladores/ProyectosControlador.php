<?php

require_once "app/basedatos/conexion.php";

class ProyectosControlador
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
        $comunidad_modelo = new Comunidad($this->conn);
        $becado_modelo = new Becado($this->conn);
        $proyectos = $proyecto_modelo->obtener_proyectos();
        $comunidades = $comunidad_modelo->obtener_comunidades();
        $becados = $becado_modelo->obtener_becados();
        cargar_vista("proyectos", "index", ["comunidades" => $comunidades, "proyectos" => $proyectos, "becados" => $becados]);
    }

    public function agregar()
    {
        verificarSesion();
        verificarRol("admin");
        $proyecto_modelo = new Proyecto($this->conn);

        if (!isset($_POST["nombre_proyecto"]) || !isset($_POST["comunidad"]) || !isset($_POST["_token"])) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Todos los campos son obligatorios", "url" => null]);
            return;
        }

        $token = htmlspecialchars($_POST["_token"]);
        $nombre_proyecto = htmlspecialchars($_POST["nombre_proyecto"]);
        $comunidad = htmlspecialchars($_POST["comunidad"]);

        if (validarToken($token) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Token no válido", "url" => null]);
            return;
        }

        $nombreCarpeta = "app/vistas/assets/images/proyectos/" . $nombre_proyecto;

        if (!file_exists($nombreCarpeta) && !is_dir($nombreCarpeta) && !empty($nombre_proyecto) && !empty($nombreCarpeta)) {
            mkdir($nombreCarpeta, 0777, true);
        } else {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Ya existe un proyecto con ese nombre", "url" => "proyectos"]);
            return;
        }

        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

        foreach ($meses as $mes) {
            $carpeta = $nombreCarpeta . "/" . $mes;
            mkdir($carpeta, 0777, true);
        }

        $insert = $proyecto_modelo->agregar_proyecto($nombre_proyecto, $comunidad);
        if ($insert) {
            echo json_encode(["title" => "¡ÉXITO!", "status" => "success", "message" => "Proyecto agregado correctamente", "url" => "proyectos"]);
        } else {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "No se pudo agregar el proyecto", "url" => "proyectos"]);
        }
    }

    public function eliminar()
    {
        verificarSesion();
        verificarRol("admin");
        $proyecto_modelo = new Proyecto($this->conn);
        $becado_modelo = new Becado($this->conn);

        if (!isset($_POST["id"]) || !isset($_POST["_token"])) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Todos los campos son obligatorios", "url" => null]);
            return;
        }

        $token = htmlspecialchars($_POST["_token"]);
        $id = htmlspecialchars($_POST["id"]);
        if (validarToken($token) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Token no válido", "url" => null]);
            return;
        }

        $proyecto = $becado_modelo->obtener_integrantes_proyecto($id);
        if ($proyecto) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "No se puede eliminar el proyecto porque tiene becados asignados", "url" => "proyectos"]);
            return;
        }

        $delete = $proyecto_modelo->eliminar_proyecto($id);
        if ($delete) {
            echo json_encode(["title" => "¡ÉXITO!", "status" => "success", "message" => "Proyecto eliminado correctamente", "url" => "proyectos"]);
        } else {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "No se pudo eliminar el proyecto", "url" => "proyectos"]);
        }
    }

    public function obtener_proyecto()
    {
        verificarSesion();
        verificarRol("admin");
        $proyecto_modelo = new Proyecto($this->conn);
        $becado_modelo = new Becado($this->conn);

        if (!isset($_POST["id"])) {
            echo json_encode(["status" => "error", "message" => "ID no válido"]);
            return;
        }

        $id = htmlspecialchars($_POST["id"]);
        $proyecto = $proyecto_modelo->obtener_proyecto_por_id($id);
        $becados_proyecto = $becado_modelo->obtener_integrantes($id);
        if ($proyecto) {
            echo json_encode(["status" => "success", "proyecto" => $proyecto, "integrantes" => $becados_proyecto]);
        } else {
            echo json_encode(["status" => "error", "message" => "No se pudo obtener el proyecto"]);
        }
    }

    public function buscar_proyecto()
    {
        verificarSesion();
        verificarRol("admin");
        $proyecto_modelo = new Proyecto($this->conn);

        if (!isset($_POST["nombre"])) {
            echo json_encode(["status" => "error", "message" => "Nombre no válido"]);
            return;
        }

        $nombre = htmlspecialchars($_POST["nombre"]);
        $proyecto = $proyecto_modelo->obtener_proyecto_completo_por_nombre($nombre);
        if ($proyecto) {
            $html = cards_proyectos($proyecto);
            echo json_encode(["status" => "success", "proyecto" => $proyecto, "html" => $html]);
        } else {
            $html = cards_proyectos($proyecto);
            echo json_encode(["status" => "error", "html" => $html]);
        }
    }

    public function editar()
    {
        verificarSesion();
        verificarRol("admin");
        $proyecto_modelo = new Proyecto($this->conn);

        if (!isset($_POST["id_proyecto_editar"]) || !isset($_POST["nombre_proyecto_editar"]) || !isset($_POST["comunidad_editar"]) || !isset($_POST["_token"])) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Todos los campos son obligatorios", "url" => null]);
            return;
        }

        $token = htmlspecialchars($_POST["_token"]);
        $id = htmlspecialchars($_POST["id_proyecto_editar"]);
        $nombre_proyecto = htmlspecialchars($_POST["nombre_proyecto_editar"]);
        $comunidad = htmlspecialchars($_POST["comunidad_editar"]);

        if (validarToken($token) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Token no válido", "url" => null]);
            return;
        }

        $update = $proyecto_modelo->actualizar_proyecto($id, $nombre_proyecto, $comunidad);
        if ($update) {
            echo json_encode(["title" => "¡ÉXITO!", "status" => "success", "message" => "Proyecto actualizado correctamente", "url" => "proyectos"]);
        } else {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "No se pudo actualizar el proyecto", "url" => "proyectos"]);
        }
    }


    public function asignar()
    {
        verificarSesion();
        $proyecto_modelo = new Proyecto($this->conn);
        $becado_modelo = new Becado($this->conn);
        $id = $this->id;

        if (validarId($id) == false) {
            cargar_vista("error", "index", ["mensaje" => "Proyecto no encontrado", "url" => "proyectos"]);
            return;
        }

        $proyecto = $proyecto_modelo->obtener_proyecto_por_id($id);
        $becados_proyecto = $becado_modelo->obtener_integrantes($id);
        $becados = $becado_modelo->obtener_becados_proyecto($id);
        cargar_vista("proyectos", "asignar", ["proyecto" => $proyecto, "becados_proyecto" => $becados_proyecto, "becados" => $becados]);
    }

    public function asignar_becados()
    {
        $becado_modelo = new Becado($this->conn);

        if (!isset($_POST["id_proyecto"]) || !isset($_POST["_token"])) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Todos los campos son obligatorios", "url" => null]);
            return;
        }

        $token = htmlspecialchars($_POST["_token"]);
        $id_proyecto = htmlspecialchars($_POST["id_proyecto"]);

        if (validarToken($token) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Token no válido", "url" => null]);
            return;
        }

        if (isset($_POST["ids"])) {
            $becados = $_POST["ids"];
            $becado_modelo->eliminar_becados_proyecto($id_proyecto);
            foreach ($becados as $becado) {
                $insert = $becado_modelo->asignar_becado_a_proyecto($id_proyecto, $becado);
            }
            echo json_encode(["title" => "¡ÉXITO!", "status" => "success", "message" => "Becados asignados correctamente", "url" => "proyectos"]);
        } elseif (!isset($_POST["ids"]) && isset($_POST["id_proyecto"])) {
            $becado_modelo->eliminar_becados_proyecto($id_proyecto);
            echo json_encode(["title" => "¡ÉXITO!", "status" => "success", "message" => "Becedos actualizados correctamente", "url" => "proyectos"]);
        } else {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "No se pudo asignar los becados", "url" => "proyectos"]);
        }
    }
}
