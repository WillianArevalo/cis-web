<main class="container-register">
    <div class="container">
        <div class="row" style="height:100%">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 mx-auto">
                <form id="formulario_registrarse" novalidate>
                    <input type="hidden" name="_token" value="<?php echo obtenerToken() ?>">
                    <div class="card shadow-lg">
                        <div class="card-header text-center">
                            <img class="img-fluid" src="<?php asset("images", "logo.webp") ?>" alt="Logo CIS login" width="120px" height="120px">
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <h1 class="text-uppercase mb-0 fs-5">Centro de Intercambio y Solidaridad</h1>
                            </div>
                            <div class="text-center p-4">
                                <p class="mb-0">Registrarse</p>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-sm-2">
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="nombres">
                                            <i class="fa-solid fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control" aria-describedby="nombres" aria-label="Input names" placeholder="Nombres completos" name="nombres" required>
                                        <div class="invalid-feedback">
                                            Los nombres no pueden estar vacios.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="apellidos">
                                            <i class="fa-solid fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control" aria-describedby="apellidos" aria-label="Input lastname" placeholder="Apellidos completos" name="apellidos" required>
                                        <div class="invalid-feedback">
                                            Los apellidos no pueden estar vacios.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="email">
                                            <i class="fa-solid fa-envelope"></i>
                                        </span>
                                        <input type="text" class="form-control" aria-describedby="email" aria-label="Input email" placeholder="example@example.com" name="email" required>
                                        <div class="invalid-feedback">
                                            El correo no puede estar vacío.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="pass">
                                            <i class="fa-solid fa-key"></i>
                                        </span>
                                        <input type="password" class="form-control" aria-describedby="pass" aria-label="Input password" placeholder="Contraseña" name="password" data-min-caracteres="8" id="password" required>
                                        <div class="invalid-feedback">
                                            La contraseña no puede estar vacía.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="confirmed-password">
                                            <i class="fa-solid fa-key"></i>
                                        </span>
                                        <input type="password" class="form-control" aria-describedby="confirmed-password" aria-label="Input confirmed password" placeholder="Confirmar contraseña" name="confirm_password" id="confirm_password" data-min-caracteres="8" required>
                                        <div class="invalid-feedback">
                                            La contraseña no puede estar vacía.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="user">
                                            <i class="fa-solid fa-circle-user"></i>
                                        </span>
                                        <input type="text" class="form-control" aria-describedby="user" aria-label="Input user" placeholder="Ingresar usuario. Ej. Willian Arevalo" name="usuario" data-min-caracteres="8" required>
                                        <div class="invalid-feedback">
                                            El usuario no puede estar vacio.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center p-4">
                            <div class="btn-group">
                                <a href="<?php url("") ?>" class="btn btn-danger">
                                    <span>
                                        <i class="fa-solid fa-circle-arrow-left"></i>
                                    </span>
                                    Ingresar
                                </a>
                                <button class="btn btn-primary" type="submit">
                                    <span>
                                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                    </span>
                                    Registrarse
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>