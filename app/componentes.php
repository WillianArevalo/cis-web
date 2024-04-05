<?php

/**
 * Función para mostrar el header de la página
 * @return html con el header
 */

function breadcumb()
{
    ob_start();
    $page = isCurrentPage();
    $usuario = obtenerSesión("usuario");
?>
    <div class="container-fluid p-4 bg-primary d-flex align-items-center justify-content-between bread-cumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <?php if ($page[1] == "") : ?>
                    <li class="breadcrumb-item">
                        <a class="text-white" href="<?php echo url($page[0]) ?>"><?php echo $page[0] ?></a>
                    </li>
                <?php else : ?>
                    <li class="breadcrumb-item">
                        <a href="<?php echo url($page[0]) ?>" class="mb-0 text-white"><?php echo $page[0] ?></a>
                    </li>
                    <li class="breadcrumb-item text-white" aria-current="page"><?php echo $page[1] ?></li>
                <?php endif; ?>
            </ol>
        </nav>
        <div class="d-flex align-items-center gap-4">
            <p class="mb-0 text-white user-email"><i class="fa-solid fa-envelope me-2"></i><?php echo $usuario["email"] ?></p>
        </div>
    </div>

    <?php
    $html = ob_get_clean();
    return $html;
}

/**
 * Función para mostrar las tarjetas de los proyectos
 * @param array $proyectos
 * @return html con las tarjetas de los proyectos
 */

function cards_proyectos($proyectos)
{
    ob_start();
    if ($proyectos != null) {
        foreach ($proyectos as $id_proyecto => $proyecto) {
    ?>
            <div class="col-sm-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <div class="rounded-circle p-2 bg-primary d-flex align-items-center justify-content-center text-white">
                                    <i class="fa-regular fa-folder"></i>
                                </div>
                                <h6 class="mb-0"><?php echo $proyecto["nombre_proyecto"] ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="mb-0">Comunidad: <?php echo $proyecto["nombre_comunidad"] ?></p>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="d-flex align-items-start justify-content-start flex-column">
                                    <p class="mb-0 mb-2">Integrantes:</p>
                                    <ul class="list-group w-100">
                                        <?php foreach ($proyecto['becados'] as $becado) : ?>
                                            <li class="list-group-item"><?php echo ($becado['nombre'] != null) ? $becado["nombre"] : "No hay ningún encargado asignado" ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group" role="group">
                            <button class="btn btn-danger btn_eliminar_proyecto" data-id="<?php echo $proyecto["id_proyecto"] ?>" data-token="<?php echo obtenerToken() ?>">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <button class="btn btn-primary btn_editar_proyecto" data-id="<?php echo $proyecto["id_proyecto"] ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <a class="btn btn-warning" href="<?php echo url("proyectos/asignar/$proyecto[id_proyecto]") ?>">
                                <i class="fa-solid fa-users"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    } else {
        ?>
        <div class='card p-4 text-center'>
            <p class="mb-0">No se encontraron proyectos</p>
        </div>
        <?php
    }
    $html = ob_get_clean();
    return $html;
}

/**
 * Función para mostrar las tarjetas de los becados
 * @param array $becados
 * @return html con las tarjetas de los becados
 */

function cards_becados($becados)
{
    ob_start();
    if ($becados != null) {
        foreach ($becados as $becado) {
        ?>
            <div class="col-sm-12 mb-4">
                <div class="card">
                    <div class="card-header text-center p-3">
                        <img src="<?php asset("images/becados", $becado["foto"]) ?>" width="200" height="200" class="img-fluid" style="object-fit:cover; border-radius:5px" alt="Imagen becado CIS" srcset="">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <strong>Nombre:</strong>
                                        <p class="mb-0"><?php echo $becado["nombre_becado"] ?></p>
                                    </div>
                                    <div class="col-12 mb-2 d-flex align-items-center justify-content-between">
                                        <strong>Comunidad:</strong>
                                        <p class="mb-0"><?php echo $becado["comunidad"] ?></p>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <strong>Institución:</strong>
                                        <p class="mb-0"><?php echo $becado["institucion"] ?></p>
                                    </div>
                                    <div class="col-12 mb-2 d-flex align-items-center justify-content-between">
                                        <strong>Nivel:</strong>
                                        <p class="mb-0"><?php echo $becado["nivel_academico"] ?></p>
                                    </div>
                                    <div class="col-12 mb-2 d-flex align-items-center justify-content-between">
                                        <strong>Carrera:</strong>
                                        <p class="mb-0"><?php echo $becado["carrera"] ?></p>
                                    </div>
                                    <div class="col-12 mb-2 d-flex align-items-center justify-content-between">
                                        <strong>Estudio:</strong>
                                        <p class="mb-0"><?php echo $becado["nivel_estudio"] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group" role="group">
                            <button class="btn btn-danger  btn_eliminar_becado" data-id="<?php echo $becado["id_becado"] ?>" data-token="<?php echo obtenerToken() ?>">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <a href="<?php echo url("becados/editar/" . $becado["id_becado"]) ?>" class="btn btn-success " data-id="<?php echo $becado["id_becado"] ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    } else {
        ?>
        <div class='card p-4 text-center'>
            <p class="mb-0">No se encontraron becados</p>
        </div>
        <?php
    }
    $html = ob_get_clean();
    return $html;
}

/**
 * Función para mostrar las imagenes del reporte
 * @param array $imagenes
 * @param array $reporte
 * @return html con las imagenes del reporte
 */

function imagenes_reportes($imagenes, $reporte)
{
    ob_start();
    if ($imagenes != null) :
        foreach ($imagenes as $imagen) :
        ?>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mt-2">
                <div class="card">
                    <img src="<?php asset("images/proyectos/", $reporte["nombre_proyecto"] . "/" . $reporte["mes"] . "/" . $imagen["imagen"]) ?>" class="card-img-top" alt="Imágenes reporte" width="150" height="150">
                    <div class="card-body">
                        <button type="button" class="btn btn-danger btn-eliminar-imagen" data-imagen="<?php echo $imagen["imagen"] ?>" data-id="<?php echo $imagen["id"] ?>">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
<?php
        endforeach;
    endif;
    $html = ob_get_clean();
    return $html;
}
