<?php

include "ajax/rutas.ajax.php";
$ruta = Rutas::RutaProyecto();

session_start();

if (isset($_GET["cerrar_sesion"]) && $_GET["cerrar_sesion"] == 1) {

    session_destroy();

    header("Location: " . $ruta );

    // echo '
    //         <script>
    //             window.location = "http://localhost/miposfacturador/";
    //         </script>        
    //     ';
}



?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Market Facturador</title>

    <link rel="shortcut icon" href="vistas/assets/dist/img/logos_empresas/mi_logo_tutorialesphperu.png" type="image/x-icon">

    <!-- ============================================================================================================= -->
    <!-- REQUIRED CSS -->
    <!-- ============================================================================================================= -->


    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="vistas/assets/plugins/fontawesome-free/css/all.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- iCheck for checkboxes and radio inputs -->
    <!-- <link rel="stylesheet" href="vistas/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="vistas/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <!-- Notie Alert -->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/notie/dist/notie.min.css">

    <link rel="stylesheet" href="vistas/assets/dist/css/toastr.min.css">

    <!-- Jquery CSS -->
    <link rel="stylesheet" href="vistas/assets/plugins/jquery-ui/css/jquery-ui.css">

    <!-- Bootstrap 5 -->
    <link href="vistas/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="vistas/assets/dist/css/select.dataTables.min.css" rel="stylesheet">

    <!-- JSTREE CSS -->
    <link rel="stylesheet" href="vistas/assets/dist/css/jstree.min.css" />

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="vistas/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">


    <!-- Select2 -->
    <link rel="stylesheet" href="vistas/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="vistas/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">


    <!-- ============================================================
    =ESTILOS PARA USO DE DATATABLES CSS
    ===============================================================-->
    <link rel="stylesheet" href="vistas/assets/dist/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="vistas/assets/dist/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="vistas/assets/dist/css/buttons.dataTables.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="vistas/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="vistas/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="vistas/assets/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="vistas/assets/dist/css/style_width_responsive.css">

    <!-- Estilos personzalidos -->
    <link rel="stylesheet" href="vistas/assets/dist/css/plantilla.css">

    <!-- ============================================================================================================= -->
    <!-- ============================================================================================================= -->
    <!-- ============================================================================================================= -->
    <!-- ============================================================================================================= -->
    <!-- REQUIRED SCRIPTS -->
    <!-- ============================================================================================================= -->
    <!-- ============================================================================================================= -->
    <!-- ============================================================================================================= -->
    <!-- ============================================================================================================= -->

    <!-- jQuery -->
    <script src="vistas/assets/plugins/jquery/jquery.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> -->

    <!-- Bootstrap 4 -->
    <script src="vistas/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- ChartJS -->
    <script src="vistas/assets/plugins/chart.js/Chart.min.js"></script>

    <script src="vistas/assets/dist/js/canvasjs.min.js"></script>

    <!-- InputMask -->
    <script src="vistas/assets/plugins/moment/moment.min.js"></script>
    <!-- <script src="vistas/assets/plugins/inputmask/jquery.inputmask.min.js"></script> -->

    <!-- SweetAlert2 -->
    <script src="vistas/assets/plugins/sweetalert2/sweetalert2.min.js"></script>

    <!-- Notie Alert -->
    <script src="https://unpkg.com/notie"></script>

    <script src="vistas/assets/dist/js/toastr.min.js"></script>

    <!-- jquery UI -->
    <script src="vistas/assets/plugins/jquery-ui/js/jquery-ui.js"></script>

    <!-- JS Bootstrap 5 -->
    <script src="vistas/assets/dist/js/bootstrap.bundle.min.js"></script>


    <!-- JSTREE JS -->
    <script src="vistas/assets/dist/js/jstree.min.js"></script>


    <script src="https://unpkg.com/quagga@0.12.1/dist/quagga.min.js"></script>

    <!-- date-range-picker -->
    <script src="vistas/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- ============================================================
    =LIBRERIAS PARA USO DE DATATABLES JS
    ===============================================================-->
    <script src="vistas/assets/dist/js/jquery.dataTables.min.js"></script>
    <script src="vistas/assets/dist/js/dataTables.responsive.min.js"></script>
    <script src="vistas/assets/dist/js/jquery.tabledit.min.js"></script>



    <!-- <script src="vistas/assets/dist/js/dataTables.fixedColumns.min.js"></script> -->


    <!-- ============================================================
    =LIBRERIAS PARA EXPORTAR A ARCHIVOS
    ===============================================================-->
    <script src="vistas/assets/dist/js/dataTables.buttons.min.js"></script>
    <script src="vistas/assets/dist/js/jszip.min.js"></script>
    <script src="vistas/assets/dist/js/buttons.html5.min.js"></script>
    <script src="vistas/assets/dist/js/buttons.print.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.min.js"></script>

    <!-- Bootstrap Switch -->
    <!-- <script src="vistas/assets/dist/js/bootstrap-switch"></script>
    <script src="vistas/assets/dist/js/bootstrap4-toggle.min.js"></script> -->

    <!-- Select2 -->
    <script src="vistas/assets/plugins/select2/js/select2.full.min.js"></script>

    <!-- Select2 -->
    <script src="vistas/assets/plugins/select2/js/select2.full.min.js"></script>

    <!-- AdminLTE App -->
    <script src="vistas/assets/dist/js/adminlte.min.js"></script>
    <script src="vistas/assets/dist/js/plantilla.js"></script>

    <script src="vistas/assets/dist/js/funciones_globales.js"></script>

    <!-- <script src="vistas/assets/dist/js/demo.js"></script> -->


</head>

<?php if (isset($_SESSION["usuario"])) : ?>

    <body class="hold-transition sidebar-mini layout-fixed">

        <div class="wrapper">

            <?php include "vistas/aside.php"; ?>

            <div class="content-wrapper">

                <?php include "vistas/modulos/" . $_SESSION["usuario"]->vista ?>

            </div>
        </div>

        <script>
            let $ruta = "<?php echo Rutas::RutaProyecto(); ?>";

            function CargarContenido(pagina_php, contenedor) {
                $("." + contenedor).fadeOut('slow', function() {
                    $("." + contenedor).load(pagina_php, function() {
                        $("." + contenedor).fadeIn(10);
                    });
                })

                // $("." + contenedor).load(pagina_php);

            }
        </script>

    </body>

<?php else : ?>

    <body>

        <?php include "vistas/modulos/seguridad/login.php"; ?>

    </body>

<?php endif; ?>

</html>