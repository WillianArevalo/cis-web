<main class="container-admin">
    <?php echo breadcumb(); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12  mt-4 mb-4">
                <div class="page-header">
                    <div class="icon">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>
                    <div class="text">
                        <h4 class="text-header mb-0">
                            Reportes mensuales
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ml-nav">
            <div class="col-12">
                <div class="card">
                    <div class="accordion accordion-flush p-4" id="accordionFlushExample">
                        <?php
                        if ($proyectos != null) :
                            $num = 0;
                            foreach ($proyectos as $proyecto) :
                                $num++;
                        ?>
                                <div class="accordion-item border border-light-subtle">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-<?php echo $proyecto["id_proyecto"]  ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                                            <span class="me-2">
                                                <i class="fa-solid fa-bookmark"></i>
                                            </span>
                                            <?php echo $proyecto["nombre_proyecto"] ?>
                                        </button>
                                    </h2>
                                    <div id="flush-collapse-<?php echo $proyecto["id_proyecto"] ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="container-fluid mb-4">
                                            <div class="table-responsive desktop card p-3 mt-4">
                                                <div class="card-header">
                                                    <h6 class="mb-0">Listado de reportes enviados</h6>
                                                </div>
                                                <table class="table text-center mb-0" id="tabla-reportes-<?php echo $num ?>">
                                                    <thead class="bg-primary text-white">
                                                        <tr>
                                                            <th scope="col">Mes</th>
                                                            <th scope="col">Tema</th>
                                                            <th scope="col">Enviado por</th>
                                                            <th scope="col">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($proyecto["reportes"] as $reporte) {
                                                            if ($reporte["id_reporte"] != null) {
                                                        ?>
                                                                <tr>
                                                                    <td><?php echo $reporte["mes"] ?></td>
                                                                    <td><?php echo $reporte["tema"] ?></td>
                                                                    <td><?php echo $reporte["enviado_por"] ?></td>
                                                                    <td>
                                                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                                                            <a class="btn btn-success" href="<?php echo url("reportes/editar/$reporte[id_reporte]") ?>">
                                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                                            </a>
                                                                            <button class="btn btn-danger btn-eliminar-reporte" data-id="<?php echo $reporte["id_reporte"] ?>" data-token="<?php echo obtenerToken() ?>">
                                                                                <i class="fa-solid fa-trash"></i>
                                                                            </button>
                                                                            <a class="btn btn-warning" href="<?php echo url("reportes/detalles/$reporte[id_reporte]") ?>">
                                                                                <i class="fa-solid fa-eye text-white"></i>
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                        <?php
                                                            } else {
                                                                echo "<tr><td colspan='4'>No hay reportes mensuales</td></tr>";
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- Mobile -->
                                        <?php foreach ($proyecto["reportes"] as $reporte) :
                                            if ($reporte["id_reporte"] != null) :
                                        ?>
                                                <div class="card mobile mb-4">
                                                    <div class="card-header">
                                                        <h6 class="mb-0"><?php echo $reporte["mes"] ?></h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <strong>
                                                                <p class="mb-0">Tema</p>
                                                            </strong>
                                                        </div>
                                                        <div class="row mb-2">
                                                            <p class="mb-0"><?php echo $reporte["tema"] ?></p>
                                                        </div>
                                                        <div class="row">
                                                            <strong>
                                                                <p class="mb-0">Enviador por</p>
                                                            </strong>
                                                        </div>
                                                        <div class="row">
                                                            <p class="mb-0"><?php echo $reporte["enviado_por"] ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="btn-group">
                                                            <a href="<?php echo url("reportes/editar/$reporte[id_reporte]") ?>" class="btn btn-primary">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a>
                                                            <button class="btn btn-danger btn-eliminar-reporte" data-id="<?php echo $reporte["id_reporte"] ?>" data-token="<?php echo obtenerToken() ?>">
                                                                <i class="fa-solid fa-trash"></i>
                                                            </button>
                                                            <a class="btn btn-warning" href="<?php echo url("reportes/detalles/$reporte[id_reporte]")  ?>">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            else :
                                            ?>
                                                <div class='card mobile mb-4'>
                                                    <div class='card-body'>
                                                        <p class='mb-0'>No hay reportes mensuales</p>
                                                    </div>
                                                </div>
                                        <?php
                                            endif;
                                        endforeach; ?>
                                        <!-- End Mobile -->
                                    </div>
                                </div>
                            <?php
                            endforeach;
                        else :
                            ?>
                            <div class="alert alert-warning mb-0" role="alert">
                                <p class="mb-0">No hay proyectos sociales</p>
                            </div>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>