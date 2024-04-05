<main class="container-admin">
    <?php echo breadcumb(); ?>
    <div class="container-fluid">
        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="page-header">
                    <div class="icon">
                        <i class="fa-solid fa-pencil"></i>
                    </div>
                    <div class="text">
                        <h4 class="text-header mb-0">
                            Editar reporte
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <form id="formulario_editar_reporte" novalidate enctype="multipart/form-data">
            <input type="hidden" name="_token" id="token" value="<?php echo obtenerToken() ?>">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card p-4">
                        <div class="row">
                            <div class="col-xl-2 col-lg-6 col-md-12 col-sm-12">
                                <input type="hidden" value="<?php echo $reporte["id"] ?>" name="id_reporte">
                                <input type="hidden" value="<?php echo $reporte["nombre_proyecto"] ?>" name="nombre_proyecto">
                                <div class="input-group mt-4">
                                    <span class="input-group-text" id="inputGroupPrepend">
                                        <i class="fa-solid fa-calendar"></i>
                                    </span>
                                    <input type="text" name="mes_editar" value="<?php echo $reporte["mes"] ?>" placeholder="Mes reporte" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 mt-4">
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">
                                        <i class="fa-regular fa-bookmark"></i>
                                    </span>
                                    <input type="text" class="form-control" value="<?php echo $reporte["tema"] ?>" aria-describedby="inputGroupPrepend" required name="tema_actividad_editar" placeholder="Tema de la actividad" required>
                                    <div class="invalid-feedback">
                                        El tema de la actividad no puede estar vacío.
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-6 col-md-12 col-sm-12 mt-4">
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">
                                        <i class="fa-solid fa-users"></i>
                                    </span>
                                    <input type="text" class="form-control" aria-describedby="inputGroupPrepend" name="numero_participantes_editar" placeholder="# participantes" value="<?php echo $reporte["numero_participantes"] ?>" required>
                                    <div class="invalid-feedback">
                                        El número de participantes no puede estar vacío.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-4">
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">
                                        <i class="fa-solid fa-align-left"></i>
                                    </span>
                                    <textarea class="form-control" aria-describedby="inputGroupPrepend" required name="descripcion_reporte_editar" rows="5" placeholder="Actividades realizadas"><?php echo $reporte["descripcion"] ?></textarea>
                                    <div class="invalid-feedback">
                                        La descripción de la actividad no puede estar vacía.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">
                                        <i class="fa-solid fa-align-left"></i>
                                    </span>
                                    <textarea class="form-control" aria-describedby="inputGroupPrepend" required name="obstaculos_reporte_editar" rows="5" placeholder="Obstáculos de las actividades"><?php echo $reporte["obstaculos"] ?></textarea>
                                    <div class="invalid-feedback">
                                        Los obstáculos no pueden estar vacíos.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="row" id="imagenes">
                                    <?php
                                    if ($imagenes != null) :
                                        foreach ($imagenes as $imagen) :
                                    ?>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mx-auto mt-4">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <img src="<?php asset("images/proyectos/", $reporte["nombre_proyecto"] . "/" . $reporte["mes"] . "/" . $imagen["imagen"]) ?>" class="images-repot-edit" alt="Imágenes reporte">
                                                    </div>
                                                    <div class="card-body bg-dark">
                                                        <button type="button" class="btn btn-danger btn-eliminar-imagen" data-imagen="<?php echo $imagen["imagen"] ?>" data-id="<?php echo $imagen["id"] ?>">
                                                            <i class="fa-solid fa-trash"></i>
                                                            Eliminar imágen
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <i class="fa-solid fa-images"></i>
                                <label for="">Agregar imágen al reporte:</label>
                                <div class="input-group has-validation">
                                    <input type="file" class="form-control" id="image-report" name="imagenes_reporte_editar[]" multiple required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col text-center">
                                    <div class="btn-group">
                                        <button class="btn btn-primary" type="button" id="btn_editar_reporte">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            Editar reporte
                                        </button>
                                        <a href="<?php echo url("reportes") ?>" class="btn btn-danger">
                                            <i class="fa-solid fa-xmark"></i>
                                            Cancelar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>