<?php

date_default_timezone_set('America/El_Salvador');

/**
 * Función para las urls del proyecto
 * @param string $ruta ruta a la que se quiere acceder
 * @return string url de la ruta
 */

function url($ruta)
{
    echo constant("URL_SITIO") . "/" . $ruta;
}

/**
 * Función para cargar los modelos
 * @return void
 */

function registrar_modelos()
{
    foreach (glob("app/modelos/*.php") as $archivoModelo) {
        require_once($archivoModelo);
    }
}

/**
 * Función para cargar los archivos que estan en la carpeta assets
 * @param string $tipo tipo de archivo (css, js, img)
 * @param string $archivo nombre archivo a cargar
 * @return string url completa del archivo
 */

function asset($tipo, $archivo)
{
    echo constant("URL_SITIO") . "/app/vistas/assets/" . $tipo . "/" . $archivo;
}

/**
 * Función para cargar los archivos que estan en la carpeta node_modules
 * @param string $lib librería a cargar
 * @param string $archivo archivo a cargar
 * @return string url completa del archivo
 */

function node_module($lib, $archivo)
{
    echo constant("URL_SITIO") . "/node_modules/" . $lib . "/" . $archivo;
}

/**
 * Función para verificar si existe una sesión activa
 * @return void
 */

function verificarSesion()
{
    if (!isset($_SESSION['usuario'])) {
        header('Location: ' . constant("URL_SITIO"));
    }
}

/**
 * Función para verificar el rol del usuario
 * @param string $rol rol del usuario
 * @return void
 */

function verificarRol($rol)
{
    if ($_SESSION['usuario']['rol'] != $rol) {
        header('Location: ' . constant("URL_SITIO") . "/");
    }
}

/**
 * Función para obtener la página actual
 * @param string $pageName nombre de la página
 * @return string active si se encuentra en la página
 */

function currentPage($pageName)
{
    $parametrosRequest = explode("?", $_SERVER['REQUEST_URI']);
    $uriRequest = explode("/", $parametrosRequest[0]);
    return ($uriRequest[1] === $pageName) ? 'active' : '';
}


/**
 * Función para obtener en que página se encuentra el usuario
 * @param string $pageName nombre de la página
 * @return string active si se encuentra en la página
 */

function isCurrentPage()
{
    $parametrosRequest = explode("?", $_SERVER['REQUEST_URI']);
    if (count($parametrosRequest) > 1) {
        $uriRequest = explode("/", $parametrosRequest[0]);
    } else {
        $uriRequest = explode("/", $_SERVER['REQUEST_URI']);
    }

    # Obtener el nombre del controlador y el archivo del controlador
    $nombreControlador = ucfirst($uriRequest[1]);
    $nombreAccion = "";
    if (isset($uriRequest[2])) {
        $nombreAccion = ucfirst($uriRequest[2]);
    } else {
        $nombreAccion = "";
    }
    return array($nombreControlador, $nombreAccion);
}

/**
 * Función para cargar las vistas
 * @param string $controlador nombre del controlador
 * @param string $accion_vista nombre de la vista
 * @param array $datos datos a pasar a la vista
 * @param boolean $cargar_assets si se cargan los assets
 * @param boolean $cargar_navbar si se carga el navbar
 * @param boolean $preloader si se carga el preloader
 * @return void
 */

function cargar_vista($controlador, $accion_vista = null, $datos = [], $cargar_assets = true, $cargar_navbar = true)
{
    $nombreControlador = ucfirst(strtolower($controlador));
    $archivoVista = __DIR__ . "/vistas/" . $nombreControlador . "/" . ($accion_vista ? $accion_vista . ".vista.php" : "index.vista.php");

    if ($cargar_assets) {
        require_once "vistas/layout/header.php";
    }

    if ($cargar_navbar) {
        require_once "vistas/layout/navbar.php";
    }

    if (file_exists($archivoVista)) {
        if ($datos) {
            extract($datos);
        }
        require_once($archivoVista);
    } else {
        require_once("vistas/error/index.vista.php");
    }

    if ($cargar_navbar) {
        require_once("vistas/layout/footer/footer.php");
    }

    if ($cargar_assets) {
        require_once("vistas/layout/footer.php");
    }
}


/**
 * Sube una imagen al servidor
 * 
 * @param string $nombreCampo El nombre del campo del formulario que contiene la imagen
 * @param string $directorio El directorio donde se va a guardar la imagen
 * @return string La ruta de la imagen
 */

function subirImagen($nombreCampo, $directorio)
{
    $nombreArchivo = $_FILES[$nombreCampo]['name'];
    $rutaArchivo = __DIR__ . "/vistas/assets/images/" . $directorio . "/" . $nombreArchivo;

    move_uploaded_file($_FILES[$nombreCampo]['tmp_name'], $rutaArchivo);

    return $nombreArchivo;
}


/**
 * Sube una imagen al servidor
 * @param string $nombreCampo  Nombre del campo del formulario
 * @param string $directorio  Nombre del directorio donde se guardará la imagen
 * @param string $nombreElemento  Nombre del elemento al que pertenece la imagen (usuario, equipo, etc.)
 * @param string $mes  Nombre del mes en el que se sube la imagen
 * @return array Nombres de los archivos subidos
 */

function subirImagenReporte($nombreCampo, $directorio, $nombreElemento, $mes)
{
    $uploadDirectory = __DIR__ . "/vistas/assets/images/" . $directorio . "/" . $nombreElemento . "/" . $mes . "/";
    $nombresArchivos = array();
    foreach ($_FILES[$nombreCampo]['tmp_name'] as $key => $tmp_name) {
        $nombreArchivo = uniqid() . "_" . $_FILES[$nombreCampo]['name'][$key];
        $rutaArchivo = $uploadDirectory . $nombreArchivo;
        move_uploaded_file($tmp_name, $rutaArchivo);
        $nombresArchivos[] = $nombreArchivo;
    }

    return $nombresArchivos;
}

/**
 * Obtiene el nombre de un mes a partir de su número y crea un array con los nombres de los meses 
 * y crear una sessión con los meses
 * @param int $numeroMes El número del mes
 * @return string El nombre del mes
 */

function obtenerNombreMes($numeroMes)
{
    $meses = [
        1 => 'enero',
        2 => 'febrero',
        3 => 'marzo',
        4 => 'abril',
        5 => 'mayo',
        6 => 'junio',
        7 => 'julio',
        8 => 'agosto',
        9 => 'septiembre',
        10 => 'octubre',
        11 => 'noviembre',
        12 => 'diciembre'
    ];

    if (array_key_exists($numeroMes, $meses)) {
        return $meses[$numeroMes];
    } else {
        return 'Mes inválido';
    }
}

if (!isset($_SESSION["meses"])) {

    $meses = array(
        "enero" => "pendiente",
        "febrero" => "pendiente",
        "marzo" => "pendiente",
        "abril" => "pendiente",
        "mayo" => "pendiente",
        "junio" => "pendiente",
        "julio" => "pendiente",
        "agosto" => "pendiente",
        "septiembre" => "pendiente",
        "octubre" => "pendiente",
        "noviembre" => "pendiente",
        "diciembre" => "pendiente"
    );

    $_SESSION["meses"] = $meses;
}

/**
 * Actualiza el estado de los meses en la sesión 
 * @param array $mes_reporte Meses que se van a actualizar
 * @param string $mesActual Mes actual
 * @return void
 */

function actualizarMeses($mes_reporte, $mesActual)
{
    foreach ($mes_reporte as $mes) {
        if (array_key_exists($mes, $_SESSION["meses"])) {
            $_SESSION["meses"][$mes] = "enviado";
        }
    }

    $meses_encontrado = false;

    // Iterar sobre todos los meses
    foreach ($_SESSION["meses"] as $nombre_mes => $estado) {
        // Si encontramos el mes dado, marcamos que lo encontramos
        if ($nombre_mes === $mesActual) {
            $meses_encontrado = true;
        }
        // Si hemos encontrado el mes y no es el mes dado, actualizamos el estado
        elseif ($meses_encontrado) {
            $_SESSION["meses"][$nombre_mes] = "no enviado";
        }
    }
}

/**
 * Función para obtener los datos guardados en la sesión
 * @param string $nameSesion nombre de la sesión
 * @return mixed datos guardados en la sesión
 */

function obtenerSesión($nameSesion)
{
    return $_SESSION[$nameSesion];
}

/**
 * Función para generar un token de seguridad
 * @return void
 */

function generarToken()
{
    if (!isset($_SESSION["crs_token"])) {
        $token = bin2hex(random_bytes(32)) . uniqid();
        $_SESSION["crs_token"] = $token;
    } else {
        $token = $_SESSION["crs_token"];
    }
}

/**
 * Función para obtener el token de seguridad
 * @return string token de seguridad
 */

function obtenerToken()
{
    return obtenerSesión("crs_token");
}

/**
 * Función para validar el token de seguridad
 * @param string $token token de seguridad
 * @return boolean true si el token es válido, false si no lo es
 */

function validarToken($token)
{
    if ($token != $_SESSION["crs_token"]) {
        return false;
    }
    return true;
}

/**
 * Función para validar el id, que no tenga ninguna letra
 * @param string $id id a validar
 * @return boolean true si el id es válido, false si no lo es
 */

function validarId($id)
{
    if (!preg_match('/^\d+$/', $id)) {
        return false;
    }
    return true;
}
