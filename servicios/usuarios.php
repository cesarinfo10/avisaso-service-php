<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once "../controladores/usuario.controller.php";

require_once "../modelos/usuario.model.php";

if (isset( $_GET['usser'])){

$usuario= $_GET['usser'];

}

if(isset($_GET['pass'])){

$pass= $_GET['pass'];

}

if(isset($_GET['ID'])){

    $id= $_GET['ID'];
    
}

if(isset($_GET['rut'])){

    $rut= $_GET['rut'];
    
}
if(isset($_GET['userId'])){

    $userId= $_GET['userId'];
    
}
//URL http://localhost/avisaso-service/servicios/usuarios.php?dni=1-9&pass=1234&session
/*=============================================
INICIAR SESIÓN
=============================================*/
if (isset($_GET['session'])){

$dni= $_GET['dni'];
$pass= $_GET['pass'];

$sesion= new ControladorPlantilla();
$sesion->iniciarSesion($dni, $pass);

}

//URL http://localhost/avisaso-service/servicios/usuarios.php?newuser
/*=============================================
NUEVO USUARIO
=============================================*/
if (isset($_GET['newUser'])){
    
    header('Content-type: application/json');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $datos = ($request);
    //$datos = json_encode($request);
    //echo $datos;
    $newuser= new ControladorPlantilla();
    $newuser->newUser($datos);
}

//URL http://localhost/avisaso-service/servicios/usuarios.php?upadateUser
/*=============================================
UPADATE USUARIO POS SESION
=============================================*/
if (isset($_GET['upadateUser'])){
    
    header('Content-type: application/json');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $datos = ($request);
    //$datos = json_encode($request);
    
    //echo $datos;
     $updateUser= new ControladorPlantilla();
     $updateUser->updateUsePosSesionCTR($datos);
        
    }

//URL http://localhost/avisaso-service/servicios/usuarios.php?user=92767291&consultaUser
/*=============================================
CONSULTA USUARIO (LLAMAR SESIÓN)
=============================================*/
if (isset($_GET['consultaUser'])){
    $dni = $_GET['dni'];
    $alluser= new ControladorPlantilla();
    $alluser->consultaUserCTR($dni);
        
    }

 //URL http://localhost/avisaso-service/servicios/usuarios.php?newuserProf
/*=============================================
NUEVA PROFESIÓN
=============================================*/
if (isset($_GET['newUserProf'])){
    
    header('Content-type: application/json');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $datos = ($request);
    //$datos = json_encode($request);
    //echo $datos;
    $newuser= new ControladorPlantilla();
    $newuser->newUserProf($datos);
}

//URL http://localhost/avisaso-service/servicios/usuarios.php?user=92767291&consultaUserSer
/*=============================================
CONSULTA SERVICIOS DEL USUARIO 
=============================================*/
if (isset($_GET['consultaUserSer'])){
    $dni = $_GET['dni'];
    $alluser= new ControladorPlantilla();
    $alluser->consultaUserSerCTR($dni);
        
    }
//URL http://localhost/avisaso-service/servicios/usuarios.php?user=92767291&consultaUserSerOne
/*=============================================
CONSULTA SERVICIOS DEL USUARIO 
=============================================*/
if (isset($_GET['consultaUserSerOne'])){
    $id = $_GET['idService'];
    $alluser= new ControladorPlantilla();
    $alluser->consultaUserSerOneCTR($id);
        
    }

//URL http://localhost/avisaso-service/servicios/usuarios.php?user=92767291&busquedaUserSerOne
/*=============================================
BUSQUEDA SERVICIOS DEL USUARIO 
=============================================*/
if (isset($_GET['busquedaUserSerOne'])){
    $nomServicio = $_GET['nomServicio'];
    $alluser= new ControladorPlantilla();
    $alluser->busquedaOneUserSerMDL($nomServicio);
        
    }

//URL http://localhost/avisaso-service/servicios/usuarios.php?user=92767291&busquedaUserSer
   /*=============================================
	BUSQUEDA SERVICIOS DEL USUARIO PARA LICITAR
	=============================================*/
if (isset($_GET['busquedaUserSer'])){
    $alluser= new ControladorPlantilla();
    $alluser->busquedaOneUserSer();
        
    }
/*================================================================================================================*/
/*================================================================================================================*/



//URL http://localhost/omrservice/servicios/usuarios.php?ID=1&consultaUserEdit
/*=============================================
CONSULTA USUARIO PARA LLENAR LOS CAMPOS
=============================================*/
if (isset($_GET['consultaUserEdit'])){
    $id = $_GET['ID'];
    $user= new ControladorPlantilla();
    $user->consultaUserEditCTR($id);
        
    }
//URL http://localhost/omrservice/servicios/usuarios.php?ID=1&consultaPredefinido
/*=============================================
CONSULTA USUARIO PARA LLENAR LOS CAMPOS
=============================================*/
if (isset($_GET['consultaPredefinido'])){
    
    $user= new ControladorPlantilla();
    $user->consultaPredefinidosCTR();
        
    }


//URL http://localhost/omr/omrservice/servicios/usuarios.php?getAllPre
/*=============================================
LLAMAR A TODOS LOS PREDEFINIDOS
=============================================*/
if (isset($_GET['getAllPre'])){

    $predefinido= new ControladorPlantilla();
    $predefinido->allPredCTR();
    
    }

//URL http://localhost/omrservice/servicios/usuarios.php?newuserpos
/*=============================================
NUEVO DETALLE DE REPORTE
=============================================*/
if (isset($_GET['nuevoReportepos'])){
    
    header('Content-type: application/json');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $datos = ($request);
    //$datos = json_encode($request);
    
    //echo $datos;
     $newuser= new ControladorPlantilla();
     $newuser->newUseReporte($datos);
        
    }

//URL http://localhost/omrservice/servicios/usuarios.php?rut=1-9&consultaUserReporte
/*=============================================
CONSULTA ID DE REPORTE PARA FOTO
=============================================*/
if (isset($_GET['consultaUserReporte'])){
    
    $alluser= new ControladorPlantilla();
    $alluser->consultaUserReportCTR($rut);
        
    }
//URL http://localhost/omrservice/servicios/usuarios.php?rut=1-9&consultaSolFoto
/*=============================================
CONSULTA ID DE REPORTE PARA FOTO
=============================================*/
if (isset($_GET['consultaSolFoto'])){
    $id= $_GET['rut'];
    $alluser= new ControladorPlantilla();
    $alluser->consultaSolFotoCTR($id);
        
    }
 //URL http://localhost/omrservice/servicios/usuarios.php?addFotoReporte
/*=============================================
NUEVa FOTO DETALLE DE REPORTE
=============================================*/
if (isset($_GET['addFotoReporte'])){
    
    header('Content-type: application/json');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $datos = ($request);
    //$datos = json_encode($request);
    
    //echo $datos;
     $newuser= new ControladorPlantilla();
     $newuser->reporteFotoCTR($datos);
        
    }
//URL http://localhost/omrservice/servicios/usuarios.php?addFotoSolucion
/*=============================================
NUEVa FOTO DETALLE DE REPORTE
=============================================*/
if (isset($_GET['addFotoSolucion'])){
    
    header('Content-type: application/json');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $datos = ($request);
    //$datos = json_encode($request);
    
    //echo $datos;
     $newuser= new ControladorPlantilla();
     $newuser->solucionFotoCTR($datos);
        
    }
 //URL http://localhost/omrservice/servicios/usuarios.php?nuevoSolucionpos
/*=============================================
NUEVO DETALLE DE REPORTE
=============================================*/
if (isset($_GET['nuevoSolucionpos'])){
    
    header('Content-type: application/json');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $datos = ($request);
    //$datos = json_encode($request);
    
    //echo $datos;
     $newuser= new ControladorPlantilla();
     $newuser->newUseSolucion($datos);
        
    }
//URL http://localhost/omrservice/servicios/usuarios.php?rut=1-9&consultaReporte
/*=============================================
CONSULTA DE REPORTE PARA SOLUCIÓN
=============================================*/
if (isset($_GET['consultaReporte'])){
    
    $user= new ControladorPlantilla();
    $user->consultaReporteCTR($rut);
        
    }
//URL http:/localhost//omrservice/servicios/usuarios.php?usuario=1-9&userId=jksahdjhsahg123Id&updateEquipo'
/*=============================================
CONSULTA USUARIO PARA LLENAR LOS CAMPOS
=============================================*/
if (isset($_GET['updateEquipo'])){
    
    $user= new ControladorPlantilla();
    $user->consultaUserEditNotiCTR($usuario, $userId);
        
    }
    
/*=============================================
UPADATE DETALLE SOLUCIÓN
=============================================*/
// URL http://localhost/omr/omrservice/servicios/rev_tecnica.php?updateSolucion
if (isset($_GET['updateSolucion'])){
    
    header('Content-type: application/json');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $datos = ($request);

    $updateRevTec= new ControladorPlantilla();
    $updateRevTec->updateSolucionesWeb($datos);       
}