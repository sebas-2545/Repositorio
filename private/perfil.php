<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    include ("../loginphp/conexion.php");
	session_start();
    require_once 'validaterol.php';
    // Prepare a select statement
    $sql = "SELECT * FROM usuarios u left join roles r on u.rol_id=r.id WHERE idusuarios = ?";
    
    if($stmt = mysqli_prepare($conexion, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $name = $row["Nombre"];
                $correo = $row["Correo"];
                $cedula = $row["Usuario"];
				        $celular = $row["Celular"];
				        $fechanacimiento = $row["FechaNacimiento"];
                $profesion = $row["Profesion"];
                $alterno = $row["CorreoAlt"];
				$rol = $row["nombre"];

            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location:../loginphp/error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($conexion);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location:../loginphp/error.php");
    exit();
}
?>

<!DOCTYPE html>

<html lang="es">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Sistema Información- Instructor Registrado </title>
		<link rel="shortcut icon" href="../assets/etapa/icono.ico" type="image/x-icon">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../assets/datatables/datatables.css" />
		<link href="../assets/css/hebbo.css" rel="stylesheet">
		<link rel="stylesheet" href="../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-rtl.min.css" />
		<script src="../assets/js/ace-extra.min.js"></script>

	</head>

	<body class="no-skin">
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
							<li class="active">Ver perfil instructor</li>
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
                       			 <h2 class="pull-left">Ver datos del Instructor</h2>
                    			</div>
                          <p>&nbsp;</p> 
						<div class="container">		
<form>
  <div class="form-row">
    <div class="col-md-2 mb-3">
      <label >Cedula</label>
      <input type="text" class="form-control" value="<?php echo $cedula; ?>" readonly>
    </div>
    <div class="col-md-4 mb-3">
      <label >Nombre Completo</label>
      <input type="text" class="form-control"  value="<?php echo $name;?>" readonly>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-3 mb-3">
      <label>Correo electrónico</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupPrepend">@</span>
        </div>
        <input type="text" class="form-control" aria-describedby="inputGroupPrepend" value="<?php echo $correo;?>" readonly>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label >Celular</label>
      <input type="text" class="form-control"  value="<?php echo $celular; ?>" readonly>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-3 mb-3">
      <label >Profesion</label>
      <input type="text" class="form-control" value="<?php echo $profesion; ?>" readonly>
    </div>
    <div class="col-md-3 mb-3">
      <label >Fecha Cumpleaños</label>
      <input type="text" class="form-control" value="<?php echo $fechanacimiento;?>" readonly>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-3 mb-3">
      <label >Correo Alterno</label>
      <input type="text" class="form-control" value="<?php echo $alterno;?>" readonly>
    </div>
    <?php
							if ($user_q['rol']=='Administrador' || $user_q['rol']=='Coordinador'){
								echo "<div class='col-md-3 mb-3'> <label >Rol</label>";
                echo "<input type='text' class='form-control' value=' " . $rol . " ' readonly>";
                echo "</div>";
							}
							else{
								echo "<p>&nbsp;</p>";
							}
		?>
  </div>
  <div class="form-group" hidden>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="">
      <label class="form-check-label">
        Agree to terms and conditions
      </label>
    </div>
  </div>
  <p>&nbsp;</p>
  <p><a href="instructor.php" class="btn btn-primary">Volver</a></p>
</form>

						
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
		</script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
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
		<script src="../assets/datatables/revisarperfil.js"></script>
	
	</body>
</html>
