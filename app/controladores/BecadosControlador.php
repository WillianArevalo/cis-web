<?php

require_once "app/basedatos/conexion.php";

class BecadosControlador
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
        $becado_modelo = new Becado($this->conn);
        $becados = $becado_modelo->obtener_becados();
        cargar_vista("becados", "index", ["becados" => $becados]);
    }

    public function nuevo()
    {
        verificarSesion();
        verificarRol("admin");
        $comunidad_modelo = new Comunidad($this->conn);
        $usuario_modelo = new Usuario($this->conn);
        $usuarios = $usuario_modelo->obtener_usuarios();
        $comunidades = $comunidad_modelo->obtener_comunidades();
        cargar_vista("becados", "nuevo", ["comunidades" => $comunidades, "usuarios" => $usuarios]);
    }

    public function agregar()
    {
        verificarSesion();
        verificarRol("admin");
        $becado_modelo = new Becado($this->conn);

        if (!isset($_POST["nombre_becado"]) || !isset($_POST["comunidad"]) || !isset($_POST["institucion"]) || !isset($_POST["nivel_academico"]) || !isset($_POST["carrera"]) || !isset($_POST["nivel_estudio"]) || !isset($_POST["usuario_becado"]) || !isset($_FILES["imagen_becado"]) || !isset($_POST["_token"])) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Faltan datos obligatorios", "url" => null]);
            return;
        }

        $token = $_POST["_token"];
        $nombre = $_POST["nombre_becado"];
        $comunidad = $_POST["comunidad"];
        $institucion = $_POST["institucion"];
        $nivel_academico = $_POST["nivel_academico"];
        $carrera = $_POST["carrera"];
        $nivel_estudio = $_POST["nivel_estudio"];
        $usuario = $_POST["usuario_becado"];


        if (validarToken($token) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Token no válido", "url" => null]);
            return;
        }

        $becado = $becado_modelo->obtener_becado_por_nombre($nombre);
        $usuario = $becado_modelo->obtener_becado_por_usuario($usuario);

        if ($usuario) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "El usuario ya tiene un becado asignado"]);
            return;
        }

        if ($becado) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Ya existe un becado con ese nombre", "url" => "becados/nuevo"]);
            return;
        }

        if (isset($_FILES["imagen_becado"])) {
            $imagen = subirImagen("imagen_becado", "becados");
        } else {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "No se ha enviado ninguna imagen"]);
        }

        $data = [
            "nombre" => $nombre,
            "foto" => $imagen,
            "id_comunidad" => $comunidad,
            "institucion" => $institucion,
            "nivel_academico" => $nivel_academico,
            "carrera" => $carrera,
            "nivel_estudio" => $nivel_estudio,
            "id_usuario" => $usuario
        ];

        $insert = $becado_modelo->guardar($data);
        if ($insert) {
            echo json_encode(["title" => "¡ÉXITO!", "status" => "success", "message" => "Becado agregado correctamente", "url" => "becados"]);
        } else {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "No se pudo agregar el becado", "url" => "becados/nuevo"]);
        }
    }

    public function eliminar()
    {
        verificarSesion();
        verificarRol("admin");
        $becado_modelo = new Becado($this->conn);

        if (!isset($_POST["_token"]) || !isset($_POST["id"])) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Faltan datos obligatorios", "url" => null]);
            return;
        }

        $token = htmlspecialchars($_POST["_token"]);
        if (validarToken($token) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Token no válido", "url" => null]);
            return;
        }

        if (is_int($_POST["id"]) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "ID no válido", "url" => null]);
            return;
        }

        $id = htmlspecialchars($_POST["id"]);
        $delete = $becado_modelo->eliminar_becado($id);
        if ($delete) {
            echo json_encode(["title" => "¡ÉXITO!", "status" => "success", "message" => "Becado eliminado correctamente", "url" => "becados"]);
        } else {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "No se pudo eliminar el becado", "url" => "becados"]);
        }
    }

    public function editar()
    {
        verificarSesion();
        verificarRol("admin");
        $becado_modelo = new Becado($this->conn);
        $comunidad_modelo = new Comunidad($this->conn);
        $usuario_modelo = new Usuario($this->conn);
        $id = $this->id;

        if (validarId($id) == false) {
            cargar_vista("error", "index", ["mensaje" => "No se encontro el becado", "url" => "becados"]);
            return;
        }

        $becado = $becado_modelo->obtener_becado($id);
        $comunidades = $comunidad_modelo->obtener_comunidades();
        $usuarios = $usuario_modelo->obtener_usuarios();

        if (!$becado) {
            cargar_vista("error", "index", ["mensaje" => "No se encontro el becado", "url" => "becados"]);
            return;
        }

        cargar_vista("becados", "editar", ["becado" => $becado, "comunidades" => $comunidades, "usuarios" => $usuarios]);
    }

    public function obtener_becado()
    {
        verificarSesion();
        verificarRol("admin");
        $becado_modelo = new Becado($this->conn);

        if (!isset($_POST["id"])) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Faltan datos obligatorios", "url" => null]);
            return;
        }

        $id = htmlspecialchars($_POST["id"]);
        $becado = $becado_modelo->obtener_becado($id);
        if ($becado) {
            echo json_encode(["status" => "success", "becado" => $becado]);
        } else {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "No se encontro el becado", "url" => "becados"]);
        }
    }

    public function actualizar()
    {
        verificarSesion();
        verificarRol("admin");
        $becado_modelo = new Becado($this->conn);

        if (!isset($_POST["id_becado"]) || !isset($_POST["nombre_becado_editar"]) || !isset($_POST["comunidad_editar"]) || !isset($_POST["institucion_editar"]) || !isset($_POST["nivel_academico_editar"]) || !isset($_POST["carrera_editar"]) || !isset($_POST["nivel_estudio_editar"]) || !isset($_POST["usuario_becado_editar"]) || !isset($_FILES["imagen_becado"]) || !isset($_POST["_token"])) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Faltan datos obligatorios", "url" => null]);
            return;
        }

        $token = htmlspecialchars($_POST["_token"]);
        $id_becado = htmlspecialchars($_POST["id_becado"]);
        $nombre = htmlspecialchars($_POST["nombre_becado_editar"]);
        $comunidad = htmlspecialchars($_POST["comunidad_editar"]);
        $institucion = htmlspecialchars($_POST["institucion_editar"]);
        $nivel_academico = htmlspecialchars($_POST["nivel_academico_editar"]);
        $carrera = htmlspecialchars($_POST["carrera_editar"]);
        $nivel_estudio = htmlspecialchars($_POST["nivel_estudio_editar"]);
        $id_usuario = $_POST["usuario_becado_editar"];

        if (validarToken($token) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Token no válido", "url" => null]);
            return;
        }

        $becado = $becado_modelo->obtener_becado($id_becado);
        if (!$becado) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "No se encontro el becado", "url" => "becados"]);
            return;
        }

        if (isset($_FILES["imagen_becado"]) && $_FILES["imagen_becado"]["error"] == 0) {
            $imagen = subirImagen("imagen_becado", "becados");
        } else {
            $imagen = $becado["foto"];
        }

        $data = [
            "id_becado" => $id_becado,
            "nombre" => $nombre,
            "foto" => $imagen,
            "id_comunidad" => $comunidad,
            "institucion" => $institucion,
            "nivel_academico" => $nivel_academico,
            "carrera" => $carrera,
            "nivel_estudio" => $nivel_estudio,
            "id_usuario" => $id_usuario
        ];

        $edit = $becado_modelo->editar($data);
        if ($edit) {
            echo json_encode(["title" => "¡ÉXITO!", "status" => "success", "message" => "Becado editado correctamente", "url" => "becados"]);
        } else {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "No se pudo editar el becado", "url" => "becados"]);
        }
    }

    public function buscar_becado()
    {
        verificarSesion();
        verificarRol("admin");
        $becado_modelo = new Becado($this->conn);

        if (!isset($_POST["nombre"])) {
            echo json_encode(["status" => "error", "message" => "Faltan datos obligatorios"]);
            return;
        }

        $nombre = htmlspecialchars($_POST["nombre"]);
        $becados = $becado_modelo->obtener_becados_por_nombre($nombre);
        if ($becados) {
            $html = cards_becados($becados);
            echo json_encode(["status" => "success", "becados" => $becados, "html" => $html]);
        } else {
            $html = cards_becados($becados);
            echo json_encode(["status" => "error", "html" => $html]);
        }
    }
}
