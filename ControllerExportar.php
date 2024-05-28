<?php

require __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
// Conectarse a la base de datos

$local="localhost";
$database="recuperar";
$user="root";
$password='';

try{
    $conn =new mysqli($local,$user,$password,$database,);
}catch(PDOException $e){
    echo "error". $e->getMessage();
}
// Leer datos de la base de datos
$sql = 'SELECT * FROM registroetapaproductiva';
$result = $conn->query($sql);

// Crear un nuevo archivo de Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$headerStyle = [
    'font' => [
        'bold' => true,
        'color' => ['rgb' => 'FFFFFF'], // Blanco
    ],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => ['rgb' => '0070C0'], // Azul
    ],
];
$DOS = [
    'font' => [
        'bold' => true,
        'color' => ['rgb' => 'FFFFFF'], // Blanco
    ],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'F34A00 '], // Azul
    ],
];
$TRES = [
    'font' => [
        'bold' => true,
        'color' => ['rgb' => 'FFFFFF'], // Blanco
    ],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'F34A00'], //ZAPOTE
    ],
];
// Aplicar estilos a la cabecera
$sheet->getStyle('A1:V1')->applyFromArray($headerStyle);
$sheet->getStyle('W1:AC1')->applyFromArray($TRES);
$sheet->getStyle('AD1:AW1')->applyFromArray($headerStyle);



$dataStyle = [
    'font' => [
        'color' => ['rgb' => '008000'], // Verde
    ],
    'borders' => [
        'outline' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000'], // Negro
        ],
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => 'C0FFC0'], // Verde claro
    ],
];

$columns = range('A', 'Z');
foreach ($columns as $column) {
    $sheet->getColumnDimension($column)->setWidth(20); // Establecer ancho de 20 unidades para todas las columnas
}
// Establecer ancho para la columna AA
$sheet->getColumnDimension('AC')->setWidth(18); // Establecer el ancho de la columna AA en 25 unidades
$sheet->getColumnDimension('AR')->setWidth(18); // Establecer el ancho de la columna AA en 25 unidades
$sheet->getColumnDimension('AS')->setWidth(18); // Establecer el ancho de la columna AA en 25 unidades
$sheet->getColumnDimension('AT')->setWidth(18); // Establecer el ancho de la columna AA en 25 unidades


// Escribir encabezados de columna
$sheet->setCellValue('A1', 'Fecha de Registro');
$sheet->setCellValue('B1', 'Número de Documento de Identidad');
$sheet->setCellValue('C1', 'Nombre Completo');
$sheet->setCellValue('D1', 'Número de Ficha');
$sheet->setCellValue('E1', 'Correo Electrónico');
$sheet->setCellValue('F1', 'Nivel Académico');
$sheet->setCellValue('G1', 'Programa de Formación');
$sheet->setCellValue('H1', 'Número de Celular');
$sheet->setCellValue('I1', 'Empresa donde inicia la etapa productiva');
$sheet->setCellValue('J1', 'Fecha de Inicio de la etapa productiva en la empresa');
$sheet->setCellValue('K1', 'Fecha de Fin de la etapa productiva en la empresa');
$sheet->setCellValue('L1', 'Nombre del Instructor Técnico en la etapa lectiva');
$sheet->setCellValue('M1', 'Dirección de la empresa');
$sheet->setCellValue('N1', 'Municipio o ciudad donde está realizando la etapa productiva');
$sheet->setCellValue('O1', 'Nombre del Jefe Inmediato');
$sheet->setCellValue('P1', 'Número de teléfono del Jefe Inmediato (supervisor)');
$sheet->setCellValue('Q1', 'Correo del Jefe Inmediato');
$sheet->setCellValue('R1', 'Tipo de Alternativa de Etapa Productiva');
$sheet->setCellValue('S1', 'INSTRUCTOR');
$sheet->setCellValue('T1', 'Documentos Entregados');
$sheet->setCellValue('U1', 'Respuesta Magna');
$sheet->setCellValue('V1', 'Registro de Etapa Productiva en Sena Sofia Plus');
$sheet->setCellValue('W1', 'Observaciones');
$sheet->setCellValue('X1', 'Fecha de Formalización');
$sheet->setCellValue('Y1', 'Fecha de Evaluación Parcial');
$sheet->setCellValue('Z1', 'Fecha de Evaluación Final');
$sheet->setCellValue('AA1', 'Fecha de Estado Por Certificar');
$sheet->setCellValue('AB1', 'Fecha Respuesta Certificación');
$sheet->setCellValue('AC1', 'URL del Formulario');
$sheet->setCellValue('AD1', 'Formato GFPI F023');
$sheet->setCellValue('AE1', 'Copia del Contrato');
$sheet->setCellValue('AF1', 'Formato GFPI F165');
$sheet->setCellValue('AG1', 'RUT o NIT');
$sheet->setCellValue('AH1', 'EPS');
$sheet->setCellValue('AI1', 'ARL');
$sheet->setCellValue('AJ1', 'Formato GFPI F023 Completo');
$sheet->setCellValue('AK1', 'Formato GFPI F147 Bitácoras');
$sheet->setCellValue('AL1', 'Certificación de Finalización');
$sheet->setCellValue('AM1', 'Estado Por Certificar');
$sheet->setCellValue('AN1', 'Copia de la Cédula');
$sheet->setCellValue('AO1', 'Pruebas y TyT');
$sheet->setCellValue('AP1', 'Destrucción de Carnet');
$sheet->setCellValue('AQ1', 'Certificado APE');
$sheet->setCellValue('AR1', 'Estado');
$sheet->setCellValue('AS1', 'Fecha de Solicitud de Paz y Salvo');
$sheet->setCellValue('AT1', 'Fecha de Respuesta del Coordinador');
$sheet->setCellValue('AU1', 'Observaciones de Seguimiento');
$sheet->setCellValue('AV1', 'ID de Usuario');
$sheet->setCellValue('AW1', 'ID del Instructor');
$sheet->getDefaultRowDimension()->setRowHeight(30);

// Escribir datos de la base de datos
$row = 2;
while ($row_data = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $row, $row_data['FechaRegistro']);
    $sheet->setCellValue('B' . $row, $row_data['NumeroDocumentoIdentidad']);
    $sheet->setCellValue('C' . $row, $row_data['NombreCompleto']);
    $sheet->setCellValue('D' . $row, $row_data['NumeroFicha']);
    $sheet->setCellValue('E' . $row, $row_data['CorreoElectronico']);
    $sheet->setCellValue('F' . $row, $row_data['NivelAcademico']);
    $sheet->setCellValue('G' . $row, $row_data['ProgramaFormacion']);
    $sheet->setCellValue('H' . $row, $row_data['NumeroCelular']);
    $sheet->setCellValue('I' . $row, $row_data['EmpresaInicioEtapaProductiva']);
    $sheet->setCellValue('J' . $row, $row_data['FechaInicioEtapa']);
    $sheet->setCellValue('K' . $row, $row_data['FechaFinEtapa']);
    $sheet->setCellValue('L' . $row, $row_data['NombreInstructorLectivo']);
    $sheet->setCellValue('M' . $row, $row_data['DireccionEmpresa']);
    $sheet->setCellValue('N' . $row, $row_data['MunicipioCiudad']);
    $sheet->setCellValue('O' . $row, $row_data['NombreJefeInmediato']);
    $sheet->setCellValue('P' . $row, $row_data['TelefonoJefeInmediato']);
    $sheet->setCellValue('Q' . $row, $row_data['CorreoJefeInmediato']);
    $sheet->setCellValue('R' . $row, $row_data['TipoAlternativaEtapaProductiva']);
    $sheet->setCellValue('S' . $row, $row_data['InstructorSeguimiento']);
    $sheet->setCellValue('T' . $row, $row_data['DocumentosEntregados']);
    $sheet->setCellValue('U' . $row, $row_data['Respuesmagna']);
    $sheet->setCellValue('V' . $row, $row_data['Registroetapaproductiva']);
    $sheet->setCellValue('W' . $row, $row_data['observaciones']);
    $sheet->setCellValue('X' . $row, $row_data['FechaFormalizacion']);
    $sheet->setCellValue('Y' . $row, $row_data['FechaEvaluacionParcial']);
    $sheet->setCellValue('Z' . $row, $row_data['FechaEvaluacionFinal']);
    $sheet->setCellValue('AA' . $row, $row_data['FechaEstadoPorCertificar']);
    $sheet->setCellValue('AB' . $row, $row_data['FechaRespuestaCertificacion']);
    $sheet->setCellValue('AC' . $row, $row_data['URLFormulario']);
    $sheet->setCellValue('AD' . $row, $row_data['FormatoGFPIF023']);
    $sheet->setCellValue('AE' . $row, $row_data['CopiaContrato']);
    $sheet->setCellValue('AF' . $row, $row_data['FormatoGFPIF165']);
    $sheet->setCellValue('AG' . $row, $row_data['RUToNIT']);
    $sheet->setCellValue('AH' . $row, $row_data['EPS']);
    $sheet->setCellValue('AI' . $row, $row_data['ARL']);
    $sheet->setCellValue('AJ' . $row, $row_data['FormatoGFPIF023Completo']);
    $sheet->setCellValue('AK' . $row, $row_data['FormatoGFPIF147Bitacoras']);
    $sheet->setCellValue('AL' . $row, $row_data['CertificacionFinalizacion']);
    $sheet->setCellValue('AM' . $row, $row_data['EstadoPorCertificar']);
    $sheet->setCellValue('AN' . $row, $row_data['CopiaCedula']);
    $sheet->setCellValue('AO' . $row, $row_data['PruebasTyT']);
    $sheet->setCellValue('AP' . $row, $row_data['DestruccionCarnet']);
    $sheet->setCellValue('AQ' . $row, $row_data['CertificadoAPE']);
    $sheet->setCellValue('AR' . $row, $row_data['Estado']);
    $sheet->setCellValue('AS' . $row, $row_data['FechaSolicitudPazySalvo']);
    $sheet->setCellValue('AT' . $row, $row_data['FechaRespuestaCoordinador']);
    $sheet->setCellValue('AU' . $row, $row_data['ObservacionesSeguimiento']);
    $sheet->setCellValue('AV' . $row, $row_data['id_user']);
    $sheet->setCellValue('AW' . $row, $row_data['id_intructor']);

    $sheet->getStyle('A' . $row . ':AW' . $row)->applyFromArray($dataStyle);
    $sheet->getStyle('A' . $row . ':AW' . $row)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('000000')); // Añadir bordes negros

    $row++;
}

// Guardar el archivo de Excel
$writer = new Xlsx($spreadsheet);

// Establecer las cabeceras para la descarga del archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="turco.xlsx"');

// Enviar el archivo Excel al navegador
$writer->save('php://output');

// Cerrar la conexión a la base de datos
$conn->close();
?>