<?php
@$usuario = obtenerSesión("usuario");
$rol = ($usuario != null) ? $usuario["rol"] : "invitado";
?>
<main class="<?php echo ($usuario["rol"] == "admin") ? "container-admin" : "container-error" ?>">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
            <div class="text-center">
                <div class="container p-4 mt-5">
                    <img src="<?php asset("images", "error-404.svg")  ?>" alt="Imagen de error página no encontrada" width="600" height="600" class="img-fluid">
                </div>
                <h2 class="display-4">Página no encontrada</h2>
                <p class="lead">La página que buscas no existe o ha sido eliminada.</p>
                <?php if ($usuario != null) : ?>
                    <a href="<?php echo ($rol === "admin") ? url("dashboard") : url("inicio") ?>" class="btn btn-primary">Volver al inicio</a>
                <?php else : ?>
                    <a href="<?php echo url("") ?>" class="btn btn-primary">
                        <i class="fa-solid fa-circle-arrow-left"></i>
                        Volver al inicio
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>


<?php if (isset($mensaje)) : ?>
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: "ERROR",
                text: "<?php echo $mensaje ?>",
                icon: "error"
            }).then(() => {
                <?php if ($url != null) : ?>
                    window.location.href = "<?php echo url($url) ?>"
                <?php endif; ?>
            });
        })
    </script>
<?php
endif; ?>