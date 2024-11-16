<?php

require_once "conexion.php";

use PhpOffice\PhpSpreadsheet\IOFactory;


class ProductosModelo
{

    /*===================================================================
    REALIZAR LA CARGA MASIVA DE PRODUCTOS MEDIANTE ARCHIVO EXCEL
    ====================================================================*/
    static public function mdlCargaMasivaProductos($fileProductos)
    {

        try {

            $nombreArchivo = $fileProductos['tmp_name'][0];

            $documento = IOFactory::load($nombreArchivo);

            //CATEGORIAS
            $hojaCategorias = $documento->getSheetByName("Categorias");
            if(!$hojaCategorias){
                $respuesta["tipo_msj"] = "error";
                $respuesta["msj"] = "No existe la hoja Categorias en el excel seleccionado";
                return $respuesta;
            }
            $numeroFilasCategorias = $hojaCategorias->getHighestDataRow();

            //TIPO AFECTACION
            $hojaTipoAfectacion = $documento->getSheetByName("Tipo_Afectacion");
            if(!$hojaTipoAfectacion){
                $respuesta["tipo_msj"] = "error";
                $respuesta["msj"] = "No existe la hoja Tipo_Afectacion en el excel seleccionado";
                return $respuesta;
            }
            $numeroFilasTipoAfectacion = $hojaTipoAfectacion->getHighestDataRow();

            //UNIDAD MEDIDA
            $hojaUnidadMedida = $documento->getSheetByName("Unidad_Medida");
            if(!$hojaUnidadMedida){
                $respuesta["tipo_msj"] = "error";
                $respuesta["msj"] = "No existe la hoja Unidad_Medida en el excel seleccionado";
                return $respuesta;
            }
            $numeroFilasUnidadMedida = $hojaUnidadMedida->getHighestDataRow();

            //PRODUCTOS
            $hojaProductos = $documento->getSheetByName("Productos");
            if(!$hojaProductos){
                $respuesta["tipo_msj"] = "error";
                $respuesta["msj"] = "No existe la hoja Productos en el excel seleccionado";
                return $respuesta;
            }

            $numeroFilasProductos = $hojaProductos->getHighestDataRow();

        } catch (Exception $e) {
            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al leer las hojas del excel " . $e->getMessage();
            return $respuesta;
        }


        $categoriasRegistrados = 0;
        $productosRegistrados = 0;
        $unidadesMedidaRegistrados = 0;


        $dbh = Conexion::conectar();

        try {
            $stmt = $dbh->prepare("INSERT INTO historico_cargas_masivas(categorias_excel, productos_excel, unidades_medida_excel)
                                                values(:categorias_excel, :productos_excel, :unidades_medida_excel)");

            $dbh->beginTransaction();
            $stmt->execute(array(
                ':categorias_excel' => $numeroFilasCategorias - 1,
                ':productos_excel' => $numeroFilasProductos - 1,
                ':unidades_medida_excel' => $numeroFilasUnidadMedida - 1
            ));
            $id_carga_masiva = $dbh->lastInsertId();
            $dbh->commit();
        } catch (Exception $e) {
            $dbh->rollBack();
            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al registrar historico de cargas masivas " . $e->getMessage();
            return $respuesta;
        }

        /*=====================================================================================
        ELIMINAR TABLAS DEL SISTEMA (venta - detalle_venta - kardex - categorias - 
                                    tipo_afectacion_igv - codigo_unidad_medida - productos)
        =====================================================================================*/
        try {
            $stmt = $dbh->prepare("call prc_truncate_all_tables()");
            $stmt->execute();
        } catch (Exception $e) {
            $dbh->rollBack();
            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al eliminar las tablas del sistema" . $e->getMessage();
            return $respuesta;
        }


        /*=====================================================================================
        CICLO FOR PARA REGISTROS DE CATEGORIAS
        =====================================================================================*/
        for ($i = 2; $i <= $numeroFilasCategorias; $i++) {

            $categoria = $hojaCategorias->getCellByColumnAndRow(1, $i);

            if (!empty($categoria)) {

                try {
                    $stmt = $dbh->prepare("INSERT INTO categorias(descripcion)
                                                        values(:categoria);");

                    $dbh->beginTransaction();
                    $stmt->execute(array(
                        ':categoria' => $categoria,
                    ));

                    $dbh->commit();
                    $categoriasRegistrados += 1;
                } catch (Exception $e) {
                    $dbh->rollBack();
                    $respuesta["tipo_msj"] = "error";
                    $respuesta["msj"] = "Error al cargar las categorías al sistema " . $e->getMessage();
                    return $respuesta;
                }
            }
        }

        try {
            $stmt = $dbh->prepare("UPDATE historico_cargas_masivas
                                    SET categorias_insertadas = :categorias_insertadas
                                    WHERE id = :id");

            $dbh->beginTransaction();
            $stmt->execute(array(
                ':categorias_insertadas' => $categoriasRegistrados,
                ':id' => $id_carga_masiva
            ));
            $dbh->commit();
        } catch (Exception $e) {
            $dbh->rollBack();
            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al el historico de cargas -> Categorías " . $e->getMessage();
            return $respuesta;
        }

        /*=====================================================================================
        CICLO FOR PARA TIPOS DE AFECTACION
        =====================================================================================*/
        for ($i = 2; $i <= $numeroFilasTipoAfectacion; $i++) {

            $codigo = $hojaTipoAfectacion->getCellByColumnAndRow(1, $i);
            $tipo_afectacion = $hojaTipoAfectacion->getCellByColumnAndRow(2, $i);
            $letra_tributo = $hojaTipoAfectacion->getCellByColumnAndRow(3, $i);
            $codigo_tributo = $hojaTipoAfectacion->getCellByColumnAndRow(4, $i);
            $nombre_tributo = $hojaTipoAfectacion->getCellByColumnAndRow(5, $i);
            $tipo_tributo = $hojaTipoAfectacion->getCellByColumnAndRow(6, $i);
            $porcentaje_impuesto = $hojaTipoAfectacion->getCellByColumnAndRow(7, $i);

            if (!empty($codigo)) {

                try {
                    $stmt = $dbh->prepare("INSERT INTO tipo_afectacion_igv(codigo, 
                                                                            descripcion, 
                                                                            letra_tributo, 
                                                                            codigo_tributo, 
                                                                            nombre_tributo, 
                                                                            tipo_tributo,
                                                                            porcentaje_impuesto)
                                                        values(?,upper(?),upper(?),upper(?),upper(?),upper(?),?);");

                    $dbh->beginTransaction();
                    $stmt->execute(array(
                        $codigo,
                        $tipo_afectacion,
                        $letra_tributo,
                        $codigo_tributo,
                        $nombre_tributo,
                        $tipo_tributo,
                        $porcentaje_impuesto
                    ));

                    $dbh->commit();
                } catch (Exception $e) {
                    $dbh->rollBack();
                    $respuesta["tipo_msj"] = "error";
                    $respuesta["msj"] = "Error al cargar los tipos de afectacion al sistema " . $e->getMessage();
                    return $respuesta;
                }
            }
        }

        /*=====================================================================================
        CICLO FOR PARA UNIDADES DE MEDIDA
        =====================================================================================*/
        for ($i = 2; $i <= $numeroFilasUnidadMedida; $i++) {

            $id = $hojaUnidadMedida->getCellByColumnAndRow(1, $i);
            $unidad_medida = $hojaUnidadMedida->getCellByColumnAndRow(2, $i);

            if (!empty($id)) {

                try {
                    $stmt = $dbh->prepare("INSERT INTO codigo_unidad_medida(id, descripcion)
                                                        values(?,?);");

                    $dbh->beginTransaction();
                    $stmt->execute(array(
                        $id,
                        $unidad_medida
                    ));

                    $dbh->commit();
                    $unidadesMedidaRegistrados += 1;
                } catch (Exception $e) {
                    $dbh->rollBack();
                    $respuesta["tipo_msj"] = "error";
                    $respuesta["msj"] = "Error al cargar las unidades de medida " . $e->getMessage();
                    return $respuesta;
                }
            }
        }

        try {
            $stmt = $dbh->prepare("UPDATE historico_cargas_masivas
                                    SET unidades_medida_insertadas = :unidades_medida_insertadas
                                    WHERE id = :id");

            $dbh->beginTransaction();
            $stmt->execute(array(
                ':unidades_medida_insertadas' => $unidadesMedidaRegistrados,
                ':id' => $id_carga_masiva
            ));
            $dbh->commit();
        } catch (Exception $e) {
            $dbh->rollBack();
            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al el historico de cargas -> Unidades de Medida " . $e->getMessage();
            return $respuesta;
        }


        /*=====================================================================================
        CICLO FOR PARA REGISTROS DE PRODUCTOS
        =====================================================================================*/
        for ($i = 2; $i <= $numeroFilasProductos; $i++) {

            $codigo_producto = $hojaProductos->getCell("A" . $i);
            $id_categoria = ProductosModelo::mdlBuscarIdCategoria($hojaProductos->getCell("B" . $i));
            $descripcion = $hojaProductos->getCell("C" . $i);
            $id_tipo_afectacion_igv =  ProductosModelo::mdlBuscarIdTipoAfectacion($hojaProductos->getCell("D" . $i)->getCalculatedValue());
            $id_unidad_medida =  ProductosModelo::mdlBuscarIdUnidadMedida($hojaProductos->getCell("E" . $i)->getCalculatedValue());
            $costo_unitario = $hojaProductos->getCell("F" . $i);
            $precio_unitario_con_igv = $hojaProductos->getCell("G" . $i);
            $precio_unitario_sin_igv = $hojaProductos->getCell("H" . $i)->getCalculatedValue();
            $precio_unitario_mayor_con_igv = $hojaProductos->getCell("I" . $i);
            $precio_unitario_mayor_sin_igv = $hojaProductos->getCell("J" . $i)->getCalculatedValue();
            $precio_unitario_oferta_con_igv = $hojaProductos->getCell("K" . $i);
            $precio_unitario_oferta_sin_igv = $hojaProductos->getCell("L" . $i)->getCalculatedValue();
            $stock = $hojaProductos->getCell("M" . $i);
            $minimo_stock = $hojaProductos->getCell("N" . $i);
            $ventas = $hojaProductos->getCell("O" . $i);
            $costo_total = $hojaProductos->getCell("P" . $i)->getCalculatedValue();
            $imagen = $hojaProductos->getCell("Q" . $i);

            if(strlen($imagen) == 0){
                $imagen = 'no_image.jpg';
            }

            if (!empty($codigo_producto) && strlen($codigo_producto) > 0) {

                try {
                    $stmt = $dbh->prepare("INSERT INTO productos(
                                                                codigo_producto, 
                                                                id_categoria, 
                                                                descripcion, 
                                                                id_tipo_afectacion_igv, 
                                                                id_unidad_medida,
                                                                costo_unitario, 
                                                                precio_unitario_con_igv, 
                                                                precio_unitario_sin_igv, 
                                                                precio_unitario_mayor_con_igv, 
                                                                precio_unitario_mayor_sin_igv, 
                                                                precio_unitario_oferta_con_igv, 
                                                                precio_unitario_oferta_sin_igv, 
                                                                stock, 
                                                                minimo_stock, 
                                                                ventas, 
                                                                costo_total,
                                                                imagen
                                                                )
                                                                values(?,?,?,?,?,ROUND(?,2),ROUND(?,2),ROUND(?,2),ROUND(?,2),ROUND(?,2),ROUND(?,2),ROUND(?,2),?,?,?,ROUND(?,2),?)");

                    $dbh->beginTransaction();
                    $stmt->execute(array(
                        $codigo_producto,
                        $id_categoria[0],
                        $descripcion,
                        $id_tipo_afectacion_igv[0],
                        $id_unidad_medida[0],
                        $costo_unitario,
                        $precio_unitario_con_igv,
                        $precio_unitario_sin_igv,
                        $precio_unitario_mayor_con_igv,
                        $precio_unitario_mayor_sin_igv,
                        $precio_unitario_oferta_con_igv,
                        $precio_unitario_oferta_sin_igv,
                        $stock,
                        $minimo_stock,
                        $ventas,
                        $costo_total,
                        $imagen
                    ));

                    $dbh->commit();

                    $productosRegistrados += 1;

                    $concepto = 'INVENTARIO INICIAL';
                    $comprobante = '';

                    //REGISTRAMOS KARDEX - INVENTARIO INICIAL
                    $stmt = $dbh->prepare("call prc_registrar_kardex_existencias(?,?,?,?,?,?)");

                    $dbh->beginTransaction();
                    $stmt->execute(array(
                        $codigo_producto,
                        $concepto,
                        $comprobante,
                        $stock,
                        $costo_unitario,
                        $costo_total
                    ));

                    $dbh->commit();
                    // }
                } catch (Exception $e) {
                    $dbh->rollBack();
                    $respuesta["tipo_msj"] = "error";
                    $respuesta["msj"] = "Error al cargar los productos al sistema" . $e->getMessage();
                    return $respuesta;
                }
            }
        }

        try {
            $stmt = $dbh->prepare("UPDATE historico_cargas_masivas
                                    SET productos_insertados = :productos_insertados
                                    WHERE id = :id");

            $dbh->beginTransaction();
            $stmt->execute(array(
                ':productos_insertados' => $productosRegistrados,
                ':id' => $id_carga_masiva
            ));
            $dbh->commit();

            $stmt = $dbh->prepare("UPDATE historico_cargas_masivas
                                    SET estado_carga = case 
                                                            when (categorias_insertadas = categorias_excel 
                                                                    and productos_insertados = productos_excel 
                                                                    and unidades_medida_insertadas = unidades_medida_excel)
                                                                then 1
                                                            else 0
                                                        end
                                    WHERE id = :id");

            $dbh->beginTransaction();
            $stmt->execute(array(
                ':id' => $id_carga_masiva
            ));
            $dbh->commit();

        } catch (Exception $e) {
            $dbh->rollBack();
            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al el historico de cargas -> Unidades de Medida " . $e->getMessage();
            return $respuesta;
        }

        $respuesta["tipo_msj"] = "success";
        $respuesta["msj"] = "La carga masiva se realizó correctamente";

        return $respuesta;
    }

    /*===================================================================
    BUSCAR EL ID DE UNA CATEGORIA POR EL NOMBRE DE LA CATEGORIA
    ====================================================================*/
    static public function mdlBuscarIdCategoria($nombreCategoria)
    {

        $stmt = Conexion::conectar()->prepare("select id from categorias where descripcion = :nombreCategoria");
        $stmt->bindParam(":nombreCategoria", $nombreCategoria, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();
    }

    /*===================================================================
    BUSCAR EL ID DE UNA CATEGORIA POR EL NOMBRE DE LA CATEGORIA
    ====================================================================*/
    static public function mdlBuscarIdTipoAfectacion($nombreTipoAfectacion)
    {

        $stmt = Conexion::conectar()->prepare("select codigo from tipo_afectacion_igv where upper(descripcion) = upper(:nombreTipoAfectacion)");
        $stmt->bindParam(":nombreTipoAfectacion", $nombreTipoAfectacion, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();
    }

    /*===================================================================
    BUSCAR EL ID DE UNA CATEGORIA POR EL NOMBRE DE LA CATEGORIA
    ====================================================================*/
    static public function mdlBuscarIdUnidadMedida($nombreUnidadMedida)
    {

        $stmt = Conexion::conectar()->prepare("select id from codigo_unidad_medida where descripcion = :nombreUnidadMedida");
        $stmt->bindParam(":nombreUnidadMedida", $nombreUnidadMedida, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();
    }

    /*===================================================================
    OBTENER LISTADO TOTAL DE PRODUCTOS PARA EL DATATABLE
    ====================================================================*/
    static public function mdlListarProductos()
    {

        $stmt = Conexion::conectar()->prepare('call prc_ListarProductos');

        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function mdlObtenerProductoPorId($id_producto)
    {

        $stmt = Conexion::conectar()->prepare('SELECT  
                                                p.id, 
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
                                                p.estado
                                            FROM productos p 
                                            WHERE p.id = :id_producto');

        $stmt->bindParam(":id_producto", $id_producto, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    static public function mdlListarProductosPorCategoria($id_categoria)
    {

        $stmt = Conexion::conectar()->prepare('SELECT  
                                                codigo_producto,
                                                p.id_categoria,
                                                upper(c.descripcion) as nombre_categoria,
                                                upper(p.descripcion) as producto,
                                                imagen,
                                                p.id_tipo_afectacion_igv,
                                                upper(tai.descripcion) as tipo_afectacion_igv,
                                                p.id_unidad_medida,
                                                upper(cum.descripcion) as unidad_medida,
                                                ROUND(costo_unitario,2) as costo_unitario,
                                                ROUND(precio_unitario_con_igv,2) as precio_unitario_con_igv,
                                                ROUND(precio_unitario_sin_igv,2) as precio_unitario_sin_igv,
                                                ROUND(precio_unitario_mayor_con_igv,2) as precio_unitario_mayor_con_igv,
                                                ROUND(precio_unitario_mayor_sin_igv,2) as precio_unitario_mayor_sin_igv,
                                                ROUND(precio_unitario_oferta_con_igv,2) as precio_unitario_oferta_con_igv,
                                                ROUND(precio_unitario_oferta_sin_igv,2) as precio_unitario_oferta_sin_igv,
                                                stock,
                                                minimo_stock,
                                                ventas,
                                                ROUND(costo_total,2) as costo_total,
                                                p.fecha_creacion,
                                                p.fecha_actualizacion,
                                                p.estado
                                            FROM productos p INNER JOIN categorias c on p.id_categoria = c.id
                                                            inner join tipo_afectacion_igv tai on tai.codigo = p.id_tipo_afectacion_igv
                                                            inner join codigo_unidad_medida cum on cum.id = p.id_unidad_medida
                                            WHERE p.estado in (0,1)
                                            AND p.stock > 0
                                            AND (p.id_categoria = :id_categoria or :id_categoria = 0)
                                            order by p.codigo_producto desc');

        $stmt->bindParam(":id_categoria", $id_categoria, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function mdlListarProductosPorDescripcion($producto)
    {

        $stmt = Conexion::conectar()->prepare('SELECT  
                                                codigo_producto,
                                                p.id_categoria,
                                                upper(c.descripcion) as nombre_categoria,
                                                upper(p.descripcion) as producto,
                                                imagen,
                                                p.id_tipo_afectacion_igv,
                                                upper(tai.descripcion) as tipo_afectacion_igv,
                                                p.id_unidad_medida,
                                                upper(cum.descripcion) as unidad_medida,
                                                ROUND(costo_unitario,2) as costo_unitario,
                                                ROUND(precio_unitario_con_igv,2) as precio_unitario_con_igv,
                                                ROUND(precio_unitario_sin_igv,2) as precio_unitario_sin_igv,
                                                ROUND(precio_unitario_mayor_con_igv,2) as precio_unitario_mayor_con_igv,
                                                ROUND(precio_unitario_mayor_sin_igv,2) as precio_unitario_mayor_sin_igv,
                                                ROUND(precio_unitario_oferta_con_igv,2) as precio_unitario_oferta_con_igv,
                                                ROUND(precio_unitario_oferta_sin_igv,2) as precio_unitario_oferta_sin_igv,
                                                stock,
                                                minimo_stock,
                                                ventas,
                                                ROUND(costo_total,2) as costo_total,
                                                p.fecha_creacion,
                                                p.fecha_actualizacion,
                                                p.estado
                                            FROM productos p INNER JOIN categorias c on p.id_categoria = c.id
                                                            inner join tipo_afectacion_igv tai on tai.codigo = p.id_tipo_afectacion_igv
                                                            inner join codigo_unidad_medida cum on cum.id = p.id_unidad_medida
                                            WHERE p.estado in (0,1)
                                            AND (p.descripcion like concat("%",:producto,"%") or c.descripcion like concat("%",:producto,"%") 
                                                    or p.codigo_producto like concat("%",:producto,"%")
                                                    or :producto = "")
                                            order by p.codigo_producto desc');

        $stmt->bindParam(":producto", $producto, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /*===================================================================
    REGISTRAR PRODUCTO POR MODULO DE INVENTARIO
    ====================================================================*/
    static public function mdlRegistrarProducto($array_datos_producto, $imagen = null)
    {

        try {

            $dbh = Conexion::conectar();

            $fecha = date('Y-m-d');
            $costo_total_producto = 0;

            $stmt = $dbh->prepare("INSERT INTO productos(codigo_producto, 
                                                        id_categoria,
                                                        descripcion, 
                                                        id_tipo_afectacion_igv, 
                                                        id_unidad_medida,
                                                        precio_unitario_con_igv,
                                                        precio_unitario_sin_igv, 
                                                        precio_unitario_mayor_con_igv,
                                                        precio_unitario_mayor_sin_igv,
                                                        precio_unitario_oferta_con_igv,
                                                        precio_unitario_oferta_sin_igv,
                                                        imagen,
                                                        minimo_stock,
                                                        fecha_creacion,
                                                        fecha_actualizacion) 
                                                VALUES (?,?,upper(?),?,?,?,?,?,?,?,?,?,?,?,?)");

            $dbh->beginTransaction();
            $stmt->execute(array(
                $array_datos_producto["codigo_producto"],
                $array_datos_producto["id_categoria"],
                $array_datos_producto["descripcion"],
                $array_datos_producto["id_tipo_afectacion_igv"],
                $array_datos_producto["id_unidad_medida"],
                $array_datos_producto["precio_unitario_con_igv"],
                $array_datos_producto["precio_unitario_sin_igv"],
                $array_datos_producto["precio_unitario_mayor_con_igv"],
                $array_datos_producto["precio_unitario_mayor_sin_igv"],
                $array_datos_producto["precio_unitario_oferta_con_igv"],
                $array_datos_producto["precio_unitario_oferta_sin_igv"],
                $imagen["nuevoNombre"] ?? 'no_image.jpg',
                $array_datos_producto["minimo_stock"],
                $fecha,
                $fecha
            ));
            $dbh->commit();

            //GUARDAMOS LA IMAGEN EN LA CARPETA
            if ($imagen) {
                $guardarImagen = new ProductosModelo();
                $guardarImagen->guardarImagen($imagen["folder"], $imagen["ubicacionTemporal"], $imagen["nuevoNombre"]);
            }

            $concepto = 'REGISTRADO EN SISTEMA';
            $comprobante = '';

            //REGISTRAMOS KARDEX - INVENTARIO INICIAL
            $stmt = $dbh->prepare("call prc_registrar_kardex_existencias(?,?,?,?,?,?);");

            $dbh->beginTransaction();
            $stmt->execute(array(
                $array_datos_producto["codigo_producto"],
                $concepto,
                $comprobante,
                0,
                0,
                $costo_total_producto
            ));

            $dbh->commit();

            $respuesta["tipo_msj"] = "success";
            $respuesta["msj"] = "Se registró el producto correctamente";
        } catch (Exception $e) {
            $dbh->rollBack();
            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al registrar el producto " . $e->getMessage();
        }

        return $respuesta;
    }

    /*===================================================================
    ACTUALIZAR PRODUCTO
    ====================================================================*/
    static public function mdlActualizarProducto($array_datos_producto, $imagen = null)
    {

        $stmt = Conexion::conectar()->prepare("select imagen from productos where codigo_producto = :codigo_producto");
        $stmt->bindParam(":codigo_producto", $array_datos_producto["codigo_producto"], PDO::PARAM_STR);
        $stmt->execute();

        $imagen_actual = $stmt->fetch()[0];

        try {

            $dbh = Conexion::conectar();

            $fecha_actualizacion = date('Y-m-d');

            $stmt = $dbh->prepare(" UPDATE  
                                        productos
                                    SET 
                                    id_categoria = ?,
                                    descripcion = ?, 
                                    id_tipo_afectacion_igv = ?, 
                                    id_unidad_medida = ?,
                                    precio_unitario_con_igv = ?,
                                    precio_unitario_sin_igv = ?, 
                                    precio_unitario_mayor_con_igv = ?,
                                    precio_unitario_mayor_sin_igv = ?,
                                    precio_unitario_oferta_con_igv = ?,
                                    precio_unitario_oferta_sin_igv = ?,
                                    imagen = ?,
                                    minimo_stock = ?, 
                                    fecha_actualizacion = ?
                                    WHERE 
                                        codigo_producto = ?");

            $dbh->beginTransaction();
            $stmt->execute(array(

                $array_datos_producto["id_categoria"],
                $array_datos_producto["descripcion"],
                $array_datos_producto["id_tipo_afectacion_igv"],
                $array_datos_producto["id_unidad_medida"],
                $array_datos_producto["precio_unitario_con_igv"],
                $array_datos_producto["precio_unitario_sin_igv"],
                $array_datos_producto["precio_unitario_mayor_con_igv"],
                $array_datos_producto["precio_unitario_mayor_sin_igv"],
                $array_datos_producto["precio_unitario_oferta_con_igv"],
                $array_datos_producto["precio_unitario_oferta_sin_igv"],
                $imagen["nuevoNombre"] ?? $imagen_actual,
                $array_datos_producto["minimo_stock"],
                $fecha_actualizacion,
                $array_datos_producto["codigo_producto"],
            ));

            $dbh->commit();

            //GUARDAMOS LA IMAGEN EN LA CARPETA
            if ($imagen) {
                $guardarImagen = new ProductosModelo();
                $guardarImagen->guardarImagen($imagen["folder"], $imagen["ubicacionTemporal"], $imagen["nuevoNombre"]);
            }


            $respuesta["tipo_msj"] = "success";
            $respuesta["msj"] = "Se actualizó el producto correctamente";
        } catch (Exception $e) {
            $dbh->rollBack();
            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al actualizar el producto " . $e->getMessage();
        }

        return $respuesta;
    }

    /*===================================================================
    ELIMINAR PRODUCTOS
    ====================================================================*/
    static public function mdlEliminarProducto($codigo_producto)
    {

        try {

            $dbh = Conexion::conectar();

            $stmt = $dbh->prepare(" UPDATE  
                                        productos
                                    SET 
                                        estado = 0
                                    WHERE 
                                        codigo_producto = ?");

            $dbh->beginTransaction();
            $stmt->execute(array(
                $codigo_producto
            ));

            $dbh->commit();

            $respuesta["tipo_msj"] = "success";
            $respuesta["msj"] = "Se eliminó el producto correctamente";
        } catch (Exception $e) {
            $dbh->rollBack();
            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al eliminar el producto " . $e->getMessage();
        }

        return $respuesta;
    }

    /*=============================================
    AUMENTAR STOCK
    =============================================*/
    static public function mdlAumentarStock($codigo_producto, $nuevo_stock)
    {

        $concepto = 'AUMENTO DE STOCK POR MODULO DE INVENTARIO';

        try {

            $dbh = Conexion::conectar();

            $stmt = $dbh->prepare("call prc_registrar_kardex_bono(?,?,?);");

            $dbh->beginTransaction();
            $stmt->execute(array(
                $codigo_producto,
                $concepto,
                $nuevo_stock
            ));

            $dbh->commit();

            $respuesta["tipo_msj"] = "success";
            $respuesta["msj"] = "Se aumentó el stock del producto correctamente";
        } catch (Exception $e) {
            $dbh->rollBack();
            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al aumentar el stock del producto " . $e->getMessage();
        }

        return $respuesta;
    }

    /*=============================================
    DISMINUIR STOCK
    =============================================*/
    static public function mdlDisminuirStock($codigo_producto, $nuevo_stock)
    {

        $concepto = 'DISMINUCIÓN DE STOCK POR MODULO DE INVENTARIO';

        try {

            $dbh = Conexion::conectar();

            $stmt = $dbh->prepare("call prc_registrar_kardex_vencido(?,?,?)");

            $dbh->beginTransaction();
            $stmt->execute(array(
                $codigo_producto,
                $concepto,
                $nuevo_stock
            ));

            $dbh->commit();

            $respuesta["tipo_msj"] = "success";
            $respuesta["msj"] = "Se disminuyó el stock del producto correctamente";
        } catch (Exception $e) {
            $dbh->rollBack();
            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al dismiunir el stock del producto " . $e->getMessage();
        }

        return $respuesta;
    }

    /*===================================================================
    LISTAR NOMBRE DE PRODUCTOS PARA INPUT DE AUTO COMPLETADO
    ====================================================================*/
    static public function mdlListarNombreProductos()
    {

        $stmt = Conexion::conectar()->prepare(
            "SELECT Concat(codigo_producto , ' / ' ,
                                                             c.nombre_categoria,' / ',
                                                             descripcion_producto, ' - S./ ' , 
                                                             p.precio_venta_producto, ' / Stock: ',
                                                             p.stock_producto)  as descripcion_producto
                                                FROM productos p inner join categorias c on p.id_categoria_producto = c.id_categoria"
        );

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /*===================================================================
    BUSCAR PRODUCTO POR SU CODIGO DE BARRAS
    ====================================================================*/
    static public function mdlGetDatosProducto($codigoProducto)
    {

        $stmt = Conexion::conectar()->prepare("SELECT p.codigo_producto, 
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
                                                    p.precio_unitario_con_igv, 
                                                    p.precio_unitario_sin_igv, 
                                                    p.precio_unitario_mayor_con_igv, 
                                                    p.precio_unitario_mayor_sin_igv, 
                                                    p.precio_unitario_oferta_con_igv, 
                                                    p.precio_unitario_oferta_sin_igv, 
                                                    p.stock,         
                                                    p.costo_total,
                                                    case when p.id_tipo_afectacion_igv = 10 then round((tai.porcentaje_impuesto/100)+1,2) else 1 end as factor_igv,
                                                    case when p.id_tipo_afectacion_igv = 10 then round((porcentaje_impuesto/100),2) else 0 end as porcentaje_igv,
                                                    p.imagen
                                                FROM productos p inner join tipo_afectacion_igv tai on tai.codigo = p.id_tipo_afectacion_igv
                                                                inner join codigo_unidad_medida cum on cum.id = p.id_unidad_medida
                                                WHERE codigo_producto = :codigoProducto
                                                AND p.stock > 0");

        $stmt->bindParam(":codigoProducto", $codigoProducto, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /*===================================================================
    BUSCAR PRODUCTO POR SU CODIGO DE BARRAS
    ====================================================================*/
    static public function mdlObtenerProducto($codigoProducto)
    {

        $stmt = Conexion::conectar()->prepare("SELECT p.codigo_producto, 
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
                                                    p.precio_unitario_con_igv, 
                                                    p.precio_unitario_sin_igv, 
                                                    p.precio_unitario_mayor_con_igv, 
                                                    p.precio_unitario_mayor_sin_igv, 
                                                    p.precio_unitario_oferta_con_igv, 
                                                    p.precio_unitario_oferta_sin_igv, 
                                                    p.stock,         
                                                    p.costo_total,
                                                    case when p.id_tipo_afectacion_igv = 10 then 1.18 else 1 end as factor_igv,
                                                    case when p.id_tipo_afectacion_igv = 10 then 0.18 else 0 end as porcentaje_igv
                                                FROM productos p inner join tipo_afectacion_igv tai on tai.codigo = p.id_tipo_afectacion_igv
                                                                inner join codigo_unidad_medida cum on cum.id = p.id_unidad_medida
                                                WHERE codigo_producto = :codigoProducto");

        $stmt->bindParam(":codigoProducto", $codigoProducto, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /*===================================================================
    VERIFICAR EL STOCK DE UN PRODUCTO
    ====================================================================*/
    static public function mdlVerificaStockProducto($codigo_producto, $cantidad_a_comprar)
    {

        $stmt = Conexion::conectar()->prepare("SELECT   count(*) as existe, stock
                                                    FROM productos p 
                                                   WHERE p.codigo_producto = :codigo_producto");
        // AND p.stock >= :cantidad_a_comprar");

        $stmt->bindParam(":codigo_producto", $codigo_producto, PDO::PARAM_STR);
        // $stmt->bindParam(":cantidad_a_comprar", $cantidad_a_comprar, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function guardarImagen($folder, $ubicacionTemporal, $nuevoNombre)
    {
        file_put_contents(strtolower($folder . $nuevoNombre), file_get_contents($ubicacionTemporal));
    }

    /*=============================================
    FUNCION PARA DESACTIVAR UN PRODUCTO
    =============================================*/
    static public function mdlDesactivarProducto($codigo_producto)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE productos 
                                                  SET estado = 0 
                                                WHERE codigo_producto = :codigo_producto");

        $stmt->bindParam(":codigo_producto", $codigo_producto, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $respuesta["tipo_msj"] = "success";
            $respuesta["msj"] = "Se desactivó el Producto correctamente";
        } else {
            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al desactivar el Producto." . Conexion::conectar()->errorInfo();
        }

        return $respuesta;
    }

    /*=============================================
    FUNCION PARA ACTIVAR UN PRODUCTO
    =============================================*/
    static public function mdlActivarProducto($codigo_producto)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE productos 
                                                  SET estado = 1
                                                WHERE codigo_producto = :codigo_producto");

        $stmt->bindParam(":codigo_producto", $codigo_producto, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $respuesta["tipo_msj"] = "success";
            $respuesta["msj"] = "Se activó el Producto correctamente";
        } else {
            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al activar el Producto." . Conexion::conectar()->errorInfo();
        }

        return $respuesta;
    }

    static public function mdlListarTipoAfectacion()
    {
        $stmt = Conexion::conectar()->prepare("select codigo,concat(codigo, ' - ', descripcion) as descripcion  from tipo_afectacion_igv where estado = 1;");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static public function mdlListarUnidadMedida()
    {
        $stmt = Conexion::conectar()->prepare("select id,concat(id, ' - ', descripcion) as descripcion from codigo_unidad_medida where estado = 1;");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static public function mdlObtenerImpuesto($codigo_tipo_afectacion)
    {
        // $stmt = Conexion::conectar()->prepare("select id_tipo_operacion, impuesto
        //                                         from impuestos 
        //                                         where estado = 1
        //                                         and id_tipo_operacion = :id_tipo_operacion");

         $stmt = Conexion::conectar()->prepare("SELECT  porcentaje_impuesto as impuesto
                                                FROM tipo_afectacion_igv 
                                                WHERE codigo = :codigo_tipo_afectacion");

        $stmt->bindParam(":codigo_tipo_afectacion", $codigo_tipo_afectacion, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_NAMED);
    }

    static public function mdlValidarCodigoProducto($codigo_producto)
    {

        $stmt = Conexion::conectar()->prepare(" SELECT count(1) as existe
                                            FROM productos p
                                            WHERE codigo_producto = :codigo_producto");

        $stmt->bindParam(":codigo_producto", $codigo_producto, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_NAMED);
    }

    static public function mdlListarCargasMasivas()
    {

        $stmt = Conexion::conectar()->prepare("SELECT '' as detalles,
                                                    id, 
                                                    categorias_insertadas, 
                                                    categorias_excel, 
                                                    productos_insertados, 
                                                    productos_excel, 
                                                    unidades_medida_insertadas, 
                                                    unidades_medida_excel,
                                                    estado_carga,
                                                    fecha_carga
                                                FROM historico_cargas_masivas
                                                ORDER BY id DESC");

        $stmt->execute();

        return $stmt->fetchAll();
    }
}
