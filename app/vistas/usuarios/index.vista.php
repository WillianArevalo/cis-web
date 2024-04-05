<main class="container-admin">
    <?php echo breadcumb() ?>
    <div class="container-fluid">
        <div class="row mt-4 mb-4">
            <div class="col-12">
                <div class="page-header">
                    <div class="icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="text">
                        <h4 class="text-header mb-0">
                            Usuarios
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mobile">
            <div class="col">
                <button class="btn btn-primary mobile mx-auto" data-bs-toggle="modal" data-bs-target="#modal_agregar_becado" id="btn_mostrar_modal_agregar_becado">
                    <div class=" d-flex align-items-center justify-content-left gap-1">
                        <i class="fa-regular fa-square-plus"></i>
                        <p class="mb-0">Nuevo usuario</p>
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
                                <h6 class="mb-0">Listado de usuarios</h6>
                            </div>
                            <div>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_agregar_becado" id="btn_mostrar_modal_agregar_becado">
                                    <div class=" d-flex align-items-center justify-content-left gap-1">
                                        <i class="fa-regular fa-square-plus"></i>
                                        Nuevo usuario
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="tabla_usuarios">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class="text-center" scope="col">#</th>
                                        <th scope="col">Usuario</th>
                                        <th scope="col">Nombres</th>
                                        <th scope="col">Apellidos</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Rol</th>
                                        <th class="text-center" scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($usuarios != null) {
                                        $num = 0;
                                        foreach ($usuarios as $usuario) {
                                            $num++;
                                    ?>
                                            <tr>
                                                <td><?php echo $num ?></td>
                                                <td><?php echo $usuario["usuario"] ?></td>
                                                <td><?php echo $usuario["nombres"] ?></td>
                                                <td><?php echo $usuario["apellidos"] ?></td>
                                                <td><?php echo $usuario["email"] ?></td>
                                                <td><?php echo $usuario["rol"] ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                                        <button class="btn btn-danger btn_eliminar_usuario" data-id="<?php echo $usuario["id"] ?>" data-token="<?php echo obtenerToken() ?>">
                                                            <i class="fa-solid fa-trash"></i>
                                                            Eliminar
                                                        </button>
                                                        <button class="btn btn-success btn_editar_usuario" data-id="<?php echo $usuario["id"] ?>">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                            Editar
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mobile mb-5">
        <div class="row">
            <?php if ($usuarios != null) :
                foreach ($usuarios as $usuario) : ?>
                    <div class="col-12">
                        <div class="card mt-4">
                            <div class="card-header d-flex align-items-center justify-content-start gap-1 bg-primary text-white">
                                <i class="fa-solid fa-circle-user me-1"></i>
                                <p class="mb-0 card-title"><?php echo $usuario["nombres"] ?> <?php echo $usuario["apellidos"] ?></p>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Usuario: <?php echo $usuario["usuario"] ?></p>
                                <p class="card-text">Email: <?php echo $usuario["email"] ?></p>
                                <p class="card-text">Rol: <?php echo $usuario["rol"] ?></p>
                            </div>
                            <div class="card-footer">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-danger btn_eliminar_becado" data-id="<?php echo $usuario["id"] ?>" data-token="<?php echo obtenerToken() ?>">
                                        <i class="fa-solid fa-trash"></i> Eliminar
                                    </button>
                                    <button type="button" class="btn btn-success btn_editar_usuario" data-id="<?php echo $usuario["id"] ?>">
                                        <i class="fa-solid fa-pen-to-square"></i> Editar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php endforeach;
            endif; ?>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="modal_agregar_becado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formulario_agregar_usuario" novalidate>
            <input type="hidden" name="_token" value="<?php echo obtenerToken() ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 mb-0" id="exampleModalLabel">Agregar usuario</h1>
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
                                        <i class="fa-solid fa-user-plus"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Nombres" name="nombres_usuario" required>
                                    <div class="invalid-feedback">
                                        El nombre no puede estar vacío.
                                    </div>
                                </div>

                                <div class="input-group mt-3 has-validation">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Apellidos" name="apellidos_usuario" required>
                                    <div class="invalid-feedback">
                                        Los apellidos no pueden estar vacíos.
                                    </div>
                                </div>

                                <div class="input-group mt-3 has-validation">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-at"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Email" name="email_usuario" required>
                                    <div class="invalid-feedback">
                                        El email no puede estar vacío.
                                    </div>
                                </div>

                                <div class="input-group mt-3 has-validation">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Usuario" name="usuario" required>
                                    <div class="invalid-feedback">
                                        El usuario no puede estar vacío.
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group mt-3 has-validation">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-key"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Contraseña" name="clave_usuario" required>
                                            <div class="invalid-feedback">
                                                La contraseña no puede estar vacía.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group mt-3 has-validation">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-user-tie"></i>
                                            </span>
                                            <select name="rol_usuario" class="form-control" required>
                                                <option value="">Selecciona un rol</option>
                                                <option value="admin">Administrador</option>
                                                <option value="becado">Becado</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                ELije un rol válido.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger d-flex align-items-center justify-content-center gap-2" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark"></i>
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center gap-2" id="btn_agregar_usuario">
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
<div class="modal fade" id="modal_editar_usuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formulario_editar_usuario" novalidate>
            <input type="hidden" name="_token" value="<?php echo obtenerToken() ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 mb-0" id="exampleModalLabel">Editar usuario</h1>
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-circle-xmark fs-2"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <input type="hidden" class="form-control" id="id_usuario" name="id_usuario">
                                <div class="input-group mt-3 has-validation">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Nombres" id="nombres_usuario" name="nombres_usuario_editar" required>
                                    <div class="invalid-feedback">
                                        El nombre no puede estar vacío.
                                    </div>
                                </div>

                                <div class="input-group mt-3 has-validation">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Apellidos" id="apellidos_usuario" name="apellidos_usuario_editar" required>
                                    <div class="invalid-feedback">
                                        Los apellidos no pueden estar vacíos.
                                    </div>
                                </div>

                                <div class="input-group mt-3 has-validation">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-at"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Email" id="email_usuario" name="email_usuario_editar" required>
                                    <div class="invalid-feedback">
                                        El email no puede estar vacío.
                                    </div>
                                </div>

                                <div class="input-group mt-3 has-validation">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Usuario" id="usuario" name="usuario_editar" required>
                                    <div class="invalid-feedback">
                                        El usuario no puede estar vacío.
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group mt-3 has-validation">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-key"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Contraseña" id="clave_usuario" name="clave_usuario_editar" required>
                                            <div class="invalid-feedback">
                                                La contraseña no puede estar vacía.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group mt-3 has-validation">
                                            <span class="input-group-text">
                                                <i class="fa-solid fa-user-tie"></i>
                                            </span>
                                            <select name="rol_usuario_editar" class="form-control" id="rol_usuario" required>
                                                <option value="">Selecciona un rol</option>
                                                <option value="admin">Administrador</option>
                                                <option value="becado">Becado</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                ELije un rol válido.
                                            </div>
                                        </div>
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
                        <button type="submit" class="btn btn-success" id="btn_editar_usuario">
                            <i class="fa-solid fa-pen-to-square"></i>
                            Editar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>