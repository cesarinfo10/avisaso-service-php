<?php

class ControladorDatos{
	/*=============================================
	INSERTAR DATOS GENERALES
	=============================================*/
    static public function newDatosGraCRL($datos){

        $tabla="datos_generales";

        $respuesta = ModelDatos::newDatosGralMDL($tabla, $datos);
    
        echo $respuesta;

        
    }

    /*=============================================
	LLAMAR A UN DATO
	=============================================*/
    static public function oneDatosGralCTR($id){

        header('Content-type:application/json');
        
        $respuesta = ModelDatos::oneDatosGralMDL($id);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }

    /*=============================================
	LLAMAR TODOS LOS DATOS
	=============================================*/
    static public function AllDatosCTR(){

        header('Content-type:application/json');
        
        $respuesta = ModelDatos::AllDatosMDL();
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
   	/*=============================================
	UPDATE DATOS GENERALES
	=============================================*/
    static public function updateDatosCTR($datos){

        $tabla="datos_generales";

        $respuesta = ModelDatos::updateUDatosGralMDL($tabla, $datos);
    
        echo $respuesta;

        
    }
    /*=============================================
	LLAMAR A UN DATO
	=============================================*/
    static public function deleteDatosCTR($id){

        header('Content-type:application/json');
        
        $tabla = "datos_generales";

        $respuesta = ModelDatos::deleteDatosMDL($tabla, $id);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }

    /*=============================================
	LLAMAR TODOS LOS DATOS MÓVIL
	=============================================*/
    static public function AllDatosMovilCTR(){

        header('Content-type:application/json');
        
        $respuesta = ModelDatos::AllDatosMovilMDL();
    
        $array=json_encode($respuesta);
        
        echo $array;
    }

    static public function DatosMovilIDCTR($id){

        header('Content-type:application/json');
        
        $respuesta = ModelDatos::datosMovilIDMDL($id);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
}