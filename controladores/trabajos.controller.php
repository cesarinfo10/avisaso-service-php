<?php

class ControladorTrabajos{

    /*=============================================
	UPDATE REPORTE DESDE LA WEB
	=============================================*/
    static public function addTrabajosCTR($datos){

        $tabla="mis_trabajo";

        $respuesta = ModelTrabajos::addTrabajosMDL($tabla, $datos);
    
        echo $respuesta;

        
    }

    /*=============================================
	ADD FOTO
	=============================================*/
    static public function addFotosTrabajosCTR($datos){

        $tabla="album";

        $respuesta = ModelTrabajos::addFotosTrabajosMDL($tabla, $datos);
    
        echo $respuesta;

        
    }

    /*=============================================
	UPDATE FOTO
	=============================================*/
    static public function editFotosTrabajosCTR($datos){

        $tabla="album";

        $respuesta = ModelTrabajos::updateFotoMDL($tabla, $datos);
    
        echo $respuesta;

        
    }
    /*=============================================
	DELETE FOTOS
	=============================================*/
    static public function deleteFotosCTR($id){

        header('Content-type:application/json');
        
        $tabla = "album";

        $respuesta = ModelTrabajos::deleteFotosMDL($tabla, $id);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }

    /*=============================================
	CONSULTAR TRABAJOS Y FOTOS POR USUARIO
	=============================================*/
    static public function consultaFotosTrabajosCTR($dni){

        header('Content-type:application/json');

        $respuesta = ModelTrabajos::consultaOneUserSerMDL($dni);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }

    /*=============================================
	DELETE FOTOS JOB
	=============================================*/
    static public function deleteFotosJobCTR($id){

        header('Content-type:application/json');

        $respuesta = ModelTrabajos::deleteFotosJOBMDL( $id);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
}