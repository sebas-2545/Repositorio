<?php
include ("../loginphp/conexion.php");
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location:../loginphp/index.php");
    exit();
}

require_once 'validaterol.php';
$iduser = $_SESSION['id_usuario'];
$sql = "SELECT idusuarios, Nombre FROM usuarios WHERE idusuarios = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param('i', $iduser);
$stmt->execute();
$resultado = $stmt->get_result();
$row = $resultado->fetch_assoc();

if ($row) {
    $_SESSION['username'] = $row['Nombre'];
}
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
            try { ace.settings.check('main-container','fixed') } catch (e) {}
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
                </div>

                <div class="page-content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->
                            <style>
                                .fixed-columns thead th:nth-child(1),
                                .fixed-columns tbody td:nth-child(1),
                                .fixed-columns thead tr:first-child th:nth-child(1) {
                                    position: sticky;
                                    left: 0;
                                    z-index: 1;
                                    background-color: #fff; /* Ajusta el color de fondo según sea necesario */
                                }

                                .fixed-columns thead th:nth-child(1),
                                .fixed-columns tbody td:nth-child(1) {
                                    /* Ancho de la primera columna */
                                }

                                /* Resto de estilos */
                                table {
                                    border-collapse: collapse;
                                    width: 100%;
                                }
                                
                                th, td {
                                    border: 1px solid #dddddd;
                                    text-align: left;
                                    padding: 8px;
                                }
                                
                                th {
                                    background-color: #f2f2f2; /* Color de fondo para las celdas de encabezado */
                                }
                            </style>
                            <?php
                            if ($user_q['rol']=='Administrador' || $user_q['rol']=='Coordinador'){
                                echo "<script>

                            window.location='news.php';
                                    </script>";

                        }
                        ?>
                            <div class="container">
                                <?php
                                // Incluir archivo de conexión a la base de datos
                                include '../loginphp/conexion.php';

                                // Verificar si se ha enviado el nombre del responsable desde el formulario
                                if (isset($_SESSION['username'])) {
                                    $nombre_responsable = $_SESSION['username'];

                                    // Consulta para obtener las fichas asociadas al nombre del responsable
                                    $query = "SELECT * FROM `fichas` WHERE `INSTRUCTOR_SEGUIMIENTO_ACTUAL` = ?";
                                    $stmt = $conexion->prepare($query);
                                    $stmt->bind_param('s', $nombre_responsable);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    // Mostrar resultados en una tabla
                                    echo "<h2>Fichas asignadas a $nombre_responsable</h2>";
                                    echo "<table id='dataTable' class='display fixed-columns'>";
                                    echo "<thead><tr><th>CODIGO DE FICHA</th><th>NIVEL DE FORMACION</th><th>NOMBRE_RESPONSABLE</th><th>FECHA_INICIO_FICHA</th><th>FECHA_TERMINACION_FICHA</th><th>MODALIDAD</th><th>NOMBRE_PROGRAMA_FORMACION</th><th>NOMBRE_MUNICIPIO_CURSO</th><th>TOTAL_APRENDICES_ACTIVOS</th><th>FECHA TERMINACIÓN E.LECTIVA</th><th>FECHA TERM. E.PRODUCTIVA Y LEG.MATRICULA</th><th>FECHA LIMITE PARA INICIO DE ETAPA PRODUCTIVA</th><th>INSTRUCTOR_SEGUIMIENTO_ACTUAL</th><th>Correo_Instructor</th><th>INSTRUCTOR_ANTERIOR</th><th>CORREO</th><th>CELULAR</th><th>Coordinador</th><th>Aprendices Activos</th><th>Registro en Sofía Plus</th><th>CARPETA CREADA DE LA FICHA</th><th>CREAR CARPETA OTROS POR CADA FICHA</th><th>REPORTE F165 DE TODOS EN LA CARPETA OTROS</th><th>Reporte Aprendices en la carpeta Otros</th><th>JUICIOS EVALUATIVOS ACTUALIZADOS EN LA CARPETA OTROS</th><th>ACTA MOMENTO1 EN LA CARPETA OTROS</th><th>ACTA MOMENTO2 EN LA CARPETA OTROS</th><th>ACTA DE CIERRE DE LA FICHA EN LA CARPETA OTROS</th><th>DOCUMENTO PDF DE ANUNCIOS EN LA CARPETA OTROS</th><th>DOCUMENTO PDF DE CORREO DESERCIONES EN LA CARPETA OTROS</th><th>ESTRUCTURADELODOCUMENTOSCONLOSNUMEROS Y NOMBRES DE CADA APRENDIZ</th><th>ESTADO</th><th>FECHA_MOMENTO_UNO</th><th>FECHA_MOMENTO_DOS</th><th>FECHA_MOMENTO_TRES</th><th>ACCIONES</th></tr></thead>
                                    <tbody>";

                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['CODIGO DE FICHA'] . "</td>";
                                        echo "<td>" . $row['NIVEL DE FORMACION'] . "</td>";
                                        echo "<td>" . $row['NOMBRE_RESPONSABLE'] . "</td>";
                                        echo "<td>" . $row['FECHA_INICIO_FICHA'] . "</td>";
                                        echo "<td>" . $row['FECHA_TERMINACION_FICHA'] . "</td>";
                                        echo "<td>" . $row['MODALIDAD'] . "</td>";
                                        echo "<td>" . $row['NOMBRE_PROGRAMA_FORMACION'] . "</td>";
                                        echo "<td>" . $row['NOMBRE_MUNICIPIO_CURSO'] . "</td>";
                                        echo "<td>" . $row['TOTAL_APRENDICES_ACTIVOS'] . "</td>";
                                        echo "<td>" . $row['FECHA TERMINACIÓN E.LECTIVA'] . "</td>";
                                        echo "<td>" . $row['FECHA TERM. E.PRODUCTIVA Y LEG.MATRICULA'] . "</td>";
                                        echo "<td>" . $row['FECHA LIMITE PARA INICIO DE ETAPA PRODUCTIVA'] . "</td>";
                                        echo "<td>" . $row['INSTRUCTOR_SEGUIMIENTO_ACTUAL'] . "</td>";
                                        echo "<td>" . $row['Correo_Instructor'] . "</td>";
                                        echo "<td>" . $row['INSTRUCTOR_ANTERIOR'] . "</td>";
                                        echo "<td>" . $row['CORREO'] . "</td>";
                                        echo "<td>" . $row['CELULAR'] . "</td>";
                                        echo "<td>" . $row['Coordinador'] . "</td>";
                                        echo "<td>" . $row['Aprendices Activos'] . "</td>";
                                        echo "<td>" . $row['Registro en Sofía Plus'] . "</td>";
                                        echo "<td>" . $row['CARPETA CREADA DE LA FICHA'] . "</td>";
                                        echo "<td>" . $row['CREAR CARPETA OTROS POR CADA FICHA'] . "</td>";
                                        echo "<td>" . $row['REPORTE F165 DE TODOS EN LA CARPETA OTROS'] . "</td>";
                                        echo "<td>" . $row['Reporte Aprendices en la carpeta Otros'] . "</td>";
                                        echo "<td>" . $row['JUICIOS EVALUATIVOS ACTUALIZADOS EN LA CARPETA OTROS'] . "</td>";
                                        echo "<td>" . $row['ACTA MOMENTO1 EN LA CARPETA OTROS'] . "</td>";
                                        echo "<td>" . $row['ACTA MOMENTO2 EN LA CARPETA OTROS'] . "</td>";
                                        echo "<td>" . $row['ACTA DE CIERRE DE LA FICHA EN LA CARPETA OTROS'] . "</td>";
                                        echo "<td>" . $row['DOCUMENTO PDF DE ANUNCIOS EN LA CARPETA OTROS'] . "</td>";
                                        echo "<td>" . $row['DOCUMENTO PDF DE CORREO DESERCIONES EN LA CARPETA OTROS'] . "</td>";
                                        echo "<td>" . $row['ESTRUCTURADELODOCUMENTOSCONLOSNUMEROS Y NOMBRES DE CADA APRENDIZ'] . "</td>";
                                        echo "<td>" . $row['ESTADO'] . "</td>";
                                        echo "<td><input type='date' name='fecha_momento_uno[" . $row['id'] . "]' value='" . $row['FECHA_MOMENTO_UNO'] . "'></td>";
                                        echo "<td><input type='date' name='fecha_momento_dos[" . $row['id'] . "]' value='" . $row['FECHA_MOMENTO_DOS'] . "'></td>";
                                        echo "<td><input type='date' name='fecha_momento_tres[" . $row['id'] . "]' value='" . $row['FECHA_MOMENTO_TRES'] . "'></td>";
                                        echo "<td>";
                                        echo "<form action='../Asignaciones/actualizar_cumple.php' method='post'>";
                                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                                        echo "<select name='ESTADO'>";
                                        echo "<option value='ABIERTO'" . ($row['ESTADO'] === 'ABIERTO' ? ' selected' : '') . ">ABIERTO</option>";
                                        echo "<option value='CERRADO'" . ($row['ESTADO'] === 'CERRADO' ? ' selected' : '') . ">CERRADO</option>";
                                        echo "</select>";
                                        echo "<input type='submit' value='Guardar'>";
                                        echo "</form>";
                                        echo "</td>";
                                        echo "</tr>";
                                        
                                    }

                                    echo "</tbody></table>";
                                    // Botón de regreso
                                } else {
                                    echo "No se ha proporcionado el nombre del responsable.";
                                }
                                ?>
                            </div>
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
