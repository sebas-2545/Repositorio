<?php
include ("../loginphp/conexion.php");
session_start();
if (!isset($_SESSION['id_usuario'])){
	header("Location:../loginphp/index.php");
}
require_once 'validaterol.php';
$iduser = $_SESSION['id_usuario'];
$sql = "SELECT * FROM usuarios WHERE idusuarios = '$iduser'";
//$sql = "SELECT * FROM Usuarios";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
//$user_q['rol'];
?>

<!DOCTYPE html>

<html lang="es">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Instructores de Etapa Productiva - Sesion CC-<?php echo $row['Usuario']?></title>
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
							<li class="active">Instructores</li>
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

							<?php
							if ($user_q['rol']=='Administrador' || $user_q['rol']=='Coordinador'){
								echo "<a href='registrar.php' class='btn btn-success pull-right'>Agregar nuevo instructor</a>";
							}
							else{
								date_default_timezone_set('America/Bogota');
								$mañana = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
								echo "<h3 class='pull-right btn btn-success'>". date('d/m/Y', $mañana) ." </h3>";
							}
							?>

								<div class="page-header clearfix">
                       			 <h2 class="pull-left">Instructores de Etapa Productiva</h2>
                       			 
                    			</div>
								
				<?php
                    // Include config file
                    //require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM Usuarios";
                    if($result = mysqli_query($conexion, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped table-hover' id='dataTable' width='100%' cellspacing='5'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Fecha Registro</th>";
                                        echo "<th>Cedula</th>";
                                        echo "<th>Nombre</th>";
                                        echo "<th>Correo</th>";
                                        echo "<th>Celular</th>";
										echo "<th>Fecha Nacimiento</th>";
										echo "<th>Profesion</th>";
										echo "<th>Control</th>";
										
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
								
								if ($user_q['rol']=='Lector'){
									echo "<tr>";
                                        echo "<td>" . $row['FechaReg'] . "</td>";
                                        echo "<td>" . $row['Usuario'] . "</td>";
                                        echo "<td>" . $row['Nombre'] . "</td>";
                                        echo "<td>" . $row['Correo'] . "</td>";
										echo "<td>" . $row['Celular'] . "</td>";
										echo "<td>" . $row['FechaNacimiento'] . "</td>";
										echo "<td>" . $row['Profesion'] . "</td>";
                                        echo "<td><a><span>---</span></a></td>";
                                    echo "</tr>";



								}
								else{

                                	while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>". $row['FechaReg'] . "</td>";
                                        echo "<td>" . $row['Usuario'] . "</td>";
                                        echo "<td>" . $row['Nombre'] . "</td>";
                                        echo "<td>" . $row['Correo'] . "</td>";
										echo "<td>" . $row['Celular'] . "</td>";
										echo "<td>" . $row['FechaNacimiento'] . "</td>";
										echo "<td>" . $row['Profesion'] . "</td>";
                                        echo "<td>";
										if ($user_q['rol']=='Administrador'){
											echo "<a href='perfil.php?id=". $row['idusuarios'] ."' title='Ver' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
											echo "<a href='perfiledit.php?id=". $row['idusuarios'] ."' title='Actualizar' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='perfildel.php?id=". $row['idusuarios'] ."' title='Borrar' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
											echo "<span> ". $row['rol_id'] ."rol_ </span>";
											date_default_timezone_set('America/Bogota');
											$fecha_actual = new DateTime(date('Y-m-d'));
											$fecha_final = new DateTime($row['FechaNacimiento']);
											$dias = $fecha_actual->diff($fecha_final)->format('%r%a');
											$mes1 = $fecha_actual->diff($fecha_final)->days / 30.31;
											$anos = $fecha_actual->diff($fecha_final)->days / 365;
											$dato = floor($anos);
	
											// Si la fecha final es igual a la fecha actual o anterior
											
											if ($dias <0) {
												echo "<span align=center ><font color='#FF0000'>" . $dato . " años</font></span>";
											}
											elseif ($dias ==0){
												echo '<span align=center ><font color="#FF8C00">En proceso</font></span>';
											}
											if($dias >=1) {
												echo '<span align=center ><Font color="#3CB371">' . $dias . ' dias En tiempo </FONT></span>';
											}
										}
										else if ($user_q['rol']=='Coordinador'){
											echo "<a href='perfil.php?id=". $row['idusuarios'] ."' title='Ver' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
											echo "<a href='perfiledit.php?id=". $row['idusuarios'] ."' title='Actualizar' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='perfildel.php?id=". $row['idusuarios'] ."' title='Borrar' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
										}
										else if ($user_q['rol']=='Instructor' && $row['idusuarios']==$iduser){
											echo "<a href='perfiledit.php?id=". $row['idusuarios'] ."' title='Actualizar' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
										}
										else if ($user_q['rol']=='Instructor'){
											echo "<a href='perfil.php?id=". $row['idusuarios'] ."' title='Ver' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
										}
										else{
											echo "<a><span>---</span></a>";
										}
                                        echo "</td>";

                                    echo "</tr>";
                               		}
								}
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No encuentra resultados.</em></p>";
                        }
                    } else{
                        echo "ERROR: No permite ejecutar la $sql. " . mysqli_error($conexion);
                    }
 
                    // Close connection
                    //mysqli_close($link);
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
