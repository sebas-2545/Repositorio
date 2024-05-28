<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Búsqueda Dinámica</title>
    <link rel="stylesheet" href="css/buscador.css">
    <link rel="stylesheet" href="inactivity_timer.js">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/2.3.7/css/searchPanes.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.3.7/js/dataTables.searchPanes.min.js"></script>
    <link href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/4.0.1/css/fixedColumns.dataTables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/4.0.1/js/dataTables.fixedColumns.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                scrollY: "800",
                scrollX: true,
                fixedColumns: {
                leftColumns: 2 // Fija las primeras 5 columnas
                },
                language: {
                    lengthMenu: "Mostrar _MENU_ registros por página",
                    search: "Buscar:",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "Mostrando 0 a 0 de 0 registros",
                    infoFiltered: "(filtrado de _MAX_ registros en total)",
                    zeroRecords: "No se encontraron registros coincidentes",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior"
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
    <style>
        
        .botoness {
            margin-bottom: 10px;
        }
        .dataTables_length{
            display: none;
        }
    </style>
</head>
<body>
    <div class="botoness">
        <form action="inicio.php" method="post">
            <button type="submit">Cargar Los Datos Excel</button>
        </form>
        <form action="descargar.php" method="post">
            <button type="submit">Descargar Datos en Excel</button>
        </form>
        <form action="login.php" method="get">
            <button class="Btn">
                <div class="sign">
                    <svg viewBox="0 0 512 512">
                        <path
                            d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"
                        ></path>
                    </svg>
                </div>
                <div class="text">  Salir</div>
            </button>
        </form>
    </div>

    

    <?php
require 'session_check.php';
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$host = "localhost";
$database = "exel";
$username = "root";
$password = "";

try {
    
    $con = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

    echo "Error de conexión: " . $e->getMessage();
}

$table = 'datos_exceldatos1_1714747072';
$query = "SELECT *, id AS editable_id FROM `{$table}`";


if (!empty($_GET['search'])) {
    $searchTerm = "%" . $_GET['search'] . "%";
    $query .= " WHERE `CODIGO DE FICHA` LIKE :search OR 
                   `NIVEL DE FORMACION` LIKE :search OR 
                   `NOMBRE_RESPONSABLE` LIKE :search OR 
                   `FECHA_INICIO_FICHA` LIKE :search OR
                   `FECHA_TERMINACION_FICHA` LIKE :search OR
                   `MODALIDAD` LIKE :search OR
                   `NOMBRE_PROGRAMA_FORMACION` LIKE :search OR
                   `NOMBRE_MUNICIPIO_CURSO` LIKE :search OR
                   `TOTAL_APRENDICES_ACTIVOS` LIKE :search OR
                   `FECHA TERMINACIÓN E.LECTIVA` LIKE :search OR
                   `FECHA TERM. E.PRODUCTIVA Y LEG.MATRICULA` LIKE :search OR
                   `FECHA LIMITE PARA INICIO DE ETAPA PRODUCTIVA` LIKE :search OR
                   `INSTRUCTOR_SEGUIMIENTO_ACTUAL` LIKE :search OR
                   `Correo_Instructor` LIKE :search OR
                   `INSTRUCTOR_ANTERIOR` LIKE :search OR
                   `CORREO` LIKE :search";
    $stmt = $con->prepare($query);
    $stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
} else {
    $stmt = $con->prepare($query);
}

$stmt->execute();
?>

<table id='dataTable'>
    <thead>
        <tr>
        <?php
        $columns = $con->query("SHOW COLUMNS FROM `{$table}`")->fetchAll(PDO::FETCH_COLUMN);
        foreach ($columns as $column) {
            echo "<th>$column</th>";
        }
        echo "<th>Editar El Estado</th>";
        ?>
        </tr>
    </thead>
    <tbody>
    <?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        foreach ($columns as $column) {
            $value = isset($row[$column]) ? $row[$column] : ''; 
            echo "<td>$value</td>";
        }
        echo "<td><form action='actualizar_cumple1.php' method='post'>";
        echo "<input type='hidden' name='id' value='{$row['editable_id']}'>";
        echo "<select name='ESTADO'>";
        echo "<option value='ABIERTO'" . ($row['ESTADO'] === 'abierto' ? ' selected' : '') . ">ABIERTO</option>";
        echo "<option value='CERRADO'" . ($row['ESTADO'] === 'cerrado' ? ' selected' : '') . ">CERRADO</option>";
        echo "</select>";
        echo "<input type='submit' class='' value='Actualizar'>";
        echo "</form></td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>


<?php
if (!empty($_SESSION['username'])) {
    $nombre_responsable = $_SESSION['username'];
    $stmt = $con->prepare("SELECT COUNT(*) AS count FROM `{$table}` WHERE `NOMBRE_RESPONSABLE` = :nombre_responsable");
    $stmt->bindParam(':nombre_responsable', $nombre_responsable, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

    if ($count > 0) {
        echo "<div>";
        echo "<form action='ver_fichas.php' method='post'>";
        echo "<input type='hidden' name='nombre_responsable' value='$nombre_responsable'></input>";
        echo "<button type='submit'>Ver Mis Fichas</button>";
        echo "</form>";
        echo "</div>";
    }
}
?>

</body>
</html>
