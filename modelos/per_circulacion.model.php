<?php

require_once "conexion.php";

class ModelPerCirculacion{

    /*=============================================
	INSERTAR DATOS REVICIÓN TÉCNICA
	=============================================*/
    static public function newPerCircMDL($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("SELECT* FROM $tabla WHERE id_numPatente = :id_numPatente");
    
        $stmt->bindParam(":id_numPatente",$datos->id_numPatente, PDO::PARAM_STR);
        $stmt-> execute();
        $stmt = $stmt->fetchColumn();
    
        if ($stmt!=null){
            return "2";
        }else{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla
        (id_numPatente, fchDesde, fchHasta, observaciones, lugarEmitido, quienEmite, selloVerde, estado)
         VALUES (:id_numPatente, :fchDesde, :fchHasta, :observaciones, :lugarEmitido, :quienEmite, :selloVerde, :estado)");

        $stmt->bindParam(":id_numPatente", $datos->id_numPatente, PDO::PARAM_STR);
        $stmt->bindParam(":fchDesde", $datos->fchDesde, PDO::PARAM_STR);
        $stmt->bindParam(":fchHasta", $datos->fchHasta, PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos->observaciones, PDO::PARAM_STR);
        $stmt->bindParam(":lugarEmitido", $datos->lugarEmitido, PDO::PARAM_STR);
        $stmt->bindParam(":quienEmite", $datos->quienEmite, PDO::PARAM_STR);
        $stmt->bindParam(":selloVerde", $datos->selloVerde, PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos->estado, PDO::PARAM_STR);
       

		if($stmt->execute()){

			return "1";

		}else{

			return "2";
		
		}

    }
    }

    /*=============================================
	CONSULTA DE REV TECNICA POR ID
	=============================================*/
    static public function onePerCirclMDL($tabla, $tablaDatosGral, $id){

        $sql = Conexion::conectar()->prepare("SELECT id, 
        (SELECT id FROM $tablaDatosGral WHERE id = id_numPatente LIMIT 1) AS 'numPatente', 
        fchDesde, fchHasta, observaciones, lugarEmitido, quienEmite, selloVerde, estado
        FROM $tabla WHERE id = $id");

        $sql ->execute();

        return $sql -> fetchAll();
 
    }

    /*=============================================
	LLAMAR A TODOS LOS  REVICIÓN TÉCNICA
	=============================================*/
    static public function AllPerCircnicaMDL($modelo_marca, $tabla){

        $sql = Conexion::conectar()->prepare("SELECT id, id_numPatente,
        (SELECT numPatente FROM $modelo_marca WHERE id = id_numPatente LIMIT 1) AS 'numPatente',
        fchDesde, fchHasta, observaciones, lugarEmitido, quienEmite, selloVerde, estado
        FROM $tabla");

        $sql ->execute();

        return $sql -> fetchAll();

    }

    /*=============================================
	UPDATE REV TECNICA
	=============================================*/
    static public function updatePerCircMDL($tabla, $datos){
        date_default_timezone_set("America/Santiago");
        $fecha = date("Y-m-d");
        
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_numPatente=:id_numPatente, fchDesde=:fchDesde, fchHasta=:fchHasta, 
                                               observaciones=:observaciones, lugarEmitido=:lugarEmitido, quienEmite=:quienEmite,
                                               selloVerde=:selloVerde, estado=:estado WHERE id=:id");

            $stmt->bindParam(":id_numPatente", $datos->id_numPatente, PDO::PARAM_STR);
            $stmt->bindParam(":fchDesde", $datos->fchDesde, PDO::PARAM_STR);
            $stmt->bindParam(":fchHasta", $datos->fchHasta, PDO::PARAM_STR);
            $stmt->bindParam(":observaciones", $datos->observaciones, PDO::PARAM_STR);
            $stmt->bindParam(":lugarEmitido", $datos->lugarEmitido, PDO::PARAM_STR);
            $stmt->bindParam(":quienEmite", $datos->quienEmite, PDO::PARAM_STR);
            $stmt->bindParam(":selloVerde", $datos->selloVerde, PDO::PARAM_STR);
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
    static public function deletePerCircMDL($tabla, $id){
        
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_STR);

		if($stmt->execute()){

			return "1";

		}else{

			return "2";
		
		}

		
		
    }
}