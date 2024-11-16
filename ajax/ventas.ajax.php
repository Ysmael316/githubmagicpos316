<?php

setlocale(LC_TIME, 'es_PE.UTF-8');

require_once "../modelos/ventas.modelo.php";
require_once "../modelos/productos.modelo.php";
require_once "../modelos/clientes.modelo.php";
require_once "../modelos/empresas.modelo.php";
require_once "apis/api_facturacion.php";
require "../vendor/autoload.php";

require "../api/guia_remision.php";

use Dompdf\Dompdf;


/* ===================================================================================  */
/* P O S T   P E T I C I O N E S  */
/* ===================================================================================  */

if (isset($_POST["accion"])) {

    switch ($_POST["accion"]) {

        case 'obtener_moneda':

            $response = VentasModelo::mdlObtenerMoneda();

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

            break;

        case 'obtener_simbolo_moneda':

            $response = VentasModelo::mdlObtenerSimboloMoneda($_POST["moneda"]);

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

            break;
        case 'obtener_nro_boleta':

            $response = VentasModelo::mdlObtenerNroBoleta();

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

            break;

        case 'registrar_venta':

            //Datos del comprobante
            $formulario_venta = [];
            parse_str($_POST['datos_venta'], $formulario_venta);

            // $detalle_productos = json_decode($_POST["arr_detalle_productos"]);
            $detalle_productos = json_decode($_POST["productos"]);


            if (isset($_POST["arr_cronograma"])) {
                $cronograma = json_decode($_POST["arr_cronograma"]);
            }

            // DATOS DEL EMISOR:
            $datos_emisor = VentasModelo::mdlObtenerDatosEmisor($formulario_venta["empresa_emisora"]);

            //DATOS DEL CLIENTE:
            if ($formulario_venta['tipo_documento'] == "0") {
                $formulario_venta['nro_documento'] = "99999999";
                $formulario_venta['nombre_cliente_razon_social'] = "CLIENTES VARIOS";
                $formulario_venta['direccion'] = "-";
                $formulario_venta['telefono'] = "-";
            }

            $datos_cliente = VentasModelo::mdlObtenerDatosCliente(
                $formulario_venta['tipo_documento'],
                $formulario_venta['nro_documento'],
                $formulario_venta['nombre_cliente_razon_social'],
                $formulario_venta['direccion'],
                $formulario_venta['telefono']
            );

            $count_items = 0;

            $total_operaciones_gravadas = 0.00;
            $total_operaciones_exoneradas = 0.00;
            $total_operaciones_inafectas = 0.00;
            $total_igv = 0;
            $total_icbper = 0;
            $detalle_venta = array();


            //RECORREMOS EL DETALLE DE LOS PRODUCTOS DE LA VENTA
            for ($i = 0; $i < count($detalle_productos); $i++) {

                $count_items = $count_items + 1;

                $igv_producto = 0; //EN CASO EL PRODUCTO NO TENGA IGV, SE MANTIENE CON EL VALOR = 0
                $factor_igv = 1; //EN CASO EL PRODUCTO NO TENGA IGV, SE MANTIENE CON EL FACTOR = 1

                if ($detalle_productos[$i]->id_tipo_igv == 10) { //SI ES OPERACION GRAVADA = 10
                    $igv = ProductosModelo::mdlObtenerImpuesto($detalle_productos[$i]->id_tipo_igv);
                    $porcentaje_igv = $igv['impuesto'] / 100; //0.18;
                    $factor_igv = 1 + ($igv['impuesto'] / 100);
                    $igv_producto = $detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad * $porcentaje_igv;
                } else $porcentaje_igv = 0.0; // SI ES INAFECTA O EXONERADA

                $total_impuestos_producto = $igv_producto;

                $afectacion = VentasModelo::ObtenerTipoAfectacionIGV($detalle_productos[$i]->id_tipo_igv);
                $costo_unitario = VentasModelo::ObtenerCostoUnitarioUnidadMedida($detalle_productos[$i]->codigo_producto);

                $producto = array(
                    'item'                  => $count_items,
                    'codigo'                => $detalle_productos[$i]->codigo_producto,
                    'descripcion'           => $detalle_productos[$i]->descripcion,
                    'porcentaje_igv'        => $porcentaje_igv * 100, //Para registrar el IGV que se consideró para la venta
                    'unidad'                => $costo_unitario['id_unidad_medida'], //$detalle_productos[$i]->unidad_medida,
                    'cantidad'              => $detalle_productos[$i]->cantidad,
                    'costo_unitario'        => $costo_unitario['costo_unitario'],
                    'valor_unitario'        => round($detalle_productos[$i]->precio, 42),
                    'precio_unitario'       => round($detalle_productos[$i]->precio * $factor_igv, 4),
                    'valor_total'           => round($detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad, 4),
                    'igv'                   => round($igv_producto, 4),
                    'importe_total'         => round($detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad * $factor_igv, 4),
                    'codigos'               => array($afectacion['letra_tributo'], $afectacion['codigo'], $afectacion['codigo_tributo'], $afectacion['nombre_tributo'], $afectacion['tipo_tributo'])
                );


                array_push($detalle_venta, $producto);

                //CALCULAMOS LOS TOTALES POR TIPO DE OPERACIÓN
                if ($detalle_productos[$i]->id_tipo_igv == 10) {
                    $total_operaciones_gravadas = $total_operaciones_gravadas + $producto['valor_total'];
                }

                if ($detalle_productos[$i]->id_tipo_igv == 20) {
                    $total_operaciones_exoneradas = $total_operaciones_exoneradas + $producto['valor_total'];
                }

                if ($detalle_productos[$i]->id_tipo_igv == 30) {
                    $total_operaciones_inafectas = $total_operaciones_inafectas + $producto['valor_total'];
                }

                $total_igv = $total_igv + $igv_producto;
            }

            //OBTENER LA SERIE DEL COMPROBANTE
            $serie = VentasModelo::mdlObtenerSerie($formulario_venta['serie']);

            if ($formulario_venta["forma_pago"] == "1") {
                $forma_pago = "Contado";
            } else {
                $forma_pago = "Credito";
            }

            $monto_credito = 0;
            $cuotas = array();


            if ($forma_pago == "Credito") {

                for ($i = 0; $i < count($cronograma); $i++) {

                    $cuotas[] = array(
                        "cuota" => $cronograma[$i]->cuota,
                        "importe" => round($cronograma[$i]->importe, 2),
                        "vencimiento" => $cronograma[$i]->fecha_vencimiento
                    );
                }
            }

            //DATOS DE LA VENTA:
            $venta['id_empresa_emisora'] = $datos_emisor["id_empresa"];
            $venta['id_cliente'] = $datos_cliente["id"];
            $venta['tipo_operacion'] = '0101';
            $venta['tipo_comprobante'] = $formulario_venta["tipo_comprobante"];
            $venta['id_serie'] = $serie['id'];
            $venta['serie'] = $serie['serie'];
            $venta['correlativo'] = intval($serie['correlativo']) + 1;
            $venta['fecha_emision'] = $formulario_venta['fecha_emision'];
            $venta['hora_emision'] = Date('H:i:s');
            $venta['fecha_vencimiento'] = Date('Y-m-d');
            $venta['moneda'] = $formulario_venta["moneda"];
            $venta['forma_pago'] = $forma_pago;
            $venta['medio_pago'] = $formulario_venta["medio_pago"];
            $venta['monto_credito'] = round($total_operaciones_gravadas + $total_operaciones_exoneradas + $total_operaciones_inafectas + $total_igv, 2);
            $venta['total_impuestos'] = $total_igv;
            $venta['total_operaciones_gravadas'] = $total_operaciones_gravadas;
            $venta['total_operaciones_exoneradas'] = $total_operaciones_exoneradas;
            $venta['total_operaciones_inafectas'] = $total_operaciones_inafectas;
            $venta['total_igv'] = $total_igv;
            $venta['total_sin_impuestos'] = $total_operaciones_gravadas + $total_operaciones_exoneradas + $total_operaciones_inafectas;
            $venta['total_con_impuestos'] = $total_operaciones_gravadas + $total_operaciones_exoneradas + $total_operaciones_inafectas + $total_igv;
            $venta['total_a_pagar'] = $total_operaciones_gravadas + $total_operaciones_exoneradas + $total_operaciones_inafectas + $total_igv;
            $venta['vuelto'] = $formulario_venta["vuelto"];
            $venta['efectivo_recibido'] = $formulario_venta["total_recibido"];
            $venta['cuotas'] = $cuotas;


            if (isset($formulario_venta['rb_generar_venta']) && $formulario_venta['rb_generar_venta'] == 1) {


                /*****************************************************************************************
                R E G I S T R A R   V E N T A   Y   D E T A L L E   E N   L A   B D
                 *****************************************************************************************/
                $id_venta = VentasModelo::mdlRegistrarVenta($venta, $detalle_venta, $_POST["id_caja"]);

                if ($venta['forma_pago'] == 'Credito') {
                    $insert_cuotas = VentasModelo::mdlInsertarCuotas($id_venta, $cuotas);
                }

                /*****************************************************************************************
                G E N E R A R    C O M P R O B A N T E    E L E C T R Ó N I C O ( X M L )
                 *****************************************************************************************/

                //INSTANCIA DE APIFACTURACION
                $generar_comprobante = new ApiFacturacion();

                //RUTA Y NOMBRE DEL ARCHIVO XML:
                $path_xml = "../fe/facturas/xml/";
                $name_xml = $datos_emisor['ruc'] . '-' .
                    $venta['tipo_comprobante'] . '-' .
                    $venta['serie'] . '-' .
                    $venta['correlativo'];

                $resultado = ApiFacturacion::Genera_XML_Factura_Boleta($path_xml, $name_xml, $datos_emisor, $datos_cliente, $venta, $detalle_venta);

                /******************************************************************************************/
                // F I R M A R   X M L 
                /******************************************************************************************/
                $response_signature = ApiFacturacion::FirmarXml($path_xml, $name_xml, $datos_emisor);

                if ($response_signature["estado_firma"] == 1) {

                    /******************************************************************************************/
                    // E N V I A R   C O M P R O B A N T E   A   S U N A T
                    /*****************************************************************************************/
                    $resultado = ApiFacturacion::EnviarComprobanteElectronico($path_xml, $name_xml, $datos_emisor, '../fe/facturas/cdr/');

                    // var_dump($resultado);

                    if ($resultado["error"] == '0') {

                        /*****************************************************************************************
                        A C T U A L I Z A R   V E N T A   C O N   R E S P U E S T A   D E   S U N A T
                         *****************************************************************************************/
                        $respuesta = VentasModelo::mdlActualizarRespuestaComprobante(
                            $id_venta,
                            $resultado['nombre_xml'],
                            $response_signature['hash_cpe'],
                            $resultado['codigo_error_sunat'],
                            $resultado['mensaje_respuesta_sunat'],
                            $resultado['estado_respuesta_sunat'],
                            $resultado['xml_base64'],
                            $resultado['xml_cdr_sunat_base64']
                        );

                        $resultado["id_venta"] = $id_venta;
                        $resultado['tipo_msj'] = "success";
                        $resultado['msj'] = 'Se envio a Sunat, ' . $resultado['mensaje_respuesta_sunat'];

                        echo json_encode($resultado);
                    } else {
                        $respuesta = VentasModelo::mdlActualizarRespuestaComprobante(
                            $_POST["id_venta"],
                            $resultado['nombre_xml'],
                            $response_signature['hash_cpe'],
                            $resultado['codigo_error_sunat'],
                            $resultado['mensaje_respuesta_sunat'],
                            $resultado['estado_respuesta_sunat'],
                            $resultado['xml_base64'],
                            $resultado['xml_cdr_sunat_base64']
                        );



                        $response["id_venta"] = $_POST["id_venta"];
                        $response['tipo_msj'] = "error";
                        $response['msj'] = 'Rechazado por SUNAT, se envió con errores,' . $resultado['mensaje_respuesta_sunat'];

                        // var_dump($response);
                        // return;

                        echo json_encode($response);
                    }
                } else {
                    $respuesta["id_venta"] = $id_venta;
                    $respuesta['tipo_msj'] = "error";
                    $respuesta['msj'] = $response_signature["mensaje_error_firma"];
                    echo json_encode($respuesta);
                }
            } else {

                /*****************************************************************************************
                R E G I S T R A R   V E N T A   Y   D E T A L L E   E N   L A   B D
                 *****************************************************************************************/
                $id_venta = VentasModelo::mdlRegistrarVenta($venta, $detalle_venta, $_POST["id_caja"]);

                /*****************************************************************************************
                G E N E R A R    C O M P R O B A N T E    E L E C T R Ó N I C O
                 *****************************************************************************************/

                //INSTANCIA DE APIFACTURACION
                // $generar_comprobante = new ApiFacturacion();

                //RUTA Y NOMBRE DEL ARCHIVO XML:
                // $path_xml = "../fe/facturas/xml/";
                // $name_xml = $datos_emisor['ruc'] . '-' .
                //     $venta['tipo_comprobante'] . '-' .
                //     $venta['serie'] . '-' .
                //     $venta['correlativo'];

                // $resultado = ApiFacturacion::Genera_XML_Factura_Boleta($path_xml, $name_xml, $datos_emisor, $datos_cliente, $venta, $detalle_venta);


                /*****************************************************************************************
                F I R M A R   X M L 
                 *****************************************************************************************/
                // $response_signature = ApiFacturacion::FirmarXml($path_xml, $name_xml, $datos_emisor);


                if ($id_venta > 0) {
                    $respuesta["id_venta"] = $id_venta;
                    $respuesta['tipo_msj'] = "success";
                    $respuesta['msj'] = "La venta se guardó correctamente";
                    echo json_encode($respuesta);
                } else {
                    $respuesta["id_venta"] = $id_venta;
                    $respuesta['tipo_msj'] = "error";
                    $respuesta['msj'] = "Error al generar la venta";
                    echo json_encode($respuesta);
                }

                // if ($response_signature["estado_firma"] == 1) {
                //     $respuesta["id_venta"] = $id_venta;
                //     $respuesta['tipo_msj'] = "success";
                //     $respuesta['msj'] = "La venta se guardó correctamente";
                //     echo json_encode($respuesta);
                // } else {
                //     $respuesta["id_venta"] = $id_venta;
                //     $respuesta['tipo_msj'] = "error";
                //     $respuesta['msj'] = $response_signature["mensaje_error_firma"];
                //     echo json_encode($respuesta);
                // }
            }

            break;

        case 'registrar_venta_pos':


            //Datos del comprobante
            // $formulario_venta = [];
            // parse_str($_POST['datos_venta'], $formulario_venta);

            $tipo_documento = $_POST["tipo_documento"];
            $id_serie = $_POST["serie"];
            $forma_pago = $_POST["forma_pago"];
            $tipo_comprobante = $_POST["tipo_comprobante"];
            $medio_pago = $_POST["medio_pago"];
            $vuelto = isset($_POST["vuelto"]) ? $_POST["vuelto"] : 0;
            $total_recibido = $_POST["total_recibido"];
            $id_caja = $_POST["id_caja"];

            // $detalle_productos = json_decode($_POST["arr_detalle_productos"]);
            $detalle_productos = json_decode($_POST["productos"]);

            // DATOS DEL EMISOR:
            $datos_emisor = VentasModelo::mdlObtenerDatosEmisorDefecto();

            //DATOS DEL CLIENTE:
            if ($tipo_documento == "0") {
                $nro_documento = "99999999";
                $nombre_cliente_razon_social = "CLIENTES VARIOS";
                $direccion = "-";
                $telefono = "-";
            } else {
                $nro_documento = $_POST["nro_documento"];
                $nombre_cliente_razon_social = $_POST["nombre_cliente_razon_social"];
                $direccion = $_POST["direccion"];
                $telefono = "-";
            }

            $datos_cliente = VentasModelo::mdlObtenerDatosCliente(
                $tipo_documento,
                $nro_documento,
                $nombre_cliente_razon_social,
                $direccion,
                $telefono
            );

            $count_items = 0;

            $total_operaciones_gravadas = 0.00;
            $total_operaciones_exoneradas = 0.00;
            $total_operaciones_inafectas = 0.00;
            $total_igv = 0;
            $total_icbper = 0;
            $detalle_venta = array();


            //RECORREMOS EL DETALLE DE LOS PRODUCTOS DE LA VENTA
            for ($i = 0; $i < count($detalle_productos); $i++) {

                $count_items = $count_items + 1;

                $igv_producto = 0; //EN CASO EL PRODUCTO NO TENGA IGV, SE MANTIENE CON EL VALOR = 0
                $factor_igv = 1; //EN CASO EL PRODUCTO NO TENGA IGV, SE MANTIENE CON EL FACTOR = 1

                if ($detalle_productos[$i]->id_tipo_igv == 10) { //SI ES OPERACION GRAVADA = 10
                    $igv = ProductosModelo::mdlObtenerImpuesto($detalle_productos[$i]->id_tipo_igv);
                    $porcentaje_igv = $igv['impuesto'] / 100; //0.18;
                    $factor_igv = 1 + ($igv['impuesto'] / 100);
                    $igv_producto = $detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad * $porcentaje_igv;
                } else $porcentaje_igv = 0.0; // SI ES INAFECTA O EXONERADA

                $total_impuestos_producto = $igv_producto;

                $afectacion = VentasModelo::ObtenerTipoAfectacionIGV($detalle_productos[$i]->id_tipo_igv);
                $costo_unitario = VentasModelo::ObtenerCostoUnitarioUnidadMedida($detalle_productos[$i]->codigo_producto);

                $producto = array(
                    'item'                  => $count_items,
                    'codigo'                => $detalle_productos[$i]->codigo_producto,
                    'descripcion'           => $detalle_productos[$i]->descripcion,
                    'porcentaje_igv'        => $porcentaje_igv * 100, //Para registrar el IGV que se consideró para la venta
                    'unidad'                => $costo_unitario['id_unidad_medida'], //$detalle_productos[$i]->unidad_medida,
                    'cantidad'              => $detalle_productos[$i]->cantidad,
                    'costo_unitario'        => $costo_unitario['costo_unitario'],
                    'valor_unitario'        => round($detalle_productos[$i]->precio, 2),
                    'precio_unitario'       => round($detalle_productos[$i]->precio * $factor_igv, 2),
                    'valor_total'           => round($detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad, 2),
                    'igv'                   => round($igv_producto, 2),
                    'importe_total'         => round($detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad * $factor_igv, 2),
                    'codigos'               => array($afectacion['letra_tributo'], $afectacion['codigo'], $afectacion['codigo_tributo'], $afectacion['nombre_tributo'], $afectacion['tipo_tributo'])
                );


                array_push($detalle_venta, $producto);

                //CALCULAMOS LOS TOTALES POR TIPO DE OPERACIÓN
                if ($detalle_productos[$i]->id_tipo_igv == 10) {
                    $total_operaciones_gravadas = $total_operaciones_gravadas + $producto['valor_total'];
                }

                if ($detalle_productos[$i]->id_tipo_igv == 20) {
                    $total_operaciones_exoneradas = $total_operaciones_exoneradas + $producto['valor_total'];
                }

                if ($detalle_productos[$i]->id_tipo_igv == 30) {
                    $total_operaciones_inafectas = $total_operaciones_inafectas + $producto['valor_total'];
                }

                $total_igv = $total_igv + $igv_producto;
            }


            //OBTENER LA SERIE DEL COMPROBANTE
            $serie = VentasModelo::mdlObtenerSerie($id_serie);

            if ($forma_pago == "1") {
                $forma_pago = "Contado";
            } else {
                $forma_pago = "Credito";
            }

            $monto_credito = 0;
            $cuotas = array();


            if ($forma_pago == "Credito") {

                for ($i = 0; $i < 1; $i++) {

                    $cuotas[] = array(
                        "cuota" => 1,
                        "importe" => round($total_operaciones_gravadas + $total_operaciones_exoneradas + $total_operaciones_inafectas + $total_igv, 2),
                        "vencimiento" => date('Y-m-d', strtotime(Date('Y-m-d') . ' + 7 days')) //sumar 7 dias si es credito
                    );
                }
            }


            //DATOS DE LA VENTA:
            $venta['id_empresa_emisora'] = $datos_emisor["id_empresa"];
            $venta['id_cliente'] = $datos_cliente["id"];
            $venta['tipo_operacion'] = '0101';
            $venta['tipo_comprobante'] = $tipo_comprobante;
            $venta['id_serie'] = $serie['id'];
            $venta['serie'] = $serie['serie'];
            $venta['correlativo'] = intval($serie['correlativo']) + 1;
            $venta['fecha_emision'] = Date('Y-m-d');
            $venta['hora_emision'] = Date('H:i:s');
            $venta['fecha_vencimiento'] = Date('Y-m-d'); //sumar 7 dias si es credito
            $venta['moneda'] = 'PEN';
            $venta['forma_pago'] = $forma_pago;
            $venta['medio_pago'] = $medio_pago;
            $venta['monto_credito'] = round($total_operaciones_gravadas + $total_operaciones_exoneradas + $total_operaciones_inafectas + $total_igv, 2);
            $venta['total_impuestos'] = $total_igv;
            $venta['total_operaciones_gravadas'] = $total_operaciones_gravadas;
            $venta['total_operaciones_exoneradas'] = $total_operaciones_exoneradas;
            $venta['total_operaciones_inafectas'] = $total_operaciones_inafectas;
            $venta['total_igv'] = $total_igv;
            $venta['total_sin_impuestos'] = $total_operaciones_gravadas + $total_operaciones_exoneradas + $total_operaciones_inafectas;
            $venta['total_con_impuestos'] = $total_operaciones_gravadas + $total_operaciones_exoneradas + $total_operaciones_inafectas + $total_igv;
            $venta['total_a_pagar'] = $total_operaciones_gravadas + $total_operaciones_exoneradas + $total_operaciones_inafectas + $total_igv;
            $venta['vuelto'] = $vuelto;
            $venta['efectivo_recibido'] = $total_recibido;
            $venta['cuotas'] = $cuotas;



            if ($tipo_comprobante == "NV") {

                /*****************************************************************************************
                R E G I S T R A R   V E N T A   Y   D E T A L L E   E N   L A   B D
                 *****************************************************************************************/
                $id_venta = VentasModelo::mdlRegistrarNotaVenta($venta, $detalle_venta, $id_caja);

                if ($venta['forma_pago'] == 'Credito') {
                    $insert_cuotas = VentasModelo::mdlInsertarCuotas($id_venta, $cuotas);
                }

                $respuesta["id_venta"] = $id_venta;
                $respuesta['tipo_msj'] = "success";
                $respuesta['msj'] = 'Se registró correctamente la Nota de Venta';

                echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
            } else {

                /*****************************************************************************************
                    G E N E R A R    C O M P R O B A N T E    E L E C T R Ó N I C O ( X M L )
                 *****************************************************************************************/
                /*****************************************************************************************
                R E G I S T R A R   V E N T A   Y   D E T A L L E   E N   L A   B D
                 *****************************************************************************************/
                $id_venta = VentasModelo::mdlRegistrarVenta($venta, $detalle_venta, $id_caja);


                if ($venta['forma_pago'] == 'Credito') {
                    $insert_cuotas = VentasModelo::mdlInsertarCuotas($id_venta, $cuotas);
                }
                //INSTANCIA DE APIFACTURACION
                $generar_comprobante = new ApiFacturacion();

                //RUTA Y NOMBRE DEL ARCHIVO XML:
                $path_xml = "../fe/facturas/xml/";
                $name_xml = $datos_emisor['ruc'] . '-' .
                    $venta['tipo_comprobante'] . '-' .
                    $venta['serie'] . '-' .
                    $venta['correlativo'];

                $resultado = ApiFacturacion::Genera_XML_Factura_Boleta($path_xml, $name_xml, $datos_emisor, $datos_cliente, $venta, $detalle_venta);

                /******************************************************************************************/
                // F I R M A R   X M L 
                /******************************************************************************************/
                $response_signature = ApiFacturacion::FirmarXml($path_xml, $name_xml, $datos_emisor);



                if ($response_signature["estado_firma"] == 1) {

                    /******************************************************************************************/
                    // E N V I A R   C O M P R O B A N T E   A   S U N A T
                    /*****************************************************************************************/


                    $resultado = ApiFacturacion::EnviarComprobanteElectronico($path_xml, $name_xml, $datos_emisor, '../fe/facturas/cdr/');     
                    
                    // print_r($resultado);

                    if ($resultado["error"] == 0) {

                        /*****************************************************************************************
                            A C T U A L I Z A R   V E N T A   C O N   R E S P U E S T A   D E   S U N A T
                         *****************************************************************************************/
                        $respuesta = VentasModelo::mdlActualizarRespuestaComprobante(
                            $id_venta,
                            $resultado['nombre_xml'],
                            $response_signature['hash_cpe'],
                            $resultado['codigo_error_sunat'],
                            $resultado['mensaje_respuesta_sunat'],
                            $resultado['estado_respuesta_sunat'],
                            $resultado['xml_base64'],
                            $resultado['xml_cdr_sunat_base64']
                        );

                        $resultado["id_venta"] = $id_venta;
                        $resultado['tipo_msj'] = "success";
                        $resultado['msj'] = 'Se envio a Sunat, ' . $resultado['mensaje_respuesta_sunat'];

                        echo json_encode($resultado);
                    }
                } else {
                    $respuesta["id_venta"] = $id_venta;
                    $respuesta['tipo_msj'] = "error";
                    $respuesta['msj'] = $response_signature["mensaje_error_firma"];
                    echo json_encode($respuesta);
                }
            }




            break;

        case 'registrar_nota_venta':

            //Datos del comprobante
            $formulario_venta = [];
            parse_str($_POST['datos_venta'], $formulario_venta);

            $detalle_productos = json_decode($_POST["productos"]);

            if (isset($_POST["arr_cronograma"])) {
                $cronograma = json_decode($_POST["arr_cronograma"]);
            }

            // DATOS DEL EMISOR:
            $datos_emisor = VentasModelo::mdlObtenerDatosEmisor($formulario_venta["empresa_emisora"]);

            //DATOS DEL CLIENTE:
            if ($formulario_venta['tipo_documento'] == "0") {
                $formulario_venta['nro_documento'] = "99999999";
                $formulario_venta['nombre_cliente_razon_social'] = "CLIENTES VARIOS";
                $formulario_venta['direccion'] = "-";
                $formulario_venta['telefono'] = "-";
            }

            $datos_cliente = VentasModelo::mdlObtenerDatosCliente(
                $formulario_venta['tipo_documento'],
                $formulario_venta['nro_documento'],
                $formulario_venta['nombre_cliente_razon_social'],
                $formulario_venta['direccion'],
                $formulario_venta['telefono']
            );

            $count_items = 0;

            $total_operaciones_gravadas = 0.00;
            $total_operaciones_exoneradas = 0.00;
            $total_operaciones_inafectas = 0.00;
            $total_igv = 0;
            $total_icbper = 0;
            $detalle_venta = array();


            //RECORREMOS EL DETALLE DE LOS PRODUCTOS DE LA VENTA
            for ($i = 0; $i < count($detalle_productos); $i++) {

                $count_items = $count_items + 1;

                $igv_producto = 0; //EN CASO EL PRODUCTO NO TENGA IGV, SE MANTIENE CON EL VALOR = 0
                $factor_igv = 1; //EN CASO EL PRODUCTO NO TENGA IGV, SE MANTIENE CON EL FACTOR = 1

                if ($detalle_productos[$i]->id_tipo_igv == 10) { //SI ES OPERACION GRAVADA = 10
                    $igv = ProductosModelo::mdlObtenerImpuesto($detalle_productos[$i]->id_tipo_igv);
                    $porcentaje_igv = $igv['impuesto'] / 100; //0.18;
                    $factor_igv = 1 + ($igv['impuesto'] / 100);
                    $igv_producto = $detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad * $porcentaje_igv;
                } else $porcentaje_igv = 0.0; // SI ES INAFECTA O EXONERADA

                $total_impuestos_producto = $igv_producto;

                $afectacion = VentasModelo::ObtenerTipoAfectacionIGV($detalle_productos[$i]->id_tipo_igv);
                $costo_unitario = VentasModelo::ObtenerCostoUnitarioUnidadMedida($detalle_productos[$i]->codigo_producto);

                $producto = array(
                    'item'                  => $count_items,
                    'codigo'                => $detalle_productos[$i]->codigo_producto,
                    'descripcion'           => $detalle_productos[$i]->descripcion,
                    'porcentaje_igv'        => $porcentaje_igv * 100, //Para registrar el IGV que se consideró para la venta
                    'unidad'                => $costo_unitario['id_unidad_medida'], //$detalle_productos[$i]->unidad_medida,
                    'cantidad'              => $detalle_productos[$i]->cantidad,
                    'costo_unitario'        => round($costo_unitario['costo_unitario'], 2),
                    'valor_unitario'        => round($detalle_productos[$i]->precio, 2),
                    'precio_unitario'       => round($detalle_productos[$i]->precio * $factor_igv, 2),
                    'valor_total'           => round($detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad, 2),
                    'igv'                   => round($igv_producto, 2),
                    'importe_total'         => round($detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad * $factor_igv, 2),
                    'codigos'               => array($afectacion['letra_tributo'], $afectacion['codigo'], $afectacion['codigo_tributo'], $afectacion['nombre_tributo'], $afectacion['tipo_tributo'])
                );


                array_push($detalle_venta, $producto);

                //CALCULAMOS LOS TOTALES POR TIPO DE OPERACIÓN
                if ($detalle_productos[$i]->id_tipo_igv == 10) {
                    $total_operaciones_gravadas = $total_operaciones_gravadas + $producto['valor_total'];
                }

                if ($detalle_productos[$i]->id_tipo_igv == 20) {
                    $total_operaciones_exoneradas = $total_operaciones_exoneradas + $producto['valor_total'];
                }

                if ($detalle_productos[$i]->id_tipo_igv == 30) {
                    $total_operaciones_inafectas = $total_operaciones_inafectas + $producto['valor_total'];
                }

                $total_igv = $total_igv + $igv_producto;
            }

            //OBTENER LA SERIE DEL COMPROBANTE
            $serie = VentasModelo::mdlObtenerSerie($formulario_venta['serie']);

            if ($formulario_venta["forma_pago"] == "1") {
                $forma_pago = "Contado";
            } else {
                $forma_pago = "Credito";
            }

            $monto_credito = 0;
            $cuotas = array();


            if ($forma_pago == "Credito") {

                for ($i = 0; $i < count($cronograma); $i++) {

                    $cuotas[] = array(
                        "cuota" => $cronograma[$i]->cuota,
                        "importe" => round($cronograma[$i]->importe, 2),
                        "vencimiento" => $cronograma[$i]->fecha_vencimiento
                    );
                }
            }

            //DATOS DE LA VENTA:
            $venta['id_empresa_emisora'] = $datos_emisor["id_empresa"];
            $venta['id_cliente'] = $datos_cliente["id"];
            $venta['tipo_operacion'] = $formulario_venta['tipo_operacion'];
            $venta['tipo_comprobante'] = $formulario_venta["tipo_comprobante"];
            $venta['id_serie'] = $serie['id'];
            $venta['serie'] = $serie['serie'];
            $venta['correlativo'] = intval($serie['correlativo']) + 1;
            $venta['fecha_emision'] = $formulario_venta['fecha_emision'];
            $venta['hora_emision'] = Date('h:m:s');
            $venta['fecha_vencimiento'] = Date('Y-m-d');
            $venta['moneda'] = $formulario_venta["moneda"];
            $venta['forma_pago'] = $forma_pago;
            $venta['medio_pago'] = $formulario_venta["medio_pago"];
            $venta['monto_credito'] = round($total_operaciones_gravadas + $total_operaciones_exoneradas + $total_operaciones_inafectas + $total_igv, 2);
            $venta['total_impuestos'] = $total_igv;
            $venta['total_operaciones_gravadas'] = round($total_operaciones_gravadas, 2);
            $venta['total_operaciones_exoneradas'] = round($total_operaciones_exoneradas, 2);
            $venta['total_operaciones_inafectas'] = round($total_operaciones_inafectas, 2);
            $venta['total_igv'] = round($total_igv, 2);
            $venta['total_sin_impuestos'] = round($total_operaciones_gravadas + $total_operaciones_exoneradas + $total_operaciones_inafectas, 2);
            $venta['total_con_impuestos'] = round($total_operaciones_gravadas + $total_operaciones_exoneradas + $total_operaciones_inafectas + $total_igv, 2);
            $venta['total_a_pagar'] = round($total_operaciones_gravadas + $total_operaciones_exoneradas + $total_operaciones_inafectas + $total_igv, 2);
            $venta['vuelto'] = $formulario_venta["vuelto"];
            $venta['efectivo_recibido'] = $formulario_venta["total_recibido"];
            $venta['cuotas'] = $cuotas;


            /*****************************************************************************************
            R E G I S T R A R   V E N T A   Y   D E T A L L E   E N   L A   B D
             *****************************************************************************************/
            $id_venta = VentasModelo::mdlRegistrarNotaVenta($venta, $detalle_venta, $_POST["id_caja"]);

            if ($venta['forma_pago'] == 'Credito') {
                $insert_cuotas = VentasModelo::mdlInsertarCuotas($id_venta, $cuotas);
            }

            $respuesta["id_venta"] = $id_venta;
            $respuesta['tipo_msj'] = "success";
            $respuesta['msj'] = 'Se registró correctamente la Nota de Venta';

            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);


            break;

        case 'registrar_nota_credito':

            //Datos del comprobante
            $datos_comprobante = [];
            parse_str($_POST['datos_comprobante'], $datos_comprobante);

            //Datos del comprobante modificado
            $datos_comprobante_modificado = [];
            parse_str($_POST['datos_comprobante_modificado'], $datos_comprobante_modificado);

            $datos_emisor = VentasModelo::mdlObtenerDatosEmisor($datos_comprobante["empresa_emisora"]);

            $detalle_productos = json_decode($_POST["productos"]);

            // DATOS DEL COMPROBANTE MODIFICADO:
            $venta_comprobante_modificado = VentasModelo::mdlObtenerDetalleVentaPorComprobante(
                $datos_comprobante_modificado["serie_modificado"],
                $datos_comprobante_modificado["correlativo_modificado"]
            );

            $datos_cliente = VentasModelo::mdlObtenerDatosClientePorId($venta_comprobante_modificado["id_cliente"]);

            $count_items = 0;

            $total_operaciones_gravadas = 0.00;
            $total_operaciones_exoneradas = 0.00;
            $total_operaciones_inafectas = 0.00;
            $total_igv = 0;
            $total_icbper = 0;
            $detalle_venta = array();

            //RECORREMOS EL DETALLE DE LOS PRODUCTOS DE LA VENTA

            for ($i = 0; $i < count($detalle_productos); $i++) {

                $count_items = $count_items + 1;

                $igv_producto = 0; //EN CASO EL PRODUCTO NO TENGA IGV, SE MANTIENE CON EL VALOR = 0
                $factor_igv = 1; //EN CASO EL PRODUCTO NO TENGA IGV, SE MANTIENE CON EL FACTOR = 1

                if ($detalle_productos[$i]->id_tipo_igv == 10) { //SI ES OPERACION GRAVADA = 10
                    $igv = ProductosModelo::mdlObtenerImpuesto($detalle_productos[$i]->id_tipo_igv);
                    $porcentaje_igv = $igv['impuesto'] / 100; //0.18;
                    $factor_igv = 1 + ($igv['impuesto'] / 100);
                    $igv_producto = $detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad * $porcentaje_igv;
                } else $porcentaje_igv = 0.0; // SI ES INAFECTA O EXONERADA

                $total_impuestos_producto = $igv_producto;

                $afectacion = VentasModelo::ObtenerTipoAfectacionIGV($detalle_productos[$i]->id_tipo_igv);
                $costo_unitario = VentasModelo::ObtenerCostoUnitarioUnidadMedida($detalle_productos[$i]->codigo_producto);

                $producto = array(
                    'item'                  => $count_items,
                    'codigo'                => $detalle_productos[$i]->codigo_producto,
                    'descripcion'           => $detalle_productos[$i]->descripcion,
                    'porcentaje_igv'        => $porcentaje_igv * 100, //Para registrar el IGV que se consideró para la venta
                    'unidad'                => $costo_unitario['id_unidad_medida'], //$detalle_productos[$i]->unidad_medida,
                    'cantidad'              => $detalle_productos[$i]->cantidad,
                    'costo_unitario' =>     $costo_unitario['costo_unitario'],
                    'valor_unitario'        => round($detalle_productos[$i]->precio, 2), // SIN IGV
                    'precio_unitario'       => round($detalle_productos[$i]->precio * $factor_igv, 2), // CON IGV
                    'valor_total'           => round($detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad, 2),
                    'igv'                   => round($igv_producto, 2),
                    'importe_total'         => round($detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad * $factor_igv, 2),
                    'codigos'               => array($afectacion['letra_tributo'], $afectacion['codigo'], $afectacion['codigo_tributo'], $afectacion['nombre_tributo'], $afectacion['tipo_tributo'])
                );

                array_push($detalle_venta, $producto);

                //CALCULAMOS LOS TOTALES POR TIPO DE OPERACIÓN
                if ($detalle_productos[$i]->id_tipo_igv == 10) {
                    $total_operaciones_gravadas = $total_operaciones_gravadas + $producto['valor_total'];
                }

                if ($detalle_productos[$i]->id_tipo_igv == 20) {
                    $total_operaciones_exoneradas = $total_operaciones_exoneradas + $producto['valor_total'];
                }

                if ($detalle_productos[$i]->id_tipo_igv == 30) {
                    $total_operaciones_inafectas = $total_operaciones_inafectas + $producto['valor_total'];
                }

                $total_igv = $total_igv + $producto['igv'];
            }

            //OBTENER LA SERIE DEL COMPROBANTE
            $serie = VentasModelo::mdlObtenerSerie($datos_comprobante['serie']);

            //DATOS DE LA VENTA:
            $venta['id_empresa_emisora']            = $datos_comprobante["empresa_emisora"];
            $venta['id_cliente']                    = $venta_comprobante_modificado["id_cliente"];
            $venta['tipo_operacion']                = $venta_comprobante_modificado['tipo_operacion'];
            $venta['tipo_comprobante']              = $datos_comprobante["tipo_comprobante"];
            $venta['id_serie']                      = $serie['id'];
            $venta['serie']                         = $serie['serie'];
            $venta['correlativo']                   = intval($serie['correlativo']) + 1;
            $venta['fecha_emision']                 = $datos_comprobante['fecha_emision'];
            $venta['hora_emision']                  = Date('h:m:s');
            $venta['fecha_vencimiento']             = $datos_comprobante['fecha_emision'];
            $venta['moneda']                        = $venta_comprobante_modificado["id_moneda"];
            $venta['forma_pago']                    = $venta_comprobante_modificado["forma_pago"];
            $venta['monto_credito']                 = 0;
            $venta['total_impuestos']               = $total_igv;
            $venta['total_operaciones_gravadas']    = round($total_operaciones_gravadas, 2);
            $venta['total_operaciones_exoneradas']  = round($total_operaciones_exoneradas, 2);
            $venta['total_operaciones_inafectas']   = round($total_operaciones_inafectas, 2);
            $venta['total_igv']                     = round($total_igv, 2);
            $venta['total_sin_impuestos']           = 0.00;
            $venta['total_con_impuestos']           = 0.00;
            $venta['total_a_pagar']                 = round($total_operaciones_gravadas + $total_operaciones_exoneradas + $total_operaciones_inafectas + $total_igv, 2);
            $venta['cuotas']                        = '';

            $venta['tipo_comprobante_modificado']   = $venta_comprobante_modificado['id_tipo_comprobante'];
            $venta['id_serie_modificado']            = $venta_comprobante_modificado['id_serie'];
            $venta['serie_modificado']              = $venta_comprobante_modificado['serie'];
            $venta['correlativo_modificado']        = $venta_comprobante_modificado['correlativo'];
            $venta['motivo_nota_credito']           = $datos_comprobante_modificado['motivo_nota_credito'];
            $venta['descripcion_nota_credito']      = $datos_comprobante_modificado['descripcion_nota_credito'];

            /*****************************************************************************************
            R E G I S T R A R   V E N T A   Y   D E T A L L E   E N   L A   B D
             *****************************************************************************************/
            $id_venta = VentasModelo::mdlRegistrarNotaCredito($venta, $detalle_venta, $venta_comprobante_modificado["id"]);

            /*****************************************************************************************
                    G E N E R A R    C O M P R O B A N T E    E L E C T R Ó N I C O
             *****************************************************************************************/

            // INSTANCIA DE APIFACTURACION
            $generar_comprobante = new ApiFacturacion();

            // RUTA Y NOMBRE DEL ARCHIVO XML:
            $path_xml = "../fe/facturas/xml/";
            $name_xml = $datos_emisor['ruc'] . '-' .
                $venta['tipo_comprobante'] . '-' .
                $venta['serie'] . '-' .
                $venta['correlativo'];

            $resultado = ApiFacturacion::Genera_XML_Nota_Credito($path_xml, $name_xml, $datos_emisor, $datos_cliente, $venta, $detalle_venta);


            /******************************************************************************************/
            // F I R M A R   X M L 
            /******************************************************************************************/
            $response_signature = ApiFacturacion::FirmarXml($path_xml, $name_xml, $datos_emisor);

            if ($response_signature["estado_firma"] == 1) {

                /******************************************************************************************/
                // E N V I A R   C O M P R O B A N T E   A   S U N A T
                /*****************************************************************************************/
                $resultado = ApiFacturacion::EnviarComprobanteElectronico($path_xml, $name_xml, $datos_emisor, '../fe/facturas/cdr/');

                if ($resultado["error"] == 0) {

                    /*****************************************************************************************
                    A C T U A L I Z A R   V E N T A   C O N   R E S P U E S T A   D E   S U N A T
                     *****************************************************************************************/
                    $respuesta = VentasModelo::mdlActualizarRespuestaComprobante(
                        $id_venta,
                        $resultado['nombre_xml'],
                        $response_signature['hash_cpe'],
                        $resultado['codigo_error_sunat'],
                        $resultado['mensaje_respuesta_sunat'],
                        $resultado['estado_respuesta_sunat'],
                        $resultado['xml_base64'],
                        $resultado['xml_cdr_sunat_base64']
                    );

                    $resultado["id_venta"] = $id_venta;
                    $resultado['tipo_msj'] = "success";
                    $resultado['msj'] = 'Se envio a Sunat, ' . $resultado['mensaje_respuesta_sunat'];

                    echo json_encode($resultado);
                }
            } else {
                $respuesta["id_venta"] = $id_venta;
                $respuesta['tipo_msj'] = "error";
                $respuesta['msj'] = $response_signature["mensaje_error_firma"];
                echo json_encode($respuesta);
            }


            break;

        case 'registrar_nota_debito':

            //Datos del comprobante
            $datos_comprobante = [];
            parse_str($_POST['datos_comprobante'], $datos_comprobante);

            //Datos del comprobante modificado
            $datos_comprobante_modificado = [];
            parse_str($_POST['datos_comprobante_modificado'], $datos_comprobante_modificado);

            $datos_emisor = VentasModelo::mdlObtenerDatosEmisor($datos_comprobante["empresa_emisora"]);

            $detalle_productos = json_decode($_POST["productos"]);

            // DATOS DEL COMPROBANTE MODIFICADO:
            $venta_comprobante_modificado = VentasModelo::mdlObtenerDetalleVentaPorComprobante(
                $datos_comprobante_modificado["serie_modificado"],
                $datos_comprobante_modificado["correlativo_modificado"]
            );

            $datos_cliente = VentasModelo::mdlObtenerDatosClientePorId($venta_comprobante_modificado["id_cliente"]);

            $count_items = 0;

            $total_operaciones_gravadas = 0.00;
            $total_operaciones_exoneradas = 0.00;
            $total_operaciones_inafectas = 0.00;
            $total_igv = 0;
            $total_icbper = 0;
            $detalle_venta = array();

            //RECORREMOS EL DETALLE DE LOS PRODUCTOS DE LA VENTA

            for ($i = 0; $i < count($detalle_productos); $i++) {

                $count_items = $count_items + 1;

                $igv_producto = 0; //EN CASO EL PRODUCTO NO TENGA IGV, SE MANTIENE CON EL VALOR = 0
                $factor_igv = 1; //EN CASO EL PRODUCTO NO TENGA IGV, SE MANTIENE CON EL FACTOR = 1

                if ($detalle_productos[$i]->id_tipo_igv == 10) { //SI ES OPERACION GRAVADA = 10
                    $igv = ProductosModelo::mdlObtenerImpuesto($detalle_productos[$i]->id_tipo_igv);
                    $porcentaje_igv = $igv['impuesto'] / 100; //0.18;
                    $factor_igv = 1 + ($igv['impuesto'] / 100);
                    $igv_producto = $detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad * $porcentaje_igv;
                } else $porcentaje_igv = 0.0; // SI ES INAFECTA O EXONERADA

                $total_impuestos_producto = $igv_producto;

                $afectacion = VentasModelo::ObtenerTipoAfectacionIGV($detalle_productos[$i]->id_tipo_igv);
                $costo_unitario = VentasModelo::ObtenerCostoUnitarioUnidadMedida($detalle_productos[$i]->codigo_producto);

                $producto = array(
                    'item'                  => $count_items,
                    'codigo'                => $detalle_productos[$i]->codigo_producto,
                    'descripcion'           => $detalle_productos[$i]->descripcion,
                    'porcentaje_igv'        => $porcentaje_igv * 100, //Para registrar el IGV que se consideró para la venta
                    'unidad'                => $costo_unitario['id_unidad_medida'], //$detalle_productos[$i]->unidad_medida,
                    'cantidad'              => $detalle_productos[$i]->cantidad,
                    'costo_unitario' =>     $costo_unitario['costo_unitario'],
                    'valor_unitario'        => round($detalle_productos[$i]->precio, 2), // SIN IGV
                    'precio_unitario'       => round($detalle_productos[$i]->precio * $factor_igv, 2), // CON IGV
                    'valor_total'           => round($detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad, 2),
                    'igv'                   => round($igv_producto, 2),
                    'importe_total'         => round($detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad * $factor_igv, 2),
                    'codigos'               => array($afectacion['letra_tributo'], $afectacion['codigo'], $afectacion['codigo_tributo'], $afectacion['nombre_tributo'], $afectacion['tipo_tributo'])
                );

                array_push($detalle_venta, $producto);

                //CALCULAMOS LOS TOTALES POR TIPO DE OPERACIÓN
                if ($detalle_productos[$i]->id_tipo_igv == 10) {
                    $total_operaciones_gravadas = $total_operaciones_gravadas + $producto['valor_total'];
                }

                if ($detalle_productos[$i]->id_tipo_igv == 20) {
                    $total_operaciones_exoneradas = $total_operaciones_exoneradas + $producto['valor_total'];
                }

                if ($detalle_productos[$i]->id_tipo_igv == 30) {
                    $total_operaciones_inafectas = $total_operaciones_inafectas + $producto['valor_total'];
                }

                $total_igv = $total_igv + $producto['igv'];
            }

            //OBTENER LA SERIE DEL COMPROBANTE
            $serie = VentasModelo::mdlObtenerSerie($datos_comprobante['serie']);

            //DATOS DE LA VENTA:
            $venta['id_empresa_emisora']            = $datos_comprobante["empresa_emisora"];
            $venta['id_cliente']                    = $venta_comprobante_modificado["id_cliente"];
            $venta['tipo_operacion']                = $venta_comprobante_modificado['tipo_operacion'];
            $venta['tipo_comprobante']              = $datos_comprobante["tipo_comprobante"];
            $venta['id_serie']                      = $serie['id'];
            $venta['serie']                         = $serie['serie'];
            $venta['correlativo']                   = intval($serie['correlativo']) + 1;
            $venta['fecha_emision']                 = $datos_comprobante['fecha_emision'];
            $venta['hora_emision']                  = Date('h:m:s');
            $venta['fecha_vencimiento']             = $datos_comprobante['fecha_emision'];
            $venta['moneda']                        = $venta_comprobante_modificado["id_moneda"];
            $venta['forma_pago']                    = $venta_comprobante_modificado["forma_pago"];
            $venta['monto_credito']                 = 0;
            $venta['total_impuestos']               = $total_igv;
            $venta['total_operaciones_gravadas']    = round($total_operaciones_gravadas, 2);
            $venta['total_operaciones_exoneradas']  = round($total_operaciones_exoneradas, 2);
            $venta['total_operaciones_inafectas']   = round($total_operaciones_inafectas, 2);
            $venta['total_igv']                     = round($total_igv, 2);
            $venta['total_sin_impuestos']           = 0.00;
            $venta['total_con_impuestos']           = 0.00;
            $venta['total_a_pagar']                 = round($total_operaciones_gravadas + $total_operaciones_exoneradas + $total_operaciones_inafectas + $total_igv, 2);
            $venta['cuotas']                        = '';

            $venta['tipo_comprobante_modificado']   = $venta_comprobante_modificado['id_tipo_comprobante'];
            $venta['id_serie_modificado']           = $venta_comprobante_modificado['id_serie'];
            $venta['serie_modificado']              = $venta_comprobante_modificado['serie'];
            $venta['correlativo_modificado']        = $venta_comprobante_modificado['correlativo'];
            $venta['motivo_nota_debito']           = $datos_comprobante_modificado['motivo_nota_debito'];
            $venta['descripcion_nota_debito']      = $datos_comprobante_modificado['descripcion_nota_debito'];

            /*****************************************************************************************
            R E G I S T R A R   V E N T A   Y   D E T A L L E   E N   L A   B D
             *****************************************************************************************/
            $id_venta = VentasModelo::mdlRegistrarNotaDebito($venta, $detalle_venta, $venta_comprobante_modificado["id"]);

            /*****************************************************************************************
            G E N E R A R    C O M P R O B A N T E    E L E C T R Ó N I C O
             *****************************************************************************************/

            // INSTANCIA DE APIFACTURACION
            $generar_comprobante = new ApiFacturacion();

            // RUTA Y NOMBRE DEL ARCHIVO XML:
            $path_xml = "../fe/facturas/xml/";
            $name_xml = $datos_emisor['ruc'] . '-' .
                $venta['tipo_comprobante'] . '-' .
                $venta['serie'] . '-' .
                $venta['correlativo'];

            $resultado = ApiFacturacion::Genera_XML_Nota_Debito($path_xml, $name_xml, $datos_emisor, $datos_cliente, $venta, $detalle_venta);


            /******************************************************************************************/
            // F I R M A R   X M L 
            /******************************************************************************************/
            $response_signature = ApiFacturacion::FirmarXml($path_xml, $name_xml, $datos_emisor);

            if ($response_signature["estado_firma"] == 1) {

                /******************************************************************************************/
                // E N V I A R   C O M P R O B A N T E   A   S U N A T
                /*****************************************************************************************/
                $resultado = ApiFacturacion::EnviarComprobanteElectronico($path_xml, $name_xml, $datos_emisor, '../fe/facturas/cdr/');

                if ($resultado["error"] == 0) {

                    /*****************************************************************************************
                        A C T U A L I Z A R   V E N T A   C O N   R E S P U E S T A   D E   S U N A T
                     *****************************************************************************************/
                    $respuesta = VentasModelo::mdlActualizarRespuestaComprobante(
                        $id_venta,
                        $resultado['nombre_xml'],
                        $response_signature['hash_cpe'],
                        $resultado['codigo_error_sunat'],
                        $resultado['mensaje_respuesta_sunat'],
                        $resultado['estado_respuesta_sunat'],
                        $resultado['xml_base64'],
                        $resultado['xml_cdr_sunat_base64']
                    );

                    $resultado["id_venta"] = $id_venta;
                    $resultado['tipo_msj'] = "success";
                    $resultado['msj'] = 'Se envio a Sunat, ' . $resultado['mensaje_respuesta_sunat'];

                    echo json_encode($resultado);
                }
            } else {
                $respuesta["id_venta"] = $id_venta;
                $respuesta['tipo_msj'] = "error";
                $respuesta['msj'] = $response_signature["mensaje_error_firma"];
                echo json_encode($respuesta);
            }


            break;

        case 'obtener_ventas':

            $response = VentasModelo::mdlListarVentas($_POST["fechaDesde"], $_POST["fechaHasta"]);

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

            break;

        case 'obtener_tipo_comprobante':

            $response = VentasModelo::mdlObtenerTipoComprobante();

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

            break;

        case 'obtener_serie_comprobante':

            $response = VentasModelo::mdlObtenerSerieComprobante($_POST["id_filtro"]);

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

            break;



        case 'obtener_tipo_documento':

            $response = VentasModelo::mdlObtenerTipoDocumento();

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

            break;

        case 'obtener_forma_pago':

            $response = VentasModelo::mdlObtenerFormaPago();

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

            break;

        case 'obtener_medio_pago':

            $response = VentasModelo::mdlObtenerMedioPago();

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

            break;

        case 'obtener_correlativo_serie':

            $response = VentasModelo::mdlObtenerCorrelativoSerie($_POST["id_serie"]);

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

            break;

        case 'obtener_tipo_operacion':

            $response = VentasModelo::mdlObtenerTipoOperacion();

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

            break;

        case 'obtener_listado_boletas':

            $response = VentasModelo::mdlObtenerListadoBoletas($_POST);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;

        case 'obtener_listado_boletas_x_fecha':

            $response = VentasModelo::mdlObtenerListadoBoletasPorFecha($_POST, $_POST["fecha_emision"], $_POST["id_empresa"]);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;

        case 'obtener_listado_facturas':

            $response = VentasModelo::mdlObtenerListadoFacturas($_POST);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;

        case 'obtener_listado_notas_venta':

            $response = VentasModelo::mdlObtenerListadoNotasVenta($_POST);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;


        case 'obtener_listado_notas_credito':

            $response = VentasModelo::mdlObtenerListadoNotasCredito($_POST);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;

        case 'obtener_listado_notas_debito':

            $response = VentasModelo::mdlObtenerListadoNotasDebito($_POST);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;

        case 'enviar_comprobante_sunat':

            // VENTA:
            $venta = VentasModelo::mdlObtenerVentaPorIdXml($_POST["id_venta"]);

            // DATOS DEL EMISOR:
            $datos_emisor = VentasModelo::mdlObtenerDatosEmisor($venta["id_empresa"]);

            // DATOS DEL CLIENTE:
            $datos_cliente = VentasModelo::mdlObtenerDatosClienteXml($venta["id_cliente"]);;

            // DETALLE DE LA VENTA:
            $detalle = VentasModelo::mdlObtenerDetalleVentaPorIdXml($_POST["id_venta"]);

            $monto_credito = 0;
            $cuotas = array();

            if ($venta["forma_pago"] == "Credito") {

                $cronograma = VentasModelo::mdlObtenerCuotas($_POST["id_venta"]);

                for ($i = 0; $i < count($cronograma); $i++) {

                    $cuotas[] = array(
                        "cuota" => $cronograma[$i]["cuota"],
                        "importe" => round($cronograma[$i]["importe"], 2),
                        "vencimiento" => $cronograma[$i]["fecha_vencimiento"]
                    );
                }
            }
            // $venta['monto_credito'] = $cuotas;
            $venta['cuotas'] = $cuotas;

            $detalle_venta = array();
            $count_items = 1;
            foreach ($detalle as $detalle_producto) {

                $afectacion = VentasModelo::ObtenerTipoAfectacionIGV($detalle_producto["id_tipo_afectacion_igv"]);

                $producto = array(
                    'item'                  => $count_items,
                    'codigo'                => $detalle_producto["codigo_producto"],
                    'descripcion'           => $detalle_producto["descripcion"],
                    'porcentaje_igv'        => $detalle_producto["porcentaje_igv"],
                    'unidad'                => $detalle_producto["unidad"],
                    'cantidad'              => $detalle_producto["cantidad"],
                    'costo_unitario'        => $detalle_producto["costo_unitario"],
                    'valor_unitario'        => $detalle_producto["valor_unitario"],
                    'precio_unitario'       => $detalle_producto["precio_unitario"],
                    'valor_total'           => $detalle_producto["valor_total"],
                    'igv'                   => $detalle_producto["igv"],
                    'importe_total'         => $detalle_producto["importe_total"],
                    'codigos'               => array($afectacion['letra_tributo'], $afectacion['codigo'], $afectacion['codigo_tributo'], $afectacion['nombre_tributo'], $afectacion['tipo_tributo'])
                );

                $count_items = $count_items + 1;
                array_push($detalle_venta, $producto);
            }

            /******************************************************************************************/
            // G E N E R A R    C O M P R O B A N T E    E L E C T R Ó N I C O ( X M L )
            /******************************************************************************************/

            //INSTANCIA DE APIFACTURACION
            $generar_comprobante = new ApiFacturacion();

            //RUTA Y NOMBRE DEL ARCHIVO XML:
            $path_xml = "../fe/facturas/xml/";
            $name_xml = $datos_emisor['ruc'] . '-' .
                $venta['tipo_comprobante'] . '-' .
                $venta['serie'] . '-' .
                $venta['correlativo'];

            $resultado = ApiFacturacion::Genera_XML_Factura_Boleta($path_xml, $name_xml, $datos_emisor, $datos_cliente, $venta, $detalle_venta);


            /******************************************************************************************/
            // F I R M A R   X M L 
            /******************************************************************************************/
            $response_signature = ApiFacturacion::FirmarXml($path_xml, $name_xml, $datos_emisor);

            if ($response_signature["estado_firma"] == 1) {

                /******************************************************************************************/
                // E N V I A R   C O M P R O B A N T E   A   S U N A T
                /*****************************************************************************************/
                $resultado = ApiFacturacion::EnviarComprobanteElectronico($path_xml, $name_xml, $datos_emisor, '../fe/facturas/cdr/');

                // var_dump($resultado);
                // return;
                if ($resultado["error"] == 0) {

                    /******************************************************************************************/
                    // A C T U A L I Z A R   V E N T A   C O N   R E S P U E S T A   D E   S U N A T
                    /******************************************************************************************/
                    $respuesta = VentasModelo::mdlActualizarRespuestaComprobante(
                        $_POST["id_venta"],
                        $resultado['nombre_xml'],
                        $response_signature['hash_cpe'],
                        $resultado['codigo_error_sunat'],
                        $resultado['mensaje_respuesta_sunat'],
                        $resultado['estado_respuesta_sunat'],
                        $resultado['xml_base64'],
                        $resultado['xml_cdr_sunat_base64']
                    );


                    $resultado["id_venta"] =  $_POST["id_venta"];
                    $resultado['tipo_msj'] = "success";
                    $resultado['msj'] = 'Se envio a Sunat, ' . $resultado['mensaje_respuesta_sunat'];
                    echo json_encode($resultado);
                } else {

                    $respuesta = VentasModelo::mdlActualizarRespuestaComprobante(
                        $_POST["id_venta"],
                        $resultado['nombre_xml'],
                        $response_signature['hash_cpe'],
                        $resultado['codigo_error_sunat'],
                        $resultado['mensaje_respuesta_sunat'],
                        $resultado['estado_respuesta_sunat'],
                        $resultado['xml_base64'],
                        $resultado['xml_cdr_sunat_base64']
                    );



                    $response["id_venta"] = $_POST["id_venta"];
                    $response['tipo_msj'] = "error";
                    $response['msj'] = 'Rechazado por SUNAT, se envió con errores,' . $resultado['mensaje_respuesta_sunat'];

                    // var_dump($response);
                    // return;

                    echo json_encode($response);
                }
            } else {
                $respuesta["id_venta"] =  $_POST["id_venta"];
                $respuesta['tipo_msj'] = "error";
                $respuesta['msj'] = $response_signature["mensaje_error_firma"];
                echo json_encode($respuesta);
            }

            break;

        case 'enviar_resumen_comprobantes':

            $comprobantes = [];
            parse_str($_POST['ventas'], $comprobantes);

            //CAPTURAMOS DATOS:
            $datos_emisor = VentasModelo::mdlObtenerDatosEmisor($_POST["empresa_emisora"]);

            $fecha_emision = $_POST['fecha_emision'];

            $serie = str_replace("-", "", $fecha_emision);

            $correlativo = VentasModelo::mdlObtenerCorrelativoResumen(date('Y-m-d'), 1, 0);

            $comprobante = array(
                "tipo_comprobante"  => "RC",
                "serie"             => $serie,
                "correlativo"       => $correlativo,
                "fecha_emision"     => $fecha_emision,
                "fecha_envio"       => date('Y-m-d'),
                "resumen"           => 1,
                "baja"              => 0,
                "estado"            => 0
            );

            $resumen_comprobante = array();

            for ($i = 0; $i < count($comprobantes["id"]); $i++) {

                $boleta = VentasModelo::mdlObtenerVentaParaResumen($comprobantes["id"][$i]);

                $resumen_comprobante[] = array(
                    "item"                => $i + 1,
                    "tipo_comprobante"    => $boleta['id_tipo_comprobante'],
                    "serie"                => $boleta['serie'],
                    "correlativo"        => $boleta['correlativo'],
                    "condicion"            => $_POST['condicion'], // 1:Registrar, 2:Actualizar, 3:Dar de Baja
                    "moneda"            => $boleta['id_moneda'],
                    "importe_total"        => floatval($boleta['importe_total']),
                    "ope_gravadas"        => floatval($boleta['total_operaciones_gravadas']),
                    "ope_exoneradas"    => floatval($boleta['total_operaciones_exoneradas']),
                    "ope_inafectas"        => floatval($boleta['total_operaciones_inafectas']),
                    "igv_total"            => floatval($boleta['total_igv']),
                    "total_impuestos"    => floatval($boleta['total_igv']),
                    "id_comprobante"    => $comprobantes["id"][$i]
                );
            }

            /*****************************************************************************************
            R E G I S T R A R   R E S U M E N  -- C A B E C E R A   Y   D E T A L L E --
             *****************************************************************************************/
            $id_resumen = VentasModelo::mdlInsertarResumen($comprobante, $resumen_comprobante);


            /*****************************************************************************************
            C R E A R   X M L   D E L   R E S U M E N   D E   C O M P R O B A N T E S
             *****************************************************************************************/
            $path_xml = "../fe/facturas/xml/";
            $name_xml = $datos_emisor['ruc'] . '-' .
                $comprobante['tipo_comprobante'] . '-' .
                $comprobante['serie'] . '-' .
                $comprobante['correlativo'];

            $resultado = ApiFacturacion::CrearXMLResumenDocumentos($path_xml, $name_xml, $datos_emisor, $comprobante, $resumen_comprobante);


            /*****************************************************************************************
            E N V I A R   R E S U M E N   D E   C O M P R O B A N T E S   A   S U N A T
             *****************************************************************************************/
            $ticket = ApiFacturacion::EnviarResumenComprobantes($path_xml, $name_xml, $datos_emisor, '../fe/facturas/cdr/');


            /*****************************************************************************************
            C O N S U L T A R   T I C K E T
             *****************************************************************************************/
            $resultado = ApiFacturacion::ConsultarTicket($datos_emisor, $comprobante, $ticket, "../fe/facturas/cdr/");

            $actualizacion_resumen = VentasModelo::mdlActualizarRespuestaResumen(
                $id_resumen,
                $name_xml,
                $resultado["mensaje_sunat"],
                $resultado["codigo_sunat"],
                $ticket,
                $resultado["estado"],
                $resumen_comprobante
            );


            $resultado["tipo_msj"] =  $resultado["estado"] = 1 ? 'success' : 'error';
            $resultado["msj"] =  $resultado["mensaje_sunat"];
            $resultado["actualizacion_resumen"] =  $actualizacion_resumen;
            echo json_encode($resultado);
            break;

        case 'anular_boleta':

            $venta = VentasModelo::mdlObtenerVentaPorId($_POST["id_venta"]);
            //CAPTURAMOS DATOS:
            $datos_emisor = VentasModelo::mdlObtenerDatosEmisor($venta["id_empresa"]);

            $fecha_emision = $_POST['fecha_emision'];

            $fecha1 = new DateTime($fecha_emision);
            $fecha2 = new DateTime(date('Y-m-d'));

            $diff = $fecha1->diff($fecha2);

            if ($diff->days > 7) {
                $respuesta["tipo_msj"] = "error";
                $respuesta["msj"] = "El comprobante no se puede anular, hasta 7días despues de la emisión";

                echo json_encode($respuesta);
                return;
            }

            $serie = str_replace("-", "", $fecha_emision);

            $correlativo = VentasModelo::mdlObtenerCorrelativoResumen(date('Y-m-d'), 1, 0);

            $comprobante = array(
                "tipo_comprobante"  => "RC",
                "serie"             => $serie,
                "correlativo"       => $correlativo,
                "fecha_emision"     => $fecha_emision,
                "fecha_envio"       => date('Y-m-d'),
                "resumen"           => 1,
                "baja"              => 0,
                "estado"            => 0
            );

            $resumen_comprobante = array();

            $boleta = VentasModelo::mdlObtenerVentaParaResumen($_POST["id_venta"]);

            $resumen_comprobante[] = array(
                "item"                => 1,
                "tipo_comprobante"    => $boleta['id_tipo_comprobante'],
                "serie"                => $boleta['serie'],
                "correlativo"        => $boleta['correlativo'],
                "condicion"            => $_POST['condicion'], // 1:Registrar, 2:Actualizar, 3:Dar de Baja
                "moneda"            => $boleta['id_moneda'],
                "importe_total"        => floatval($boleta['importe_total']),
                "ope_gravadas"        => floatval($boleta['total_operaciones_gravadas']),
                "ope_exoneradas"    => floatval($boleta['total_operaciones_exoneradas']),
                "ope_inafectas"        => floatval($boleta['total_operaciones_inafectas']),
                "igv_total"            => floatval($boleta['total_igv']),
                "total_impuestos"    => floatval($boleta['total_igv']),
                "id_comprobante"    => $_POST["id_venta"]
            );


            /*****************************************************************************************
            R E G I S T R A R   R E S U M E N  -- C A B E C E R A   Y   D E T A L L E --
             *****************************************************************************************/
            $id_resumen = VentasModelo::mdlInsertarResumen($comprobante, $resumen_comprobante);

            /*****************************************************************************************
            C R E A R   X M L   D E L   R E S U M E N   D E   C O M P R O B A N T E S
             *****************************************************************************************/
            $path_xml = "../fe/facturas/xml/";
            $name_xml = $datos_emisor['ruc'] . '-' . $comprobante['tipo_comprobante'] . '-' . $comprobante['serie'] . '-' . $comprobante['correlativo'];

            $resultado = ApiFacturacion::CrearXMLResumenDocumentos($path_xml, $name_xml, $datos_emisor, $comprobante, $resumen_comprobante);


            /*****************************************************************************************
            E N V I A R   R E S U M E N   D E   C O M P R O B A N T E S   A   S U N A T
             *****************************************************************************************/
            $ticket = ApiFacturacion::EnviarResumenComprobantes($path_xml, $name_xml, $datos_emisor, '../fe/facturas/cdr/');


            /*****************************************************************************************
            C O N S U L T A R   T I C K E T
             *****************************************************************************************/
            $resultado = ApiFacturacion::ConsultarTicket($datos_emisor, $comprobante, $ticket, "../fe/facturas/cdr/");

            // ($id_resumen, $name_xml, $mensaje_sunat, $codigo_sunat, $ticket, $estado);
            $actualizacion_resumen = VentasModelo::mdlActualizarRespuestaResumenAnulacion(
                $id_resumen,
                $name_xml,
                $resultado["mensaje_sunat"],
                $resultado["codigo_sunat"],
                $ticket,
                $resultado["estado"],
                $resumen_comprobante
            );

            $resultado["tipo_msj"] =  $resultado["estado"] = 1 ? 'success' : 'error';
            $resultado["msj"] =  $resultado["mensaje_sunat"];
            $resultado["actualizacion_resumen"] =  $actualizacion_resumen;
            echo json_encode($resultado);
            break;

        case 'anular_nota_venta':

            $venta = VentasModelo::mdlObtenerDetalleVentaPorId($_POST["id_venta"]);

            /*****************************************************************************************
            
             *****************************************************************************************/
            $response = VentasModelo::mdlAnularNotaVenta($_POST["id_venta"], $venta);

            echo json_encode($response);
            break;

        case "facturas_x_cobrar":

            $response = VentasModelo::mdlObtenerFacturasPorCobrar($_POST);

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

            break;

        case "obtener_cuotas_x_id_venta":

            $response = VentasModelo::mdlObtenerCuotasPorIdVenta($_POST["id_venta"]);

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

            break;

        case "pagar_cuota":

            $response = VentasModelo::mdlPagarCuotas($_POST["id_venta"], $_POST["monto_a_pagar"], $_POST["medio_pago"]);

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

            break;

        case 'obtener_detalle_venta':

            $response = VentasModelo::mdlObtenerVentaPorComprobante($_POST["id_serie"], $_POST["correlativo"]);

            echo json_encode($response, JSON_NUMERIC_CHECK);

            break;


        case "reporte_ventas":

            $response = VentasModelo::mdlReporteVentas($_POST["fecha_desde"], $_POST["fecha_hasta"]);

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

            break;

        case "enviar_email_comprobante":

            $response = VentasModelo::mdlEnviarComprobanteEmail(
                $_POST['id_venta'],
                $_POST["email_destino"]
            );
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;

        case 'regisrar_cotizacion':

            //Datos del comprobante
            $datos_cotizacion = [];
            parse_str($_POST['datos_cotizacion'], $datos_cotizacion);
            $detalle_productos = json_decode($_POST["productos"]);


            $datos_cliente = VentasModelo::mdlObtenerDatosCliente(
                $datos_cotizacion['tipo_documento'],
                $datos_cotizacion['nro_documento'],
                $datos_cotizacion['nombre_cliente_razon_social'],
                $datos_cotizacion['direccion'],
                $datos_cotizacion['telefono']
            );

            $count_items = 0;

            $total_operaciones_gravadas = 0.00;
            $total_operaciones_exoneradas = 0.00;
            $total_operaciones_inafectas = 0.00;
            $total_igv = 0;
            $total_icbper = 0;
            $detalle_venta = array();

            //RECORREMOS EL DETALLE DE LOS PRODUCTOS DE LA VENTA

            for ($i = 0; $i < count($detalle_productos); $i++) {

                $count_items = $count_items + 1;

                $igv_producto = 0; //EN CASO EL PRODUCTO NO TENGA IGV, SE MANTIENE CON EL VALOR = 0
                $factor_igv = 1; //EN CASO EL PRODUCTO NO TENGA IGV, SE MANTIENE CON EL FACTOR = 1

                if ($detalle_productos[$i]->id_tipo_igv == 10) { //SI ES OPERACION GRAVADA = 10
                    $igv = ProductosModelo::mdlObtenerImpuesto($detalle_productos[$i]->id_tipo_igv);
                    $porcentaje_igv = $igv['impuesto'] / 100; //0.18;
                    $factor_igv = 1 + ($igv['impuesto'] / 100);
                    $igv_producto = $detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad * $porcentaje_igv;
                } else $porcentaje_igv = 0.0; // SI ES INAFECTA O EXONERADA

                $total_impuestos_producto = $igv_producto;

                $afectacion = VentasModelo::ObtenerTipoAfectacionIGV($detalle_productos[$i]->id_tipo_igv);
                $costo_unitario = VentasModelo::ObtenerCostoUnitarioUnidadMedida($detalle_productos[$i]->codigo_producto);

                $producto = array(
                    'item'                  => $count_items,
                    'codigo'                => $detalle_productos[$i]->codigo_producto,
                    'descripcion'           => $detalle_productos[$i]->descripcion,
                    'porcentaje_igv'        => $porcentaje_igv * 100, //Para registrar el IGV que se consideró para la venta
                    'unidad'                => $costo_unitario['id_unidad_medida'], //$detalle_productos[$i]->unidad_medida,
                    'cantidad'              => $detalle_productos[$i]->cantidad,
                    'costo_unitario' =>     $costo_unitario['costo_unitario'],
                    'valor_unitario'        => round($detalle_productos[$i]->precio, 2), // SIN IGV
                    'precio_unitario'       => round($detalle_productos[$i]->precio * $factor_igv, 2), // CON IGV
                    'valor_total'           => round($detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad, 2),
                    'igv'                   => round($igv_producto, 2),
                    'importe_total'         => round($detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad * $factor_igv, 2),
                    'codigos'               => array($afectacion['letra_tributo'], $afectacion['codigo'], $afectacion['codigo_tributo'], $afectacion['nombre_tributo'], $afectacion['tipo_tributo'])
                );

                array_push($detalle_venta, $producto);

                //CALCULAMOS LOS TOTALES POR TIPO DE OPERACIÓN
                if ($detalle_productos[$i]->id_tipo_igv == 10) {
                    $total_operaciones_gravadas = $total_operaciones_gravadas + $producto['valor_total'];
                }

                if ($detalle_productos[$i]->id_tipo_igv == 20) {
                    $total_operaciones_exoneradas = $total_operaciones_exoneradas + $producto['valor_total'];
                }

                if ($detalle_productos[$i]->id_tipo_igv == 30) {
                    $total_operaciones_inafectas = $total_operaciones_inafectas + $producto['valor_total'];
                }

                $total_igv = $total_igv + $producto['igv'];
            }

            //OBTENER LA SERIE DEL COMPROBANTE
            $serie = VentasModelo::mdlObtenerSerie($datos_comprobante['serie']);

            //DATOS DE LA VENTA:
            $venta['id_empresa_emisora']            = $datos_comprobante["empresa_emisora"];
            $venta['id_cliente']                    = $venta_comprobante_modificado["id_cliente"];
            $venta['tipo_operacion']                = $venta_comprobante_modificado['tipo_operacion'];
            $venta['tipo_comprobante']              = $datos_comprobante["tipo_comprobante"];
            $venta['id_serie']                      = $serie['id'];
            $venta['serie']                         = $serie['serie'];
            $venta['correlativo']                   = intval($serie['correlativo']) + 1;
            $venta['fecha_emision']                 = $datos_comprobante['fecha_emision'];
            $venta['hora_emision']                  = Date('h:m:s');
            $venta['fecha_vencimiento']             = $datos_comprobante['fecha_emision'];
            $venta['moneda']                        = $venta_comprobante_modificado["id_moneda"];
            $venta['forma_pago']                    = $venta_comprobante_modificado["forma_pago"];
            $venta['monto_credito']                 = 0;
            $venta['total_impuestos']               = $total_igv;
            $venta['total_operaciones_gravadas']    = round($total_operaciones_gravadas, 2);
            $venta['total_operaciones_exoneradas']  = round($total_operaciones_exoneradas, 2);
            $venta['total_operaciones_inafectas']   = round($total_operaciones_inafectas, 2);
            $venta['total_igv']                     = round($total_igv, 2);
            $venta['total_sin_impuestos']           = 0.00;
            $venta['total_con_impuestos']           = 0.00;
            $venta['total_a_pagar']                 = round($total_operaciones_gravadas + $total_operaciones_exoneradas + $total_operaciones_inafectas + $total_igv, 2);
            $venta['cuotas']                        = '';

            $venta['tipo_comprobante_modificado']   = $venta_comprobante_modificado['id_tipo_comprobante'];
            $venta['id_serie_modificado']            = $venta_comprobante_modificado['id_serie'];
            $venta['serie_modificado']              = $venta_comprobante_modificado['serie'];
            $venta['correlativo_modificado']        = $venta_comprobante_modificado['correlativo'];
            $venta['motivo_nota_credito']           = $datos_comprobante_modificado['motivo_nota_credito'];
            $venta['descripcion_nota_credito']      = $datos_comprobante_modificado['descripcion_nota_credito'];

            /*****************************************************************************************
             R E G I S T R A R   V E N T A   Y   D E T A L L E   E N   L A   B D
             *****************************************************************************************/
            $id_cotizacion = VentasModelo::mdlRegistrarNotaCredito($venta, $detalle_venta, $venta_comprobante_modificado["id"]);

            break;

        case "generar_guia_remision_remitente":

            // Datos del comprobante
            $formulario_guia_remision = [];
            parse_str($_POST['datos_guia_remision_remitente'], $formulario_guia_remision);

            // Obtener Destinatario
            $cliente = ClientesModelo::mdlObtenerClientePorNroDocumento(explode("-", $formulario_guia_remision["cliente"])[0]);

            // Obtener Empresa
            $empresa = EmpresasModelo::mdlObtenerEmpresaPrincipal();

            // Obtener Serie y Correlativo del Comprobante
            $serie = VentasModelo::mdlObtenerSerie($formulario_guia_remision['serie']);

            // Obtener Productos de la Guia
            $detalle_productos = json_decode($_POST["productos"]);

            $detalle_choferes = json_decode($_POST["choferes"]);

            $productos = [];

            for ($i = 0; $i < count($detalle_productos); $i++) {

                $productos[] = [
                    'cantidad' => $detalle_productos[$i]->cantidad,
                    'unidad' => ProductosModelo::mdlBuscarIdUnidadMedida($detalle_productos[$i]->unidad_medida)['id'],
                    'descripcion' => $detalle_productos[$i]->descripcion,
                    'codigo' => $detalle_productos[$i]->codigo_producto
                ];
            }

            $choferes = [];

            for ($i = 0; $i < count($detalle_choferes); $i++) {

                $choferes[] = [
                    'item' => $detalle_choferes[$i]->item,
                    'tipoDoc' => $detalle_choferes[$i]->id_tipo_documento,
                    'nroDoc' => $detalle_choferes[$i]->nro_documento,
                    'licencia' => $detalle_choferes[$i]->licencia,
                    'nombres' => $detalle_choferes[$i]->nombres,
                    'apellidos' => $detalle_choferes[$i]->apellidos
                ];
            }

            $vehiculos = [];

            for ($i = 0; $i < count($detalle_choferes); $i++) {

                $vehiculos[] = [
                    'item' => $detalle_choferes[$i]->item,
                    'placa' => $detalle_choferes[$i]->placa
                ];
            }

            $guia_remision_remitente = [];

            $guia_remision_remitente = [
                'version' => '2022',
                'tipo_doc' => $formulario_guia_remision["tipo_comprobante"],
                'serie' => $serie["serie"],
                'correlativo' => $serie["correlativo"] + 1,
                'fechaEmision' => $formulario_guia_remision["fecha_emision"],
                'company' => [
                    'ruc' => $empresa["ruc"],
                    'razonSocial' => $empresa["razon_social"],
                    'nombreComercial' => $empresa["nombre_comercial"],
                    'address' => [
                        'ubigeo' => $empresa["ubigeo"],
                        'departamento' => $empresa["departamento"],
                        'provincia' => $empresa["provincia"],
                        'distrito' => $empresa["distrito"],
                        'urbanizacion' => '-',
                        'direccion' => $empresa["direccion"],
                        'codLocal' => '0000'
                    ]
                ],
                'relDocs' => [
                    'relDoc' => [
                        'tipoDoc' => $formulario_guia_remision["tipo_comprobante_rel"],
                        'nroDoc' => strtoupper($formulario_guia_remision["serie_rel"] . '-' . $formulario_guia_remision["correlativo_rel"])
                    ]
                ],
                'destinatario' => [
                    'tipoDoc' => $cliente["id_tipo_documento"],
                    'numDoc' => $cliente["nro_documento"],
                    'rznSocial' => $cliente["razonSocial"]
                ],
                'envio' => [
                    'codTraslado' => $formulario_guia_remision["motivo_traslado"],
                    'modTraslado' => $formulario_guia_remision["modalidad_traslado"],
                    'fecTraslado' => $formulario_guia_remision["fecha_traslado"],
                    'pesoTotal' => $formulario_guia_remision["peso_bruto_total"],
                    'undPesoTotal' => $formulario_guia_remision["peso_unidad_medida"],
                    'numBultos' => $formulario_guia_remision["numero_bultos"],
                    'llegada' => [
                        'ubigeo' => explode(' - ', $formulario_guia_remision["ubigeo_llegada"])[0],
                        'direccion' => $formulario_guia_remision["direccion_llegada"],
                    ],
                    'partida' => [
                        'ubigeo' => explode(' - ', $formulario_guia_remision["ubigeo_partida"])[0],
                        'direccion' => $formulario_guia_remision["direccion_partida"],
                    ],
                    'transportista' => [
                        'tipoDoc' => $formulario_guia_remision["tipo_documento_transportista"] ?? null,
                        'numDoc' => $formulario_guia_remision["nro_documento_transportista"] ?? null,
                        'rznSocial' => $formulario_guia_remision["nombre_transportista"] ?? null,
                        'nroMtc' => $formulario_guia_remision["nro_mtc"] ?? null,
                    ],
                    'choferes' => $choferes ?? null,
                    'vehiculos' => $vehiculos ?? null
                ],
                'details' => $productos,
                'observaciones' => $formulario_guia_remision["observaciones"],
            ];

            $id_guia = VentasModelo::mdlGuardarGuiaRemisionRemitente($guia_remision_remitente);


            $response = ApiGuiaRemision::enviarGuia(json_encode($guia_remision_remitente), $id_guia);


            if (isset($response['sunatResponse']['error'])) {
                $estado_sunat = $response['sunatResponse']['error']['code'];
                $mensaje_error_sunat = $response['sunatResponse']['error']['message'];
            } else {
                $estado_sunat = $response['sunatResponse']['cdrResponse']['code'];
                $mensaje_error_sunat = "";
            }

            $xml_base64 = base64_encode($response['xml']);

            $actualizacion_guia = VentasModelo::mdlActualizarEstadoGuiaRemision($id_guia, $estado_sunat, $xml_base64, $mensaje_error_sunat);

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

            break;

        case "generar_guia_remision_transportista":

            // Datos del comprobante
            $formulario_guia_remision = [];
            parse_str($_POST['datos_guia_remision_transportista'], $formulario_guia_remision);

            // Obtener Destinatario
            $cliente = ClientesModelo::mdlObtenerClientePorNroDocumento(explode("-", $formulario_guia_remision["cliente"])[0]);

            $tercero = ClientesModelo::mdlObtenerClientePorNroDocumento(explode("-", $formulario_guia_remision["nro_documento_destinatario"])[0]);

            // Obtener Empresa
            $empresa = EmpresasModelo::mdlObtenerEmpresaPrincipal();

            // Obtener Serie y Correlativo del Comprobante
            $serie = VentasModelo::mdlObtenerSerie($formulario_guia_remision['serie']);

            // Obtener Productos de la Guia
            $detalle_productos = json_decode($_POST["productos"]);

            $detalle_choferes = json_decode($_POST["choferes"]);

            $productos = [];

            for ($i = 0; $i < count($detalle_productos); $i++) {

                $productos[] = [
                    'cantidad' => $detalle_productos[$i]->cantidad,
                    'unidad' => ProductosModelo::mdlBuscarIdUnidadMedida($detalle_productos[$i]->unidad_medida)['id'],
                    'descripcion' => $detalle_productos[$i]->descripcion,
                    'codigo' => $detalle_productos[$i]->codigo_producto
                ];
            }

            $choferes = [];

            for ($i = 0; $i < count($detalle_choferes); $i++) {

                $choferes[] = [
                    'item' => $detalle_choferes[$i]->item,
                    'tipoDoc' => $detalle_choferes[$i]->id_tipo_documento,
                    'nroDoc' => $detalle_choferes[$i]->nro_documento,
                    'licencia' => $detalle_choferes[$i]->licencia,
                    'nombres' => $detalle_choferes[$i]->nombres,
                    'apellidos' => $detalle_choferes[$i]->apellidos
                ];
            }

            $vehiculos = [];

            for ($i = 0; $i < count($detalle_choferes); $i++) {

                $vehiculos[] = [
                    'item' => $detalle_choferes[$i]->item,
                    'placa' => $detalle_choferes[$i]->placa
                ];
            }

            $guia_remision_transportista = [];

            $guia_remision_transportista = [
                'version' => '2022',
                'tipo_doc' => $formulario_guia_remision["tipo_comprobante"],
                'serie' => $serie["serie"],
                'correlativo' => $serie["correlativo"] + 1,
                'fechaEmision' => $formulario_guia_remision["fecha_emision"],
                'company' => [
                    'ruc' => $empresa["ruc"],
                    'razonSocial' => $empresa["razon_social"],
                    'nombreComercial' => $empresa["nombre_comercial"],
                    'address' => [
                        'ubigeo' => $empresa["ubigeo"],
                        'departamento' => $empresa["departamento"],
                        'provincia' => $empresa["provincia"],
                        'distrito' => $empresa["distrito"],
                        'urbanizacion' => '-',
                        'direccion' => $empresa["direccion"],
                        'codLocal' => '0000'
                    ]
                ],
                'relDocs' => [
                    'relDoc' => [
                        'tipoDoc' => $formulario_guia_remision["tipo_comprobante_rel"],
                        'nroDoc' => strtoupper($formulario_guia_remision["serie_rel"] . '-' . $formulario_guia_remision["correlativo_rel"])
                    ]
                ],
                'destinatario' => [
                    'tipoDoc' => $cliente["id_tipo_documento"],
                    'numDoc' => $cliente["nro_documento"],
                    'rznSocial' => $cliente["razonSocial"]
                ],
                'tercero' => [
                    'tipoDoc' => '1',
                    'numDoc' => '45257895',
                    'rznSocial' => 'Luis Lozano'
                ],
                'envio' => [
                    'fecTraslado' => $formulario_guia_remision["fecha_traslado"],
                    'pesoTotal' => $formulario_guia_remision["peso_bruto_total"],
                    'undPesoTotal' => $formulario_guia_remision["peso_unidad_medida"],
                    'numBultos' => $formulario_guia_remision["numero_bultos"],
                    'llegada' => [
                        'ubigeo' => explode(' - ', $formulario_guia_remision["ubigeo_llegada"])[0],
                        'direccion' => $formulario_guia_remision["direccion_llegada"],
                    ],
                    'partida' => [
                        'ubigeo' => explode(' - ', $formulario_guia_remision["ubigeo_partida"])[0],
                        'direccion' => $formulario_guia_remision["direccion_partida"],
                    ],
                    'transportista' => [
                        'nroMtc' => $formulario_guia_remision["nro_mtc"] ?? null,
                    ],
                    'choferes' => $choferes ?? null,
                    'vehiculos' => $vehiculos ?? null
                ],
                'details' => $productos,
                'observaciones' => $formulario_guia_remision["observaciones"],
            ];


            $id_guia = VentasModelo::mdlGuardarGuiaRemisionTransportista($guia_remision_transportista);

            $response = ApiGuiaRemision::enviarGuiaTransportista(json_encode($guia_remision_transportista), $id_guia);

            //ACTUALIZAR GUIA CON:
            // $response['xml'] = $api->getLastXml();
            // $response['hash'] = (new XmlUtils)->getHashSign($response['xml']);
            // $response['sunatResponse'] = $sunat->sunatResponse($result);
            // $response["guia"] =  $guia["serie"].'-'.$guia["correlativo"];
            // $response["id_guia"] =  $id_guia;

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

            break;

        case 'obtener_modalidad_traslado':

            $response = VentasModelo::mdlObtenerModalidadTraslado();

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

            break;

        case 'obtener_motivo_traslado':

            $response = VentasModelo::mdlObtenerMotivoTraslado();

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

            break;

        case 'obtener_listado_guias_remitente':

            $response = VentasModelo::mdlObtenerGuiasRemisionRemitente($_POST);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;
    }
}

/* ===================================================================================  */
/* G E T   P E T I C I O N E S  */
/* ===================================================================================  */
if (isset($_GET["accion"])) {

    switch ($_GET["accion"]) {

        case 'generar_nota_venta_ticket':

            require('../vistas/assets/plugins/fpdf/fpdf.php');
            require("../phpqrcode/qrlib.php");

            $venta = VentasModelo::mdlObtenerVentaPorIdTicket($_GET["id_venta"]);

            if ($venta["forma_pago"] == "Credito") {
                $cuotas = VentasModelo::mdlObtenerCuotas($_GET["id_venta"]);
            }

            $pdf = new FPDF($orientation = 'P', $unit = 'mm', array(80, 1000));
            $pdf->AddPage();
            $pdf->setMargins(5, 5, 5);

            //NOMBRE DE LA EMPRESA
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60, 10, 'TUTORIALES PHPERU', 0, 0, 'C');

            //LOGO
            $pdf->Image('../vistas/assets/dist/img/logos_empresas/' . $venta["logo"] ?? 'mi_logo_tutorialesphperu.png', 30, 18, 20, 20);

            $pdf->Ln(25);

            //EMPRESA
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(70, 15, strlen(utf8_decode($venta["empresa"])) > 30 ? substr(utf8_decode($venta["empresa"]), 0, 30) . "..." : utf8_decode($venta["empresa"]), 0, 0, 'C');

            //DIRECCION
            $pdf->Ln(5);
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(70, 15, $venta["direccion_empresa"], 0, 0, 'C');

            //UBIGEO
            $pdf->Ln(5);
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(70, 15, $venta["ubigeo"], 0, 0, 'C');


            //RUC
            $pdf->Ln(5);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(70, 15, utf8_decode("RUC: " . $venta["ruc"]), 0, 0, 'C');

            //BOLETA DE VENTA ELECTRONICA
            $pdf->Ln(15);
            $pdf->SetFont('Arial', '', 8);
            if ($venta["id_tipo_comprobante"] == "01") {
                $pdf->Cell(70, 6, utf8_decode("FACTURA ELECTRÓNICA"), 0, 0, 'C');
            } elseif ($venta["id_tipo_comprobante"] == "03") {
                $pdf->Cell(70, 6, utf8_decode("BOLETA DE VENTA ELECTRÓNICA"), 0, 0, 'C');
            } else {
                $pdf->Cell(70, 6, utf8_decode("NOTA DE VENTA"), 0, 0, 'C');
            }

            $pdf->Ln(5);
            $pdf->Cell(70, 6, utf8_decode("SERIE: " . $venta["serie"]) . " " . utf8_decode("CORRELATIVO: " . $venta["correlativo"]), 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Cell(70, 6, utf8_decode("FECHA EMISIÓN: " . $venta["fecha_emision"] . "  " . $venta["hora_emision"]), 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Cell(70, 6, strtoupper(utf8_decode("CAJERO: " . $venta["nombre_cajero"] . " " . $venta["apellido_cajero"])), 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Cell(70, 6, strtoupper(strlen(utf8_decode($venta["nombres_apellidos_razon_social"])) > 25 ? "CLIENTE:" . substr(utf8_decode($venta["nombres_apellidos_razon_social"]), 0, 25) . "..." : "CLIENTE:" . utf8_decode($venta["nombres_apellidos_razon_social"])), 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Cell(70, 6, strtoupper(utf8_decode("NRO. DOC.: " . $venta["nro_documento"])), 0, 0, 'C');


            $pdf->Ln(10);

            //INICIO DETALLE DE LA VENTA
            $pdf->Cell(70, 5, utf8_decode("-------------------------------------------------------------------------"), 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->SetFont('Arial', 'B', 6);
            $pdf->Cell(13, 4, utf8_decode("CODIGO"), 0, 0, 'L');
            $pdf->Cell(30, 4, utf8_decode("DESCRIPCIÓN"), 0, 0, 'L');
            $pdf->Cell(8, 4, utf8_decode("CANT."), 0, 0, 'L');
            $pdf->Cell(10, 4, utf8_decode("P. UNIT"), 0, 0, 'L');
            $pdf->Cell(8, 4, utf8_decode("IMP."), 0, 0, 'C');

            $detalle_venta = VentasModelo::mdlObtenerDetalleVentaPorId($_GET["id_venta"]);

            foreach ($detalle_venta as $detalle) {
                $pdf->Ln(5);
                $pdf->SetFont('Arial', '', 6);
                $pdf->Cell(13, 4, strlen(utf8_decode($detalle["codigo_producto"])) > 6 ? substr(utf8_decode($detalle["codigo_producto"]), 0, 6) . "..." : utf8_decode($detalle["codigo_producto"]), 0, 0, 'L');
                $pdf->Cell(30, 4, strtoupper(strlen(utf8_decode($detalle["descripcion"])) > 25 ? substr(utf8_decode($detalle["descripcion"]), 0, 25) . "..." : utf8_decode($detalle["descripcion"])), 0, 0, 'L');
                $pdf->Cell(8, 4, $detalle["cantidad"], 0, 0, 'C');
                $pdf->Cell(10, 4, $detalle["precio_unitario"], 0, 0, 'C');
                $pdf->Cell(8, 4, $detalle["importe_total"], 0, 0, 'R');
            }

            $pdf->Ln(5);
            $pdf->Cell(70, 5, utf8_decode("--------------------------------------------------------------------------------------------------"), 0, 0, 'C');
            $pdf->Ln();
            //FIN DETALLE DE LA VENTA

            //INICIO RESUMEN IMPORTES
            $pdf->SetFont('Arial', 'B', 6);
            $pdf->Cell(50, 4, "OP. GRAVADA:", 0, 0, 'R');
            $pdf->Cell(20, 4, $venta["simbolo"] . " " . $venta["ope_gravada"], 0, 0, 'R');
            $pdf->Ln();

            $pdf->Cell(50, 4, "OP. INAFECTA:", 0, 0, 'R');
            $pdf->Cell(20, 4, $venta["simbolo"] . " " . $venta["ope_inafecta"], 0, 0, 'R');
            $pdf->Ln();

            $pdf->Cell(50, 4, "OP. EXONERADA:", 0, 0, 'R');
            $pdf->Cell(20, 4, $venta["simbolo"] . " " . $venta["ope_exonerada"], 0, 0, 'R');
            $pdf->Ln();

            $pdf->Cell(50, 4, "I.G.V.:", 0, 0, 'R');
            $pdf->Cell(20, 4, $venta["simbolo"] . " " . $venta["total_igv"], 0, 0, 'R');
            $pdf->Ln();

            $pdf->Cell(50, 4, "IMPORTE TOTAL:", 0, 0, 'R');
            $pdf->Cell(20, 4, $venta["simbolo"] . " " . $venta["importe_total"], 0, 0, 'R');
            $pdf->Ln(10);
            //FIN RESUMEN IMPORTES


            //FORMA DE PAGO
            $pdf->Cell(20, 4, strtoupper("Forma de Pago: "), 0, 0, 'L');
            $pdf->Cell(40, 4, strtoupper($venta["forma_pago"]), 0, 0, 'L');
            $pdf->Ln(5);

            if ($venta["forma_pago"] != "Credito") {

                //TOTAL RECIBIDO
                $pdf->Cell(25, 4, strtoupper("Efectivo Recibido: "), 0, 0, 'L');
                $pdf->Cell(40, 4, $venta["simbolo"] . ' ' . $venta["efectivo_recibido"], 0, 0, 'L');

                $pdf->Ln(5);

                //VUELTO
                $pdf->Cell(25, 4, strtoupper("Vuelto: "), 0, 0, 'L');
                $pdf->Cell(40, 4, $venta["simbolo"] . ' ' . $venta["vuelto"], 0, 0, 'L');

                $pdf->Ln(5);
            }

            //CALENDARIO DE PAGOS
            if ($venta["forma_pago"] == "Credito") {

                $pdf->Ln(5);
                $pdf->SetFont('Arial', '', 6);
                $pdf->Cell(10, 4, "Cuota", 0, 0, 'L');
                $pdf->Cell(20, 4, "Fecha Vencimiento", 0, 0, 'L');
                $pdf->Cell(20, 4, "Importe", 0, 0, 'C');
                $pdf->Cell(20, 4, "", 0, 0, 'C');

                for ($i = 0; $i < count($cuotas); $i++) {

                    $pdf->Ln(5);
                    $pdf->SetFont('Arial', '', 6);

                    $pdf->Cell(10, 4, $cuotas[$i]["cuota"], 0, 0, 'L');
                    $pdf->Cell(20, 4, $cuotas[$i]["fecha_vencimiento"], 0, 0, 'L');
                    $pdf->Cell(20, 4, $cuotas[$i]["importe"], 0, 0, 'C');
                    $pdf->Cell(20, 4, "", 0, 0, 'L');
                }
            }

            $pdf->Ln(30);
            $pdf->SetFont('Arial', '', 6);
            //QR
            /*RUC | TIPO DE DOCUMENTO | SERIE | NUMERO | MTO TOTAL IGV | MTO TOTAL DEL COMPROBANTE | FECHA DE EMISION |TIPO DE DOCUMENTO ADQUIRENTE | NUMERO DE DOCUMENTO ADQUIRENTE |*/
            $text_qr = $venta["ruc"] . " | " . $venta["id_tipo_comprobante"] . " | " . $venta["serie"] . " | " . $venta["correlativo"] . " | " . $venta["total_igv"] . " | " . $venta["importe_total"] . " | " . $venta["fecha_emision"] . " | " . $venta["id_tipo_documento"] . " | " . $venta["nro_documento"];
            $ruta_qr = "../fe/qr/" . "prueba_qr" . '.png';

            QRcode::png($text_qr, $ruta_qr, 'Q', 15, 0);

            $pdf->Image($ruta_qr, 28, $pdf->GetY() - 20, 25, 25);

            $pdf->Ln(5);

            //HASH SIGNATURE
            $pdf->Cell(70, 4, $venta["hash_signature"], 0, 0, 'C');
            $pdf->Ln(10);

            //TEXTO
            $pdf->SetFillColor(255, 255, 255);
            $pdf->Cell(70, 4, utf8_decode("Representación impresa de la Boleta de Venta Electrónica, esta puede"), 0, 0, 'L');
            $pdf->Ln();
            $pdf->Cell(70, 4, utf8_decode("ser consultada en: www.tutorialesphperu.com"), 0, 0, 'L');

            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(70, 4, "GRACIAS POR TU COMPRA", 0, 0, 'C');

            // $detalle_venta = VentasModelo::mdlObtenerDetalleVenta($_GET["nro_boleta"]);

            $pdf->SetFont('Arial', '', 8);

            $filename = "../fe/facturas/" . $venta["ruc"] . "-" . $venta["id_tipo_comprobante"] . "-" . $venta["serie"] . "-" . $venta["correlativo"] . ".pdf";

            $pdf->Output();
            $pdf->Output($filename, 'F');

            break;

        case 'generar_factura_a4':

            require("../phpqrcode/qrlib.php");

            $venta = VentasModelo::mdlObtenerVentaPorIdFormatoA4($_GET["id_venta"]);
            $detalle_venta = VentasModelo::mdlObtenerDetalleVentaPorId($_GET["id_venta"]);

            if ($venta["forma_pago"] == "Credito") {
                $cuotas = VentasModelo::mdlObtenerCuotas($_GET["id_venta"]);
            }

            $text_qr = $venta["ruc"] . " | " . $venta["id_tipo_comprobante"] . " | " . $venta["serie"] . " | " . $venta["correlativo"] . " | " . $venta["total_igv"] . " | " . $venta["importe_total"] . " | " . $venta["fecha_emision"] . " | " . $venta["id_tipo_documento"] . " | " . $venta["nro_documento"];
            $ruta_qr = "../fe/qr/" . $venta["ruc"] . $venta["id_tipo_comprobante"] . $venta["serie"]  .  $venta["correlativo"] . '.png';

            QRcode::png($text_qr, $ruta_qr, 'Q', 15, 0);

            ob_start();

            require "impresion_factura_a4.php";

            $html = ob_get_clean();

            $dompdf = new Dompdf();

            $dompdf->loadHtml($html);
            $dompdf->setpaper('A4');
            $dompdf->render();
            $dompdf->stream('factura_a4.pdf', array('Attachment' => false));

            // $output = $dompdf->output();
            file_put_contents('../fe/facturas/' .  $venta["ruc"] . '-' . trim($venta["id_tipo_comprobante"]) .  '-' . trim($venta["serie"])  .   '-' . $venta["correlativo"] . '.pdf', $dompdf->output());

            $_SESSION["compra"] = '';
            $_SESSION["cliente"] = '';

            $response = VentasModelo::mdlEnviarComprobanteEmail($_GET["id_venta"], 'tutorialesphperu@gmail.com');

            // $response = VentasModelo::mdlEnviarComprobanteEmail(
            //     'tutorialesphperu@gmail.com',
            //     'Luis Lozano',
            //     '../fe/facturas/xml/' . '20452578951' . '-' . trim($venta["id_tipo_comprobante"])  . '-' . trim($venta["serie"]) . '-' . $venta["correlativo"]  . '.xml',
            //     '20452578951' . '-' . trim($venta["id_tipo_comprobante"])  . '-' . trim($venta["serie"]) . '-' . $venta["correlativo"]  . '.xml',
            //     '../fe/facturas/' . '20452578951' . '-' . trim($venta["id_tipo_comprobante"])  . '-' . trim($venta["serie"]) . '-' . $venta["correlativo"]  . '.pdf',
            //     '20452578951' . '-' . trim($venta["id_tipo_comprobante"])  . '-' . trim($venta["serie"]) . '-' . $venta["correlativo"]  . '.pdf'
            // );

            // echo $response; 

            break;

        case 'generar_ticket':

            require('../vistas/assets/plugins/fpdf/fpdf.php');
            require("../phpqrcode/qrlib.php");

            $venta = VentasModelo::mdlObtenerVentaPorIdTicket($_GET["id_venta"]);

            if ($venta["forma_pago"] == "Credito") {
                $cuotas = VentasModelo::mdlObtenerCuotas($_GET["id_venta"]);
            }

            $pdf = new FPDF($orientation = 'P', $unit = 'mm', array(80, 1000));
            $pdf->AddPage();
            $pdf->setMargins(5, 5, 5);

            //NOMBRE DE LA EMPRESA
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(60, 10, $venta["nombre_comercial"], 0, 0, 'C');

            //LOGO
            $pdf->Image('../vistas/assets/dist/img/logos_empresas/' . $venta["logo"] ?? 'mi_logo_tutorialesphperu.png', 30, 18, 20, 20);

            $pdf->Ln(25);

            //EMPRESA
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(70, 15, strlen(utf8_decode($venta["empresa"])) > 30 ? substr(utf8_decode($venta["empresa"]), 0, 30) . "..." : utf8_decode($venta["empresa"]), 0, 0, 'C');

            //DIRECCION
            $pdf->Ln(5);
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(70, 15, $venta["direccion_empresa"], 0, 0, 'C');

            //UBIGEO
            $pdf->Ln(5);
            $pdf->SetFont('Arial', '', 8);
            $pdf->Cell(70, 15, $venta["ubigeo"], 0, 0, 'C');


            //RUC
            $pdf->Ln(5);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(70, 15, utf8_decode("RUC: " . $venta["ruc"]), 0, 0, 'C');

            //BOLETA DE VENTA ELECTRONICA
            $pdf->Ln(15);
            $pdf->SetFont('Arial', '', 8);
            if ($venta["id_tipo_comprobante"] == "01") {
                $pdf->Cell(70, 6, utf8_decode("FACTURA ELECTRÓNICA"), 0, 0, 'C');
            } else if ($venta["id_tipo_comprobante"] == "NV")
                $pdf->Cell(70, 6, utf8_decode("NOTA DE VENTA"), 0, 0, 'C');
            else {
                $pdf->Cell(70, 6, utf8_decode("BOLETA DE VENTA ELECTRÓNICA"), 0, 0, 'C');
            }

            $pdf->Ln(5);
            $pdf->Cell(70, 6, utf8_decode("SERIE: " . $venta["serie"]) . " " . utf8_decode("CORRELATIVO: " . $venta["correlativo"]), 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Cell(70, 6, utf8_decode("FECHA EMISIÓN: " . $venta["fecha_emision"] . "  " . $venta["hora_emision"]), 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Cell(70, 6, strtoupper(utf8_decode("CAJERO: " . $venta["nombre_cajero"] . " " . $venta["apellido_cajero"])), 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Cell(70, 6, strtoupper(strlen(utf8_decode($venta["nombres_apellidos_razon_social"])) > 25 ? "CLIENTE:" . substr(utf8_decode($venta["nombres_apellidos_razon_social"]), 0, 25) . "..." : "CLIENTE:" . utf8_decode($venta["nombres_apellidos_razon_social"])), 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->Cell(70, 6, strtoupper(utf8_decode("NRO. DOC.: " . $venta["nro_documento"])), 0, 0, 'C');


            $pdf->Ln(10);

            //INICIO DETALLE DE LA VENTA
            $pdf->Cell(70, 5, utf8_decode("-------------------------------------------------------------------------"), 0, 0, 'C');
            $pdf->Ln(5);
            $pdf->SetFont('Arial', 'B', 6);
            $pdf->Cell(13, 4, utf8_decode("CODIGO"), 0, 0, 'L');
            $pdf->Cell(30, 4, utf8_decode("DESCRIPCIÓN"), 0, 0, 'L');
            $pdf->Cell(8, 4, utf8_decode("CANT."), 0, 0, 'L');
            $pdf->Cell(10, 4, utf8_decode("P. UNIT"), 0, 0, 'L');
            $pdf->Cell(8, 4, utf8_decode("IMP."), 0, 0, 'C');

            $detalle_venta = VentasModelo::mdlObtenerDetalleVentaPorId($_GET["id_venta"]);

            foreach ($detalle_venta as $detalle) {
                $pdf->Ln(5);
                $pdf->SetFont('Arial', '', 6);
                $pdf->Cell(13, 4, strlen(utf8_decode($detalle["codigo_producto"])) > 6 ? substr(utf8_decode($detalle["codigo_producto"]), 0, 6) . "..." : utf8_decode($detalle["codigo_producto"]), 0, 0, 'L');
                $pdf->Cell(30, 4, strtoupper(strlen(utf8_decode($detalle["descripcion"])) > 25 ? substr(utf8_decode($detalle["descripcion"]), 0, 25) . "..." : utf8_decode($detalle["descripcion"])), 0, 0, 'L');
                $pdf->Cell(8, 4, $detalle["cantidad"], 0, 0, 'C');
                $pdf->Cell(10, 4, $detalle["precio_unitario"], 0, 0, 'C');
                $pdf->Cell(8, 4, $detalle["importe_total"], 0, 0, 'R');
            }

            $pdf->Ln(5);
            $pdf->Cell(70, 5, utf8_decode("--------------------------------------------------------------------------------------------------"), 0, 0, 'C');
            $pdf->Ln();
            //FIN DETALLE DE LA VENTA

            //INICIO RESUMEN IMPORTES
            $pdf->SetFont('Arial', 'B', 6);
            $pdf->Cell(50, 4, "OP. GRAVADA:", 0, 0, 'R');
            $pdf->Cell(20, 4, $venta["simbolo"] . " " . $venta["ope_gravada"], 0, 0, 'R');
            $pdf->Ln();

            $pdf->Cell(50, 4, "OP. INAFECTA:", 0, 0, 'R');
            $pdf->Cell(20, 4, $venta["simbolo"] . " " . $venta["ope_inafecta"], 0, 0, 'R');
            $pdf->Ln();

            $pdf->Cell(50, 4, "OP. EXONERADA:", 0, 0, 'R');
            $pdf->Cell(20, 4, $venta["simbolo"] . " " . $venta["ope_exonerada"], 0, 0, 'R');
            $pdf->Ln();

            $pdf->Cell(50, 4, "I.G.V.:", 0, 0, 'R');
            $pdf->Cell(20, 4, $venta["simbolo"] . " " . $venta["total_igv"], 0, 0, 'R');
            $pdf->Ln();

            $pdf->Cell(50, 4, "IMPORTE TOTAL:", 0, 0, 'R');
            $pdf->Cell(20, 4, $venta["simbolo"] . " " . $venta["importe_total"], 0, 0, 'R');
            $pdf->Ln(10);
            //FIN RESUMEN IMPORTES


            //FORMA DE PAGO
            $pdf->Cell(20, 4, strtoupper("Forma de Pago: "), 0, 0, 'L');
            $pdf->Cell(40, 4, strtoupper($venta["forma_pago"]), 0, 0, 'L');
            $pdf->Ln(5);

            if ($venta["forma_pago"] != "Credito") {

                //TOTAL RECIBIDO
                $pdf->Cell(25, 4, strtoupper("Efectivo Recibido: "), 0, 0, 'L');
                $pdf->Cell(40, 4, $venta["simbolo"] . ' ' . $venta["efectivo_recibido"], 0, 0, 'L');

                $pdf->Ln(5);

                //VUELTO
                $pdf->Cell(25, 4, strtoupper("Vuelto: "), 0, 0, 'L');
                $pdf->Cell(40, 4, $venta["simbolo"] . ' ' . $venta["vuelto"], 0, 0, 'L');

                $pdf->Ln(5);
            }

            //CALENDARIO DE PAGOS
            if ($venta["forma_pago"] == "Credito") {

                $pdf->Ln(5);
                $pdf->SetFont('Arial', '', 6);
                $pdf->Cell(10, 4, "Cuota", 0, 0, 'L');
                $pdf->Cell(20, 4, "Fecha Vencimiento", 0, 0, 'L');
                $pdf->Cell(20, 4, "Importe", 0, 0, 'C');
                $pdf->Cell(20, 4, "", 0, 0, 'C');

                for ($i = 0; $i < count($cuotas); $i++) {

                    $pdf->Ln(5);
                    $pdf->SetFont('Arial', '', 6);

                    $pdf->Cell(10, 4, $cuotas[$i]["cuota"], 0, 0, 'L');
                    $pdf->Cell(20, 4, $cuotas[$i]["fecha_vencimiento"], 0, 0, 'L');
                    $pdf->Cell(20, 4, $cuotas[$i]["importe"], 0, 0, 'C');
                    $pdf->Cell(20, 4, "", 0, 0, 'L');
                }
            }

            $pdf->Ln(30);
            $pdf->SetFont('Arial', '', 6);
            //QR
            /*RUC | TIPO DE DOCUMENTO | SERIE | NUMERO | MTO TOTAL IGV | MTO TOTAL DEL COMPROBANTE | FECHA DE EMISION |TIPO DE DOCUMENTO ADQUIRENTE | NUMERO DE DOCUMENTO ADQUIRENTE |*/
            $text_qr = $venta["ruc"] . " | " . $venta["id_tipo_comprobante"] . " | " . $venta["serie"] . " | " . $venta["correlativo"] . " | " . $venta["total_igv"] . " | " . $venta["importe_total"] . " | " . $venta["fecha_emision"] . " | " . $venta["id_tipo_documento"] . " | " . $venta["nro_documento"];
            $ruta_qr = "../fe/qr/" . "prueba_qr" . '.png';

            QRcode::png($text_qr, $ruta_qr, 'Q', 15, 0);

            $pdf->Image($ruta_qr, 28, $pdf->GetY() - 20, 25, 25);

            $pdf->Ln(5);

            //HASH SIGNATURE
            $pdf->Cell(70, 4, $venta["hash_signature"], 0, 0, 'C');
            $pdf->Ln(10);

            //TEXTO
            $pdf->SetFillColor(255, 255, 255);
            $pdf->Cell(70, 4, utf8_decode("Representación impresa de la Boleta de Venta Electrónica, esta puede"), 0, 0, 'L');
            $pdf->Ln();
            $pdf->Cell(70, 4, utf8_decode("ser consultada en: www.tutorialesphperu.com"), 0, 0, 'L');

            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(70, 4, "GRACIAS POR TU COMPRA", 0, 0, 'C');

            // $detalle_venta = VentasModelo::mdlObtenerDetalleVenta($_GET["nro_boleta"]);

            $pdf->SetFont('Arial', '', 8);

            $pdf->Output('../fe/facturas/' . $venta["ruc"] . "-" . $venta["id_tipo_comprobante"] . "-" . $venta["serie"] . "-" . $venta["correlativo"] . '.pdf', 'F');
            $pdf->Output();

            break;

        case 'generar_nota_credito_a4':

            require("../phpqrcode/qrlib.php");

            $venta = VentasModelo::mdlObtenerVentaPorIdFormatoA4($_GET["id_venta"]);
            $detalle_venta = VentasModelo::mdlObtenerDetalleVentaPorId($_GET["id_venta"]);


            $text_qr = $venta["ruc"] . " | " . $venta["id_tipo_comprobante"] . " | " . $venta["serie"] . " | " . $venta["correlativo"] . " | " . $venta["total_igv"] . " | " . $venta["importe_total"] . " | " . $venta["fecha_emision"] . " | " . $venta["id_tipo_documento"] . " | " . $venta["nro_documento"];
            $ruta_qr = "../fe/qr/" . $venta["ruc"] . $venta["id_tipo_comprobante"] . $venta["serie"]  .  $venta["correlativo"] . '.png';

            QRcode::png($text_qr, $ruta_qr, 'Q', 15, 0);

            ob_start();

            require "impresion_nota_credito_a4.php";

            $html = ob_get_clean();

            $dompdf = new Dompdf();

            $dompdf->loadHtml($html);
            $dompdf->setpaper('A4');
            $dompdf->render();
            $dompdf->stream('factura_a4.pdf', array('Attachment' => false));

            // $output = $dompdf->output();
            file_put_contents('../fe/facturas/' .  $venta["ruc"] . '-' . trim($venta["id_tipo_comprobante"]) .  '-' . trim($venta["serie"])  .   '-' . $venta["correlativo"] . '.pdf', $dompdf->output());

            break;

        case 'generar_guia_remision_a4':

            require("../phpqrcode/qrlib.php");

            $guia = VentasModelo::mdlObtenerGuiaRemisionPorIdFormatoA4($_GET["id_guia"]);

            $detalle_guia_productos = VentasModelo::mdlObtenerGuiaRemisionDetalleProductos($_GET["id_guia"]);

            if ($guia["id_modalidad_traslado"] == '02') {
                $detalle_vehiculos = VentasModelo::mdlObtenerGuiaRemisionDetalleVehiculos($_GET["id_guia"]);
                $detalle_choferes = VentasModelo::mdlObtenerGuiaRemisionDetalleChoferes($_GET["id_guia"]);
            }

            $text_qr = $guia["ruc_empresa"] . " | " . $guia["tipo_documento"] . " | " . $guia["serie"] . " | " . $guia["correlativo"] . " | " . $guia["fecha_emision"] . " | " . $guia["id_tipo_documento_cliente"] . " | " . $guia["nro_doc_cliente"];
            $ruta_qr = "../fe/qr/" . $guia["ruc_empresa"] . $guia["tipo_documento"] . $guia["serie"]  .  $guia["correlativo"] . '.png';

            QRcode::png($text_qr, $ruta_qr, 'Q', 15, 0);

            ob_start();

            require "impresion_guia_remision_a4.php";

            $html = ob_get_clean();

            $dompdf = new Dompdf();

            $dompdf->loadHtml($html);
            $dompdf->setpaper('A4');
            $dompdf->render();
            $dompdf->stream('factura_a4.pdf', array('Attachment' => false));

            file_put_contents('../fe/facturas/' .  $venta["ruc"] . '-' . trim($venta["id_tipo_comprobante"]) .  '-' . trim($venta["serie"])  .   '-' . $venta["correlativo"] . '.pdf', $dompdf->output());

            break;
    }
}
