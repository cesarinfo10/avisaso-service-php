<?php
ob_start();
require_once "../controladores/tipo_user.controller.php";

require_once "../modelos/tipo_user.model.php";

//URL http://localhost/appcondominio/servicios/tipo_user.php?getAllTipo
/*=============================================
LLAMAR A TODOS LOS USUARIOS
=============================================*/
if (isset($_GET['getAllTipo'])){

   $alltipouser= new ControladorTipo();
   $alltipouser->allTipoUserCTR();
   
   }

   header("Access-Control-Allow-Origin: *");
   ob_end_flush();