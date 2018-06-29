<?php
    session_start(); //Inicia una nueva sesión o reanuda la existente
    require 'conexion.php'; //Agregamos el script de Conexión
    if(!isset($_SESSION["IDDocente"])){
        header("Location: login-profesores.php");
    }
    $matricula=$_GET['IDMA'];
    $curso=$_GET['IDCO'];
    $practica=$_POST['practica'];
    $parcial=$_POST['parcial'];
    $final=$_POST['final'];
    $sustitutorio=$_POST['sustitutorio'];
    $promedio=0;
    if ($final==0 && $practica==0 && $sustitutorio==0 ) {
       /*  $promedio=($practica+$parcial+$final+$sustitutorio)/4; */
       $sql = "UPDATE tbl_notas_alumno SET ExamenParcial='$parcial' WHERE IDMatricula='$matricula' AND IDCO='$curso'";
       $resultado = $mysqli->query($sql);
    }
    if ($practica==0 && $sustitutorio==0 ) {
        /* $promedio=($practica+$parcial+$final)/3; */
        $sql = "UPDATE tbl_notas_alumno SET ExamenParcial='$parcial',ExamenFinal='$final' WHERE IDMatricula='$matricula' AND IDCO='$curso'";
        $resultado = $mysqli->query($sql);
    }
    if ($sustitutorio==0 ) {
        /* $promedio=($practica+$parcial+$final)/3; */
        $sql = "UPDATE tbl_notas_alumno SET ExamenParcial='$parcial',ExamenFinal='$final',PPracticas='$practica' WHERE IDMatricula='$matricula' AND IDCO='$curso'";
        $resultado = $mysqli->query($sql);
    }
    /* 
	$sql = "UPDATE tbl_notas_alumno SET PPracticas='$practica',ExamenParcial='$parcial',ExamenFinal='$final',ExamenSusti='$sustitutorio' WHERE IDMatricula='$matricula' AND IDCO='$curso'";
    $resultado = $mysqli->query($sql); */
?>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="keywords" content="universidad, peruana, investigación, investigacion, negocios, upein, UPEIN">
        <meta name="description" content="UPEIN! - Universidad Peruana de Invesitgacion y Negocios da la bienvenida a sus nuevos estudiantes">
        <title>Intranet</title>
        <link href="../../img/favicon.ico" rel="shortcut icon" type="image/x-icon">
        <link href="../../css/bootstrap.min.css" rel="stylesheet">
        <link href="../../css/bootstrap-theme.css" rel="stylesheet">
        <script src="../../js/jquery-3.3.1.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>	
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="row" style="text-align:center">
					<?php if($resultado) { ?>
						<h3>REGISTRO MODIFICADO</h3>
						<?php } else { ?>
						<h3>ERROR AL MODIFICAR</h3>
					<?php } ?>	
					<a href="m_a_aula.php" class="btn btn-primary">Regresar</a>
				</div>
			</div>
		</div>
	</body>
</html>