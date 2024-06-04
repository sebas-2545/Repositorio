<?php
include ("../loginphp/conexion.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $instructor_2024 = $_POST['INSTRUCTOR_SEGUIMIENTO_ACTUAL'];
    $correo_instructor_2024 = $_POST['Correo_Instructor'];
    $instructor_2023 = $_POST['INSTRUCTOR_ANTERIOR'];
    $correo_instructor_2023 = $_POST['CORREO'];
    $fecha_momento_uno = $_POST['FECHA_MOMENTO_UNO'];
    $fecha_momento_dos = $_POST['FECHA_MOMENTO_DOS'];
    $fecha_momento_tres = $_POST['FECHA_MOMENTO_TRES'];

    $sql = "UPDATE fichas SET 
            INSTRUCTOR_SEGUIMIENTO_ACTUAL = ?, 
            Correo_Instructor = ?, 
            INSTRUCTOR_ANTERIOR = ?, 
            CORREO = ?,
            FECHA_MOMENTO_UNO = ?,
            FECHA_MOMENTO_DOS = ?,
            FECHA_MOMENTO_TRES = ?
            WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$instructor_2024, $correo_instructor_2024, $instructor_2023, $correo_instructor_2023, $fecha_momento_uno, $fecha_momento_dos, $fecha_momento_tres, $id]);

    echo "Datos actualizados correctamente.";
    header("Location:../private/buscador.php");
    exit;
}
?>
