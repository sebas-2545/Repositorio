<?php
require '../loginphp/conexion.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $cumple = $_POST['ESTADO'];

    $query = "UPDATE fichas SET ESTADO = ? WHERE id = ?";
    $stmt = $conexion->prepare($query);
    if ($stmt->execute([$cumple, $id])) {
        echo "<script>alert('Registro actualizado correctamente.'); window.location='../private/newsadd.php';</script>";
    } else {
        echo "Error al actualizar el registro.";
    }
}
?>

<?php
include ("../loginphp/conexion.php");
session_start();


// Obtener datos del formulario
$id = $_POST['id'];
$fecha_momento_uno = $_POST['fecha_momento_uno'][$id];
$fecha_momento_dos = $_POST['fecha_momento_dos'][$id];
$fecha_momento_tres = $_POST['fecha_momento_tres'][$id];
$estado = $_POST['ESTADO'];

// Actualizar la base de datos
$query = "UPDATE fichas SET FECHA_MOMENTO_UNO = ?, FECHA_MOMENTO_DOS = ?, FECHA_MOMENTO_TRES = ?, ESTADO = ? WHERE id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param('ssssi', $fecha_momento_uno, $fecha_momento_dos, $fecha_momento_tres, $estado, $id);

if ($stmt->execute()) {
    echo "Datos actualizados correctamente.";
} else {
    echo "Error al actualizar los datos.";
}

// Redirigir de vuelta a la página principal
header("Location: ../private/newsadd.php.php");
?>
