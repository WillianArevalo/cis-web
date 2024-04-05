<?php
$usuario = obtenerSesión("usuario");
$becado = obtenerSesión("becado");
?>
<main class="<?php echo ($usuario["rol"] === "admin") ? "container-admin" : "container-scholarship" ?>">
    <?php echo ($usuario["rol"] == "admin") ?  breadcumb() : ""; ?>
    <div class="container mb-4">
        <div class=" grid-cards">
            <div class="card card-1">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">Foto de perfil</h6>
                </div>
                <div class="card-body text-center d-flex align-items-center justify-content-center">
                    <img src="<?php ($becado == null) ? asset("images", "profile.webp") : asset("images/becados", $becado["foto"]) ?>" alt="Foto de perfil del Administrador" class="rounded-circle" width="200" height="200">
                </div>
            </div>
            <div class="card p-1 d-flex align-items-start justify-content-center card-2">
                <div class="ms-5">
                    <h4 class="mb-0 name-perfil">
                        <?php echo $usuario["nombres"] . "&nbsp" . $usuario["apellidos"] ?>
                    </h4>
                    <h6 class="mb-0">
                        <i class="fa-solid fa-user-tie"></i>
                        <?php echo ($usuario["rol"] == "admin") ? "Administrador" : "Becado" ?>
                    </h6>
                    <p class="mb-0 text-break">
                        <i class="fa-solid fa-envelope"></i>
                        <?php echo $usuario["email"] ?>
                    </p>
                </div>
            </div>
            <div class="card card-3">
                <div class="card-header bg-primary text-white">
                    <div class="text-center">
                        <h6 class="mb-0">Actualizar perfil</h6>
                    </div>
                </div>
                <div class="card-body p-4 d-flex justify-content-center flex-column w-100">
                    <form action="">
                        <div class="input-group has-validation">
                            <span class="input-group-text">
                                <i class="fa-regular fa-circle-user"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Nombres" value="<?php echo $usuario["nombres"]  ?>" name="nombres" required readonly>
                            <div class="invalid-feedback">
                                Los nombres son requeridos.
                            </div>
                        </div>
                        <div class="input-group mt-3 has-validation">
                            <span class="input-group-text">
                                <i class="fa-regular fa-circle-user"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Apellidos" value="<?php echo $usuario["apellidos"] ?>" name="apellidos" required readonly>
                            <div class="invalid-feedback">
                                Los apellidos son requeridos.
                            </div>
                        </div>
                        <div class="input-group mt-3 has-validation">
                            <span class="input-group-text">
                                <i class="fa-solid fa-user-tie"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Usuario" value="<?php echo $usuario["usuario"] ?>" name="usuario" required readonly>
                            <div class="invalid-feedback">
                                El usuario es requerido.
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-9 col-sm-12">
                                <div class="input-group mt-3 has-validation">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Email" value="<?php echo $usuario["email"] ?>" name="email" id="email" required>
                                    <div class="invalid-feedback">
                                        El email es requerido.
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-12 mt-3">
                                <button type="button" class="btn btn-primary" id="cambiar_correo" data-token="<?php echo obtenerToken() ?>">Cambiar correo</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div class="card card-4">
                <div class="card-header text-left bg-primary text-white">
                    <h6 class="mb-0">Cambiar contraseña</h6>
                </div>
                <div class="card-body d-flex justify-content-center flex-column w-100">
                    <form id="formulario_cambiar_clave" novalidate>
                        <input type="hidden" name="_token" value="<?php echo obtenerToken() ?>" id="token">
                        <div class="input-group mt-3 has-validation">
                            <span class="input-group-text">
                                <i class="fa-solid fa-key"></i>
                            </span>
                            <input type="password" class="form-control" id="password" placeholder="Nueva contraseña" name="password" data-min-caracteres="8" required>
                            <div class="invalid-feedback">
                                La nueva contraseña es requerida.
                            </div>
                        </div>
                        <div class="input-group mt-3 has-validation">
                            <span class="input-group-text">
                                <i class="fa-solid fa-key"></i>
                            </span>
                            <input type="password" class="form-control" placeholder="Confirmar contraseña" id="confirmed_password" name="confirmed_password" data-min-caracteres="8" required>
                            <div class="invalid-feedback">
                                Debe confirmar la contraseña.
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-success mx-auto" type="button" id="cambiar_contraseña">
                                <i class="fa-solid fa-arrow-rotate-left"></i>
                                Cambiar contraseña
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="mobile text-center">
            <a href="<?php echo ($usuario["rol"] == "admin") ?  url("dashboard") : url("inicio") ?>" class="btn btn-danger  mx-auto">
                <?php echo ($usuario["rol"] == "admin") ?  "<i class='fa-solid fa-gauge me-2'></i>Dashboard" : "<i class='fa-solid fa-house me-2'></i>Inicio" ?>
            </a>
        </div>
    </div>
</main>