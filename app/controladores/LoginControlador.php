<?php

require_once "app/basedatos/conexion.php";

class LoginControlador
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
        generarToken();
        cargar_vista("login", "login", ["token" => obtenerToken()], true, false);
    }

    public function validar_usuario()
    {
        $usuario_modelo = new Usuario($this->conn);
        if (!isset($_POST["email"]) || !isset($_POST["password"]) || !isset($_POST["_token"])) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Faltan datos obligatorios", "url" => null]);
            return;
        }

        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        $token = htmlspecialchars($_POST["_token"]);

        if (validarToken($token) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Token no válido", "url" => null]);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Formato de correo electrónico inválido", "url" => null]);
            return;
        }

        $usuario = $usuario_modelo->obtener_usuario_por_email($email);
        if ($usuario) {
            $becado = $usuario_modelo->obtener_becado_por_usuario($usuario["id"]);
            if (password_verify($password, $usuario["clave"])) {
                $_SESSION["usuario"] = $usuario;
                $_SESSION["becado"] = $becado;
                echo json_encode(["title" => "¡BIENVENIDO&nbsp" . strtoupper($usuario["usuario"] . "!"), "status" => "success", "message" => "Iniciando sesión...", "usuario" => $usuario]);
            } else {
                echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Contraseña incorrecta"]);
            }
        } else {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Correo no encontrado"]);
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location:" . constant("URL_SITIO"));
    }
}
