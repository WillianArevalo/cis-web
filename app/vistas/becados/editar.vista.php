<main class="container-admin">
    <?php echo breadcumb(); ?>
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="page-header">
                    <div class="icon">
                        <i class="fa-solid fa-user-pen"></i>
                    </div>
                    <div class="text">
                        <h5 class="text-header mb-0">
                            Editar becado
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <form id="formulario_editar_becado" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="_token" value="<?php echo obtenerToken() ?>">
            <input type="hidden" value="<?php echo $becado["id"] ?>" name="id_becado" class="form-control">
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
                                        <img alt="Foto becado" id="imagen-editar" class="mx-auto" style="object-fit:cover" src="<?php asset("images/becados/", $becado["foto"]) ?>" width="140" height="140">
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <div class="custom-file-input">
                                        <input type="file" id="imagen_becado" name="imagen_becado" accept=".jpg, .jpeg, .png" />
                                        <button onclick="document.getElementById('imagen_becado').click()" type="button" class="btn btn-primary">
                                            <i class="fa-solid fa-image"></i>
                                            Editar imagen
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
                                        <input type="text" class="form-control" placeholder="Nombre del becado" name="nombre_becado_editar" value="<?php echo $becado["nombre"] ?>" required>
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
                                        <select name="comunidad_editar" id="comunidad" class="form-control" required>
                                            <option value="">Seleccionar comunidad</option>
                                            <?php if ($comunidades != null) {
                                                foreach ($comunidades as $comunidad) { ?>
                                                    <option value="<?php echo $comunidad['id'] ?>" <?php echo ($becado["id_comunidad"] == $comunidad["id"]) ? "selected" : ""  ?>><?php echo $comunidad['nombre'] ?></option>
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
                                        <input type="text" class="form-control" placeholder="Institución del becado" name="institucion_editar" id="institucion" value="<?php echo $becado["institucion"] ?>" required>
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
                                        <input type="text" class="form-control" placeholder="Nivel academico" name="nivel_academico_editar" value="<?php echo $becado["nivel_academico"] ?>" required>
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
                                        <input type="text" class="form-control" placeholder="Carrera" name="carrera_editar" value="<?php echo $becado["carrera"] ?>" required>
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
                                        <input type="text" class="form-control" placeholder="Estudiando" name="nivel_estudio_editar" value="<?php echo $becado["nivel_estudio"] ?>" required>
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
                                        <select name="usuario_becado_editar" class="form-control" required>
                                            <option value="">Selecciona un usuario</option>
                                            <?php if ($usuarios != null) {
                                                foreach ($usuarios as $usuario) {
                                            ?>
                                                    <option value="<?php echo $usuario["id"] ?>" <?php echo ($becado["id_usuario"] == $usuario["id"]) ? "selected" : "" ?>><?php echo $usuario["nombres"] . " " . $usuario["apellidos"] . " (" . $usuario["id"] . ")" ?></option>
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
                        <div class="card-footer">
                            <div class="text-center">
                                <div class="btn-group m-2">
                                    <a href="<?php echo url("becados") ?>" class="btn btn-danger">
                                        <i class="fa-solid fa-xmark"></i>
                                        Cancelar
                                    </a>
                                    <button class="btn btn-primary" id="btn_editar_becado" type="submit">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                        Actualizar becado
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            var url = "http://localhost/cis/"

            document.getElementById('imagen_becado').addEventListener('change', function() {
                var archivo = this.files[0];
                if (archivo) {
                    var lector = new FileReader(); // Crear un objeto FileReader
                    lector.onload = function(e) {
                        var vistaPrevia = document.getElementById('imagen-editar');
                        vistaPrevia.src = e.target.result; // Establecer la fuente de la imagen seleccionada
                    }
                    lector.readAsDataURL(archivo); // Leer el archivo como una URL de datos
                }
            });
        });
    </script>
</main>