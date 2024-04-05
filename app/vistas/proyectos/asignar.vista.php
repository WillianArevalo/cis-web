<main class="container-admin">
    <?php echo breadcumb() ?>
    <div class="container">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card alert alert-primary">
                    <h5 class="mb-0">
                        <i class="fa-solid fa-folder-open"></i>
                        Proyecto:
                        <?php echo $proyecto["nombre_proyecto"] ?>
                    </h5>
                </div>
            </div>
        </div>
        <input type="hidden" name="id_proyecto" id="id_proyecto" value="<?php echo $proyecto["id"] ?>">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-4" id="colum-becados">
                <div class="card alert alert-info">
                    <h6 class="mb-0">
                        <i class="fa-solid fa-list-check"></i>
                        Becados asignados
                    </h6>
                </div>
                <div class="columns" id="column1">
                    <?php
                    if ($becados_proyecto != null) :
                        foreach ($becados_proyecto as $becado) : ?>
                            <div class="card alert alert-info p-2 mb-1" data-id="<?php echo $becado["id"] ?>">
                                <div class="row">
                                    <div class="col-2 my-auto">
                                        <img src="<?php asset("images/becados", $becado["foto"]) ?>" alt="" srcset="" class="rounded-circle square object-fit-cover ms-2">
                                    </div>
                                    <div class="col-10 d-flex align-items-center justify-content-between">
                                        <p class="mb-0 name-user-asignar">
                                            <?php echo $becado["nombre"] ?>
                                        </p>
                                        <button class="btn btn-danger btn-move rounded-circle square d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-minus icon-btn-move"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                    <?php
                        endforeach;
                    endif; ?>
                </div>
                <div class="text-center">
                    <div class="mt-4 btn-group">
                        <a href="<?php echo url("proyectos") ?>" class="btn btn-danger">
                            <i class="fa-solid fa-circle-arrow-left me-2"></i>Regresar
                        </a>
                        <button class="btn btn-primary" id="btn_asignar_becados" data-token="<?php echo obtenerToken() ?>">Asignar becados</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 columns" style="margin-bottom:90px" id="column2">
                <div class="card alert alert-success">
                    <h6 class="mb-0">
                        <i class="fa-solid fa-list"></i>
                        Lista de becados
                    </h6>
                </div>
                <?php foreach ($becados as $becado) : ?>
                    <div class="card alert alert-success p-2 mb-1" data-id="<?php echo $becado["id"] ?>">
                        <div class="row">
                            <div class="col-2 my-auto">
                                <img src="<?php asset("images/becados", $becado["foto"]) ?>" alt="Foto becado CIS" class="rounded-circle object-fit-cover ms-2 square">
                            </div>
                            <div class="col-10 d-flex align-items-center justify-content-between">
                                <p class="mb-0 name-user-asignar">
                                    <?php echo $becado["nombre"] ?>
                                </p>
                                <div class="d-flex gap-2 align-items-center">
                                    <?php if ($becado["id_proyecto"] != null) : ?>
                                        <i class="fa-solid fa-circle-check fs-1 text-primary"></i>
                                    <?php
                                    else : ?>
                                        <i class="fa-solid fa-circle-xmark fs-1 text-warning"></i>
                                    <?php
                                    endif; ?>
                                    <button class="btn btn-success btn-move rounded-circle square d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-plus icon-btn-move"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>