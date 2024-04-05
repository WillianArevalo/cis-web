<?php
$becado = obtenerSesión("becado");
$usuario = obtenerSesión("usuario");
?>
<header class="fixed-top">
    <nav class="navbar navbar-expand-lg bg-dark  border-bottom-primary">
        <div class="container">
            <div class="navbar-brand d-flex align-items-center justify-content-center text-primary">
                <img src="<?php asset("images", "logo.webp") ?>" alt="" width=45" height="45" class="rounded-circle me-2 object-fit-cover">
                <h5 class="mb-0">CIS | Tacachico</h5>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="text-white">
                    <i class="fa-solid fa-bars fs-5"></i>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link becado d-flex align-items-center justify-content-start gap-2" aria-current="page" href="<?php echo url("inicio") ?>">
                            <i class="fa-solid fa-home"></i>
                            Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link becado d-flex align-items-center justify-content-start gap-2" href="<?php echo url("reportes/lista") ?>">
                            <i class="fa-solid fa-file-lines"></i>
                            Reportes
                        </a>
                    </li>
                    <li class="nav-item mobile">
                        <a class="nav-link becado d-flex align-items-center justify-content-start gap-2" href="<?php echo url("perfil") ?>">
                            <i class="fa-solid fa-circle-user"></i>
                            Perfil
                        </a>
                    </li>
                    <li class="nav-item mobile btn_cerrar_sesion mobile">
                        <a class="nav-link becado d-flex align-items-center justify-content-start gap-2" href="#">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Cerrar sesión
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown me-2 desktop">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php (!isset($becado["foto"])) ? asset("images", "profile.webp") : asset("images/becados", $becado["foto"]) ?>" alt="" width="45" height="45" class="rounded-circle me-2 object-fit-cover">
                            <p class="d-inline"><?php echo $usuario["usuario"] ?></p>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item d-flex align-items-center justify-content-start gap-2" href="<?php echo url("perfil") ?>">
                                    <i class="fa-regular fa-user"></i>
                                    Perfil
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="btn_cerrar_sesion">
                                <a class="dropdown-item d-flex align-items-center justify-content-start gap-2" href="#">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    Cerrar sesión
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>