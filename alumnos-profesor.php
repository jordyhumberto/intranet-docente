<?php
	session_start(); //Inicia una nueva sesión o reanuda la existente
	require 'conexion.php'; //Agregamos el script de Conexión
	if(!isset($_SESSION["IDDocente"])){
		header("Location: login-profesores.php");
    }
    $id=$_SESSION['IDDocente'];
    $where = "";
    if(!empty($_POST))
	{
        $valor = $_POST['semestre'];
        if(!empty($valor))
        {
            $where="AND s.IDSemestre='$valor'";
        }
    }
    $sql3= "SELECT * FROM tbl_semestre ORDER BY Descripcion DESC";
    $resultado3=$mysqli->query($sql3);
	$sql = "SELECT co.IDCO AS codigo,c.Descripcion AS curso,d.Apellidos AS docente,s.Descripcion as semestre FROM (((tbl_curso_operativo AS co INNER JOIN tbl_cursos AS c ON co.IDCursos=c.IDCursos) INNER JOIN tbl_semestre AS s ON co.IDSemestre=s.IDSemestre) INNER JOIN tbl_docente AS d ON co.IDDocente=d.IDDocente) WHERE d.IDDocente='$id' $where";
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
				<h2 style="text-align:center">CURSOS</h2>
			</div>
            <br>
            <form class="form-horizontal" method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
                <div class="form-group">
					<label for="semestre" class="col-sm-1 control-label">SEMESTRE</label>
					<div class="col-sm-11">
						<select class="form-control" id="semestre" name="semestre">
                            <option value="">TODOS</option>
							<?php while($row = $resultado3->fetch_array(MYSQLI_ASSOC)) { ?>
								<option value="<?php echo $row['IDSemestre']; ?>"><?php echo $row['Descripcion']; ?></option>	
							<?php } ?>
						</select>
					</div>
                </div>
                <div class="form-group">
					<div class="col-sm-offset-1">
						<button type="submit" class="btn btn-primary">BUSCAR</button>
					</div>
				</div>
            </form>
			<div class="row table-responsive">
			    <table class="display" id="mitabla">
                    <thead>
                        <tr>
                            <th>IDCO</th>
                            <th>CURSO</th>
                            <th>DOCENTE</th>
                            <th>SEMESTRE</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                            <tr>
                                <td><?php echo $row['codigo']; ?></td>
                                <td><?php echo $row['curso']; ?></td>
                                <td><?php echo $row['docente']; ?></td>
                                <td><?php echo $row['semestre']; ?></td>
                                <td><a href="alumnos.php?IDCO=<?php echo $row['codigo'];?>"><span class="glyphicon glyphicon-plus"></span></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
				</table>
			</div>
		</div>	
	</div>
</body>
</html>