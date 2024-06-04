<?php
// Configuración de la base de datos
$server = "localhost";
$user = "root";
$password = "";
$bd = "recuperar";

// Obtener la pregunta del usuario
$userInput = $_GET['q'];

// Conexión a la base de datos
$conn = new mysqli($server, $user, $password, $bd);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Preparar la consulta con búsqueda de coincidencias parciales
$sql = $conn->prepare("SELECT respuesta FROM respuestas WHERE pregunta LIKE CONCAT('%', ?, '%')");
$sql->bind_param("s", $userInput);
$sql->execute();
$result = $sql->get_result();

// Verificar si se encontró una respuesta
if ($result->num_rows > 0) {
    // Mostrar la respuesta del chatbot
    $row = $result->fetch_assoc();
    $respuesta = $row["respuesta"];
    echo json_encode(['text' => $respuesta]);
} else {
    echo json_encode(['text' => "Lo siento, no tengo una respuesta para esa pregunta."]);
}

$conn->close();
?>
