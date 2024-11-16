<?php


require_once "conexion.php";

class CotizacionesModelo
{


    /*===================================================================
    L I S T A D O   D E   C O T I Z A C I O N (DATATABLE)
    ====================================================================*/
    static public function mdlObtenerListadoCotizaciones($post)
    {

        $id_usuario = $_SESSION["usuario"]->id_usuario;

        $columns = [
            "id",
            "id_serie",
            "serie",
            "correlativo",
            "comprobante",
            "fecha_cotizacion",
            "cliente",
            "importe_total",
            "estado",
            "fecha_expiracion",
            "id_moneda",
            "tipo_cambio",
            "id_cliente",
            "total_operaciones_gravadas",
            "total_operaciones_exoneradas",
            "total_operaciones_inafectas",
            "total_igv",
            "id_usuario",
            "usuario",
            "comprobante_a_generar",
        ];

        $query = ' SELECT "" as detalles,
                        "" as opciones,
                        c.id, 
                        c.id_serie, 
                        c.serie, 
                        c.correlativo, 
                        concat(c.serie,"-",c.correlativo) as comprobante,
                        c.fecha_cotizacion, 
                        cli.nombres_apellidos_razon_social as cliente,
                        format(c.importe_total,2) as importe_total,
                        c.estado, 
                        c.fecha_expiracion, 
                        CASE WHEN c.id_moneda = "PEN" THEN "SOLES" ELSE "DOLARES" END as id_moneda, 
                        c.tipo_cambio, 
                        c.id_cliente, 
                        format(c.total_operaciones_gravadas,2) as total_operaciones_gravadas,
                        format(c.total_operaciones_exoneradas,2) as total_operaciones_exoneradas,
                        format(c.total_operaciones_inafectas,2) as total_operaciones_inafectas,
                        format(c.total_igv,2) as total_igv,
                        c.id_usuario,
                        concat(usu.nombre_usuario," ", usu.apellido_usuario) as usuario,
                        case when comprobante_a_generar = "01" then "FACTURA" else "BOLETA" end as comprobante_a_generar
                from cotizaciones c join clientes cli on c.id_cliente = cli.id
                                    join usuarios usu on usu.id_usuario = c.id_usuario';

        // var_dump($post["search"]["value"]);

        if (isset($post["search"]["value"])) {
            $query .= '  WHERE c.id_usuario = "' . $id_usuario . '"
                        AND (c.serie like "%' . $post["search"]["value"] . '%"
                             or c.correlativo like "%' . $post["search"]["value"] . '%"
                             or concat(c.serie,"-",c.correlativo) like "%' . $post["search"]["value"] . '%"
                             or c.fecha_cotizacion like "%' . $post["search"]["value"] . '%")
                        OR cli.nombres_apellidos_razon_social like "%' . $post["search"]["value"] . '%"
                        OR (CASE WHEN c.estado = 0 THEN "REGISTRADA" 
                                WHEN c.estado = 1 THEN "CONFIRMADA"
                                WHEN c.estado = 2 THEN "REGISTRADA" ELSE "" END) like  "%' . $post["search"]["value"] . '%"';
        }

        if (isset($post["order"])) {
            $query .= ' ORDER BY ' . $columns[$post['order']['0']['column']] . ' ' . $post['order']['0']['dir'] . ' ';
        } else {
            $query .= ' ORDER BY c.id desc ';
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
            $sub_array[] = $row['detalles']; // 0
            $sub_array[] = $row['opciones']; // 0
            $sub_array[] = $row['id']; //1
            $sub_array[] = $row['id_serie']; //2
            $sub_array[] = $row['serie']; //3
            $sub_array[] = $row['correlativo']; //4
            $sub_array[] = $row['comprobante']; //5
            $sub_array[] = $row['fecha_cotizacion']; //6
            $sub_array[] = $row['cliente']; //7
            $sub_array[] = $row['importe_total']; //8
            $sub_array[] = $row['estado']; //9
            $sub_array[] = $row['fecha_expiracion']; //10
            $sub_array[] = $row['id_moneda']; //11
            $sub_array[] = $row['tipo_cambio']; //12
            $sub_array[] = $row['id_cliente']; //13
            $sub_array[] = $row['total_operaciones_gravadas']; //14
            $sub_array[] = $row['total_operaciones_exoneradas']; //15
            $sub_array[] = $row['total_operaciones_inafectas']; //16
            $sub_array[] = $row['total_igv']; //17
            $sub_array[] = $row['id_usuario']; //18            
            $sub_array[] = $row['usuario']; //19
            $sub_array[] = $row['comprobante_a_generar']; //20
            $data[] = $sub_array;
        }

        $stmt = Conexion::conectar()->prepare(" SELECT 1
                                                FROM cotizaciones c JOIN clientes cli on c.id_cliente = cli.id
                                                                    JOIN usuarios usu on usu.id_usuario = c.id_usuario");

        $stmt->execute();

        $count_all_data = $stmt->rowCount();

        $cotizaciones = array(
            'draw' => $post['draw'],
            "recordsTotal" => $count_all_data,
            "recordsFiltered" => $number_filter_row,
            "data" => $data
        );

        return $cotizaciones;
    }

    /*===================================================================
    R E G I S T R A R   C O T I Z A C I O N
    ====================================================================*/
    static public function mdlRegistrarCotizacion($cotizacion, $detalle_venta)
    {

        $id_usuario = $_SESSION["usuario"]->id_usuario;

        $dbh = Conexion::conectar();

        try {

            $stmt = $dbh->prepare("INSERT INTO cotizaciones
                                            (id_empresa_emisora,
                                            id_serie,
                                            serie,
                                            correlativo,
                                            fecha_cotizacion,
                                            fecha_expiracion,
                                            id_moneda,
                                            tipo_cambio,
                                            comprobante_a_generar,
                                            id_cliente,
                                            total_operaciones_gravadas,
                                            total_operaciones_exoneradas,
                                            total_operaciones_inafectas,
                                            total_igv,
                                            importe_total,
                                            estado,
                                            id_usuario)
                                        VALUES (
                                            :id_empresa_emisora,
                                            :id_serie ,
                                            :serie ,
                                            :correlativo ,
                                            :fecha_cotizacion ,
                                            :fecha_expiracion ,
                                            :id_moneda ,
                                            :tipo_cambio ,
                                            :comprobante_a_generar,
                                            :id_cliente ,
                                            :total_operaciones_gravadas,
                                            :total_operaciones_exoneradas,
                                            :total_operaciones_inafectas,
                                            :total_igv,
                                            :importe_total,
                                            :estado,
                                            :id_usuario)");
            $dbh->beginTransaction();
            $stmt->execute(array(
                ':id_empresa_emisora' => $cotizacion['id_empresa_emisora'],
                ':id_serie' => $cotizacion['id_serie'],
                ':serie' => $cotizacion['serie'],
                ':correlativo' => $cotizacion['correlativo'],

                ':fecha_cotizacion' => $cotizacion['fecha_emision'],
                ':fecha_expiracion' => $cotizacion['fecha_expiracion'],

                ':id_moneda' => $cotizacion['moneda'],
                ':tipo_cambio' => $cotizacion['tipo_cambio'],
                ':comprobante_a_generar' => $cotizacion['tipo_comprobante_a_generar'],
                ':id_cliente' => $cotizacion['id_cliente'],

                ':total_operaciones_gravadas' => $cotizacion['total_operaciones_gravadas'],
                ':total_operaciones_exoneradas' => $cotizacion['total_operaciones_exoneradas'],
                ':total_operaciones_inafectas' => $cotizacion['total_operaciones_inafectas'],
                ':total_igv' => $cotizacion['total_igv'],
                ':importe_total' => $cotizacion['total_a_pagar'],
                ':estado' => 0,
                ':id_usuario' => $id_usuario
            ));
            $id_cotizacion = $dbh->lastInsertId();
            $dbh->commit();

            $stmt = $dbh->prepare("UPDATE serie
                                     SET correlativo = correlativo + 1 
                                    WHERE id = :id_serie");
            $dbh->beginTransaction();
            $stmt->execute(array(
                ':id_serie' => $cotizacion['id_serie']
            ));
            $dbh->commit();


            // GUARDAR EL DETALLE DE LA VENTA:
            foreach ($detalle_venta as $producto) {

                $stmt = $dbh->prepare("INSERT INTO cotizaciones_detalle(id_cotizacion,
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
                                                                VALUES(:id_cotizacion,
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
                                                                        :importe_total)");
                $dbh->beginTransaction();
                $stmt->execute(array(
                    ':id_cotizacion' => $id_cotizacion,
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
            }

            $respuesta["tipo_msj"] = "success";
            $respuesta["msj"] = "La cotización Nro: " . $id_cotizacion . " se registró correctamente.";
        } catch (Exception $e) {
            $dbh->rollBack();

            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al registrar la cotización " . $e->getMessage();
        }

        return  $respuesta;
    }

    /*===================================================================
    A C T U A L I Z A R   C O T I Z A C I O N
    ====================================================================*/
    static public function mdlActualizarCotizacion($cotizacion, $detalle_venta)
    {

        $id_usuario = $_SESSION["usuario"]->id_usuario;

        $dbh = Conexion::conectar();

        try {

            $stmt = $dbh->prepare("UPDATE cotizaciones
                                    SET id_empresa_emisora = :id_empresa_emisora,                                       
                                        fecha_cotizacion = :fecha_cotizacion,
                                        fecha_expiracion = :fecha_expiracion,
                                        id_moneda = :id_moneda,
                                        tipo_cambio = :tipo_cambio,
                                        comprobante_a_generar = :comprobante_a_generar,
                                        id_cliente = :id_cliente,
                                        total_operaciones_gravadas = :total_operaciones_gravadas,
                                        total_operaciones_exoneradas = :total_operaciones_exoneradas,
                                        total_operaciones_inafectas = :total_operaciones_inafectas,
                                        total_igv = :total_igv,
                                        importe_total = :importe_total,
                                        id_usuario = :id_usuario
                                    WHERE id = :id_cotizacion");
            $dbh->beginTransaction();
            $stmt->execute(array(

                //DATOS DE LA COTIZACION:
                ':id_empresa_emisora' => $cotizacion['id_empresa_emisora'],
                ':fecha_cotizacion' => $cotizacion['fecha_emision'],
                ':fecha_expiracion' => $cotizacion['fecha_expiracion'],
                ':id_moneda' => $cotizacion['moneda'],
                ':tipo_cambio' => $cotizacion['tipo_cambio'],
                ':comprobante_a_generar' => $cotizacion['tipo_comprobante_a_generar'],

                //DATOS DEL CLIENTE:
                ':id_cliente' => $cotizacion['id_cliente'],

                //TOTALES DE LA COTIZACIÓN:
                ':total_operaciones_gravadas' => $cotizacion['total_operaciones_gravadas'],
                ':total_operaciones_exoneradas' => $cotizacion['total_operaciones_exoneradas'],
                ':total_operaciones_inafectas' => $cotizacion['total_operaciones_inafectas'],
                ':total_igv' => $cotizacion['total_igv'],
                ':importe_total' => $cotizacion['total_a_pagar'],
                ':id_usuario' => $id_usuario,
                ':id_cotizacion' => $cotizacion['id_cotizacion']
            ));

            $dbh->commit();

            $stmt = $dbh->prepare("DELETE FROM cotizaciones_detalle WHERE id_cotizacion = :id_cotizacion");
            $dbh->beginTransaction();
            $stmt->execute(array(
                ':id_cotizacion' => $cotizacion['id_cotizacion']
            ));
            $dbh->commit();

            // GUARDAR EL DETALLE DE LA VENTA:
            foreach ($detalle_venta as $producto) {

                $stmt = $dbh->prepare("INSERT INTO cotizaciones_detalle(id_cotizacion,
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
                                                                VALUES(:id_cotizacion,
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
                                                                        :importe_total)");
                $dbh->beginTransaction();
                $stmt->execute(array(
                    ':id_cotizacion' => $cotizacion['id_cotizacion'],
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
            }

            $respuesta["tipo_msj"] = "success";
            $respuesta["msj"] = "La cotización Nro: " . $cotizacion['id_cotizacion'] . " se actualizó correctamente.";
        } catch (Exception $e) {
            $dbh->rollBack();

            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al actualizar la cotización " . $e->getMessage();
        }

        return  $respuesta;
    }

    static public function mdlObtenerCotizacionPorId($id_cotizacion)
    {

        $stmt = Conexion::conectar()->prepare("SELECT c.id as id_cotizacion, 
                                                    c.id_empresa_emisora, 
                                                    c.id_serie, 
                                                    c.serie, 
                                                    c.correlativo, 
                                                    c.fecha_cotizacion, 
                                                    c.fecha_expiracion, 
                                                    c.id_moneda, 
                                                    c.tipo_cambio, 
                                                    c.comprobante_a_generar, 
                                                    c.id_cliente, 
                                                    c.total_operaciones_gravadas, 
                                                    c.total_operaciones_exoneradas, 
                                                    c.total_operaciones_inafectas, 
                                                    c.total_igv, 
                                                    c.importe_total, 
                                                    c.estado as estado_cotizacion, 
                                                    c.id_usuario,
                                                     cli.* 
                                                FROM cotizaciones c inner join clientes cli on cli.id = c.id_cliente
                                                WHERE c.id = :id_cotizacion");

        $stmt->bindParam(":id_cotizacion", $id_cotizacion, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_NAMED);
    }

    static public function mdlObtenerDetalleCotizacionPorId($id_cotizacion)
    {

        $stmt = Conexion::conectar()->prepare("SELECT cd.id,
                                                     cd.id_cotizacion,
                                                     cd.item,
                                                     cd.codigo_producto as codigo_producto_cd,
                                                     cd.descripcion as descripcion_cd,
                                                     cd.porcentaje_igv as porcentaje_igv_cd,
                                                     cd.cantidad,
                                                     cd.costo_unitario as costo_unitario_cd,
                                                     cd.valor_unitario,
                                                     cd.precio_unitario,
                                                     cd.valor_total,
                                                     cd.igv,
                                                     cd.importe_total,
                                                     p.codigo_producto, 
                                                     p.id_categoria, 
                                                     p.descripcion, 
                                                     p.id_tipo_afectacion_igv, 
                                                     p.id_unidad_medida, 
                                                     p.costo_unitario, 
                                                     p.precio_unitario_con_igv, 
                                                     p.precio_unitario_sin_igv, 
                                                     p.precio_unitario_mayor_con_igv, 
                                                     p.precio_unitario_mayor_sin_igv, 
                                                     p.precio_unitario_oferta_con_igv, 
                                                     p.precio_unitario_oferta_sin_igv, 
                                                     p.stock, 
                                                     p.minimo_stock, 
                                                     p.ventas, 
                                                     p.costo_total, 
                                                     p.imagen, 
                                                     p.fecha_creacion, 
                                                     p.fecha_actualizacion, 
                                                     p.estado,
                                                     case when p.id_tipo_afectacion_igv = 10 
                                                        then 'GRAVADO' 
                                                    when p.id_tipo_afectacion_igv = 20 
                                                        then 'EXONERADO' 
                                                    when p.id_tipo_afectacion_igv = 30
                                                        then 'INAFECTO' 
                                                    end as tipo_afectacion_igv,
                                                     cum.descripcion as unidad_medida,
                                                     case when p.id_tipo_afectacion_igv = 10 then 1.18 else 1 end as factor_igv,
                                                    case when p.id_tipo_afectacion_igv = 10 then 0.18 else 0 end as porcentaje_igv
                                                FROM cotizaciones c inner join cotizaciones_detalle cd on cd.id_cotizacion = c.id
                                                                    inner join productos p on p.codigo_producto = cd.codigo_producto
                                                                    inner join codigo_unidad_medida cum on cum.id = p.id_unidad_medida
                                                WHERE c.id = :id_cotizacion");

        $stmt->bindParam(":id_cotizacion", $id_cotizacion, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_NAMED);
    }

    static public function mdlConfirmarCotizacion($id_cotizacion)
    {

        $dbh = Conexion::conectar();

        try {

            $stmt = $dbh->prepare("UPDATE  cotizaciones 
                                    SET estado = 1 -- confirmado
                                    WHERE id = :id_cotizacion");
            $dbh->beginTransaction();
            $stmt->execute(array(
                ':id_cotizacion' => $id_cotizacion
            ));
            $dbh->commit();

            $respuesta["tipo_msj"] = "success";
            $respuesta["msj"] = "La cotización Nro: " . $id_cotizacion . " ha sido confirmada.";
        } catch (Exception $e) {
            $dbh->rollBack();

            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al actualizar la cotizacion " . $e->getMessage();
        }

        return  $respuesta;
    }

    static public function mdlCerrarCotizacion($id_cotizacion)
    {

        $dbh = Conexion::conectar();

        try {

            $stmt = $dbh->prepare("UPDATE  cotizaciones 
                                    SET estado = 2 -- cerrada
                                    WHERE id = :id_cotizacion");
            $dbh->beginTransaction();
            $stmt->execute(array(
                ':id_cotizacion' => $id_cotizacion
            ));
            $dbh->commit();

            $respuesta["tipo_msj"] = "success";
            $respuesta["msj"] = "La cotización Nro: " . $id_cotizacion . " ha sido cerrada.";
        } catch (Exception $e) {
            $dbh->rollBack();

            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al cerrar la cotizacion " . $e->getMessage();
        }

        return  $respuesta;
    }

    static public function mdlDetalleCotizacionBoleta($id_cotizacion)
    {

        $stmt = Conexion::conectar()->prepare("SELECT c.id_empresa_emisora,
                                                    c.id_cliente,
                                                    C.id_moneda,
                                                    c.tipo_cambio,
                                                    cd.codigo_producto,
                                                    p.descripcion,
                                                    p.costo_unitario, 
                                                    p.id_unidad_medida,
                                                    p.id_tipo_afectacion_igv as id_tipo_igv,
                                                    cd.valor_unitario as precio,
                                                    cd.cantidad as cantidad_final
                                                FROM cotizaciones c inner join cotizaciones_detalle cd on cd.id_cotizacion = c.id
                                                                    inner join productos p on p.codigo_producto = cd.codigo_producto
                                                                    inner join codigo_unidad_medida cum on cum.id = p.id_unidad_medida
                                                WHERE c.id = :id_cotizacion");

        $stmt->bindParam(":id_cotizacion", $id_cotizacion, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    static public function mdlActualizarEstadoCotizacion($id_cotizacion, $estado)
    {

        $dbh = Conexion::conectar();

        try {

            $stmt = $dbh->prepare("UPDATE  cotizaciones 
                                    SET estado = :estado
                                    WHERE id = :id_cotizacion");
            $dbh->beginTransaction();
            $stmt->execute(array(
                ':estado' => $estado,
                ':id_cotizacion' => $id_cotizacion
            ));
            $dbh->commit();

            $respuesta["tipo_msj"] = "success";
            $respuesta["msj"] = "La cotización Nro: " . $id_cotizacion . " ha sido confirmada.";
        } catch (Exception $e) {
            $dbh->rollBack();

            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al actualizar la cotizacion " . $e->getMessage();
        }

        return  $respuesta;
    }

    static public function mdlObtenerCotizacionPorIdFormatoA4($id_cotizacion)
    {

        $stmt = Conexion::conectar()->prepare("SELECT -- DATOS DE LA COTIZACION
                                                        c.id, 
                                                        c.id_empresa_emisora, 
                                                        c.id_serie, 
                                                        c.serie, 
                                                        c.correlativo, 
                                                        c.fecha_cotizacion, 
                                                        c.fecha_expiracion, 
                                                        c.id_moneda, 
                                                        c.tipo_cambio, 
                                                        c.comprobante_a_generar, 
                                                        c.id_cliente, 
                                                        format(c.total_operaciones_gravadas, 2) as total_operaciones_gravadas,
                                                        format(c.total_operaciones_exoneradas, 2) as total_operaciones_exoneradas,
                                                        format(c.total_operaciones_inafectas, 2) as total_operaciones_inafectas,
                                                        format(c.total_igv, 2) as total_igv,
                                                        format(c.importe_total, 2) as importe_total,
                                                        c.estado, 
                                                        c.id_usuario,

                                                        -- DATOS DE LA EMPRESA
                                                        e.id_empresa,
                                                        e.logo,
                                                        e.razon_social as empresa,
                                                        e.ruc,
                                                        e.direccion as direccion_empresa,
                                                        e.telefono as telefono_empresa,
                                                        e.email,
                                                        concat(e.provincia  ,'-' ,e.departamento ,'-' ,e.distrito) as ubigeo,

                                                        -- DATOS DEL CLIENTE
                                                        cli.id_tipo_documento,
                                                        cli.nro_documento,
                                                        cli.nombres_apellidos_razon_social as nombres_apellidos_razon_social,
                                                        cli.direccion,
                                                        cli.telefono
                                                FROM cotizaciones c inner join empresas e on c.id_empresa_emisora = e.id_empresa
                                                        inner join moneda m on m.id = c.id_moneda
                                                        inner join serie s on s.id = c.id_serie                                                        
                                                        left join clientes cli on cli.id = c.id_cliente
                                                        inner join usuarios u on u.id_usuario = c.id_usuario
                                            WHERE c.id = :id_cotizacion");
        $stmt->bindParam(":id_cotizacion", $id_cotizacion, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_NAMED);
    }

    static public function mdlEliminarCotizacion($id_cotizacion)
    {

        $dbh = Conexion::conectar();

        try {

            $stmt = $dbh->prepare("DELETE FROM  cotizaciones 
                                    WHERE id = :id_cotizacion");
            $dbh->beginTransaction();
            $stmt->execute(array(
                ':id_cotizacion' => $id_cotizacion
            ));
            $dbh->commit();

            $respuesta["tipo_msj"] = "success";
            $respuesta["msj"] = "La cotización Nro: " . $id_cotizacion . " ha sido eliminada.";
        } catch (Exception $e) {
            $dbh->rollBack();

            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al eliminar la cotizacion " . $e->getMessage();
        }

        return  $respuesta;
    }
}
