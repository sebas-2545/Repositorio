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
				<?php require_once("menulateral.php"); ?>
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
                                        <style>
                                            
                                            .botoness {
                                                margin-bottom: 10px;
                                            }
                                            .dataTables_length{
                                                display: none;
                                            }
                                            select {
                                                font-size: 9px; /* Cambia el tamaño de la fuente en el select */
                                                padding: 2px 4px; /* Ajusta el padding para reducir el tamaño */
                                            }

                                            /* Estilos para las opciones */
                                            select option {
                                                font-size: 12px; /* Cambia el tamaño de la fuente en las opciones */
                                                padding: 2px 4px; /* Ajusta el padding para reducir el tamaño */
                                            }
                                            form{
                                                display: flex;
                                                flex-wrap: wrap;
                                                justify-content: center;
                                            }
                                        </style>
                                        <div class="botoness">
                                            <form action="../Asignaciones/inicio.php" method="post">
                                                <button type="submit">Cargar Los Datos Excel</button>
                                            </form>
                                        </div>
                                        <?php
                                    if (session_status() !== PHP_SESSION_ACTIVE) {
                                        session_start();
                                    }

                                   

                                    $table = 'datos_exceldatos1_1714747072';
                                    $query = "SELECT *, id AS editable_id FROM `{$table}`";


                                    if (!empty($_GET['search'])) {
                                        $searchTerm = "%" . $_GET['search'] . "%";
                                        $query .= " WHERE `CODIGO DE FICHA` LIKE :search OR 
                                                    `NIVEL DE FORMACION` LIKE :search OR 
                                                    `NOMBRE_RESPONSABLE` LIKE :search OR 
                                                    `FECHA_INICIO_FICHA` LIKE :search OR
                                                    `FECHA_TERMINACION_FICHA` LIKE :search OR
                                                    `MODALIDAD` LIKE :search OR
                                                    `NOMBRE_PROGRAMA_FORMACION` LIKE :search OR
                                                    `NOMBRE_MUNICIPIO_CURSO` LIKE :search OR
                                                    `TOTAL_APRENDICES_ACTIVOS` LIKE :search OR
                                                    `FECHA TERMINACIÓN E.LECTIVA` LIKE :search OR
                                                    `FECHA TERM. E.PRODUCTIVA Y LEG.MATRICULA` LIKE :search OR
                                                    `FECHA LIMITE PARA INICIO DE ETAPA PRODUCTIVA` LIKE :search OR
                                                    `INSTRUCTOR_SEGUIMIENTO_ACTUAL` LIKE :search OR
                                                    `Correo_Instructor` LIKE :search OR
                                                    `INSTRUCTOR_ANTERIOR` LIKE :search OR
                                                    `CORREO` LIKE :search";
                                        $stmt = $conexion->prepare($query);
                                        $stmt->bind_param('ssssssssssssssss', $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm);
                                    } else {
                                    $stmt = $conexion->prepare($query);
                                    }

                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $stmt->close();
                                    ?>

                                    <table id='dataTable'>
                                    <thead>
                                        <tr>
                                        <?php
                                        $columns = [];
                                        $columnsQuery = $conexion->query("SHOW COLUMNS FROM `{$table}`");
                                        while ($column = $columnsQuery->fetch_assoc()) {
                                            $columns[] = $column['Field'];
                                            echo "<th>{$column['Field']}</th>";
                                        }
                                        echo "<th>Editar El Estado</th>";
                                        echo "<th>Editar</th>"; // Nueva columna para el botón de edición
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
                                        echo "<td><form action='../Asignaciones/actualizar_cumple1.php' method='post'>";
                                        echo "<input type='hidden' name='id' value='{$row['editable_id']}'>";
                                        echo "<select class='con' name='ESTADO'>";
                                        echo "<option value='ABIERTO'" . ($row['ESTADO'] === 'abierto' ? ' selected' : '') . ">ABIERTO</option>";
                                        echo "<option value='CERRADO'" . ($row['ESTADO'] === 'cerrado' ? ' selected' : '') . ">CERRADO</option>";
                                        echo "</select>";
                                        echo "<input type='submit' class='act' value='Actualizar'>";
                                        echo "</form></td>";
                                        echo "<td><a href='../Asignaciones/editar.php?id=" . $row['editable_id'] . "'><button type='button'>Editar</button></a></td>"; // Enlace de edición
                                        echo "</tr>";
                                    }
                                    ?>
                                    </table>
                                    <?php
                                    if (!empty($_SESSION['username'])) {
                                        $nombre_responsable = $_SESSION['username'];
                                        $stmt = $conexion->prepare("SELECT COUNT(*) AS count FROM `{$table}` WHERE `NOMBRE_RESPONSABLE` = ?");
                                        $stmt->bind_param('s', $nombre_responsable);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $count = $result->fetch_assoc()['count'];
                                        $stmt->close(); // Cerrar la instrucción preparada

                                        if ($count > 0) {
                                            echo "<div>";
                                            echo "<form action='ver_fichas.php' method='post'>";
                                            echo "<input type='hidden' name='nombre_responsable' value='$nombre_responsable'></input>";
                                            echo "<button type='submit'>Ver Mis Fichas</button>";
                                            echo "</form>";
                                            echo "</div>";
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

