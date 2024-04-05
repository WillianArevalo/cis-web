<?php
$usuario = obtenerSesión("usuario");
if ($usuario["rol"] == "becado") :
?>
    <main class="container-scholarship">
        <div class="container">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="page-header">
                        <div class="icon">
                            <i class="fa-solid fa-circle-info"></i>
                        </div>
                        <div class="text">
                            <h4 class="text-header mb-0">
                                Detalles del reporte
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row no-gutters mt-4">
                        <div class="col-12 mx-auto">
                            <div class="card mb-3 p-4">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fa-solid fa-calendar"></i>
                                        <strong>Mes:</strong>
                                        <?php echo $reporte["mes"] ?>
                                    </h5>
                                    <h6 class="card-text">
                                        <i class="fa-solid fa-bookmark"></i>
                                        <strong>Tema:</strong>
                                        <?php echo $reporte["tema"] ?>
                                    </h6>
                                    <p class="card-text">
                                        <i class="fa-regular fa-rectangle-list"></i>
                                        <strong>Descripción:</strong>
                                        <?php echo $reporte["descripcion"] ?>
                                    </p>
                                    <p class="card-text">
                                        <i class="fa-regular fa-rectangle-list"></i>
                                        <strong>
                                            Obstáculos:
                                        </strong>
                                        <?php echo $reporte["obstaculos"] ?>
                                    </p>
                                    <p class="card-text">
                                        <i class="fa-solid fa-paper-plane"></i>
                                        <strong>
                                            Enviado por:
                                        </strong>
                                        <?php echo $reporte["enviado_por"] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mx-auto mb-4">
                            <div class="card p-4">
                                <div class="alert alert-primary" role="alert">
                                    <div class="d-flex align-items-center justify-content-start gap-2">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="mb-0">Imágenes</p>
                                    </div>
                                </div>
                                <div class="w-75 mx-auto">
                                    <div class="slider-image">
                                        <?php foreach ($imagenes as $index => $imagen) : ?>
                                            <img src="<?php asset("images/proyectos/", $reporte["nombre_proyecto"] . "/" . $reporte["mes"] . "/" . $imagen["imagen"]) ?>" class="image-report" alt="Fotos reportes" style="object-fit:cover">
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mx-auto mb-4 w-25">
                        <a href="<?php echo url("reportes/lista") ?>" class="btn btn-primary">
                            <i class="fa-solid fa-circle-arrow-left"></i>
                            Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php else : ?>
    <main class="container-admin">
        <?php echo breadcumb(); ?>
        <div class="container-fluid  contenedor-general">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="page-header">
                        <div class="icon">
                            <i class="fa-solid fa-circle-info"></i>
                        </div>
                        <div class="text">
                            <h4 class="text-header mb-0">
                                Detalles del reporte
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row no-gutters mt-4">
                        <div class="col-12 mx-auto">
                            <div class="card mb-3 p-4">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fa-solid fa-calendar"></i>
                                        <strong>Mes:</strong>
                                        <?php echo $reporte["mes"] ?>
                                    </h5>
                                    <h6 class="card-text">
                                        <i class="fa-solid fa-bookmark"></i>
                                        <strong>Tema:</strong>
                                        <?php echo $reporte["tema"] ?>
                                    </h6>
                                    <p class="card-text">
                                        <i class="fa-regular fa-rectangle-list"></i>
                                        <strong>Descripción:</strong>
                                        <?php echo $reporte["descripcion"] ?>
                                    </p>
                                    <p class="card-text">
                                        <i class="fa-regular fa-rectangle-list"></i>
                                        <strong>
                                            Obstáculos:
                                        </strong>
                                        <?php echo $reporte["obstaculos"] ?>
                                    </p>
                                    <p class="card-text">
                                        <i class="fa-solid fa-paper-plane"></i>
                                        <strong>
                                            Enviado por:
                                        </strong>
                                        <?php echo $reporte["enviado_por"] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mx-auto mb-4">
                            <div class="card p-4">
                                <div class="alert alert-primary" role="alert">
                                    <div class="d-flex align-items-center justify-content-start gap-2">
                                        <i class="fa-solid fa-image"></i>
                                        <p class="mb-0">Imágenes</p>
                                    </div>
                                </div>
                                <div class="w-75 mx-auto">
                                    <div class="slider-image">
                                        <?php foreach ($imagenes as $index => $imagen) : ?>
                                            <img src="<?php asset("images/proyectos/", $reporte["nombre_proyecto"] . "/" . $reporte["mes"] . "/" . $imagen["imagen"]) ?>" class="image-report" alt="Fotos reportes" style="object-fit:cover">
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mx-auto mb-4 w-25">
                        <a href="<?php echo url("reportes") ?>" class="btn btn-primary">
                            <i class="fa-solid fa-circle-arrow-left"></i>
                            Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php endif; ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('.slider-image').slick({
            dots: true,
            infinite: true,
            speed: 500,
            fade: true,
            cssEase: 'linear'
        });
    });
</script>