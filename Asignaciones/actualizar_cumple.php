<?php
require '../loginphp/conexion.php'; 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar los valores recibidos

    $id = $_POST['id'];
    $cumple = $_POST['ESTADO'];

    // Actualizar el estado en la base de datos
    $query = "UPDATE fichas SET ESTADO = ? WHERE id = ?";
    $stmt = $conexion->prepare($query);
    if ($stmt->execute([$cumple, $id])) {
        echo "<script>alert('Registro actualizado correctamente.'); window.location='../private/newsadd.php';</script>";
    } else {
        echo "Error al actualizar el registro de estado.";
    }

    // Obtener datos adicionales del formulario
    $fecha_momento_uno = $_POST['fecha_momento_uno'][$id];
    $fecha_momento_dos = $_POST['fecha_momento_dos'][$id];
    $fecha_momento_tres = $_POST['fecha_momento_tres'][$id];

    // Actualizar la base de datos con los datos adicionales
    $query = "UPDATE fichas SET FECHA_MOMENTO_UNO = ?, FECHA_MOMENTO_DOS = ?, FECHA_MOMENTO_TRES = ? WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('sssi', $fecha_momento_uno, $fecha_momento_dos, $fecha_momento_tres, $id);

    if ($stmt->execute()) {
        echo "Datos actualizados correctamente.";
    } else {
        // Agregar mensajes de error para la consulta SQL
        echo "Error al actualizar los datos de las fechas: " . $stmt->errorInfo()[2];
    }
}
?>
