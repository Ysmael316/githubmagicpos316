<?php

$menuUsuario = UsuarioModelo::mdlObtenerMenuUsuario($_SESSION["usuario"]->id_usuario);
$datosEmpresa = UsuarioModelo::mdlObtenerEmpresaPrincipal();
?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav w-100 d-flex justify-content-between ">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="./" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link fs-4 fw-bold text-success" href="https://bit.ly/contactametutorialesphperu" target="_blank">
                <i class="fab fa-whatsapp fs-4 fw-bold"></i>
                CONTÁCTAME
            </a>

        </li>


    </ul>

</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="./" class="brand-link">
        <img src="vistas/assets/dist/img/logos_empresas/<?php echo $datosEmpresa["logo"] ?? 'no_image.jpg' ?>" style="width: 35px;height: 35px;" id="logo_sistema" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo $datosEmpresa["nombre_comercial"] ?? 'SIN REGISTRAR' ?></span>
        <!-- <br>
        <p class="fs-6 text-center mt-2">
            Contacto: Luis Lozano Arica <br>
            Celular: +51932676811
        </p> -->
    </a>



    <!-- Sidebar -->
    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="vistas/assets/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <h6 class="text-warning"><?php echo strlen($_SESSION["usuario"]->nombre_usuario) > 10 ? "Hola, " . substr($_SESSION["usuario"]->nombre_usuario, 0, 10) . "..." : "Hola, " . $_SESSION["usuario"]->nombre_usuario ?></h6>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">

                <?php foreach ($menuUsuario as $menu) : ?>
                    <li class="nav-item <?php if ($menu->abrir_arbol == 1) : ?> <?php echo ' menu-is-opening menu-open'; ?> <?php endif; ?>">
                        <a style="cursor: pointer;" class="nav-link  <?php if ($menu->vista_inicio == 1) : ?>
                                                <?php echo 'active'; ?>
                                            <?php endif; ?>" <?php if (!empty($menu->vista)) : ?> onclick="CargarContenido('vistas/modulos/<?php echo $menu->vista; ?>','content-wrapper')" <?php endif; ?>>
                            <i class="nav-icon <?php echo $menu->icon_menu; ?>"></i>
                            <p>
                                <?php echo $menu->modulo ?>
                                <?php if (empty($menu->vista)) : ?>
                                    <i class="right fas fa-angle-left"></i>
                                <?php endif; ?>
                            </p>
                        </a>

                        <?php if (empty($menu->vista)) : ?>

                            <?php
                            $subMenuUsuario = UsuarioModelo::mdlObtenerSubMenuUsuario($menu->id, $_SESSION["usuario"]->id_usuario);
                            ?>

                            <ul class="nav nav-treeview">

                                <?php foreach ($subMenuUsuario as $subMenu) : ?>

                                    <li class="nav-item">
                                        <a style="cursor: pointer;" class="nav-link <?php if ($subMenu->vista_inicio == 1) : ?>
                                                <?php echo 'active '; ?>
                                            <?php endif; ?>" onclick="CargarContenido('vistas/modulos/<?php echo $subMenu->vista ?>','content-wrapper')">
                                            <i class="<?php echo $subMenu->icon_menu; ?> nav-icon"></i>
                                            <p><?php echo $subMenu->modulo; ?></p>
                                        </a>
                                    </li>

                                <?php endforeach; ?>

                            </ul>

                        <?php endif; ?>

                    </li>
                <?php endforeach; ?>

                <li class="nav-item">
                    <a style="cursor: pointer;" class="nav-link" href="<?php echo $ruta ?>/?cerrar_sesion=1">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Cerrar Sesion
                        </p>
                    </a>
                </li>
                <!-- 
                <li class="nav-item">
                    <a style="cursor: pointer;" class="nav-link">
                        <p>
                            Contacto: Luis Lozano Arica <br>
                            Celular: +51932676811
                        </p>
                    </a>
                </li> -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>




<script>
    var itemProducto = 1;
    var $simbolo_moneda = '';
    $(document).ready(function() {

        $(".nav-link").on('click', function() {
            $(".nav-link").removeClass('active');
            $(this).addClass('active');
        })

        $(".nav-item").on('click', function() {

            if (!$(this).children().hasClass('nav-treeview')) {

                if ($(window).width() < 768) {
                    $(".sidebar-mini").removeClass('sidebar-open')
                    $(".sidebar-mini").addClass('sidebar-collapse')
                    $(".sidebar-mini").addClass('sidebar-closed')
                    $(this).children().addClass('active');
                }

            }
        })

        // var formData = new FormData();
        // formData.append("accion", "tipo_cambio");
        // $response = SolicitudAjax("ajax/apis/apis.ajax.php", 'POST', formData)
        // console.log("🚀 ~ $ ~ $response:", $response)

        // $("#tipo_cambio").html("TC Compra: " + $response["precioCompra"] + " | TC Venta: " + $response["precioVenta"])

    })
</script>