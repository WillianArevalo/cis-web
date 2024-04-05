<main class="container-admin">
    <?php echo breadcumb(); ?>
    <div class="container-fluid mb-4">
        <div class="row">
            <div class="col-12 mt-4 mb-4">
                <div class="page-header">
                    <div class="icon">
                        <i class="fa-solid fa-people-group"></i>
                    </div>
                    <div class="text">
                        <h4 class="text-header mb-0">
                            Becados
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mobile">
            <div class="col">
                <a href="<?php url("becados/nuevo") ?>" class="btn btn-primary mobile mb-4 mx-auto">
                    <div class=" d-flex align-items-center justify-content-left gap-2 ">
                        <i class="fa-regular fa-square-plus"></i>
                        <p class="mb-0">Nuevo becado</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="row desktop">
            <div class="col-12">
                <div class="card ml-nav">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center justify-content-right gap-2">
                                <div class="rounded-circle p-2 bg-primary d-flex align-items-center justify-content-center text-white">
                                    <i class="fa-solid fa-list"></i>
                                </div>
                                <h6 class="mb-0">Listado de becados</h6>
                            </div>
                            <div>
                                <a href="<?php url("becados/nuevo") ?>" class="btn btn-primary">
                                    <i class="fa-regular fa-square-plus"></i>
                                    Nuevo becado
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="tabla_becados">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Comunidad</th>
                                        <th scope="col">Institución</th>
                                        <th scope="col">Nivel</th>
                                        <th scope="col">Carrera</th>
                                        <th scope="col">Estudiando</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($becados != null) {
                                        $num = 0;
                                        foreach ($becados as $becado) {
                                            $num++;
                                    ?>
                                            <tr>
                                                <th scope="row"><?php echo $num ?></th>
                                                <td><img src="<?php asset("images/becados", $becado["foto"]) ?>" alt="Imagen becado CIS" width="70" height="70" style="object-fit:cover" /></td>
                                                <td><?php echo $becado["nombre_becado"] ?></td>
                                                <td><?php echo $becado["comunidad"] ?></td>
                                                <td><?php echo $becado["institucion"] ?></td>
                                                <td><?php echo $becado["nivel_academico"] ?></td>
                                                <td><?php echo $becado["carrera"] ?></td>
                                                <td><?php echo $becado["nivel_estudio"] ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                                        <button class="btn btn-danger btn_eliminar_becado" data-id="<?php echo $becado["id_becado"] ?>" data-token="<?php echo obtenerToken() ?>">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                        <a href="<?php echo url("becados/editar/" . $becado["id_becado"]) ?>" class="btn btn-success">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                    <?php
                                        }
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
    <div class="container-fluid mobile ">
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="input-group">
                        <div class="input-group-text">
                            <i class="fa-solid fa-search"></i>
                        </div>
                        <input type="text" class="form-control" placeholder="Buscar..." id="buscar-becado">
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="becados-list">
            <?php
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
            } ?>
        </div>
    </div>
</main>