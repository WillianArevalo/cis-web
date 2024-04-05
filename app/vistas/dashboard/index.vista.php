<main class="container-admin">
    <?php echo breadcumb(); ?>
    <div class="container-fluid">
        <div class="row mb-4 mt-4">
            <div class="col-12">
                <div class="card p-4">
                    <h3 class="d-flex align-items-center gap-2 mb-0 text-header">
                        <i class="fa-solid fa-gauge"></i>
                        Bienvenido al Dashboard
                    </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                <div class="card shadow-lg mb-4 bg-body-tertiary">
                    <div class="card-header d-flex align-items-center text-white justify-content-left gap-2 bg-primary">
                        <div class="rounded-circle square bg-dark d-flex align-items-center justify-content-center">
                            <h6 class="mb-0"><?php echo $total_becados ?></h6>
                        </div>
                        <h6 class="mb-0">Becados</h6>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid mb-1 text-center">
                            <img src="<?php asset("images", "user-group-monochromatic.svg") ?>" class="img-thumbnail" alt="becados" width="200" height="200">
                        </div>
                    </div>
                    <div class="card-footer p-3">
                        <a href="<?php echo url("becados") ?>" class="btn btn-primary">
                            <i class="fa-solid fa-eye"></i>
                            Ver
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                <div class="card shadow-lg mb-4 bg-body-tertiary">
                    <div class="card-header bg-primary text-white d-flex align-items-center justify-content-left gap-2">
                        <div class="rounded-circle square bg-dark d-flex align-items-center justify-content-center">
                            <h6 class="mb-0"><?php echo $total_proyectos ?></h6>
                        </div>
                        <h6 class="mb-0">Proyectos sociales</h6>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid text-center">
                            <img src="<?php asset("images", "knowledge-isometric.svg") ?>" class="img-thumbnail" alt="becados" width="200" height="200">
                        </div>
                    </div>
                    <div class="card-footer p-3">
                        <a href="<?php echo url("proyectos") ?>" class="btn btn-primary">
                            <i class="fa-solid fa-eye"></i>
                            Ver
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                <div class="card shadow-lg mb-4 bg-body-tertiary">
                    <div class="card-header bg-primary text-white d-flex align-items-center justify-content-left gap-2">
                        <div class="rounded-circle square bg-dark d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-file-lines"></i>
                        </div>
                        <h6 class="mb-0 p-1">Reportes</h6>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid text-center">
                            <img src="<?php asset("images", "report-analysis-isometric-109e6.svg") ?>" class="img-thumbnail" alt="becados" srcset="" width="200" height="200">
                        </div>
                    </div>
                    <div class="card-footer p-3">
                        <a href="<?php echo url("reportes") ?>" class="btn btn-primary">
                            <i class="fa-solid fa-eye"></i>
                            Ver
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
                <div class="card shadow-lg mb-4 bg-body-tertiary">
                    <div class="card-header bg-primary text-white d-flex align-items-center justify-content-left gap-2">
                        <div class="rounded-circle square bg-dark d-flex align-items-center justify-content-center">
                            <h6 class="mb-0"><?php echo $total_comunidades ?></h6>
                        </div>
                        <h6 class="mb-0">Comunidades</h6>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid text-center">
                            <img src="<?php asset("images", "home.svg") ?>" class="img-thumbnail" alt="comunidades" width="179" height="179">
                        </div>
                    </div>
                    <div class="card-footer p-3">
                        <a href="<?php echo url("comunidades") ?>" class="btn btn-primary ">
                            <div class="d-flex align-items-center justify-content-left gap-1">
                                <i class="fa-solid fa-eye"></i>
                                Ver
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>