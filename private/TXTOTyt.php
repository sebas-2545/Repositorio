<?php
// Check existence of id parameter before processing further
include("../loginphp/conexion.php");
session_start();
if (!isset($_SESSION['id_usuario'])){
    header("Location:../loginphp/index.php");
    exit();
}

require_once 'validaterol.php';
$iduser = $_SESSION['id_usuario'];
$sql = "SELECT * FROM usuarios WHERE idusuarios = '$iduser'";
$resultado = $conexion->query($sql);
$row = $resultado->fetch_assoc();


    $noti = "SELECT * FROM texto";
    $edino = $conexion->query($noti);
    $re = $edino->fetch_assoc();

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
    <link rel="stylesheet" href="../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="../assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="../assets/css/ace-rtl.min.css" />
    <script src="../assets/js/ace-extra.min.js"></script>
</head>

<body class="no-skin">
    <div id="navbar" class="navbar navbar-default ace-save-state">
        <div class="navbar-container ace-save-state" id="navbar-container">
            <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                <span class="sr-only">Toggle sidebar</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-header pull-left">
                <a href="admin.php" class="navbar-brand">
                    <small>
                        <i class="bi bi-person-add"></i>
                        ..:: Sistema de Etapa Productiva ::..
                    </small>
                </a>
            </div>
            <div class="navbar-buttons navbar-header pull-right" role="navigation">
                <ul class="nav ace-nav">
                    <a href="loginphp/loginAprendiz.php">
                        <button type="button" class="pull-right btn btn-success">
                            <i class="ace-icon fa fa-sign-in white bigger-110"></i>
                            <span class="bigger-110 white">INICIAR SESION</span>
                        </button>
                    </a>
                </ul>
            </div>
        </div>
    </div>

    <div class="main-container ace-save-state" id="main-container">
        <script type="text/javascript">
            try { ace.settings.loadState('main-container') } catch (e) { }
        </script>
        <div id="sidebar" class="sidebar responsive ace-save-state">
            <script type="text/javascript">
                try { ace.settings.loadState('sidebar') } catch (e) { }
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
            </div>
            <ul class="nav nav-list">
                <?php require_once("menulateral.php"); ?>
            </ul>
            <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state"
                   data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
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
                    </ul>
                    <div class="nav-search" id="nav-search">
                        <form class="form-search">
                            <span class="input-icon">
                                <input type="text" placeholder="Buscar ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                                <i class="ace-icon fa fa-search nav-search-icon"></i>
                            </span>
                        </form>
                    </div>
                </div>

                <div class="page-content">
                    <div class="page-header">
                        <h1>
                            Escritorio
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                            </small>
                        </h1>
                        <h2>BIENVENIDO AL SISTEMA</h2>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- CONTENIDO PAGINA-->
                            <div class="container">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Editar Título</h3>
                                    </div>
                                    <div class="panel-body">
                                        <form action="../assets/controller/Controllereditxto.php" method="post">
                                            <div class="form-group">
                                                <label for="titulo">Título:</label>
                                                <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo $re['Calendario']; ?>" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                        </form>
                                    </div>
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