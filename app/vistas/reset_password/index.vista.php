<main class="container-login">
    <div class="container">
        <div class="row" style="height:100%">
            <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-6 col-sm-12 mx-auto">
                <form id="formulario_recuperar" novalidate>
                    <input type="hidden" name="_token" value="<?php echo obtenerToken() ?>">
                    <div class="card shadow-lg">
                        <div class="card-header text-center p-4">
                            <img class="img-fluid" src="<?php asset("images", "logo.webp") ?>" alt="Logo CIS login" width="140px" height="140px">
                        </div>
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h6 class="text-uppercase">Centro de Intercambio y Solidaridad</h6>
                            </div>
                            <div class="text-center p-3">
                                <p class="mb-0">Recuperar contraseña</p>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>
                                    <input type="text" class="form-control" aria-describedby="inputGroupPrepend" placeholder="Ingresa tu correo electronico" name="email" required>
                                    <div class="invalid-feedback">
                                        El correo no puede estar vacio.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer p-4 text-center">
                            <button class="btn btn-primary mx-auto" type="submit">
                                <span>
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                                Enviar correo
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>