<?php

require_once "conexion.php";

class ConfiguracionesModelo
{


    static public function mdlObtenerConfiguracion($id_configuracion)
    {

        $stmt = Conexion::conectar()->prepare("SELECT '' as opciones,
                                                    id, 
                                                      ordinal, 
                                                    llave, 
                                                    valor
                                                FROM configuraciones
                                                WHERE id = :id_configuracion");

        $stmt->bindParam(":id_configuracion", $id_configuracion, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static public function mdlObtenerConfiguracionValue($id_configuracion, $id_ordinal)
    {

        $stmt = Conexion::conectar()->prepare("select valor from configuraciones where id = :id_configuracion and ordinal = :ordinal");

        $stmt->bindParam(":id_configuracion", $id_configuracion, PDO::PARAM_STR);
        $stmt->bindParam(":ordinal", $id_ordinal, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    static public function mdlActualizarConfiguracionCorreo($formulario_correo)
    {

        $dbh = Conexion::conectar();

        try {

            $stmt = $dbh->prepare("UPDATE   configuraciones
                                     SET    valor = :valor
                                    WHERE   id = :codigo and ordinal = :ordinal");
            $dbh->beginTransaction();
            $stmt->execute(array(
                ':valor' => $formulario_correo['valor'],
                ':codigo' => $formulario_correo['codigo'],
                ':ordinal' => $formulario_correo['ordinal']
            ));
            $dbh->commit();


            $respuesta['tipo_msj'] = 'success';
            $respuesta['msj'] = 'Se actualizó el valor correctamente';
        } catch (Exception $e) {
            $dbh->rollBack();
            $respuesta['tipo_msj'] = 'error';
            $respuesta['msj'] = 'Error al actualizar el valor ' . $e->getMessage();
        }

        return $respuesta;
    }
}
