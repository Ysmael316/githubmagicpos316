<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 fw-bold">EMPRESA</h2>
            </div>
            <div class="col-sm-6  d-none d-md-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="./">Inicio</a></li>
                    <li class="breadcrumb-item active">Datos de la Empresa</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Content (Page header) -->
<div class="content">

    <div class="container-fluid">

        <div class="card card-gray shadow mt-4">

            <div class="card-body px-3 py-3" style="position: relative;">

                <span class="titulo-fieldset px-3 py-1">DATOS DE LA EMPRESA </span>

                <div class="row my-3">

                    <div class="col-12">

                        <form id="frm-datos-empresas" class="needs-validation-empresas" novalidate>

                            <input type="hidden" name="id_empresa" id="id_empresa" value="0">

                            <div class="row">

                                <!-- GENERA FACTURACIÓN -->
                                <div class="col-12 col-lg-2 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-file-invoice mr-1 my-text-color"></i>Genera Fact. Elect.?<strong class="text-danger">*</strong></label>
                                    <div class="form-group clearfix w-100 d-flex justify-content-start justify-content-lg-start my-0 ">
                                        <div class="icheck-warning d-inline mx-2">
                                            <input type="radio" id="rb-si-genera" value="1" name="rb_genera_facturacion" checked="">
                                            <label for="rb-si-genera">
                                                Si
                                            </label>
                                        </div>
                                        <div class="icheck-success d-inline mx-2">
                                            <input type="radio" id="rb-no-genera" value="2" name="rb_genera_facturacion">
                                            <label for="rb-no-genera">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- TIPO DE DOCUMENTO -->
                                <!-- <div class="col-12 col-lg-2 mb-2">
                                
                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-file-contract mr-1 my-text-color"></i>Tipo Documento <strong class="text-danger">*</strong></label>
                                <select class="form-select" id="tipo_documento" name="tipo_documento" aria-label="Floating label select example" required readonly>
                                </select>
                                <div class="invalid-feedback">Seleccione el Tipo de Documento</div>
                            </div> -->

                                <!-- NRO DE DOCUMENTO -->
                                <div class="col-12 col-lg-2 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>RUC <strong class="text-danger">*</strong></label>
                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="nro_documento" name="nro_documento" onchange="validateJS(event, 'ruc_empresa')" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                    <div class="invalid-feedback">Ingrese el Nro de Documento</div>
                                </div>

                                <!-- RAZÓN SOCIAL -->
                                <div class="col-12 col-lg-8 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Razón Social <strong class="text-danger">*</strong></label>
                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="razon_social" name="razon_social" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                    <div class="invalid-feedback">Ingrese Razón Social</div>
                                </div>

                                <!-- NOMBRE COMERCIAL -->
                                <div class="col-12 col-lg-6 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Nombre Comercial <strong class="text-danger">*</strong></label>
                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="nombre_comercial" name="nombre_comercial" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                    <div class="invalid-feedback">Ingrese Nombre Comercial</div>
                                </div>

                                <!-- DIRECCIÓN -->
                                <div class="col-12 col-lg-6 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Dirección <strong class="text-danger">*</strong></label>
                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="direccion" name="direccion" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                    <div class="invalid-feedback">Ingrese Dirección</div>
                                </div>

                                <!-- EMAIL -->
                                <div class="col-12 col-lg-3 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Email</label>
                                    <input type="email" style="border-radius: 20px;" class="form-control form-control-sm" id="email" name="email" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <!-- TELEFONO -->
                                <div class="col-12 col-lg-2 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Teléfono</label>
                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="telefono" name="telefono" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <!-- DEPARTAMENTO -->
                                <div class="col-12 col-lg-2 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-file-contract mr-1 my-text-color"></i>Departamento <strong class="text-danger">*</strong></label>
                                    <select class="form-select" id="departamento" name="departamento" aria-label="Floating label select example" required>
                                    </select>
                                    <div class="invalid-feedback">Ingrese Departamento</div>
                                </div>

                                <!-- PROVINCIA -->
                                <div class="col-12 col-lg-2 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-file-contract mr-1 my-text-color"></i>Provincia <strong class="text-danger">*</strong></label>
                                    <select class="form-select" id="provincia" name="provincia" aria-label="Floating label select example" required>
                                        <option value="">--Seleccione Provincia--</option>
                                    </select>
                                    <div class="invalid-feedback">Ingrese Provincia</div>
                                </div>

                                <!-- DISTRITO -->
                                <div class="col-12 col-lg-2 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-file-contract mr-1 my-text-color"></i>Distrito <strong class="text-danger">*</strong></label>
                                    <select class="form-select" id="distrito" name="distrito" aria-label="Floating label select example" required>
                                        <option value="">--Seleccione Distrito--</option>
                                    </select>
                                    <div class="invalid-feedback">Ingrese Distrito</div>
                                </div>

                                <!-- UBIGEO -->
                                <div class="col-12 col-lg-1 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Ubigeo <strong class="text-danger">*</strong></label>
                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm my-disabled" onchange="validateJS(event, 'ubigeo')" id="ubigeo" name="ubigeo" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                    <div class="invalid-feedback">Ingrese Ubigeo</div>
                                </div>

                                <div class="row" id="section-facturacion">
                                </div>

                                <!-- ESTADO -->
                                <div class="col-12 col-lg-2 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-toggle-on mr-1 my-text-color"></i>Estado <strong class="text-danger">*</strong></label>
                                    <select class="form-select" id="estado" name="estado" aria-label="Floating label select example" required>
                                        <option value="" disabled>--Seleccione un estado--</option>
                                        <option value="1" selected>ACTIVO</option>
                                        <option value="0">INACTIVO</option>
                                    </select>
                                    <div class="invalid-feedback">Seleccion Estado</div>
                                </div>

                                <!-- IMAGEN -->
                                <div class="col-12 col-lg-6 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-image mr-1 my-text-color"></i>Seleccione logo </label>
                                    <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" onchange="previewFile(this)">
                                </div>

                                <!-- PREVIEW IMAGEN -->
                                <div class="col-12 col-lg-12">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-image mr-1 my-text-color"></i>Vista previa logo</label>
                                    <div style="width: 155px; height: 155px;">
                                        <img id="previewImg" src="vistas/assets/imagenes/no_image.jpg" class="border border-secondary" style="object-fit: fill; width: 100%; height: 100%;" alt="">
                                    </div>
                                </div>

                                <!-- CANCELAR - GUARDAR -->
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <a class="btn btn-sm btn-success  fw-bold w-lg-25 w-100" id="btnRegistrarEmpresa" style="position: relative;">
                                                <span class="text-button">GUARDAR</span>
                                                <span class="btn fw-bold icon-btn-success d-flex align-items-center">
                                                    <i class="fas fa-save fs-5 text-white m-0 p-0"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>


<div class="loading">Loading</div>

<script>
    $(document).ready(function() {

        fnc_MostrarLoader()


        CargarSelects();
        // fnc_CargarDatatableEmpresas();
        fnc_AgregarInputsFacturacion();
        fnc_CargarDatosEmpresa();


        $("#btnRegistrarEmpresa").on('click', function() {
            fnc_GuardarDatosEmpresa();
        });

        $('#tbl_empresas tbody').on('click', '.btnEditarEmpresa', function() {
            fnc_CargarDatosEmpresa($(this));
        })

        $('#tbl_empresas tbody').on('click', '.btnEliminarEmpresa', function() {
            fnc_ModalEliminarEmpresa($(this));
        })



        $("#email").change(function() {
            var pattern = /^[^0-9][.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/;

            if (!pattern.test($("#email").val())) {
                mensajeToast('warning', 'Formato de email inválido');
                $("#email").val('');
                $("#email").focus();
                return;
            }
        })


        $('input[type=radio][name=rb_genera_facturacion]').change(function() {
            if (this.value == '1') {
                fnc_AgregarInputsFacturacion();
            } else if (this.value == '2') {
                fnc_QuitarInputsFacturacion();
            }
        });

        $("#departamento").change(function() {
            CargarSelect(null, $("#provincia"), "--Seleccione Provincia--", "ajax/ubigeos.ajax.php", 'obtener_provincias', $("#departamento").val(), 0);
            CargarSelect(null, $("#distrito"), "--Seleccione Distrito--", "ajax/ubigeos.ajax.php", 'obtener_distritos', $("#provincia").val(), 0);
            $("#ubigeo").val('')
        })

        $("#provincia").change(function() {
            CargarSelect(null, $("#distrito"), "--Seleccione Distrito--", "ajax/ubigeos.ajax.php", 'obtener_distritos', $("#provincia").val(), 0);
            $("#ubigeo").val('')
        })

        $("#distrito").change(function() {

            var formData = new FormData();
            formData.append('accion', 'obtener_ubigeo');
            formData.append('departamento', $("#departamento").val());
            formData.append('provincia', $("#provincia").val());
            formData.append('distrito', $("#distrito").val());

            response = SolicitudAjax('ajax/ubigeos.ajax.php', 'POST', formData);

            $("#ubigeo").val(response.ubigeo);
        })

        fnc_OcultarLoader();

    })

    function CargarSelects() {
        CargarSelect('6', $("#tipo_documento"), "--Seleccione Tipo Documento--", "ajax/ventas.ajax.php", 'obtener_tipo_documento', null, 0);
        CargarSelect(null, $("#departamento"), "--Seleccione Departamento--", "ajax/ubigeos.ajax.php", 'obtener_departamentos', null, 0);
    }


    function fnc_AgregarInputsFacturacion() {



        // <div class="col-12 col-lg-2 mb-2">
        //         <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Usuario SOL </label>
        //         <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="usuario_sol" name="usuario_sol" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
        //         <div class="invalid-feedback">Ingrese usuario sol</div>
        //     </div> 

        //     <div class="col-12 col-lg-2 mb-2">
        //         <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Clave SOL </label>
        //         <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="clave_sol" name="clave_sol" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
        //         <div class="invalid-feedback">Ingrese clave sol</div>
        //     </div> 

        $("#section-facturacion").append(
            `  
            <div class="col-12 col-lg-2 mb-2">
                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Ruta Certificado</label>
                <input type="text" value="../fe/certificado/" style="border-radius: 20px;" class="form-control form-control-sm" id="ruta_certificado" name="ruta_certificado" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly>
            </div> 

            <div class="col-12 col-lg-8 mb-2">
                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-image mr-1 my-text-color"></i>Seleccione el Certificado Digital </label>
                <input type="file" class="form-control" id="certificado" name="certificado" accept=".pfx" required>
                <div class="invalid-feedback">Seleccione certificado</div>
            </div> 
            

            <div class="col-12 col-lg-2 mb-2">
                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Clave Certificado </label>
                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="clave_certificado" name="clave_certificado" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                <div class="invalid-feedback">Ingrese clave</div>
            </div>`

        );
    }

    function fnc_QuitarInputsFacturacion() {

        $("#section-facturacion").html('');
    }

    function fnc_CargarDatatableEmpresas() {

        if ($.fn.DataTable.isDataTable('#tbl_empresas')) {
            $('#tbl_empresas').DataTable().destroy();
            $('#tbl_empresas tbody').empty();
        }

        $("#tbl_empresas").DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excel',
                title: function() {
                    var printTitle = 'LISTADO DE EMPRESAS';
                    return printTitle
                }
            }, 'pageLength'],
            pageLength: 10,
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: 'ajax/empresas.ajax.php',
                data: {
                    'accion': 'obtener_empresas'
                },
                type: 'POST'
            },
            // responsive: {
            //     details: {
            //         type: 'column'
            //     }
            // },
            scrollX: true,
            scrollY: "63vh",
            columnDefs: [{
                    targets: 0,
                    orderable: false,
                    className: 'control'
                },
                {
                    targets: 4,
                    visible: false
                },
                {
                    targets: 17,
                    createdCell: function(td, cellData, rowData, row, col) {
                        if (rowData[17] != 'ACTIVO') {
                            $(td).parent().css('background', '#F2D7D5')
                            $(td).parent().css('color', 'black')
                        }
                    }
                },
                {
                    targets: 0,
                    orderable: false,
                    createdCell: function(td, cellData, rowData, row, col) {
                        $(td).html(`<span class='btnEditarEmpresa text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar Empresa'>
                                        <i class='fas fa-pencil-alt fs-6'></i>
                                    </span>
                                    <span class='btnEliminarEmpresa text-danger px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar Empresa'>
                                        <i class='fas fa-trash fs-6'></i>
                                    </span>`)
                    }
                }

            ],
            language: {
                url: "ajax/language/spanish.json"
            }
        })
    }

    function fnc_GuardarDatosEmpresa() {

        let accion = '';
        var certificado_valido = true;
        var imagen_valida = true;

        form_empresas_validate = validarFormulario('needs-validation-empresas');

        var formData = new FormData();

        //INICIO DE LAS VALIDACIONES
        if (!form_empresas_validate) {
            mensajeToast("error", "complete los datos obligatorios");
            return;
        }

        Swal.fire({
            title: 'Está seguro(a) de guardar los datos de la Empresa?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si!',
            cancelButtonText: 'No',
        }).then((result) => {

            if (result.isConfirmed) {

                var file = $("#certificado").val();

                if (file) {

                    var ext = file.substring(file.lastIndexOf("."));

                    if (ext != ".pfx") {
                        mensajeToast('error', "La extensión " + ext + " no es un certificado válido");
                        certificado_valido = false;
                    }

                    if (!certificado_valido) {
                        return;
                    }

                    const inputCertificado = document.querySelector('#certificado');
                    formData.append('archivo[]', inputCertificado.files[0])
                }

                var file_image = $("#imagen").val();

                if (file_image) {

                    var ext = file_image.substring(file_image.lastIndexOf("."));

                    if (ext != ".jpg" && ext != ".png" && ext != ".gif" && ext != ".jpeg" && ext != ".webp") {
                        mensajeToast('error', "La extensión " + ext + " no es una imagen válida");
                        imagen_valida = false;
                    }

                    if (!imagen_valida) {
                        return;
                    }

                    const inputImage = document.querySelector('#imagen');
                    formData.append('archivo_imagen[]', inputImage.files[0])
                }

                if ($("#id_empresa").val() > 0) accion = 'actualizar_empresa'
                else accion = 'registrar_empresa'

                formData.append('accion', accion);
                formData.append('datos_empresa', $("#frm-datos-empresas").serialize());

                response = SolicitudAjax('ajax/empresas.ajax.php', 'POST', formData);

                Swal.fire({
                    position: 'top-center',
                    icon: response['tipo_msj'],
                    title: response['msj'],
                    showConfirmButton: true,
                    timer: 2000
                });

                $("#tbl_empresas").DataTable().ajax.reload();
                // fnc_LimpiarFomulario();
            }

        })
    }

    function fnc_CargarDatosEmpresa() {

        // fnc_QuitarInputsFacturacion();

        var datos = new FormData();
        datos.append('accion', 'obtener_empresa_principal');

        response = SolicitudAjax('ajax/empresas.ajax.php', 'POST', datos);

        if (response) {
            $("#id_empresa").val(response.id_empresa);

            $("#tipo_documento").val(response.tipo_documento);
            $("#nro_documento").val(response.ruc);
            $("#razon_social").val(response.razon_social)
            $("#nombre_comercial").val(response.nombre_comercial)
            $("#direccion").val(response.direccion)
            $("#email").val(response.email)
            $("#telefono").val(response.telefono)

            $("#departamento").val(response.departamento)
            CargarSelect(null, $("#provincia"), "--Seleccione Provincia--", "ajax/ubigeos.ajax.php", 'obtener_provincias', $("#departamento").val(), 0);
            $("#provincia").val(response.provincia)
            CargarSelect(null, $("#distrito"), "--Seleccione Distrito--", "ajax/ubigeos.ajax.php", 'obtener_distritos', $("#provincia").val(), 0);
            $("#distrito").val(response.distrito)
            $("#ubigeo").val(response.ubigeo)


            if (response.genera_fact_electronica == "1") {
                const fileInput = document.querySelector('input[type="file"]');

                // Create a new File object
                const myFile = new File(['Certificado Digital'], response.certificado_digital, {
                    type: 'text/plain',
                    lastModified: new Date(),
                });

                // Now let's create a DataTransfer to get a FileList
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(myFile);
                fileInput.files = dataTransfer.files;
            }


            const fileInputLogo = document.querySelector('input[name="imagen"]');

            // Create a new File object
            const myFileLogo = new File(['Logo Empresa'], response.logo, {
                type: 'image/*',
                lastModified: new Date(),
            });

            // Now let's create a DataTransfer to get a FileList
            const dataTransferLogo = new DataTransfer();
            dataTransferLogo.items.add(myFileLogo);
            fileInputLogo.files = dataTransferLogo.files;


            if (response.genera_fact_electronica == "1") {
                $("#clave_certificado").val(response.clave_certificado)
                $("#usuario_sol").val(response.usuario_sol)
                $("#clave_sol").val(response.clave_sol)
            }

            $("#previewImg").attr("src", 'vistas/assets/dist/img/logos_empresas/' + (response.logo ? response.logo : 'no_image.jpg'));
            $("#bcp_cci").val(response.bcp_cci);
            $("#bbva_cci").val(response.bbva_cci);
            $("#yape").val(response.yape);
            $("#estado").val(response.estado)
        }



    }

    function fnc_ModalEliminarEmpresa(fila_eliminar) {

        Swal.fire({
            title: 'Está seguro de eliminar la empresa?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo eliminarla!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {

                var data = (fila_eliminar.parents('tr').hasClass('child')) ?
                    $("#tbl_empresas").DataTable().row(fila_eliminar.parents().prev('tr')).data() :
                    $("#tbl_empresas").DataTable().row(fila_eliminar.parents('tr')).data();

                var datos = new FormData();
                datos.append('accion', 'eliminar_empresa');
                datos.append('id_empresa', data['1']);

                response = SolicitudAjax('ajax/empresas.ajax.php', 'POST', datos);

                Swal.fire({
                    position: 'top-center',
                    icon: response['tipo_msj'],
                    title: response['msj'],
                    showConfirmButton: true
                });

                $("#tbl_empresas").DataTable().ajax.reload();

            }
        })




    }

    function fnc_LimpiarFomulario() {

        //LIMPIAR MENSAJES DE VALIDACION
        $(".needs-validation-empresas").removeClass("was-validated");
        $(".form-floating").removeClass("was-validated");


        $("#id_empresa").val('');
        CargarSelects();
        $("#nro_documento").val('');
        $("#nro_documento").attr('id_empresa', -1)
        $("#razon_social").val('')
        $("#nombre_comercial").val('')
        $("#direccion").val('')
        $("#email").val('')
        $("#telefono").val('')
        $("#provincia").val('')
        $("#departamento").val('')
        $("#distrito").val('')
        $("#ubigeo").val('')
        $("#certificado").val('');
        $("#clave_certificado").val('')
        $("#usuario_sol").val('')
        $("#clave_sol").val('')
        $("#imagen").val('');
        $("#previewImg").attr("src", "vistas/assets/imagenes/no_image.jpg");
        $("#bcp_cci").val('')
        $("#bbva_cci").val('')
        $("#yape").val('')
        $("#estado").val('1')

        $("#listado-empresas-tab").prop('disabled', false)

        $("#listado-empresas-tab").addClass('active')
        $("#listado-empresas-tab").attr('aria-selected', true)
        $("#listado-empresas").addClass('active show')

        //DESACTIVAR PANE LISTADO DE PROVEEDORES:
        $("#registrar-empresas-tab").removeClass('active')
        $("#registrar-empresas-tab").attr('aria-selected', false)
        $("#registrar-empresas").removeClass('active show')

        $("#registrar-empresas-tab").html('<i class="fas fa-file-signature"></i> Registrar')


    }

    function ajustarHeadersDataTables(element) {

        var observer = window.ResizeObserver ? new ResizeObserver(function(entries) {
            entries.forEach(function(entry) {
                $(entry.target).DataTable().columns.adjust();
            });
        }) : null;

        // Function to add a datatable to the ResizeObserver entries array
        resizeHandler = function($table) {
            if (observer)
                observer.observe($table[0]);
        };

        // Initiate additional resize handling on datatable
        resizeHandler(element);

    }

    // PREVISUALIZAR LA IMAGEN
    function previewFile(input) {

        var file = $("#imagen").get(0).files[0];

        if (file) {
            var reader = new FileReader();

            reader.onload = function() {
                $("#previewImg").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
    }
</script>