<main class="container-admin">
    <?php echo breadcumb();
    $parametrosRequest = explode("?", $_SERVER['REQUEST_URI']);
    ?>
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="page-header">
                    <div class="icon">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <div class="text">
                        <h5 class="text-header mb-0">
                            Nuevo becado
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <form id="formulario_agregar_becado" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="_token" value="<?php echo obtenerToken() ?>">
            <div class="row mt-4">
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4 mx-auto">
                    <div class="card shadow bg-body-tertiary">
                        <div class="card-header d-flex align-items-center gap-2">
                            <i class="fa-solid fa-image fs-4"></i>
                            <h6 class="mb-0">Foto becado</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="card col-8 mx-auto p-4 mt-2">
                                    <div class="container-fluid contenedor-imagen mt-2 text-center">
                                        <img alt="Foto becado" src="<?php asset("images", "sin_imagen.jpg") ?>" class="mx-auto object-fit-cover" id="imagen-agregar" width="140" height="140">
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <div class="custom-file-input">
                                        <input type="file" id="imagen_becado" required name="imagen_becado" accept=".jpg, .jpeg, .png" />
                                        <button onclick="document.getElementById('imagen_becado').click()" type="button" class="btn btn-primary">
                                            <i class="fa-solid fa-image"></i>
                                            Seleccionar imagen
                                        </button>
                                        <br>
                                        <div class="invalid-feedback">
                                            La imagen no puede estar vacía.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12">
                    <div class="card shadow bg-body-tertiary mb-4">
                        <div class="card-header d-flex align-items-center gap-2">
                            <i class="fa-solid fa-circle-info fs-4"></i>
                            <h6 class="mb-0">Información del becado</h6>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-group has-validation">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Nombre del becado" name="nombre_becado" required>
                                        <div class="invalid-feedback">
                                            El nombre del becado no puede estar vacío.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-group mt-3 has-validation">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </span>
                                        <select name="comunidad" id="comunidad" class="form-control" required>
                                            <option value="">Seleccionar comunidad</option>
                                            <?php if ($comunidades != null) {
                                                foreach ($comunidades as $comunidad) { ?>
                                                    <option value="<?php echo $comunidad['id'] ?>"><?php echo $comunidad['nombre'] ?></option>
                                            <?php
                                                }
                                            } ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            La comunidad no puede estar vacía.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12">
                                    <div class="input-group mt-3 has-validation">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-school"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Institución del becado" name="institucion" id="institucion" required>
                                        <div class="invalid-feedback">
                                            La institución no puede estar vacía.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12">
                                    <div class="input-group mt-3 has-validation">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-graduation-cap"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Nivel academico" name="nivel_academico" required>
                                        <div class="invalid-feedback">
                                            El nivel académico no puede estar vacío.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12">
                                    <div class="input-group mt-3 has-validation">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-graduation-cap"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Carrera" name="carrera" required>
                                        <div class="invalid-feedback">
                                            La carrera no puede estar vacía.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                                    <div class="input-group mt-3 has-validation">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-list-ol"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Estudiando" name="nivel_estudio" required>
                                        <div class="invalid-feedback">
                                            El nivel no puede estar vacío.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-group mt-3 has-validation">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-user-plus"></i>
                                        </span>
                                        <select name="usuario_becado" class="form-control" required>
                                            <option value="">Selecciona un usuario</option>
                                            <?php if ($usuarios != null) {
                                                foreach ($usuarios as $usuario) {
                                            ?>
                                                    <option value="<?php echo $usuario["id"] ?>"><?php echo $usuario["nombres"] . " " . $usuario["apellidos"] . " (" . $usuario["rol"] . ")" ?></option>
                                            <?php
                                                }
                                            } ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Elije un usuario válido.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <div class="m-2 btn-group">
                                <a href="<?php echo url("becados") ?>" class="btn btn-danger">
                                    <i class="fa-solid fa-circle-arrow-left"></i>
                                    Regresar
                                </a>
                                <button class="btn btn-primary btn_agregar_becado" type="submit">
                                    <i class="fa-solid fa-circle-plus"></i>
                                    Agregar becado
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>



<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('imagen_becado').addEventListener('change', function() {
            var archivo = this.files[0];
            if (archivo) {
                var lector = new FileReader(); // Crear un objeto FileReader
                lector.onload = function(e) {
                    var vistaPrevia = document.getElementById('imagen-agregar');
                    vistaPrevia.src = e.target.result; // Establecer la fuente de la imagen seleccionada
                }
                lector.readAsDataURL(archivo); // Leer el archivo como una URL de datos
            }
        });
    });
</script>