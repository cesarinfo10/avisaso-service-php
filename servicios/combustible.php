<?php

require_once "../controladores/combustible.controller.php";

require_once "../modelos/combustible.model.php";

//URL http://localhost/omrservice/servicios/combustible.php?addCombustible
/*=============================================
NUEVO USUARIO
=============================================*/
if (isset($_GET['addCombustible'])){
    

header('Content-type: application/json');
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$datos = ($request);
//$datos = json_encode($request);


 $addCombustible= new ControladorCombustible();
 $addCombustible->newCombCRL($datos);
    
}

/*=============================================
CONSULTA ID DE REPORTE PARA FOTO
=============================================*/
if (isset($_GET['consultaComFoto'])){
    
    $rut= $_GET['rut'];
    $allcom= new ControladorCombustible();
    $allcom->consultaComFotoCTR($rut);
        
    }

/*=============================================
NUEVA FOTO DETALLE DE REPORTE
=============================================*/
if (isset($_GET['addFotoCombustible'])){
    
    header('Content-type: application/json');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $datos = ($request);

     $newAddFoto= new ControladorCombustible();
     $newAddFoto->combustibleFotoCTR($datos);
        
    }

/*=============================================
LLAMAR A USUARIO POR COMBUSTIBLE
=============================================*/
if (isset($_GET['getAllCombustible'])){
    $usser = $_GET['usser'];
    $allOneCombustible= new ControladorCombustible();
    $allOneCombustible->oneCombustibleCTR($usser);
    
    }

/*=============================================
LLAMAR A UN COMBUSTIBLE
=============================================*/
if (isset($_GET['getOneCombustible'])){

    $idReporte= $_GET['idReporte'];

    $oneCombustible= new ControladorCombustible();
    $oneCombustible->oneAlbumCombustibleCTR($idReporte);
    
    }

/*=============================================
LLAMAR A TODAS LAS FOTOS DE COMBUSTIBLE POR USUARIO
=============================================*/
if (isset($_GET['getOneCombustibleFotos'])){
    $idReporte= $_GET['idReporte'];

    $fotoCombustible= new ControladorCombustible();
    $fotoCombustible->oneCombustibleFotoCTR($idReporte);
    
    }

header("Access-Control-Allow-Origin: *");
ob_end_flush();