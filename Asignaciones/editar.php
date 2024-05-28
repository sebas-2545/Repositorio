<?php
include ("../loginphp/conexion.php");

session_start();
require_once '../private/validaterol.php';


if (!isset($_SESSION['id_usuario'])){
	header("Location:../loginphp/index.php");
}

$iduser = $_SESSION['id_usuario'];
$sql = "SELECT idusuarios, Nombre FROM usuarios WHERE idusuarios = '$iduser'";
//$sql = "SELECT * FROM Usuarios";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();

?>
<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Verificar si hay algún error en la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $con->connect_error);
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Error: ID no proporcionado o inválido.');
}

$id = intval($_GET['id']);
$stmt = $conexion->prepare("SELECT * FROM datos_exceldatos1_1714747072 WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die('Registro no encontrado.');
}
?>


<!DOCTYPE html>

<html lang="es">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Sistema - Panel Principal</title>
        <link rel="stylesheet" href="../assets/css/editar1.css">
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

	<body class="no-skin">
		<?php require_once("../private/encabeza.php"); ?>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container','fixed')}catch(e){}
			</script>
				
				<!-- MOSTRAR EL MENU  -->
				<?php require_once("../Asignaciones/menulateral.php"); ?>
				<!-- fin Menu Lateral -->

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="admin.php">Inicio</a>
							</li>
							<li class="active">Panel Principal</li>
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

                                            <h1>Editar Registro</h1>
                                            <form action="../Asignaciones/actualizar_registro.php" method="post">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                <label for="INSTRUCTOR_SEGUIMIENTO_ACTUAL">INSTRUCTOR SEGUIMIENTO ACTUAL</label><br>
                                                <input type="text" name="INSTRUCTOR_SEGUIMIENTO_ACTUAL" value="<?php echo htmlspecialchars($row['INSTRUCTOR_SEGUIMIENTO_ACTUAL']); ?>"><br>
                                                <label for="Correo_Instructor">Correo Instructor</label><br>
                                                <input type="email" name="Correo_Instructor" value="<?php echo htmlspecialchars($row['Correo_Instructor']); ?>" required><br>
                                                <label for="INSTRUCTOR_ANTERIOR">INSTRUCTOR ANTERIOR</label><br>
                                                <input type="text" name="INSTRUCTOR_ANTERIOR" value="<?php echo htmlspecialchars($row['INSTRUCTOR_ANTERIOR']); ?>"><br>
                                                <label for="CORREO">CORREO</label><br>
                                                <input type="email" name="CORREO" value="<?php echo htmlspecialchars($row['CORREO']); ?>" ><br>
                                                <input type="submit" value="Actualizar">
                                            </form>
                                            <button id="redirectButton">
                                        <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024"><path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path></svg>
                                        <span>Regresar</span>
                                        </button>

                                            <script>
                                                document.getElementById('redirectButton').addEventListener('click', function() {
                                                    window.location.href = '../private/buscador.php';
                                                });
                                            </script>
                                                    <!-- PAGE CONTENT ENDS -->
                                                    </div><!-- /.col -->
                                                        </div><!-- /.row -->
                                                    </div><!-- /.page-content -->
                                                </div>
                                            </div><!-- /.main-content -->
                                            
                                            <?php require_once("../private/piedepagina.php"); ?>
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
                                        <script src="../assets/datatables/revisar.js"></script>

                                        
                                    </body>
                                </html>
