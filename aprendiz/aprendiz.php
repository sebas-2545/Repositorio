<?php
include ("../loginphp/conexion.php");
session_start();

if(isset($_SESSION['cedula'])){
    $cedula=$_SESSION['cedula'];
    $id_rol= $_SESSION['id_rol'];
    $use="SELECT * FROM user WHERE cedula='$cedula'";
    $res=$conexion->query($use);
    $row=$res->fetch_assoc();
     $id=$row['id'];

    $eta="SELECT * FROM registroetapaproductiva where id_user='$id'";
    $ress=$conexion->query($eta);
    $r=$ress->fetch_assoc();
	$te=$r['Id'];

	$url='.../assets/controller/Controllerpdf.php?id='.$te;

    if($id_rol!=5){
        header("Location:  ../loginphp/loginAprendiz.php");
    }

}else{
    header("Location:  ../loginphp/loginAprendiz.php");
    exit();
}
?>

<!DOCTYPE html>

<html lang="es">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Sistema - Panel Principal</title>
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
								<a href="aprendiz.php">Inicio</a>
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

								<div class="page-header clearfix">
                       			 <h2 class="pull-left">Bienvenido al Sistema <?php echo "Aprendiz"; ?></h2>
                    			</div>

<div class="row">
									<div class="space-6"></div>
									

									<a href="<?php if($ress->num_rows>0){ echo'editar.php'; } else {echo 'inscribir.php';}?> ">
									   <div class="col-sm-7 infobox-container">
										<div class="infobox infobox-green">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-book" style="padding-top:2px"></i>
											</div>
                                           
											<div class="infobox-data">
												<span class="infobox-data-number"><?php //echo $usercount_count; ?></span>
												<div class="infobox-content"> <?php if($ress->num_rows>0){ echo "Editar Registro De etapa Productiva"; } else {echo 'Resgitrar etapa productiva';}?></div>
											</div>

										</div>
									</a>
									
										<a href="<?php echo '../assets/controller/Controllerpdf.php?id='.$te; ?>">
										<div class="infobox infobox-blue">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-newspaper-o" style="padding-top:2px"></i>
											</div>
											<div class="infobox-data">
												<span class="infobox-data-number"><?php //echo $newscount_count; ?></span>
												<div class="infobox-content">PDF</div>
											</div>
										</div>
										</a>
									
										

										<div class="space-6"></div>
									</div>

									<div class="vspace-12-sm"></div>
								</div>



								
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
			
			<?php require_once("piedepagina.php"); ?>
			<!-- /.Pie de pagina -->
			
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
