<?php
require 'loginphp/conexion.php';

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
		<title>Sistema - Panel Principal</title>
		<link rel="shortcut icon" href="assets/etapa/icono.ico" type="image/x-icon">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
		<meta name="description" content="TYT PRUEBAS" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/datatables/datatables.css" />
		<link href="assets/css/hebbo.css" rel="stylesheet">
		<link href="assets/css/tyt.css" rel="stylesheet">

		<link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<script src="assets/js/ace-extra.min.js"></script>
 <style>
            .video{
               text-align: center;


}
@media screen and (max-width: 600px) { 
    .video iframe{
        width: 80%;
        height: 200px;
    }
    .video video{
        width: 80%;
        height: 200px;
    }
    .video{
         text-align: center;
         font-size: 8px;

    }
     .video h3{
       
         font-size: 13px;

    }
}
        </style>
	</head>

	<body class="no-skin">
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
						..:: PRUEBAS TYT::..
						</small>
					</a>
				</div>
			<!-- Encabezado lado derecho-->
				
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>
			<!-- Barra Lateral  botones color verde btn-success azul btn-info rojo btn-danger amarillo btn-warning-->
			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

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
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list"><!-- Menu Lateral -->
				
				<!-- MOSTRAR EL MENU  -->
				<?php require_once("menulateral.php"); ?>
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="index.php">Home</a>
							</li>
							<li class="active">Escritorio</li>
						</ul><!-- /.breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Buscar ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->
					</div>

					<div class="page-content">

						<div class="page-header">
							<h1>
								Escritorio
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>

								</small>
							</h1>

							<h2> Validación de Datos de las Pruebas TYT</h2>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- CONTENIDO PAGINA-->
								<div class="container">
                                    <form action="TyT.php" method="POST">
                                        <div class="form-group">
                                            <label for="cedula">Numero de Cedula</label>
                                            <input type="number" id="cedula" name="DNI" required>
                                            <input type="submit" value="Consultar">
                                        </div>
                                    </form>
                                    <div class="form-group4">
                                        <label for="nombre">Nombres y Apellidos</label>
                                        <p id="nombre" name="nombre">
                                            <?php if($displayData) { echo $r['PrimerApellido'] . " " . $r['SegundoApellido'] . " " . $r['PrimerNombre'] . " " . $r['OtrosNombres']; } ?>
                                        </p>
                                    </div>
                                    <div class="row">
                                        <div class="column">
                                            <div class="form-group2">
                                                <label for="ficha">Ficha</label>
                                                <p id="ficha" name="ficha"><?php if($displayData) { echo $r['ficha']; } ?></p>
                                            </div>
                                            <div class="form-group2">
                                                <label for="fecha_inicio">Fecha de Inicio</label>
                                                <p id="fecha_inicio" name="Fechainicio"><?php if($displayData) { echo $r['Fechainicio']; } ?></p>
                                            </div>
                                            <div class="form-group2">
                                                <label for="resultados_aprobados">Resultados Aprobados</label>
                                                <p id="resultados_aprobados" name="ResultadosAprobados"><?php if($displayData) { echo $r['ResultadosAprobados']; } ?></p>
                                            </div>
                                            <div class="form-group2">
                                                <label for="prueba_icfes">Prueba Icfes Realizada</label>
                                                <p id="prueba_icfes" name="SNPRegistradaEnSOFIAPlus"><?php if($displayData) { echo $r['SNPRegistradaEnSOFIAPlus']; } ?></p>
                                            </div>
                                            <div class="form-group2">
                                                <label for="estado_bd">Estado BD Definitivo</label>
                                                <p id="estado_bd" name="EstadoSENABDPreliminar"><?php if($displayData) { echo $r['EstadoSENABDPreliminar']; } ?></p>
                                            </div>
                                            <div class="form-group2">
                                                <label for="responsable_pago">Responsable Pago </label>
                                                <p id="responsable_pago" name="ResponsablePagoBDPreliminar"><?php
if ($displayData) {
    if ($r['ResponsablePagoBDPreliminar'] == "CANDIDATO A BENEFICIO") {
        echo "CANDIDATO A BENEFICIO SENA";
    } else {
        echo $r['ResponsablePagoBDPreliminar'];
    }
}
?></p>
                                            </div>
                                        </div>
                                        <div class="column1">
                                            <div class="form-group3">
                                                <label for="fecha_fin">Fecha Fin Ficha</label>
                                                <p id="fecha_fin" name="FechaFinFicha"><?php if($displayData) { echo $r['FechaFinFicha']; } ?></p>
                                            </div>
                                            <div class="form-group3">
                                                <label for="resultados_requeridos">Resultados Requeridos</label>
                                                <p id="resultados_requeridos" name="ResulatadoRequeridos"><?php if($displayData) { echo $r['ResulatadoRequeridos']; } ?></p>
                                            </div>
                                            <div class="form-group3">
                                                <label for="fecha_presentacion">Fecha de Presentacion</label>
                                                <p id="fecha_presentacion" name="FechaPresentaci�nDelSNP"><?php if($displayData) { echo $r['FechaPresentacionDelSNP']; } ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group1">
                                        <label for="observacion_bd">Observacion BD</label>
                                        <p id="observacion_bd" name="ObservacionesBDPreliminar"><?php if($displayData) { echo $r['ObservacionesBDPreliminar']; } ?></p>
                                    </div>
                                </div>
                                <div class="video">
                                                                       <h3>Informacion de tyt</h3>
								<iframe width="460" height="400" src="https://www.youtube.com/embed/uIwjoFvpZEs" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                     <h3>Registro de prueba de tyt</h3>
                                    <video width="460" height="400" controls  poster="https://www.etitc.edu.co/uploads/images/products/601b29543b33d974817907.jpg">
                                    <source src="uploads/VideoTYT.mp4" type="video/mp4">
                                </video>
                                
                                      
								</div>

								<!-- FIN CONTENIDO PAGINA -->
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

		<script src="assets/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/jquery-ui.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="assets/js/jquery.easypiechart.min.js"></script>
		<script src="assets/js/jquery.sparkline.index.min.js"></script>
		<script src="assets/js/jquery.flot.min.js"></script>
		<script src="assets/js/jquery.flot.pie.min.js"></script>
		<script src="assets/js/jquery.flot.resize.min.js"></script>
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>


	</body>
</html>