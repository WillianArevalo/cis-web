<?php

require "app/basedatos/conexion.php";

class PerfilControlador
{
    private $conn;
    private $id;
    private $usuarioSession;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
        $this->usuarioSession = obtenerSesión("usuario");
    }

    public function set_id($id)
    {
        $this->id = $id;
    }

    public function index()
    {
        verificarSesion();
        cargar_vista("perfil", "index");
    }

    public function cambiar_correo()
    {
        verificarSesion();
        $usuario_modelo = new Usuario($this->conn);

        if (!isset($_POST["email"]) || !isset($_POST["password"]) || !isset($_POST["_token"])) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Todos los campos son obligatorios", "url" => null]);
            return;
        }

        $token = htmlspecialchars($_POST["_token"]);
        $password = htmlspecialchars($_POST["password"]);
        $correo = htmlspecialchars($_POST["email"]);
        $id = $this->usuarioSession["id"];

        if (validarToken($token) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Token no válido", "url" => null]);
            return;
        }

        $usuario = $usuario_modelo->obtener_usuario_por_id($id);
        if (password_verify($password, $usuario["clave"])) {
            $update = $usuario_modelo->cambiar_correo($id, $correo);
            if ($update) {
                echo json_encode(["status" => "success", "message" => "Correo cambiado con exito."]);
            } else {
                echo json_encode(["status" => "error", "message" => "No se pudo cambiar el correo."]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Contraseña incorrecta."]);
        }
    }
}
