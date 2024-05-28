<?php
include ("../loginphp/conexion.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $instructor_2024 = $_POST['INSTRUCTOR_SEGUIMIENTO_ACTUAL'];
    $correo_instructor_2024 = $_POST['Correo_Instructor'];
    $instructor_2023 = $_POST['INSTRUCTOR_ANTERIOR'];
    $correo_instructor_2023 = $_POST['CORREO'];

    $sql = "UPDATE datos_exceldatos1_1714747072 SET 
            INSTRUCTOR_SEGUIMIENTO_ACTUAL = ?, 
            Correo_Instructor = ?, 
            INSTRUCTOR_ANTERIOR = ?, 
            CORREO = ?
            WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$instructor_2024, $correo_instructor_2024, $instructor_2023, $correo_instructor_2023, $id]);

    echo "Datos actualizados correctamente.";
    header("Location:../private/buscador.php");
    exit;
}
?>
