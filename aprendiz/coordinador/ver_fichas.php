<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Fichas Asignadas</title>
    <link rel="stylesheet" href="css/editar.css">
    <script src="inactivity_timer.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="http://localhost/xampp/composer/datatables/datatables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.3.7/css/searchPanes.dataTables.min.css">
    <script src="https://cdn.datatables.net/searchpanes/2.3.7/js/dataTables.searchPanes.min.js"></script>
    <link href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                scrollY: "800",
                scrollX: true,
                language: {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "search": "Buscar:",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                    "infoFiltered": "(filtrado de _MAX_ registros en total)",
                    "zeroRecords": "No se encontraron registros coincidentes",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                dom: 'Plfrtip',
                searchPanes: {
                    controls: false,
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15] 
                }
            });
        });
    </script>
</head>
<body>
    <div class="container">
    <?php
// Incluir archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se ha enviado el nombre del responsable desde el formulario
if (isset($_POST['nombre_responsable'])) {
    $nombre_responsable = $_POST['nombre_responsable'];

    // Consulta para obtener las fichas asociadas al nombre del responsable
    $query = "SELECT * FROM `datos_exceldatos1_1714747072` WHERE `NOMBRE_RESPONSABLE` = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('s', $nombre_responsable);
    $stmt->execute();
    $result = $stmt->get_result();

    // Mostrar resultados en una tabla
    echo "<h2>Fichas asignadas a $nombre_responsable</h2>";
    echo "<table id='dataTable' class='display'>";
    echo "<thead><tr><th>CODIGO DE FICHA</th><th>NIVEL DE FORMACION</th><th>NOMBRE_RESPONSABLE</th><th>FECHA_INICIO_FICHA</th><th>FECHA_TERMINACION_FICHA</th><th>MODALIDAD</th><th>NOMBRE_PROGRAMA_FORMACION</th><th>NOMBRE_MUNICIPIO_CURSO</th><th>TOTAL_APRENDICES_ACTIVOS</th><th>FECHA TERMINACIÓN E.LECTIVA</th><th>FECHA TERM. E.PRODUCTIVA Y LEG.MATRICULA</th><th>FECHA LIMITE PARA INICIO DE ETAPA PRODUCTIVA</th><th>INSTRUCTOR_SEGUIMIENTO_ACTUAL</th><th>Correo_Instructor</th><th>INSTRUCTOR_ANTERIOR</th><th>CORREO</th><th>ESTADO</th><th>ACCIONES</th></tr></thead>
    <tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['CODIGO DE FICHA'] . "</td>";
        echo "<td>" . $row['NIVEL DE FORMACION'] . "</td>";
        echo "<td>" . $row['NOMBRE_RESPONSABLE'] . "</td>";
        echo "<td>" . $row['FECHA_INICIO_FICHA'] . "</td>";
        echo "<td>" . $row['FECHA_TERMINACION_FICHA'] . "</td>";
        echo "<td>" . $row['MODALIDAD'] . "</td>";
        echo "<td>" . $row['NOMBRE_PROGRAMA_FORMACION'] . "</td>";
        echo "<td>" . $row['NOMBRE_MUNICIPIO_CURSO'] . "</td>";
        echo "<td>" . $row['TOTAL_APRENDICES_ACTIVOS'] . "</td>";
        echo "<td>" . $row['FECHA TERMINACIÓN E.LECTIVA'] . "</td>";
        echo "<td>" . $row['FECHA TERM. E.PRODUCTIVA Y LEG.MATRICULA'] . "</td>";
        echo "<td>" . $row['FECHA LIMITE PARA INICIO DE ETAPA PRODUCTIVA'] . "</td>";
        echo "<td>" . $row['INSTRUCTOR_SEGUIMIENTO_ACTUAL'] . "</td>";
        echo "<td>" . $row['Correo_Instructor'] . "</td>";
        echo "<td>" . $row['INSTRUCTOR_ANTERIOR'] . "</td>";
        echo "<td>" . $row['CORREO'] . "</td>";
        echo "<td>" . $row['ESTADO'] . "</td>";
        echo "<td>";
        echo "<form action='actualizar_cumple.php' method='post'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
        echo "<select name='estado'>";
        echo "<option value='abierto'" . ($row['ESTADO'] === 'abierto' ? ' selected' : '') . ">Abierto</option>";
        echo "<option value='cerrado'" . ($row['ESTADO'] === 'cerrado' ? ' selected' : '') . ">Cerrado</option>";
        echo "</select>";
        echo "<input type='submit' value='Guardar'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
    // Botón de regreso
    echo "<button id='redirectButton'>";
    echo "<svg height='16' width='16' xmlns='http://www.w3.org/2000/svg' version='1.1' viewBox='0 0 1024 1024'><path d='M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z'></path></svg>";
    echo "<span>Regresar</span>";
    echo "</button>";

    echo "<script>";
    echo "document.getElementById('redirectButton').addEventListener('click', function() {";
    echo "window.location.href = 'http://localhost/xampp/composer/buscadorinstru.php?search=';";
    echo "});";
    echo "</script>";

} else {
    echo "No se ha proporcionado el nombre del responsable.";
}
?>


    </div>
</body>
</html>
