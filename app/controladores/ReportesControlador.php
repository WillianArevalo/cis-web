<?php

require_once "app/basedatos/conexion.php";



class ReportesControlador
{

    private $id;
    private $conn;
    private $usuarioSession;
    private $becadoSession;
    private $mesesSession;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
        $this->usuarioSession = obtenerSesión("usuario");
        $this->becadoSession = obtenerSesión("becado");
        $this->mesesSession = obtenerSesión("meses");
    }

    public function set_id($id)
    {
        $this->id = $id;
    }

    public function index()
    {
        verificarSesion();
        verificarRol("admin");
        $reporte_modelo = new Reporte($this->conn);
        $proyectos = $reporte_modelo->obtener_reportes_por_proyecto();
        cargar_vista("reportes", "index", ["proyectos" => $proyectos]);
    }

    public function lista()
    {
        verificarSesion();
        verificarRol("becado");
        $becado_modelo = new Becado($this->conn);
        $reporte_modelo = new Reporte($this->conn);
        $proyecto = $becado_modelo->obtener_proyecto_del_becado($this->becadoSession["id"]);

        if ($proyecto) {
            $id_proyecto = $proyecto["id"];
            $reporte = $reporte_modelo->obtener_reporte($id_proyecto);
            $months = array();
            foreach ($reporte as $r) {
                array_push($months, $r["mes"]);
            }
            cargar_vista("reportes", "lista", ["mes_reporte" => $months, "reporte" => $reporte]);
        } else {
            cargar_vista("error", "index", ["mensaje" => "No ha sido asignado a ningún proyecto.", "url" => "inicio"]);
        }
    }

    public function enviar()
    {
        verificarSesion();
        verificarRol("becado");
        $becado_modelo = new Becado($this->conn);
        $proyecto = $becado_modelo->obtener_proyecto_del_becado($this->becadoSession["id"]);

        if (!$proyecto) {
            cargar_vista("error", "index", ["mensaje" => "No ha sido asignado a ningún proyecto.", "url" => "inicio"]);
            return;
        }

        $mes = $this->id;
        $meses = $this->mesesSession;

        if (!array_key_exists($mes, $meses)) {
            cargar_vista("error", "index", ["mensaje" => "El mes no es válido.", "url" => "reportes/lista"]);
            return;
        }

        if ($meses[$mes] === "no enviado") {
            cargar_vista("error", "index", ["mensaje" => "No puedes enviar el reporte de ese mes.", "url" => "reportes/lista"]);
            return;
        } elseif ($meses[$mes] == "enviado") {
            cargar_vista("error", "index", ["mensaje" => "El reporte de este mes ya fue enviado.", "url" => "reportes/lista"]);
            return;
        }
        cargar_vista("reportes", "enviar", ["proyecto" => $proyecto, "mes" => $mes]);
    }

    public function enviar_reporte()
    {
        $reporte_modelo = new Reporte($this->conn);

        $token = $_POST["_token"];
        $id_proyecto = $_POST["id_proyecto"];
        $mes_reporte = ucfirst($_POST["mes_reporte"]);
        $tema_actividad = $_POST["tema_actividad"];
        $numero_participantes = $_POST["numero_participantes"];
        $descripcion_reporte = $_POST["descripcion_reporte"];
        $obstaculos_reporte = $_POST["obstaculos_reporte"];

        if (validarToken($token) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Token no válido", "url" => null]);
            return;
        }

        if (isset($_FILES["imagenes_reporte"])) {
            $nombreCarpeta = $_POST["nombre_proyecto"];
            $imagen = subirImagenReporte("imagenes_reporte", "proyectos", $nombreCarpeta, $mes_reporte);
        } else {
            $imagen = [];
        }

        $data = [
            "id_proyecto" => $id_proyecto,
            "mes" =>  strtolower($mes_reporte),
            "tema" => $tema_actividad,
            "numero_participantes" => $numero_participantes,
            "descripcion" => $descripcion_reporte,
            "obstaculos" => $obstaculos_reporte,
            "enviado_por" => $this->becadoSession["nombre"]
        ];

        $id = $reporte_modelo->agregar_reporte_mensual($data);
        if ($id) {
            for ($i = 0; $i < count($imagen); $i++) {
                $reporte_modelo->agregar_imagenes_reporte($id, $imagen[$i]);
            }
            echo json_encode(["title" => "¡ÉXITO!", "status" => "success", "message" => "Reporte enviado correctamente.", "url" => "reportes/lista"]);
        } else {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Error al enviar el reporte.", "url" => "reportes/lista"]);
        }
    }

    public function eliminar()
    {
        verificarSesion();
        verificarRol("admin");
        $reporte_modelo = new Reporte($this->conn);

        if (!isset($_POST["_token"]) || !isset($_POST["id"])) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Todos los campos son requeridos.", "url" => null]);
            return;
        }

        $token = htmlspecialchars($_POST["_token"]);
        $id = htmlspecialchars($_POST["id"]);

        if (validarToken($token) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Token no válido", "url" => null]);
            return;
        }

        $result = $reporte_modelo->eliminar_reporte($id);
        if ($result) {
            echo json_encode(["title" => "¡ÉXITO!", "status" => "success", "message" => "Reporte eliminado correctamente.", "url" => "reportes"]);
        } else {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Error al eliminar el reporte.", "url" => "reportes"]);
        }
    }

    public function detalles()
    {
        verificarSesion();
        $reporte_modelo = new Reporte($this->conn);
        $id = $this->id;
        $url = ($this->usuarioSession["rol"] == "admin") ? "reportes" : "reportes/lista";

        if (validarId($id) == false) {
            cargar_vista("error", "index", ["mensaje" => "El id no es válido.", "url" => $url]);
            return;
        }

        $reporte = $reporte_modelo->obtener_reporte_por_id($id);
        if (!$reporte) {
            cargar_vista("error", "index", ["mensaje" => "No se encontró el reporte.", "url" => $url]);
            return;
        }
        $imagenes_reporte = $reporte_modelo->obtener_imagenes_reporte($id);
        cargar_vista("reportes", "detalles", ["reporte" => $reporte, "imagenes" => $imagenes_reporte]);
    }

    public function editar()
    {
        $reporte_modelo = new Reporte($this->conn);

        $id = $this->id;

        if (validarId($id) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "El id no es válido.", "url" => "reportes"]);
            return;
        }

        $reporte = $reporte_modelo->obtener_reporte_por_id($id);
        $imagenes_reporte = $reporte_modelo->obtener_imagenes_reporte($id);
        if (!$reporte) {
            cargar_vista("error", "index", ["mensaje" => "No se encontró el reporte.", "url" => "reportes"]);
            return;
        }
        cargar_vista("reportes", "editar", ["reporte" => $reporte, "imagenes" => $imagenes_reporte]);
    }

    public function eliminar_imagen()
    {
        $reporte_modelo = new Reporte($this->conn);

        if (!isset($_POST["_token"]) || !isset($_POST["id"])) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Todos los campos son requeridos.", "url" => null]);
            return;
        }

        $token = htmlspecialchars($_POST["_token"]);
        $id = htmlspecialchars($_POST["id"]);
        if (validarToken($token) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Token no válido", "url" => null]);
            return;
        }

        $imagen = $reporte_modelo->obtener_imagen($id);

        if (!$imagen) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "No se encontró la imagen."]);
            return;
        }

        $result = $reporte_modelo->eliminar_imagen($id);
        if ($result) {
            $reporte = $reporte_modelo->obtener_reporte_por_id($imagen["id_reporte"]);
            $imagenes_reporte = $reporte_modelo->obtener_imagenes_reporte($imagen["id_reporte"]);
            $html = imagenes_reportes($imagenes_reporte, $reporte);
            echo json_encode(["title" => "¡ÉXITO!", "status" => "success", "message" => "Imagen eliminada correctamente.", "html" => $html]);
        } else {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Error al eliminar la imagen."]);
        }
    }

    public function editar_reporte()
    {
        $reporte_modelo = new Reporte($this->conn);

        if (!isset($_POST["_token"]) || !isset($_POST["id_reporte"]) || !isset($_POST["tema_actividad_editar"]) || !isset($_POST["numero_participantes_editar"]) || !isset($_POST["mes_editar"]) || !isset($_POST["descripcion_reporte_editar"]) || !isset($_POST["obstaculos_reporte_editar"])) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Todos los campos son requeridos.", "url" => null]);
            return;
        }

        $token = htmlspecialchars($_POST["_token"]);
        $id = htmlspecialchars($_POST["id_reporte"]);
        $tema = htmlspecialchars($_POST["tema_actividad_editar"]);
        $numero_participantes = htmlspecialchars($_POST["numero_participantes_editar"]);
        $descripcion = htmlspecialchars($_POST["descripcion_reporte_editar"]);
        $obstaculos = htmlspecialchars($_POST["obstaculos_reporte_editar"]);
        $mes = htmlspecialchars($_POST["mes_editar"]);

        if (validarToken($token) == false) {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Token no válido", "url" => null]);
            return;
        }

        if (isset($_FILES["imagenes_reporte_editar"]) && $_FILES["imagenes_reporte_editar"]["error"][0] == 0) {
            $nombreCarpeta = $_POST["nombre_proyecto"];
            $imagen = subirImagenReporte("imagenes_reporte_editar", "proyectos", $nombreCarpeta, $mes);
        } else {
            $imagen = [];
        }

        $data = [
            "id" => $id,
            "tema" => $tema,
            "numero_participantes" => $numero_participantes,
            "descripcion" => $descripcion,
            "obstaculos" => $obstaculos
        ];

        $result = $reporte_modelo->editar_reporte($data);
        if ($result || count($imagen) > 0) {
            for ($i = 0; $i < count($imagen); $i++) {
                $reporte_modelo->agregar_imagenes_reporte($id, $imagen[$i]);
            }
            echo json_encode(["title" => "¡ÉXITO!", "status" => "success", "message" => "Reporte editado correctamente.", "url" => "reportes"]);
        } else {
            echo json_encode(["title" => "ERROR", "status" => "error", "message" => "Error al editar el reporte.", "url" => "reportes"]);
        }
    }
}
