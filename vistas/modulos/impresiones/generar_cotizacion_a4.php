<?php

include "../../../ajax/rutas.ajax.php";
$ruta = Rutas::RutaProyecto();

if (isset($_GET["id_cotizacion"])) {
    $id_cotizacion = $_GET["id_cotizacion"];
}
?>


<main>
    <div class="container-fluid vh-100">
        <iframe src="<?php echo $ruta."ajax/cotizaciones.ajax.php?accion=" . "generar_cotizacion_a4" . "&id_cotizacion=" . $id_cotizacion ?>" frameborder="0" height="100%" width="100%">
        </iframe>
    </div>
</main>