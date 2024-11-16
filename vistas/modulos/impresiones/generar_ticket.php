<?php

include "../../../ajax/rutas.ajax.php";
$ruta = Rutas::RutaProyecto();


if(isset($_GET["id_venta"])){
    $id_venta = $_GET["id_venta"];
    
}

?>

<main>
    <div class="container-fluid vh-100">
        <iframe src="<?php echo $ruta."ajax/ventas.ajax.php?accion=". "generar_ticket" . "&id_venta=".$id_venta ?>" frameborder="0" height="100%" width="100%">
        </iframe>
    </div>
</main>