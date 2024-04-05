<?php

/**
 * Clase para establecer la conexión a la base de datos
 * 
 */
class Conexion
{

    private $host;
    private $usuario;
    private $contrasena;
    private $base_datos;
    private $conexion;

    public function __construct($host, $usuario, $contrasena, $base_datos)
    {
        $this->host = $host;
        $this->usuario = $usuario;
        $this->contrasena = $contrasena;
        $this->base_datos = $base_datos;

        $this->conexion = new mysqli($this->host, $this->usuario, $this->contrasena, $this->base_datos);

        if ($this->conexion->connect_errno) {
            echo "Error al conectarse a MySQL: " . $this->conexion->connect_error;
            exit();
        }
    }

    public function getConnection()
    {
        return $this->conexion;
    }

    public function __destruct()
    {
        $this->conexion->close();
    }
}


$conexionBD = new Conexion(
    constant("MYSQL_HOST"),
    constant("MYSQL_USER"),
    constant("MYSQL_PASSWORD"),
    constant("MYSQL_DATABASE")
);

// Establecer la conexión a la base de datos
$conn = $conexionBD->getConnection();
