<?php

require '../../vendor/autoload.php';
include ("../../loginphp/conexion.php");;

use setasign\Fpdi\Fpdi;

if(isset($_GET['id'])){
    $id=$_GET['id'];
   
$sql="SELECT * FROM registroetapaproductiva WHERE id='$id'";
$ress = $conexion->query($sql);
$r=$ress->fetch_assoc();
$id_intructor=$r['id_intructor'];
$que="SELECT * From usuarios WHERE idusuarios= '$id_intructor' ";
$je=$conexion->query($que);
$s=$je->fetch_assoc();


// Ruta al PDF existente que deseas editar
$existingPdf = 'Cuadro_Control.pdf';

// Crear una instancia de FPDI
$pdf = new FPDI();

// Agregar páginas del PDF existente
$pageCount = $pdf->setSourceFile($existingPdf);

// Iterar sobre todas las páginas del PDF existente
for ($pageNumber = 1; $pageNumber <= $pageCount; $pageNumber++) {
    $templateId = $pdf->importPage($pageNumber);
    $size = $pdf->getTemplateSize($templateId);

    // Agregar una nueva página al PDF editado con las dimensiones de la página original
    $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);

    // Utilizar la plantilla de la página importada en la página actual del PDF editado
    $pdf->useTemplate($templateId);
    
    // Establecer el estilo del texto
    $pdf->SetFont('helvetica', '', 8);

    // Agregar texto solo en la primera página
    if ($pageNumber === 1) {
        //fecha
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(40, 32); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10,  $r['FechaRegistro'], 0, 1, 'L');
        //numero de documento
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(49, 68); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10,  $r['NumeroDocumentoIdentidad'], 0, 1, 'L'); // Agregar texto
        // nombre
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(13, 68); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10,  $r['NombreCompleto'], 0, 1, 'C');
       // numero
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(180, 68); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10, $r['NumeroCelular'] , 0, 1, 'C');
        // correo
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(105, 72); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10,$r['CorreoElectronico'] , 0, 1, 'L');
        
        // cuadro 
        // ficha
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(49, 85.5); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10, $r['NumeroFicha'], 0, 1, 'L'); // Agregar texto
        //fecha inicio
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(49, 90); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10, $r['FechaInicioEtapa'], 0, 1, 'L'); // Agregar texto
        //fecha fin
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(49, 94); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10,$r['FechaFinEtapa'] , 0, 1, 'L');
        //tipo formacion
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(13, 85.5); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10, $r['NivelAcademico'], 0, 1, 'C');
        // nombre del programa
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(79, 90); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10, $r['ProgramaFormacion'], 0, 1, 'C');
        // INSTRUCTOR TECNICO ETAPA ELECTIVA
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(39, 94); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10, $r['NombreInstructorLectivo'], 0, 1, 'C');

        //
        //NOMBRE EMPRESA
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(68, 107.5); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10, $r['EmpresaInicioEtapaProductiva'], 0, 1, 'L');
        //FECHA INICIO
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(68, 111.5); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10, '14/4/2024', 0, 1, 'L');
        //FECHA FIN 
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(68, 116); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10, '10/05/2024', 0, 1, 'L');
        // Direccion  EMPRESA
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(68, 120); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10,  $r['DireccionEmpresa'], 0, 1, 'L');

        //NOMBRE SUPERVISOR 
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(130, 107.5); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10,  $r['NombreJefeInmediato'], 0, 1, 'C');
        // celular
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(130, 111.5); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10, $r['TelefonoJefeInmediato'], 0, 1, 'C');
        //correo
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(130, 116); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10, $r['CorreoJefeInmediato'], 0, 1, 'C');
        //municipio
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(130, 120); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10, $r['MunicipioCiudad'], 0, 1, 'C');

        //pre
        //alternativa 
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(78, 130); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10, $r['TipoAlternativaEtapaProductiva'], 0, 1, 'L');
        //NOMBRE INSTRUCTOR DE SEGUIMIENTO
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(78, 134); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10, $s['Nombre'], 0, 1, 'L');
        //CORREO
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(34, 134); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10, $s['Correo'], 0, 1, 'C');

        // LISTA DE CHEKEO
        //FORMATO 023 planeacion
        if ($r['FormatoGFPIF023']== 'si') {
            $pdf->SetTextColor(0, 0, 0); // Color: negro
            $pdf->SetXY(132, 151); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'OK', 0, 1, 'C');
        }else{
            $pdf->SetTextColor(0, 0, 0); // Color: negro
            $pdf->SetXY(189, 151); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'X', 0, 1, 'C');
        }
         //contrato de aprendisaje
        if ($r['CertificadoAPE']== 'si') {
            $pdf->SetTextColor(0, 0, 0); // Color: negro
            $pdf->SetXY(132, 155); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'OK', 0, 1, 'C');
        }else {
            $pdf->SetTextColor(0, 0, 0); // Color: negro
            $pdf->SetXY(189, 155); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'X', 0, 1, 'C');
        }
        
       
        //formato 165
        if ($r['FormatoGFPIF165']== 'si') {
            $pdf->SetTextColor(0, 0, 0); // Color: negro
            $pdf->SetXY(132, 159); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'OK', 0, 1, 'C');
        }else{
            $pdf->SetTextColor(0, 0, 0); // Color: negro
            $pdf->SetXY(189, 159); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'X', 0, 1, 'C');
        }
       
        // rut o camara y comercio
        if ($r['RUToNIT']== 'si') {
            $pdf->SetTextColor(0, 0, 0); // Color: negro
            $pdf->SetXY(132, 163); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'OK', 0, 1, 'C');
        }else{
            $pdf->SetTextColor(0, 0, 0); // Color: negro
            $pdf->SetXY(189, 163); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'X', 0, 1, 'C');
        }
      
        // eps
        if ($r['EPS']=='si') {
            $pdf->SetTextColor(0, 0, 0); // Color: negro
            $pdf->SetXY(132, 168); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'OK', 0, 1, 'C');
        }else {
            $pdf->SetTextColor(0, 0, 0); // Color: negro
            $pdf->SetXY(189, 168); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'X', 0, 1, 'C');
        }
       
        //arl
        if ($r['ARL']=='si') {
            $pdf->SetTextColor(0, 0, 0); // Color: negro
            $pdf->SetXY(132, 172); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'OK', 0, 1, 'C');
        }else{
            $pdf->SetTextColor(0, 0, 0); // Color: negro
            $pdf->SetXY(189, 172); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'X', 0, 1, 'C');
        }
        
        // formato 023 Final
        if ($r['FormatoGFPIF023Completo']=='si') {
            $pdf->SetTextColor(0, 0, 0); // Color: negro
             $pdf->SetXY(132, 176); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'OK', 0, 1, 'C');
        }else{
            $pdf->SetTextColor(0, 0, 0); // Color: negro
            $pdf->SetXY(189, 176); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'X', 0, 1, 'C');
        }
        
        //formato 147 bitacoras
        
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(132, 180); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10, $r['FormatoGFPIF147Bitacoras'], 0, 1, 'C');
        
    }
    if ($pageNumber === 2) {
        if ($r['CertificacionFinalizacion']=='si') {
            $pdf->SetTextColor(0, 0, 0); // Color: negro
            $pdf->SetXY(132, 17); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'OK', 0, 1, 'C');
        }else{
            $pdf->SetTextColor(0, 0, 0); // Color: negro
            $pdf->SetXY(189, 17); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'X', 0, 1, 'C');
        }
       
        //juicio evaluativo del reporte
            if($r['EstadoPorCertificar'] == 'si'){
            $pdf->SetTextColor(0, 0, 0); // Color: negro
            $pdf->SetXY(132, 21); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'OK', 0, 1, 'C');
            }else{
                $pdf->SetTextColor(0, 0, 0); // Color: negro
                $pdf->SetXY(189, 21); // Ajusta las coordenadas según lo necesario
                $pdf->Cell(0, 10, 'X', 0, 1, 'C');
            }
        //documento de identidad
        if ($r['CopiaCedula']== 'si') {
        $pdf->SetTextColor(0, 0, 0); // Color: negro
        $pdf->SetXY(132, 25); // Ajusta las coordenadas según lo necesario
        $pdf->Cell(0, 10, 'OK', 0, 1, 'C');
        }else{
            $pdf->SetTextColor(0, 0, 0); // Color: negro
            $pdf->SetXY(189, 25); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'X', 0, 1, 'C');}
        
        //tyt
        if ($r['PruebasTyT']=='si') {
            $pdf->SetTextColor(0, 0, 0); // Color: negro
            $pdf->SetXY(132, 30); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'OK', 0, 1, 'C');
        }else{
            $pdf->SetTextColor(0, 0, 0); // Color: negro
            $pdf->SetXY(189, 30); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'X', 0, 1, 'C');
        }
        
        //Carnet
        if ( $r['DestruccionCarnet']=='si') {
            $pdf->SetTextColor(0, 0, 0); // Color: negro
            $pdf->SetXY(132, 34); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'OK', 0, 1, 'C');
        }else {
            $pdf->SetTextColor(0, 0, 0); // Color: negro
            $pdf->SetXY(189, 34); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'X', 0, 1, 'C');
        }
        
        //Ape
        if ($r['CertificadoAPE']=='si') {
            $pdf->SetTextColor(0, 0, 0); // Color: negro
            $pdf->SetXY(132, 38); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'OK', 0, 1, 'C');
        }else {
            $pdf->SetTextColor(0, 0, 0); // Color: negro
            $pdf->SetXY(189, 38); // Ajusta las coordenadas según lo necesario
            $pdf->Cell(0, 10, 'X', 0, 1, 'C');
        }
        
        //observacion
         

         $pdf->SetTextColor(0, 0, 0); // Color: negro
         $pdf->SetXY(50, 63); // Ajusta las coordenadas según lo necesario
         $pdf->Cell(0, 10, $r['observaciones'], 0, 1, 'L');
         // Estado
         $pdf->SetFont('helvetica', 'B', 10);
         $pdf->SetTextColor(0, 0, 0); // Color: negro
         $pdf->SetXY(70, 72); // Ajusta las coordenadas según lo necesario
         $pdf->Cell(0, 10, $r['Estado'], 0, 1, 'C');
    }
}

// Limpiar los búferes de salida antes de enviar las cabeceras
ob_clean();

// Cabecera HTTP para forzar la descarga del archivo con el nombre especificado
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="edited_pdf.pdf"');

// Enviar el PDF editado al navegador
$pdf->Output('D', 'edited_pdf.pdf');
}else{
    echo "ERROR NO SE ENNCONTRO EL ID";
}
?>
