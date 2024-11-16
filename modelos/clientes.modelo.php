<?php

require_once "conexion.php";

class ClientesModelo
{

    static public function mdlObtenerClientes($post)
    {

        $columns = [
            "id",
            "id_tipo_documento",
            "tipo_documento",
            "nro_documento",
            "nombres_apellidos_razon_social",
            "direccion",
            "telefono",
            "estado"
        ];

        $query = " SELECT 
                    '' as opciones,
                    cli.id,
                    cli.id_tipo_documento,
                    td.descripcion as tipo_documento,
                    cli.nro_documento,
                    cli.nombres_apellidos_razon_social,
                    cli.direccion,
                    cli.telefono,
                    case when cli.estado = 1 then 'ACTIVO' else 'INACTIVO' end as estado
            FROM clientes cli INNER JOIN tipo_documento td on cli.id_tipo_documento = td.id";

        if (isset($post["search"]["value"])) {
            $query .= ' WHERE td.descripcion like "%' . $post["search"]["value"] . '%"
                        or cli.nro_documento like "%' . $post["search"]["value"] . '%"
                        or cli.nombres_apellidos_razon_social like "%' . $post["search"]["value"] . '%"
                        or cli.direccion like "%' . $post["search"]["value"] . '%"
                        or cli.telefono like "%' . $post["search"]["value"] . '%"
                        or case when cli.estado = 1 then "ACTIVO" else "INACTIVO" end like "%' . $post["search"]["value"] . '%"';
        }

        if (isset($post["order"])) {
            $query .= ' ORDER BY ' . $columns[$post['order']['0']['column']] . ' ' . $post['order']['0']['dir'] . ' ';
        } else {
            $query .= ' ORDER BY cli.id desc ';
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
            $sub_array[] = $row['id_tipo_documento'];
            $sub_array[] = $row['tipo_documento'];
            $sub_array[] = $row['nro_documento'];
            $sub_array[] = $row['nombres_apellidos_razon_social'];
            $sub_array[] = $row['direccion'];
            $sub_array[] = $row['telefono'];
            $sub_array[] = $row['estado'];
            $data[] = $sub_array;
        }

        $stmt = Conexion::conectar()->prepare(" SELECT 'X'
                                                FROM clientes cli INNER JOIN tipo_documento td on cli.id_tipo_documento = td.id");

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

    static public function mdlRegistrarCliente($cliente)
    {

        $dbh = Conexion::conectar();

        try {

            $stmt = $dbh->prepare("INSERT INTO clientes(id_tipo_documento, 
                                                        nro_documento, 
                                                        nombres_apellidos_razon_social,                                                         
                                                        direccion, 
                                                        telefono, 
                                                        estado)
                                                VALUES(:id_tipo_documento, 
                                                        :nro_documento, 
                                                        upper(:nombres_apellidos_razon_social), 
                                                        upper(:direccion), 
                                                        :telefono, 
                                                        :estado)");
            $dbh->beginTransaction();
            $stmt->execute(array(
            ':id_tipo_documento' =>  $cliente['tipo_documento'],
            ':nro_documento' => $cliente['nro_documento'],
            ':nombres_apellidos_razon_social' => $cliente['nombre_cliente_razon_social'] ?? '',
            ':direccion' =>  $cliente['direccion'],
            ':telefono' =>  $cliente['telefono'],
            ':estado' => $cliente['estado']
            ));
            $dbh->commit();

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = 'Se registró el cliente correctamente';
        } catch (Exception $e) {
            $dbh->rollBack();
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al registrar el cliente ' . $e->getMessage();
        }

        return $respuesta;
    }

    static public function mdlActualizarCliente($cliente)
    {
        
        $dbh = Conexion::conectar();

        try {

            $stmt = $dbh->prepare("UPDATE   clientes
                                     SET    id_tipo_documento = :id_tipo_documento,
                                            nro_documento = :nro_documento,
                                            nombres_apellidos_razon_social = upper(:nombre_cliente_razon_social),
                                            direccion = upper(:direccion),
                                            telefono = :telefono,
                                            estado = :estado
                                    WHERE   id = :id_cliente");
            $dbh->beginTransaction();
            $stmt->execute(array(
                ':id_tipo_documento' => $cliente['tipo_documento'],
                ':nro_documento' => $cliente['nro_documento'],
                ':nombre_cliente_razon_social' => $cliente['nombre_cliente_razon_social'] ?? '',
                ':direccion' => $cliente['direccion'],
                ':telefono' => $cliente['telefono'],
                ':estado' => $cliente['estado'],
                ':id_cliente' => $cliente['id_cliente']
            ));
            $dbh->commit();

            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = 'Se actualizó el cliente correctamente';
        } catch (Exception $e) {
            $dbh->rollBack();
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al registrar al cliente ' . $e->getMessage();
        }

        return $respuesta;
    }

    static public function mdlValidarNroDocumento($id_cliente, $tipo_documento, $nro_documento)
    {

        $stmt = Conexion::conectar()->prepare(" SELECT count(1) as existe
                                            FROM clientes cli 
                                            WHERE id_tipo_documento = :tipo_documento
                                            AND cli.nro_documento = :nro_documento
                                            AND cli.id != :id_cliente");

        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_STR);
        $stmt->bindParam(":tipo_documento", $tipo_documento, PDO::PARAM_STR);
        $stmt->bindParam(":nro_documento", $nro_documento, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_NAMED);
    }

    static public function mdlObtenerClientePorDocumento($tipo_documento, $nro_documento)
    {

        $stmt = Conexion::conectar()->prepare(" SELECT id, 
                                                        id_tipo_documento, 
                                                        nro_documento, 
                                                        nombres_apellidos_razon_social as razonSocial,
                                                         direccion, 
                                                         telefono, 
                                                         estado
                                            FROM clientes cli 
                                            WHERE id_tipo_documento = :tipo_documento
                                            AND cli.nro_documento = :nro_documento");

        $stmt->bindParam(":tipo_documento", $tipo_documento, PDO::PARAM_STR);
        $stmt->bindParam(":nro_documento", $nro_documento, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_NAMED);
    }

    static public function mdlObtenerClientePorNroDocumento($nro_documento)
    {

        $stmt = Conexion::conectar()->prepare(" SELECT id, 
                                                        id_tipo_documento, 
                                                        nro_documento,                                                         
                                                        cli.nombres_apellidos_razon_social as razonSocial,
                                                         direccion, 
                                                         telefono, 
                                                         estado
                                            FROM clientes cli 
                                            WHERE cli.nro_documento = :nro_documento");

        $stmt->bindParam(":nro_documento", $nro_documento, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_NAMED);
    }

    static public function mdlAutocompleteClientes($dato_busqueda)
    {

        // $dato_busqueda = $_GET['term'];

        $stmt = Conexion::conectar()->prepare("SELECT 
                                            c.id, 
                                            c.id_tipo_documento, 
                                            c.nro_documento, 
                                            c.nombres_apellidos_razon_social, 
                                            c.direccion, 
                                            c.telefono, 
                                            c.estado
                                        FROM 
                                            clientes c                                        
                                        WHERE  (c.nombres_apellidos_razon_social  LIKE CONCAT('%', :dato_buscado, '%') 
                                                or c.nro_documento  LIKE CONCAT('%', :dato_buscado, '%'))                                        
                                        LIMIT 0,5");

        $stmt->bindParam(":dato_buscado", $dato_busqueda, PDO::PARAM_STR);
        $stmt->execute();

        $clientes = $stmt->fetchAll();

        $clientData = array();

        foreach ($clientes as $row) {

            $id_tipo_documento = $row['id_tipo_documento'];
            $nro_documento = $row['nro_documento'];
            $razon_social = $row['nombres_apellidos_razon_social'];
            $direccion = $row['direccion'];
            $telefono = $row['telefono'];
            
            // <a href="javascript:void(0);" class="d-flex border border-secondary border-left-0 border-right-0 border-top-0" style="width:100% !important;">
            $data["id"] = $nro_documento;
            $data["value"] = $nro_documento . ' - ' . $razon_social;
            $data["label"] = '<div class="row mx-0 border border-secondary border-left-0 border-right-0 border-top-0" style="z-index:100;">
                            <div class="col-lg-12 d-flex flex-row align-items-center">
                                <div class="d-flex flex-column ml-3 text-sm">
                                    <div class="text-sm">N° Doc: ' . $nro_documento . ' - Cliente: ' . $razon_social . '</div> 
                                </div>
                            </div>
                        </div>';

            array_push($clientData, $data);
        }

        return $clientData;

    }
}
