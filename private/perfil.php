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
    <link href="../assets/css/excel.css" rel="stylesheet">

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
                 <div style="display:flex; justify-content: flex-start;">
                        <div class="container" >		
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
<?php

  if ($user_q['rol'] == 'Administrador' || $user_q['rol'] == 'Coordinador') {
?>
  <a href="../ControllerExportar.php">exportar</a>					
  <?php
} else {
    echo "<p>.</p>";
}
?>
</form>
</div>
<?php
// Asume que $user_q contiene la información del usuario y está previamente definida.
// $user_q = array('rol' => 'Administrador'); // Ejemplo de definición

if ($user_q['rol'] == 'Administrador' || $user_q['rol'] == 'Coordinador') {
?>
   <div class="juan">
    <form action="../assets/controller/ControllerInportar.php" method="post" enctype="multipart/form-data">
        <h2>Subir Archivo Excel</h2>
        <div class="input-div">
  <input class="input" type="file" name="archivo_excel"  accept=".xls,.xlsx" required>
<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" stroke-linejoin="round" stroke-linecap="round" viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="currentColor" class="icon"><polyline points="16 16 12 12 8 16"></polyline><line y2="21" x2="12" y1="12" x1="12"></line><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"></path><polyline points="16 16 12 12 8 16"></polyline></svg>
</div>
        <button>
          <div class="svg-wrapper-1">
            <div class="svg-wrapper">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                width="30"
                height="30"
                class="icon"
              >
                <path
                  d="M22,15.04C22,17.23 20.24,19 18.07,19H5.93C3.76,19 2,17.23 2,15.04C2,13.07 3.43,11.44 5.31,11.14C5.28,11 5.27,10.86 5.27,10.71C5.27,9.33 6.38,8.2 7.76,8.2C8.37,8.2 8.94,8.43 9.37,8.8C10.14,7.05 11.13,5.44 13.91,5.44C17.28,5.44 18.87,8.06 18.87,10.83C18.87,10.94 18.87,11.06 18.86,11.17C20.65,11.54 22,13.13 22,15.04Z"
                ></path>
              </svg>
            </div>
          </div>
          <span>Save</span>
        </button>
     </form>
   </div>
<?php
} else {
    echo "<p>.</p>";
}
?>
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
