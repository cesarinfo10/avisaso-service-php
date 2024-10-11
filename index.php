
<?php
require_once "controladores/usuario.controller.php";

require_once "modelos/usuario.model.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"  crossorigin="anonymous">
    <title>Notificaciones</title>
    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand" href="#"> <img class="logo" src="assets/logo-icon.png" height="40"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbar1">
    <ul class="navbar-nav ml-auto"> 
<li class="nav-item">
<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
</li>
<li class="nav-item active"><a class="nav-link" href="index.php"> Notificación por usuario </a></li>
<li class="nav-item"><a class="nav-link" href="todos.php"> Notificar a todos </a></li>
    </ul>
  </div>
</nav>
<div class="container"> 
<div class="col-md-12">
<div class="panel panel-primary p-3">
  <div class="panel-heading">
    <h3 class="panel-title">Notificación por Usuario</h3>
  </div>
  <div class="panel-body">
<form>
  <div class="form-row">

    <div class="form-group col-md-6">
      <label for="inputEmail4">Usuario</label>
      <select class="form-control" id="usuarioRut" onchange="consultarIDequipo()">
      <option value="0">Seleccione RUT</option>';
      <?php
      $alluser = ControladorPlantilla::allUserNotCTR();
        foreach($alluser as $user){?>

        <option><?php echo $user['USUARIO']; ?></option>';
 <?php } ?>
      </select>
      <input type="hidden" class="form-control" value="" id="include_player_ids">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Título</label>
      <input type="text" class="form-control" id="titulo">
    </div>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Mensaje</label>
    <textarea class="form-control" id="mensaje" rows="3"></textarea>
  </div>
  </div>
  <button type="button" class="btn btn-primary" onclick="guardarNotificacion();">Enviar Notificación</button>
</form>

<!-- <table class="table table-striped custab" style="margin-top: 3%">
    <thead>
        <tr>
            <th>Usario</th>
            <th>Título</th>
            <th>Mensaje</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
            <tr>
                <td>Usuario</td>
                <td>Titulo</td>
                <td>Mensaje</td>
                <td class="text-center"><a class='btn btn-info btn-xs' href="#"><span class="glyphicon glyphicon-edit"></span> Editar</a> <a href="#" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Eliminar</a></td>
            </tr>
    </table>-->

</div>
  </div>
</div>
<script src="js/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="js/js.js"></script>
</body>
</html>
