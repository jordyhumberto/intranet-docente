<?php
	require('conexion.php');
	session_start();
	if(isset($_SESSION["IDDocente"])){
		header("Location: datos-profesores.php");
	}
	if(!empty($_POST))
	{
		$usuario = mysqli_real_escape_string($mysqli,$_POST['usuario']);
		$password = mysqli_real_escape_string($mysqli,$_POST['clave']);
		$error = '';
		$sql = "SELECT IDDocente,Clave,Estado FROM tbl_usuario_docente WHERE IDDocente = '$usuario' AND Clave = '$password' AND Estado='01'";
		//, id_tipo
		$result=$mysqli->query($sql);
		$rows = $result->num_rows;
		if($rows > 0) {
			$row = $result->fetch_assoc();
			$_SESSION['IDDocente'] = $row['IDDocente'];
			//$_SESSION['tipo_usuario'] = $row['id_tipo'];
			header("location: datos-profesores.php");
			} else {
			$error = "El nombre o contraseña son incorrectos";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <link href="favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link rel="stylesheet" href="css/login.css">
    <title>INTRANET</title>
</head>
<body>
<div id="login" class="container">
  <div class="row-fluid">
    <div class="span12">
      <div class="login well well-small">
        <div class="center">
          <img src="logo_upein.png" alt="logo"> 
        </div>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" style="" class="login-form" id="UserLoginForm" method="post" accept-charset="utf-8" autocomplete="off">
          <div class="control-group">
            <div class="input-prepend">
              <span class="add-on"><i class="icon-user"></i></span>
              <input name="usuario" required="required" placeholder="Username" maxlength="255" type="text" id="UserUsername"> 
            </div>
          </div>
          <div class="control-group">
            <div class="input-prepend">
              <span class="add-on"><i class="icon-lock"></i></span>
              <input name="clave" required="required" placeholder="Password" type="password" id="UserPassword"> 
            </div>
          </div>
          <div class="control-group">
            <input class="btn btn-primary btn-large btn-block" type="submit" value="Sign in"> 
          </div>
        </form>
      </div><!--/.login-->
    </div><!--/.span12-->
  </div><!--/.row-fluid-->
</div><!--/.container-->    
</body>
</html>

