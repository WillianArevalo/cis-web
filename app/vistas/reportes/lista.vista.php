<?php
$mesActual = strtolower(obtenerNombreMes(date('n')));
$className = "bg-dark text-light";
actualizarMeses($mes_reporte, $mesActual);
$meses = $_SESSION["meses"];
?>
<main class="container-scholarship mt-4">
    <div class="container mb-4">
        <div class="page-header">
            <div class="icon">
                <i class="fa-solid fa-file-lines"></i>
            </div>
            <div class="text">
                <h4 class="text-header mb-0">
                    Reportes
                </h4>
            </div>
        </div>
        <div class="row">
            <?php
            foreach ($meses as $mes => $estado) :
                if ($meses[$mes] == "enviado") :
                    $className = "success";
                elseif ($meses[$mes] == "no enviado") :
                    $className = "dark";
                else :
                    $className = "danger";
                endif;
            ?>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                    <div class="card mt-4">
                        <div class="card-header bg-<?php echo $className ?> text-light">
                            <div class="d-flex align-items-center justify-content-left gap-2">
                                <?php
                                if ($meses[$mes] == "enviado") {
                                ?>
                                    <i class="fa-solid fa-calendar-check fs-5"></i>
                                <?php
                                } elseif ($meses[$mes] == "pendiente") {
                                ?>
                                    <i class="fa-regular fa-calendar-xmark fs-5"></i>
                                <?php
                                } else {
                                ?>
                                    <i class="fa-solid fa-calendar-days fs-5"></i>
                                <?php
                                } ?>
                                <h5 class="mb-0"><?php echo ucfirst($mes) ?></h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-<?php echo $className ?> mb-0" role="alert">
                                <strong>
                                    <p class="mb-0">Reporte <?php echo $meses[$mes] ?></p>
                                </strong>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <?php if ($meses[$mes] === "enviado") : ?>
                                <a href="<?php echo url("reportes/enviar/$mes") ?>" class="btn btn-success disabled">
                                    <i class="fa-solid fa-circle-check"></i>
                                    Enviado
                                </a>
                            <?php elseif ($meses[$mes] === "no enviado") : ?>
                                <a href="<?php echo url("reportes/enviar/$mes") ?>" class="btn btn-primary disabled">
                                    <i class="fa-solid fa-clock"></i>
                                    Enviar reporte
                                </a>
                            <?php else : ?>
                                <a href="<?php echo url("reportes/enviar/$mes") ?>" class="btn btn-primary">
                                    <i class="fa-solid fa-paper-plane"></i>
                                    Enviar reporte
                                </a>
                            <?php endif; ?>
                            <?php
                            if ($meses[$mes] == "enviado") :
                                foreach ($reporte as $report) :
                                    if ($report["mes"] == $mes) :
                            ?>
                                        <a href="<?php echo url("reportes/detalles/$report[id]") ?>" class="btn btn-warning">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                            <?php
                                    endif;
                                endforeach;
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            endforeach;
            ?>
        </div>
    </div>
</main>