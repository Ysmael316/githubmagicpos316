<?php

require_once "conexion.php";

class CategoriasModelo
{


    static public function mdlObtenerCategorias()
    {

        $stmt = Conexion::conectar()->prepare("SELECT  id, 
                                                        descripcion
                                                FROM categorias c
                                                WHERE estado = 1
                                                order BY descripcion");

        $stmt->execute();

        return $stmt->fetchAll();
    }

    static public function mdlListarCategorias($post)
    {

        $column = ["id", "descripcion", "fecha_creacion_categoria", "estado"];

        $query = " SELECT '' as opciones,
                         id, 
                        descripcion,
                        date(fecha_creacion) as fecha_creacion_categoria,
                        case when estado = 1 then 'ACTIVO' else 'INACTIVO' end as estado
                    FROM categorias c";

        if (isset($post["search"]["value"])) {
            $query .= ' WHERE descripcion like "%' . $post["search"]["value"] . '%"';
        }

        if (isset($post["order"])) {
            $query .= ' ORDER BY ' . $column[$post['order']['0']['column']] . ' ' . $post['order']['0']['dir'] . ' ';
        } else {
            $query .= ' ORDER BY descripcion asc ';
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
            $sub_array[] = $row['descripcion'];
            $sub_array[] = $row['estado'];
            $sub_array[] = $row['fecha_creacion_categoria'];
            $data[] = $sub_array;
        }

        $stmt = Conexion::conectar()->prepare("SELECT  'x'
                                                    FROM categorias c
                                                    order BY descripcion ");

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

    static public function mdlRegistrarCategoria($categoria)
    {

        try {

            $dbh = Conexion::conectar();

            $fecha = date('Y-m-d');

            $stmt = $dbh->prepare("INSERT INTO categorias(descripcion)
                                VALUES(?)");

            $dbh->beginTransaction();
            $stmt->execute(array(
                $categoria
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

    static public function mdlActualizarCategoria($id_categoria, $descripcion)
    {

        try {

            $dbh = Conexion::conectar();

            $fecha = date('Y-m-d');

            $stmt = $dbh->prepare("UPDATE categorias 
                                      SET descripcion = :descripcion,
                                      fecha_actualizacion = :fecha_actualizacion_categoria
                                    WHERE id = :id_categoria");

            $dbh->beginTransaction();
            $stmt->execute(array(
                ':descripcion' => $descripcion,
                ':fecha_actualizacion_categoria' => $fecha,
                ':id_categoria' => $id_categoria,
            ));

            $dbh->commit();
            $respuesta["tipo_msj"] = "success";
            $respuesta["msj"] = "Se actualizó la categoría correctamente";
        } catch (Exception $e) {
            $dbh->rollBack();
            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al actualizar la categoría " . $e->getMessage();
        }

        return $respuesta;
    }

    static public function mdlCambiarEstadoCategoria($id_categoria, $estado)
    {

        try {

            $dbh = Conexion::conectar();

            $stmt = $dbh->prepare("UPDATE categorias
                                     SET estado = :estado
                                    WHERE id = :id_categoria");

            $dbh->beginTransaction();
            $stmt->execute(array(
                ':estado' => $estado,
                ':id_categoria' =>$id_categoria
            ));

            $dbh->commit();
            $respuesta["tipo_msj"] = "success";
            $respuesta["msj"] = "Se " . ($estado>0 ? 'activo':'desactivo') . " la categoría correctamente";
        } catch (Exception $e) {
            $dbh->rollBack();
            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al " . ($estado>0 ? 'activar':'desactivar') . " la categoría " . $e->getMessage();
        }

        return $respuesta;
    }

    static public function mdlEliminarCategoria($id_categoria)
    {

        try {

            $dbh = Conexion::conectar();

            $stmt = Conexion::conectar()->prepare(" SELECT count(1) as existe
                                                        FROM categorias c inner join productos p on c.id = p.id_categoria
                                                        WHERE c.id = :id_categoria");

            $stmt->bindParam(":id_categoria", $id_categoria, PDO::PARAM_STR);            

            $stmt->execute();

            $categoria =  $stmt->fetch(PDO::FETCH_NAMED);

            if($categoria["existe"] > 0){
                $respuesta["tipo_msj"] = "error";
                $respuesta["msj"] = "No se puede eliminar la categoria porque está asignada a productos";
                return $respuesta;
            }

            $stmt = $dbh->prepare("DELETE FROM categorias
                                    WHERE id = :id_categoria");

            $dbh->beginTransaction();
            $stmt->execute(array(
                ':id_categoria' => $id_categoria
            ));

            $dbh->commit();
            $respuesta["tipo_msj"] = "success";
            $respuesta["msj"] = "Se eliminó la categoría correctamente";
        } catch (Exception $e) {
            $dbh->rollBack();
            $respuesta["tipo_msj"] = "error";
            $respuesta["msj"] = "Error al eliminar la categoría " . $e->getMessage();
        }

        return $respuesta;
    }
}
