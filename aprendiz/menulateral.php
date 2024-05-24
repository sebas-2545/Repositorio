<?php
include ("../loginphp/conexion.php");
//session_start();
if (!isset($_SESSION['cedula'])){
	header("Location:../loginphp/index.php");
}
$iduser = $_SESSION['cedula'];
//$sql = "SELECT idusuarios, Nombre FROM usuarios WHERE idusuarios = '$iduser'";
$sql = "SELECT u.idusuarios, u.Nombre, r.nombre as rol FROM usuarios u left join roles r on u.rol_id=r.id WHERE idusuarios = '$iduser'";
$stmt = $conexion->query($sql);
$user_q = $stmt->fetch_assoc();
$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
?>




			<!-- Barra Lateral  botones color verde btn-success azul btn-info rojo btn-danger amarillo btn-warning-->
		<div id="sidebar" class="sidebar responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar', 'fixed')}catch(e){}
				</script>
				<!--
				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-book"></i>
						</button>

						<button class="btn btn-success">
							<i class="ace-icon fa fa-bar-chart"></i>
						</button>

						<button class="btn btn-success">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-success">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div> /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li <?php if (strpos($url,'admin.php') !== false) {echo 'class="active"';}?> >
						<a href="admin.php">
							<i class="menu-icon"><i class="fa fa-book"></i></i>
							<span class="menu-text">Panel de Inicio</span>
						</a>

						<b class="arrow"></b>
					</li>
					
					
					
					
					
					<li <?php if (strpos($url,'news') !== false) {echo 'class="active"';}?>>
						<a href="news.php" class="dropdown-toggle">
							<i class="menu-icon"><i class="fa fa-newspaper-o"></i></i>
							<span class="menu-text"> Asignaciones </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li <?php if (strpos($url,'newsadd.php') !== false) {echo 'class="active"';}?>>
								<a href=".php">
									<i class="menu-icon"></i><i class="fa fa-caret-right"></i>
									 Registrar Etapa Productiva
								</a>

								<b class="arrow"></b>
							</li>

							<li <?php if (strpos($url,'news.php') !== false) {echo 'class="active"';} if (strpos($url,'newsedit.php') !== false) {echo 'class="active"';}?> >
								<a href="news.php">
									<i class="menu-icon"></i><i class="fa fa-caret-right"></i>
									Editar Etapa productiva
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
															
					<li <?php if (strpos($url,'catalog_refresh.php') !== false) {echo 'class="active"';} if (strpos($url,'catalog_badges') !== false) {echo 'class="active"';}?>>
						<a href="catalog_badges.php" class="dropdown-toggle">
							<i class="menu-icon"><i class="fa fa-shopping-cart"></i></i>
							<span class="menu-text"> Consultas </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li <?php  if (strpos($url,'catalog_badges') !== false) {echo 'class="active"';}?>>
								<a href="catalog_badges.php">
									<i class="menu-icon"></i><i class="fa fa-caret-right"></i>
									Pruebas TYT
								</a>

								<b class="arrow"></b>
							</li>
							<li <?php  if (strpos($url,'catalog_refresh.php') !== false) {echo 'class="active"';}?>>
								<a href="catalog_refresh.php">
									<i class="menu-icon"></i><i class="fa fa-caret-right"></i>
									ARL
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
						
						
					<li <?php if (strpos($url,'roomedit.php') !== false) {echo 'class="active"';} if (strpos($url,'rooms.php') !== false) {echo 'class="active"';}?>>
						<a href="rooms.php" class="dropdown-toggle">
							<i class="menu-icon"><i class="fa fa-key"></i></i>
							<span class="menu-text"> Aprendices </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li <?php if (strpos($url,'roomedit.php') !== false) {echo 'class="active"';} if (strpos($url,'rooms.php') !== false) {echo 'class="active"';}?>>
								<a href="rooms.php">
									<i class="menu-icon"></i><i class="fa fa-caret-right"></i>
									Mis aprendices
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
					<li <?php if (strpos($url,'badge_texts.php') !== false) {echo 'class="active"';} if (strpos($url,'badge_texts_search.php') !== false) {echo 'class="active"';} if (strpos($url,'badge_upload.php') !== false) {echo 'class="active"';} if (strpos($url,'badge_texts_add.php') !== false) {echo 'class="active"';}?>>
						<a href="badge_texts.php" class="dropdown-toggle">
							<i class="menu-icon"><i class="fa fa-asterisk"></i></i>
							<span class="menu-text"> Ayudas </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li <?php if (strpos($url,'badge_upload.php') !== false) {echo 'class="active"';} if (strpos($url,'badge_texts_add.php') !== false) {echo 'class="active"';}?>>
								<a href="badge_upload.php">
									<i class="menu-icon"></i><i class="fa fa-caret-right"></i>
									Subir Nueva Placa
								</a>

								<b class="arrow"></b>
							</li>
								<li <?php if (strpos($url,'badge_texts_search.php') !== false) {echo 'class="active"';} if (strpos($url,'badge_texts.php') !== false) {echo 'class="active"';}?>>
								<a href="badge_texts_search.php">
									<i class="menu-icon"></i><i class="fa fa-caret-right"></i>
									Editar Textos de Placa
								</a>

								<b class="arrow"></b>							
								</li>
						</ul>
					</li>
					
						
			</ul><!-- /.nav-list -->
			<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
			</div>	

			<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
			</script>			

		</div>



