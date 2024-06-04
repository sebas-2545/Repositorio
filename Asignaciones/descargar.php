<?php
require '../loginphp/conexion.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

$table = 'fichas';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $table . '.xlsx"');

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();


$headerStyle = [
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'color' => ['argb' => 'FFFF00'],
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
    ]
];


$columnResult = $con->query("SHOW COLUMNS FROM `$table` WHERE Field != 'id'");
if (!$columnResult) {
    die('Error al obtener las columnas de la tabla.');
}
$columns = $columnResult->fetchAll(PDO::FETCH_COLUMN);

$columnIndex = 'A';
foreach ($columns as $column) {
    $sheet->setCellValue($columnIndex . '1', $column);
    $sheet->getColumnDimension($columnIndex)->setAutoSize(true);
    $sheet->getStyle($columnIndex . '1')->applyFromArray($headerStyle);
    $columnIndex++;
}


$query = $con->query("SELECT " . implode(", ", array_map(function ($column) { return "`$column`"; }, $columns)) . " FROM `$table`");
if (!$query) {
    die('Error al consultar los datos de la tabla.');
}
$rowCount = 2;

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $columnIndex = 'A';
    foreach ($row as $cellValue) {
        $sheet->setCellValue($columnIndex . $rowCount, $cellValue);
        $columnIndex++;
    }
    $rowCount++;
}


$cellRange = 'A1:' . $columnIndex . ($rowCount - 1);
$sheet->getStyle($cellRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);


$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
