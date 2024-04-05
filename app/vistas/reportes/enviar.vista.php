<main class="container-scholarship mt-4">
    <div class="container">
        <div class="page-header mb-4">
            <div class="icon">
                <i class="fa-regular fa-paper-plane"></i>
            </div>
            <div class="text">
                <h4 class="text-header mb-0">
                    Enviar reporte
                </h4>
            </div>
        </div>
        <form id="formulario_enviar_reporte" novalidate enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo obtenerToken() ?>">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bx bx-detail fs-5"></i>
                        <h5 class="mb-0">Detalles del reporte</h5>
                    </div>
                </div>
                <div class="card-body me-2 ms-2">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 mt-4">
                                    <input type="hidden" name="mes" placeholder="Mes reporte" class="form-control" value="<?php echo $mes ?>">
                                    <div class="input-group">
                                        <span class="input-group-text d-none"></span>
                                        <input type="hidden" name="id_proyecto" value="<?php echo $proyecto["id"] ?>" class="form-control" readonly>
                                    </div>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">
                                            <i class="fa-regular fa-file-lines"></i>
                                        </span>
                                        <input type="text" class="form-control" aria-describedby="inputGroupPrepend" name="nombre_proyecto" value="<?php echo $proyecto["nombre_proyecto"] ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 mt-4">
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">
                                            <i class="fa-solid fa-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control" aria-describedby="inputGroupPrepend" name="fecha_reporte" value="<?php echo date('Y-m-d'); ?>" readonly required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-8 col-lg-6 col-md-12 col-sm-12 mt-4">
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">
                                            <i class="fa-regular fa-bookmark"></i>
                                        </span>
                                        <input type="text" class="form-control" aria-describedby="inputGroupPrepend" required name="tema_actividad" id="tema_actividad" placeholder="Tema de la actividad" data-min-caracteres="25" required>
                                        <div class="invalid-feedback" id="error_tema">
                                            El tema de la actividad no puede estar vacío.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 mt-4">
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">
                                            <i class="fa-solid fa-users"></i>
                                        </span>
                                        <input type="number" class="form-control" aria-describedby="inputGroupPrepend" name="numero_participantes" id="numero_participantes" placeholder="Ingrese el # de participantes" required>
                                        <div class="invalid-feedback" id="error_participantes">
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
                                        <textarea class="form-control" aria-describedby="inputGroupPrepend" required name="descripcion_reporte" id="descripcion_reporte" rows="5" placeholder="Describa las actividades realizadas" data-min-caracteres="100"></textarea>
                                        <div class="invalid-feedback" id="error_descripcion">
                                            La descripción de la actividad no puede estar vacía.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">
                                            <i class="fa-solid fa-align-left"></i>
                                        </span>
                                        <textarea class="form-control" aria-describedby="inputGroupPrepend" required name="obstaculos_reporte" id="obstaculos_reporte" rows="5" placeholder="Describa si tuvo que enfrentarse a algún obstaculo durante el desarrollo de las actividades" data-min-caracteres="50"></textarea>
                                        <div class="invalid-feedback" id="error_obstaculos">
                                            Los obstaculos no pueden estar vacíos.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <i class="fa-solid fa-images"></i>
                                    <label for="">Imágenes del reporte:</label>
                                    <div class="input-group has-validation">
                                        <input type="file" class="form-control" id="image-report" name="imagenes_reporte[]" multiple required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="container-fluid">
                                        <div class="preview-container" id="previewContainer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer p-3">
                    <div class="row">
                        <div class="col text-center">
                            <div class="btn-group">
                                <button class="btn btn-primary" type="button" id="btn_enviar_reporte">
                                    <i class="fa-solid fa-paper-plane me-1"></i>
                                    Enviar reporte
                                </button>
                                <a href="<?php echo url("reportes/lista") ?>" class="btn btn-danger">
                                    <i class="fa-solid fa-xmark"></i>
                                    Cancelar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>