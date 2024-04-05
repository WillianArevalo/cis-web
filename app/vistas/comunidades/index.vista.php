<main class="container-admin">
    <?php echo breadcumb(); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-4 mb-4">
                <div class="page-header">
                    <div class="icon">
                        <i class="fa-solid fa-building"></i>
                    </div>
                    <div class="text">
                        <h4 class="text-header mb-0">
                            Comunidades
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mobile mb-4">
            <div class="col">
                <button class="btn btn-primary mobile mx-auto" data-bs-toggle="modal" data-bs-target="#modal_agregar_comunidad" id="btn_mostrar_modal_agregar_comunidad">
                    <div class="d-flex align-items-center justify-content-left gap-1">
                        <i class="fa-regular fa-square-plus"></i>
                        <p class="mb-0">Nueva comunidad</p>
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
                                <h6 class="mb-0">Listado de comunidades</h6>
                            </div>
                            <div>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_agregar_comunidad" id="btn_mostrar_modal_agregar_comunidad">
                                    <div class="d-flex align-items-center justify-content-left gap-1">
                                        <i class="fa-regular fa-square-plus"></i>
                                        Nueva comunidad
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="tabla_comunidades">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="text-start" scope="col">#</th>
                                        <th scope="col">Comunidad</th>
                                        <th class="text-end" scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($comunidades != null) {
                                        $num = 0;
                                        foreach ($comunidades as $comunidad) {
                                            $num++; ?>
                                            <tr>
                                                <td class="text-start"><?php echo $num; ?></td>
                                                <td><?php echo $comunidad["nombre"]; ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-end gap-2">
                                                        <button class="btn btn-danger btn_eliminar_comunidad" data-id="<?php echo $comunidad["id"] ?>" data-token="<?php echo obtenerToken() ?>">
                                                            <i class="fa-solid fa-trash"></i>
                                                            Eliminar
                                                        </button>
                                                        <button class="btn btn-success btn_editar_comunidad" data-id="<?php echo $comunidad["id"] ?>">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                            Editar
                                                        </button>
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
    <!-- Mobile -->
    <div class="container-fluid mobile">
        <div class="row">
            <?php if ($comunidades != null) {
                foreach ($comunidades as $comunidad) {
            ?>
                    <div class="col-12 mb-2">
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="mb-0"><?php echo $comunidad["nombre"]; ?></h6>
                                </div>
                                <div>
                                    <div class="btn-group">
                                        <button class="btn btn-danger btn_eliminar_comunidad" data-id="<?php echo $comunidad["id"] ?>" data-token="<?php echo obtenerToken() ?>">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                        <button class="btn btn-success btn_editar_comunidad" data-id="<?php echo $comunidad["id"] ?>">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="modal_agregar_comunidad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formulario_agregar_comunidad" novalidate>
            <input type="hidden" name="_token" value="<?php echo obtenerToken() ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 mb-0" id="exampleModalLabel">Agregar comunidad</h1>
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
                                        <i class="fa-solid fa-house-medical"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Comunidad" name="nombre_comunidad" required>
                                    <div class="invalid-feedback">
                                        El nombre de la comunidad no puede estar vacío.
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
                        <button type="submit" class="btn btn-primary" id="btn_agregar_comunidad">
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
<div class="modal fade" id="modal_editar_comunidad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formulario_editar_comunidad" novalidate>
            <input type="hidden" name="_token" value="<?php echo obtenerToken() ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 mb-0" id="exampleModalLabel">Editar comunidad</h1>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-circle-xmark fs-2"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <input type="hidden" name="id_comunidad" id="id_comunidad">
                                <div class="input-group mt-3 has-validation">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-house-medical"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Comunidad" name="nombre_comunidad" id="nombre_comunidad_editar" required>
                                    <div class="invalid-feedback">
                                        El nombre de la comunidad no puede estar vacío.
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
                        <button type="submit" class="btn btn-success" id="btn_editar_comunidad">
                            <i class="fa-solid fa-pen-to-square"></i>
                            Editar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>