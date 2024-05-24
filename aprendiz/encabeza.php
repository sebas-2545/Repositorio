<?php
include ("../loginphp/conexion.php");
//session_start();
if (!isset($_SESSION['cedula'])){
	header("Location:../loginphp/index.php");
}
$iduser = $_SESSION['cedula'];

?>

<div id="navbar" class="navbar navbar-default          ace-save-state">
			
			<div class="navbar-container ace-save-state" id="navbar-container">	
				<!-- Mostrar menu con cambio de tamaño-->
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>
				<!-- Encabezado-->
				<div class="navbar-header pull-left">
					<a href="admin.php" class="navbar-brand">
						<small>
						<i class="bi bi-person-add"></i>
						..:: Sistema de Etapa Productiva ::..
						</small>
					</a>
				</div>
				<!-- Encabezado lado derecho-->
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<!-- iconos de actividades
						<li class="purple dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bell icon-animated-bell"></i>
								<span class="badge badge-important">1</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-exclamation-triangle"></i>
									1 No entrego la actividad SENA
								</li>

								
							</ul>
						</li>

						<li class="green dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-graduation-cap icon-animated-vertical"></i>
								<span class="badge badge-success">8</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-graduation-cap"></i>
									8 Actividaddes 
								</li>


								<li class="dropdown-footer">
									<a href="http:/www.jhonvaquiro.com">
										Ver Actividades
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li> -->

						<li class="green dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="../assets/images/avatars/avatar4.png"  />
								<span class="user-info">
									<small>Bienvenid@ Aprendiz</small>
									<!-- Mostrar Nombre del Usuario Logueado-->
								</span>
								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<!-- <a href="perfil.php?id=<?php echo $row['idusuarios'] ?>">-->
									<a href="#"></a>
										<i class="ace-icon fa fa-user"></i>
										Perfil
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="../loginphp/salir.php">
										<i class="ace-icon fa fa-power-off"></i>
										Salir
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>