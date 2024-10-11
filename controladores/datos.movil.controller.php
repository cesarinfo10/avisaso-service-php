<?php

class ControladorDatosMovil{
	/*=============================================
	INSERTAR DATOS GENERALES
	=============================================*/
    static public function newDatosMovilCRL($datos){

        $tabla="modelo_marca";

        $respuesta = ModelDatosMovil::newDatosMovilMDL($tabla, $datos);
    
        echo $respuesta;

        
    }

    /*=============================================
	LLAMAR A UN DATO MÓVIL
	=============================================*/
    static public function oneDatosMovilCTR($id){

        header('Content-type:application/json');
        
        $respuesta = ModelDatosMovil::oneDatosMovilMDL($id);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }

    /*=============================================
	LLAMAR TODOS LOS DATOS
	=============================================*/
    static public function AllDatosMovilCTR(){

        header('Content-type:application/json');
        
        $respuesta = ModelDatosMovil::AllDatosMovilMDL();
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
   	/*=============================================
	UPDATE DATOS GENERALES
	=============================================*/
    static public function updateDatosCTR($datos){

        $tabla="modelo_marca";

        $respuesta = ModelDatosMovil::updateUDatosMovilMDL($tabla, $datos);
    
        echo $respuesta;

        
    }
    /*=============================================
	ELIMINAR DATO
	=============================================*/
    static public function deleteDatosCTR($id){

        header('Content-type:application/json');
        
        $tabla = "modelo_marca";

        $respuesta = ModelDatosMovil::deleteDatosMDL($tabla, $id);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }

}