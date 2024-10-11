<?php

require_once "../controladores/rev_tecnica.controller.php";

require_once "../modelos/rev_tecnica.model.php";

// URL http://localhost/omr/omrservice/servicios/rev_tecnica.php?addDatosRevTec
/*=============================================
INSERTAR REV TECNICA
=============================================*/
if (isset($_GET['addDatosRevTec'])){    

header('Content-type: application/json');
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$datos = ($request);
//$datos = json_encode($request);
 $addRevTec= new ControladorRevTecnica();
 $addRevTec->newRevTecCRL($datos);
    
}

/*=============================================
CONSULTA DE REV TECNICA POR ID
=============================================*/
// URL http://localhost/omr/omrservice/servicios/rev_tecnica.php?id=1&getOneRevTec
if (isset($_GET['getOneRevTec'])){

    $id= $_GET['id'];

    $oneRevTec= new ControladorRevTecnica();
    $oneRevTec->oneDatosRevTecCTR($id);
    }
/*=============================================
LLAMAR TODOS LOS DATOS
=============================================*/
// URL http://localhost/omr/omrservice/servicios/rev_tecnica.php?getAllrevTec
if (isset($_GET['getAllrevTec'])){

    $oneRevTec= new ControladorRevTecnica();
    $oneRevTec->AllRevTecnicaCTR();
    }

/*=============================================
UPADATE REV TECNICA
=============================================*/
// URL http://localhost/omr/omrservice/servicios/rev_tecnica.php?updateRevTec
if (isset($_GET['updateRevTec'])){
    
    header('Content-type: application/json');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $datos = ($request);

    $updateRevTec= new ControladorRevTecnica();
    $updateRevTec->updateRevTecCTR($datos);       
}

/*=============================================
DELETE UN DATOS
=============================================*/
// URL http://localhost/omr/omrservice/servicios/rev_tecnica.php?id=1&deleteRevTec
if (isset($_GET['deleteRevTec'])){

    $id= $_GET['id'];

    $oneRevTecDelete= new ControladorRevTecnica();
    $oneRevTecDelete->deleteRevTecTR($id);
    }

    header("Access-Control-Allow-Origin: *");
    ob_end_flush();