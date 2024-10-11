<?php

require_once "../controladores/per_circulacion.controller.php";

require_once "../modelos/per_circulacion.model.php";

// URL http://localhost/omr/omrservice/servicios/per_circulacion.php?addDatosPerCir
/*=============================================
INSERTAR PERMISO DE CIRCULACIÓN
=============================================*/
if (isset($_GET['addDatosPerCir'])){    

header('Content-type: application/json');
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$datos = ($request);
//$datos = json_encode($request);
 $addPerCir= new ControladorPerCirculacion();
 $addPerCir->newPerCircCRL($datos);
    
}

/*=============================================
CONSULTA PERMISO DE CIRCULACIÓN POR ID
=============================================*/
// URL http://localhost/omr/omrservice/servicios/per_circulacion.php?id=1&getOnePerCir
if (isset($_GET['getOnePerCir'])){

    $id= $_GET['id'];

    $onePerCir= new ControladorPerCirculacion();
    $onePerCir->oneDatosPerCircCTR($id);
    }
/*=============================================
LLAMAR TODOS LOS PERMISO DE CIRCULACIÓN
=============================================*/
// URL http://localhost/omr/omrservice/servicios/per_circulacion.php?getAllPerCir
if (isset($_GET['getAllPerCir'])){

    $onePerCir= new ControladorPerCirculacion();
    $onePerCir->AllPerCircnicaCTR();
    }

/*=============================================
UPADATE PERMISO DE CIRCULACIÓN
=============================================*/
// URL http://localhost/omr/omrservice/servicios/per_circulacion.php?updatePerCir
if (isset($_GET['updatePerCir'])){
    
    header('Content-type: application/json');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $datos = ($request);

    $updatePerCir= new ControladorPerCirculacion();
    $updatePerCir->updatePerCircCTR($datos);       
}

/*=============================================
DELETE PERMISO DE CIRCULACIÓN
=============================================*/
// URL http://localhost/omr/omrservice/servicios/per_circulacion.php?id=1&deletePerCir
if (isset($_GET['deletePerCir'])){

    $id= $_GET['id'];
    
    $onePerCirDelete= new ControladorPerCirculacion();
    $onePerCirDelete->deletePerCircTR($id);
    }

    header("Access-Control-Allow-Origin: *");
    ob_end_flush();