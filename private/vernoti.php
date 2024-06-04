<?php
// Check existence of id parameter before processing further
include ("../loginphp/conexion.php");
session_start();
if (!isset($_SESSION['id_usuario'])){
	header("Location:../loginphp/index.php");
}
require_once 'validaterol.php';
$iduser = $_SESSION['id_usuario'];

$sq="SELECT * FROM noticias";
$resulta = $conexion->query($sq);

$sql = "SELECT * FROM usuarios WHERE idusuarios = '$iduser'";
//$sql = "SELECT * FROM Usuarios";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();
//$user_q['rol'];
?>



<!DOCTYPE html>
<html lang="en">
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
    <link href="../assets/css/noticia.css" rel="stylesheet">

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
								
							
								<!-- CONTENIDO PAGINA-->
                                 <H3>APRENDICES SENA</H3>
                                  <div class="fil">
								  <?php while ($ro = $resulta->fetch_assoc()) { ?>

                                        <div class="card">
                                            <div class="header">
                                                <div>
                                                <p class="title" >
												<?php echo $ro['Titulo']; ?>
                                                </p>
                                                <p class="name"><?php echo $ro['Empresa']; ?></p>
                                                </div>
                                                <span class="image"></span>
                                            </div>
                                                <p class="description">
												<?php echo $ro['Mensaje']; ?>
                                                </p>
											<span class="read-more">Ver más</span>
 

                                            <dl class="post-info">

                                                <div class="cr">
                                                <dt class="dt">Correo: <?php echo $ro['Correo']; ?></dt>
                                                <dd class="dd"><?php echo $ro['Fecha']; ?></dd>
                                             </div>
                                                
                                                
                                            
                                            </dl>
                                            <a href="notiedi.php?id=<?php echo $ro['id']; ?>" class="btn edit">
                            <i class="fa fa-pencil"></i> Editar
                        </a>
                        <a href="../assets/controller/ControllerDeleteNoti.php?id=<?php echo $ro['id']; ?>" class="btn delete" onclick="return confirmDelete();">
    <i class="fa fa-trash"></i> Eliminar
</a>

<script>
function confirmDelete() {
    return confirm('¿Estás seguro de que deseas eliminar esta noticia?');
}
</script>
                                        </div>
									<?php }?>
                                        
									</div>

                                    </div>


                            <!-- FIN CONTENIDO PAGINA -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once("piedepagina.php"); ?>
        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>
    </div>
	<script>
        document.addEventListener('DOMContentLoaded', () => {
            const readMoreButtons = document.querySelectorAll('.read-more');
            readMoreButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    const description = e.target.previousElementSibling;
                    if (description.classList.contains('expanded')) {
                        description.classList.remove('expanded');
                        e.target.textContent = 'Ver más';
                    } else {
                        description.classList.add('expanded');
                        e.target.textContent = 'Ver menos';
                    }
                });
            });
        });
    </script>
    <script src="../assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript">
        if ('ontouchstart' in document.documentElement) document.write("<script src='../../assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
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
</body>
</html>
