<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 fw-bold">INVENTARIO</h2>
            </div><!-- /.col -->
            <div class="col-sm-6 d-none d-md-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item active">Inventario</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content mb-3">

    <div class="container-fluid">

        <!-- row para criterios de busqueda -->
        <div class="row">

            <div class="col-lg-12">

                <div class="card card-gray shadow mt-3">

                    <div class="card-body px-3 py-3" style="position: relative;">

                        <span class="titulo-fieldset px-3 py-1">CRITERIOS DE BÚSQUEDA </span>

                        <div class="row my-2">

                            <div class="col-12 col-lg-3 mb-2">

                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-barcode mr-1 my-text-color"></i>Código del Producto</label>
                                <input data-index="3" type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="iptCodigoBarras" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>

                            <div class="col-12 col-lg-3 mb-2">
                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-layer-group mr-1 my-text-color"></i> Categorías</label>
                                <select data-index="4" class="form-select" id="id_categoria_busqueda" aria-label="Floating label select example" required>
                                </select>
                            </div>

                            <div class="col-12 col-lg-6 mb-2">
                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-gifts mr-1 my-text-color"></i>Producto</label>
                                <input data-index="6" type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="iptProducto" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>

                            <div class="col-12 col-lg-3 mb-2">
                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-dollar-sign mr-1 my-text-color"></i> P. Venta Desde</label>
                                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="iptPrecioVentaDesde" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>

                            <div class="col-12 col-lg-3 mb-2">
                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-dollar-sign mr-1 my-text-color"></i> P. Venta Hasta</label>
                                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="iptPrecioVentaHasta" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>

                        </div>

                    </div>

                </div>


            </div>

        </div>

        <div class="card card-gray shadow mt-3">

            <div class="card-body px-3 py-3" style="position: relative;">

                <span class="titulo-fieldset px-3 py-1">LISTADO DE PRODUCTOS </span>

                <!-- row para listado de productos/inventario -->
                <div class="row my-2">

                    <div class="col-lg-12">

                        <table id="tbl_productos" class="table w-100 shadow border responsive border-secondary display">
                            <thead class="bg-main">
                                <tr style="font-size: 15px;">
                                    <th> </th> <!-- 0 -->
                                    <th class="text-cetner">Op.</th> <!-- 1 -->
                                    <th>ID</th> <!-- 2 -->
                                    <th>Codigo</th> <!-- 3 -->

                                    <th>Id Categoria</th> <!-- 4 -->

                                    <th>Categoría</th> <!-- 5 -->

                                    <th>Producto</th> <!-- 6 -->
                                    <th>Imagen</th> <!-- 4 -->
                                    <th>Id Tipo Afec. IGV</th> <!-- 7 -->
                                    <th>Tipo Afec. IGV</th> <!-- 8 -->

                                    <th>Id Unidad Medida</th> <!-- 9 -->
                                    <th>Unidad Medida</th> <!-- 10 -->

                                    <th>Costo Unit.</th> <!-- 11 -->

                                    <th>Precio C/IGV</th> <!-- 12 -->
                                    <th>Precio S/IGV</th> <!-- 13 -->
                                    <th>Precio Mayor C/IGV</th> <!-- 14 -->
                                    <th>Precio Mayor S/IGV</th> <!-- 15 -->
                                    <th>Precio Oferta C/IGV</th> <!-- 16 -->
                                    <th>Precio Oferta S/IGV</th> <!-- 17 -->

                                    <th>Stock</th> <!-- 18 -->
                                    <th>Min. Stock</th> <!-- 19 -->

                                    <th>Ventas</th> <!-- 20 -->

                                    <th>Costo Total</th> <!-- 21 -->

                                    <th>Fecha Creación</th> <!-- 22 -->
                                    <th>Fecha Actualización</th> <!-- 23 -->

                                    <th>Estado</th> <!-- 24 -->
                                </tr>
                            </thead>
                            <tbody class="text-small">
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>



    </div><!-- /.container-fluid -->

</div>
<!-- /.content -->

<div class="loading">Loading</div>

<script>
    var accion;
    var operacion_stock = ''; // permitar definir si vamos a sumar o restar al stock (1: sumar, 2:restar)

    $(document).ready(function() {
        
        fnc_MostrarLoader()

        fnc_InicializarFormulario();

        /*===================================================================*/
        // C R I T E R I O S   D E   B U S Q U E D A  (CODIGO, CATEGORIA Y PRODUCTO)
        /*===================================================================*/
        // BUSQUEDA POR CODIGO DE BARRAS
        $("#iptCodigoBarras").keyup(function() {
            $("#tbl_productos").DataTable().column($(this).data('index')).search(this.value).draw();
        })

        // BUSQUEDA POR CATEGORIAS
        $("#id_categoria_busqueda").change(function() {

            if (this.value != 0) {
                $('#tbl_productos').DataTable().column($(this).data('index')).search('^' + this.value + '$', true, false).draw();
            } else {
                $('#tbl_productos').DataTable().column($(this).data('index')).search("").draw();
            }

        })

        // BUSQUEDA POR DESCRIPCION DE PRODUCTO
        $("#iptProducto").keyup(function() {
            $("#tbl_productos").DataTable().column($(this).data('index')).search(this.value).draw();
        })

        // BUSQUEDA POR RANGO DE PRECIOS
        $("#iptPrecioVentaDesde, #iptPrecioVentaHasta").keyup(function() {
            $("#tbl_productos").DataTable().draw();
        })

        $.fn.dataTable.ext.search.push(

            function(settings, data, dataIndex) {

                var precioDesde = parseFloat($("#iptPrecioVentaDesde").val());
                var precioHasta = parseFloat($("#iptPrecioVentaHasta").val());

                var col_venta = parseFloat(data[13]);

                if ((isNaN(precioDesde) && isNaN(precioHasta)) ||
                    (isNaN(precioDesde) && col_venta <= precioHasta) ||
                    (precioDesde <= col_venta && isNaN(precioHasta)) ||
                    (precioDesde <= col_venta && col_venta <= precioHasta)) {
                    return true;
                }

                return false;
            }
        )

        // LIMPIAR CRITERIOS DE BUSQUEDA
        $("#btnLimpiarBusqueda").on('click', function() {

            $("#iptCodigoBarras").val('')
            CargarSelect(null, $("#id_categoria_busqueda"), "--Todas las categorías--", "ajax/categorias.ajax.php", 'obtener_categorias', null, 1);
            $("#iptProducto").val('')
            $("#iptPrecioVentaDesde").val('')
            $("#iptPrecioVentaHasta").val('')

            $("#tbl_productos").DataTable().search('').columns().search('').draw();
        })

        // LIMPIAR INPUT DE INGRESO DE STOCK AL CERRAR LA VENTANA MODAL
        // $("#btnCancelarRegistroStock, #btnCerrarModalStock").on('click', function() {
        //     $("#iptStockSumar").val("")
        // })

        /*===================================================================*/
        // R E G I S T R O   Y   A C T U A L I Z A C I O N   D E   P R O D U C T O S
        /*===================================================================*/
        // $("#btnGuardarProducto").on('click', function() {
        //     fnc_registrarProducto();
        // });

        // $('#tbl_productos tbody').on('click', '.btnEditarProducto', function() {
        //     // fnc_ModalActualizarProducto($(this));

        // })

        // $("#btnCancelarRegistro, #btnCerrarModal").on('click', function() {
        //     fnc_InicializarFormulario();
        // })




        /* ======================================================================================
        A U M E N T A R /  D I S M I N U I R   S T O C K   A L   P R O D U C T O
        =========================================================================================*/
        // $('#tbl_productos tbody').on('click', '.btnAumentarStock', function() {
        //     // fnc_ModalAumentarStock($("#tbl_productos").DataTable().row($(this).parents('tr')).data());
        //     $(".content-wrapper").load('vistas/modulos/inventario/productos/modulos/editar_producto.php', {
        //         id_producto: $id_producto
        //     });
        // })

        // $('#tbl_productos tbody').on('click', '.btnDisminuirStock', function() {
        //     fnc_ModalDisminuirStock($("#tbl_productos").DataTable().row($(this).parents('tr')).data());
        // })

        // CALCULAR NUEVO STOCK (AUMENTAR O DISMINUIR)
        // $("#iptStockSumar").keyup(function() {
        //     fnc_CalcularNuevoStock();
        // })

        // $("#btnGuardarNuevorStock").on('click', function() {
        //     fnc_ActualizarStock();
        // })

        /* ======================================================================================
        E L I M I N A R   P R O D U C T O
        =========================================================================================*/
        // DESACTIVAR UN PRODUCTO
        $('#tbl_productos tbody').on('click', '.btnDesactivarProducto', function() {
            fnc_DesactivarProducto($('#tbl_productos').DataTable().row($(this).parents('tr')).data());
        })

        // ACTIVAR UN PRODUCTO
        $('#tbl_productos tbody').on('click', '.btnActivarProducto', function() {
            fnc_ActivarProducto($('#tbl_productos').DataTable().row($(this).parents('tr')).data());
        })

        fnc_OcultarLoader();

    });

    function fnc_InicializarFormulario() {

        fnc_cargarSelectCategorias();
        fnc_CargarDataTableInventario();

        // // $("#mdlGestionarProducto").modal('hide');

        // $("#codigo_producto").prop('readonly', false);

        // $("#codigo_producto").val('');
        // $("#id_categoria").val('');
        // $("#descripcion").val('');
        // $("#id_tipo_afectacion_igv").val('');
        // $("#impuesto").val('');
        // $("#id_unidad_medida").val('');
        // $("#precio_unitario_con_igv").val('');
        // $("#precio_unitario_sin_igv").val('');
        // $("#precio_unitario_mayor_con_igv").val('');
        // $("#precio_unitario_mayor_sin_igv").val('');
        // $("#precio_unitario_oferta_con_igv").val('');
        // $("#precio_unitario_oferta_sin_igv").val('');
        // $("#minimo_stock").val('');

        // $("#iptImagen").val('');
        // $("#previewImg").attr("src", "vistas/assets/imagenes/no_image.jpg");

        // fnc_cargarSelectCategorias();
    }



    /*===================================================================*/
    // C O N S U L T A   D E   P R O D U C T O S  (DATATABLE)
    /*===================================================================*/
    function fnc_CargarDataTableInventario() {

        if ($.fn.DataTable.isDataTable('#tbl_productos')) {
            $('#tbl_productos').DataTable().destroy();
            $('#tbl_productos tbody').empty();
        }

        // new DataTable('#tbl_productos', {
        //     layout: {
        //         topStart: {
        //             buttons: ['colvis']
        //         }
        //     }
        // });

        $("#tbl_productos").DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    text: '<i class="fas fa-sync-alt"></i>',
                    className: 'bg-secondary',
                    action: function(e, dt, node, config) {
                        fnc_CargarDataTableInventario();
                    }
                },
                {
                    text: 'Agregar Producto',
                    className: 'addNewRecord',
                    action: function(e, dt, node, config) {
                        CargarContenido('vistas/modulos/inventario/productos/modulos/registrar_producto.php', 'content-wrapper')
                    }
                },
                {
                    extend: 'excel',
                    title: function() {
                        var printTitle = 'LISTADO DE PRODUCTOS';
                        return printTitle
                    }
                },
                {
                    extend: 'print',
                    title: function() {
                        var printTitle = 'LISTADO DE PRODUCTOS';
                        return printTitle
                    }
                }, 'pageLength'
            ],
            // pageLength: [5, 10, 15, 30, 50, 100],
            pageLength: 10,
            ajax: {
                url: "ajax/productos.ajax.php",
                dataSrc: '',
                type: "POST",
                data: {
                    'accion': 'listar_productos' //1: LISTAR PRODUCTOS
                },
            },
            autoWidth: false,
            columnDefs: [{
                    className: 'control',
                    orderable: false,
                    targets: 0
                },
                {
                    "className": "dt-center",
                    "targets": "_all"
                },
                {
                    targets: [4, 8, 10],
                    visible: false
                },
                {
                    targets: 18,
                    createdCell: function(td, cellData, rowData, row, col) {
                        if (parseFloat(rowData['stock']) <= parseFloat(rowData['minimo_stock'])) {
                            $(td).parent().css('background', '#F2D7D5')
                            $(td).parent().css('color', 'black')
                        }
                    }
                },
                {
                    targets: 7,
                    createdCell: function(td, cellData, rowData, row, col) {
                        if (rowData['imagen'] != 'no_image.jpg') {

                            $(td).html('<img src="vistas/assets/imagenes/productos/' + rowData['imagen'] + '" class="zoom rounded-pill border text-center border-secondary" style="object-fit: cover; width: 40px; height: 40px; transition: transform .5s;overflow:hidden; z-index:100000" alt="">')
                            $(td).css('overflow', 'hidden')
                        } else {
                            $(td).html('<img src="vistas/assets/imagenes/no_image.jpg" class="rounded-pill border text-center border-secondary" style="object-fit: cover; width: 40px; height: 40px;" alt="">')
                        }

                    }
                },
                {
                    targets: 1,
                    orderable: false,
                    createdCell: function(td, cellData, rowData, row, col) {

                        $(td).html(`
                                    <div class="btn-group" >
                                        <button class="btn btn-sm dropdown-toggle p-0 m-0 my-text-color fs-5" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-list-alt"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item btnEditarProducto" style='cursor:pointer;' onclick="fnc_EditarProducto('` + rowData["id"] + `');"><i class='fas fa-pencil-alt fs-6 text-primary mr-2'></i> <span class='my-color'>Editar</span>
                                            </a>
                                        </div>
                                    </div>`)

                        if (parseInt(rowData['costo_unitario']) > 0) {
                            $(td).html(`
                                    <div class="btn-group" >
                                        <button class="btn btn-sm dropdown-toggle p-0 m-0 my-text-color fs-5" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-list-alt"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item btnEditarProducto" style='cursor:pointer;' onclick="fnc_EditarProducto('` + rowData["id"] + `');"><i class='fas fa-pencil-alt fs-6 text-primary mr-2'></i> <span class='my-color'>Editar</span></a>                                            

                                            <a class="dropdown-item btnAumentarStock" style='cursor:pointer;' onclick="fnc_ActualizarStock('` + rowData["id"] + `','aumentar_stock');"><i class='fas fa-plus-circle fs-6 mr-2 text-success'></i> <span class='my-color'>Aumentar Stock</span></a>                                            

                                            <a class="dropdown-item btnDisminuirStock" style='cursor:pointer;' onclick="fnc_ActualizarStock('` + rowData["id"] + `','disminuir_stock');"><i class='fas fa-minus-circle fs-6 mr-2 text-warning'></i> <span class='my-color'>Disminuir Stock</span></a>
                                        </div>
                                    </div>`)
                        }

                        if (rowData['estado'] == 'INACTIVO') {
                            $(td).html(`
                                    <div class="btn-group" >
                                        <button class="btn btn-sm dropdown-toggle p-0 m-0 my-text-color fs-5" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-list-alt"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item btnEditarProducto" style='cursor:pointer;' onclick="fnc_EditarProducto('` + rowData["id"] + `');"><i class='fas fa-pencil-alt fs-6 text-primary mr-2'></i> <span class='my-color'>Editar</span></a>                                            
                                            <a class="dropdown-item btnAumentarStock" style='cursor:pointer;' onclick="fnc_ActualizarStock('` + rowData["id"] + `','aumentar_stock');"><i class='fas fa-plus-circle fs-6 mr-2 text-success'></i> <span class='my-color'>Aumentar Stock</span></a>                                            
                                            <a class="dropdown-item btnDisminuirStock" style='cursor:pointer;' onclick="fnc_ActualizarStock('` + rowData["id"] + `','disminuir_stock');"><i class='fas fa-minus-circle fs-6 mr-2 text-warning'></i> <span class='my-color'>Disminuir Stock</span></a>                                            
                                            <a class="dropdown-item btnActivarProducto" style='cursor:pointer;'><i class='fas fa-toggle-off fs-6 text-danger mr-2'> </i> <span class='my-color'>Activar</span></a>
                                        </div>
                                    </div>`)
                        } else {
                            $(td).html(`
                                    <div class="btn-group" >
                                        <button class="btn btn-sm dropdown-toggle p-0 m-0 my-text-color fs-5" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-list-alt"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item btnEditarProducto" style='cursor:pointer;' onclick="fnc_EditarProducto('` + rowData["id"] + `');"><i class='fas fa-pencil-alt fs-6 text-primary mr-2'></i> <span class='my-color'>Editar</span></a>                                            
                                            <a class="dropdown-item btnAumentarStock" style='cursor:pointer;' onclick="fnc_ActualizarStock('` + rowData["id"] + `','aumentar_stock');"><i class='fas fa-plus-circle fs-6 mr-2 text-success'></i> <span class='my-color'>Aumentar Stock</span></a>                                            
                                            <a class="dropdown-item btnDisminuirStock" style='cursor:pointer;' onclick="fnc_ActualizarStock('` + rowData["id"] + `','disminuir_stock');"><i class='fas fa-minus-circle fs-6 mr-2 text-warning'></i> <span class='my-color'>Disminuir Stock</span></a>                                            
                                            <a class="dropdown-item btnDesactivarProducto" style='cursor:pointer;'><i class='fas fa-toggle-on fs-6 text-success mr-2'> </i> <span class='my-color'>Desactivar</span></a>
                                        </div>
                                    </div>`)
                        }

                    }
                }

            ],
            // layout: {
            //     topStart: {
            //         buttons: [{
            //             extend: 'colvis',
            //             columns: ':not(.noVis)',
            //             popoverTitle: 'Column visibility selector'
            //         }]
            //     }
            // },
            // scrollX: true,
            // scrollY: "50vh",
            language: {
                // url: "ajax/language/spanish.json"
                url: "ajax/language/spanish.json"
            }

        }, {
            layout: {
                topStart: {
                    buttons: ['colvis']
                }
            }
        });

    }


    /*===================================================================*/
    // R E G I S T R O   Y   A C T U A L I Z A C I O N   D E   P R O D U C T O S
    /*===================================================================*/





    /* ======================================================================================
    E L I M I N A R   P R O D U C T O
    =========================================================================================*/
    function fnc_eliminarProducto(codigo_producto) {

        Swal.fire({
            title: 'Está seguro de eliminar el producto?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo eliminarlo!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {
                var formData = new FormData();

                formData.append('accion', 'eliminar_producto')
                formData.append('codigo_producto', codigo_producto);

                response = SolicitudAjax("ajax/productos.ajax.php", "POST", formData);
                mensajeToast(response["tipo_msj"], response["msj"]);
                $("#tbl_productos").DataTable().ajax.reload();
            }

        });


    }

    function fnc_DesactivarProducto(data) {

        var codigo_producto = data['codigo_producto'];
        Swal.fire({
            title: 'Está seguro de desactivar el Producto: ' + data['descripcion_producto'] + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar!',
            cancelButtonText: 'Cancelar!',
        }).then((result) => {
            if (result.isConfirmed) {

                if (result.isConfirmed) {

                    var datos = new FormData();

                    datos.append('accion', 'desactivar_producto');
                    datos.append('codigo_producto', codigo_producto);

                    response = SolicitudAjax('ajax/productos.ajax.php', 'POST', datos)

                    mensajeToast(response["tipo_msj"], response["msj"])
                    $('#tbl_productos').DataTable().ajax.reload(null, false);

                }

            }
        })
    }

    function fnc_ActivarProducto(data) {

        var codigo_producto = data['codigo_producto'];

        Swal.fire({
            title: 'Está seguro de activar el Producto: ' + data['descripcion_producto'] + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar!',
            cancelButtonText: 'Cancelar!',
        }).then((result) => {
            if (result.isConfirmed) {

                if (result.isConfirmed) {

                    var datos = new FormData();

                    datos.append('accion', 'activar_producto');
                    datos.append('codigo_producto', codigo_producto);

                    response = SolicitudAjax('ajax/productos.ajax.php', 'POST', datos)

                    mensajeToast(response["tipo_msj"], response["msj"])
                    $('#tbl_productos').DataTable().ajax.reload(null, false);

                }

            }
        })
    }


    /* ======================================================================================
    A U M E N T A R /  D I S M I N U I R   S T O C K   A L   P R O D U C T O
    =========================================================================================*/
    function fnc_ModalAumentarStock(data) {

        operacion_stock = 'aumentar_stock'; //sumar stock
        accion = 3;

        $("#mdlGestionarStock").modal('show'); //MOSTRAR VENTANA MODAL

        $("#titulo_modal_stock").html('Aumentar Stock'); // CAMBIAR EL TITULO DE LA VENTANA MODAL
        $("#titulo_modal_label").html('Agregar al Stock'); // CAMBIAR EL TEXTO DEL LABEL DEL INPUT PARA INGRESO DE STOCK
        $("#iptStockSumar").attr("placeholder", "Ingrese cantidad a agregar al Stock"); //CAMBIAR EL PLACEHOLDER 

        $("#stock_codigoProducto").html(data['codigo_producto']) //CODIGO DEL PRODUCTO DEL DATATABLE
        $("#stock_Producto").html(data['producto']) //NOMBRE DEL PRODUCTO DEL DATATABLE
        $("#stock_Stock").html(data['stock']) //STOCK ACTUAL DEL PRODUCTO DEL DATATABLE

        $("#stock_NuevoStock").html(parseFloat($("#stock_Stock").html()));
    }

    function fnc_ModalDisminuirStock(data) {

        operacion_stock = 'disminuir_stock'; //restar stock
        accion = 3;
        $("#mdlGestionarStock").modal('show'); //MOSTRAR VENTANA MODAL

        $("#titulo_modal_stock").html('Disminuir Stock'); // CAMBIAR EL TITULO DE LA VENTANA MODAL
        $("#titulo_modal_label").html('Disminuir al Stock'); // CAMBIAR EL TEXTO DEL LABEL DEL INPUT PARA INGRESO DE STOCK
        $("#iptStockSumar").attr("placeholder", "Ingrese cantidad a disminuir al Stock"); //CAMBIAR EL PLACEHOLDER 

        $("#stock_codigoProducto").html(data['codigo_producto']) //CODIGO DEL PRODUCTO DEL DATATABLE
        $("#stock_Producto").html(data['producto']) //NOMBRE DEL PRODUCTO DEL DATATABLE
        $("#stock_Stock").html(data['stock']) //STOCK ACTUAL DEL PRODUCTO DEL DATATABLE

        $("#stock_NuevoStock").html(parseFloat($("#stock_Stock").html()));

    }

    function fnc_CalcularNuevoStock() {
        if (operacion_stock == 'aumentar_stock') {

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

    // CALCULA LA UTILIDAD
    function calcularUtilidad() {

        var iptPrecioCompraReg = $("#iptPrecioCompraReg").val();
        var iptPrecioVentaReg = $("#iptPrecioVentaReg").val();
        var Utilidad = iptPrecioVentaReg - iptPrecioCompraReg;

    }

    // function fnc_ActualizarStock() {

    //     if ($("#iptStockSumar").val() != "" && $("#iptStockSumar").val() > 0) {

    //         var nuevoStock = parseFloat($("#stock_NuevoStock").html()),
    //             codigo_producto = $("#stock_codigoProducto").html();

    //         var datos = new FormData();

    //         datos.append('accion', 'aumentar_disminuir_stock');
    //         datos.append('nuevoStock', nuevoStock);
    //         datos.append('codigo_producto', codigo_producto);
    //         datos.append('tipo_movimiento', operacion_stock);

    //         //Solicitud para verificar el Stock del Producto
    //         response = SolicitudAjax("ajax/productos.ajax.php", "POST", datos);

    //         if (response["tipo_msj"] == "success") {
    //             $("#stock_NuevoStock").html("");
    //             $("#iptStockSumar").val("");

    //             $("#mdlGestionarStock").modal('hide');

    //             $("#tbl_productos").DataTable().ajax.reload();
    //             mensajeToast(response["tipo_msj"], response["msj"])
    //         }


    //     } else {
    //         mensajeToast('error', 'Debe ingresar la cantidad a aumentar');
    //         return false;
    //     }
    // }

    /* ======================================================================================
    G E N E R A L E S
    =========================================================================================*/
    // LIMPIAR INPUTS DEL FORMULARIO DE REGISTRO

    // CARGAR SELECT DE CATEGORIAS
    function fnc_cargarSelectCategorias() {
        CargarSelect(null, $("#id_categoria_busqueda"), "--Todas las categorías--", "ajax/categorias.ajax.php", 'obtener_categorias', null, 1);
    }

    function dropmenuPostion() {
        // hold onto the drop down menu                                             
        var dropdownMenu;

        $(window).on('show.bs.dropdown', function(e) {
            // grab the menu
            dropdownMenu = $(e.target).find('.dropdown-menu');
            // detach it and append it to the body
            $('body').append(dropdownMenu.detach());

            // grab the new offset position
            var eOffset = $(e.target).offset();

            // make sure to place it where it would normally go (this
            // could be
            // improved)
            dropdownMenu.css({
                'display': 'block',
                'top': eOffset.top + $(e.target).outerHeight(),
                'left': eOffset.left,
                'min-width': '80px'
            });
        });

        // and when you hide it, reattach the drop down, and hide it
        // normally
        $(window).on('hide.bs.dropdown', function(e) {
            $(e.target).append(dropdownMenu.detach());
            dropdownMenu.hide();
        });

        // // and when you show it, move it to the body                                     
        // $(window).on('show.bs.dropdown', function(e) {

        //     // grab the menu        
        //     dropdownMenu = $(e.target).find('.dropdown-menu');

        //     // detach it and append it to the body
        //     $('body').append(dropdownMenu.detach());

        //     // grab the new offset position
        //     var eOffset = $(e.target).offset();

        //     // make sure to place it where it would normally go (this could be improved)
        //     dropdownMenu.css({
        //         'display': 'block',
        //         'top': eOffset.top + $(e.target).outerHeight(),
        //         'left': eOffset.left - 50
        //     });
        // });

        // // and when you hide it, reattach the drop down, and hide it normally                                                   
        // $(window).on('hide.bs.dropdown', function(e) {
        //     $(e.target).append(dropdownMenu.detach());
        //     dropdownMenu.hide();
        // });
    }

    /* ======================================================================================
    IR A EDITAR PRODUCTO
    =========================================================================================*/
    function fnc_EditarProducto($id_producto) {

        $(".content-wrapper").fadeOut('slow', function() {
            $(".content-wrapper").load('vistas/modulos/inventario/productos/modulos/editar_producto.php', {
                    id_producto: $id_producto
                },
                function() {
                    $(".content-wrapper").fadeIn(60);

                },
            );
        })
    }

    /* ======================================================================================
    IR A ACTUALIZAR STOCK
    =========================================================================================*/
    function fnc_ActualizarStock($id_producto, $accion) {
        // $(".content-wrapper").load('vistas/modulos/inventario/productos/modulos/actualizar_stock.php', {
        //     id_producto: $id_producto,
        //     accion: $accion
        // });

        $(".content-wrapper").fadeOut('slow', function() {
            $(".content-wrapper").load('vistas/modulos/inventario/productos/modulos/actualizar_stock.php', {
                    id_producto: $id_producto,
                    accion: $accion
                },
                function() {
                    $(".content-wrapper").fadeIn(60);

                },
            );
        })
    }
</script>