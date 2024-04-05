<main class="container-login">
    <div class="container">
        <div class="row" style="height:100%">
            <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-6 col-sm-12 mx-auto">
                <form id="formulario_login" class="formulario_login" novalidate>
                    <div class="card shadow-lg">
                        <div class="card-header text-center p-4">
                            <img class="img-fluid" src="<?php asset("images", "logo.webp") ?>" alt="Logo CIS login" width="140px" height="140px">
                        </div>
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h1 class="text-uppercase fs-5">Centro de Intercambio y Solidaridad</h1>
                            </div>
                            <div class="text-center p-3">
                                <p class="mb-0">Iniciar sesión</p>
                            </div>
                            <input type="hidden" name="_token" value="<?php echo $token ?>" class="form-control">
                            <div class="col-md-12 mb-3">
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="email">
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>
                                    <input type="text" class="form-control" aria-describedby="email" aria-label="Input email" placeholder="Ingresa tu correo electronico" name="email" required>
                                    <div class="invalid-feedback">
                                        El correo no puede estar vacio.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="password">
                                        <i class="fa-solid fa-key"></i>
                                    </span>
                                    <input type="password" class="form-control" aria-describedby="password" aria-label="Input password" placeholder="Ingresa tu contraseña" name="password" id="password-login" required>
                                    <div class="invalid-feedback">
                                        La contraseña no puede estar vacía.
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <a href="<?php echo url("recuperar") ?>" class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            </div>
                        </div>
                        <div class="card-footer text-center p-4">
                            <button class="btn btn-primary" type="submit">
                                <span>
                                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                </span>
                                Ingresar
                            </button>
                            <div class="text-center mt-4 mb-0">
                                <a href="<?php echo url("registrarse") ?>" class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                    Registrarse
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>