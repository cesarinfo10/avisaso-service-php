<?php

class ControladorRondas{

    
    /*=============================================
	LLAMAR A TODAS LAS RODAS
	=============================================*/
    static public function consultaPuntosCTR($usuario, $fecha){

        header('Content-type:application/json');

        $rSolicitud = "rondas_solicitud";

        $rRutas = "rondas_rutas";

        $respuesta = ModelRondas::consultaPuntosMDL($usuario, $fecha, $rSolicitud, $rRutas);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }

    /*=============================================
	MARCAR PUNTOS
	=============================================*/
    static public function MarcarPuntosCTR($punto, $fecha, $hora, $usuario){

        $rRutas = "rondas_rutas";

        $respuesta = ModelRondas::MarcarPuntosMDL($punto, $fecha, $usuario, $rRutas);
        if ($respuesta['RANGO_MARCA_TERMINO'] == NULL){
            echo 3;
        } else{
            if ($hora > $respuesta['RANGO_MARCA_TERMINO']){
                //fuera de tiempo  
                $respuesta = ModelRondas::updateMarcarPuntosMDL($usuario, $rRutas, 0, $respuesta['ID']);
                echo $respuesta;
            }elseif($hora == $respuesta['RANGO_MARCA_TERMINO']){
                //ronda marcada a tiempo
                $respuesta = ModelRondas::updateMarcarPuntosMDL($usuario, $rRutas, 1, $respuesta['ID']);
                echo $respuesta;
            }else{
                //antes de  tiempo
                $respuesta = ModelRondas::updateMarcarPuntosMDL($usuario, $rRutas,1, $respuesta['ID']);
                echo $respuesta;
            }
        }
    }
    /*=============================================
	LLAMAR A TODAS LAS RODAS HECHAS
	=============================================*/
    static public function consultaPuntosHechosCTR($usuario, $fecha){

        header('Content-type:application/json');

        $rRutas = "rondas_rutas";

        $respuesta = ModelRondas::consultaPuntosHechosMDL($usuario, $fecha, $rRutas);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
}