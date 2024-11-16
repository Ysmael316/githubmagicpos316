<?php

include "../../../ajax/rutas.ajax.php";
$ruta = Rutas::RutaProyecto();

if(isset($_GET["id_compra"])){
    $id_compra = $_GET["id_compra"];
    
}

?>

<main>
    <div class="container-fluid vh-100">
        <iframe src="<?php echo  $ruta."ajax/compras.ajax.php?accion=". "generar_pdf_compra" . "&id_compra=".$id_compra ?>" frameborder="0" height="100%" width="100%">
        </iframe>
    </div>
</main>