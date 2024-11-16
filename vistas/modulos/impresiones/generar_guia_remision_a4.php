<?php

include "../../../ajax/rutas.ajax.php";
$ruta = Rutas::RutaProyecto();

if (isset($_GET["id_guia"])) {
    $id_guia = $_GET["id_guia"];
}
?>


<main>
    <div class="container-fluid vh-100">
        <iframe src="<?php echo  $ruta."ajax/ventas.ajax.php?accion=" . "generar_guia_remision_a4" . "&id_guia=" . $id_guia ?>" frameborder="0" height="100%" width="100%">
        </iframe>
    </div>
</main>