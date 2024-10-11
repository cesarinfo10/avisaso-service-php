<?php

require_once "conexion.php";

class ModelTipo{
    /*=============================================
	LLAMAR A TODOS LOS TIPO USUARIOS
	=============================================*/
    static public function allUserTipoMDL($tabla){

        $sql = Conexion::conectar()->prepare("SELECT *FROM $tabla");

        $sql ->execute();

        return $sql -> fetchAll();
    }

}