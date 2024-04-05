<?php
$reporte_status = "Sin enviar";
$mesActual = obtenerNombreMes(date('n'));
$bg = "danger";

if ($mes_reporte != null) {
    foreach ($mes_reporte as $mes) {
        if ($mes === $mesActual) {
            $reporte_status = "Enviado";
            $bg = "success";
            break;
        }
    }
} else {
    $reporte_status = "Sin enviar";
    $bg = "danger";
}
?>
<main class="container-scholarship mt-4">
    <div class="container">
        <div class="card">
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 text-center">
                    <img src="<?php asset("images", "tree.svg") ?>" class="p-3" alt="Imagen proyecto" width="100" height="100">
                </div>
                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 p-4">
                    <h3 class="text-uppercase mb-0 text-header"><strong>Proyecto asignado:</strong></h3>
                    <h5 class="mb-0 text-uppercase text-header"><?php echo (!isset($proyecto["nombre_proyecto"])) ?  "No ha sido asignado a ningún proyecto" : $proyecto["nombre_proyecto"] ?></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-4">
                <div class="card">
                    <div class="card-header p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Reportes mensuales</h5>
                            <div class="rounded-circle square bg-primary d-flex align-items-center justify-content-center">
                                <h5 class="mb-0">
                                    <i class="fa-regular fa-file-lines text-light fs-5"></i>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <img src="<?php asset("images", "report.svg") ?>" alt="" class="img-thumbnail p-4" width="300" height="300">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <p>Reporte del mes actual:</p>
                                <div class="alert alert-<?php echo $bg ?>" role="alert">
                                    <p class="mb-0"><?php echo $reporte_status ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group">
                            <a href="<?php echo url("reportes/lista") ?>" class="btn btn-primary <?php echo (!isset($proyecto["nombre_proyecto"]) ? "disabled" : "") ?>">
                                <i class="fa-regular fa-eye"></i>
                                Ver
                            </a>
                            <a href="<?php echo url("reportes/enviar/$mesActual") ?>" class="btn  btn-<?php echo ($reporte_status == "Enviado" ? "success" : "warning")  ?> text-dark <?php echo (!isset($proyecto["nombre_proyecto"])) ? "disabled" : ($reporte_status == "Enviado" ? "disabled" : "") ?>">
                                <?php if ($reporte_status == "Enviado") { ?>
                                    <i class="fa-regular fa-square-check"></i>
                                    Reporte enviado
                                <?php } else {
                                ?>
                                    <i class="fa-solid fa-file-import"></i>
                                    Enviar reporte
                                <?php
                                } ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-4 mb-4">
                <div class="card">
                    <div class="card-header p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bx bxs-user fs-4"></i>
                                <h5 class="mb-0">Integrantes proyecto</h5>
                            </div>
                            <div class="bg-primary d-flex align-items-center justify-content-center rounded-circle square text-light">
                                <h6 class="mb-0"><?php echo ($total_integrantes != null) ? $total_integrantes["cantidad"] : "0" ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 text-left">
                                <div class="d-flex gap-2 flex-wrap">
                                    <?php
                                    if ($integrantes != null) {
                                        foreach ($integrantes as $integrante) { ?>
                                            <div class="">
                                                <img src="<?php asset("images/becados", $integrante["foto"]) ?>" alt="Foto becado" class="img-thumbnail" style="object-fit:cover; width: 65px; height:65px; border-radius:50%">
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class=" col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <p class="mb-0">Integrantes:</p>
                                <ul class="list-group">
                                    <?php if ($integrantes != null) {
                                        foreach ($integrantes as $integrante) { ?>
                                            <li class="list-group-item"><?php echo $integrante["nombre"] ?></li>
                                    <?php
                                        }
                                    } else {
                                        echo "No se ha asignado ningún integrante";
                                    } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>