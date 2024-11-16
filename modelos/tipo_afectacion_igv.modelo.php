<?php

require_once "conexion.php";

class TipoAfectacionIgvModelo
{

    static public function mdlObtenerTipoAfectacionIgv($post)
    {

        $column = ["id", "descripcion", "letra_tributo", "codigo_tributo", "nombre_tributo", "tipo_tributo", "porcentaje_impuesto", "estado"];

        $query = " SELECT  '' as opciones,
                            ta.id, 
                            ta.codigo, 
                            ta.descripcion, 
                            ta.letra_tributo, 
                            ta.codigo_tributo, 
                            ta.nombre_tributo, 
                            ta.tipo_tributo,
                            porcentaje_impuesto,
                        case when ta.estado = 1 then 'ACTIVO' else 'INACTIVO' end as estado
                    FROM tipo_afectacion_igv ta";

        if (isset($post["search"]["value"])) {
            $query .= ' WHERE ta.descripcion like "%' . $post["search"]["value"] . '%"
                            or ta.codigo like "%' . $post["search"]["value"] . '%"
                            or ta.nombre_tributo like "%' . $post["search"]["value"] . '%"
                            or ta.tipo_tributo like "%' . $post["search"]["value"] . '%"
                            or case when ta.estado = 1 then "ACTIVO" else "INACTIVO" end like "%' . $post["search"]["value"] . '%"';
        }

        if (isset($post["order"])) {
            $query .= ' ORDER BY ' . $column[$post['order']['0']['column']] . ' ' . $post['order']['0']['dir'] . ' ';
        } else {
            $query .= ' ORDER BY ta.id asc ';
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

        $results = $stmt->fetchAll();

        $data = array();

        foreach ($results as $row) {
            $sub_array = array();
            $sub_array[] = $row['opciones'];
            $sub_array[] = $row['id'];
            $sub_array[] = $row['codigo'];
            $sub_array[] = $row['descripcion'];
            $sub_array[] = $row['letra_tributo'];
            $sub_array[] = $row['codigo_tributo'];
            $sub_array[] = $row['nombre_tributo'];
            $sub_array[] = $row['tipo_tributo'];
            $sub_array[] = $row['porcentaje_impuesto'];
            $sub_array[] = $row['estado'];
            $data[] = $sub_array;
        }

        $stmt = Conexion::conectar()->prepare("SELECT 1
                                                FROM tipo_afectacion_igv ta");

        $stmt->execute();

        $count_all_data = $stmt->rowCount();

        $output = array(
            'draw' => $post['draw'],
            "recordsTotal" => $count_all_data,
            "recordsFiltered" => $number_filter_row,
            "data" => $data
        );

        return $output;
    }

    static public function mdlRegistrarTipoAfectacionIgv($tipo_afectacion_igv)
    {

        $dbh = Conexion::conectar();

        try {

            if ($tipo_afectacion_igv["id_tipo_afectacion"] > 0) {

                $stmt = $dbh->prepare("UPDATE tipo_afectacion_igv
                                        SET codigo = :codigo,
                                            descripcion = :descripcion,
                                            letra_tributo = :letra_tributo,
                                            codigo_tributo = :codigo_tributo,
                                            nombre_tributo = :nombre_tributo,
                                            tipo_tributo = :tipo_tributo,
                                            porcentaje_impuesto = :porcentaje_impuesto,
                                            estado = :estado
                                        WHERE id = :id_tipo_afectacion");
                $dbh->beginTransaction();
                $stmt->execute(array(
                    ':codigo' => $tipo_afectacion_igv['codigo'],
                    ':descripcion' => $tipo_afectacion_igv['descripcion'],
                    ':letra_tributo' => $tipo_afectacion_igv['letra_tributo'],
                    ':codigo_tributo' => $tipo_afectacion_igv['codigo_tributo'],
                    ':nombre_tributo' => $tipo_afectacion_igv['nombre_tributo'],
                    ':tipo_tributo' => $tipo_afectacion_igv['tipo_tributo'],
                    ':porcentaje_impuesto' => $tipo_afectacion_igv['porcentaje_impuesto'],
                    ':estado' => $tipo_afectacion_igv['estado'],
                    ':id_tipo_afectacion' => $tipo_afectacion_igv["id_tipo_afectacion"]
                ));

                $dbh->commit();

                $respuesta['tipo_msj'] = 'success';
                $respuesta['msj'] = 'Se actualizó el tipo de afectación correctamente';
            } else {

                $stmt = $dbh->prepare("INSERT INTO tipo_afectacion_igv(codigo,
                                                                        descripcion,
                                                                        letra_tributo,
                                                                        codigo_tributo,
                                                                        nombre_tributo,
                                                                        tipo_tributo,
                                                                        porcentaje_impuesto,
                                                                        estado)
                                            VALUES(:codigo,
                                                    upper(:descripcion),
                                                    upper(:letra_tributo),
                                                    upper(:codigo_tributo),
                                                    upper(:nombre_tributo),
                                                    upper(:tipo_tributo),
                                                    :porcentaje_impuesto,
                                                    :estado)");
                $dbh->beginTransaction();
                $stmt->execute(array(
                    ':codigo' => $tipo_afectacion_igv['codigo'],
                    ':descripcion' => $tipo_afectacion_igv['descripcion'],
                    ':letra_tributo' => $tipo_afectacion_igv['letra_tributo'],
                    ':codigo_tributo' => $tipo_afectacion_igv['codigo_tributo'],
                    ':nombre_tributo' => $tipo_afectacion_igv['nombre_tributo'],
                    ':tipo_tributo' => $tipo_afectacion_igv['tipo_tributo'],
                    ':porcentaje_impuesto' => $tipo_afectacion_igv['porcentaje_impuesto'],
                    ':estado' => $tipo_afectacion_igv['estado']
                ));

                $dbh->commit();

                $respuesta['tipo_msj'] = 'success';
                $respuesta['msj'] = 'Se registró el tipo de afectación correctamente';
            }
        } catch (Exception $e) {
            $dbh->rollBack();
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al registrar el tipo de afectación ' . $e->getMessage();
        }

        return $respuesta;
    }

    static public function mdlValidarCodigoAfectacion($codigo_afectacion)
    {

        $stmt = Conexion::conectar()->prepare(" SELECT count(1) as existe
                                            FROM tipo_afectacion_igv 
                                            WHERE codigo = :codigo_afectacion");

        $stmt->bindParam(":codigo_afectacion", $codigo_afectacion, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_NAMED);
    }

    static public function mdlEliminarTipoAfectacion($id_tipo_afectacion)
    {

        $dbh = Conexion::conectar();

        try {

            $stmt = Conexion::conectar()->prepare(" SELECT count(1) as existe
                                                    FROM productos p inner join tipo_afectacion_igv ta on p.id_tipo_afectacion_igv = ta.codigo
                                                    WHERE ta.id = :id_tipo_afectacion");

            $stmt->bindParam(":id_tipo_afectacion", $id_tipo_afectacion, PDO::PARAM_STR);

            $stmt->execute();
            $existe = $stmt->fetch(PDO::FETCH_NAMED);

            if(intval($existe["existe"]) > 0){

                $respuesta['tipo_msj'] = 'error';
                $respuesta['msj'] = 'No se puede eliminar el tipo de afectación porque está asociado a productos registrados en el sistema';
                return $respuesta;
            }
            
            $stmt = $dbh->prepare("DELETE FROM tipo_afectacion_igv                                        
                                        WHERE id = :id_tipo_afectacion");
            $dbh->beginTransaction();
            $stmt->execute(array(
                ':id_tipo_afectacion' => $id_tipo_afectacion
            ));

            $dbh->commit();

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = 'Se eliminó el tipo de afectación correctamente';
        } catch (Exception $e) {
            $dbh->rollBack();
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al eliminar el tipo de afectación ' . $e->getMessage();
        }

        return $respuesta;
    }

    static public function mdlObtenerPorcentajeImpuesto($codigo_afectacion)
    {

        $stmt = Conexion::conectar()->prepare(" SELECT  round((porcentaje_impuesto/100),2) as porcentaje,
                                                        round((porcentaje_impuesto/100+1),2) as factor
                                                FROM tipo_afectacion_igv 
                                                WHERE codigo = :codigo_afectacion");

        $stmt->bindParam(":codigo_afectacion", $codigo_afectacion, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_NAMED);
    }

}
