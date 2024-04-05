<?php

class Proyecto
{

    private $conexion;

    public function __construct($con)
    {
        $this->conexion = $con;
    }

    public function agregar_proyecto($nombre, $id_comunidad)
    {
        $sql = "INSERT INTO proyecto (nombre_proyecto, id_comunidad) VALUES (?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("si", $nombre, $id_comunidad);
        $stmt->execute();
        return $stmt->insert_id;
        $stmt->close();
    }

    public function cantidad_proyectos()
    {
        $sql = "SELECT COUNT(*) AS cantidad FROM proyecto";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
        $stmt->close();
    }

    public function obtener_proyectos()
    {
        $sql = "SELECT proyecto.id AS id_proyecto, proyecto.nombre_proyecto, 
      becado.id AS id_becado, becado.nombre AS nombre_becado, c.nombre AS nombre_comunidad
      FROM proyecto
      LEFT JOIN becado ON proyecto.id = becado.id_proyecto
      LEFT JOIN comunidad c ON c.id = proyecto.id_comunidad";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $proyectos = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id_proyecto = $row["id_proyecto"];
                $nombre_proyecto = $row["nombre_proyecto"];
                $comunidad_proyecto = $row["nombre_comunidad"];
                if (!isset($proyectos[$id_proyecto])) {
                    $proyectos[$id_proyecto] = array(
                        "id_proyecto" => $id_proyecto,
                        "nombre_proyecto" => $nombre_proyecto,
                        "nombre_comunidad" => $comunidad_proyecto,
                        "becados" => array()
                    );
                }

                $proyectos[$id_proyecto]["becados"][] = array(
                    "id_becado" => $row["id_becado"],
                    "nombre" => $row["nombre_becado"]
                );
            }
        }
        return $proyectos;
        $stmt->close();
    }


    public function obtener_proyecto_completo_por_nombre($nombre)
    {
        $sql = "SELECT proyecto.id AS id_proyecto, proyecto.nombre_proyecto, 
      becado.id AS id_becado, becado.nombre AS nombre_becado, c.nombre AS nombre_comunidad
      FROM proyecto
      LEFT JOIN becado ON proyecto.id = becado.id_proyecto
      LEFT JOIN comunidad c ON c.id = proyecto.id_comunidad WHERE proyecto.nombre_proyecto LIKE ?";
        $stmt = $this->conexion->prepare($sql);
        $nombre_proyecto_like =   '%' . $nombre . '%';
        $stmt->bind_param("s", $nombre_proyecto_like);
        $stmt->execute();
        $result = $stmt->get_result();
        $proyectos = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id_proyecto = $row["id_proyecto"];
                $nombre_proyecto = $row["nombre_proyecto"];
                $comunidad_proyecto = $row["nombre_comunidad"];
                if (!isset($proyectos[$id_proyecto])) {
                    $proyectos[$id_proyecto] = array(
                        "id_proyecto" => $id_proyecto,
                        "nombre_proyecto" => $nombre_proyecto,
                        "nombre_comunidad" => $comunidad_proyecto,
                        "becados" => array()
                    );
                }

                $proyectos[$id_proyecto]["becados"][] = array(
                    "id_becado" => $row["id_becado"],
                    "nombre" => $row["nombre_becado"]
                );
            }
        }
        return $proyectos;
        $stmt->close();
    }

    public function obtener_proyecto_por_id($id)
    {
        $sql = "SELECT * FROM proyecto WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
        $stmt->close();
    }

    public function eliminar_proyecto($id)
    {
        $sql = "DELETE FROM proyecto WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
        $stmt->close();
    }

    public function actualizar_proyecto($id, $nombre, $id_comunidad)
    {
        $sql = "UPDATE proyecto SET nombre_proyecto = ?, id_comunidad = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sii", $nombre, $id_comunidad, $id);
        $stmt->execute();
        return $stmt->affected_rows;
        $stmt->close();
    }
}
