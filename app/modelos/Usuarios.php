    <?php

class Usuario
{
    private $conexion;
    public function __construct($con)
    {
        $this->conexion = $con;
    }

    public function buscar_por_usuario($usuario)
    {
        $sql = "SELECT id, nombres, apellidos, clave, email,usuario, rol FROM usuario WHERE usuario = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        return $resultado->fetch_assoc();
    }

    public function obtener_usuario_por_email($email)
    {
        $sql = "SELECT id, nombres, apellidos, clave, email,usuario, rol FROM usuario WHERE email = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        return $resultado->fetch_assoc();
    }

    public function obtener_becado_por_usuario($id)
    {
        $sql = "SELECT * FROM becado WHERE id_usuario = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        return $resultado->fetch_assoc();
    }

    public function agregar_usuario($data)
    {
        $sql = "INSERT INTO usuario (nombres, apellidos, clave, usuario, rol, email) VALUES ( ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ssssss", $data["nombres"], $data["apellidos"], $data["clave"], $data["usuario"], $data["rol"], $data["email"]);
        $stmt->execute();
        return $stmt->insert_id;
        $stmt->close();
    }

    public function obtener_usuarios()
    {
        $sql = "SELECT * FROM usuario";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }

    public function obtener_usuario_por_id($id)
    {
        $sql = "SELECT * FROM usuario WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
        $stmt->close();
    }

    public function actualizar_usuario($data)
    {
        $sql = "UPDATE usuario SET nombres = ?, apellidos = ?, email = ?, clave = ?, usuario = ?, rol = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ssssssi", $data["nombres"], $data["apellidos"], $data["email"], $data["clave"], $data["usuario"], $data["rol"], $data["id"]);
        $stmt->execute();
        return $stmt->affected_rows;
        $stmt->close();
    }

    public function eliminar_usuario($id)
    {
        $sql = "DELETE FROM usuario WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
        $stmt->close();
    }

    public function cambiar_clave($id, $clave)
    {
        $sql = "UPDATE usuario SET clave = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("si", $clave, $id);
        $stmt->execute();
        return $stmt->affected_rows;
        $stmt->close();
    }

    public function cambiar_correo($id, $correo)
    {
        $sql = "UPDATE usuario SET email = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("si", $correo, $id);
        $stmt->execute();
        return $stmt->affected_rows;
        $stmt->close();
    }
}