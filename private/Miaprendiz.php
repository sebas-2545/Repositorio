<?php
session_start();

require_once 'validaterol.php';
include ("../loginphp/conexion.php");

if (!isset($_SESSION['id_usuario'])){
	header("Location:../loginphp/index.php");
}
$iduser = $_SESSION['id_usuario'];
$sql = "SELECT * FROM usuarios WHERE idusuarios = '$iduser'";
//$sql = "SELECT * FROM Usuarios";
$resultado = $conexion->query($sql);
$roww = $resultado->fetch_assoc();
//$user_q['rol'];



    $sql = "SELECT * FROM registroetapaproductiva";
    $res = $conexion->query($sql);
   



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
		<link href="../assets/css/instructor.css" rel="stylesheet">
		<link rel="stylesheet" href="../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-rtl.min.css" />
		<script src="../assets/js/ace-extra.min.js"></script>
        <link href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/4.0.1/css/fixedColumns.dataTables.min.css"/>

        <style>

        th {
            z-index: 1 !important;
        }
        .dataTables_wrapper label {
            display: flex !important;
        }
        .dataTables_paginate {
            text-align: left;
        }
        .filter-dropdown {
            position: relative;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 5px;
            z-index: 1000;
            display: none;
        }
        .filter-dropdown::after {
            content: "\25BC";
            position: absolute;
            right: 10px;
            top: 5px;
        }
        body {
            background-color: #928e8e;
        }
    </style>
	   </style>
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
<div class="container mt-4">
    <div class="table-responsive">

        <table id="miTabla" class="table table-striped">
        <thead >
                <tr>


                    <th scope="col">Fecha de Registro</th>
                    <th scope="col">Número de Documento de Identidad</th>
                    <th scope="col">Nombre Completo</th>
                    <th scope="col">Número de Ficha</th>
                    <th scope="col">Correo Electrónico</th>
                    <th scope="col">Nivel Académico</th>
                    <th scope="col">Programa de Formación</th>
                    <th scope="col">Número de Celular</th>
                    <th scope="col">Empresa de Inicio de Etapa Productiva</th>
                    <th scope="col">Fecha de Inicio de Etapa</th>
                    <th scope="col">Fecha de Fin de Etapa</th>
                    <th scope="col">Nombre del Instructor/Lectivo</th>
                    <th scope="col">Dirección de la Empresa</th>
                    <th scope="col">Municipio/Ciudad</th>
                    <th scope="col">Nombre del Jefe Inmediato</th>
                    <th scope="col">Teléfono del Jefe Inmediato</th>
                    <th scope="col">Correo del Jefe Inmediato</th>
                    <th scope="col">Tipo de Alternativa de Etapa Productiva</th>
                    <th scope="col">Documentos Entregados</th>
                    <th scope="col">Respuesta Magna</th>
                    <th scope="col">Registro de Etapa Productiva</th>
                    <th scope="col">Observaciones</th>
                    <th scope="col">Fecha de Formalización</th>
                    <th scope="col">Fecha de Evaluación Parcial</th>
                    <th scope="col">Fecha de Evaluación Final</th>
                    <th scope="col">Fecha de Estado por Certificar</th>
                    <th scope="col">Fecha de Respuesta de Certificación</th>
                    <th scope="col">URL del Formulario</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Fecha de Solicitud de Paz y Salvo</th>
                    <th scope="col">Fecha de Respuesta del Coordinador</th>
                    <th scope="col">Observaciones de Seguimiento</th>
                    <th scope="col">Formato GFPIF023</th>
                    <th scope="col">Copia de Contrato</th>
                    <th scope="col">Formato GFPIF165</th>
                    <th scope="col">RUT o NIT</th>
                    <th scope="col">EPS</th>
                    <th scope="col">ARL</th>
                    <th scope="col">Formato GFPIF023 Completo</th>
                    <th scope="col">Formato GFPIF147 Bitácoras</th>
                    <th scope="col">Certificación de Finalización</th>
                    <th scope="col">Estado por Certificar</th>
                    <th scope="col">Copia de Cédula</th>
                    <th scope="col">Pruebas TyT</th>
                    <th scope="col">Destrucción de Carnet</th>
                    <th scope="col">Certificado APE</th>
                    <th scope="col">Ver más..</th>
                    <th scope="col">PDF</th>
                    <th scope="col">comunicate</th>

                </tr>

            </thead>
            <div id="filter-controls" class="clear-filter"></div>

            <tbody>
                
                <?php
                $ext = "completar la información";
                $extt = "Pdf";
              
                while ($row = $res->fetch_assoc()) {
                    $id = $row['Id'];

                    $redi = './index.php?id=' . $id;
                    $urll = '../assets/controller/Controllerpdf.php?id='.$id;
                    $fechaEspecifica = $row['FechaInicioEtapa'];
                    $fechaEspecificaDateTime = new DateTime($fechaEspecifica);
                    $fechaActualDateTime = new DateTime();
                    $diferencia = $fechaEspecificaDateTime->diff($fechaActualDateTime);
                    $diferenciaMeses = $diferencia->y * 12 + $diferencia->m;
                    $destinatario = $row['CorreoElectronico']; 
    
                        $asunto = 'SEGUIMIENTO ' ; 
                    
                        $cuerpo = "Buen dia". "%0A"."habla con el instrcutor de seguimiento " .$roww['Nombre']  ."%0A".
                        "Es para informarle que tiene que enviar los documentos correspondiente para poder formalizar su etapa productiva";

                        $cuer="Buen dia". "%0A"."habla con el instrcutor de seguimiento " .$roww['Nombre']  ."%0A".
                        "Es para informarle que me tiene que contactar para hacer el correspondiente seguimiento parcial  ";
                        $cuerp="Buen dia". "%0A"."habla con el instrcutor de seguimiento " .$roww['Nombre']  ."%0A".
                        "Es para informarle que me tiene que contactar para hacer el correspondiente seguimiento final y asi poder certificarse   ";
                        $msj1 = 'mailto:' . $destinatario . '?subject=' . $asunto . '&body=' . $cuerpo;
                        $msj2 = 'mailto:' . $destinatario . '?subject=' . $asunto . '&body=' . $cuer;
                        $msj3 = 'mailto:' . $destinatario . '?subject=' . $asunto . '&body=' . $cuerp;




                    if ($diferenciaMeses >= 1 && $diferencia->invert == 0 && is_null($row['FechaFormalizacion'])) {
                       $hola= '<a href="' . $msj1 . '" class="btn btn-outline-success btn-sm">Formalizacion debe</a>';
                    } elseif ($diferenciaMeses >= 3 && $diferencia->invert == 0 && is_null($row['FechaEvaluacionParcial'])) {
                       $hola= '<a href="' . $msj2 . '" class="btn btn-outline-success btn-sm">evaluacion parcial debe </a>';
                    } elseif ($diferenciaMeses >= 6 && $diferencia->invert == 0 && is_null($row['FechaEvaluacionFinal'])) {
                       $hola= '<a href="' . $msj3 . '" class="btn btn-outline-success btn-sm">evaluacion final debe </a>';
                    } else {
                       $hola= '<div class="custom-alert custom-verde">ESTÁ TODO AL DÍA.</div>';
                    }

                    if ($roww['idusuarios'] == $row['id_intructor']) {
                       
                        echo "<tr>";
                        echo "<td>" . $row['FechaRegistro'] . "</td>";
                        echo "<td>" . $row['NumeroDocumentoIdentidad'] . "</td>";
                        echo "<td>" . $row['NombreCompleto'] . "</td>";
                        echo "<td>" . $row['NumeroFicha'] . "</td>";
                        echo "<td>" . $row['CorreoElectronico'] . "</td>";
                        echo "<td>" . $row['NivelAcademico'] . "</td>";
                        echo "<td>" . $row['ProgramaFormacion'] . "</td>";
                        echo "<td>" . $row['NumeroCelular'] . "</td>";
                        echo "<td>" . $row['EmpresaInicioEtapaProductiva'] . "</td>";
                        echo "<td>" . $row['FechaInicioEtapa'] . "</td>";
                        echo "<td>" . $row['FechaFinEtapa'] . "</td>";
                        echo "<td>" . $row['NombreInstructorLectivo'] . "</td>";
                        echo "<td>" . $row['DireccionEmpresa'] . "</td>";
                        echo "<td>" . $row['MunicipioCiudad'] . "</td>";
                        echo "<td>" . $row['NombreJefeInmediato'] . "</td>";
                        echo "<td>" . $row['TelefonoJefeInmediato'] . "</td>";
                        echo "<td>" . $row['CorreoJefeInmediato'] . "</td>";
                        echo "<td>" . $row['TipoAlternativaEtapaProductiva'] . "</td>";
                        echo "<td>" . $row['DocumentosEntregados'] . "</td>";
                        echo "<td>" . $row['Respuesmagna'] . "</td>";
                        echo "<td>" . $row['Registroetapaproductiva'] . "</td>";
                        echo "<td>" . $row['observaciones'] . "</td>";
                        echo "<td>" . $row['FechaFormalizacion'] . "</td>";
                        echo "<td>" . $row['FechaEvaluacionParcial'] . "</td>";
                        echo "<td>" . $row['FechaEvaluacionFinal'] . "</td>";
                        echo "<td>" . $row['FechaEstadoPorCertificar'] . "</td>";
                        echo "<td>" . $row['FechaRespuestaCertificacion'] . "</td>";
                        echo "<td>" . $row['URLFormulario'] . "</td>";
                        echo "<td>" . $row['Estado'] . "</td>";
                        echo "<td>" . $row['FechaSolicitudPazySalvo'] . "</td>";
                        echo "<td>" . $row['FechaRespuestaCoordinador'] . "</td>";
                        echo "<td>" . $row['ObservacionesSeguimiento'] . "</td>";
                        echo "<td>" . $row['FormatoGFPIF023'] . "</td>";
                        echo "<td>" . $row['CopiaContrato'] . "</td>";
                        echo "<td>" . $row['FormatoGFPIF165'] . "</td>";
                        echo "<td>" . $row['RUToNIT'] . "</td>";
                        echo "<td>" . $row['EPS'] . "</td>";
                        echo "<td>" . $row['ARL'] . "</td>";
                        echo "<td>" . $row['FormatoGFPIF023Completo'] . "</td>";
                        echo "<td>" . $row['FormatoGFPIF147Bitacoras'] . "</td>";
                        echo "<td>" . $row['CertificacionFinalizacion'] . "</td>";
                        echo "<td>" . $row['EstadoPorCertificar'] . "</td>";
                        echo "<td>" . $row['CopiaCedula'] . "</td>";
                        echo "<td>" . $row['PruebasTyT'] . "</td>";
                        echo "<td>" . $row['DestruccionCarnet'] . "</td>";
                        echo "<td>" . $row['CertificadoAPE'] . "</td>";
                        echo "<td><a href='$redi' class='btn btn-outline-success btn-sm'>Completar</a></td>";
                        echo "<td><a href='../assets/controller/Controllerpdf.php?id='.$id' class='btn btn-outline-success btn-sm'>PDF</a></td>";
                        echo "<td>$hola</td>";

                        echo "</tr>";
                    }else{
                        $id = $row['Id'];
                        $redi = './index.php?id=' . $id;
                        $urll = '../../controller/pdf.php?id=' . $id;
                        echo "<tr>";
                        echo "<td>" . $row['FechaRegistro'] . "</td>";
                        echo "<td>" . $row['NumeroDocumentoIdentidad'] . "</td>";
                        echo "<td>" . $row['NombreCompleto'] . "</td>";
                        echo "<td>" . $row['NumeroFicha'] . "</td>";
                        echo "<td>" . $row['CorreoElectronico'] . "</td>";
                        echo "<td>" . $row['NivelAcademico'] . "</td>";
                        echo "<td>" . $row['ProgramaFormacion'] . "</td>";
                        echo "<td>" . $row['NumeroCelular'] . "</td>";
                        echo "<td>" . $row['EmpresaInicioEtapaProductiva'] . "</td>";
                        echo "<td>" . $row['FechaInicioEtapa'] . "</td>";
                        echo "<td>" . $row['FechaFinEtapa'] . "</td>";
                        echo "<td>" . $row['NombreInstructorLectivo'] . "</td>";
                        echo "<td>" . $row['DireccionEmpresa'] . "</td>";
                        echo "<td>" . $row['MunicipioCiudad'] . "</td>";
                        echo "<td>" . $row['NombreJefeInmediato'] . "</td>";
                        echo "<td>" . $row['TelefonoJefeInmediato'] . "</td>";
                        echo "<td>" . $row['CorreoJefeInmediato'] . "</td>";
                        echo "<td>" . $row['TipoAlternativaEtapaProductiva'] . "</td>";
                        echo "<td>" . $row['DocumentosEntregados'] . "</td>";
                        echo "<td>" . $row['Respuesmagna'] . "</td>";
                        echo "<td>" . $row['Registroetapaproductiva'] . "</td>";
                        echo "<td>" . $row['observaciones'] . "</td>";
                        echo "<td>" . $row['FechaFormalizacion'] . "</td>";
                        echo "<td>" . $row['FechaEvaluacionParcial'] . "</td>";
                        echo "<td>" . $row['FechaEvaluacionFinal'] . "</td>";
                        echo "<td>" . $row['FechaEstadoPorCertificar'] . "</td>";
                        echo "<td>" . $row['FechaRespuestaCertificacion'] . "</td>";
                        echo "<td>" . $row['URLFormulario'] . "</td>";
                        echo "<td>" . $row['Estado'] . "</td>";
                        echo "<td>" . $row['FechaSolicitudPazySalvo'] . "</td>";
                        echo "<td>" . $row['FechaRespuestaCoordinador'] . "</td>";
                        echo "<td>" . $row['ObservacionesSeguimiento'] . "</td>";
                        echo "<td>" . $row['FormatoGFPIF023'] . "</td>";
                        echo "<td>" . $row['CopiaContrato'] . "</td>";
                        echo "<td>" . $row['FormatoGFPIF165'] . "</td>";
                        echo "<td>" . $row['RUToNIT'] . "</td>";
                        echo "<td>" . $row['EPS'] . "</td>";
                        echo "<td>" . $row['ARL'] . "</td>";
                        echo "<td>" . $row['FormatoGFPIF023Completo'] . "</td>";
                        echo "<td>" . $row['FormatoGFPIF147Bitacoras'] . "</td>";
                        echo "<td>" . $row['CertificacionFinalizacion'] . "</td>";
                        echo "<td>" . $row['EstadoPorCertificar'] . "</td>";
                        echo "<td>" . $row['CopiaCedula'] . "</td>";
                        echo "<td>" . $row['PruebasTyT'] . "</td>";
                        echo "<td>" . $row['DestruccionCarnet'] . "</td>";
                        echo "<td>" . $row['CertificadoAPE'] . "</td>";
                        echo "<td><a href='$redi' class='btn btn-outline-success btn-sm'>Completar</a></td>";
                        echo "<td><a href='../assets/controller/Controllerpdf.php?id=".$id."' class='btn btn-outline-success btn-sm'>PDF</a></td>";

                        echo "<td>$hola</td>";


                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
   
</div>
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

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
		<script src="../assets/datatables/revisar.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>  
<script src="https://cdn.datatables.net/searchpanes/1.0.1/js/dataTables.searchPanes.min.js"></script>

 <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>  
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/4.0.1/js/dataTables.fixedColumns.min.js"></script>
<script>
$(document).ready(function(){
    var table = $('#miTabla').DataTable({
        "dom": '<"top"lf>rt<"bottom"ip><"clear">',
        "pageLength": 10, // Define la cantidad predeterminada de filas por página
        "lengthMenu": [10], // Elimina la opción de elegir la cantidad de registros por página
        "info": false,
        "scrollX": true, // Habilitar scroll horizontal
        "fixedColumns": {
            "leftColumns": 5 // Fija las primeras 5 columnas
        },
        "language": {
            "search": "Buscador:",
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrados de _MAX_ registros totales)",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });

    $('<button type="button">Limpiar</button>')
        .appendTo('#filter-controls')
        .addClass('clear-filter')
        .on('click', function() {
            $('#miTabla').DataTable().search('').columns().search('').draw();
            $('.filter-dropdown select').val('').trigger('change');
        });

    $('thead th').each(function() {
        var filterDropdown = $('<div class="filter-dropdown"></div>').appendTo($(this));

        // Adiciona evento de clique
        $(this).on('click', function(e) {
            e.stopPropagation();
            $('.filter-dropdown').not(filterDropdown).hide();
            filterDropdown.toggle();
        });

        // Fecha el menú desplegable al hacer clic en cualquier otro lugar de la página
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.filter-dropdown').length) {
                $('.filter-dropdown').hide();
            }
        });

        var column = table.column($(this).index());
        var select = $('<select><option value=""></option></select>')
            .appendTo(filterDropdown)
            .on('click', function(e) {
                e.stopPropagation(); // Impide la propagación del evento de clic
            })
            .on('change', function() {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? '^' + val + '$' : '', true, false).draw();
            });

        column.data().unique().sort().each(function(d, j) {
            select.append('<option value="' + d + '">' + d + '</option>');
        });
    });
});
</script>






</body>
</html>
