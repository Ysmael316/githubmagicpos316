<?php

include "../../../ajax/rutas.ajax.php";
$ruta = Rutas::RutaProyecto();

if(isset($_GET["id_arqueo_caja"])){
    $id_arqueo_caja = $_GET["id_arqueo_caja"];    
}

if(isset($_GET["id_usuario_arqueo"])){
    $id_usuario_arqueo = $_GET["id_usuario_arqueo"];    
}else{
    $id_usuario_arqueo = 0;
}

?>

<main>
    <div class="container-fluid vh-100">
        <iframe 
        src="<?php echo  $ruta."ajax/arqueo_caja.ajax.php?accion=". "generar_ticket_arqueo" . "&id_arqueo_caja=".$id_arqueo_caja . "&id_usuario_arqueo=".$id_usuario_arqueo ?>" 
        frameborder="0" height="100%" width="100%">

        </iframe>
    </div>
</main>