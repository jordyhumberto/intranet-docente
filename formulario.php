<?php
    session_start(); //Inicia una nueva sesión o reanuda la existente
	require 'conexion.php'; //Agregamos el script de Conexión
	if(!isset($_SESSION["IDDocente"])){
		header("Location: login-profesores.php");
    }
    $matricula=$_GET['IDMA'];
    $curso=$_GET['IDCO'];
?>
<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="keywords" content="universidad, peruana, investigación, investigacion, negocios, upein, UPEIN">
		<meta name="description" content="UPEIN! - Universidad Peruana de Invesitgacion y Negocios da la bienvenida a sus nuevos estudiantes">
		<title>Intranet</title>
		<link href="img/favicon.ico" rel="shortcut icon" type="image/x-icon">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>	
	</head>
	<body>
		<div class="container">
			<div class="row">
				<h3 style="text-align:center">NUEVO REGISTRO</h3>
			</div>
			<form class="form-horizontal" method="POST" action="guardar.php?IDMA=<?php echo $matricula;?>&IDCO=<?php echo $curso;?>" autocomplete="off">
                <div class="form-group">
					<label for="practica" class="col-sm-2 control-label">practica</label>
					<div class="col-sm-10">
						<input type="number" class="form-control" id="practica" name="practica" placeholder="ingresar nota">
					</div>
				</div>
                <div class="form-group">
					<label for="parcial" class="col-sm-2 control-label">parcial</label>
					<div class="col-sm-10">
						<input type="number" class="form-control" id="parcial" name="parcial" placeholder="ingresar nota">
					</div>
                </div>
                <div class="form-group">
					<label for="final" class="col-sm-2 control-label">final</label>
					<div class="col-sm-10">
						<input type="number" class="form-control" id="final" name="final" placeholder="ingresar nota">
					</div>
                </div>
                <div class="form-group">
					<label for="sustitutorio" class="col-sm-2 control-label">sustitutorio</label>
					<div class="col-sm-10">
						<input type="number" class="form-control" id="sustitutorio" name="sustitutorio" placeholder="ingresar nota">
					</div>
                </div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<a href="notas.php?IDMA=<?php echo $matricula;?>&IDCO=<?php echo $curso;?>" class="btn btn-default">Regresar</a>
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</div>
			</form>	
		</div>
	</body>
</html>