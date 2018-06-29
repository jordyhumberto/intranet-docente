<?php
	session_start(); //Inicia una nueva sesión o reanuda la existente
	require 'conexion.php'; //Agregamos el script de Conexión
	if(!isset($_SESSION["IDDocente"])){
		header("Location: login-profesores.php");
    }
    $id=$_GET['IDCO'];
	$sql = "SELECT na.IDMatricula AS matricula,na.IDCO as curso,a.Apellido_paterno AS paterno,a.Apellido_materno AS materno,a.Nombres AS nombres,na.PPracticas AS nota1,na.ExamenParcial AS nota2,na.ExamenFinal AS nota3,na.ExamenSusti AS nota4,na.Promedio AS nota5 FROM ((tbl_notas_alumno AS na INNER JOIN tbl_matricula_carrera AS mc ON na.IDMatricula=mc.IDMatricula) INNER JOIN tbl_alumno AS a ON mc.IDAlumno=a.IDAlumno) WHERE na.IDCO='$id' ";
	$resultado = $mysqli->query($sql);
?>
<!DOCTYPE html>
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
	<link href="css/jquery.dataTables.min.css" rel="stylesheet">	
	<script src="js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" href="css/estilos.css">
	<link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One|Ultra" rel="stylesheet">
	<script>
		$(document).ready(function(){
			$('#mitabla').DataTable({
				"order": [[1, "asc"]],
				"language":{
					"lengthMenu": "Mostrar _MENU_ registros por pagina",
					"info": "Mostrando pagina _PAGE_ de _PAGES_",
					"infoEmpty": "No hay registros disponibles",
					"infoFiltered": "(filtrada de _MAX_ registros)",
					"loadingRecords": "Cargando...",
					"processing":     "Procesando...",
					"search": "Buscar:",
					"zeroRecords":    "No se encontraron registros coincidentes",
					"paginate": {
						"next":       "Siguiente",
						"previous":   "Anterior"
					},					
				}
			});	
		});	
	</script>
</head>
<body>
    <?php include 'banner.html'?>
	<div class="contenedor">	
		<div class="container">
			<div class="row">
				<h2 style="text-align:center">ALUMNOS</h2>
			</div>
            <br>
            <div class="row">
                <a href="alumnos-profesor.php" class="btn btn-default">Regresar</a>
            </div>
            <br>
			<div class="row table-responsive">
			    <table class="display" id="mitabla">
                    <thead>
                        <tr>
                            <th>ALUMNO</th>
                            <th>PRACTICA</th>
                            <th>PARCIAL</th>
                            <th>FINAL</th>
                            <th>SUSTI</th>
                            <th>PROMEDIO</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                            <tr>
                                <td><?php echo $row['paterno'].' '.$row['materno'].' '.$row['nombres']; ?></td>
                                <td><?php echo $row['nota1']; ?></td>
                                <td><?php echo $row['nota2']; ?></td>
                                <td><?php echo $row['nota3']; ?></td>
                                <td><?php echo $row['nota4']; ?></td>
                                <td><?php echo $row['nota5']; ?></td>
                                <td><a href="formulario.php?IDMA=<?php echo $row['matricula'];?>&IDCO=<?php echo $row['curso'];?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
				</table>
			</div>
		</div>	
	</div>
</body>
</html>