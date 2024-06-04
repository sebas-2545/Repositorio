<?php
// Check existence of id parameter before processing further
    // Include config file
    include ("../loginphp/conexion.php");
	session_start();
    require_once 'validaterol.php';
    // Prepare a select statement
   
	$displayData = false;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Obtener el n�mero de c�dula del POST
		$cedula = isset($_POST['DNI']) ? $_POST['DNI'] : '';
	
		if ($cedula) {
			// Consulta SQL para obtener los datos
			$sql = "SELECT PrimerApellido, SegundoApellido, PrimerNombre, OtrosNombres, ficha, Fechainicio, FechaFinFicha, ResultadosAprobados, ResulatadoRequeridos, SNPRegistradaEnSOFIAPlus, FechaPresentacionDelSNP, EstadoSENABDPreliminar, ResponsablePagoBDPreliminar, ObservacionesBDPreliminar FROM tyt WHERE DNI = ?";
			
			// Preparar la declaraci�n
			$stmt = $conexion->prepare($sql);
			
			// Vincular par�metros
			$stmt->bind_param("s", $cedula);
			
			// Ejecutar la consulta
			$stmt->execute();
			
			// Obtener el resultado
			$result = $stmt->get_result();
			 
			if ($result->num_rows > 0) {
				// Fetch all rows from the result set
				$r = $result->fetch_assoc();
				$displayData = true;
			} else {
				echo "<script>
					alert('Datos no encontrados');
					window.location='TyT.php';
				</script>";
				exit();  // Salir para evitar que contin�e el script
			}
		}
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
        <link href="../assets/css/eceltyt.css" rel="stylesheet">

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
<h2 class="pull-left">IMPORTAR DATOS DE TYT</h2>
<?php
// Asume que $user_q contiene la información del usuario y está previamente definida.
// $user_q = array('rol' => 'Administrador'); // Ejemplo de definición

if ($user_q['rol'] == 'Administrador' || $user_q['rol'] == 'Coordinador') {
?>
<div class="conec"style="display:flex;">
	
	<div class="img">
	<H2>FORMATO COMO DEBE IR LAS PRUEBAS TYT </H2>

    <img src="../assets/images/Captura de pantalla (6).png" height="500" width="700"alt="" >
	<img class="test" src="../assets/images/Captura de pantalla (7).png" height="500" width="700"alt="" >

         </div>
    <div class="juan">
 
         <form action="../assets/controller/ControllerInportarTYT.php" method="post" enctype="multipart/form-data">
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
