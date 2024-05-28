<?php
require 'conexion.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $cumple = $_POST['ESTADO'];

    $query = "UPDATE datos_exceldatos1_1714747072 SET ESTADO = ? WHERE id = ?";
    $stmt = $con->prepare($query);
    if ($stmt->execute([$cumple, $id])) {
        echo "<script>alert('Registro actualizado correctamente.'); window.location='buscador.php';</script>";
    } else {
        echo "Error al actualizar el registro.";
    }
}
?>