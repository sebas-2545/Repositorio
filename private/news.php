<?php
include ("../loginphp/conexion.php");

session_start();
require_once 'validaterol.php';


if (!isset($_SESSION['id_usuario'])){
	header("Location:../loginphp/index.php");
}

$iduser = $_SESSION['id_usuario'];
$sql = "SELECT idusuarios, Nombre FROM usuarios WHERE idusuarios = '$iduser'";
//$sql = "SELECT * FROM Usuarios";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();

?>

<!DOCTYPE html>

<html lang="es">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Sistema - Panel Principal</title>
        <link rel="stylesheet" href="../assets/css/buscador.css">
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
		<?php require_once("encabeza.php"); ?>

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
								
							
							<!-- PAGE CONTENT BEGINS -->
                           
                               
                                <!-- Agregamos un campo de búsqueda -->
                                <?php
                            if ($user_q['rol']=='Administrador' || $user_q['rol']=='Coordinador'){
                                echo "<script>

                            window.location='buscador.php';
                                    </script>";

                        }
                                if (session_status() !== PHP_SESSION_ACTIVE) {
                                    session_start();
                                }
                                include '../loginphp/conexion.php';

                                $table = 'datos_exceldatos1_1714747072';
                                $query = "SELECT *, id AS editable_id FROM `{$table}`";

                                // Verifica si se ha proporcionado un término de búsqueda
                                if (!empty($_GET['search'])) {
                                    $searchTerm = "%" . $_GET['search'] . "%";
                                    $query .= " WHERE `CODIGO DE FICHA` LIKE ? OR 
                                                `NIVEL DE FORMACION` LIKE ? OR 
                                                `NOMBRE_RESPONSABLE` LIKE ? OR 
                                                `FECHA_INICIO_FICHA` LIKE ? OR
                                                `FECHA_TERMINACION_FICHA` LIKE ? OR
                                                `MODALIDAD` LIKE ? OR
                                                `NOMBRE_PROGRAMA_FORMACION` LIKE ? OR
                                                `NOMBRE_MUNICIPIO_CURSO` LIKE ? OR
                                                `TOTAL_APRENDICES_ACTIVOS` LIKE ? OR
                                                `FECHA TERMINACIÓN E.LECTIVA` LIKE ? OR
                                                `FECHA TERM. E.PRODUCTIVA Y LEG.MATRICULA` LIKE ? OR
                                                `FECHA LIMITE PARA INICIO DE ETAPA PRODUCTIVA` LIKE ? OR
                                                `INSTRUCTOR_SEGUIMIENTO_ACTUAL` LIKE ? OR
                                                `Correo_Instructor` LIKE ? OR
                                                `INSTRUCTOR_ANTERIOR` LIKE ? OR
                                                `CORREO` LIKE ?";
                                    $stmt = $conexion->prepare($query);
                                    $stmt->bind_param('ssssssssssssssss', $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm);
                                } else {
                                    $stmt = $conexion->prepare($query);
                                }

                                $stmt->execute();
                                $result = $stmt->get_result();
                                ?>

                                <table id='dataTable'>
                                    <thead>
                                        <tr>
                                        <?php
                                        $columnsResult = $conexion->query("SHOW COLUMNS FROM `{$table}`");
                                        $columns = [];
                                        while ($column = $columnsResult->fetch_assoc()) {
                                            $columns[] = $column['Field'];
                                            echo "<th>{$column['Field']}</th>";
                                        }
                                        ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        foreach ($columns as $column) {
                                            $value = isset($row[$column]) ? $row[$column] : ''; 
                                            echo "<td>$value</td>";
                                        }
                                        echo "</tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <?php
                                if (!empty($_SESSION['username'])) {
                                    $nombre_responsable = $_SESSION['username'];
                                    $stmt = $conexion->prepare("SELECT COUNT(*) AS count FROM `{$table}` WHERE `NOMBRE_RESPONSABLE` = ?");
                                    $stmt->bind_param('s', $nombre_responsable);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $count = $result->fetch_assoc()['count'];

                                    if ($count > 0) {
                                        echo "<form action='ver_fichas.php' method='post'>";
                                        echo "<input type='hidden' name='nombre_responsable' value='$nombre_responsable'>";
                                        echo "<button type='submit' class='custom-button'>Ver Mis Fichas</button>"; // Añade la clase custom-button aquí
                                        echo "</form>";
                                    }
                                }
                                ?>
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
                                        <script src="../assets/datatables/revisar.js"></script>

                                        
                                    </body>
                                </html>
