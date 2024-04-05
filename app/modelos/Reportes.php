<?php

class Reporte
{
    private $conexion;

    public function __construct($conn)
    {
        $this->conexion = $conn;
    }

    public function agregar_reporte_mensual($data)
    {
        $sql = " INSERT INTO reporte_mensual(id_proyecto, mes, tema, numero_participantes, descripcion, obstaculos, enviado_por) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ississs", $data["id_proyecto"], $data["mes"], $data["tema"], $data["numero_participantes"], $data["descripcion"], $data["obstaculos"], $data["enviado_por"]);
        $stmt->execute();
        return $stmt->insert_id;
        $stmt->close();
    }

    public function agregar_imagenes_reporte($id_reporte, $imagen)
    {
        $sql = "INSERT INTO fotografia_reporte(id_reporte, imagen) VALUES (?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("is", $id_reporte, $imagen);
        $stmt->execute();
        return $stmt->insert_id;
        $stmt->close();
    }

    public function obtener_reportes_por_proyecto()
    {
        $sql = "SELECT r.id AS id_reporte, p.id AS id_proyecto, p.nombre_proyecto, r.mes, r.tema, r.numero_participantes, r.descripcion, r.obstaculos, r.enviado_por FROM proyecto p LEFT JOIN reporte_mensual r ON p.id = r.id_proyecto";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $reportes = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id_proyecto = $row["id_proyecto"];
                $nombre_proyecto = $row["nombre_proyecto"];
                if (!isset($reportes[$id_proyecto])) {
                    $reportes[$id_proyecto] = array(
                        "id_proyecto" => $id_proyecto,
                        "nombre_proyecto" => $nombre_proyecto,
                        "reportes" => array()
                    );
                }

                $reportes[$row["id_proyecto"]]["reportes"][] = array(
                    "id_reporte" => $row["id_reporte"],
                    "mes" => $row["mes"],
                    "tema" => $row["tema"],
                    "numero_participantes" => $row["numero_participantes"],
                    "descripcion" => $row["descripcion"],
                    "obstaculos" => $row["obstaculos"],
                    "enviado_por" => $row["enviado_por"]
                );
            }
        }
        return $reportes;
        $stmt->close();
    }

    public function obtener_reportes()
    {
        $sql = "SELECT * FROM reporte_mensual";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }

    public function obtener_reporte($id_proyecto)
    {
        $sql = "SELECT * FROM reporte_mensual WHERE id_proyecto = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id_proyecto);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }

    public function eliminar_reporte($id)
    {
        $sql = "DELETE FROM reporte_mensual WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
        $stmt->close();
    }

    public function obtener_reporte_por_id($id)
    {
        $sql = "SELECT r.id AS id, mes, tema, numero_participantes, descripcion, obstaculos, enviado_por, p.id AS id_proyecto, nombre_proyecto, id_comunidad FROM reporte_mensual r INNER JOIN proyecto p ON r.id_proyecto = p.id WHERE r.id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
        $stmt->close();
    }

    public function obtener_imagenes_reporte($id)
    {
        $sql = "SELECT * FROM fotografia_reporte WHERE id_reporte = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }

    public function obtener_imagen($id)
    {
        $sql = "SELECT * FROM fotografia_reporte WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
        $stmt->close();
    }

    public function eliminar_imagen($id)
    {
        $sql = "DELETE FROM fotografia_reporte WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
        $stmt->close();
    }

    public function editar_reporte($data)
    {
        $sql = "UPDATE reporte_mensual SET tema = ?, numero_participantes = ?, descripcion = ?, obstaculos = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sissi", $data["tema"], $data["numero_participantes"], $data["descripcion"], $data["obstaculos"], $data["id"]);
        $stmt->execute();
        return $stmt->affected_rows;
        $stmt->close();
    }
}
