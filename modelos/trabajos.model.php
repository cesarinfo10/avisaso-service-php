<?php

require_once "conexion.php";

class ModelTrabajos{

/*=============================================
INSERTAR TRABAJO
=============================================*/
static public function addTrabajosMDL($tabla, $datos){

    $conexion = Conexion::conectar();
    $stmt = $conexion->prepare("INSERT INTO $tabla(dni_usuario, titulo, descripcion, estado) VALUES (:dni_usuario, :titulo, :descripcion, :estado)");

    $stmt->bindParam(":dni_usuario", $datos->dni_usuario, PDO::PARAM_STR);
    $stmt->bindParam(":titulo", $datos->titulo, PDO::PARAM_STR);
    $stmt->bindParam(":descripcion", $datos->descripcion, PDO::PARAM_STR);
    $stmt->bindParam(":estado", $datos->estado, PDO::PARAM_STR);

    if($stmt->execute()){
        $lastInsertId = $conexion->lastInsertId();
        return $lastInsertId;
    }else{
        return "error";
    }
}
/*=============================================
INSERTAR FOTOS
=============================================*/
static public function addFotosTrabajosMDL($tabla, $datos){

    $conexion = Conexion::conectar();
    $stmt = $conexion->prepare("INSERT INTO $tabla(id_trabajo, foto, rotacion, estado) VALUES (:id_trabajo, :foto, :rotacion, :estado)");

    $stmt->bindParam(":id_trabajo", $datos->id_trabajo, PDO::PARAM_STR);
    $stmt->bindParam(":foto", $datos->foto, PDO::PARAM_STR);
      $stmt->bindParam(":rotacion", $datos->rotacion, PDO::PARAM_STR);
    $stmt->bindParam(":estado", $datos->estado, PDO::PARAM_STR);


    if($stmt->execute()){
        $lastInsertId = $conexion->lastInsertId();
        return $lastInsertId;
    }else{
        return "error";
    }
}

    /*=============================================
	UPDATE DATOS GENERALES
	=============================================*/
    static public function updateFotoMDL($tabla, $datos){
        date_default_timezone_set("America/Santiago");
        $fecha = date("Y-m-d");
        
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_trabajo=:id_trabajo, foto=:foto, rotacion=:rotacion,
                                              estado=:estado  WHERE id=:id");

            $stmt->bindParam(":id_trabajo", $datos->id_trabajo, PDO::PARAM_STR);
            $stmt->bindParam(":foto", $datos->foto, PDO::PARAM_STR);
            $stmt->bindParam(":rotacion", $datos->rotacion, PDO::PARAM_STR);
            $stmt->bindParam(":estado", $datos->estado, PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos->id, PDO::PARAM_STR);

		if($stmt->execute()){

			return "1";

		}else{

			return "2";
		
		}
		
    }

    /*=============================================
	DELETE FOTOS
	=============================================*/
    static public function deleteFotosMDL($tabla, $id){
        
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_STR);

		if($stmt->execute()){

			return "1";

		}else{

			return "2";
		
		}	
		
    }
    /*=============================================
		CONSULTA SERVICIOS DEL USUARIO 
	=============================================*/
    static public function consultaOneUserSerMDL($dni){
        $conexion = Conexion::conectar();

        // Consulta para obtener los datos de mis_trabajo
        $sql = $conexion->prepare("SELECT id, dni_usuario, titulo, descripcion, estado FROM mis_trabajo WHERE dni_usuario = :dni AND estado = 1");
        $sql->bindParam(":dni", $dni, PDO::PARAM_STR);
        $sql->execute();
        $trabajos = $sql->fetchAll(PDO::FETCH_ASSOC);
    
        // Consulta para obtener las fotos de la tabla album
        $fotos = [];
        foreach ($trabajos as $trabajo) {
            if ($trabajo['id'] != null) {
                $id_trabajo = $trabajo['id'];
                $sqlFotos = $conexion->prepare("SELECT id_trabajo, foto, rotacion, estado FROM album WHERE id_trabajo = :id_trabajo");
                $sqlFotos->bindParam(":id_trabajo", $id_trabajo, PDO::PARAM_STR);
                $sqlFotos->execute();
                $fotos = array_merge($fotos, $sqlFotos->fetchAll(PDO::FETCH_ASSOC));
            }
        }
    
        return ['trabajos' => $trabajos, 'fotos' => $fotos];
     }


    /*=============================================
	DELETE FOTOS
	=============================================*/
    static public function deleteFotosJOBMDL($id){
        
        $conexion = Conexion::conectar();

        try {
            // Iniciar una transacción
            $conexion->beginTransaction();
    
            // Eliminar las fotos de la tabla album
            $stmtFotos = $conexion->prepare("DELETE FROM album WHERE id_trabajo = :id_trabajo");
            $stmtFotos->bindParam(":id_trabajo", $id, PDO::PARAM_STR);
            $stmtFotos->execute();
    
            // Eliminar el trabajo de la tabla mis_trabajo
            $stmtTrabajo = $conexion->prepare("DELETE FROM mis_trabajo WHERE id = :id");
            $stmtTrabajo->bindParam(":id", $id, PDO::PARAM_STR);
            $stmtTrabajo->execute();
    
            // Confirmar la transacción
            $conexion->commit();
    
            return "1";
        } catch (PDOException $e) {
            // Revertir la transacción en caso de error
            $conexion->rollBack();
            return "error: " . $e->getMessage();
        }	
		
    }
}