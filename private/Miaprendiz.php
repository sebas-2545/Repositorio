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
$row= $resultado->fetch_assoc();
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
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/4.0.1/css/fixedColumns.dataTables.min.css"/>

		<link rel="shortcut icon" href="../assets/etapa/icono.ico" type="image/x-icon">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../assets/datatables/datatables.css" />
        <link href="../assets/css/instructor.css" rel="stylesheet">
		<link href="../assets/css/hebbo.css" rel="stylesheet">
		<link rel="stylesheet" href="../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-rtl.min.css" />
		<script src="../assets/js/ace-extra.min.js"></script>
        <style>
           th.tes.sorting {
    position: unset !important;
}
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

                <div class="row">
                    <div class="col-xs-12">
                        
                    
                    <!-- PAGE CONTENT BEGINS -->

                    	<!-- PAGE CONTENT BEGINS -->
                        <div class="container mt-4">
    <div class="table-responsive">
							<table id="miTabla" class="table table-striped ">
        <thead >
                <tr>


                    <th scope="col">Número de Documento de Identidad</th>
                    <th scope="col">Nombre Completo</th>
                    <th scope="col">Número de Ficha</th>
                    <th scope="col" class="tes">Correo Electrónico</th>
                    <th scope="col" class="tes">Nivel Académico</th>
                    <th scope="col" class="tes">Programa de Formación</th>
                    <th scope="col" class="tes">Número de Celular</th>
                    <th scope="col" class="tes">Empresa de Inicio de Etapa Productiva</th>
                    <th scope="col" class="tes">Fecha de Inicio de Etapa</th>
                    <th scope="col" class="tes">Fecha de Fin de Etapa</th>
                    <th scope="col" class="tes">Nombre del Instructor/Lectivo</th>
                    <th scope="col" class="tes">Dirección de la Empresa</th>
                    <th scope="col" class="tes">Municipio/Ciudad</th>
                    <th scope="col" class="tes">Nombre del Jefe Inmediato</th>
                    <th scope="col" class="tes">Teléfono del Jefe Inmediato</th>
                    <th scope="col" class="tes">Correo del Jefe Inmediato</th>
                    <th scope="col" class="tes">Tipo de Alternativa de Etapa Productiva</th>
                    <th scope="col" class="tes">Documentos Entregados</th>
                    <th scope="col" class="tes">Respuesta Magna</th>
                    <th scope="col" class="tes">Registro de Etapa Productiva</th>
                    <th scope="col" class="tes">Observaciones</th>
                    <th scope="col" class="tes">Fecha de Formalización</th>
                    <th scope="col" class="tes">Fecha de Evaluación Parcial</th>
                    <th scope="col" class="tes">Fecha de Evaluación Final</th>
                    <th scope="col" class="tes">Fecha de Estado por Certificar</th>
                    <th scope="col" class="tes">Fecha de Respuesta de Certificación</th>
                    <th scope="col" class="tes">URL del Formulario</th>
                    <th scope="col" class="tes">Estado</th>
                    <th scope="col" class="tes">Fecha de Solicitud de Paz y Salvo</th>
                    <th scope="col" class="tes">Fecha de Respuesta del Coordinador</th>
                    <th scope="col" class="tes">Observaciones de Seguimiento</th>
                    <th scope="col" class="tes">Formato GFPIF023</th>
                    <th scope="col" class="tes">Copia de Contrato</th>
                    <th scope="col" class="tes">Formato GFPIF165</th>
                    <th scope="col" class="tes">RUT o NIT</th>
                    <th scope="col" class="tes">EPS</th>
                    <th scope="col" class="tes">ARL</th>
                    <th scope="col" class="tes">Formato GFPIF023 Completo</th>
                    <th scope="col" class="tes">Formato GFPIF147 Bitácoras</th>
                    <th scope="col" class="tes">Certificación de Finalización</th>
                    <th scope="col" class="tes">Estado por Certificar</th>
                    <th scope="col" class="tes">Copia de Cédula</th>
                    <th scope="col" class="tes">Pruebas TyT</th>
                    <th scope="col" class="tes">Destrucción de Carnet</th>
                    <th scope="col" class="tes">Certificado APE</th>
                    <th scope="col" class="tes">Ver más..</th>
                    <th scope="col" class="tes">PDF</th>
                    <th scope="col" class="tes">comunicate</th>

                </tr>

            </thead>
            <div id="filter-controls" class="clear-filter"></div>

            <tbody>
                
                <?php
                $ext = "completar la información";
                $extt = "Pdf";
              
                while ($ro = $res->fetch_assoc()) {
                    $id = $ro['Id'];

                    $redi = './index.php?id=' . $id;
                    $urll = '../assets/controller/Controllerpdf.php?id='.$id;
                    $fechaEspecifica = $ro['FechaInicioEtapa'];
                    $fechaEspecificaDateTime = new DateTime($fechaEspecifica);
                    $fechaActualDateTime = new DateTime();
                    $diferencia = $fechaEspecificaDateTime->diff($fechaActualDateTime);
                    $diferenciaMeses = $diferencia->y * 12 + $diferencia->m;
                    $destinatario = $ro['CorreoElectronico']; 
    
                        $asunto = 'SEGUIMIENTO ' ; 
                    
                        $cuerpo = "Buen dia". "%0A"."habla con el instrcutor de seguimiento " .$row['Nombre']  ."%0A".
                        "Es para informarle que tiene que enviar los documentos correspondiente para poder formalizar su etapa productiva";

                        $cuer="Buen dia". "%0A"."habla con el instrcutor de seguimiento " .$row['Nombre']  ."%0A".
                        "Es para informarle que me tiene que contactar para hacer el correspondiente seguimiento parcial  ";
                        $cuerp="Buen dia". "%0A"."habla con el instrcutor de seguimiento " .$row['Nombre']  ."%0A".
                        "Es para informarle que me tiene que contactar para hacer el correspondiente seguimiento final y asi poder certificarse   ";
                        $msj1 = 'mailto:' . $destinatario . '?subject=' . $asunto . '&body=' . $cuerpo;
                        $msj2 = 'mailto:' . $destinatario . '?subject=' . $asunto . '&body=' . $cuer;
                        $msj3 = 'mailto:' . $destinatario . '?subject=' . $asunto . '&body=' . $cuerp;




                    if ($diferenciaMeses >= 1 && $diferencia->invert == 0 && is_null($ro['FechaFormalizacion'])) {
                       $hola= '<a href="' . $msj1 . '" class="btn btn-outline-success btn-sm">Formalizacion debe</a>';
                    } elseif ($diferenciaMeses >= 3 && $diferencia->invert == 0 && is_null($ro['FechaEvaluacionParcial'])) {
                       $hola= '<a href="' . $msj2 . '" class="btn btn-outline-success btn-sm">evaluacion parcial debe </a>';
                    } elseif ($diferenciaMeses >= 6 && $diferencia->invert == 0 && is_null($ro['FechaEvaluacionFinal'])) {
                       $hola= '<a href="' . $msj3 . '" class="btn btn-outline-success btn-sm">evaluacion final debe </a>';
                    } else {
                       $hola= '<div class="custom-alert custom-verde">ESTÁ TODO AL DÍA.</div>';
                    }

                    if ($row['idusuarios'] == $ro['id_intructor']) {
                       
                        echo "<tr>";
                        echo "<td>" . $ro['NumeroDocumentoIdentidad'] . "</td>";
                        echo "<td>" . $ro['NombreCompleto'] . "</td>";
                        echo "<td>" . $ro['NumeroFicha'] . "</td>";
                        echo "<td>" . $ro['CorreoElectronico'] . "</td>";
                        echo "<td>" . $ro['NivelAcademico'] . "</td>";
                        echo "<td>" . $ro['ProgramaFormacion'] . "</td>";
                        echo "<td>" . $ro['NumeroCelular'] . "</td>";
                        echo "<td>" . $ro['EmpresaInicioEtapaProductiva'] . "</td>";
                        echo "<td>" . $ro['FechaInicioEtapa'] . "</td>";
                        echo "<td>" . $ro['FechaFinEtapa'] . "</td>";
                        echo "<td>" . $ro['NombreInstructorLectivo'] . "</td>";
                        echo "<td>" . $ro['DireccionEmpresa'] . "</td>";
                        echo "<td>" . $ro['MunicipioCiudad'] . "</td>";
                        echo "<td>" . $ro['NombreJefeInmediato'] . "</td>";
                        echo "<td>" . $ro['TelefonoJefeInmediato'] . "</td>";
                        echo "<td>" . $ro['CorreoJefeInmediato'] . "</td>";
                        echo "<td>" . $ro['TipoAlternativaEtapaProductiva'] . "</td>";
                        echo "<td>" . $ro['DocumentosEntregados'] . "</td>";
                        echo "<td>" . $ro['Respuesmagna'] . "</td>";
                        echo "<td>" . $ro['Registroetapaproductiva'] . "</td>";
                        echo "<td>" . $ro['observaciones'] . "</td>";
                        echo "<td>" . $ro['FechaFormalizacion'] . "</td>";
                        echo "<td>" . $ro['FechaEvaluacionParcial'] . "</td>";
                        echo "<td>" . $ro['FechaEvaluacionFinal'] . "</td>";
                        echo "<td>" . $ro['FechaEstadoPorCertificar'] . "</td>";
                        echo "<td>" . $ro['FechaRespuestaCertificacion'] . "</td>";
                        echo "<td>" . $ro['URLFormulario'] . "</td>";
                        echo "<td>" . $ro['Estado'] . "</td>";
                        echo "<td>" . $ro['FechaSolicitudPazySalvo'] . "</td>";
                        echo "<td>" . $ro['FechaRespuestaCoordinador'] . "</td>";
                        echo "<td>" . $ro['ObservacionesSeguimiento'] . "</td>";
                        echo "<td>" . $ro['FormatoGFPIF023'] . "</td>";
                        echo "<td>" . $ro['CopiaContrato'] . "</td>";
                        echo "<td>" . $ro['FormatoGFPIF165'] . "</td>";
                        echo "<td>" . $ro['RUToNIT'] . "</td>";
                        echo "<td>" . $ro['EPS'] . "</td>";
                        echo "<td>" . $ro['ARL'] . "</td>";
                        echo "<td>" . $ro['FormatoGFPIF023Completo'] . "</td>";
                        echo "<td>" . $ro['FormatoGFPIF147Bitacoras'] . "</td>";
                        echo "<td>" . $ro['CertificacionFinalizacion'] . "</td>";
                        echo "<td>" . $ro['EstadoPorCertificar'] . "</td>";
                        echo "<td>" . $ro['CopiaCedula'] . "</td>";
                        echo "<td>" . $ro['PruebasTyT'] . "</td>";
                        echo "<td>" . $ro['DestruccionCarnet'] . "</td>";
                        echo "<td>" . $ro['CertificadoAPE'] . "</td>";
                        echo "<td><a href='$redi' class='btn btn-outline-success btn-sm'>Completar</a></td>";
                        echo "<td><a href='../assets/controller/Controllerpdf.php?id='.$id' class='btn btn-outline-success btn-sm'>PDF</a></td>";
                        echo "<td>$hola</td>";

                        echo "</tr>";
                    }else{
                        $id = $ro['Id'];
                        $redi = './index.php?id=' . $id;
                        $urll = '../../controller/pdf.php?id=' . $id;
                        echo "<tr>";
                        echo "<td>" . $ro['NumeroDocumentoIdentidad'] . "</td>";
                        echo "<td>" . $ro['NombreCompleto'] . "</td>";
                        echo "<td>" . $ro['NumeroFicha'] . "</td>";
                        echo "<td>" . $ro['CorreoElectronico'] . "</td>";
                        echo "<td>" . $ro['NivelAcademico'] . "</td>";
                        echo "<td>" . $ro['ProgramaFormacion'] . "</td>";
                        echo "<td>" . $ro['NumeroCelular'] . "</td>";
                        echo "<td>" . $ro['EmpresaInicioEtapaProductiva'] . "</td>";
                        echo "<td>" . $ro['FechaInicioEtapa'] . "</td>";
                        echo "<td>" . $ro['FechaFinEtapa'] . "</td>";
                        echo "<td>" . $ro['NombreInstructorLectivo'] . "</td>";
                        echo "<td>" . $ro['DireccionEmpresa'] . "</td>";
                        echo "<td>" . $ro['MunicipioCiudad'] . "</td>";
                        echo "<td>" . $ro['NombreJefeInmediato'] . "</td>";
                        echo "<td>" . $ro['TelefonoJefeInmediato'] . "</td>";
                        echo "<td>" . $ro['CorreoJefeInmediato'] . "</td>";
                        echo "<td>" . $ro['TipoAlternativaEtapaProductiva'] . "</td>";
                        echo "<td>" . $ro['DocumentosEntregados'] . "</td>";
                        echo "<td>" . $ro['Respuesmagna'] . "</td>";
                        echo "<td>" . $ro['Registroetapaproductiva'] . "</td>";
                        echo "<td>" . $ro['observaciones'] . "</td>";
                        echo "<td>" . $ro['FechaFormalizacion'] . "</td>";
                        echo "<td>" . $ro['FechaEvaluacionParcial'] . "</td>";
                        echo "<td>" . $ro['FechaEvaluacionFinal'] . "</td>";
                        echo "<td>" . $ro['FechaEstadoPorCertificar'] . "</td>";
                        echo "<td>" . $ro['FechaRespuestaCertificacion'] . "</td>";
                        echo "<td>" . $ro['URLFormulario'] . "</td>";
                        echo "<td>" . $ro['Estado'] . "</td>";
                        echo "<td>" . $ro['FechaSolicitudPazySalvo'] . "</td>";
                        echo "<td>" . $ro['FechaRespuestaCoordinador'] . "</td>";
                        echo "<td>" . $ro['ObservacionesSeguimiento'] . "</td>";
                        echo "<td>" . $ro['FormatoGFPIF023'] . "</td>";
                        echo "<td>" . $ro['CopiaContrato'] . "</td>";
                        echo "<td>" . $ro['FormatoGFPIF165'] . "</td>";
                        echo "<td>" . $ro['RUToNIT'] . "</td>";
                        echo "<td>" . $ro['EPS'] . "</td>";
                        echo "<td>" . $ro['ARL'] . "</td>";
                        echo "<td>" . $ro['FormatoGFPIF023Completo'] . "</td>";
                        echo "<td>" . $ro['FormatoGFPIF147Bitacoras'] . "</td>";
                        echo "<td>" . $ro['CertificacionFinalizacion'] . "</td>";
                        echo "<td>" . $ro['EstadoPorCertificar'] . "</td>";
                        echo "<td>" . $ro['CopiaCedula'] . "</td>";
                        echo "<td>" . $ro['PruebasTyT'] . "</td>";
                        echo "<td>" . $ro['DestruccionCarnet'] . "</td>";
                        echo "<td>" . $ro['CertificadoAPE'] . "</td>";
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
</div>

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
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/4.0.1/js/dataTables.fixedColumns.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
      
        <script>
$(document).ready(function(){
    var table = $('#miTabla').DataTable({
       
        "pageLength": 10, // Define la cantidad predeterminada de filas por página
        "lengthMenu": [10], // Elimina la opción de elegir la cantidad de registros por página
        "info": false,
        "scrollX": true, // Habilitar scroll horizontal
        "fixedColumns": {
            "leftColumns": 3 // Fija las primeras 5 columnas
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
        },
         dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o"></i> Excel',
                        titleAttr: 'Exportar a Excel',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i> PDF',
                        titleAttr: 'Exportar a PDF',
                        className: 'btn btn-danger'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> Print',
                        titleAttr: 'Imprimir',
                        className: 'btn btn-info'
                    }
                ],
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
