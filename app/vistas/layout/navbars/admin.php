<?php
$usuario = obtenerSesión("usuario");
$becado = obtenerSesión("becado");
?>
<header>
    <nav class="position-fixed navbar-admin bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class=" d-flex flex-column flex-shrink-0 p-3" style="height:100vh">
            <a href="<?php echo url("dashboard") ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img src="<?php asset("images", "logo.webp") ?>" alt="Logo de CIS" width="32" height="32" class="rounded-circle me-2 object-fit-cover">
                <h1 class="fs-4 name-user mb-0">ADMINISTRADOR</h1>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="<?php echo url("dashboard") ?>" class="nav-link d-flex align-items-center gap-2 <?php echo currentPage("dashboard") ?>" aria-current="page">
                        <span>
                            <i class="fa-solid fa-house"></i>
                        </span>
                        Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo url("becados") ?>" class="nav-link link-body-emphasis d-flex align-items-center gap-2 <?php echo currentPage("becados") ?>">
                        <span>
                            <i class="fa-solid fa-people-group"></i>
                        </span>
                        Becados
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo url("proyectos") ?>" class="nav-link link-body-emphasis d-flex align-items-center gap-2 <?php echo currentPage("proyectos") ?>">
                        <span>
                            <i class="fa-solid fa-folder"></i>
                        </span>
                        Proyectos
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo url("reportes") ?>" class="nav-link link-body-emphasis d-flex align-items-center gap-2 <?php echo currentPage("reportes") ?>">
                        <span>
                            <i class="fa-regular fa-file-lines"></i>
                        </span>
                        Reportes
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo url("comunidades") ?>" class="nav-link link-body-emphasis d-flex align-items-center gap-2 <?php echo currentPage("comunidades") ?>">
                        <span>
                            <i class="fa-solid fa-building"></i>
                        </span>
                        Comunidades
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo url("usuarios") ?>" class="nav-link link-body-emphasis d-flex align-items-center gap-2 <?php echo currentPage("usuarios") ?>">
                        <span>
                            <i class="fa-solid fa-users"></i>
                        </span>
                        Usuarios
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?php ($becado == null) ? asset("images", "profile.webp") : asset("images/becados", $becado["foto"]) ?>" alt="Foto de perfil del Administrador" width="32" height="32" class="rounded-circle me-2 object-fit-cover">
                    <strong class="text-primary"><?php echo $usuario["usuario"] ?></strong>
                </a>
                <ul class="dropdown-menu text-small shadow">
                    <li>
                        <a class="dropdown-item" href="<?php echo url("perfil") ?>">
                            <span>
                                <i class="fa-solid fa-circle-user"></i>
                            </span>
                            Perfil
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="btn_cerrar_sesion">
                        <a class="dropdown-item" href="#">
                            <span><i class="fa-solid fa-right-from-bracket"></i></span>
                            Cerrar sesión
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <nav class="navbar mobile bg-dark position-fixed  w-100">
        <div class=" container-fluid">
            <a class="navbar-brand" href="<?php echo url("perfil") ?>">
                <img src="<?php ($becado == null) ? asset("images", "profile.webp") : asset("images/becados", $becado["foto"]) ?>" alt="Foto de perfil del Administrador" width="32" height="32" class="rounded-circle me-2 object-fit-cover">
                <strong class="text-white"><?php echo $usuario["usuario"] ?></strong>
            </a>
            <button class="navbar-toggler btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-white bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header d-flex align-items-center justify-content-between mt-4">
                    <div class="d-flex container">
                        <img src="<?php ($becado == null) ? asset("images", "logo.webp") : asset("images/becados", $becado["foto"]) ?>" alt="Foto de perfil del Administrador" width="32" height="32" class="rounded-circle me-2 object-fit-cover">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">CIS</h5>
                    </div>
                    <button type="button" class="btn text-white" data-bs-dismiss="offcanvas" aria-label="Close">
                        <i class="fa-solid fa-xmark fs-4"></i>
                    </button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a href="<?php echo url("dashboard") ?>" class="nav-link d-flex align-items-center gap-2 <?php echo currentPage("dashboard") ?>" aria-current="page">
                                <span>
                                    <i class="fa-solid fa-house"></i>
                                </span>
                                Inicio
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo url("becados") ?>" class="nav-link link-body-emphasis d-flex align-items-center gap-2 <?php echo currentPage("becados") ?>">
                                <span>
                                    <i class="fa-solid fa-people-group"></i>
                                </span>
                                Becados
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo url("proyectos") ?>" class="nav-link link-body-emphasis d-flex align-items-center gap-2 <?php echo currentPage("proyectos") ?>">
                                <span>
                                    <i class="fa-solid fa-folder"></i>
                                </span>
                                Proyectos
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo url("reportes") ?>" class="nav-link link-body-emphasis d-flex align-items-center gap-2 <?php echo currentPage("reportes") ?>">
                                <span>
                                    <i class="fa-regular fa-file-lines"></i>
                                </span>
                                Reportes
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo url("comunidades") ?>" class="nav-link link-body-emphasis d-flex align-items-center gap-2 <?php echo currentPage("comunidades") ?>">
                                <span>
                                    <i class="fa-solid fa-building"></i>
                                </span>
                                Comunidades
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo url("usuarios") ?>" class="nav-link link-body-emphasis d-flex align-items-center gap-2 <?php echo currentPage("usuarios") ?>">
                                <span>
                                    <i class="fa-solid fa-circle-user"></i>
                                </span>
                                Usuarios
                            </a>
                        </li>
                        <li class="btn_cerrar_sesion">
                            <a href="#" class="nav-link link-body-emphasis d-flex align-items-center gap-2">
                                <span>
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                </span>
                                Cerrar sesión
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>