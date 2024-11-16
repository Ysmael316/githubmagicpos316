<?php
$id_producto = $_POST['id_producto'];
$accion = $_POST['accion'];

?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 fw-bold"><?php echo ($accion == 'aumentar_stock' ? 'Aumentar Stock' : 'Disminuir Stock') ?> </h2>
            </div><!-- /.col -->
            <div class="col-sm-6 d-none d-md-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="./">Inicio</a></li>
                    <li class="breadcrumb-item active">Inventario / <?php echo $accion == 'aumentar_stock' ? 'Aumentar stock' : 'Disminuir stock' ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="content">

    <div class="container-fluid">

        <div class="card card-gray shadow mt-3">

            <div class="card-body px-3 py-3" style="position: relative;">

                <span class="titulo-fieldset px-2 py-1">DATOS DEL PRODUCTO </span>

                <div class="row my-1">

                    <div class="col-12 mb-3">
                        <label for="" class="form-label text-primary d-block">Codigo: <span id="stock_codigoProducto" class="text-secondary"></span></label>
                        <label for="" class="form-label text-primary d-block">Producto: <span id="stock_Producto" class="text-secondary"></span></label>
                        <label for="" class="form-label text-primary d-block">Stock actual: <span id="stock_Stock" class="text-secondary"></span></label>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-2">
                            <label class="" for="iptStockSumar">
                                <i class="fas fa-plus-circle fs-6"></i> <span class="small" id="titulo_modal_label">Agregar al Stock</span>
                            </label>
                            <input type="number" min="0" class="form-control form-control-sm" id="iptStockSumar" placeholder="Ingrese cantidad a agregar al Stock">
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="" class="form-label text-danger">Nuevo Stock: <span id="stock_NuevoStock" class="text-secondary"></span></label><br>
                    </div>

                    <!-- BOTONERA -->
                    <div class="col-12 text-center mt-3">
                        <a class="btn btn-sm btn-danger  fw-bold " id="btnCancelarRegistro" style="position: relative; width: 160px;" onclick="fnc_RegresarListadoProductos();">
                            <span class="text-button">REGRESAR</span>
                            <span class="btn fw-bold icon-btn-danger ">
                                <i class="fas fa-undo-alt fs-5 text-white m-0 p-0"></i>
                            </span>
                        </a>

                        <a class="btn btn-sm btn-success  fw-bold " id="btnGuardarProducto" style="position: relative; width: 160px;" onclick="fnc_ActualizarStock();">
                            <span class="text-button">GUARDAR</span>
                            <span class="btn fw-bold icon-btn-success ">
                                <i class="fas fa-save fs-5 text-white m-0 p-0"></i>
                            </span>
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </div>

</div>


<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    $(document).ready(function() {

        // CALCULAR NUEVO STOCK (AUMENTAR O DISMINUIR)
        $("#iptStockSumar").keyup(function() {
            fnc_CalcularNuevoStock();
        })

        fnc_CargarDatosProducto(<?php echo $id_producto; ?>, '<?php echo $accion; ?>')

    })

    function fnc_CargarDatosProducto($id_producto, $accion) {

        var formData = new FormData();
        formData.append('accion', 'obtener_producto_x_id')
        formData.append('id_producto', $id_producto);

        $producto = SolicitudAjax('ajax/productos.ajax.php', 'POST', formData);

        $("#titulo_modal_stock").html($accion == 'aumentar_stock' ? 'Aumentar stock' : 'Disminuir stock');
        $("#titulo_modal_label").html($accion == 'aumentar_stock' ? 'Agregar al stock' : 'Disminuir al stock');
        $("#iptStockSumar").attr("placeholder", $accion == 'aumentar_stock' ? "Ingrese cantidad a agregar al Stock" : "Ingrese cantidad a disminuir al Stock"); //CAMBIAR EL PLACEHOLDER 

        $("#stock_codigoProducto").html($producto.codigo_producto) //CODIGO DEL PRODUCTO DEL DATATABLE
        $("#stock_Producto").html($producto.descripcion) //NOMBRE DEL PRODUCTO DEL DATATABLE
        $("#stock_Stock").html($producto.stock)
    }

    function fnc_CalcularNuevoStock() {

        if ('<?php echo $accion; ?>' == 'aumentar_stock') {

            if ($("#iptStockSumar").val() != "" && $("#iptStockSumar").val() > 0) {

                var stockActual = parseFloat($("#stock_Stock").html());
                var cantidadAgregar = parseFloat($("#iptStockSumar").val());

                $("#stock_NuevoStock").html(stockActual + cantidadAgregar);

            } else {

                mensajeToast('error', 'Ingrese un valor mayor a 0');

                $("#iptStockSumar").val("")
                $("#stock_NuevoStock").html(parseFloat($("#stock_Stock").html()));

            }

        } else {

            if ($("#iptStockSumar").val() != "" && $("#iptStockSumar").val() > 0) {

                var stockActual = parseFloat($("#stock_Stock").html());
                var cantidadAgregar = parseFloat($("#iptStockSumar").val());

                $("#stock_NuevoStock").html(stockActual - cantidadAgregar);

                if (parseInt($("#stock_NuevoStock").html()) < 0) {

                    mensajeToast('error', 'La cantidad a disminuir no puede ser mayor al stock actual (Nuevo stock < 0)');

                    $("#iptStockSumar").val("");
                    $("#iptStockSumar").focus();
                    $("#stock_NuevoStock").html(parseFloat($("#stock_Stock").html()));
                }
            } else {

                mensajeToast('error', 'Ingrese un valor mayor a 0');

                $("#iptStockSumar").val("")
                $("#stock_NuevoStock").html(parseFloat($("#stock_Stock").html()));
            }
        }
    }

    function fnc_ActualizarStock() {

        if ($("#iptStockSumar").val() != "" && $("#iptStockSumar").val() > 0) {

            var nuevoStock = parseFloat($("#stock_NuevoStock").html()),
                codigo_producto = $("#stock_codigoProducto").html();

            var datos = new FormData();

            datos.append('accion', '<?php echo $accion; ?>');
            datos.append('nuevoStock', nuevoStock);
            datos.append('codigo_producto', codigo_producto);

            //Solicitud para verificar el Stock del Producto
            response = SolicitudAjax("ajax/productos.ajax.php", "POST", datos);

            if (response["tipo_msj"] == "success") {
                $("#stock_NuevoStock").html("");
                $("#iptStockSumar").val("");

                $("#mdlGestionarStock").modal('hide');

                $("#tbl_productos").DataTable().ajax.reload();

                Swal.fire({
                    position: 'top-center',
                    icon: response["tipo_msj"],
                    title: response["msj"],
                    showConfirmButton: true
                })
                
                // notie.alert({ type: response["tipo_msj"], 
                //             text: response["msj"], 
                //             stay: false ,
                //             position: 'bottom',}) 

                fnc_LimpiarControles();
                fnc_RegresarListadoProductos();
                // mensajeToast(response["tipo_msj"], response["msj"])
            }


        } else {
            mensajeToast('error', 'Debe ingresar la cantidad a aumentar');
            return false;
        }
    }


    function fnc_LimpiarControles() {
        $("#iptStockSumar").val('');
    }

    function fnc_RegresarListadoProductos() {
        fnc_LimpiarControles();
        // CargarContenido('vistas/modulos/inventario/productos/productos.php', 'content-wrapper');

        $(".content-wrapper").fadeOut('slow', function() {
            $(".content-wrapper").load('vistas/modulos/inventario/productos/productos.php',
                function() {
                    $(".content-wrapper").fadeIn(60);

                },
            );
        })
    }
</script>