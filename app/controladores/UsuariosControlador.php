<?php

require_once  "app/basedatos/conexion.php";


class UsuariosControlador
{
    private $id;
    private $conn;
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
        verificarRol("admin");
        $usuario_modelo = new Usuario($this->conn);
        $usuarios = $usuario_modelo->obtener_usuarios();
        cargar_vista("usuarios", "index", ["usuarios" => $usuarios]);
    }

    public function agregar()
    {
        verificarSesion();
        verificarRol("admin");
        $usuario_modelo = new Usuario($this->conn);
        $token = $_POST["_token"];

        if (validarToken($token) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Token no válido", "url" => null]);
            return;
        }

        $usuario = $usuario_modelo->obtener_usuario_por_email($_POST["email_usuario"]);

        if ($usuario) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "El usuario ya existe.", "url" => "usuarios"]);
            return;
        }

        $data = array(
            "nombres" => $_POST["nombres_usuario"],
            "apellidos" => $_POST["apellidos_usuario"],
            "email" => $_POST["email_usuario"],
            "clave" => password_hash($_POST["clave_usuario"], PASSWORD_DEFAULT),
            "usuario" => $_POST["usuario"],
            "rol" => $_POST["rol_usuario"]
        );

        $id = $usuario_modelo->agregar_usuario($data);
        if ($id) {
            echo json_encode(["title" => "¡ÉXITO!", "status" => "success", "message" => "Usuario agregado correctamente.", "url" => "usuarios"]);
        } else {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Error al agregar el usuario.", "url" => "usuarios"]);
        }
    }

    public function editar()
    {
        verificarSesion();
        verificarRol("admin");
        $usuario_modelo = new Usuario($this->conn);
        $id = $_POST["id"];
        $usuario = $usuario_modelo->obtener_usuario_por_id($id);
        if ($usuario) {
            echo json_encode(["status" => "success", "usuario" => $usuario]);
        } else {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Usuario no encontrado.", "url" => "usuarios"]);
        }
    }

    public function actualizar()
    {
        verificarSesion();
        verificarRol("admin");
        $usuario_modelo = new Usuario($this->conn);
        $token = $_POST["_token"];

        if (validarToken($token) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Token no válido", "url" => null]);
            return;
        }

        $data = array(
            "id" => $_POST["id_usuario"],
            "nombres" => $_POST["nombres_usuario_editar"],
            "apellidos" => $_POST["apellidos_usuario_editar"],
            "email" => $_POST["email_usuario_editar"],
            "clave" => password_hash($_POST["clave_usuario_editar"], PASSWORD_DEFAULT),
            "usuario" => $_POST["usuario_editar"],
            "rol" => $_POST["rol_usuario_editar"]
        );
        $update = $usuario_modelo->actualizar_usuario($data);
        if ($update) {
            echo json_encode(["title" => "¡ÉXITO!", "status" => "success", "message" => "Usuario actualizado correctamente.", "url" => "usuarios"]);
        } else {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Error al actualizar el usuario.", "url" => "usuarios"]);
        }
    }

    public function cambiar_clave()
    {
        verificarSesion();
        $usuario_modelo = new Usuario($this->conn);
        $token = $_POST["_token"];

        if (validarToken($token) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Token no válido", "url" => null]);
            return;
        }

        $id = $this->usuarioSession["id"];
        $password = $_POST["password"];
        $nueva_clave = $_POST["new_password"];
        $usuario = $usuario_modelo->obtener_usuario_por_id($id);
        if (password_verify($password, $usuario["clave"])) {
            $update = $usuario_modelo->cambiar_clave($id, password_hash($nueva_clave, PASSWORD_DEFAULT));
            if ($update) {
                echo json_encode(["status" => "success", "message" => "Contraseña actualizada correctamente."]);
            } else {
                echo json_encode(["status" => "error", "message" => $id . $password . " no se pudo actualizar la contraseña."]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Contraseña incorrecta."]);
        }
    }

    public function eliminar()
    {
        verificarSesion();
        verificarRol("admin");
        $usuario_modelo = new Usuario($this->conn);

        if (!isset($_POST["_token"]) || !isset($_POST["id"])) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Token no válido", "url" => null]);
            return;
        }

        $token = htmlspecialchars($_POST["_token"]);
        $id = htmlspecialchars($_POST["id"]);

        if (validarToken($token) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Token no válido", "url" => null]);
            return;
        }

        $becado = $usuario_modelo->obtener_becado_por_usuario($id);
        if ($becado) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "No se puede eliminar el usuario, tiene un becado asociado.", "url" => "usuarios"]);
            return;
        }

        $delete = $usuario_modelo->eliminar_usuario($id);
        if ($delete) {
            echo json_encode(["title" => "¡ÉXITO!", "status" => "success", "message" => "Usuario eliminado correctamente.", "url" => "usuarios"]);
        } else {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Error al eliminar el usuario.", "url" => "usuarios"]);
        }
    }
}
