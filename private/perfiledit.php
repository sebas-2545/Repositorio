<?php

    // Include config file
    //require_once "config.php";
    include ("../loginphp/conexion.php");
	session_start();
	require_once 'validateperfil.php';
    // Prepare a select statement
	$nombre = $correo = $cedula = $celular = $fechanacimiento = $correo2 = $password= $fechareg = $profesion=$rolr ="";
	$nombre_err = $correo_err = $cedula_err = $celular_err = $fechanacimiento_err = $correo_err2 = $password_err= $confirm_password_err= $profesion_err=$rol_err="";


	// Processing form data when form is submitted
	if(isset($_POST['id']) && !empty($_POST["id"])){
		// Get hidden input value
		$id = $_POST["id"];

		// Validate cedula
		$input_salary = trim($_POST["Cedula"]);
		if(empty($input_salary)){
			$cedula_err = "Por favor ingrese una cedula valida.";     
		} elseif(!ctype_digit($input_salary)){
			$cedula_err = "Por favor ingrese un valor positivo y válido.";
		} else{
			$cedula = $input_salary;
		}

		// Validate name
		$input_name = trim($_POST["Nombre"]);
		if(empty($input_name)){
			$nombre_err = "Por favor ingrese un nombre.";
		} elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
			$nombre_err = "Por favor ingrese un nombre válido.";
		} else{
			$nombre = $input_name;
		}
		
		// Validate address address
		$input_address = trim($_POST["Correo1"]);
		if(empty($input_address)){
			$correo_err = "Por favor ingrese un Correo.";     
		} else{
			$correo = $input_address;
		}
		
		$input_address2 = trim($_POST["Correo2"]);
		if(empty($input_address2)){
			$correo2 = $input_address2;
		}elseif(!filter_var($input_address2, FILTER_VALIDATE_EMAIL)){
			$correo_err2 = "Por favor ingrese un Correo Alterno.";     
		} else{
			$correo2 = $input_address2;
		}
	
		// Validacion de contraseña
		if (empty(trim($_POST["pass"]))) {
			$password_err = "";
		} elseif (strlen(trim($_POST["pass"])) < 6) {
			$password_err = "Contraseña tiene que tener al menos 6 caracteres.";
		} else {
			$password = $_POST["pass"];
		}

		// Validacion de segundo contraseña 
		if (empty(trim($_POST["passr"]))) {
			$confirm_password_err = "";
		} else {
			$confirm_password = trim($_POST["passr"]);
			if (empty($password_err) && ($password != $confirm_password)) {
				$confirm_password_err = "Contraseñas no conciden.";
			}
		}
		// Validate celular
		$input_celular = trim($_POST["cel"]);
		if(empty($input_celular)){
			$celular_err = "Por favor ingrese un numero de celular.";     
		} elseif(!ctype_digit($input_celular)){
			$celular_err = "Por favor ingrese un valor positivo y válido.";
		} elseif (strlen(trim($_POST["cel"])) < 10) {
			$celular_err = "Celular debe tener al menos 10 caracteres.";
		} else{
			$celular = $input_celular;
		}

		// Validate fecha nacimiento
		$input_fecha = trim($_POST["fecha2"]);
		if(empty($input_fecha)){
			$fechanacimiento = $input_fecha;
		} else{
			$fechanacimiento = $input_fecha;
		}
		// Validate profesion
		$input_profesion = trim($_POST["prof"]);
		if(empty($input_profesion)){
			$profesion = $input_profesion;
		} else{
			$profesion = $input_profesion;
		}

		$rolr = trim($_POST["rolr"]);

		// Check input errors before inserting in database
		if(empty($nombre_err) && empty($correo_err) && empty($cedula_err) && empty($correo_err2)&& empty($password_err)&& empty($confirm_password_err)&& empty($celular_err)&& empty($fechanacimiento_err)&& empty($profesion_err)){
			// Prepare an update statement , Password=?
			
			//$ssql = "UPDATE roles SET nombre = '$rolr' WHERE roles.id = ?";
			//$conexion->query($ssql);

			//$sql = "UPDATE usuarios SET Nombre=?, Correo=?, Usuario=?, Celular=?, Profesion=?, FechaNacimiento=?, CorreoAlt=? WHERE idusuarios=?";
			$sql = "UPDATE usuarios u Inner join roles r on u.rol_id=r.id SET u.Nombre=?, u.Correo=?, u.Usuario=?, u.Celular=?, u.Profesion=?, u.FechaNacimiento=?, u.CorreoAlt=?, u.rol_id=? WHERE idusuarios = ?";

			if($stmt = mysqli_prepare($conexion, $sql)){
				// Bind variables to the prepared statement as parameters $param_password,
				mysqli_stmt_bind_param($stmt, "ssssssssi", $param_nombre, $param_correo, $param_cedula, $param_celular, $param_profesion, $param_fechanacimiento, $param_correoalt,$param_rol,  $param_id);
				
				// Set parameters
				$param_nombre = $nombre;
				$param_correo = $correo;
				$param_cedula = $cedula;
				$param_celular = $celular;
				$param_profesion = $profesion;
				$param_fechanacimiento = $fechanacimiento;
				$param_correoalt = $correo2;
				$param_rol = $rolr;
				$param_id = $id;
				
				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
					// Records updated successfully. Redirect to landing page
					header("location: instructor.php");
					exit();
				} else{
					echo "Algo esta mal. Por favor intentelo nuevamente despues de un tiempo.";
				}
			}
			// Close statement
			mysqli_stmt_close($stmt);
		}
		// Close connection
		mysqli_close($conexion);
	
	} else{
		
		
		// Check existence of id parameter before processing further
		if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
			// Get URL parameter
			$id =  trim($_GET["id"]);
			
			// Prepare a select statement
			//$sql = "SELECT * FROM usuarios WHERE idusuarios = ?";
			$sql = "SELECT * FROM usuarios u left join roles r on u.rol_id=r.id WHERE idusuarios = ?";

			if($stmt = mysqli_prepare($conexion, $sql)){
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "i", $param_id);
				
				// Set parameters
				$param_id = $id;
				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt)){
					$result = mysqli_stmt_get_result($stmt);
		
					if(mysqli_num_rows($result) == 1){
						/* Fetch result row as an associative array. Since the result set
						contains only one row, we don't need to use while loop */
						$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
						
						// Retrieve individual field value
						$fechareg = $row["FechaReg"];
						$cedula = $row["Usuario"];
						$nombre = $row["Nombre"];
						$correo = $row["Correo"];
						$correo2 = $row["CorreoAlt"];
						$celular = $row["Celular"];
						$fechanacimiento = $row["FechaNacimiento"];
						$profesion = $row["Profesion"];
						$rols = $row['nombre'];
						$rolid=$row['rol_id'];

					} else{
						// URL doesn't contain valid id. Redirect to error page
						header("location: ../loginphp/error.php");
						exit();
					}
					
				} else{
					echo "Oops! Algo esta mal. Por favor intentelo nuevamente despues de un tiempo.";
				}
			}
			
			// Close statement
			mysqli_stmt_close($stmt);
			
			// Close connection
			mysqli_close($conexion);
		}  	else{
			// URL doesn't contain id parameter. Redirect to error page
			header("location: ../loginphp/error.php");
			exit();
		}
	}
?>

<!DOCTYPE html>

<html lang="es">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Sistema - Panel Principal</title>
		<link rel="shortcut icon" href="../assets/etapa/icono.ico" type="image/x-icon">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../assets/datatables/datatables.css" />
		<link href="../assets/css/hebbo.css" rel="stylesheet">
		<link rel="stylesheet" href="../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-rtl.min.css" />
		<script src="../assets/js/ace-extra.min.js"></script>

	</head>

	<body class="no-skin login-layout">
		<?php require_once("encabeza.php"); ?>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container','fixed')}catch(e){}
			</script>
				
				<!-- MOSTRAR EL MENU  -->
				<?php require_once("menulateral.php"); ?>
				<!-- fin Menu Lateral -->
				
			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="admin.php">Inicio</a>
							</li>
							<li>
							<a href="instructor.php">Instructores</a>
							<li class="active">Panel Editar Personal</li>
						</ul><!-- /.breadcrumb -->

						<!--
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Buscar ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div> /.nav-search -->
					</div>

					<div class="page-content">

						<div class="row">
							<div class="col-xs-12">
								
							
							<!-- PAGE CONTENT BEGINS -->

								<div class="page-header clearfix">
                       			 <h2 class="pull-left">Panel Actualizar Registro</h2>
                    			</div>
								<p>Edite los valores de entrada y envíe para actualizar el registro.</p>
<div class="position-relative width-80 pull-left">
	<div class="login-box widget-box no-border visible" id="reg-box">
	<div class="widget-body">
		<div class="widget-main">
		<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="POST">
			<fieldset>
				<label class="block clearfix"> Fecha de registro
					<span class="block input-icon input-icon-right">
						<input type="date" class="form-control" name="fecha1" value="<?php echo $fechareg; ?>" readonly/>
					</span>
				</label>
				<label class="block clearfix"> Cedula
					<span class="block input-icon input-icon-right <?php echo (!empty($cedula_err)) ? 'has-error' : ''; ?>">
			            <input type="number" class="form-control" name="Cedula" value="<?php echo $cedula; ?>" readonly/>
						<span class="help-block"><?php echo $cedula_err;?></span>
                        <i class="ace-icon fa fa-user"></i>
  					</span>
				</label>
			    <label class="block clearfix"> Nombre
					<span class="block input-icon input-icon-right <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
						<input type="text" class="form-control"  name="Nombre" value="<?php echo $nombre; ?>" />
						<span class="help-block"><?php echo $nombre_err;?></span>
						<i class="ace-icon fa fa-users"></i>
					</span>
				</label>
				<label class="block clearfix"> Correo electrónico
					<span class="block input-icon input-icon-right <?php echo (!empty($correo_err)) ? 'has-error' : ''; ?>">
				        <input type="email" class="form-control" name="Correo1" value="<?php echo $correo; ?>" />
						<span class="help-block"><?php echo $correo_err;?></span>
					    <i class="ace-icon fa fa-envelope"></i>
					</span>
				</label>
				<label class="block clearfix"> Correo electrónico Alterno
					<span class="block input-icon input-icon-right <?php echo (!empty($correo_err2)) ? 'has-error' : ''; ?>">
				        <input type="email" class="form-control" name="Correo2" value="<?php echo $correo2; ?>" />
						<span class="help-block"><?php echo $correo_err2;?></span>
					    <i class="ace-icon fa fa-envelope"></i>
					</span>
				</label>
				<div style="display: none">
				<label class="block clearfix"> Constraseña
                    <span class="block input-icon input-icon-right <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
		                <input type="password" class="form-control" name="pass" placeholder="Password"/>
						<span class="help-block"><?php echo $password_err;?></span>
						<i class="ace-icon fa fa-lock"></i>
					</span>
				</label> 
				<label class="block clearfix"> Repetir contraseña
					<span class="block input-icon input-icon-right <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
						<input type="password" class="form-control" name="passr" placeholder="Repetir password" />
						<span class="help-block"><?php echo $confirm_password_err;?></span>
						<i class="ace-icon fa fa-retweet"></i>
					</span>
				</label>
				</div>
                <label class="block clearfix"> Numero Celular
					<span class="block input-icon input-icon-right <?php echo (!empty($celular_err)) ? 'has-error' : ''; ?>">
						<input type="number" class="form-control" name="cel" value="<?php echo $celular; ?>" />
						<span class="help-block"><?php echo $celular_err;?></span>
						<i class="ace-icon fa fa-phone"></i>
					</span>
				</label>
                <label class="block clearfix"> Fecha de Cumpleaños
					<span class="block input-icon input-icon-right <?php echo (!empty($fechanacimiento_err)) ? 'has-error' : ''; ?>">
						<input type="date" class="form-control" name="fecha2" value="<?php echo $fechanacimiento; ?>" />
						<span class="help-block"><?php echo $fechanacimiento_err;?></span>
						<i class="ace-icon fa fa-birthday-cake"></i>
					</span>
				</label>
				<label class="block clearfix"> Profesión
					<span class="block input-icon input-icon-right <?php echo (!empty($profesion_err)) ? 'has-error' : ''; ?>">
						<input type="text" class="form-control" name="prof" value="<?php echo $profesion; ?>" />
						<span class="help-block"><?php echo $profesion_err;?></span>
						<i class="ace-icon fa fa-user"></i>
					</span>
				</label>
				<?php 
							if ($user_q['rol']=='Administrador' || $user_q['rol']=='Coordinador'){
								echo "<label class='block clearfix'> Rol";
                				echo "<span class='block input-icon input-icon-right'>";
                				echo "<select class='custom-select' name='rolr' required>";
								echo "<option selected hidden value=\"$rolid\">" . $rols . "</option>";
								$registros = mysqli_query($conexion, "SELECT id, nombre from roles order by id") or
                                        die("Problemas en el select:" . mysqli_error($conexion));
                                        while ($reg = mysqli_fetch_array($registros)) {
                                        echo "<option value=\"$reg[id]\">$reg[nombre]</option>";
                                        }
								echo "</select>";
								echo "</span>";
								echo "</label>";
							}
							else{
								echo "<p>&nbsp;</p>";
							}
				?>
				<div class="space-24"></div>
				<div class="clearfix">
					
				<input type="hidden" name="id" value="<?php echo $id; ?>"/>
        		<input type="submit" class="btn btn-primary" value="Enviar">
       			<a href="instructor.php" class="btn btn-default">Cancelar</a>

					 </div>
			</fieldset>
		</form>
		</div>
			<div class="toolbar clearfix">
				<div>
				<a href="#" data-target="#change-box" class="forgot-password-link">
				<i class="ace-icon bi bi-key-fill"></i>
				Cambiar contraseña
				</a>
				</div>

			</div>
	</div>	
	</div>

	<div id="change-box" class="forgot-box widget-box no-border">
		<div class="widget-body">
			<div class="widget-main">
				<h4 class="header red lighter bigger">
				<i class="ace-icon fa fa-key"></i>
				Recuperar Contraseña
				</h4>
				<div class="space-6"></div>
				<p>
				Ingressa tu correo electronico para recibir las instrucciones
				</p>
				<form action="" method="post">
				<fieldset>
					<label for="contraseña">Contraseña antigua:</label><br>
					<input type="password" id="password" name="password" required><br><br>
					<label for="contraseña nueva">Contraseña nueva:</label><br>
					<input type="password" id="nueva_password" name="nueva_password" required><br><br>
					<label for="contraseña nuevamente">repita su contraseña:</label><br>
					<input type="password" id="nueva_password_rep" name="nueva_password_rep" required><br><br>
					<input type="submit" class="width-35 pull-right btn btn-sm btn-danger" value="Cambiar" name="cambiapass">
					</fieldset>
				</form>


			</div><!-- /.widget-main -->
			<div class="toolbar center">
				<a href="#" data-target="#reg-box" class="back-to-login-link">
				Regresar al perfil
				<i class="ace-icon fa fa-arrow-right"></i>
				</a>
			</div>
		</div><!-- /.widget-body -->
	</div><!-- /.forgot-box -->
</div>

								
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
			
			<?php require_once("piedepagina.php"); ?>
			<!-- /.Pie de pagina -->
			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<script src="../assets/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript">
			window.jQuery || document.write("<script src='../assets/js/jquery.min.js'>"+"<"+"/script>");

		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		</script>
				<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
		</script>

		<script src="../assets/js/bootstrap.min.js"></script>
		<script src="../assets/js/jquery-ui.custom.min.js"></script>
		<script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../assets/js/jquery.easypiechart.min.js"></script>
		<script src="../assets/js/jquery.sparkline.index.min.js"></script>
		<script src="../assets/js/jquery.flot.min.js"></script>
		<script src="../assets/js/jquery.flot.pie.min.js"></script>
		<script src="../assets/js/jquery.flot.resize.min.js"></script>
		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>
		<script src="../assets/datatables/datatables.min.js"></script>
		<script src="../assets/datatables/revisar.js"></script>
	</body>
</html>
