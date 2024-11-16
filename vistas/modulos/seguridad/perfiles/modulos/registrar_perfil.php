<!-- =============================================================================================================================
C O N T E N T   H E A D E R
===============================================================================================================================-->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 mb-2 fw-bold">REGISTRAR PERFIL</h2>
            </div><!-- /.col -->
            <div class="col-sm-6 d-none d-md-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="./">Inicio</a></li>
                    <li class="breadcrumb-item">Perfiles</li>
                    <li class="breadcrumb-item active">Registrar</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div><!-- /.content-header -->

<!-- =============================================================================================================================
M A I N   C O N T E N T
===============================================================================================================================-->
<div class="content">

    <div class="container-fluid">

        <div class="card card-gray shadow mt-4">

            <div class="card-body px-3 py-3" style="position: relative;">

                <span class="titulo-fieldset px-3 py-1">DATOS DEL PERFIL </span>

                <div class="row my-3">

                    <div class="col-12">

                        <form id="frm-datos-perfiles" class="needs-validation-perfiles" novalidate>

                            <div class="row">

                                <div class="col-8">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-users mr-1 my-text-color"></i>Perfil</label>
                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="descripcion" name="descripcion" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="Ingrese el nombre del perfil" required>
                                    <div class="invalid-feedback">Ingrese el nombre del perfil</div>
                                </div>

                                <!-- ESTADO -->
                                <div class="col-4">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-toggle-on mr-1 my-text-color"></i> Estado</label>
                                    <select class="form-select" id="estado" name="estado" aria-label="Floating label select example" required>
                                        <option value="" disabled>--Seleccione un estado--</option>
                                        <option value="1" selected>ACTIVO</option>
                                        <option value="0">INACTIVO</option>
                                    </select>
                                </div>


                                <div class="col-12 mt-3">

                                    <div class="text-center">
                                        <a class="btn btn-sm btn-danger  fw-bold " id="btnCancelarRegistro" style="position: relative; width: 160px;" onclick="fnc_RegresarListadoPerfiles();">
                                            <span class="text-button">REGRESAR</span>
                                            <span class="btn fw-bold icon-btn-danger ">
                                                <i class="fas fa-undo-alt fs-5 text-white m-0 p-0"></i>
                                            </span>
                                        </a>

                                        <a class="btn btn-sm btn-success  fw-bold " id="btnRegistrarPerfil" style="position: relative; width: 160px;" onclick="fnc_RegistrarPerfil();">
                                            <span class="text-button">REGISTRAR</span>
                                            <span class="btn fw-bold icon-btn-success ">
                                                <i class="fas fa-save fs-5 text-white m-0 p-0"></i>
                                            </span>
                                        </a>
                                    </div>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div><!-- /.container-fluid -->

</div><!-- /.content -->

<script>
    $(document).ready(function() {

        fnc_InicializarFormulario();
    })

    function fnc_InicializarFormulario() {
        fnc_LimpiarFomulario();
    }

    function fnc_LimpiarControles() {

        $("#descripcion").val('')
        $("#estado").val('1');

        $(".needs-validation-perfiles").removeClass("was-validated");

    }

    function fnc_RegistrarPerfil() {

        form_perfiles_validate = validarFormulario('needs-validation-perfiles');

        //INICIO DE LAS VALIDACIONES
        if (!form_perfiles_validate) {
            mensajeToast("error", "complete los datos obligatorios");
            return;
        }

        Swal.fire({
            title: 'Está seguro(a) de registrar el Perfil?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo registrarlo!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {

                var formData = new FormData();
                formData.append('accion', 'registrar_perfil');
                formData.append('datos_perfil', $("#frm-datos-perfiles").serialize());

                response = SolicitudAjax('ajax/perfiles.ajax.php', 'POST', formData);

                Swal.fire({
                    position: 'top-center',
                    icon: response['tipo_msj'],
                    title: response['msj'],
                    showConfirmButton: true
                })

                fnc_LimpiarControles();
                fnc_RegresarListadoPerfiles();

            }

        })
    }

    function fnc_RegresarListadoPerfiles() {
        fnc_LimpiarControles();
        CargarContenido('vistas/modulos/seguridad/perfiles/seguridad_perfiles.php', 'content-wrapper')
    }
</script>