<!-- =============================================================================================================================
C O N T E N T   H E A D E R
===============================================================================================================================-->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 mb-2 fw-bold">CUADRES DE CAJA</h2>
            </div><!-- /.col -->
            <div class="col-sm-6 d-none d-md-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item active">Reportes</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- =============================================================================================================================
M A I N   C O N T E N T
===============================================================================================================================-->
<div class="content">

    <div class="container-fluid">

        <!-- row para criterios de busqueda -->
        <div class="row">

            <div class="col-lg-12">

                <div class="card card-gray shadow">
                    <div class="card-header">
                        <h3 class="card-title">CRITERIOS DE BÚSQUEDA</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button type="button" class="btn btn-tool text-warning" id="btnLimpiarBusqueda">
                                <i class="fas fa-times"></i>
                            </button>
                        </div> <!-- ./ end card-tools -->
                    </div> <!-- ./ end card-header -->
                    <div class="card-body py-2">

                        <div class="row">

                            <!-- FECHA DE COMPRA -->
                            <div class="col-12 col-md-4 col-lg-3 mb-2">
                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card mr-1 my-text-color"></i> Fecha Desde</label>
                                <div class="input-group input-group-sm mb-3 ">
                                    <span class="input-group-text" id="inputGroup-sizing-sm" style="cursor: pointer;" data-toggle="datetimepicker" data-target="#fecha_desde"><i class="fas fa-calendar-alt ml-1 text-white"></i></span>
                                    <input type="text" class="form-control form-control-sm datetimepicker-input" style="border-top-right-radius: 20px;border-bottom-right-radius: 20px;" aria-label="Sizing example input" id="fecha_desde" name="fecha_desde" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>

                            <div class="col-12 col-lg-3 mb-2">
                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card mr-1 my-text-color"></i> Fecha Hasta</label>
                                <div class="input-group input-group-sm mb-3 ">
                                    <span class="input-group-text" id="inputGroup-sizing-sm" style="cursor: pointer;" data-toggle="datetimepicker" data-target="#fecha_hasta"><i class="fas fa-calendar-alt ml-1 text-white"></i></span>
                                    <input type="text" class="form-control form-control-sm datetimepicker-input" style="border-top-right-radius: 20px;border-bottom-right-radius: 20px;" aria-label="Sizing example input" id="fecha_hasta" name="fecha_hasta" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 mb-2">
                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-gifts mr-1 my-text-color"></i>Usuario</label>
                                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="usuario" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>


                            <!-- BUSCAR PRODUCTO -->
                            <div class="d-flex align-items-end col-12  justify-content-center">

                                <a class="btn btn-sm btn-danger fw-bold w-10" id="btnLimpiarFiltros" style="position: relative;">
                                    <span class="text-button">LIMPIAR</span>
                                    <span class="btn fw-bold icon-btn-danger d-flex align-items-center">
                                        <i class="fas fa-times-circle fs-5"></i>
                                    </span>
                                </a>

                                <a class="btn btn-sm btn-info w-10 fw-bold btnBuscarArqueos ml-2" style="position: relative;">
                                    <span class="text-button">BUSCAR</span>
                                    <span class="btn fw-bold icon-btn-custom d-flex align-items-center">
                                        <i class="fas fa-search fs-5"></i>
                                    </span>
                                </a>
                            </div>


                        </div>

                    </div> <!-- ./ end card-body -->

                </div>

            </div>

        </div>


        <div class="row pt-3 pb-3">

            <div class="col-12">

                <table id="tbl_arqueo_caja" class="table table-striped w-100 shadow border border-secondary">
                    <thead class="bg-main">
                        <tr style="font-size: 15px;">
                            <th class="text-cetner"></th> <!-- 10 -->
                            <th>ID</th> <!-- 2 -->
                            <th>Id Usu</th> <!-- 3 -->
                            <th>Usuario</th> <!-- 3 -->
                            <th>Fec. Apertura</th> <!-- 4 -->
                            <th>Fec. Cierre</th> <!-- 5 -->
                            <th>Monto Apertura</th> <!-- 6 -->
                            <th>Ingresos</th> <!-- 7 -->
                            <th>Devoluciones</th> <!-- 8 -->
                            <th>Gastos</th> <!-- 9 -->
                            <th>Monto Final</th> <!-- 10 -->
                            <th>Estado</th> <!-- 11 -->
                        </tr>
                    </thead>
                    <tbody class="text-small">
                    </tbody>
                </table>

            </div>

        </div>

    </div>

</div>

<div class="loading">Loading</div>

<script>
    $(document).ready(function() {

        fnc_MostrarLoader()
        fnc_CargarDataTableArqueosCaja("", "", "");
        fnc_CargarAutocompleteUsuarios();
        fnc_CargarInputsFecha();

        $("#btnImprimirArqueo").on('click', function() {
            fnc_ImprimirArqueo($("#btnAbrirCerrarCaja").attr('id-caja'));
        })

        $('#tbl_arqueo_caja tbody').on('click', '.btnCerrarCaja', function() {
            var data = $("#tbl_arqueo_caja").DataTable().row($(this).parents('tr')).data();
            fnc_CerrarCaja(data["id"], data['monto_final'])
        })

        $(".btnBuscarArqueos").on('click', function() {
            fnc_CargarDataTableArqueosCaja($("#usuario").val().split("-")[0].trim(), $("#fecha_desde").val(), $("#fecha_hasta").val());
        })
        $(".btnLimpiarFiltro").on('click', function() {
            $("#usuario").val(""); 
            $("#fecha_desde").val(""); 
            $("#fecha_hasta").val("")
            fnc_CargarDataTableArqueosCaja("", "", "");
        })

        $('#tbl_arqueo_caja tbody').on('click', '.btnImprimirDetalleArqueo', function() {
            var data = $('#tbl_arqueo_caja').DataTable().row($(this).parents('tr')).data();
            
            fnc_ImprimirArqueo(data["1"], data["2"]);
        });


        fnc_OcultarLoader();

    })

    function fnc_MostrarLoader() {
        $(".loading").removeClass('d-none');
        $(".loading").addClass('d-block');
    }

    function fnc_OcultarLoader() {
        $(".loading").removeClass('d-block');
        $(".loading").addClass('d-none')
    }

    function fnc_CargarDataTableArqueosCaja($usuario, $fecha_desde, $fecha_hasta) {

        if ($.fn.DataTable.isDataTable('#tbl_arqueo_caja')) {
            $('#tbl_arqueo_caja').DataTable().destroy();
            $('#tbl_arqueo_caja tbody').empty();
        }

        $("#tbl_arqueo_caja").DataTable({
            dom: 'Bfrtip',
            buttons: ['pageLength'],
            pageLength: [5, 10, 15, 30, 50, 100],
            pageLength: 10,
            ajax: {
                url: "ajax/arqueo_caja.ajax.php",
                dataSrc: '',
                type: "POST",
                data: {
                    'accion': 'listar_arqueos', //1: LISTAR PRODUCTOS
                    'usuario': $usuario,
                    'fecha_desde': $fecha_desde,
                    'fecha_hasta': $fecha_hasta
                },
            },
            // responsive: {
            //     details: {
            //         type: 'column'
            //     }
            // },
            columnDefs: [{
                    targets: 0,
                    createdCell: function(td, cellData, rowData, row, col) {
                        // $(td).html("<span class='btnImprimirDetalleArqueo text-danger px-1' style='cursor:pointer;'  data-bs-toggle='tooltip' data-bs-placement='top' title='Ver Arqueo'>" +
                        //     "<i class='fas fa-file-pdf fs-5'></i>" +
                        //     "</span>")

                        // if (rowData["estado"] == "CAJA ABIERTA") {
                        //     $(td).append("<span class='btnCerrarCaja text-danger px-1' style='cursor:pointer;'  data-bs-toggle='tooltip' data-bs-placement='top' title='Cerrar Caja'>" +
                        //         "<i class='fas fa-ban fs-5'></i>" +
                        //         "</span>")
                        // }

                        $options = `<div class="btn-group">
                                
                                <button class="btn btn-sm dropdown-toggle p-0 m-0 my-text-color fs-5" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-list-alt"></i>
                                </button>

                                <div class="dropdown-menu z-3">
                                    <a class="dropdown-item btnImprimirDetalleArqueo" style='cursor:pointer;'><i class='px-1 fas fa-print fs-5 text-secondary'></i> <span class='my-color'>Imprimir Arqueo</span></a>`



                        $options = $options + `</div>
                                    </div>`;

                        $(td).html($options)
                    }
                },
                {
                    targets: [1,2],
                    visible: false
                },
                {
                    targets: 11,
                    createdCell: function(td, cellData, rowData, row, col) {

                        if (rowData[11] == 'CAJA ABIERTA') {
                            $(td).html('<span class="bg-success px-2 py-1 rounded "> ' + rowData[11] + ' </span>')
                        } else {
                            $(td).html('<span class="bg-secondary px-2 py-1 rounded "> ' + rowData[11] + ' </span>')
                        }
                    }
                },


            ],
            language: {
                url: "ajax/language/spanish.json"
            }
        });

    }

    /*===================================================================*/
    //A U T O C O M P L E T E   D E   C L I E N T E S
    /*===================================================================*/
    function fnc_CargarAutocompleteUsuarios() {

        $("#usuario").autocomplete({
            source: "ajax/usuarios.ajax.php",
            minLength: 2,
            autoFocus: true,
            select: function(event, ui) {                
                $("#usuario").val(ui.item.value)
                return false;
            },

            response: function(event, ui) {

                if (!ui.content.length) {
                    var noResult = {
                        value: "",
                        label: '<a href="javascript:void(0);" class="d-flex border border-secondary border-left-0 border-right-0 border-top-0" style="width:100% !important;">' +
                            '<div class=""> ' +
                            '<span class="text-sm fw-bold">No existen datos</span>' +
                            '</div>' +
                            '</a>'
                    };
                    ui.content.push(noResult);
                }
            },
            open: function() {
                $("ul.ui-menu").width($(this).innerWidth());
            }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
            return $("<li class='ui-autocomplete-row'></li>")
                .data("item.autocomplete", item)
                .append(item.label)
                .appendTo(ul);
        };

    }

    function fnc_CargarInputsFecha() {
        $('#fecha_desde, #fecha_hasta').datetimepicker({
            format: 'YYYY-MM-DD',
            locale: moment.lang('es', {
                months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'
                    .split('_'),
                monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.'.split(
                    '_'),
                weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
                weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
                weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
            }),
            // defaultDate: moment(),
        });
    }


    function fnc_ImprimirArqueo($id_arqueo_caja, $id_usuario_arqueo) {


        window.open($ruta+'vistas/modulos/impresiones/imprimir_arqueo.php?id_arqueo_caja=' + $id_arqueo_caja+'&id_usuario_arqueo='+$id_usuario_arqueo,
            "ModalPopUp",
            "toolbar=no," +
            "scrollbars=no," +
            "location=no," +
            "statusbar=no," +
            "menubar=no," +
            "resizable=0," +
            "width=400," +
            "height=600," +
            "left = 450," +
            "top=200");
    }
</script>