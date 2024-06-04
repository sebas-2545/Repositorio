<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require '../vendor/autoload.php';
include ("../loginphp/conexion.php");
use PhpOffice\PhpSpreadsheet\IOFactory;
use Carbon\Carbon;
$tableName = 'fichas';

if (isset($_POST['submit']) && isset($_FILES['fileToUpload'])) {
    $file = $_FILES['fileToUpload'];

    if ($file['error'] === 0 && $file['size'] > 0) {
        $allowedTypes = ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        if (in_array($file['type'], $allowedTypes)) {
            $destinationPath = "upl/uploads/" . basename($file['name']);
            
            if (move_uploaded_file($file['tmp_name'], $destinationPath)) {
                if (tableIsEmpty($conexion, $tableName)) {
                    importarDatos($destinationPath, $conexion);
                    echo "<script>alert('Datos importados con éxito en la tabla.'); window.location='inicio.php';</script>";
                } else {
                    if (compararDatos($destinationPath, $conexion, $tableName)) {
                        echo "<script>alert('Los datos ya existen en la base de datos.'); window.location='inicio.php';</script>";
                    } else {
                        actualizarDatos($destinationPath, $conexion, $tableName);
                    }
                }
            } else {
                echo "<script>alert('Error al mover el archivo a la ubicación deseada.'); window.location='inicio.php';</script>";
            }
        } else {
            echo "<script>alert('Error: El archivo seleccionado no es un Excel válido.'); window.location='inicio.php';</script>";
        }
    } else {
        echo "<script>alert('Error: No se ha podido cargar el archivo o el archivo está vacío.'); window.location='inicio.php';</script>";
    }
}


function tableIsEmpty($mysqli, $tableName) {
    $result = $mysqli->query("SELECT COUNT(*) FROM $tableName");
    $row = $result->fetch_row();
    return $row[0] == 0;
}

function importarDatos($archivoExcel, $pdo) {
    $documento = IOFactory::load($archivoExcel);
    $hojaExcel = $documento->getActiveSheet();
    $header = $hojaExcel->rangeToArray('A1:' . $hojaExcel->getHighestColumn() . '1', NULL, TRUE, FALSE)[0];
    
     // Initialize $indiceNivelFormacion, $indiceFechaInicio, and $indiceFechaTerminacion here
     
     $indiceFechaInicio = array_search('FECHA_INICIO_FICHA', $header);
     $indiceFechaTerminacion = array_search('FECHA_TERMINACION_FICHA', $header);
     $indiceFinEtapaElectiva = array_search('FECHA TERMINACIÓN E.LECTIVA', $header);
     $indiceFinPracticas = array_search('FECHA TERM. E.PRODUCTIVA Y LEG.MATRICULA', $header);
     $indiceFechaLimitePracticas = array_search('FECHA LIMITE PARA INICIO DE ETAPA PRODUCTIVA', $header);
     $indiceNivelFormacion = array_search('NIVEL DE FORMACION', $header);
     
 
    
    $tableName = 'fichas';
    $data = $hojaExcel->rangeToArray('A2:' . $hojaExcel->getHighestColumn() . $hojaExcel->getHighestRow(), NULL, TRUE, FALSE);
    $placeholders = array_fill(0, count($header), '?');
    $sql = "INSERT INTO `$tableName` (" . implode(', ', array_map(function($h) { return "`$h`"; }, $header)) . ") VALUES (" . implode(', ', $placeholders) . ")";
    $stmt = $pdo->prepare($sql);

    foreach ($data as $row) {
        $nivelFormacion = $row[$indiceNivelFormacion];
        // Convertir fechas de Excel a formato de fecha SQL antes de la inserción
        if (!empty($row[$indiceFechaInicio]) && is_numeric($row[$indiceFechaInicio])) {
            $dateTime = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[$indiceFechaInicio]);
            $row[$indiceFechaInicio] = $dateTime->format('Y-m-d');
        }
        if (!empty($row[$indiceFechaTerminacion]) && is_numeric($row[$indiceFechaTerminacion])) {
            $dateTime = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[$indiceFechaTerminacion]);
            $row[$indiceFechaTerminacion] = $dateTime->format('Y-m-d');
        }
        

        // Calcular y asignar las fechas calculadas
        if ($nivelFormacion == "TECNÓLOGO" || $nivelFormacion == "TÉCNICO"|| $nivelFormacion == "OPERARIO") {
            list($row[$indiceFinEtapaElectiva], $row[$indiceFinPracticas], $row[$indiceFechaLimitePracticas]) = calculateAdditionalDates(
                $row[$indiceFechaInicio], $row[$indiceFechaTerminacion], $nivelFormacion);
        } else {
            $row[$indiceFinEtapaElectiva] = null;
            $row[$indiceFinPracticas] = null;
            $row[$indiceFechaLimitePracticas] = null;
        }

        $stmt->execute($row);
    }
}

function actualizarDatos($archivoExcel, $pdo, $tableName) {
    $documento = IOFactory::load($archivoExcel);
    $hojaExcel = $documento->getActiveSheet();
    $header = $hojaExcel->rangeToArray('A1:' . $hojaExcel->getHighestColumn() . '1', NULL, TRUE, FALSE)[0];

    $data = $hojaExcel->rangeToArray('A2:' . $hojaExcel->getHighestColumn() . $hojaExcel->getHighestRow(), NULL, TRUE, FALSE);

    foreach ($data as $row) {
        // Convertir la fecha al formato adecuado
        $formattedRow = array_map(function($cell) {
            // Si el valor es una fecha válida, conviértelo al formato YYYY-MM-DD
            if (DateTime::createFromFormat('d-m-Y', $cell) !== false) {
                return DateTime::createFromFormat('d-m-Y', $cell)->format('Y-m-d');
            } else {
                // Si no es una fecha válida, deja el valor como está
                return $cell;
            }
        }, $row);

        // Aquí debemos ajustar las fechas según los índices correspondientes a las columnas de fecha
        $indiceFechaInicio = array_search('FECHA_INICIO_FICHA', $header);
        $indiceFechaTerminacion = array_search('FECHA_TERMINACION_FICHA', $header);

        if (!empty($formattedRow[$indiceFechaInicio]) && is_numeric($formattedRow[$indiceFechaInicio])) {
            $dateTime = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($formattedRow[$indiceFechaInicio]);
            $formattedRow[$indiceFechaInicio] = $dateTime->format('Y-m-d');
        }
        if (!empty($formattedRow[$indiceFechaTerminacion]) && is_numeric($formattedRow[$indiceFechaTerminacion])) {
            $dateTime = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($formattedRow[$indiceFechaTerminacion]);
            $formattedRow[$indiceFechaTerminacion] = $dateTime->format('Y-m-d');
        }

        $placeholders = array_fill(0, count($formattedRow), '?');
        $updatePlaceholders = array_map(function($h) { return "`$h` = VALUES(`$h`)"; }, $header);
        $sql = "INSERT INTO `$tableName` (`" . implode('`, `', $header) . "`) VALUES (" . implode(', ', $placeholders) . ")
                ON DUPLICATE KEY UPDATE " . implode(', ', $updatePlaceholders);

        $stmt = $pdo->prepare($sql);
        $stmt->execute($formattedRow);
    }

    // Agregar mensaje de éxito
    echo "<script>alert('Los datos se han actualizado con éxito.'); window.location='inicio.php';</script>";
}


function compararDatos($archivoExcel, $mysqli, $tableName) {
    $documento = IOFactory::load($archivoExcel);
    $hojaExcel = $documento->getActiveSheet();
    $excelHeader = $hojaExcel->rangeToArray('A1:' . $hojaExcel->getHighestColumn() . '1', NULL, TRUE, FALSE)[0];

    $columns = implode(', ', array_map(function($h) { return "`$h`"; }, $excelHeader));
    $sql = "SELECT $columns FROM `$tableName`";
    $result = $mysqli->query($sql);

    if (!$result) {
        die("Error al ejecutar la consulta: " . $mysqli->error);
    }

    $dbData = [];
    while ($row = $result->fetch_assoc()) {
        $dbData[] = $row;
    }

    $excelData = [];
    foreach ($hojaExcel->getRowIterator() as $rowIndex => $row) {
        if ($rowIndex > 1) {
            $rowData = [];
            foreach ($row->getCellIterator() as $cell) {
                $rowData[] = $cell->getValue();
            }
            $excelData[] = array_combine($excelHeader, $rowData);
        }
    }

    $excelDataMap = [];
    foreach ($excelData as $row) {
        $excelDataMap[$row['CODIGO DE FICHA']] = $row;
    }

    $dbDataMap = [];
    foreach ($dbData as $row) {
        $dbDataMap[$row['CODIGO DE FICHA']] = $row;
    }

    $newRows = array_diff_key($excelDataMap, $dbDataMap);
    $existingRows = array_intersect_key($excelDataMap, $dbDataMap);

    if (!empty($newRows) || empty($existingRows)) {
        return false;
    } else {
        return true;
    }
}



function calculateAdditionalDates($fechaInicio, $fechaTerminacion, $nivelFormacion) {
    try {
        // Crear objetos Carbon a partir de las fechas
        $fechaInicioCarbon = Carbon::createFromFormat('Y-m-d', $fechaInicio);
        $fechaTerminacionCarbon = Carbon::createFromFormat('Y-m-d', $fechaTerminacion);

        // Inicializar variables
        $finEtapaElectiva = $inicioPracticas = $finPracticas = $fechaLimitePracticas = null;

        // Definir las variables relacionadas con las fechas según el nivel de formación
        if ($nivelFormacion == "TECNÓLOGO") {
            $finEtapaElectiva = $fechaInicioCarbon->copy()->addMonths(21);
            $inicioPracticas = $finEtapaElectiva->copy();
            $finPracticas = $inicioPracticas->copy()->addMonths(24); // Asumí que este es un valor estático
            $fechaLimitePracticas = $inicioPracticas->copy()->addMonths(18);
        } elseif ($nivelFormacion == "TÉCNICO") {
            $finEtapaElectiva = $fechaInicioCarbon->copy()->addMonths(6);
            $inicioPracticas = $finEtapaElectiva->copy();
            $finPracticas = $inicioPracticas->copy()->addMonths(24);
            $fechaLimitePracticas = $inicioPracticas->copy()->addMonths(18);
        } elseif ($nivelFormacion == "OPERARIO") {
            $finEtapaElectiva = $fechaInicioCarbon->copy()->addMonths(3);
            $inicioPracticas = $finEtapaElectiva->copy();
            $finPracticas = $inicioPracticas->copy()->addMonths(24);
            $fechaLimitePracticas = $inicioPracticas->copy()->addMonths(18);
        } else {
            throw new Exception("Nivel de formación no reconocido: " . $nivelFormacion);
        }

        // Retornar las fechas calculadas
        return [
            $finEtapaElectiva->format('Y-m-d'),
            $finPracticas->format('Y-m-d'),
            $fechaLimitePracticas->format('Y-m-d')
        ];
    } catch (Exception $e) {
        // Manejar cualquier excepción que pueda ocurrir durante el cálculo de fechas
        echo 'Error al calcular las fechas: ' . $e->getMessage();
        return [null, null, null];
    }
}
?>

<!DOCTYPE html>

<html lang="es">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Sistema - Panel Principal</title>
        <link rel="stylesheet" href="../assets/css/inicio.css">
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
		<?php require_once("../private/encabeza.php"); ?>

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
                                <div class="container">
                                    <h1>Cargar Archivo Excel</h1>
                                    <form action="inicio.php" method="post" enctype="multipart/form-data">
                                        <label for="fileToUpload">Seleccione archivo Excel para cargar:</label>
                                        <input type="file" name="fileToUpload" id="fileToUpload" accept=".xls,.xlsx">
                                        <input type="submit" value="Subir Archivo" name="submit">
                                    </form>
                                </div>
                                <div class="regresar">
                                    <button id="redirectButton">
                                        <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024"><path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path></svg>
                                        <span>Regresar</span>
                                    </button>
                                </div>
                                <script>
                                    document.getElementById('redirectButton').addEventListener('click', function() {
                                        window.location.href = '../private/buscador.php';
                                    });
                                </script>
                                    <!-- PAGE CONTENT ENDS -->
                                    </div><!-- /.col -->
                                                        </div><!-- /.row -->
                                                    </div><!-- /.page-content -->
                                                </div>
                                            </div><!-- /.main-content -->
                                            
                                            <?php require_once("../private/piedepagina.php"); ?>
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
