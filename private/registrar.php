<?php

include ("../loginphp/conexion.php");
//login 

session_start();
//session_destroy();
require_once 'validatereg.php';
//if (isset($_SESSION['id_usuario'])){
//	header("Location:admin.php");
//}

// Registrar Usuario
if (isset($_POST ["registrar"])) { // verifica si existe o se presiono
	$nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
	//  Valida que no se le inyecte SQL
	$correo = mysqli_real_escape_string($conexion, $_POST['correo']);
	$usuario = mysqli_real_escape_string($conexion, $_POST['user']);
	$pass = mysqli_real_escape_string($conexion, $_POST['pass']);
    $celular = mysqli_real_escape_string($conexion, $_POST['cel']);
    $fecha = mysqli_real_escape_string($conexion, $_POST['fecha']);
	$rol = mysqli_real_escape_string($conexion, $_POST['rol']);
	$password_encriptada = sha1($pass);
	$sqluser= "SELECT idusuarios FROM usuarios
				WHERE usuario = '$usuario'"; //Para no ingresar otro usuario reg
	$resultadouser = $conexion->query($sqluser);

	$filas = $resultadouser->num_rows;//para contar los registros

	if ($filas >0){
		echo "<script>
				alert ('El usuario ya existe');

				window.location='../loginphp/index.php';
			  </script>";
	}else{
		//insertar el usuario
		$sqlusuario= "INSERT INTO usuarios(Nombre,Correo,Usuario,Password,Celular,FechaNacimiento,rol_id)
						VALUES ('$nombre', '$correo','$usuario', '$password_encriptada', '$celular', '$fecha', '$rol')";
		$resultadousuario = $conexion->query($sqlusuario);
		if ($resultadousuario >0){
			echo "<script>
					alert ('Registro Exitoso');
					window.location='../loginphp/index.php';
				  </script>";
		} else{

			echo "<script>
					alert ('Error al Registrar');
					window.location='../loginphp/index.php';
				  </script>";

		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Login  - Sistema de Usuarios</title>
		<link rel="shortcut icon" href="../assets/etapa/icono.ico" type="image/x-icon">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="../assets/etapa/style.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="../assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="../assets/css/ace.min.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="../assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="space-6"></div>
							<div class="position-relative">

	<div id="signup-box" class="signup-box visible widget-box no-border">
             	<div class="widget-body">
			<div class="widget-main">
            <h1>
					<i class="ico ico-sena green bigger-225 pull-left btn-lg"></i>
					<span class="gray">Registro </span>
					<span class="green" id="id-text2">Nuevos Usuarios</span>
				</h1>
				<div class="space-6"></div>
		<p><i class="bi bi-door-open"></i>Ingresa los datos solicitados acontinuacion: </p>
		<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST" >
			<fieldset>
			    <label class="block clearfix">
					<span class="block input-icon input-icon-right">
						<input type="text" class="form-control"  name="nombre" placeholder="Nombre Completo"  required />
						<i class="ace-icon fa fa-users"></i>
					</span>
				</label>
				<label class="block clearfix">
					<span class="block input-icon input-icon-right">
				        <input type="email" class="form-control" name="correo" placeholder="Email"  required />
					    <i class="ace-icon fa fa-envelope"></i>
					</span>
				</label>
				<label class="block clearfix">
					<span class="block input-icon input-icon-right">
			            <input type="number" class="form-control" name="user" placeholder="Cedula"  required />
                        <i class="ace-icon fa fa-user"></i>
  					</span>
				</label>
				<label class="block clearfix">
                    <span class="block input-icon input-icon-right">
		                <input type="password" class="form-control" name="pass" placeholder="Password"  required />
						<i class="ace-icon fa fa-lock"></i>
					</span>
				</label>
				<label class="block clearfix">
					<span class="block input-icon input-icon-right">
						<input type="password" class="form-control" name="passr" placeholder="Repetir password" />
						<i class="ace-icon fa fa-retweet"></i>
					</span>
				</label>
                <label class="block clearfix">
					<span class="block input-icon input-icon-right">
						<input type="number" class="form-control" name="cel" placeholder="Numero Celular" required/>
						<i class="ace-icon fa fa-retweet"></i>
					</span>
				</label>
                <label class="block clearfix">
					<span class="block input-icon input-icon-right">
						<input type="date" class="form-control" name="fecha" placeholder="Fecha Cumpleaños" required/>
						<i class="ace-icon fa fa-retweet"></i>
					</span>
				</label>
				<input type="hidden"  value="4" name="rol">
				<label class="block">
					<input type="checkbox" class="ace" />
						<span class="lbl">
						Acepto los
						<a href="#">Terminos de Uso</a>
						</span>
				</label>
				<div class="space-24"></div>
				<div class="clearfix">
					<button type="reset" class="width-30 pull-left btn btn-sm">
						<i class="ace-icon fa fa-refresh"></i>
						<span class="bigger-110">Reset</span>
					</button>
					
					<button type="submit" name="registrar"   class="width-65 pull-right btn btn-sm btn-success">
						<span class="bigger-110">Registrar</span>
						<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
					</button>
					 </div>
			</fieldset>
		</form>
	</div>

            <div class="toolbar center">
				<a href="../loginphp/index.php" class="back-to-login-link">
					<i class="ace-icon fa fa-arrow-left"></i>
						Regresar al Login
				</a>
			</div>
		</div><!-- /.widget-body -->
	</div><!-- /.signup-box -->
</div>
<!-- /.position-relative -->

							
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<script src="../assets/js/jquery-2.1.4.min.js"></script>

	</body>
</html>