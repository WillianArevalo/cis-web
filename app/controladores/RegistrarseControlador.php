<?php

require_once "app/basedatos/conexion.php";

class RegistrarseControlador
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
        cargar_vista("Registrarse", "index", [], true, false);
    }

    public function crear_usuario()
    {
        $usuario_modelo = new Usuario($this->conn);

        if (!isset($_POST["nombres"]) || !isset($_POST["apellidos"]) || !isset($_POST["email"]) || !isset($_POST["password"]) || !isset($_POST["usuario"]) || !isset($_POST["_token"])) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Todos los campos son obligatorios", "url" => null]);
            return;
        }

        $token = htmlspecialchars($_POST["_token"]);
        $nombre = htmlspecialchars($_POST["nombres"]);
        $apellido = htmlspecialchars($_POST["apellidos"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        $usuario = htmlspecialchars($_POST["usuario"]);

        if (validarToken($token) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Token no válido", "url" => null]);
            return;
        }

        $usuario = $usuario_modelo->obtener_usuario_por_email($email);
        if ($usuario) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "El usuario ya existe.", "url" => "registrarse"]);
            return;
        }

        $data = array(
            "nombres" => $nombre,
            "apellidos" => $apellido,
            "email" => $email,
            "clave" => password_hash($password, PASSWORD_DEFAULT),
            "usuario" => $usuario,
            "rol" => "becado"
        );

        $id = $usuario_modelo->agregar_usuario($data);

        if ($id) {
            echo json_encode(["title" => "¡BIENVENIDO!", "status" => "success", "message" => "Usuario creado correctamente.", "url" => ""]);
        } else {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Error al agregar el usuario.", "url" => ""]);
        }
    }
}
