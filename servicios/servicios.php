<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once "../controladores/servicios.controller.php";

require_once "../modelos/servicios.model.php";



if (isset( $_GET['idReporte'])){

    $idReporte= $_GET['idReporte'];
    
    }

    if (isset( $_GET['idSolucion'])){

        $idSolucion= $_GET['idSolucion'];
        
    }



/*=============================================
AGEGAR LICITACIÓN DEL USUARIO
=============================================*/
//URL http://localhost/avisaso-service/servicios/servicios.php?addServicio
    if (isset($_GET['addServicio'])){
    
        header('Content-type: application/json');
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $datos = ($request);
    
        $updateReporte= new ControladorServicios();
        $updateReporte->addServicioCTR($datos);       
    }

//URL http://localhost/avisaso-service/servicios/servicios.php?dni_usuario_licita=1-9&todosServicios
/*=============================================
LLAMAR A TODAS LAS LICITAIONES POR  SERVICIO
=============================================*/
if (isset($_GET['todosServicios'])){
    $dni_usuario_licita = $_GET['dni_usuario_licita'];
    $allLicitaciones= new ControladorServicios();
    $allLicitaciones->allLicitaionesCTR($dni_usuario_licita);
    
    }

//URL http://localhost/avisaso-service/servicios/servicios.php?id=1-9&detalleLicitacionesUser
/*=============================================
LLAMAR A TODAS LAS LICITAIONES POR  SERVICIO
=============================================*/
if (isset($_GET['detalleLicitacionesUser'])){
    $id_licitacion = $_GET['id'];
    $allLicitaciones= new ControladorServicios();
    $allLicitaciones->detalleLicitacionesUserCTR($id_licitacion); 
    }



    
/*=============================================
LLAMAR A TODAS LAS LICITAIONES POR  SERVICIO
=============================================*/
if (isset($_GET['todosServiciosPorNom'])){
    $dni = $_GET['dni'];
    $allLicitaciones= new ControladorServicios();
    $allLicitaciones->allLicitaionesNomCTR($dni);
    
    }

/*=============================================
CAMBIAR ESTADO DEL SERVICIO
=============================================*/
    if (isset($_GET['estadosServicio'])){
    
        header('Content-type: application/json');
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $datos = ($request);
    
        $estadosServicio= new ControladorServicios();
        $estadosServicio->estadosServicioCTR($datos);       
    }
/*=============================================
CAMBIAR ESTADO DEL SERVICIO
=============================================*/
if (isset($_GET['respuestaJOB'])){
    
    header('Content-type: application/json');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $datos = ($request);

    $respuestaJOB= new ControladorServicios();
    $respuestaJOB->respuestaJOBCTR($datos);       
}
/*================================================================================================================*/
/*================================================================================================================*/

//URL http://localhost/appcondominio/servicios/servicios.php?dni_usuario_licita=1-9&todosSinSolucionServicios
/*=============================================
LLAMAR A TODOS LOS REPORTES POR USUARIO
=============================================*/
if (isset($_GET['todosSinSolucionServicios'])){
    $dni_usuario_licita = $_GET['dni_usuario_licita'];
    $alltipouser= new ControladorServicios();
    $alltipouser->allSinSolucionServiciosCTR($dni_usuario_licita);
    }

//URL http://localhost/appcondominio/servicios/servicios.php?idReporte=7&getAllServicios
/*=============================================
LLAMAR A UN REPORTE POR ID
=============================================*/
if (isset($_GET['getOneServicios'])){

    $alltipouser= new ControladorServicios();
    $alltipouser->oneServiciosCTR($idReporte);
    
    }

//URL http://localhost/appcondominio/servicios/servicios.php?idReporte=7&getOneSolucion
/*=============================================
LLAMAR A UNA SOLUCION
=============================================*/
if (isset($_GET['getOneSolucion'])){

    $alltipouser= new ControladorServicios();
    $alltipouser->oneSolucionCTR($idReporte);
    
    }

//URL http://localhost/appcondominio/servicios/servicios.php?idReporte=7&getOneServiciosFotos
/*=============================================
LLAMAR A TODAS LAS FOTOS DE REPORTE POR USUARIO
=============================================*/
if (isset($_GET['getOneServiciosFotos'])){

    $alltipouser= new ControladorServicios();
    $alltipouser->oneServiciosFotoCTR($idReporte);
    
    }
//URL http://localhost/appcondominio/servicios/servicios.php?idSolucion=7&getOneSolucionFotos
/*=============================================
LLAMAR A TODAS LAS FOTOS DE REPORTE POR USUARIO
=============================================*/
if (isset($_GET['getOneSolucionFotos'])){

    $fotosolucion= new ControladorServicios();
    $fotosolucion->oneSolucionFotoCTR($idSolucion);
    
    }

//URL http://localhost/appcondominio/servicios/servicios.php?user=1-9&getAllSolucion
/*=============================================
LLAMAR A UN REPORTE
=============================================*/
if (isset($_GET['getAllSolucion'])){
    $user = $_GET['user'];
    $alltipouser= new ControladorServicios();
    $alltipouser->allSolucionCTR($user);
    
    }

//URL http://localhost/omr/omrservice/servicios//servicios.php?getAllEstadoD
/*=============================================
LLAMAR TODOS LOS ESTADOS DATOS
=============================================*/
if (isset($_GET['getAllEstadoD'])){

    $alltipouser= new ControladorServicios();
    $alltipouser->allallEstadoDatoCTR();
    
}
/*=============================================
LLAMAR TODOS LOS TIPOS DATOS
=============================================*/
if (isset($_GET['getAllTipoD'])){

    $alltipouser= new ControladorServicios();
    $alltipouser->allallTipoDatoCTR();
    
}
/*=============================================
LLAMAR TODOS LOS MODELO MARCA DATOS
=============================================*/
if (isset($_GET['getAllMMD'])){

    $alltipouser= new ControladorServicios();
    $alltipouser->allaMMDCTR();

}

/*=============================================
UPDATE REPORTE DESDE LA WEB
=============================================*/
//URL http://localhost/omr/omrservice/servicios//servicios.php?updateReporte
if (isset($_GET['updateReporte'])){
    
    header('Content-type: application/json');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $datos = ($request);

    $updateReporte= new ControladorServicios();
    $updateReporte->updateReporteCTR($datos);       
}
 //URL http://localhost/omrservice/servicios/servicios.php?addDoc
/*=============================================
NUEVo DOCUMENTO DETALLE DE REPORTE
=============================================*/
if (isset($_GET['addDoc'])){
    
    header('Content-type: application/json');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $datos = ($request);

     $newuser= new ControladorServicios();
     $newuser->docPDFCTR($datos);
        
    }
/*=============================================
LLAMAR TODOS LOS MODELO MARCA DATOS
=============================================*/
//URL http://localhost/omrservice/servicios/servicios.php?getAllMMD
if (isset($_GET['getAllDOC'])){

    $doc= new ControladorServicios();
    $doc->allDocCTR();

}

//URL http://localhost/appcondominio/servicios/servicios.php?id=7&getOneDocument
/*=============================================
LLAMAR A TODAS LAS FOTOS DE REPORTE POR USUARIO
=============================================*/
if (isset($_GET['getOneDocument'])){
    $id = $_GET['id'];
    $doc= new ControladorServicios();
    $doc->oneDocument($id);
    
    }