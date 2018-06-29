<?php
	session_start(); //Inicia una nueva sesión o reanuda la existente
	require 'conexion.php'; //Agregamos el script de Conexión
	if(!isset($_SESSION["IDDocente"])){
		header("Location: login-profesores.php");
    }
    $id=$_SESSION['IDDocente'];
	$sql = "SELECT * FROM tbl_docente WHERE IDDocente = '$id'";
	$resultado = $mysqli->query($sql);
	$row = $resultado->fetch_array(MYSQLI_ASSOC);
	$consulta = "SELECT * FROM distritos ORDER BY Nom_Dist";
	$resul = $mysqli->query($consulta);
?>
<html lang="es">
	<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="universidad, peruana, investigación, investigacion, negocios, upein, UPEIN">
        <meta name="description" content="UPEIN! - Universidad Peruana de Invesitgacion y Negocios da la bienvenida a sus nuevos estudiantes">
        <title>Intranet</title>
        <link href="favicon.ico" rel="shortcut icon" type="image/x-icon">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>	
        <link rel="stylesheet" href="css/estilos.css">
	</head>
	<body>
        <?php include 'banner.html'?>
		<div class="container">
			<div class="row">
				<h3 style="text-align:center">MODIFICAR REGISTRO</h3>
			</div>
			<form class="form-horizontal" method="POST" action="#" autocomplete="off">
				<input type="hidden" id="id" name="id" value="<?php echo $row['IDDocente']; ?>"/>
				<div class="form-group">
					<label for="tipo" class="col-sm-2 control-label">Tipo de documento</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="tipo" name="tipo" placeholder="Tipo de documento" value="<?php echo $row['Tipo_doc']; ?>" required>
					</div>
					<label for="documento" class="col-sm-2 control-label"># de documento</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="documento" name="documento" placeholder="# de documento" value="<?php echo $row['N_documento'];?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="nombre" class="col-sm-2 control-label">Nombre</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $row['Nombres'];?>"required>
					</div>
					<label for="Apellido" class="col-sm-2 control-label">Apellido</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" value="<?php echo $row['Apellidos'];?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="fecha" class="col-sm-2 control-label">Fecha de nacimiento</label>
					<div class="col-sm-10">
						<input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $row['Fecha_nac'];?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="direccion" class="col-sm-2 control-label">Dirección</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" value="<?php echo $row['Direccion'];?>" required>
					</div>
					<label for="distrito" class="col-sm-2 control-label">Distrito</label>
					<div class="col-sm-2">
						<select class="form-control" id="distrito" name="distrito">				
							<?php while($fila = $resul->fetch_array(MYSQLI_ASSOC)) { ?>
								<option value="<?php echo $fila['Cod_Dist']; ?>" 
								<?php if($fila['Cod_Dist']==$row['Cod_Dist']) echo 'selected'; ?>>
								<?php echo $fila['Nom_Dist']; ?>
								</option>	
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="telefono" class="col-sm-2 control-label">Telefono</label>
					<div class="col-sm-4">
						<input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo $row['Telf_fijo'];?>" placeholder="Telefono">
					</div>
					<label for="celular" class="col-sm-2 control-label">Celular</label>
					<div class="col-sm-4">
						<input type="tel" class="form-control" id="celular" name="celular" value="<?php echo $row['Telf_celular'];?>" placeholder="Celular">
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $row['Email'];?>" required>
					</div>
				</div>		
				<div class="form-group">
					<label for="categoria" class="col-sm-2 control-label">Categoría</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="categoria" name="categoria" placeholder="Categoría" value="<?php echo $row['Categoria'];?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="regimen" class="col-sm-2 control-label">Régimen</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="regimen" name="regimen" placeholder="Régimen de dedicación" value="<?php echo $row['Regi_dedicacion'];?>">
					</div>
				</div>
				<div class="form-group">
					<label for="tiempo" class="col-sm-2 control-label">Tiempo de labores</label>
					<div class="col-sm-10">
						<input type="number" class="form-control" id="tiempo" name="tiempo" min="0" placeholder="horas a la semana" value="<?php echo $row['Tiem_labores'];?>">
					</div>
				</div>
				<div class="form-group">
					<label for="estado_civil" class="col-sm-2 control-label">Estado</label>
					<div class="col-sm-10">
						<select class="form-control" id="estado" name="estado">
							<option value="01" <?php if($row['Estado']=='01') echo 'selected'; ?>>ACTIVO</option>
							<option value="00" <?php if($row['Estado']=='00') echo 'selected'; ?>>INACTIVO</option>
						</select>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>