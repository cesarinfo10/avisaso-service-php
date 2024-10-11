<?php

class ControladorTipo{
    /*=============================================
	LLAMAR A TODOS LOS TIPO USUARIO
	=============================================*/
    static public function allTipoUserCTR(){

        header('Content-type:application/json');
        
        $tabla = "tipos_usuarios";

        $respuesta = ModelTipo::allUserTipoMDL($tabla);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
}