<?php
include ("../loginphp/conexion.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $fecha_momento_uno = $_POST['FECHA_MOMENTO_UNO'];
    $fecha_momento_dos = $_POST['FECHA_MOMENTO_DOS'];
    $fecha_momento_tres = $_POST['FECHA_MOMENTO_TRES'];

    $sql = "UPDATE fichas SET 
            FECHA_MOMENTO_UNO = ?
            FECHA_MOMENTO_DOS = ?,
            FECHA_MOMENTO_TRES = ?
            WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$fecha_momento_uno, $fecha_momento_dos, $fecha_momento_tres, $id]);

    echo "Datos actualizados correctamente.";
    header("Location:../private/buscador.php");
    exit;
}
?>
