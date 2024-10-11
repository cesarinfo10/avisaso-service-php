<?php

require_once "conexion.php";

class ModelDatosMovil{

    /*=============================================
	INSERTAR DATOS GENERALES
	=============================================*/
    static public function newDatosMovilMDL($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("SELECT* FROM $tabla WHERE numPatente = :numPatente");
    
        $stmt->bindParam(":numPatente",$datos->numPatente, PDO::PARAM_STR);
        $stmt-> execute();
        $stmt = $stmt->fetchColumn();
    
        if ($stmt!=null){
            return "2";
        }else{
        
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla
        (numCarro, numPatente, idTipoMovil, nomMarca, nomModelo, numChasis,numMotor,ano, estado)
         VALUES (:numCarro, :numPatente, :idTipoMovil, :nomMarca, :nomModelo, :numChasis, :numMotor, :ano, :estado)");

        $stmt->bindParam(":numCarro", $datos->numCarro, PDO::PARAM_STR);
        $stmt->bindParam(":numPatente", $datos->numPatente, PDO::PARAM_STR);
        $stmt->bindParam(":idTipoMovil", $datos->idTipoMovil, PDO::PARAM_STR);
        $stmt->bindParam(":nomMarca", $datos->nomMarca, PDO::PARAM_STR);
        $stmt->bindParam(":nomModelo", $datos->nomModelo, PDO::PARAM_STR);
        $stmt->bindParam(":numChasis", $datos->numChasis, PDO::PARAM_STR);
        $stmt->bindParam(":numMotor", $datos->numMotor, PDO::PARAM_STR);
        $stmt->bindParam(":ano", $datos->ano, PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos->estado, PDO::PARAM_STR);
       

		if($stmt->execute()){

			return "1";

		}else{

			return "2";
		
		}
    }

    }

    /*=============================================
	LLAMAR A UN DATO MÓVIL
	=============================================*/
    static public function oneDatosMovilMDL($id){

        $sql = Conexion::conectar()->prepare("SELECT
        modelo_marca.id,
        modelo_marca.idTipoMovil,
        (SELECT nomTipoMovil FROM tipo_movil WHERE id = idTipoMovil) as nomTipoMovil,
        modelo_marca.nomMarca,
        modelo_marca.nomModelo,
        modelo_marca.numChasis,
        modelo_marca.numMotor,
        modelo_marca.numPatente,
        modelo_marca.numCarro,
        modelo_marca.ano,
        modelo_marca.estado AS estadoID,
        (SELECT nomEstado FROM estado_datos WHERE id = estado) as estado
        FROM
        modelo_marca WHERE modelo_marca.id = $id");

        $sql ->execute();

        return $sql -> fetch();
 
    }

    /*=============================================
	LLAMAR A TODOS LOS DATOS
	=============================================*/
    static public function AllDatosMovilMDL(){

        $sql = Conexion::conectar()->prepare("SELECT
        modelo_marca.id,
        modelo_marca.idTipoMovil,
        (SELECT nomTipoMovil FROM tipo_movil WHERE id = idTipoMovil) as nomTipoMovil,
        modelo_marca.nomMarca,
        modelo_marca.nomModelo,
        modelo_marca.numChasis,
        modelo_marca.numMotor,
        modelo_marca.numPatente,
        modelo_marca.numCarro,
        modelo_marca.ano,
        modelo_marca.estado AS estadoID,
        (SELECT nomEstado FROM estado_datos WHERE id = estado) as estado
        FROM
        modelo_marca");

        $sql ->execute();

        return $sql -> fetchAll();

    }
    /*=============================================
	LLAMAR A UN DATO POR PATENTE
	=============================================*/
    static public function oneDatosGralRutMDL($tabla, $id){

        $sql = Conexion::conectar()->prepare("SELECT id, rutUsuario, numPatente FROM $tabla WHERE id = $id");

        $sql ->execute();

        return $sql -> fetchAll();
 
    }
    /*=============================================
	UPDATE DATOS GENERALES
	=============================================*/
    static public function updateUDatosMovilMDL($tabla, $datos){
        
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET numCarro=:numCarro, numPatente=:numPatente, idTipoMovil=:idTipoMovil, nomMarca=:nomMarca,
                                              nomModelo=:nomModelo, numChasis=:numChasis, numMotor=:numMotor,
                                              ano=:ano, estado=:estado  WHERE id=:id");
            
            $stmt->bindParam(":numCarro", $datos->numCarro, PDO::PARAM_STR);
            $stmt->bindParam(":numPatente", $datos->numPatente, PDO::PARAM_STR);
            $stmt->bindParam(":idTipoMovil", $datos->idTipoMovil, PDO::PARAM_STR);
            $stmt->bindParam(":nomMarca", $datos->nomMarca, PDO::PARAM_STR);
            $stmt->bindParam(":nomModelo", $datos->nomModelo, PDO::PARAM_STR);
            $stmt->bindParam(":numChasis", $datos->numChasis, PDO::PARAM_STR);
            $stmt->bindParam(":numMotor", $datos->numMotor, PDO::PARAM_STR);
            $stmt->bindParam(":ano", $datos->ano, PDO::PARAM_STR);
            $stmt->bindParam(":estado", $datos->estado, PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos->id, PDO::PARAM_STR);

		if($stmt->execute()){

			return "1";

		}else{

			return "2";
		
		}
		
    }

    /*=============================================
	DELETE DATOS GENERALES
	=============================================*/
    static public function deleteDatosMDL($tabla, $id){
        
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_STR);

		if($stmt->execute()){

			return "1";

		}else{

			return "2";
		
		}

		
		
    }

}