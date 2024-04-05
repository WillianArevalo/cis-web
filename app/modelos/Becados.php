<?php


class Becado
{
    private $conexion;
    public function __construct($con)
    {
        $this->conexion = $con;
    }

    public function obtener_becados()
    {
        $sql = "SELECT b.nombre AS nombre_becado, c.nombre as comunidad, b.foto, c.id AS id_comunidad, b.institucion, b.nivel_academico, b.carrera, b.nivel_estudio, b.id AS id_becado, b.id_proyecto AS id_proyecto FROM becado b INNER JOIN comunidad c ON b.id_comunidad = c.id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtener_becado_por_nombre($becado)
    {
        $sql = "SELECT * FROM becado WHERE nombre = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("s", $becado);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtener($becado)
    {
        $sql = "SELECT * FROM becado WHERE nombre = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("s", $becado);
        $stmt->execute();
        $result = $stmt->get_result();
    }

    public function obtener_becado_por_usuario($id_usuario)
    {
        $sql = "SELECT * FROM becado WHERE id_usuario = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtener_becados_proyecto($id)
    {
        $sql = "SELECT * FROM becado WHERE id_proyecto != ? OR id_proyecto IS NULL";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtener_becados_por_nombre($nombre)
    {
        $sql = "SELECT b.nombre AS nombre_becado, c.nombre as comunidad, b.foto, c.id AS id_comunidad, b.institucion, b.nivel_academico, b.carrera, b.nivel_estudio, b.id AS id_becado FROM becado b INNER JOIN comunidad c ON b.id_comunidad = c.id WHERE b.nombre LIKE ?";
        $stmt = $this->conexion->prepare($sql);
        $nombre = "%" . $nombre . "%";
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function cantidad_becados()
    {
        $sql = "SELECT COUNT(*) AS cantidad FROM becado";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function guardar($data)
    {
        $sql = "INSERT INTO becado (nombre, foto, id_comunidad, institucion, nivel_academico, carrera, nivel_estudio, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ssissssi", $data["nombre"], $data["foto"], $data["id_comunidad"], $data["institucion"], $data["nivel_academico"], $data["carrera"], $data["nivel_estudio"], $data["id_usuario"]);
        $stmt->execute();
        return $stmt->insert_id;
        $stmt->close();
    }

    public function asignar_becado_a_proyecto($id_proyecto, $id_becado)
    {
        $sql = "UPDATE becado SET id_proyecto = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ii", $id_proyecto, $id_becado);
        $stmt->execute();
        return $stmt->affected_rows;
        $stmt->close();
    }

    public function eliminar_becados_proyecto($id_proyecto)
    {
        $sql = "UPDATE becado SET id_proyecto = NULL WHERE id_proyecto = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id_proyecto);
        $stmt->execute();
        return $stmt->affected_rows;
        $stmt->close();
    }

    public function obtener_proyecto_del_becado($id)
    {
        $sql = "SELECT * FROM becado b INNER JOIN proyecto p ON b.id_proyecto = p.id WHERE b.id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
        $stmt->close();
    }

    public function obtener_becados_por_comunidad($id)
    {
        $sql = "SELECT * FROM becado WHERE id_comunidad = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }

    public function obtener_integrantes_proyecto($id)
    {
        $sql = "SELECT * FROM becado b INNER JOIN proyecto p ON b.id_proyecto = p.id WHERE p.id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }

    public function obtener_integrantes($id)
    {
        $sql = "SELECT b.id as id, b.nombre as nombre, b.foto as foto, b.id_proyecto as proyecto FROM becado b INNER JOIN proyecto p ON b.id_proyecto = p.id WHERE p.id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }

    public function obtener_cantidad_de_integrantes_proyecto($id)
    {
        $sql = "SELECT COUNT(*) AS cantidad FROM becado WHERE id_proyecto = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
        $stmt->close();
    }

    public function eliminar_becado($id)
    {
        $sql = "DELETE FROM becado WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
        $stmt->close();
    }

    public function obtener_becado($id)
    {
        $sql = "SELECT * FROM becado WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
        $stmt->close();
    }

    public function editar($data)
    {
        $sql = "UPDATE becado SET nombre = ?, foto = ?, id_comunidad = ?, institucion = ?, nivel_academico = ?, carrera = ?, nivel_estudio = ?, id_usuario = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ssissssii", $data["nombre"], $data["foto"], $data["id_comunidad"], $data["institucion"], $data["nivel_academico"], $data["carrera"], $data["nivel_estudio"], $data["id_usuario"], $data["id_becado"]);
        $stmt->execute();
        return $stmt->affected_rows;
        $stmt->close();
    }
}
