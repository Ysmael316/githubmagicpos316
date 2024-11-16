<?php

session_start();

require_once "conexion.php";
require_once "configuraciones.modelo.php";
require_once "empresas.modelo.php";
require_once "clientes.modelo.php";
// require_once "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

class VentasModelo
{

    public $resultado;


    static public function mdlObtenerNroBoleta()
    {

        $stmt = Conexion::conectar()->prepare("call prc_obtenerNroBoleta()");

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }


    static public function mdlObtenerTipoMovimientoCajaPorMedioPago($id_medio_pago)
    {


        $stmt = Conexion::conectar()->prepare("SELECT mp.id as id_medio_pago,
                                                    mp.id_tipo_movimiento_caja,
                                                    tmc.afecta_caja,
                                                    mp.descripcion as medio_pago
                                            FROM medio_pago mp inner join tipo_movimiento_caja tmc on mp.id_tipo_movimiento_caja = tmc.id
                                            WHERE mp.id = :id_medio_pago");

        $stmt->bindParam(":id_medio_pago", $id_medio_pago, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();
    }
    /* =========================================================================================
    R E G I S T R A R   V E N T A
    ========================================================================================= */
    static public function mdlRegistrarVenta($venta, $detalle_venta, $id_caja)
    {
        
        $id_usuario = $_SESSION["usuario"]->id_usuario;

        $date = date('Y-m-d');

        $dbh = Conexion::conectar();

        if ($venta['forma_pago'] == 'Credito') {
            $pagado = 0;
        } else {
            $pagado = 1;
        }

        //ELIMINAR TABLAS DEL SISTEMA
        try {

            $stmt = $dbh->prepare("INSERT INTO venta(id_empresa_emisora, 
                                                    id_cliente, 
                                                    id_serie, 
                                                    serie, 
                                                    correlativo, 
                                                    fecha_emision, 
                                                    hora_emision, 
                                                    fecha_vencimiento, 
                                                    id_moneda, 
                                                    forma_pago, 
                                                    medio_pago,
                                                    total_operaciones_gravadas, 
                                                    total_operaciones_exoneradas, 
                                                    total_operaciones_inafectas, 
                                                    total_igv, 
                                                    importe_total,
                                                    efectivo_recibido,
                                                    vuelto,
                                                    id_usuario,
                                                    pagado)
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $dbh->beginTransaction();
            $stmt->execute(array(
                $venta['id_empresa_emisora'],
                $venta['id_cliente'],
                $venta['id_serie'],
                $venta['serie'],
                $venta['correlativo'],
                $venta['fecha_emision'],
                $venta['hora_emision'],
                $venta['fecha_vencimiento'],
                $venta['moneda'],
                $venta['forma_pago'],
                $venta['medio_pago'],
                $venta['total_operaciones_gravadas'],
                $venta['total_operaciones_exoneradas'],
                $venta['total_operaciones_inafectas'],
                $venta['total_igv'],
                $venta['total_a_pagar'],
                $venta['efectivo_recibido'],
                $venta['vuelto'],
                $id_usuario,
                $pagado
            ));
            $id_venta = $dbh->lastInsertId();
            $dbh->commit();

            $stmt = $dbh->prepare("UPDATE serie
                                     SET correlativo = correlativo + 1 
                                    WHERE id = ?");
            $dbh->beginTransaction();
            $stmt->execute(array(
                $venta['id_serie']
            ));
            $dbh->commit();

            //GUARDAR EL DETALLE DE LA VENTA:
            foreach ($detalle_venta as $producto) {

                $stmt = $dbh->prepare("INSERT INTO detalle_venta(id_venta, 
                                                                item, 
                                                                codigo_producto, 
                                                                descripcion, 
                                                                porcentaje_igv, 
                                                                cantidad, 
                                                                costo_unitario,
                                                                valor_unitario, 
                                                                precio_unitario, 
                                                                valor_total, 
                                                                igv, 
                                                                importe_total)
                            VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
                $dbh->beginTransaction();
                $stmt->execute(array(
                    $id_venta,
                    $producto['item'],
                    $producto['codigo'],
                    $producto['descripcion'],
                    $producto['porcentaje_igv'],
                    $producto['cantidad'],
                    $producto['costo_unitario'],
                    $producto['valor_unitario'],
                    $producto['precio_unitario'],
                    $producto['valor_total'],
                    $producto['igv'],
                    $producto['importe_total']
                ));
                $dbh->commit();


                //*************************************************************************** */
                // R E G I S T R A M O S   E L   I N G R E S O   E N   M O V I M I E N T O S
                //*************************************************************************** */

                $tipo_movimiento_caja = VentasModelo::mdlObtenerTipoMovimientoCajaPorMedioPago($venta['medio_pago']);

                $stmt = $dbh->prepare("INSERT INTO movimientos_arqueo_caja(id_arqueo_caja, 
                                                                                id_tipo_movimiento, 
                                                                                descripcion, 
                                                                                monto, 
                                                                                comprobante,
                                                                                estado)
                                                                        VALUES(:id_arqueo_caja, 
                                                                                :id_tipo_movimiento, 
                                                                                :descripcion, 
                                                                                :monto, 
                                                                                :comprobante,
                                                                                :estado)");

                $dbh->beginTransaction();
                $stmt->execute(array(
                    ':id_arqueo_caja' => $id_caja,
                    ':id_tipo_movimiento' => $venta['forma_pago'] == "Credito" ? 10:$tipo_movimiento_caja["id_tipo_movimiento_caja"],
                    ':descripcion' => 'INGRESO - ' . ($venta['forma_pago'] == "Credito" ? "VENTA AL CREDITO":$tipo_movimiento_caja['medio_pago']),
                    ':monto' =>  $producto['importe_total'],
                    ':comprobante' => $venta['serie'] . '-' . $venta['correlativo'],
                    ':estado' => 1
                ));
                $dbh->commit();

                if ($tipo_movimiento_caja["afecta_caja"] == "1" && $venta["forma_pago"] == "Contado") {

                    //*************************************************************************** */
                    // A C T U A L I Z A M O S   E L   I N G R E S O   A   C A J A
                    //*************************************************************************** */
                    $stmt = $dbh->prepare("UPDATE arqueo_caja
                                            SET ingresos = round(ifnull(ingresos,0) + :importe_venta,2),
                                                monto_final = ifnull(monto_apertura,0) + ifnull(ingresos,0) - ifnull(devoluciones,0) - ifnull(gastos,0)
                                        WHERE id = :id_caja");

                    $dbh->beginTransaction();
                    $stmt->execute(array(
                        ':importe_venta' => $producto['importe_total'],
                        ':id_caja' => $id_caja
                    ));
                    $dbh->commit();
                }

                //*************************************************************************** */
                // R E G I S T R A M O S   E L   K A R D E X   D E   S A L I D A S
                //*************************************************************************** */
                $concepto = 'VENTA';

                $stmt = Conexion::conectar()->prepare("call prc_registrar_kardex_venta (?,?,?,?,?)");

                $dbh->beginTransaction();
                $stmt->execute(array(
                    $producto['codigo'],
                    $date,
                    $concepto,
                    $venta['serie'] . '-' . $venta['correlativo'],
                    $producto['cantidad']

                ));
                $dbh->commit();
            }
        } catch (Exception $e) {
            $dbh->rollBack();
            return 0;
        }

        return $id_venta;
    }

    /* =========================================================================================
    R E G I S T R A R   N O T A   D E   V E N T A
    ========================================================================================= */
    static public function mdlRegistrarNotaVenta($venta, $detalle_venta, $id_caja)
    {

        $id_usuario = $_SESSION["usuario"]->id_usuario;

        $date = date('Y-m-d');

        $dbh = Conexion::conectar();

        if ($venta['forma_pago'] == 'Credito') {
            $pagado = 0;
        } else {
            $pagado = 1;
        }


        try {

            $stmt = $dbh->prepare("INSERT INTO venta(id_empresa_emisora, 
                                                    id_cliente, 
                                                    id_serie, 
                                                    serie, 
                                                    correlativo, 
                                                    fecha_emision, 
                                                    hora_emision, 
                                                    fecha_vencimiento, 
                                                    id_moneda, 
                                                    forma_pago, 
                                                    medio_pago,
                                                    total_operaciones_gravadas, 
                                                    total_operaciones_exoneradas, 
                                                    total_operaciones_inafectas, 
                                                    total_igv, 
                                                    importe_total,
                                                    efectivo_recibido,
                                                    vuelto,
                                                    id_usuario,
                                                    pagado,
                                                    estado_comprobante)
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,1)");
            $dbh->beginTransaction();
            $stmt->execute(array(
                $venta['id_empresa_emisora'],
                $venta['id_cliente'],
                $venta['id_serie'],
                $venta['serie'],
                $venta['correlativo'],
                $venta['fecha_emision'],
                $venta['hora_emision'],
                $venta['fecha_vencimiento'],
                $venta['moneda'],
                $venta['forma_pago'],
                $venta['medio_pago'],
                $venta['total_operaciones_gravadas'],
                $venta['total_operaciones_exoneradas'],
                $venta['total_operaciones_inafectas'],
                $venta['total_igv'],
                $venta['total_a_pagar'],
                $venta['efectivo_recibido'],
                $venta['vuelto'],
                $id_usuario,
                $pagado
            ));
            $id_venta = $dbh->lastInsertId();
            $dbh->commit();

            $stmt = $dbh->prepare("UPDATE serie
                                     SET correlativo = correlativo + 1 
                                    WHERE id = ?");
            $dbh->beginTransaction();
            $stmt->execute(array(
                $venta['id_serie']
            ));
            $dbh->commit();

            //GUARDAR EL DETALLE DE LA VENTA:
            foreach ($detalle_venta as $producto) {

                $stmt = $dbh->prepare("INSERT INTO detalle_venta(id_venta, 
                                                                item, 
                                                                codigo_producto, 
                                                                descripcion, 
                                                                porcentaje_igv, 
                                                                cantidad, 
                                                                costo_unitario,
                                                                valor_unitario, 
                                                                precio_unitario, 
                                                                valor_total, 
                                                                igv, 
                                                                importe_total)
                            VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
                $dbh->beginTransaction();
                $stmt->execute(array(
                    $id_venta,
                    $producto['item'],
                    $producto['codigo'],
                    $producto['descripcion'],
                    $producto['porcentaje_igv'],
                    $producto['cantidad'],
                    $producto['costo_unitario'],
                    $producto['valor_unitario'],
                    $producto['precio_unitario'],
                    $producto['valor_total'],
                    $producto['igv'],
                    $producto['importe_total']
                ));
                $dbh->commit();


                //*************************************************************************** */
                // R E G I S T R A M O S   E L   I N G R E S O   E N   M O V I M I E N T O S
                //*************************************************************************** */
                $stmt = $dbh->prepare("INSERT INTO movimientos_arqueo_caja(id_arqueo_caja, 
                                                                            id_tipo_movimiento, 
                                                                            descripcion, 
                                                                            monto, 
                                                                            estado)
                                                            VALUES(:id_arqueo_caja, 
                                                            :id_tipo_movimiento, 
                                                            :descripcion, 
                                                            :monto, 
                                                            :estado)");

                $dbh->beginTransaction();
                $stmt->execute(array(
                    ':id_arqueo_caja' => $id_caja,
                    ':id_tipo_movimiento' => 3,
                    ':descripcion' => 'INGRESO - ' . $venta['forma_pago'],
                    ':monto' =>  $producto['importe_total'],
                    ':estado' => 1
                ));
                $dbh->commit();

                //*************************************************************************** */
                // A C T U A L I Z A M O S   E L   I N G R E S O   A   C A J A
                //*************************************************************************** */
                if ($venta['forma_pago'] == "Contado") {

                    $stmt = $dbh->prepare("UPDATE arqueo_caja
                                            SET ingresos = round(ifnull(ingresos,0) + :importe_venta,2),
                                                monto_final = ifnull(monto_apertura,0) + ifnull(ingresos,0) - ifnull(devoluciones,0) - ifnull(gastos,0)
                                        WHERE id = :id_caja");

                    $dbh->beginTransaction();
                    $stmt->execute(array(
                        ':importe_venta' => $producto['importe_total'],
                        ':id_caja' => $id_caja
                    ));
                    $dbh->commit();
                }


                //*************************************************************************** */
                //R E G I S T R A M O S   E L   K A R D E X   D E   S A L I D A S
                //*************************************************************************** */
                $concepto = 'VENTA';

                $stmt = Conexion::conectar()->prepare("call prc_registrar_kardex_venta (?,?,?,?,?)");

                $dbh->beginTransaction();
                $stmt->execute(array(
                    $producto['codigo'],
                    $date,
                    $concepto,
                    $venta['serie'] . '-' . $venta['correlativo'],
                    $producto['cantidad']

                ));
                $dbh->commit();
            }
        } catch (Exception $e) {
            $dbh->rollBack();
            return 0;
        }

        return $id_venta;
    }

    /* =========================================================================================
    R E G I S T R A R   N O T A   D E   C R E D I T O
    ========================================================================================= */
    static public function mdlRegistrarNotaCredito($venta, $detalle_venta, $id_venta_anulada)
    {

        $id_usuario = $_SESSION["usuario"]->id_usuario;

        $dbh = Conexion::conectar();

        try {

            $stmt = $dbh->prepare("INSERT INTO venta(id_empresa_emisora, 
                                                    id_cliente, 
                                                    id_serie, 
                                                    serie, 
                                                    correlativo,
                                                    tipo_comprobante_modificado,
                                                    id_serie_modificado,
                                                    correlativo_modificado,
                                                    motivo_nota_credito_debito,
                                                    descripcion_motivo_nota,
                                                    fecha_emision, 
                                                    hora_emision, 
                                                    fecha_vencimiento, 
                                                    id_moneda, 
                                                    forma_pago, 
                                                    total_operaciones_gravadas, 
                                                    total_operaciones_exoneradas, 
                                                    total_operaciones_inafectas, 
                                                    total_igv, 
                                                    importe_total,
                                                    id_usuario,
                                                    pagado)
            VALUES(:id_empresa_emisora, 
                    :id_cliente, 
                    :id_serie, 
                    :serie, 
                    :correlativo, 
                    :tipo_comprobante_modificado,
                    :id_serie_modificado,
                    :correlativo_modificado,
                    :motivo_nota_credito_debito,
                    :descripcion_motivo_nota,
                    :fecha_emision, 
                    :hora_emision, 
                    :fecha_vencimiento, 
                    :id_moneda, 
                    :forma_pago, 
                    :total_operaciones_gravadas, 
                    :total_operaciones_exoneradas, 
                    :total_operaciones_inafectas, 
                    :total_igv, 
                    :importe_total,
                    :id_usuario,
                    :pagado)");
            $dbh->beginTransaction();
            $stmt->execute(array(
                ':id_empresa_emisora' => $venta['id_empresa_emisora'],
                ':id_cliente' => $venta['id_cliente'],
                ':id_serie' => $venta['id_serie'],
                ':serie' => $venta['serie'],
                ':correlativo' => $venta['correlativo'],

                ':tipo_comprobante_modificado' => $venta['tipo_comprobante_modificado'],
                ':id_serie_modificado' => $venta['id_serie_modificado'],
                ':correlativo_modificado' => $venta['correlativo_modificado'],
                ':motivo_nota_credito_debito' => $venta['motivo_nota_credito'],
                ':descripcion_motivo_nota' => $venta['descripcion_nota_credito'],

                ':fecha_emision' => $venta['fecha_emision'],
                ':hora_emision' => $venta['hora_emision'],
                ':fecha_vencimiento' => $venta['fecha_vencimiento'],
                ':id_moneda' => $venta['moneda'],
                ':forma_pago' => $venta['forma_pago'],
                ':total_operaciones_gravadas' => $venta['total_operaciones_gravadas'],
                ':total_operaciones_exoneradas' => $venta['total_operaciones_exoneradas'],
                ':total_operaciones_inafectas' => $venta['total_operaciones_inafectas'],
                ':total_igv' => $venta['total_igv'],
                ':importe_total' => $venta['total_a_pagar'],
                ':id_usuario' => $id_usuario,
                ':pagado' => 1
            ));
            $id_venta = $dbh->lastInsertId();
            $dbh->commit();

            $stmt = $dbh->prepare("UPDATE serie
                                     SET correlativo = correlativo + 1 
                                    WHERE id = :id_serie");
            $dbh->beginTransaction();
            $stmt->execute(array(
                ':id_serie' => $venta['id_serie']
            ));
            $dbh->commit();

            //Actualizar estado anulado del comprobante modificado solo cuando los motivos son anulacion

            if ($venta['motivo_nota_credito'] == '01' || $venta['motivo_nota_credito'] == '02') {

                $stmt = $dbh->prepare("UPDATE venta
                                        SET estado_respuesta_sunat = 3,
                                        estado_comprobante = 2
                                    WHERE id_serie = :id_serie 
                                    AND correlativo = :correlativo");
                $dbh->beginTransaction();
                $stmt->execute(array(
                    ':id_serie' => $venta['id_serie_modificado'],
                    ':correlativo' => $venta['correlativo_modificado']
                ));
                $dbh->commit();
            }


            //GUARDAR EL DETALLE DE LA VENTA:
            foreach ($detalle_venta as $producto) {

                $stmt = $dbh->prepare("INSERT INTO detalle_venta(id_venta, 
                                                                item, 
                                                                codigo_producto, 
                                                                descripcion, 
                                                                porcentaje_igv, 
                                                                cantidad, 
                                                                costo_unitario,
                                                                valor_unitario, 
                                                                precio_unitario, 
                                                                valor_total, 
                                                                igv, 
                                                                importe_total)
                            VALUES(:id_venta, 
                                    :item, 
                                    :codigo_producto, 
                                    :descripcion, 
                                    :porcentaje_igv, 
                                    :cantidad, 
                                    :costo_unitario,
                                    :valor_unitario, 
                                    :precio_unitario, 
                                    :valor_total, 
                                    :igv, 
                                    :importe_total

                            )");
                $dbh->beginTransaction();
                $stmt->execute(array(
                    ':id_venta' => $id_venta,
                    ':item' => $producto['item'],
                    ':codigo_producto' => $producto['codigo'],
                    ':descripcion' => $producto['descripcion'],
                    ':porcentaje_igv' => $producto['porcentaje_igv'],
                    ':cantidad' => $producto['cantidad'],
                    ':costo_unitario' => $producto['costo_unitario'],
                    ':valor_unitario' => $producto['valor_unitario'],
                    ':precio_unitario' => $producto['precio_unitario'],
                    ':valor_total' => $producto['valor_total'],
                    ':igv' => $producto['igv'],
                    ':importe_total' => $producto['importe_total']
                ));
                $dbh->commit();

                // solo se devuelve al stock cuando el motivo es anulación o devolucion
                /*
                01: Anulación de la operación
                02: Anulación por error en el RUC
                06: Devolución total
                07: Devolución por ítem
                 */
                if ($venta['motivo_nota_credito'] == '01' || $venta['motivo_nota_credito'] == '02' || $venta['motivo_nota_credito'] == '06' || $venta['motivo_nota_credito'] == '07') {
                    /* **************************************************************
                    R E G I S T R A R   K A R D E X   D E   D E V O L U C I O N
                    ************************************************************** */
                    $stmt = $dbh->prepare("call prc_registrar_kardex_anulacion(:id_venta, :codigo_producto)");

                    $dbh->beginTransaction();
                    $stmt->execute(array(
                        ':id_venta' => $id_venta_anulada,
                        ':codigo_producto' => $producto["codigo"]
                    ));

                    $dbh->commit();
                }
            }

            return  $id_venta;
        } catch (Exception $e) {
            $dbh->rollBack();
            $mensaje = $e->getMessage();
            return 0;
        }

        // return $id_venta;
        // return $mensaje;
    }

    /* =========================================================================================
    R E G I S T R A R   N O T A   D E   D E B I T O
    ========================================================================================= */
    static public function mdlRegistrarNotaDebito($venta, $detalle_venta, $id_venta_anulada)
    {

        $id_usuario = $_SESSION["usuario"]->id_usuario;

        $dbh = Conexion::conectar();

        try {

            $stmt = $dbh->prepare("INSERT INTO venta(id_empresa_emisora, 
                                                    id_cliente, 
                                                    id_serie, 
                                                    serie, 
                                                    correlativo,
                                                    tipo_comprobante_modificado,
                                                    id_serie_modificado,
                                                    correlativo_modificado,
                                                    motivo_nota_credito_debito,
                                                    descripcion_motivo_nota,
                                                    fecha_emision, 
                                                    hora_emision, 
                                                    fecha_vencimiento, 
                                                    id_moneda, 
                                                    forma_pago, 
                                                    total_operaciones_gravadas, 
                                                    total_operaciones_exoneradas, 
                                                    total_operaciones_inafectas, 
                                                    total_igv, 
                                                    importe_total,
                                                    id_usuario,
                                                    pagado)
            VALUES(:id_empresa_emisora, 
                    :id_cliente, 
                    :id_serie, 
                    :serie, 
                    :correlativo, 
                    :tipo_comprobante_modificado,
                    :id_serie_modificado,
                    :correlativo_modificado,
                    :motivo_nota_credito_debito,
                    :descripcion_motivo_nota,
                    :fecha_emision, 
                    :hora_emision, 
                    :fecha_vencimiento, 
                    :id_moneda, 
                    :forma_pago, 
                    :total_operaciones_gravadas, 
                    :total_operaciones_exoneradas, 
                    :total_operaciones_inafectas, 
                    :total_igv, 
                    :importe_total,
                    :id_usuario,
                    :pagado)");
            $dbh->beginTransaction();
            $stmt->execute(array(
                ':id_empresa_emisora' => $venta['id_empresa_emisora'],
                ':id_cliente' => $venta['id_cliente'],
                ':id_serie' => $venta['id_serie'],
                ':serie' => $venta['serie'],
                ':correlativo' => $venta['correlativo'],

                ':tipo_comprobante_modificado' => $venta['tipo_comprobante_modificado'],
                ':id_serie_modificado' => $venta['id_serie_modificado'],
                ':correlativo_modificado' => $venta['correlativo_modificado'],
                ':motivo_nota_credito_debito' => $venta['motivo_nota_debito'],
                ':descripcion_motivo_nota' => $venta['descripcion_nota_debito'],

                ':fecha_emision' => $venta['fecha_emision'],
                ':hora_emision' => $venta['hora_emision'],
                ':fecha_vencimiento' => $venta['fecha_vencimiento'],
                ':id_moneda' => $venta['moneda'],
                ':forma_pago' => $venta['forma_pago'],
                ':total_operaciones_gravadas' => $venta['total_operaciones_gravadas'],
                ':total_operaciones_exoneradas' => $venta['total_operaciones_exoneradas'],
                ':total_operaciones_inafectas' => $venta['total_operaciones_inafectas'],
                ':total_igv' => $venta['total_igv'],
                ':importe_total' => $venta['total_a_pagar'],
                ':id_usuario' => $id_usuario,
                ':pagado' => 1
            ));
            $id_venta = $dbh->lastInsertId();
            $dbh->commit();

            $stmt = $dbh->prepare("UPDATE serie
                                     SET correlativo = correlativo + 1 
                                    WHERE id = :id_serie");
            $dbh->beginTransaction();
            $stmt->execute(array(
                ':id_serie' => $venta['id_serie']
            ));
            $dbh->commit();


            //GUARDAR EL DETALLE DE LA VENTA:
            foreach ($detalle_venta as $producto) {

                $stmt = $dbh->prepare("INSERT INTO detalle_venta(id_venta, 
                                                                item, 
                                                                codigo_producto, 
                                                                descripcion, 
                                                                porcentaje_igv, 
                                                                cantidad, 
                                                                costo_unitario,
                                                                valor_unitario, 
                                                                precio_unitario, 
                                                                valor_total, 
                                                                igv, 
                                                                importe_total)
                            VALUES(:id_venta, 
                                    :item, 
                                    :codigo_producto, 
                                    :descripcion, 
                                    :porcentaje_igv, 
                                    :cantidad, 
                                    :costo_unitario,
                                    :valor_unitario, 
                                    :precio_unitario, 
                                    :valor_total, 
                                    :igv, 
                                    :importe_total

                            )");
                $dbh->beginTransaction();
                $stmt->execute(array(
                    ':id_venta' => $id_venta,
                    ':item' => $producto['item'],
                    ':codigo_producto' => $producto['codigo'],
                    ':descripcion' => $producto['descripcion'],
                    ':porcentaje_igv' => $producto['porcentaje_igv'],
                    ':cantidad' => $producto['cantidad'],
                    ':costo_unitario' => $producto['costo_unitario'],
                    ':valor_unitario' => $producto['valor_unitario'],
                    ':precio_unitario' => $producto['precio_unitario'],
                    ':valor_total' => $producto['valor_total'],
                    ':igv' => $producto['igv'],
                    ':importe_total' => $producto['importe_total']
                ));
                $dbh->commit();


                // if ($venta['motivo_nota_credito'] == '01' || $venta['motivo_nota_credito'] == '02' || $venta['motivo_nota_credito'] == '06' || $venta['motivo_nota_credito'] == '07') {
                //     /* **************************************************************
                //     R E G I S T R A R   K A R D E X   D E   D E V O L U C I O N
                //     ************************************************************** */
                //     $stmt = $dbh->prepare("call prc_registrar_kardex_anulacion(:id_venta, :codigo_producto)");

                //     $dbh->beginTransaction();
                //     $stmt->execute(array(
                //         ':id_venta' => $id_venta_anulada,
                //         ':codigo_producto' => $producto["codigo"]
                //     ));

                //     $dbh->commit();
                // }
            }

            return  $id_venta;
        } catch (Exception $e) {
            $dbh->rollBack();
            $mensaje = $e->getMessage();
            return 0;
        }
    }

    static public function mdlListarVentas($fechaDesde, $fechaHasta)
    {

        try {

            $stmt = Conexion::conectar()->prepare("SELECT Concat('Boleta Nro: ',v.nro_boleta,' - Total Venta: S./ ',Round(vc.total_venta,2)) as nro_boleta,
                                                            v.codigo_producto,
                                                            c.nombre_categoria,
                                                            p.descripcion_producto,
                                                            case when c.aplica_peso = 1 then concat(v.cantidad,' Kg(s)')
                                                            else concat(v.cantidad,' Und(s)') end as cantidad,                            
                                                            concat('S./ ',round(v.total_venta,2)) as total_venta,
                                                            v.fecha_venta
                                                            FROM venta_detalle v inner join productos p on v.codigo_producto = p.codigo_producto
                                                                                inner join venta_cabecera vc on cast(vc.nro_boleta as integer) = cast(v.nro_boleta as integer)
                                                                                inner join categorias c on c.id_categoria = p.id_categoria_producto
                                                    where DATE(v.fecha_venta) >= date(:fechaDesde) and DATE(v.fecha_venta) <= date(:fechaHasta)
                                                    order by v.nro_boleta asc");

            $stmt->bindParam(":fechaDesde", $fechaDesde, PDO::PARAM_STR);
            $stmt->bindParam(":fechaHasta", $fechaHasta, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            return 'Excepción capturada: ' .  $e->getMessage() . "\n";
        }


        $stmt = null;
    }

    static public function mdlObtenerDetalleVenta($nro_boleta)
    {

        try {

            $stmt = Conexion::conectar()->prepare("select concat('B001-',vc.nro_boleta) as nro_boleta,
                                                        vc.total_venta,
                                                        vc.fecha_venta,
                                                        vd.codigo_producto,
                                                        upper(p.descripcion_producto) as descripcion_producto,
                                                        vd.cantidad,
                                                        vd.precio_unitario_venta,
                                                        vd.total_venta
                                                from venta_cabecera vc inner join venta_detalle vd on vc.nro_boleta = vd.nro_boleta
                                                                        inner join productos p on p.codigo_producto = vd.codigo_producto
                                                where vc.nro_boleta =  :nro_boleta");

            $stmt->bindParam(":nro_boleta", $nro_boleta, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            return 'Excepción capturada: ' .  $e->getMessage() . "\n";
        }
    }

    /* =========================================================================================
    
    ========================================================================================= */
    static public function mdlObtenerTipoComprobante()
    {
        $stmt = Conexion::conectar()->prepare("select id,concat(codigo,'-',descripcion) as descripcion  from tipo_comprobante where estado = 1;");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /* =========================================================================================
    
    ========================================================================================= */
    static public function mdlObtenerMoneda()
    {
        $stmt = Conexion::conectar()->prepare("select id, concat(id, ' - ', descripcion) as descripcion  from moneda where estado = 1;");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static public function mdlObtenerSimboloMoneda($moneda)
    {
        $stmt = Conexion::conectar()->prepare("SELECT m.*  
                                                FROM moneda m
                                                where m.id = :id_moneda
                                                AND estado = 1");

        $stmt->bindParam(":id_moneda", $moneda, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }


    /* =========================================================================================
    
    ========================================================================================= */
    static public function mdlObtenerTipoDocumento()
    {
        $stmt = Conexion::conectar()->prepare("select id,concat(id, ' - ', descripcion) as descripcion  from tipo_documento where estado = 1;");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /* =========================================================================================
    
    ========================================================================================= */
    static public function mdlObtenerTipoOperacion()
    {
        $stmt = Conexion::conectar()->prepare("select codigo,concat(codigo, ' - ', descripcion) as descripcion  from tipo_operacion where estado = 1;");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /* =========================================================================================
    
    ========================================================================================= */
    static public function mdlObtenerSerieComprobante($id_filtro)
    {
        $stmt = Conexion::conectar()->prepare("select id,serie as descripcion  
                                            from serie where estado = 1 and id_tipo_comprobante = :id_filtro");
        $stmt->bindParam(":id_filtro", $id_filtro, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /* =========================================================================================
    
    ========================================================================================= */
    static public function mdlObtenerCorrelativoSerie($id_serie)
    {
        $stmt = Conexion::conectar()->prepare("SELECT (correlativo  + 1) as correlativo
                                                FROM serie 
                                                WHERE estado = 1 
                                                AND id = :id_serie");
        $stmt->bindParam(":id_serie", $id_serie, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /* =========================================================================================
    
    ========================================================================================= */
    static public function mdlObtenerFormaPago()
    {
        $stmt = Conexion::conectar()->prepare("select id, descripcion  
                                            from forma_pago where estado = 1 ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static public function mdlObtenerMedioPago()
    {
        $stmt = Conexion::conectar()->prepare("select id, descripcion  
                                            from medio_pago where estado = 1 ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /* =========================================================================================
    
    ========================================================================================= */
    static public function mdlRegistrarComprobante($datos_emisor, $array_datos_comprobante)
    {

        //obtener datos del emisor
        $doc = new DOMDocument();
        $doc->formatOutput = FALSE;
        $doc->preserveWhiteSpace = TRUE;
        $doc->encoding = 'utf-8';

        $items = array(
            'item'                 => 1
        );

        $xml = '<?xml version="1.0" encoding="utf-8"?>
                    <Invoice xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ccts="urn:un:unece:uncefact:documentation:2" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2">
                        <ext:UBLExtensions>
                            <ext:UBLExtension>
                                <ext:ExtensionContent/>
                            </ext:UBLExtension>
                        </ext:UBLExtensions>
                        <cbc:UBLVersionID>2.1</cbc:UBLVersionID>
                        <cbc:CustomizationID schemeAgencyName="PE:SUNAT">2.0</cbc:CustomizationID>
                        <cbc:ProfileID schemeName="Tipo de Operacion" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo17">' . $array_datos_comprobante['tipo_operacion'] . '</cbc:ProfileID>
                        <cbc:ID>' . $array_datos_comprobante['serie'] . '-' . $array_datos_comprobante['correlativo'] . '</cbc:ID>
                        <cbc:IssueDate>' . $array_datos_comprobante['fecha_emision'] . '</cbc:IssueDate>
                        <cbc:IssueTime>' . $array_datos_comprobante['hora_emision'] . '</cbc:IssueTime>
                        <cbc:DueDate>' . $array_datos_comprobante['fecha_vencimiento'] . '</cbc:DueDate>
                        <cbc:InvoiceTypeCode listAgencyName="PE:SUNAT" listName="Tipo de Documento" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo01" listID="0101" name="Tipo de Operacion">' . $array_datos_comprobante['tipo_comprobante'] . '</cbc:InvoiceTypeCode>
                        <cbc:DocumentCurrencyCode listID="ISO 4217 Alpha" listName="Currency" listAgencyName="United Nations Economic Commission for Europe">' . $array_datos_comprobante['moneda'] . '</cbc:DocumentCurrencyCode>
                        <cbc:LineCountNumeric>' . count($items) . '</cbc:LineCountNumeric>
                        <cac:Signature>
                            <cbc:ID>' . $array_datos_comprobante['serie'] . '-' . $array_datos_comprobante['correlativo'] . '</cbc:ID>
                            <cac:SignatoryParty>
                                <cac:PartyIdentification>
                                    <cbc:ID>' . $datos_emisor['ruc'] . '</cbc:ID>
                                </cac:PartyIdentification>
                                <cac:PartyName>
                                    <cbc:Name><![CDATA[' . $datos_emisor['razon_social'] . ']]></cbc:Name>
                                </cac:PartyName>
                            </cac:SignatoryParty>
                            <cac:DigitalSignatureAttachment>
                                <cac:ExternalReference>
                                    <cbc:URI>#SignatureSP</cbc:URI>
                                </cac:ExternalReference>
                            </cac:DigitalSignatureAttachment>
                        </cac:Signature>
                    </Invoice>';
    }

    /* =========================================================================================
    
    ========================================================================================= */
    static public function mdlObtenerDatosEmisor($id_empresa)
    {
        $stmt = Conexion::conectar()->prepare("SELECT id_empresa, 
                                                        razon_social, 
                                                        nombre_comercial, 
                                                        id_tipo_documento as tipo_documento, 
                                                        ruc, 
                                                        direccion, 
                                                        simbolo_moneda, 
                                                        email, 
                                                        telefono, 
                                                        provincia, 
                                                        departamento, 
                                                        distrito, 
                                                        ubigeo, 
                                                        usuario_sol, 
                                                        clave_sol,
                                                        certificado_digital,
                                                        clave_certificado
                                                FROM empresas
                                                where id_empresa = :id_empresa");
        $stmt->bindParam(":id_empresa", $id_empresa, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_NAMED);
    }

    static public function mdlObtenerDatosEmisorDefecto()
    {
        $stmt = Conexion::conectar()->prepare("SELECT id_empresa, 
                                                        razon_social, 
                                                        nombre_comercial, 
                                                        id_tipo_documento as tipo_documento, 
                                                        ruc, 
                                                        direccion, 
                                                        simbolo_moneda, 
                                                        email, 
                                                        telefono, 
                                                        provincia, 
                                                        departamento, 
                                                        distrito, 
                                                        ubigeo, 
                                                        usuario_sol, 
                                                        clave_sol,
                                                        certificado_digital,
                                                        clave_certificado
                                                FROM empresas
                                                LIMIT 1");

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_NAMED);
    }

    /* =========================================================================================
    
    ========================================================================================= */
    static public function mdlObtenerDatosCliente($tipo_documento, $nro_documento, $nombre_razon_social, $direccion, $telefono)
    {

        $stmt = Conexion::conectar()->prepare("SELECT id, 
                                                    id_tipo_documento as tipo_documento, 
                                                    nro_documento, 
                                                    nombres_apellidos_razon_social, 
                                                    direccion, 
                                                    telefono
                                                FROM clientes 
                                                where id_tipo_documento = :id_tipo_documento
                                                AND nro_documento = :nro_documento");

        $stmt->bindParam(":id_tipo_documento", $tipo_documento, PDO::PARAM_STR);
        $stmt->bindParam(":nro_documento", $nro_documento, PDO::PARAM_STR);
        $stmt->execute();

        $datos_cliente = $stmt->fetch(PDO::FETCH_NAMED);

        if ($datos_cliente) {
            return $datos_cliente;
        } else {

            $nro_documento = trim($nro_documento);

            $stmt = Conexion::conectar()->prepare("INSERT INTO clientes(id_tipo_documento, 
                                                                        nro_documento, 
                                                                        nombres_apellidos_razon_social, 
                                                                        direccion, 
                                                                        telefono)
                                                VALUES(:id_tipo_documento, 
                                                        trim(:nro_documento), 
                                                        :nombres_apellidos_razon_social, 
                                                        :direccion, 
                                                        :telefono)");

            $stmt->bindParam(":id_tipo_documento", $tipo_documento, PDO::PARAM_STR);
            $stmt->bindParam(":nro_documento", $nro_documento, PDO::PARAM_STR);
            $stmt->bindParam(":nombres_apellidos_razon_social", $nombre_razon_social, PDO::PARAM_STR);
            $stmt->bindParam(":direccion", $direccion, PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $telefono, PDO::PARAM_STR);

            $stmt->execute();

            $stmt = Conexion::conectar()->prepare("SELECT id, 
                                                            id_tipo_documento as tipo_documento, 
                                                            nro_documento, 
                                                            nombres_apellidos_razon_social, 
                                                            direccion, 
                                                            telefono
                                                        FROM clientes 
                                                        where id_tipo_documento = :id_tipo_documento
                                                        AND nro_documento = :nro_documento");

            $stmt->bindParam(":id_tipo_documento", $tipo_documento, PDO::PARAM_STR);
            $stmt->bindParam(":nro_documento", $nro_documento, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_NAMED);
        }
    }

    static public function mdlObtenerDatosClientePorId($id_cliente)
    {

        $stmt = Conexion::conectar()->prepare("SELECT id, 
                                                    id_tipo_documento as tipo_documento, 
                                                    nro_documento, 
                                                    nombres_apellidos_razon_social, 
                                                    direccion, 
                                                    telefono
                                                FROM clientes 
                                                where id = :id_cliente");

        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_NAMED);
    }

    /* =========================================================================================
    
    ========================================================================================= */
    static public function mdlObtenerDatosClienteXml($id_cliente)
    {

        $stmt = Conexion::conectar()->prepare("SELECT id, 
                                                    id_tipo_documento as tipo_documento, 
                                                    nro_documento, 
                                                    nombres_apellidos_razon_social, 
                                                    direccion, 
                                                    telefono
                                                FROM clientes 
                                                where id = :id_cliente");

        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_NAMED);
    }

    /* =========================================================================================
    
    ========================================================================================= */
    static public function mdlObtenerSerie($id_serie)
    {
        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM serie 
                                                where id = :id_serie");
        $stmt->bindParam(":id_serie", $id_serie, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_NAMED);
    }

    static public function mdlObtenerSeriePorTipo($id_tipo_comprobante)
    {
        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM serie 
                                                where id_tipo_comprobante = :id_tipo_comprobante
                                                LIMIT 1");

        $stmt->bindParam(":id_tipo_comprobante", $id_tipo_comprobante, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    /* =========================================================================================
    
    ========================================================================================= */
    static public function ObtenerTipoAfectacionIGV($id_tipo_afectacion)
    {
        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM tipo_afectacion_igv 
                                                where estado = 1
                                                and codigo = :id_tipo_afectacion");
        $stmt->bindParam(":id_tipo_afectacion", $id_tipo_afectacion, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_NAMED);
    }

    /* =========================================================================================
    
    ========================================================================================= */
    static public function ObtenerCostoUnitarioUnidadMedida($codigo_producto)
    {
        $stmt = Conexion::conectar()->prepare("SELECT costo_unitario, id_unidad_medida
                                                FROM productos 
                                                where codigo_producto = :codigo_producto");
        $stmt->bindParam(":codigo_producto", $codigo_producto, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_NAMED);
    }

    /* =========================================================================================
    
    ========================================================================================= */
    static public function mdlActualizarRespuestaComprobante($id_venta, $nombre_xml, $hash_signature, $codigo_error_sunat, $mensaje_respuesta_sunat, $estado_respuesta_sunat, $xml_base64, $xml_cdr_sunat_base64)
    {

        // var_dump("llego");
        // return;

        $dbh = Conexion::conectar();

        try {

            if ($hash_signature == "") {
                $stmt = $dbh->prepare("UPDATE venta
                                                SET nombre_xml = ?,
                                                codigo_error_sunat  = ?,
                                                mensaje_respuesta_sunat = ?,
                                                estado_respuesta_sunat = ?,
                                                xml_base64 = ?,
                                                xml_cdr_sunat_base64 = ?,
                                                estado_comprobante = 1
                                            WHERE id = ?");
                $dbh->beginTransaction();
                $stmt->execute(array(
                    $nombre_xml,
                    $codigo_error_sunat,
                    $mensaje_respuesta_sunat,
                    $estado_respuesta_sunat,
                    $xml_base64,
                    $xml_cdr_sunat_base64,
                    $id_venta
                ));
                $dbh->commit();
            } else {
                $stmt = $dbh->prepare("UPDATE venta
                                        SET nombre_xml = ?,
                                        codigo_error_sunat  = ?,
                                        mensaje_respuesta_sunat = ?,
                                        hash_signature = ?,
                                        estado_respuesta_sunat = ?,
                                        xml_base64 = ?,
                                        xml_cdr_sunat_base64 = ?,
                                        estado_comprobante = 1
                                    WHERE id = ?");
                $dbh->beginTransaction();
                $stmt->execute(array(
                    $nombre_xml,
                    $codigo_error_sunat,
                    $mensaje_respuesta_sunat,
                    $hash_signature,
                    $estado_respuesta_sunat,
                    $xml_base64,
                    $xml_cdr_sunat_base64,
                    $id_venta
                ));
                $dbh->commit();
            }
        } catch (Exception $e) {
            $dbh->rollBack();
        }

        return "OK";
    }

    /* =========================================================================================
    
    ========================================================================================= */
    static public function mdlObtenerListadoBoletas($post)
    {

        $id_usuario = $_SESSION["usuario"]->id_usuario;

        $columns = [
            "id",
            "comprobante",
            "forma_pago",
            "fecha_emision",
            "ope_gravadas",
            "ope_exoneradas",
            "ope_inafectas",
            "total_igv",
            "importe_total",
            "estado_respuesta_sunat",
            "estado_sunat",
            "nombre_xml",
            "estado_comprobante",
            "mensaje_respuesta_sunat"
        ];

        $query = ' SELECT 
                         "" as opciones,
                         v.id,
                        concat(v.serie,"-",v.correlativo) as comprobante, 
                        v.fecha_emision,
                        upper(forma_pago) as forma_pago,
                        concat(mon.simbolo,format(v.total_operaciones_gravadas,2)) as ope_gravadas,
                        concat(mon.simbolo,format(v.total_operaciones_exoneradas,2)) as ope_exoneradas,
                        concat(mon.simbolo,format(v.total_operaciones_inafectas,2)) as ope_inafectas,
                        concat(mon.simbolo,format(v.total_igv,2)) as igv,
                        concat(mon.simbolo,format(v.importe_total,2)) as importe_total,
                        v.estado_respuesta_sunat,
                        case when v.estado_respuesta_sunat = 2 then "Rechazado!... enviado con errores"
                            when v.estado_respuesta_sunat = 1 then "Comprobante enviado correctamente"
                            when v.estado_respuesta_sunat is null then "Pendiente de envío"
                        end as estado_sunat,
                        nombre_xml,
                        estado_comprobante,
                        mensaje_respuesta_sunat
                from venta v inner join serie s on v.id_serie = s.id
                             inner join moneda mon on mon.id = v.id_moneda';

        // var_dump($post["search"]["value"]);

        if (isset($post["search"]["value"])) {
            $query .= '  WHERE s.id_tipo_comprobante = "03"
                        AND v.id_usuario = "' . $id_usuario . '"
                        AND (v.serie like "%' . $post["search"]["value"] . '%"
                             or v.correlativo like "%' . $post["search"]["value"] . '%"
                             or concat(v.serie,"-",v.correlativo) like "%' . $post["search"]["value"] . '%"
                             or v.fecha_emision like "%' . $post["search"]["value"] . '%")';
        }

        if (isset($post["order"])) {
            $query .= ' ORDER BY ' . $columns[$post['order']['0']['column']] . ' ' . $post['order']['0']['dir'] . ' ';
        } else {
            $query .= ' ORDER BY v.id desc ';
        }

        //SE AGREGA PAGINACION
        if ($post["length"] != -1) {
            $query1 = " LIMIT " . $post["start"] . ", " . $post["length"];
        }

        $stmt = Conexion::conectar()->prepare($query);

        // var_dump($query);

        $stmt->execute();

        $number_filter_row = $stmt->rowCount();

        $stmt =  Conexion::conectar()->prepare($query . $query1);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_NAMED);

        $data = array();

        foreach ($results as $row) {
            $sub_array = array();
            $sub_array[] = $row['opciones']; //0
            $sub_array[] = $row['id']; //1
            $sub_array[] = $row['comprobante']; //2
            $sub_array[] = $row['fecha_emision'];//3
            $sub_array[] = $row['forma_pago'];//4
            $sub_array[] = $row['ope_gravadas'];//5
            $sub_array[] = $row['ope_exoneradas'];//6
            $sub_array[] = $row['ope_inafectas'];//7
            $sub_array[] = $row['igv'];//8
            $sub_array[] = $row['importe_total'];//9
            $sub_array[] = $row['estado_respuesta_sunat'];//10
            $sub_array[] = $row['estado_sunat'];//11
            $sub_array[] = $row['nombre_xml'];//12
            $sub_array[] = $row['estado_comprobante'];//13
            $sub_array[] = $row['mensaje_respuesta_sunat'];//14
            $data[] = $sub_array;
        }

        $stmt = Conexion::conectar()->prepare(" SELECT 1
                                                from venta v inner join serie s on v.id_serie = s.id
                                                where s.id_tipo_comprobante = '03'");

        $stmt->execute();

        $count_all_data = $stmt->rowCount();

        $clientes = array(
            'draw' => $post['draw'],
            "recordsTotal" => $count_all_data,
            "recordsFiltered" => $number_filter_row,
            "data" => $data
        );

        return $clientes;
    }

    /* =========================================================================================
    
    ========================================================================================= */
    static public function mdlObtenerListadoBoletasPorFecha($post, $fecha_emision, $id_empresa)
    {

        $columns = [
            "id",
            "comprobante",
            "fecha_emision",
            "ope_gravadas",
            "ope_exoneradas",
            "ope_inafectas",
            "total_igv",
            "importe_total",
            "estado_respuesta_sunat",
            "estado_sunat",
            "nombre_xml"
        ];

        $query = " SELECT 
                         v.id,
                        concat(v.serie,'-',v.correlativo) as comprobante, 
                        v.fecha_emision,
                        concat(mon.simbolo,format(v.total_operaciones_gravadas,2)) as ope_gravadas,
                        concat(mon.simbolo,format(v.total_operaciones_exoneradas,2)) as ope_exoneradas,
                        concat(mon.simbolo,format(v.total_operaciones_inafectas,2)) as ope_inafectas,
                        concat(mon.simbolo,format(v.total_igv,2)) as igv,
                        concat(mon.simbolo,format(v.importe_total,2)) as importe_total,
                        v.estado_respuesta_sunat,
                        case when v.estado_respuesta_sunat = 2 then 'Enviado, con errores'
                            when v.estado_respuesta_sunat = 1 then 'Comprobante enviado correctamente'
                            when v.estado_respuesta_sunat is null then 'Pendiente de envío'
                        end as estado_sunat,
                        nombre_xml
                from venta v inner join serie s on v.id_serie = s.id
                             inner join moneda mon on mon.id = v.id_moneda";

        if (isset($post["search"]["value"])) {
            $query .= '  WHERE s.id_tipo_comprobante = "03"  
                        AND date(v.fecha_emision) = "' . $fecha_emision . '"
                        AND v.id_empresa_emisora = "' . $id_empresa . '"
                        AND ifnull(estado_respuesta_sunat,0) <> 1
                        AND ( v.serie like "%' . $post["search"]["value"] . '%" 
                                or ( case when v.estado_respuesta_sunat = 2 then "Enviado, con errores"
                                when v.estado_respuesta_sunat = 1 then "Comprobante enviado correctamente"
                                when v.estado_respuesta_sunat is null then "Pendiente de envío"
                            end) like "%' . $post["search"]["value"] . '%"                      
                        or v.correlativo like "%' . $post["search"]["value"] . '%")';
        }

        if (isset($post["order"])) {
            $query .= ' ORDER BY ' . $columns[$post['order']['0']['column']] . ' ' . $post['order']['0']['dir'] . ' ';
        } else {
            $query .= ' ORDER BY v.id desc ';
        }

        //SE AGREGA PAGINACION
        if ($post["length"] != -1) {
            $query1 = " LIMIT " . $post["start"] . ", " . $post["length"];
        }

        $stmt = Conexion::conectar()->prepare($query);

        $stmt->execute();

        $number_filter_row = $stmt->rowCount();

        $stmt =  Conexion::conectar()->prepare($query . $query1);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_NAMED);

        $data = array();

        foreach ($results as $row) {
            $sub_array = array();
            $sub_array[] = $row['id'];
            $sub_array[] = $row['comprobante'];
            $sub_array[] = $row['fecha_emision'];
            $sub_array[] = $row['ope_gravadas'];
            $sub_array[] = $row['ope_exoneradas'];
            $sub_array[] = $row['ope_inafectas'];
            $sub_array[] = $row['igv'];
            $sub_array[] = $row['importe_total'];
            $sub_array[] = $row['estado_respuesta_sunat'];
            $sub_array[] = $row['estado_sunat'];
            $sub_array[] = $row['nombre_xml'];
            $data[] = $sub_array;
        }

        $stmt = Conexion::conectar()->prepare(" SELECT 1
                                                from venta v inner join serie s on v.id_serie = s.id
                                                where s.id_tipo_comprobante = '03'");

        $stmt->execute();

        $count_all_data = $stmt->rowCount();

        $clientes = array(
            'draw' => $post['draw'],
            "recordsTotal" => $count_all_data,
            "recordsFiltered" => $number_filter_row,
            "data" => $data
        );

        return $clientes;
    }

    /* =========================================================================================
    
    ========================================================================================= */
    static public function mdlObtenerListadoFacturas($post)
    {

        $id_usuario = $_SESSION["usuario"]->id_usuario;

        $columns = [
            "id",
            "comprobante",
            "fecha_emision",
            "forma_pago",
            "ope_gravadas",
            "ope_exoneradas",
            "ope_inafectas",
            "total_igv",
            "importe_total",
            "estado_respuesta_sunat",
            "estado_sunat",
            "nombre_xml",
            "estado_comprobante",
            "mensaje_respuesta_sunat"
        ];

        $query = " SELECT 
                         '' as opciones,
                         v.id,
                        concat(v.serie,'-',v.correlativo) as comprobante, 
                        v.fecha_emision,
                        upper(forma_pago) as forma_pago,
                        concat(mon.simbolo,format(v.total_operaciones_gravadas,2)) as ope_gravadas,
                        concat(mon.simbolo,format(v.total_operaciones_exoneradas,2)) as ope_exoneradas,
                        concat(mon.simbolo,format(v.total_operaciones_inafectas,2)) as ope_inafectas,
                        concat(mon.simbolo,format(v.total_igv,2)) as igv,
                        concat(mon.simbolo,format(v.importe_total,2)) as importe_total,
                        v.estado_respuesta_sunat,
                        case when v.estado_respuesta_sunat = 2 then 'Enviado, con errores'
                            when v.estado_respuesta_sunat = 1 then 'Comprobante enviado correctamente'
                            when v.estado_respuesta_sunat is null then 'Pendiente de envío'
                        end as estado_sunat,
                        nombre_xml,
                        estado_comprobante,
                        mensaje_respuesta_sunat
                from venta v inner join serie s on v.id_serie = s.id
                             inner join moneda mon on mon.id = v.id_moneda";

        if (isset($post["search"]["value"])) {
            $query .= '  WHERE s.id_tipo_comprobante = "01"
                AND v.id_usuario = "' . $id_usuario . '"
                AND (v.serie like "%' . $post["search"]["value"] . '%"
                     or v.correlativo like "%' . $post["search"]["value"] . '%"
                     or concat(v.serie,"-",v.correlativo) like "%' . $post["search"]["value"] . '%"
                     or v.fecha_emision like "%' . $post["search"]["value"] . '%")';
        }

        if (isset($post["order"])) {
            $query .= ' ORDER BY ' . $columns[$post['order']['0']['column']] . ' ' . $post['order']['0']['dir'] . ' ';
        } else {
            $query .= ' ORDER BY v.id desc ';
        }

        //SE AGREGA PAGINACION
        if ($post["length"] != -1) {
            $query1 = " LIMIT " . $post["start"] . ", " . $post["length"];
        }

        $stmt = Conexion::conectar()->prepare($query);

        $stmt->execute();

        $number_filter_row = $stmt->rowCount();

        $stmt =  Conexion::conectar()->prepare($query . $query1);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_NAMED);

        $data = array();

        foreach ($results as $row) {
            $sub_array = array();
            // $sub_array[] = $row['detalles'];
            $sub_array[] = $row['opciones'];
            $sub_array[] = $row['id'];
            $sub_array[] = $row['comprobante'];
            $sub_array[] = $row['fecha_emision'];
            $sub_array[] = $row['forma_pago'];
            $sub_array[] = $row['ope_gravadas'];
            $sub_array[] = $row['ope_exoneradas'];
            $sub_array[] = $row['ope_inafectas'];
            $sub_array[] = $row['igv'];
            $sub_array[] = $row['importe_total'];
            $sub_array[] = $row['estado_respuesta_sunat'];
            $sub_array[] = $row['estado_sunat'];
            $sub_array[] = $row['nombre_xml'];
            $sub_array[] = $row['estado_comprobante'];
            $sub_array[] = $row['mensaje_respuesta_sunat'];
            $data[] = $sub_array;
        }

        $stmt = Conexion::conectar()->prepare(" SELECT 1
                                                from venta v inner join serie s on v.id_serie = s.id
                                                where s.id_tipo_comprobante = '03'");

        $stmt->execute();

        $count_all_data = $stmt->rowCount();

        $clientes = array(
            'draw' => $post['draw'],
            "recordsTotal" => $count_all_data,
            "recordsFiltered" => $number_filter_row,
            "data" => $data
        );

        return $clientes;
    }

    static public function mdlObtenerListadoNotasVenta($post)
    {

        $id_usuario = $_SESSION["usuario"]->id_usuario;

        $columns = [
            "id",
            "comprobante",
            "fecha_emision",
            "ope_gravadas",
            "ope_exoneradas",
            "ope_inafectas",
            "total_igv",
            "importe_total",
            "estado_comprobante"
        ];

        $query = " SELECT 
                         '' as opciones,
                         v.id,
                        concat(v.serie,'-',v.correlativo) as comprobante, 
                        v.fecha_emision,
                        concat(mon.simbolo,format(v.total_operaciones_gravadas,2)) as ope_gravadas,
                        concat(mon.simbolo,format(v.total_operaciones_exoneradas,2)) as ope_exoneradas,
                        concat(mon.simbolo,format(v.total_operaciones_inafectas,2)) as ope_inafectas,
                        concat(mon.simbolo,format(v.total_igv,2)) as igv,
                        concat(mon.simbolo,format(v.importe_total,2)) as importe_total,                        
                        estado_comprobante
                from venta v inner join serie s on v.id_serie = s.id
                             inner join moneda mon on mon.id = v.id_moneda";

        if (isset($post["search"]["value"])) {
            $query .= '  WHERE s.id_tipo_comprobante = "NV"
                AND v.id_usuario = "' . $id_usuario . '"
                AND (v.serie like "%' . $post["search"]["value"] . '%"
                     or v.correlativo like "%' . $post["search"]["value"] . '%"
                     or concat(v.serie,"-",v.correlativo) like "%' . $post["search"]["value"] . '%"
                     or v.fecha_emision like "%' . $post["search"]["value"] . '%")';
        }

        if (isset($post["order"])) {
            $query .= ' ORDER BY ' . $columns[$post['order']['0']['column']] . ' ' . $post['order']['0']['dir'] . ' ';
        } else {
            $query .= ' ORDER BY v.id desc ';
        }

        //SE AGREGA PAGINACION
        if ($post["length"] != -1) {
            $query1 = " LIMIT " . $post["start"] . ", " . $post["length"];
        }

        $stmt = Conexion::conectar()->prepare($query);

        $stmt->execute();

        $number_filter_row = $stmt->rowCount();

        $stmt =  Conexion::conectar()->prepare($query . $query1);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_NAMED);

        $data = array();

        foreach ($results as $row) {
            $sub_array = array();
            // $sub_array[] = $row['detalles'];
            $sub_array[] = $row['opciones']; //0
            $sub_array[] = $row['id']; //1
            $sub_array[] = $row['comprobante']; //2
            $sub_array[] = $row['fecha_emision']; //3
            $sub_array[] = $row['ope_gravadas']; //4
            $sub_array[] = $row['ope_exoneradas']; //5
            $sub_array[] = $row['ope_inafectas']; //6
            $sub_array[] = $row['igv']; //7
            $sub_array[] = $row['importe_total'];            //8
            $sub_array[] = $row['estado_comprobante']; //9
            $data[] = $sub_array;
        }

        $stmt = Conexion::conectar()->prepare(" SELECT 1
                                                from venta v inner join serie s on v.id_serie = s.id
                                                where s.id_tipo_comprobante = 'NV'");

        $stmt->execute();

        $count_all_data = $stmt->rowCount();

        $clientes = array(
            'draw' => $post['draw'],
            "recordsTotal" => $count_all_data,
            "recordsFiltered" => $number_filter_row,
            "data" => $data
        );

        return $clientes;
    }

    /* =========================================================================================
    
    ========================================================================================= */
    static public function mdlObtenerListadoNotasCredito($post)
    {

        $id_usuario = $_SESSION["usuario"]->id_usuario;

        $columns = [
            "id",
            "comprobante",
            "comprobante_modificado",
            "motivo_nota_credito",
            "fecha_emision",
            "ope_gravadas",
            "ope_exoneradas",
            "ope_inafectas",
            "total_igv",
            "importe_total",
            "importe_total_referencia",
            "estado_respuesta_sunat",
            "estado_sunat",
            "nombre_xml",
            "estado_comprobante",
            "mensaje_respuesta_sunat"
        ];

        $query = " SELECT 
                         '' as opciones,
                         v.id,
                        concat(v.serie,'-',v.correlativo) as comprobante, 
                        concat(snc.serie,'-',v.correlativo_modificado) as comprobante_modificado, 
                        mnc.descripcion as motivo_nota_credito,
                        v.fecha_emision,
                        concat(mon.simbolo,format(v.total_operaciones_gravadas,2)) as ope_gravadas,
                        concat(mon.simbolo,format(v.total_operaciones_exoneradas,2)) as ope_exoneradas,
                        concat(mon.simbolo,format(v.total_operaciones_inafectas,2)) as ope_inafectas,
                        concat(mon.simbolo,format(v.total_igv,2)) as igv,
                        concat(mon.simbolo,format(v.importe_total,2)) as importe_total,                        
                        (select concat(mon.simbolo,format(v1.importe_total,2)) from venta v1 where v1.id_serie = v.id_serie_modificado and v1.correlativo = v.correlativo_modificado) as importe_total_referencia,
                        v.estado_respuesta_sunat,
                        case when v.estado_respuesta_sunat = 2 then 'Enviado, con errores'
                            when v.estado_respuesta_sunat = 1 then 'Comprobante enviado correctamente'
                            when v.estado_respuesta_sunat is null then 'Pendiente de envío'
                        end as estado_sunat,
                        nombre_xml,
                        estado_comprobante,
                        mensaje_respuesta_sunat
                from venta v inner join serie s on v.id_serie = s.id
                            inner join serie snc on v.id_serie_modificado = snc.id
                            inner join motivos_notas mnc on mnc.codigo = v.motivo_nota_credito_debito and mnc.tipo = 'C'
                            inner join moneda mon on mon.id = v.id_moneda";

        if (isset($post["search"]["value"])) {
            $query .= '  WHERE s.id_tipo_comprobante = "07"            
                AND v.id_usuario = "' . $id_usuario . '"
                AND (v.serie like "%' . $post["search"]["value"] . '%"
                     or v.correlativo like "%' . $post["search"]["value"] . '%"
                     or concat(v.serie,"-",v.correlativo) like "%' . $post["search"]["value"] . '%"
                     or v.fecha_emision like "%' . $post["search"]["value"] . '%")';
        }

        if (isset($post["order"])) {
            $query .= ' ORDER BY ' . $columns[$post['order']['0']['column']] . ' ' . $post['order']['0']['dir'] . ' ';
        } else {
            $query .= ' ORDER BY v.id desc ';
        }

        //SE AGREGA PAGINACION
        if ($post["length"] != -1) {
            $query1 = " LIMIT " . $post["start"] . ", " . $post["length"];
        }

        $stmt = Conexion::conectar()->prepare($query);

        $stmt->execute();

        $number_filter_row = $stmt->rowCount();

        $stmt =  Conexion::conectar()->prepare($query . $query1);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_NAMED);

        $data = array();

        foreach ($results as $row) {
            $sub_array = array();
            // $sub_array[] = $row['detalles'];
            $sub_array[] = $row['opciones']; //0
            $sub_array[] = $row['id']; //1
            $sub_array[] = $row['comprobante']; //2
            $sub_array[] = $row['comprobante_modificado']; //3
            $sub_array[] = $row['motivo_nota_credito']; //4
            $sub_array[] = $row['fecha_emision']; //5
            $sub_array[] = $row['ope_gravadas']; //6
            $sub_array[] = $row['ope_exoneradas']; //7
            $sub_array[] = $row['ope_inafectas']; //8
            $sub_array[] = $row['igv']; //9
            $sub_array[] = $row['importe_total']; //10
            $sub_array[] = $row['importe_total_referencia']; //11
            $sub_array[] = $row['estado_respuesta_sunat']; //12
            $sub_array[] = $row['estado_sunat']; //13
            $sub_array[] = $row['nombre_xml']; //14
            $sub_array[] = $row['estado_comprobante']; //15
            $sub_array[] = $row['mensaje_respuesta_sunat']; //16
            $data[] = $sub_array;
        }

        $stmt = Conexion::conectar()->prepare(" SELECT 1
                                                from venta v inner join serie s on v.id_serie = s.id
                                                where s.id_tipo_comprobante = '07'");

        $stmt->execute();

        $count_all_data = $stmt->rowCount();

        $clientes = array(
            'draw' => $post['draw'],
            "recordsTotal" => $count_all_data,
            "recordsFiltered" => $number_filter_row,
            "data" => $data
        );

        return $clientes;
    }

    static public function mdlObtenerListadoNotasDebito($post)
    {

        $id_usuario = $_SESSION["usuario"]->id_usuario;

        $columns = [
            "id",
            "comprobante",
            "comprobante_modificado",
            "motivo_nota_credito",
            "fecha_emision",
            "ope_gravadas",
            "ope_exoneradas",
            "ope_inafectas",
            "total_igv",
            "importe_total",
            "importe_total_referencia",
            "estado_respuesta_sunat",
            "estado_sunat",
            "nombre_xml",
            "estado_comprobante",
            "mensaje_respuesta_sunat"
        ];

        $query = " SELECT 
                         '' as opciones,
                         v.id,
                        concat(v.serie,'-',v.correlativo) as comprobante, 
                        concat(snc.serie,'-',v.correlativo_modificado) as comprobante_modificado, 
                        mnc.descripcion as motivo_nota_credito,
                        v.fecha_emision,
                        concat(mon.simbolo,format(v.total_operaciones_gravadas,2)) as ope_gravadas,
                        concat(mon.simbolo,format(v.total_operaciones_exoneradas,2)) as ope_exoneradas,
                        concat(mon.simbolo,format(v.total_operaciones_inafectas,2)) as ope_inafectas,
                        concat(mon.simbolo,format(v.total_igv,2)) as igv,
                        concat(mon.simbolo,format(v.importe_total,2)) as importe_total,                        
                        (select concat(mon.simbolo,format(v1.importe_total,2)) from venta v1 where v1.id_serie = v.id_serie_modificado and v1.correlativo = v.correlativo_modificado) as importe_total_referencia,
                        v.estado_respuesta_sunat,
                        case when v.estado_respuesta_sunat = 2 then 'Enviado, con errores'
                            when v.estado_respuesta_sunat = 1 then 'Comprobante enviado correctamente'
                            when v.estado_respuesta_sunat is null then 'Pendiente de envío'
                        end as estado_sunat,
                        nombre_xml,
                        estado_comprobante,
                        mensaje_respuesta_sunat
                from venta v inner join serie s on v.id_serie = s.id
                            inner join serie snc on v.id_serie_modificado = snc.id
                            inner join motivos_notas mnc on mnc.codigo = v.motivo_nota_credito_debito and mnc.tipo = 'C'
                            inner join moneda mon on mon.id = v.id_moneda";

        if (isset($post["search"]["value"])) {
            $query .= '  WHERE s.id_tipo_comprobante = "08"            
                AND v.id_usuario = "' . $id_usuario . '"
                AND (v.serie like "%' . $post["search"]["value"] . '%"
                     or v.correlativo like "%' . $post["search"]["value"] . '%"
                     or concat(v.serie,"-",v.correlativo) like "%' . $post["search"]["value"] . '%"
                     or v.fecha_emision like "%' . $post["search"]["value"] . '%")';
        }

        if (isset($post["order"])) {
            $query .= ' ORDER BY ' . $columns[$post['order']['0']['column']] . ' ' . $post['order']['0']['dir'] . ' ';
        } else {
            $query .= ' ORDER BY v.id desc ';
        }

        //SE AGREGA PAGINACION
        if ($post["length"] != -1) {
            $query1 = " LIMIT " . $post["start"] . ", " . $post["length"];
        }

        $stmt = Conexion::conectar()->prepare($query);

        $stmt->execute();

        $number_filter_row = $stmt->rowCount();

        $stmt =  Conexion::conectar()->prepare($query . $query1);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_NAMED);

        $data = array();

        foreach ($results as $row) {
            $sub_array = array();
            // $sub_array[] = $row['detalles'];
            $sub_array[] = $row['opciones']; //0
            $sub_array[] = $row['id']; //1
            $sub_array[] = $row['comprobante']; //2
            $sub_array[] = $row['comprobante_modificado']; //3
            $sub_array[] = $row['motivo_nota_credito']; //4
            $sub_array[] = $row['fecha_emision']; //5
            $sub_array[] = $row['ope_gravadas']; //6
            $sub_array[] = $row['ope_exoneradas']; //7
            $sub_array[] = $row['ope_inafectas']; //8
            $sub_array[] = $row['igv']; //9
            $sub_array[] = $row['importe_total']; //10
            $sub_array[] = $row['importe_total_referencia']; //11
            $sub_array[] = $row['estado_respuesta_sunat']; //12
            $sub_array[] = $row['estado_sunat']; //13
            $sub_array[] = $row['nombre_xml']; //14
            $sub_array[] = $row['estado_comprobante']; //15
            $sub_array[] = $row['mensaje_respuesta_sunat']; //16
            $data[] = $sub_array;
        }

        $stmt = Conexion::conectar()->prepare(" SELECT 1
                                                from venta v inner join serie s on v.id_serie = s.id
                                                where s.id_tipo_comprobante = '08'");

        $stmt->execute();

        $count_all_data = $stmt->rowCount();

        $clientes = array(
            'draw' => $post['draw'],
            "recordsTotal" => $count_all_data,
            "recordsFiltered" => $number_filter_row,
            "data" => $data
        );

        return $clientes;
    }

    /* =========================================================================================
    
    ========================================================================================= */
    static public function mdlObtenerVentaPorId($id_venta)
    {

        $stmt = Conexion::conectar()->prepare("SELECT e.id_empresa,
                                                    e.logo,
                                                    v.id_cliente,
                                                    e.razon_social as empresa,
                                                    e.ruc,
                                                    e.direccion as direccion_empresa,
                                                    concat(e.provincia  ,'-' ,e.departamento ,'-' ,e.distrito) as ubigeo,
                                                    s.id_tipo_comprobante,
                                                    v.serie,
                                                    v.correlativo,
                                                    v.fecha_emision,
                                                    v.hora_emision,
                                                    u.usuario as cajero,
                                                    u.nombre_usuario as nombre_cajero,
                                                    u.apellido_usuario as apellido_cajero,
                                                    format(v.total_operaciones_gravadas,2) as ope_gravada,
                                                    format(v.total_operaciones_exoneradas,2) as ope_inafecta,
                                                    format(v.total_operaciones_inafectas,2) as ope_exonerada,
                                                    format(v.total_igv,2) as total_igv,
                                                    format(v.importe_total,2) as importe_total,
                                                    c.id_tipo_documento,
                                                    c.nro_documento,
                                                    c.nombres_apellidos_razon_social,
                                                    c.direccion,
                                                    c.telefono,
                                                    v.hash_signature,
                                                    m.simbolo,
                                                    v.forma_pago
                                            FROM venta v inner join empresas e on v.id_empresa_emisora = e.id_empresa
                                                        inner join moneda m on m.id = v.id_moneda
                                                        inner join serie s on s.id = v.id_serie
                                                        inner join clientes c on c.id = v.id_cliente
                                                        inner join usuarios u on u.id_usuario = v.id_usuario
                                            WHERE v.id = :id_venta");
        $stmt->bindParam(":id_venta", $id_venta, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_NAMED);
    }

    static public function mdlObtenerVentaPorIdTicket($id_venta)
    {

        $stmt = Conexion::conectar()->prepare("SELECT e.id_empresa,
                                                    e.logo,
                                                    v.id_cliente,
                                                    e.razon_social as empresa,
                                                    e.nombre_comercial as nombre_comercial,
                                                    e.ruc,
                                                    e.direccion as direccion_empresa,
                                                    concat(e.provincia  ,'-' ,e.departamento ,'-' ,e.distrito) as ubigeo,
                                                    s.id_tipo_comprobante,
                                                    v.serie,
                                                    v.correlativo,
                                                    v.fecha_emision,
                                                    v.hora_emision,
                                                    u.usuario as cajero,
                                                    u.nombre_usuario as nombre_cajero,
                                                    u.apellido_usuario as apellido_cajero,
                                                    format(v.total_operaciones_gravadas,2) as ope_gravada,
                                                    format(v.total_operaciones_exoneradas,2) as ope_exonerada,
                                                    format(v.total_operaciones_inafectas,2) as ope_inafecta,
                                                    format(v.total_igv,2) as total_igv,
                                                    format(v.importe_total,2) as importe_total,
                                                    c.id_tipo_documento,
                                                    c.nro_documento,
                                                    c.nombres_apellidos_razon_social ,
                                                    c.direccion,
                                                    c.telefono,
                                                    v.hash_signature,
                                                    m.simbolo,
                                                    v.forma_pago,
                                                    format(v.efectivo_recibido,2) as efectivo_recibido,
                                                    format(v.vuelto,2) as vuelto
                                            FROM venta v inner join empresas e on v.id_empresa_emisora = e.id_empresa
                                                        inner join moneda m on m.id = v.id_moneda
                                                        inner join serie s on s.id = v.id_serie
                                                        inner join clientes c on c.id = v.id_cliente
                                                        inner join usuarios u on u.id_usuario = v.id_usuario
                                            WHERE v.id = :id_venta");
        $stmt->bindParam(":id_venta", $id_venta, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_NAMED);
    }

    static public function mdlObtenerVentaPorIdFormatoA4($id_venta)
    {

        $stmt = Conexion::conectar()->prepare("SELECT e.id_empresa,
                                                        e.logo,
                                                        v.id_cliente,
                                                        e.razon_social as empresa,
                                                        e.ruc,
                                                        e.direccion as direccion_empresa,
                                                        e.telefono as telefono_empresa,
                                                        e.email,
                                                        concat(e.provincia  ,'-' ,e.departamento ,'-' ,e.distrito) as ubigeo,
                                                        e.bcp_cci,
                                                        bbva_cci,
                                                        yape,
                                                        s.id_tipo_comprobante,
                                                        v.serie,
                                                        v.correlativo,
                                                        v.id_serie_modificado,
                                                        sm.serie as serie_modificado,
                                                        v.correlativo_modificado,
                                                        mn.descripcion as motivo_nota,
                                                        v.descripcion_motivo_nota,
                                                        v.fecha_emision,
                                                        v.hora_emision,
                                                        u.usuario as cajero,
                                                        u.nombre_usuario as nombre_cajero,
                                                        u.apellido_usuario as apellido_cajero,
                                                        format(v.total_operaciones_gravadas,2) as ope_gravada,
                                                        format(v.total_operaciones_exoneradas,2) as ope_exonerada,
                                                        format(v.total_operaciones_inafectas,2) as ope_inafecta,
                                                        format(v.total_operaciones_gravadas + v.total_operaciones_exoneradas + v.total_operaciones_inafectas,2) as subtotal,
                                                        format(v.total_igv,2) as total_igv,
                                                        format(v.importe_total,2) as importe_total,
                                                        c.id_tipo_documento,
                                                        c.nro_documento,
                                                        c.nombres_apellidos_razon_social,
                                                        c.direccion,
                                                        c.telefono,
                                                        v.hash_signature,
                                                        m.simbolo,
                                                        v.forma_pago
                                                    FROM venta v inner join empresas e on v.id_empresa_emisora = e.id_empresa
                                                        inner join moneda m on m.id = v.id_moneda
                                                        inner join serie s on s.id = v.id_serie
                                                        left join serie sm on sm.id = v.id_serie_modificado
                                                        left join clientes c on c.id = v.id_cliente
                                                        inner join usuarios u on u.id_usuario = v.id_usuario
                                                        left join motivos_notas mn on mn.codigo = v.motivo_nota_credito_debito and mn.tipo = 'C'
                                            WHERE v.id = :id_venta");
        $stmt->bindParam(":id_venta", $id_venta, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_NAMED);
    }

    static public function mdlObtenerVentaPorIdXml($id_venta)
    {

        $stmt = Conexion::conectar()->prepare("SELECT e.id_empresa,
                                                    v.id_cliente,
                                                    v.tipo_operacion,
                                                    s.id_tipo_comprobante as tipo_comprobante,
                                                    v.id_serie,
                                                    v.serie,
                                                    v.correlativo,
                                                    v.fecha_emision,
                                                    v.hora_emision,
                                                    v.fecha_vencimiento,
                                                    v.id_moneda as moneda,
                                                    v.forma_pago,
                                                    round(ifnull(v.total_operaciones_gravadas,0) + ifnull(v.total_operaciones_exoneradas,0) + ifnull(v.total_operaciones_inafectas,0) + ifnull(v.total_igv,0),2) as monto_credito,
                                                    round(v.total_igv,2) as total_impuestos,
                                                    round(v.total_operaciones_gravadas,2) as total_operaciones_gravadas,
                                                    round(v.total_operaciones_exoneradas,2) as total_operaciones_exoneradas,
                                                    round(v.total_operaciones_inafectas,2) as total_operaciones_inafectas,
                                                    round(v.total_igv,2) as total_igv,
                                                    round(ifnull(v.total_operaciones_gravadas,0) + ifnull(v.total_operaciones_exoneradas,0) + ifnull(v.total_operaciones_inafectas,0),2) as total_sin_impuestos,
                                                    round(ifnull(v.total_operaciones_gravadas,0) + ifnull(v.total_operaciones_exoneradas,0) + ifnull(v.total_operaciones_inafectas,0) + ifnull(v.total_igv,0),2) as total_con_impuestos,
                                                    round(ifnull(v.total_operaciones_gravadas,0) + ifnull(v.total_operaciones_exoneradas,0) + ifnull(v.total_operaciones_inafectas,0) + ifnull(v.total_igv,0),2) as total_a_pagar
                                            FROM venta v inner join empresas e on v.id_empresa_emisora = e.id_empresa
                                                        inner join moneda m on m.id = v.id_moneda
                                                        inner join serie s on s.id = v.id_serie
                                                        inner join clientes c on c.id = v.id_cliente
                                            WHERE v.id = :id_venta");
        $stmt->bindParam(":id_venta", $id_venta, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_NAMED);
    }

    static public function mdlObtenerVentaParaResumen($id_venta)
    {

        $stmt = Conexion::conectar()->prepare("SELECT v.id,
                                                s.id_tipo_comprobante,
                                                v.serie,
                                                v.correlativo,
                                                v.id_moneda,	
                                                v.total_operaciones_gravadas,
                                                v.total_operaciones_exoneradas,
                                                v.total_operaciones_inafectas,
                                                v.total_igv,
                                                v.importe_total	
                                            FROM venta v  inner join serie s on s.id = v.id_serie
                                            WHERE v.id = :id_venta");
        $stmt->bindParam(":id_venta", $id_venta, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_NAMED);
    }

    static public function mdlObtenerDetalleVentaPorId($id_venta)
    {

        $stmt = Conexion::conectar()->prepare("SELECT dv.codigo_producto, 
                                                    dv.descripcion,
                                                    dv.cantidad,
                                                    format(dv.precio_unitario,2) as precio_unitario,
                                                    format(dv.importe_total,2) as importe_total
                                            FROM detalle_venta dv 
                                            WHERE dv.id_venta  = :id_venta");
        $stmt->bindParam(":id_venta", $id_venta, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_NAMED);
    }

    static public function mdlObtenerDetalleVentaPorIdXml($id_venta)
    {

        $stmt = Conexion::conectar()->prepare("SELECT dv.item,
                                                    dv.codigo_producto, 
                                                    dv.descripcion,
                                                    dv.porcentaje_igv,
                                                    p.id_tipo_afectacion_igv,
                                                    p.id_unidad_medida as unidad,
                                                    dv.cantidad,
                                                    p.costo_unitario,
                                                    dv.valor_unitario,
                                                    dv.precio_unitario,
                                                    dv.valor_total,
                                                    dv.igv,
                                                    format(dv.importe_total,2) as importe_total
                                            FROM detalle_venta dv inner join productos p on dv.codigo_producto = p.codigo_producto	
                                            WHERE dv.id_venta  = :id_venta");
        $stmt->bindParam(":id_venta", $id_venta, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_NAMED);
    }

    static public function mdlObtenerCorrelativoResumen($fecha_envio, $resumen, $baja)
    {
        $stmt = Conexion::conectar()->prepare("SELECT max(correlativo) as correlativo
                                                FROM resumenes 
                                            WHERE resumen=:resumen 
                                            AND baja=:baja 
                                            AND fecha_envio=:fecha_envio 
                                        ORDER BY correlativo DESC LIMIT 1");

        $stmt->bindParam(":fecha_envio", $fecha_envio, PDO::PARAM_STR);
        $stmt->bindParam(":resumen", $resumen, PDO::PARAM_STR);
        $stmt->bindParam(":baja", $baja, PDO::PARAM_STR);
        $stmt->execute();
        $correlativo = $stmt->fetch(PDO::FETCH_OBJ);

        return isset($correlativo) ? $correlativo->correlativo + 1 : 1;
    }

    static public function mdlInsertarResumen($comprobante, $resumen_comprobante)
    {


        $dbh = Conexion::conectar();

        try {
            $stmt = $dbh->prepare("INSERT INTO resumenes(fecha_envio, 
                                                        fecha_referencia, 
                                                        correlativo, 
                                                        resumen, 
                                                        baja, 
                                                        estado) 
                                        VALUES(:fecha_envio, 
                                                :fecha_referencia, 
                                                :correlativo, 
                                                :resumen, 
                                                :baja, 
                                                :estado)");

            $dbh->beginTransaction();
            $stmt->execute(array(
                ':fecha_envio' => $comprobante["fecha_envio"],
                ':fecha_referencia' => $comprobante["fecha_emision"],
                ':correlativo' => $comprobante["correlativo"],
                ':resumen' => $comprobante["resumen"],
                ':baja' => $comprobante["baja"],
                ':estado' => $comprobante["estado"]
            ));

            $id_resumen = $dbh->lastInsertId();
            $dbh->commit();

            /* **************************************************************
            R E G I S T R A R   D E T A L L E   D E L   R E S U M E N
            ************************************************************** */
            foreach ($resumen_comprobante as $venta) {

                $stmt = $dbh->prepare("INSERT INTO resumenes_detalle(id_envio,id_comprobante,condicion) 
                                            VALUES(:id_envio,:id_comprobante,:condicion)");

                $dbh->beginTransaction();
                $stmt->execute(array(
                    ':id_envio' => $id_resumen,
                    ':id_comprobante' => $venta["id_comprobante"],
                    ':condicion' => $venta["condicion"]
                ));

                $dbh->commit();

                $productos_venta = VentasModelo::mdlObtenerDetalleVentaPorId($venta["id_comprobante"]);

                /* **************************************************************
                R E G I S T R A R   K A R D E X   D E   D E V O L U C I O N
                ************************************************************** */
                foreach ($productos_venta as $producto) {

                    $stmt = $dbh->prepare("call prc_registrar_kardex_anulacion(:id_venta, :codigo_producto)");

                    $dbh->beginTransaction();
                    $stmt->execute(array(
                        ':id_venta' => $venta["id_comprobante"],
                        ':codigo_producto' => $producto["codigo_producto"]
                    ));

                    $dbh->commit();
                }
            }

            return $id_resumen;
        } catch (Exception $e) {
            $dbh->rollBack();
            return $e->getMessage();
        }
    }

    static public function mdlAnularNotaVenta($id_venta, $detalle_venta)
    {

        $dbh = Conexion::conectar();

        try {

            /* **************************************************************
            
            ************************************************************** */
            for ($i = 0; $i < count($detalle_venta); $i++) {

                $stmt = $dbh->prepare("call prc_registrar_kardex_anulacion(:id_venta, :codigo_producto)");

                $dbh->beginTransaction();
                $stmt->execute(array(
                    ':id_venta' => $id_venta,
                    ':codigo_producto' => $detalle_venta[$i]["codigo_producto"]
                ));

                $dbh->commit();
            }

            $stmt = $dbh->prepare("UPDATE venta
                                    SET estado_comprobante = 2
                                WHERE id = :id_venta");

            $dbh->beginTransaction();
            $stmt->execute(array(
                ':id_venta' => $id_venta
            ));

            $dbh->commit();


            $respuesta["tipo_msj"] = "success";
            $respuesta["msj"] = "La Nota de Venta se anuló correctamente";
            return $respuesta;
        } catch (Exception $e) {
            $dbh->rollBack();
            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al anular la Nota de Venta " . $e->getMessage();
            return $respuesta;;
        }
    }

    static public function mdlActualizarRespuestaResumen($id_resumen, $name_xml, $mensaje_sunat, $codigo_sunat, $ticket, $estado, $resumen_comprobante)
    {

        $dbh = Conexion::conectar();

        try {
            $stmt = $dbh->prepare("UPDATE resumenes 
                                    SET nombrexml=:name_xml, 
                                        mensaje_sunat=:mensaje_sunat, 
                                        codigo_sunat=:codigo_sunat, 
                                        estado=:estado, 
                                        ticket=:ticket 
                                    WHERE id=:id_resumen");
            $dbh->beginTransaction();
            $stmt->execute(array(
                ':name_xml' => $name_xml,
                ':mensaje_sunat' => $mensaje_sunat,
                ':codigo_sunat' => $codigo_sunat,
                ':estado' => $estado,
                ':ticket' => $ticket,
                ':id_resumen' => $id_resumen,
            ));
            $dbh->commit();

            if ($estado == 1) {

                foreach ($resumen_comprobante as $comprobante) {

                    $stmt = $dbh->prepare("UPDATE venta
                                    SET codigo_error_sunat = :codigo_sunat,
                                        mensaje_respuesta_sunat = :mensaje_sunat, 
                                        estado_respuesta_sunat = :estado_respuesta_sunat,
                                        estado_comprobante = :estado
                                    WHERE id=:id_venta");
                    $dbh->beginTransaction();
                    $stmt->execute(array(
                        ':codigo_sunat' => $codigo_sunat,
                        ':mensaje_sunat' => $mensaje_sunat,
                        ':estado_respuesta_sunat' => $estado,
                        ':estado' => $estado,
                        ':id_venta' => $comprobante["id_comprobante"]
                    ));
                    $dbh->commit();
                }
            }
        } catch (Exception $e) {
            $dbh->rollBack();
        }

        return "OK";
    }

    static public function mdlActualizarRespuestaResumenAnulacion($id_resumen, $name_xml, $mensaje_sunat, $codigo_sunat, $ticket, $estado, $resumen_comprobante)
    {

        $dbh = Conexion::conectar();

        try {
            $stmt = $dbh->prepare("UPDATE resumenes 
                                    SET nombrexml=:name_xml, 
                                        mensaje_sunat=:mensaje_sunat, 
                                        codigo_sunat=:codigo_sunat, 
                                        estado=:estado, 
                                        ticket=:ticket 
                                    WHERE id=:id_resumen");
            $dbh->beginTransaction();
            $stmt->execute(array(
                ':name_xml' => $name_xml,
                ':mensaje_sunat' => $mensaje_sunat,
                ':codigo_sunat' => $codigo_sunat,
                ':estado' => $estado,
                ':ticket' => $ticket,
                ':id_resumen' => $id_resumen,
            ));
            $dbh->commit();

            if ($estado == 1) {

                foreach ($resumen_comprobante as $comprobante) {

                    $stmt = $dbh->prepare("UPDATE venta
                                    SET codigo_error_sunat = :codigo_sunat,
                                        mensaje_respuesta_sunat = :mensaje_sunat, 
                                        estado_respuesta_sunat = :estado_respuesta_sunat,
                                        estado_comprobante = :estado
                                    WHERE id=:id_venta");
                    $dbh->beginTransaction();
                    $stmt->execute(array(
                        ':codigo_sunat' => $codigo_sunat,
                        ':mensaje_sunat' => $mensaje_sunat,
                        ':estado_respuesta_sunat' => 3,
                        ':estado' => 2,
                        ':id_venta' => $comprobante["id_comprobante"]
                    ));
                    $dbh->commit();
                }
            }
        } catch (Exception $e) {
            $dbh->rollBack();
        }

        return "OK";
    }

    static public function mdlInsertarCuotas($id_venta, $cronograma)
    {


        $dbh = Conexion::conectar();

        try {

            for ($i = 0; $i < count($cronograma); $i++) {

                $stmt = $dbh->prepare("INSERT INTO cuotas(id_venta, cuota, importe, importe_pagado,saldo_pendiente, cuota_pagada,fecha_vencimiento, estado)
                VALUES (:id_venta, :cuota, :importe, :importe_pagado, :saldo_pendiente, :cuota_pagada, :fecha_vencimiento, '1')");

                $dbh->beginTransaction();
                $stmt->execute(array(
                    ':id_venta'            => $id_venta,
                    ':cuota'            => $cronograma[$i]["cuota"],
                    ':importe'            => $cronograma[$i]["importe"],
                    ':importe_pagado'   => 0,
                    ':saldo_pendiente'   => $cronograma[$i]["importe"],
                    ':cuota_pagada'      => 0,
                    ':fecha_vencimiento' => $cronograma[$i]["vencimiento"]
                ));

                $dbh->commit();
            }

            return "ok";
        } catch (Exception $e) {
            $dbh->rollBack();
            return $e->getMessage();
        }
    }

    static public function mdlObtenerCuotas($id_venta)
    {

        $stmt = Conexion::conectar()->prepare("SELECT id, 
                                                    id_venta, 
                                                    cuota, 
                                                    round(importe, 2) as importe,
                                                    fecha_vencimiento, 
                                                    estado
                                            FROM cuotas c 
                                            WHERE c.id_venta  = :id_venta");

        $stmt->bindParam(":id_venta", $id_venta, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_NAMED);
    }

    static public function mdlObtenerFacturasPorCobrar($post)
    {

        $columns = [
            "id",
            "factura",
            "cliente",
            "fecha_emision",
            "importe_total",
            "nro_cuotas",
            "cuotas_pagadas",
            "saldo_pendiente"
        ];

        $query = "SELECT '' as opciones,
                        v.id,
                    concat(v.serie,'-',v.correlativo) as factura,
                    c.nombres_apellidos_razon_social as cliente,
                    date(v.fecha_emision) as fecha_emision,
                    round(v.importe_total,2) as importe_total,
                    (select count(c.id) from cuotas c where c.id_venta = v.id) as nro_cuotas,
                    (select count(c.id) from cuotas c where c.id_venta = v.id and c.cuota_pagada = 1) as cuotas_pagadas,
                    round((select round(sum(ifnull(c.saldo_pendiente,0)),2) from cuotas c where c.id_venta = v.id and c.cuota_pagada = 0),2) as saldo_pendiente
                FROM venta v inner join serie s on v.id_serie = s.id
                             inner join clientes c on c.id = v.id_cliente
                WHERE (s.id_tipo_comprobante = '01' OR s.id_tipo_comprobante = 'NV')
                and upper(v.forma_pago) = 'CREDITO' 
                and pagado = 0 ";

        if (isset($post["search"]["value"])) {
            $query .= '  AND  (v.fecha_emision like "%' . $post["search"]["value"] . '%"
                                or c.nombres_apellidos_razon_social like "%' . $post["search"]["value"] . '%"
                                or concat(v.serie,"-",v.correlativo) like "%' . $post["search"]["value"] . '%")';
        }

        // var_dump($query);
        if (isset($post["order"])) {
            $query .= ' ORDER BY ' . $columns[$post['order']['0']['column']] . ' ' . $post['order']['0']['dir'] . ' ';
        } else {
            $query .= ' ORDER BY v.id desc ';
        }

        //SE AGREGA PAGINACION
        if ($post["length"] != -1) {
            $query1 = " LIMIT " . $post["start"] . ", " . $post["length"];
        }

        $stmt = Conexion::conectar()->prepare($query);

        $stmt->execute();

        $number_filter_row = $stmt->rowCount();

        $stmt =  Conexion::conectar()->prepare($query . $query1);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_NAMED);

        $data = array();

        foreach ($results as $row) {
            $sub_array = array();
            $sub_array[] = $row['opciones'];
            $sub_array[] = $row['id'];
            $sub_array[] = $row['factura'];
            $sub_array[] = $row['cliente'];
            $sub_array[] = $row['fecha_emision'];
            $sub_array[] = $row['importe_total'];
            $sub_array[] = $row['nro_cuotas'];
            $sub_array[] = $row['cuotas_pagadas'];
            $sub_array[] = $row['saldo_pendiente'];
            $data[] = $sub_array;
        }

        $stmt = Conexion::conectar()->prepare(
            $query = "SELECT 'X'
                    FROM venta v inner join serie s on v.id_serie = s.id
                    WHERE s.id_tipo_comprobante = '01'
                    and upper(v.forma_pago) = 'CREDITO'"
        );

        $stmt->execute();

        $count_all_data = $stmt->rowCount();

        $facturas = array(
            'draw' => $post['draw'],
            "recordsTotal" => $count_all_data,
            "recordsFiltered" => $number_filter_row,
            "data" => $data
        );

        return $facturas;
    }

    static public function mdlObtenerCuotasPorIdVenta($id_venta)
    {

        $stmt = Conexion::conectar()->prepare("SELECT 
                                                id, 
                                                cuota, 
                                                round(ifnull(importe,0),2) as  importe,
                                                round(ifnull(importe_pagado,0),2) as  importe_pagado,
                                                round(ifnull(saldo_pendiente,0),2) as saldo_pendiente,
                                                case when cuota_pagada = 0 then 'NO' else 'SI' end as cuota_pagada, 
                                                fecha_vencimiento
                                        from cuotas c
                                        where c.id_venta = :id_venta");

        $stmt->bindParam(":id_venta", $id_venta, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function mdlPagarCuotas($id_venta, $importe_a_pagar, $medio_pago)
    {

        $id_usuario = $_SESSION["usuario"]->id_usuario;

        $dbh = Conexion::conectar();

        try {

            $stmt = $dbh->prepare("call prc_pagar_cuotas_factura(:id_venta, :importe_a_pagar, :id_usuario, :medio_pago)");

            $dbh->beginTransaction();
            $stmt->execute(array(
                ':id_venta'            => $id_venta,
                ':importe_a_pagar'     => $importe_a_pagar,
                ':id_usuario'          => $id_usuario,
                ':medio_pago'          => $medio_pago
            ));

            $dbh->commit();

            $respuesta["tipo_msj"] = "success";
            $respuesta["msj"] = "Se registró el pago correctamente";
        } catch (Exception $e) {
            $dbh->rollBack();
            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al registrar el pago " . $e->getMessage();
        }

        return $respuesta;
    }

    static public function mdlObtenerVentaPorComprobante($id_serie, $correlativo)
    {

        $stmt = Conexion::conectar()->prepare("SELECT v.id, 
                                                    v.id_empresa_emisora, 
                                                    v.id_cliente, 
                                                    v.id_serie, 
                                                    v.serie, 
                                                    v.correlativo, 
                                                    v.tipo_comprobante_modificado, 
                                                    v.id_serie_modificado, 
                                                    v.correlativo_modificado, 
                                                    v.motivo_nota_credito_debito, 
                                                    v.fecha_emision, 
                                                    v.hora_emision, 
                                                    v.fecha_vencimiento, 
                                                    v.id_moneda, 
                                                    v.forma_pago, 
                                                    v.tipo_operacion, 
                                                    v.total_operaciones_gravadas, 
                                                    v.total_operaciones_exoneradas, 
                                                    v.total_operaciones_inafectas, 
                                                    v.total_igv, 
                                                    v.importe_total, 
                                                    v.efectivo_recibido, 
                                                    v.vuelto, 
                                                    v.nombre_xml, 
                                                    v.xml_base64, 
                                                    v.xml_cdr_sunat_base64, 
                                                    v.codigo_error_sunat, 
                                                    v.mensaje_respuesta_sunat, 
                                                    v.hash_signature, 
                                                    v.estado_respuesta_sunat, 
                                                    v.estado_comprobante, 
                                                    v.id_usuario, 
                                                    v.pagado,
                                                    cli.*,
                                                    td.descripcion as descripcion_documento,
                                                    p.codigo_producto, 
                                                    p.id_categoria, 
                                                    p.descripcion, 
                                                    p.id_tipo_afectacion_igv, 
                                                    case when p.id_tipo_afectacion_igv = 10 
                                                            then 'GRAVADO' 
                                                        when p.id_tipo_afectacion_igv = 20 
                                                            then 'EXONERADO' 
                                                        when p.id_tipo_afectacion_igv = 30
                                                            then 'INAFECTO' 
                                                    end as tipo_afectacion_igv,
                                                    p.id_unidad_medida, 
                                                    cum.descripcion as unidad_medida, 
                                                    p.costo_unitario, 
                                                    dv.precio_unitario as precio_unitario_con_igv,
                                                    dv.valor_unitario as precio_unitario_sin_igv, 
                                                    dv.cantidad,
                                                    dv.importe_total as total_producto,
                                                    case when p.id_tipo_afectacion_igv = 10 then 1.18 else 1 end as factor_igv,
                                                    case when p.id_tipo_afectacion_igv = 10 then 0.18 else 0 end as porcentaje_igv
                                            FROM venta v inner join  detalle_venta dv on v.id = dv.id_venta
                                                        inner join productos p on dv.codigo_producto = p.codigo_producto
                                                        inner join codigo_unidad_medida cum on cum.id = p.id_unidad_medida
                                                        inner join clientes cli on cli.id = v.id_cliente
                                                        inner join tipo_documento td on td.id = cli.id_tipo_documento
                                            WHERE v.id_serie = :id_serie
                                            and v.correlativo = :correlativo
                                            order by dv.id asc");

        $stmt->bindParam(":id_serie", $id_serie, PDO::PARAM_STR);
        $stmt->bindParam(":correlativo", $correlativo, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_NAMED);
    }

    static public function mdlObtenerDetalleVentaPorComprobante($id_serie, $correlativo)
    {

        $stmt = Conexion::conectar()->prepare("SELECT v.id,
                                                    v.id_empresa_emisora,
                                                    v.id_cliente,
                                                    v.id_serie,
                                                    s.id_tipo_comprobante,
                                                    v.serie,
                                                    v.correlativo,
                                                    v.tipo_comprobante_modificado,
                                                    v.id_serie_modificado,
                                                    v.correlativo_modificado,
                                                    v.motivo_nota_credito_debito,
                                                    v.fecha_emision,
                                                    v.hora_emision,
                                                    v.fecha_vencimiento,
                                                    v.id_moneda,
                                                    v.forma_pago,
                                                    v.tipo_operacion,
                                                    v.total_operaciones_gravadas,
                                                    v.total_operaciones_exoneradas,
                                                    v.total_operaciones_inafectas,
                                                    v.total_igv,
                                                    v.importe_total,
                                                    v.efectivo_recibido,
                                                    v.vuelto,
                                                    v.nombre_xml,
                                                    v.xml_base64,
                                                    v.xml_cdr_sunat_base64,
                                                    v.codigo_error_sunat,
                                                    v.mensaje_respuesta_sunat,
                                                    v.hash_signature,
                                                    v.estado_respuesta_sunat,
                                                    v.estado_comprobante,
                                                    v.id_usuario,
                                                    v.pagado                                                 
                                            FROM venta v inner join serie s on v.id_serie = s.id
                                            WHERE v.id_serie = :id_serie
                                            AND v.correlativo = :correlativo");

        $stmt->bindParam(":id_serie", $id_serie, PDO::PARAM_STR);
        $stmt->bindParam(":correlativo", $correlativo, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_NAMED);
    }

    static public function mdlReporteVentas($fecha_desde, $fecha_hasta)
    {

        $stmt = Conexion::conectar()->prepare("call prc_ReporteVentas(:fecha_desde, :fecha_hasta)");

        $stmt->bindParam(":fecha_desde", $fecha_desde, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_hasta", $fecha_hasta, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static public function mdlEnviarComprobanteEmail($id_venta, $email_destino)
    {

        $venta = VentasModelo::mdlObtenerVentaPorId($id_venta);
        $path_xml = '../fe/facturas/xml/';
        $path_pdf = '../fe/facturas/';
        $xml_adjunto = $venta['ruc'] . '-' . $venta['id_tipo_comprobante'] . '-' . $venta['serie'] . '-' . $venta['correlativo'] . '.xml';
        $pdf_adjunto = $venta['ruc'] . '-' . $venta['id_tipo_comprobante'] . '-' . $venta['serie'] . '-' . $venta['correlativo'] . '.pdf';
        $nombre_cliente = $venta["nombres_apellidos_razon_social"];

        $host = ConfiguracionesModelo::mdlObtenerConfiguracionValue(100, 1)["valor"];
        $username = ConfiguracionesModelo::mdlObtenerConfiguracionValue(100, 2)["valor"];
        $password = ConfiguracionesModelo::mdlObtenerConfiguracionValue(100, 3)["valor"];
        $smtp_secure = ConfiguracionesModelo::mdlObtenerConfiguracionValue(100, 4)["valor"];
        $port = ConfiguracionesModelo::mdlObtenerConfiguracionValue(100, 5)["valor"];
        $nombre_empresa = ConfiguracionesModelo::mdlObtenerConfiguracionValue(100, 6)["valor"];

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                   //Enable verbose debug output
            $mail->isSMTP();                        //Send using SMTP
            $mail->Host       = $host;              //Set the SMTP server to send through
            $mail->SMTPAuth   = true;               //Enable SMTP authentication
            $mail->Username   = $username;          //SMTP username
            $mail->Password   = $password;          //SMTP password
            $mail->SMTPSecure = $smtp_secure;       //Enable implicit TLS encryption
            $mail->Port       = $port;              //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`



            //Recipients
            $mail->setFrom($username, $nombre_empresa);
            $mail->addAddress($email_destino, $nombre_cliente);     //Add a recipient

            //Attachments
            if (file_exists($path_pdf . $pdf_adjunto)) {
                $mail->addAttachment($path_pdf . $pdf_adjunto, $pdf_adjunto);         //Add attachments
            }
            if (file_exists($path_xml . $xml_adjunto)) {
                $mail->addAttachment($path_xml . $xml_adjunto, $xml_adjunto);    //Optional name
            }

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = utf8_decode('Se envia la el Comprobante Electrónico');
            $mail->Body    = 'Gracias por tu compra!</b>';
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            // echo 'Enviado Correctamente';



            $respuesta['tipo_msj'] = "success";
            $respuesta['msj'] = "Correo enviado correctamente";
        } catch (Exception $e) {
            $respuesta['tipo_msj'] = "error";
            $respuesta['msj'] = "Error al enviar correo {$mail->ErrorInfo}";
        }

        return $respuesta;
    }

    static public function mdlObtenerModalidadTraslado()
    {

        $stmt = Conexion::conectar()->prepare("SELECT codigo as id, descripcion
                                                FROM modalidad_traslado 
                                            WHERE estado = 1");

        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function mdlObtenerMotivoTraslado()
    {

        $stmt = Conexion::conectar()->prepare("SELECT codigo as id, descripcion
                                                FROM motivo_traslado 
                                            WHERE estado = 1");

        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function mdlGuardarGuiaRemisionRemitente($guia_remision_remitente)
    {

        $id_usuario = $_SESSION["usuario"]->id_usuario;

        $dbh = Conexion::conectar();

        try {

            $empresa = EmpresasModelo::mdlObtenerEmpresaPrincipal();
            $cliente = ClientesModelo::mdlObtenerClientePorDocumento($guia_remision_remitente["destinatario"]["tipoDoc"], $guia_remision_remitente["destinatario"]["numDoc"]);

            $stmt = $dbh->prepare("INSERT INTO guia_remision(tipo_documento, 
                                                            serie, 
                                                            correlativo, 
                                                            fecha_emision, 
                                                            id_empresa, 
                                                            id_cliente, 
                                                            id_tipo_documento_rel,
                                                            documento_rel,
                                                            codigo_traslado, 
                                                            modalidad_traslado, 
                                                            fecha_traslado, 
                                                            peso_total, 
                                                            unidad_peso_total, 
                                                            numero_bultos,
                                                            ubigeo_llegada, 
                                                            direccion_llegada, 
                                                            ubigeo_partida, 
                                                            direccion_partida, 
                                                            tipo_documento_transportista, 
                                                            numero_documento_transportista, 
                                                            razon_social_transportista, 
                                                            nro_mtc, 
                                                            observaciones, 
                                                            id_usuario, 
                                                            estado)
                                                    VALUES(:tipo_documento, 
                                                            :serie, 
                                                            :correlativo, 
                                                            :fecha_emision, 
                                                            :id_empresa, 
                                                            :id_cliente, 
                                                            :id_tipo_documento_rel,
                                                            upper(:documento_rel),
                                                            :codigo_traslado, 
                                                            :modalidad_traslado, 
                                                            :fecha_traslado, 
                                                            :peso_total, 
                                                            :unidad_peso_total, 
                                                            :numero_bultos,
                                                            :ubigeo_llegada, 
                                                            upper(:direccion_llegada), 
                                                            :ubigeo_partida, 
                                                            upper(:direccion_partida), 
                                                            :tipo_documento_transportista, 
                                                            :numero_documento_transportista, 
                                                            upper(:razon_social_transportista), 
                                                            :nro_mtc, 
                                                            upper(:observaciones), 
                                                            :id_usuario, 
                                                            :estado)");
            $dbh->beginTransaction();
            $stmt->execute(array(
                ':tipo_documento' => $guia_remision_remitente['tipo_doc'],
                ':serie' => $guia_remision_remitente['serie'],
                ':correlativo' => $guia_remision_remitente['correlativo'],
                ':fecha_emision' => $guia_remision_remitente['fechaEmision'],
                ':id_empresa' => $empresa['id_empresa'],
                ':id_cliente' => $cliente['id'] ?? null,
                ':id_tipo_documento_rel' => $guia_remision_remitente['relDocs']['relDoc']['tipoDoc'] ?? null,
                ':documento_rel' => $guia_remision_remitente['relDocs']['relDoc']['nroDoc'] ?? null,
                ':codigo_traslado' => $guia_remision_remitente["envio"]['codTraslado'],
                ':modalidad_traslado' => $guia_remision_remitente["envio"]['modTraslado'],
                ':fecha_traslado' => $guia_remision_remitente["envio"]['fecTraslado'],
                ':peso_total' => $guia_remision_remitente["envio"]['pesoTotal'],
                ':unidad_peso_total' => $guia_remision_remitente["envio"]['undPesoTotal'],
                ':numero_bultos' => $guia_remision_remitente["envio"]['numBultos'],
                ':ubigeo_llegada' => $guia_remision_remitente["envio"]['llegada']['ubigeo'],
                ':direccion_llegada' => $guia_remision_remitente["envio"]['llegada']['direccion'],
                ':ubigeo_partida' => $guia_remision_remitente["envio"]['partida']['ubigeo'],
                ':direccion_partida' => $guia_remision_remitente["envio"]['partida']['direccion'],
                ':tipo_documento_transportista' => $guia_remision_remitente["envio"]['transportista']['tipoDoc'] ?? null,
                ':numero_documento_transportista' => $guia_remision_remitente["envio"]['transportista']['numDoc'] ?? null,
                ':razon_social_transportista' => $guia_remision_remitente["envio"]['transportista']['rznSocial'] ?? null,
                ':nro_mtc' => $guia_remision_remitente["envio"]['transportista']['nroMtc'] ?? null,
                ':observaciones' => $guia_remision_remitente['observaciones'],
                ':id_usuario' => $id_usuario,
                ':estado' => 1
            ));
            $id_guia = $dbh->lastInsertId();
            $dbh->commit();

            $stmt = $dbh->prepare("UPDATE serie
                                     SET correlativo = correlativo + 1 
                                    WHERE serie = :serie 
                                    AND id_tipo_comprobante = '09'");
            $dbh->beginTransaction();
            $stmt->execute(array(
                ':serie' => $guia_remision_remitente['serie']
            ));
            $dbh->commit();

            //GUARDAR EL DETALLE DE PRODUCTOS:
            foreach ($guia_remision_remitente['details'] as $item) {
                // var_dump($item['codigo']);

                $stmt = $dbh->prepare("INSERT INTO guia_remision_productos(id_guia_remision, 
                                                                            codigo_producto, 
                                                                            descripcion_producto, 
                                                                            unidad, 
                                                                            cantidad, 
                                                                            estado)
                                                    VALUES(:id_guia_remision, 
                                                            :codigo_producto, 
                                                            :descripcion_producto, 
                                                            :unidad, 
                                                            :cantidad, 
                                                            :estado)");
                $dbh->beginTransaction();
                $stmt->execute(array(
                    ':id_guia_remision' => $id_guia,
                    ':codigo_producto' => $item['codigo'],
                    ':descripcion_producto' => $item['descripcion'],
                    ':unidad' => $item['unidad'],
                    ':cantidad' => $item['cantidad'],
                    ':estado' => 1
                ));
                // $id_guia = $dbh->lastInsertId();
                $dbh->commit();
            }

            if ($guia_remision_remitente['envio']['modTraslado'] == "02") { // MODALIDAD TRANSPORTE PRIVADO

                // GUARDAR EL DETALLE DE VEHICULOS:
                foreach ($guia_remision_remitente['envio']['vehiculos'] as $item) {

                    $stmt = $dbh->prepare("INSERT INTO guia_remision_vehiculos(id_guia_remision, 
                                                                                placa, 
                                                                                tipo_vehiculo, 
                                                                                estado)
                                                    VALUES(:id_guia_remision, 
                                                            :placa, 
                                                            :tipo_vehiculo, 
                                                            :estado)");
                    $dbh->beginTransaction();
                    $stmt->execute(array(
                        ':id_guia_remision' => $id_guia,
                        ':placa' => $item['placa'],
                        ':tipo_vehiculo' => $item['item'] > 0 ? 'SECUNDARIO' : 'PRINCIPAL',
                        ':estado' => 1
                    ));
                    $dbh->commit();
                }

                //GUARDAR EL DETALLE DE CHOFERES:
                foreach ($guia_remision_remitente['envio']['choferes'] as $item) {

                    $stmt = $dbh->prepare("INSERT INTO guia_remision_choferes( id_guia_remision, 
                                                                                tipo_documento, 
                                                                                numero_documento, 
                                                                                licencia, 
                                                                                nombres, 
                                                                                apellidos, 
                                                                                tipo_chofer, 
                                                                                estado)
                                                                        VALUES(:id_guia_remision, 
                                                                                :tipo_documento, 
                                                                                :numero_documento, 
                                                                                :licencia, 
                                                                                :nombres, 
                                                                                :apellidos, 
                                                                                :tipo_chofer, 
                                                                                :estado)");
                    $dbh->beginTransaction();
                    $stmt->execute(array(
                        ':id_guia_remision' => $id_guia,
                        ':tipo_documento' => $item['tipoDoc'],
                        ':numero_documento' => $item['nroDoc'],
                        ':licencia' => $item['licencia'],
                        ':nombres' => $item['nombres'],
                        ':apellidos' => $item['apellidos'],
                        ':tipo_chofer' =>  $item['item'] > 0 ? 'SECUNDARIO' : 'PRINCIPAL',
                        ':estado' => 1
                    ));
                    $dbh->commit();
                }
            }
        } catch (Exception $e) {
            $dbh->rollBack();
            return 0;
        }

        return $id_guia;
    }

    static public function mdlObtenerGuiaRemisionPorIdFormatoA4($id_guia)
    {

        $stmt = Conexion::conectar()->prepare("SELECT e.id_empresa, 
                                                        e.nombre_comercial as empresa, 
                                                        e.ruc as ruc_empresa, 
                                                        e.direccion as direccion_empresa, 
                                                        concat(e.ubigeo,' - ',e.departamento,' - ',e.provincia,' - ',e.distrito) as ubigeo_empresa, 
                                                        e.email as email_empresa,
                                                        e.telefono as telefono_empresa,
                                                        e.logo,
                                                        g.tipo_documento,
                                                        g.serie,
                                                        g.correlativo,
                                                        c.id_tipo_documento as id_tipo_documento_cliente,
                                                        c.nro_documento as nro_doc_cliente,
                                                        nombres_apellidos_razon_social  as rzn_social_cliente,
                                                        g.id_tipo_documento_rel,
                                                        g.documento_rel,
                                                        g.fecha_emision,
                                                        g.fecha_traslado,
                                                        g.codigo_traslado,
                                                        g.modalidad_traslado as id_modalidad_traslado,
                                                        g.peso_total,
                                                        g.unidad_peso_total,
                                                        g.numero_bultos,
                                                        mt.descripcion as motivo_traslado,
                                                        modt.descripcion as modalidad_traslado,
                                                        concat(g.numero_documento_transportista,'-',g.razon_social_transportista) as datos_transportista,
                                                        concat(g.ubigeo_partida, ' - ', ub1.departamento, ' - ', ub1.provincia, ' - ', ub1.distrito, ' / ', g.direccion_partida) as punto_partida,
                                                        concat(g.ubigeo_llegada, ' - ', ub2.departamento, ' - ', ub2.provincia, ' - ', ub2.distrito, ' / ', g.direccion_llegada) as punto_llegada,
                                                        g.observaciones
                                            FROM guia_remision g inner join empresas e on g.id_empresa = e.id_empresa
                                                                inner join clientes c on c.id = g.id_cliente    
                                                                inner join motivo_traslado mt on g.codigo_traslado = mt.codigo
                                                                inner join modalidad_traslado modt on g.modalidad_traslado = modt.codigo
                                                                inner join tb_ubigeos ub1 on ub1.ubigeo_reniec = g.ubigeo_partida
                                                                inner join tb_ubigeos ub2 on ub2.ubigeo_reniec = g.ubigeo_llegada
                                            WHERE g.id = :id_guia");
        $stmt->bindParam(":id_guia", $id_guia, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    static public function mdlObtenerGuiaRemisionDetalleProductos($id_guia)
    {

        $stmt = Conexion::conectar()->prepare("SELECT id, 
                                                    id_guia_remision, 
                                                    codigo_producto, 
                                                    descripcion_producto, 
                                                    unidad, 
                                                    cantidad, 
                                                    estado
                                            FROM guia_remision_productos grp
                                            WHERE grp.id_guia_remision  = :id_guia");
        $stmt->bindParam(":id_guia", $id_guia, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static public function mdlGuardarGuiaRemisionTransportista($guia_remision_transportista)
    {

        $id_usuario = $_SESSION["usuario"]->id_usuario;

        $dbh = Conexion::conectar();

        try {

            $empresa = EmpresasModelo::mdlObtenerEmpresaPrincipal();
            $cliente = ClientesModelo::mdlObtenerClientePorDocumento($guia_remision_transportista["destinatario"]["tipoDoc"], $guia_remision_transportista["destinatario"]["numDoc"]);

            $stmt = $dbh->prepare("INSERT INTO guia_remision(tipo_documento, 
                                                            serie, 
                                                            correlativo, 
                                                            fecha_emision, 
                                                            id_empresa, 
                                                            id_cliente, 
                                                            id_tipo_documento_rel,
                                                            documento_rel,
                                                            fecha_traslado, 
                                                            peso_total, 
                                                            unidad_peso_total, 
                                                            numero_bultos,
                                                            ubigeo_llegada, 
                                                            direccion_llegada, 
                                                            ubigeo_partida, 
                                                            direccion_partida, 
                                                            tipo_documento_transportista, 
                                                            numero_documento_transportista, 
                                                            razon_social_transportista, 
                                                            nro_mtc, 
                                                            observaciones, 
                                                            id_usuario, 
                                                            estado)
                                                    VALUES(:tipo_documento, 
                                                            :serie, 
                                                            :correlativo, 
                                                            :fecha_emision, 
                                                            :id_empresa, 
                                                            :id_cliente, 
                                                            :id_tipo_documento_rel,
                                                            :documento_rel,
                                                            :fecha_traslado, 
                                                            :peso_total, 
                                                            :unidad_peso_total, 
                                                            :numero_bultos,
                                                            :ubigeo_llegada, 
                                                            :direccion_llegada, 
                                                            :ubigeo_partida, 
                                                            :direccion_partida, 
                                                            :tipo_documento_transportista, 
                                                            :numero_documento_transportista, 
                                                            :razon_social_transportista, 
                                                            :nro_mtc, 
                                                            :observaciones, 
                                                            :id_usuario, 
                                                            :estado)");
            $dbh->beginTransaction();
            $stmt->execute(array(
                ':tipo_documento' => $guia_remision_transportista['tipo_doc'],
                ':serie' => $guia_remision_transportista['serie'],
                ':correlativo' => $guia_remision_transportista['correlativo'],
                ':fecha_emision' => $guia_remision_transportista['fechaEmision'],
                ':id_empresa' => $empresa['id_empresa'],
                ':id_cliente' => $cliente['id'] ?? null,
                ':id_tipo_documento_rel' => $guia_remision_transportista['relDocs']['relDoc']['tipoDoc'] ?? null,
                ':documento_rel' => $guia_remision_transportista['relDocs']['relDoc']['nroDoc'] ?? null,
                ':fecha_traslado' => $guia_remision_transportista["envio"]['fecTraslado'],
                ':peso_total' => $guia_remision_transportista["envio"]['pesoTotal'],
                ':unidad_peso_total' => $guia_remision_transportista["envio"]['undPesoTotal'],
                ':numero_bultos' => $guia_remision_transportista["envio"]['numBultos'],
                ':ubigeo_llegada' => $guia_remision_transportista["envio"]['llegada']['ubigeo'],
                ':direccion_llegada' => $guia_remision_transportista["envio"]['llegada']['direccion'],
                ':ubigeo_partida' => $guia_remision_transportista["envio"]['partida']['ubigeo'],
                ':direccion_partida' => $guia_remision_transportista["envio"]['partida']['direccion'],
                ':tipo_documento_transportista' => $guia_remision_transportista["envio"]['transportista']['tipoDoc'] ?? null,
                ':numero_documento_transportista' => $guia_remision_transportista["envio"]['transportista']['numDoc'] ?? null,
                ':razon_social_transportista' => $guia_remision_transportista["envio"]['transportista']['rznSocial'] ?? null,
                ':nro_mtc' => $guia_remision_transportista["envio"]['transportista']['nroMtc'] ?? null,
                ':observaciones' => $guia_remision_transportista['observaciones'],
                ':id_usuario' => $id_usuario,
                ':estado' => 1
            ));
            $id_guia = $dbh->lastInsertId();
            $dbh->commit();

            $stmt = $dbh->prepare("UPDATE serie
                                     SET correlativo = correlativo + 1 
                                    WHERE serie = :serie 
                                    AND id_tipo_comprobante = '09'");
            $dbh->beginTransaction();
            $stmt->execute(array(
                ':serie' => $guia_remision_transportista['serie']
            ));
            $dbh->commit();

            //GUARDAR EL DETALLE DE PRODUCTOS:
            foreach ($guia_remision_transportista['details'] as $item) {

                $stmt = $dbh->prepare("INSERT INTO guia_remision_productos(id_guia_remision, 
                                                                            codigo_producto, 
                                                                            descripcion_producto, 
                                                                            unidad, 
                                                                            cantidad, 
                                                                            estado)
                                                    VALUES(:id_guia_remision, 
                                                            :codigo_producto, 
                                                            :descripcion_producto, 
                                                            :unidad, 
                                                            :cantidad, 
                                                            :estado)");
                $dbh->beginTransaction();
                $stmt->execute(array(
                    ':id_guia_remision' => $id_guia,
                    ':codigo_producto' => $item['codigo'],
                    ':descripcion_producto' => $item['descripcion'],
                    ':unidad' => $item['unidad'],
                    ':cantidad' => $item['cantidad'],
                    ':estado' => 1
                ));

                $dbh->commit();
            }

            // GUARDAR EL DETALLE DE VEHICULOS:
            foreach ($guia_remision_transportista['envio']['vehiculos'] as $item) {

                $stmt = $dbh->prepare("INSERT INTO guia_remision_vehiculos(id_guia_remision, 
                                                                            placa, 
                                                                            tipo_vehiculo, 
                                                                            estado)
                                                VALUES(:id_guia_remision, 
                                                        :placa, 
                                                        :tipo_vehiculo, 
                                                        :estado)");
                $dbh->beginTransaction();
                $stmt->execute(array(
                    ':id_guia_remision' => $id_guia,
                    ':placa' => $item['placa'],
                    ':tipo_vehiculo' => $item['item'] > 0 ? 'SECUNDARIO' : 'PRINCIPAL',
                    ':estado' => 1
                ));
                $dbh->commit();
            }

            //GUARDAR EL DETALLE DE CHOFERES:
            foreach ($guia_remision_transportista['envio']['choferes'] as $item) {

                $stmt = $dbh->prepare("INSERT INTO guia_remision_choferes( id_guia_remision, 
                                                                            tipo_documento, 
                                                                            numero_documento, 
                                                                            licencia, 
                                                                            nombres, 
                                                                            apellidos, 
                                                                            tipo_chofer, 
                                                                            estado)
                                                                    VALUES(:id_guia_remision, 
                                                                            :tipo_documento, 
                                                                            :numero_documento, 
                                                                            :licencia, 
                                                                            :nombres, 
                                                                            :apellidos, 
                                                                            :tipo_chofer, 
                                                                            :estado)");
                $dbh->beginTransaction();
                $stmt->execute(array(
                    ':id_guia_remision' => $id_guia,
                    ':tipo_documento' => $item['tipoDoc'],
                    ':numero_documento' => $item['nroDoc'],
                    ':licencia' => $item['licencia'],
                    ':nombres' => $item['nombres'],
                    ':apellidos' => $item['apellidos'],
                    ':tipo_chofer' =>  $item['item'] > 0 ? 'SECUNDARIO' : 'PRINCIPAL',
                    ':estado' => 1
                ));
                $dbh->commit();
            }
        } catch (Exception $e) {
            $dbh->rollBack();
            return 0;
        }

        return $id_guia;
    }

    static public function mdlObtenerGuiaRemisionDetalleVehiculos($id_guia)
    {

        $stmt = Conexion::conectar()->prepare("SELECT id, 
                                                        id_guia_remision, 
                                                        placa, 
                                                        tipo_vehiculo, 
                                                        estado
                                            FROM guia_remision_vehiculos grv
                                            WHERE grv.id_guia_remision  = :id_guia");

        $stmt->bindParam(":id_guia", $id_guia, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static public function mdlObtenerGuiaRemisionDetalleChoferes($id_guia)
    {

        $stmt = Conexion::conectar()->prepare("SELECT id, 
                                                        id_guia_remision, 
                                                        tipo_documento, 
                                                        numero_documento, 
                                                        licencia, 
                                                        nombres, 
                                                        apellidos, 
                                                        tipo_chofer, 
                                                        estado
                                            FROM guia_remision_choferes grc
                                            WHERE grc.id_guia_remision  = :id_guia");

        $stmt->bindParam(":id_guia", $id_guia, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static public function mdlObtenerGuiasRemisionRemitente($post)
    {

        $columns = [
            'id',
            'codigo_tipo_comprobante',
            'tipo_comprobante',
            'guia',
            'fecha_emision',
            'fecha_traslado',
            'id_cliente',
            'cliente',
            'documento_rel',
            'codigo_motivo_traslado',
            'motivo_traslado',
            'codigo_modalidad_traslado',
            'modalidad',
            'peso_total',
            'unidad_peso_total',
            'numero_bultos',
            'ubigeo_partida',
            'direccion_partida',
            'ubigeo_llegada',
            'direccion_llegada',
            'estado_sunat',
            'xml_base64',
            "mensaje_error_sunat"
        ];

        $query = "SELECT '' as opciones,
                            g.id, 
                            g.tipo_documento as codigo_tipo_comprobante,
                            tc.descripcion as tipo_comprobante,
                            concat(g.serie,'-',g.correlativo) as guia,
                            g.fecha_emision,
                            g.fecha_traslado,
                            g.id_cliente,
                            c.nombres_apellidos_razon_social as cliente,
                            g.documento_rel,
                            g.codigo_traslado as codigo_motivo_traslado,
                            mt.descripcion as motivo_traslado,
                            g.modalidad_traslado as codigo_modalidad_traslado,
                            mdt.descripcion as modalidad,
                            g.peso_total,
                            g.unidad_peso_total,
                            g.numero_bultos,
                            concat(g.ubigeo_partida,' - ',ub_p.departamento,' - ',ub_p.provincia,' - ',ub_p.distrito) ubigeo_partida,
                            upper(g.direccion_partida) as direccion_partida,
                            concat(g.ubigeo_llegada,' - ',ub_ll.departamento,' - ',ub_ll.provincia,' - ',ub_ll.distrito) ubigeo_llegada,
                            upper(g.direccion_llegada) as direccion_llegada,
                            g.estado_sunat,
                            g.xml_base64,
                            g.mensaje_error_sunat
                    FROM guia_remision g inner join clientes c on g.id_cliente = c.id
                                        inner join motivo_traslado mt on mt.codigo = g.codigo_traslado
                                        inner join modalidad_traslado mdt on mdt.codigo = g.modalidad_traslado
                                        inner join tipo_comprobante tc on tc.codigo = g.tipo_documento
                                        inner join tb_ubigeos ub_p on ub_p.ubigeo_reniec = g.ubigeo_partida
                                        inner join tb_ubigeos ub_ll on ub_ll.ubigeo_reniec = g.ubigeo_llegada
                WHERE g.tipo_documento = '09'";

        if (isset($post["search"]["value"])) {
            $query .= '  AND  (g.fecha_emision like "%' . $post["search"]["value"] . '%"
                                or c.nombres_apellidos_razon_social like "%' . $post["search"]["value"] . '%"
                                or concat(g.serie,"-",g.correlativo) like "%' . $post["search"]["value"] . '%")';
        }

        // var_dump($query);
        if (isset($post["order"])) {
            $query .= ' ORDER BY ' . $columns[$post['order']['0']['column']] . ' ' . $post['order']['0']['dir'] . ' ';
        } else {
            $query .= ' ORDER BY g.id desc ';
        }

        //SE AGREGA PAGINACION
        if ($post["length"] != -1) {
            $query1 = " LIMIT " . $post["start"] . ", " . $post["length"];
        }

        $stmt = Conexion::conectar()->prepare($query);

        $stmt->execute();

        $number_filter_row = $stmt->rowCount();

        $stmt =  Conexion::conectar()->prepare($query . $query1);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_NAMED);

        $data = array();

        foreach ($results as $row) {

            $sub_array = array();
            $sub_array[] =  $row['opciones'];
            $sub_array[] =  $row['id'];
            $sub_array[] =  $row['codigo_tipo_comprobante'];
            $sub_array[] =  $row['tipo_comprobante'];
            $sub_array[] =  $row['guia'];
            $sub_array[] =  $row['fecha_emision'];
            $sub_array[] =  $row['fecha_traslado'];
            $sub_array[] =  $row['id_cliente'];
            $sub_array[] =  $row['cliente'];
            $sub_array[] =  $row['documento_rel'];
            $sub_array[] =  $row['codigo_motivo_traslado'];
            $sub_array[] =  $row['motivo_traslado'];
            $sub_array[] =  $row['codigo_modalidad_traslado'];
            $sub_array[] =  $row['modalidad'];
            $sub_array[] =  $row['peso_total'];
            $sub_array[] =  $row['unidad_peso_total'];
            $sub_array[] =  $row['numero_bultos'];
            $sub_array[] =  $row['ubigeo_partida'];
            $sub_array[] =  $row['direccion_partida'];
            $sub_array[] =  $row['ubigeo_llegada'];
            $sub_array[] =  $row['direccion_llegada'];
            $sub_array[] =  $row['estado_sunat'];
            $sub_array[] =  $row['xml_base64'];
            $sub_array[] =  $row['mensaje_error_sunat'];
            $data[] = $sub_array;
        }

        $stmt = Conexion::conectar()->prepare(
            $query = "SELECT 'X' 
                        FROM guia_remision g inner join clientes c on g.id_cliente = c.id
                                            inner join motivo_traslado mt on mt.codigo = g.codigo_traslado
                                            inner join modalidad_traslado mdt on mdt.codigo = g.modalidad_traslado
                        WHERE g.tipo_documento = '09'"
        );

        $stmt->execute();

        $count_all_data = $stmt->rowCount();

        $guias = array(
            'draw' => $post['draw'],
            "recordsTotal" => $count_all_data,
            "recordsFiltered" => $number_filter_row,
            "data" => $data
        );

        return $guias;
    }

    static public function mdlActualizarEstadoGuiaRemision($id_guia, $estado_sunat, $xml_base64, $mensaje_error_sunat)
    {

        $dbh = Conexion::conectar();

        try {

            $stmt = $dbh->prepare("UPDATE guia_remision
                                    SET estado_sunat = :estado_sunat,
                                        xml_base64 = :xml_base64,
                                        mensaje_error_sunat = :mensaje_error_sunat
                                WHERE id = :id_guia");

            $dbh->beginTransaction();
            $stmt->execute(array(
                ':estado_sunat' => $estado_sunat,
                ':xml_base64' =>  $xml_base64,
                ':mensaje_error_sunat' => $mensaje_error_sunat,
                ':id_guia' => $id_guia
            ));
            $dbh->commit();

            $respuesta["tipo_msj"] = 'success';
            $respuesta["msj"] = 'Se actualizó el estado correctamente';
        } catch (Exception $e) {
            $dbh->rollBack();
            $respuesta["tipo_msj"] = 'error';
            $respuesta["msj"] = 'Error al actualizar el estado ->' . $e->getMessage();
        }

        return $respuesta;
    }
}
