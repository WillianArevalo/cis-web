<main class="container-admin">
    <?php echo breadcumb(); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-4 mb-4">
                <div class="page-header">
                    <div class="icon">
                        <i class="fa-solid fa-folder-open"></i>
                    </div>
                    <div class="text">
                        <h4 class="text-header mb-0">
                            Proyectos sociales
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mobile">
            <div class="col">
                <button class="btn btn-primary mobile mx-auto" data-bs-toggle="modal" data-bs-target="#modal_agregar_proyecto" id="btn_mostrar_modal_agregar_proyecto">
                    <div class="d-flex align-items-center justify-content-left gap-2 p-1">
                        <i class="fa-regular fa-square-plus"></i>
                        <p class="mb-0">Nuevo proyecto</p>
                    </div>
                </button>
            </div>
        </div>
        <div class="row desktop">
            <div class="col-12">
                <div class="card mb-4 ml-nav">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <div class="rounded-circle p-2 bg-primary d-flex align-items-center justify-content-center text-white">
                                    <i class="fa-solid fa-list"></i>
                                </div>
                                <h6 class="mb-0">Listado de proyectos sociales</h6>
                            </div>
                            <div>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_agregar_proyecto" id="btn_mostrar_modal_agregar_proyecto">
                                    <i class="fa-regular fa-square-plus"></i>
                                    Nuevo proyecto
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-4">
                            <table class="table" id="tabla_proyectos">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th scope="col">Nombre proyecto</th>
                                        <th scope="col">Comunidad</th>
                                        <th scope="col">Encargados</th>
                                        <th class="text-center" scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($proyectos != null) {
                                        $num = 0;
                                        foreach ($proyectos as $id_proyecto => $proyecto) {
                                            $num++; ?>
                                            <tr>
                                                <td><?php echo $num; ?></td>
                                                <td><?php echo $proyecto["nombre_proyecto"] ?></td>
                                                <td><?php echo $proyecto["nombre_comunidad"] ?></td>
                                                <td>
                                                    <ul class="list-group" style="font-size:14px">
                                                        <?php foreach ($proyecto['becados'] as $becado) : ?>
                                                            <li class="list-group-item"><?php echo ($becado['nombre'] != null) ? $becado["nombre"] : "No hay ningún encargado asignado" ?></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                                        <button class="btn btn-danger btn_eliminar_proyecto" data-id="<?php echo $proyecto["id_proyecto"] ?>" data-token="<?php echo obtenerToken() ?>">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                        <button class="btn btn-success btn_editar_proyecto" data-id="<?php echo $proyecto["id_proyecto"] ?>">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                        <a href="<?php echo url("proyectos/asignar/$proyecto[id_proyecto]") ?>" class="btn btn-warning">
                                                            <i class="fa-solid fa-users"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mobile mt-4">
        <div class="row mb-4">
            <div class="col-12 mx-auto" style="width:90%">
                <div class="input-group">
                    <div class="input-group-text">
                        <i class="fa-solid fa-search"></i>
                    </div>
                    <input type="search" class="form-control" placeholder="Buscar..." id="buscar-proyecto">
                </div>
            </div>
        </div>

        <div class="row" id="proyectos-list">
            <?php if ($proyectos != null) {
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
            <?php }
            }
            ?>
        </div>
    </div>

    <!-- Modal agregar -->
    <div class="modal fade" id="modal_agregar_proyecto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-md-down">
            <form id="formulario_agregar_proyecto" novalidate>
                <input type="hidden" name="_token" value="<?php echo obtenerToken() ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 mb-0" id="exampleModalLabel">Agregar proyecto</h1>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-circle-xmark fs-2"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="input-group mt-3 has-validation">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-folder"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Nombre del proyecto" name="nombre_proyecto" required>
                                        <div class="invalid-feedback">
                                            El nombre del proyecto no puede estar vacío.
                                        </div>
                                    </div>
                                    <div class="input-group mt-3 has-validation">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </span>
                                        <select name="comunidad" id="comunidad" class="form-control" required>
                                            <option value="">Seleccionar comunidad</option>
                                            <?php if ($comunidades != null) {
                                                foreach ($comunidades as $comunidad) { ?>
                                                    <option value="<?php echo $comunidad["id"] ?>"><?php echo $comunidad["nombre"] ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Debes seleccionar una comunidad.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                <i class="fa-solid fa-xmark"></i>
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary" id="btn_agregar_proyecto">
                                <i class="fa-solid fa-circle-plus"></i>
                                Agregar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal editar -->
    <div class="modal fade" id="modal_editar_proyecto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formulario_editar_proyecto" novalidate>
                <input type="hidden" name="_token" value="<?php echo obtenerToken() ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 mb-0" id="exampleModalLabel">Editar proyecto</h1>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-circle-xmark fs-2"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <input type="hidden" class="form-control" name="id_proyecto_editar" id="id_proyecto_editar">
                                    <div class="input-group mt-3 has-validation">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-folder"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Nombre del proyecto" name="nombre_proyecto_editar" id="nombre_proyecto_editar" required>
                                        <div class="invalid-feedback">
                                            El nombre del proyecto no puede estar vacío.
                                        </div>
                                    </div>

                                    <div class="input-group mt-3 has-validation">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </span>
                                        <select name="comunidad_editar" id="comunidad_editar" class="form-control" required>
                                            <option value="">Seleccionar comunidad</option>
                                            <?php if ($comunidades != null) {
                                                foreach ($comunidades as $comunidad) { ?>
                                                    <option value="<?php echo $comunidad["id"] ?>"><?php echo $comunidad["nombre"] ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Debes seleccionar una comunidad válida.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                <i class="fa-solid fa-xmark me-2"></i>Cancelar
                            </button>
                            <button type="submit" class="btn btn-success" id="btn_editar_proyecto">
                                <i class="fa-solid fa-pen-to-square"></i>
                                Editar
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>