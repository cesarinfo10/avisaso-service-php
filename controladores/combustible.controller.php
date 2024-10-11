<?php

class ControladorCombustible{
	/*=============================================
	INSERTAR COMBUSTIBLE
	=============================================*/
    static public function newCombCRL($datos){

        $tabla="detalle_combustible";

        $respuesta = ModelCombustible::newCombMDL($tabla, $datos);
    
        echo $respuesta;

        
    }

    /*=============================================
	CONSULTAR ID DE REPORTE PARA FOTO
	=============================================*/
    static public function consultaComFotoCTR($rut){

        header('Content-type:application/json');
        $tabla = "detalle_combustible";

        $respuesta = ModelCombustible::consultaComFotoMDL($tabla, $rut);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }

    /*=============================================
	INSERTAR FOTO DETALLES DE COMBUSTIBLE
	=============================================*/
    static public function combustibleFotoCTR($datos){

        $tabla="foto_combustible";

        $respuesta = ModelCombustible::combustibleFotoMDL($tabla, $datos);
    
        echo $respuesta;

        
    }
    /*=============================================
	LLAMAR A USUARIO POR COMBUSTIBLE
	=============================================*/
    static public function oneCombustibleCTR($usser){

        header('Content-type:application/json');
        
        $tablaCliente = "usuarios";
        $tabla = "detalle_combustible";
        $tablaFoto = "foto_combustible";

        $respuesta = ModelCombustible::oneCombustibleMDL($tablaCliente, $tabla, $tablaFoto, $usser);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }

    /*=============================================
	LLAMAR A UN COMBUSTIBLE
	=============================================*/
    static public function oneAlbumCombustibleCTR($idReporte){

        header('Content-type:application/json');
        
        $tablaCliente = "usuarios";
        $tabla = "detalle_combustible";
        $tablaFoto = "foto_combustible";

        $respuesta = ModelCombustible::oneSolucionMDL($idReporte, $tablaCliente, $tabla, $tablaFoto);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
   
    /*=============================================
	CONSULTA ALBUM  DE COMBUSTIBLE POR USUARIO
	=============================================*/
    static public function oneCombustibleFotoCTR($idReporte){

        header('Content-type:application/json');

        $tablaFoto = "foto_combustible";

        $respuesta = ModelCombustible::oneSolucionFotodMDL($idReporte, $tablaFoto);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
}