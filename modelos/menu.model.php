<?php

require_once "conexion.php";

class ModelServicios{
    /*=============================================
	LLAMAR A TODOS LOS TIPO USUARIOS
	=============================================*/
    static public function allMenuMDL($tabla, $tablaPermiso, $menu){

        $sql = Conexion::conectar()->prepare("SELECT a.id, a.nombre_menu,
        a.link, a.icono, a.orden, b.tipo, b.id_menu, b.permitido, 
        (SELECT descripcion FROM tipos_usuarios WHERE tipos_usuarios.id = $menu) as 'descripcion'
        FROM $tabla a, $tablaPermiso b WHERE b.tipo = '".$menu."' 
        and a.id = b.id_menu and permitido=1 and activo = 1 ORDER BY orden");

        $sql ->execute();

        return $sql -> fetchAll();

    }
    /*=============================================
	LLAMAR A UNO LOS TIPO USUARIOS OARA REPORTE
	=============================================*/
    static public function oneServiciosMDL($idReporte, $tablaCliente, $tabla, $tablaTorre, $tablaFoto){

        $sql = Conexion::conectar()->prepare("SELECT id,
        (SELECT NOMBRE FROM $tablaCliente WHERE USUARIO = idCliente LIMIT 1) AS 'Clientes', 
        (SELECT DESCRIPCION FROM $tablaTorre WHERE ID = idTorre)AS 'TORRES',
        unidad, descripcion, descripcionQR, 
        (SELECT rutaFoto FROM $tablaFoto WHERE idReporte = id LIMIT 1) AS 'rutaFoto',
        (CASE solucionado WHEN  '1' THEN 'Si' ELSE 'No' END) as 'solucions' FROM $tabla WHERE id = $idReporte");

        $sql ->execute();

        return $sql -> fetchAll();

    }
    /*=============================================
	LLAMAR A UNO LOS TIPO USUARIOS PARA REPORTE
	=============================================*/
    static public function oneSolucionMDL($idSolucion, $tablaCliente, $tabla, $tablaFoto){

        $sql = Conexion::conectar()->prepare("SELECT id,
        (SELECT NOMBRE FROM $tablaCliente WHERE USUARIO = usuarios LIMIT 1) AS 'Clientes', 
        desde, hasta, descripcion, 
        (SELECT rutaFoto FROM $tablaFoto WHERE idSolucion = id LIMIT 1) AS 'rutaFoto'
         FROM $tabla WHERE id = $idSolucion");

        $sql ->execute();

        return $sql -> fetchAll();

    }

    /*=============================================
	LLAMAR A UNO LOS TIPO USUARIOS PARA REPORTE
	=============================================*/
    static public function oneServiciosFotodMDL($idReporte, $tablaFoto){

        $sql = Conexion::conectar()->prepare("SELECT rutaFoto FROM $tablaFoto WHERE idReporte = $idReporte AND activo=1");

        $sql ->execute();

        return $sql -> fetchAll();
 
    }
    /*=============================================
	CONSULTA ALBUM  DE SOLUCION POR USUARIO
	=============================================*/
    static public function oneSolucionFotodMDL($idSolucion, $tablaFoto){

        $sql = Conexion::conectar()->prepare("SELECT rutaFoto FROM $tablaFoto WHERE idSolucion = $idSolucion AND activo=1");

        $sql ->execute();

        return $sql -> fetchAll();
 
    }
    /*=============================================
	LLAMAR A TODOS LOS TIPO USUARIOS
	=============================================*/
    static public function allallSolucionMDL($tablaCliente, $tabla, $tablaFoto){

        $sql = Conexion::conectar()->prepare("SELECT id,
        (SELECT NOMBRE FROM $tablaCliente WHERE USUARIO = usuarios LIMIT 1) AS 'Clientes', 
        desde, hasta, descripcion,
        (SELECT rutaFoto FROM $tablaFoto WHERE idSolucion = id LIMIT 1) AS 'rutaFoto' FROM $tabla ORDER BY fecha_crea DESC");

        $sql ->execute();

        return $sql -> fetchAll();
 
    }


}