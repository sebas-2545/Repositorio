<?php
require '../../vendor/autoload.php';
include ("../../loginphp/conexion.php");
set_time_limit(300);

use PhpOffice\PhpSpreadsheet\IOFactory;

$archivo_nombre = $_FILES["archivo_excel"]["name"];
$archivo_temporal = $_FILES["archivo_excel"]["tmp_name"];
$archivo_error = $_FILES["archivo_excel"]["error"];
function convertirFechaMySQL($fecha) {
    if (empty($fecha)) {
        return ''; // Devuelve una cadena vacía si la fecha es nula o vacía
    }
    return date('Y-m-d', strtotime($fecha));
}

if($archivo_error === UPLOAD_ERR_OK) {
    
    $ruta_destino = "../uploads/" . $archivo_nombre;
    if(move_uploaded_file($archivo_temporal, $ruta_destino)) {
                $inputFileName = $ruta_destino;

                    class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter {
                        public function readCell(string $columnAddress, int $row, string $worksheetName = ''): bool {
                            if ($row > 1) {
                                return true;
                            }
                            return false;
                        }
                    }

                    $inputFileType = IOFactory::identify($inputFileName);

                    $reader = IOFactory::createReader($inputFileType);
                    $reader->setReadFilter( new MyReadFilter() );

                    $spreadsheet = $reader->load($inputFileName);
                    $sel = $spreadsheet->getActiveSheet()->toArray();
                    $for_time = microtime(true);

                    foreach ($sel as $r) {
                        if($r[0] != '') {
                            //busca si la persona ya esta registrada
                            $quer = "SELECT id FROM registroetapaproductiva WHERE NumeroDocumentoIdentidad ='$r[1]'";
                            $eje = $conexion->query($quer);
                           
                                $FechaRegistro = convertirFechaMySQL($r[0]);
                                $fechaInicioEtapa = convertirFechaMySQL($r[9]);
                                $fechaFinEtapa = convertirFechaMySQL($r[10]);
                                $fechaFormalizacion = convertirFechaMySQL($r[23]);
                                $fechaEvaluacionParcial = convertirFechaMySQL($r[24]);
                                $fechaEvaluacionFinal = convertirFechaMySQL($r[25]);
                                $fechaEstadoPorCertificar = convertirFechaMySQL($r[26]);
                                $fechaRespuestaCertificacion = convertirFechaMySQL($r[27]);
                                $fechaSolicitudPazySalvo = convertirFechaMySQL($r[44]);
                                $fechaRespuestaCoordinador = convertirFechaMySQL($r[45]);

                                if($eje->num_rows > 0) {
                                     // actualiza 
                                    $seb = $eje->fetch_assoc();
                                    $id = $seb['id'];
                                    $upda = "UPDATE registroetapaproductiva 
                                    SET 
                                    NombreCompleto = '$r[2]',
                                    NumeroFicha = '$r[3]',
                                    CorreoElectronico = '$r[4]',
                                    NivelAcademico = '$r[5]',
                                    ProgramaFormacion = '$r[6]',
                                    NumeroCelular = '$r[7]',
                                    EmpresaInicioEtapaProductiva = '$r[8]',
                                    FechaInicioEtapa = '$fechaInicioEtapa',
                                    FechaFinEtapa = '$fechaFinEtapa',
                                    NombreInstructorLectivo = '$r[11]',
                                    DireccionEmpresa = '$r[12]',
                                    MunicipioCiudad = '$r[13]',
                                    NombreJefeInmediato = '$r[14]',
                                    TelefonoJefeInmediato = '$r[15]',
                                    CorreoJefeInmediato = '$r[16]',
                                    TipoAlternativaEtapaProductiva = '$r[17]',
                                    InstructorSeguimiento ='$r[18]',
                                    DocumentosEntregados = '$r[19]',
                                    Respuesmagna = '$r[20]',
                                    Registroetapaproductiva = '$r[21]',
                                    observaciones = '$r[22]',
                                    FechaFormalizacion = '$fechaFormalizacion',
                                    FechaEvaluacionParcial = '$fechaEvaluacionParcial',
                                    FechaEvaluacionFinal = '$fechaEvaluacionFinal',
                                    FechaEstadoPorCertificar = '$fechaEstadoPorCertificar',
                                    FechaRespuestaCertificacion = '$fechaRespuestaCertificacion',
                                    URLFormulario = '$r[28]',
                                    Estado = '$r[43]',
                                    FechaSolicitudPazySalvo = '$fechaSolicitudPazySalvo',
                                    FechaRespuestaCoordinador = '$fechaRespuestaCoordinador',
                                    ObservacionesSeguimiento = '$r[46]',
                                    FormatoGFPIF023 = '$r[29]',
                                    CopiaContrato = '$r[30]',
                                    FormatoGFPIF165 = '$r[31]',
                                    RUToNIT = ' $r[32]',
                                    EPS = '$r[33]',
                                    ARL = '$r[34] ',
                                    FormatoGFPIF023Completo = '$r[35]',
                                    FormatoGFPIF147Bitacoras = ' $r[36]',
                                    CertificacionFinalizacion = '$r[37] ',
                                    EstadoPorCertificar = '$r[38]',
                                    CopiaCedula = '$r[39]',
                                    PruebasTyT = ' $r[40]',
                                    DestruccionCarnet = '$r[41]',
                                    CertificadoAPE = '$r[42]',
                                    WHERE id ='$id'";
                                    
                                            if ($conexion->query($upda) === true) {
                                                echo "La actualización fue exitosa" ;
                                            } else {
                                                echo "Error en la actualización: " . $conexion->error;
                                            }
                                    
                                } else {
                                    try {
                                        $secret = password_hash($r[1], PASSWORD_DEFAULT);
                                        $create = $conexion->prepare("INSERT INTO user (cedula, contrasena, id_rol) VALUES (?, ?, 2)");
                                        $create->bind_param("ss", $r[1], $secret);
                                        
                                        if ($create->execute()) {
                                            // Busca el instructor
                                            $instru = "SELECT * FROM fichas WHERE CODIGO_DE_FICHA = '$r[3]'";
                                            $ins = $conexion->query($instru);
                                            
                                        
                                                // Define la id del instructor
                                                $hs = $ins->fetch_assoc();
                                                $nombre = $hs['INSTRUCTOR_ANTERIOR'];
                                                $usuaa = "SELECT * FROM usuarios WHERE Nombre = '$nombre'";
                                                $testt = $conexion->query($usuaa);
                                                
                                                if ($testt && $testt->num_rows > 0) {
                                                    $gs = $testt->fetch_assoc();
                                                    $idusuario = $gs['idusuarios'];
                                                } else {
                                                    $idusuario = null; // No se encontró el usuario
                                                }
                                                
                                                $usr_id = $create->insert_id;
                                                
                                                // Prepara la consulta SQL
                                                $sql = "INSERT INTO registroetapaproductiva (
                                                    FechaRegistro, 
                                                    NumeroDocumentoIdentidad, 
                                                    NombreCompleto, 
                                                    NumeroFicha, 
                                                    CorreoElectronico, 
                                                    NivelAcademico, 
                                                    ProgramaFormacion, 
                                                    NumeroCelular, 
                                                    EmpresaInicioEtapaProductiva, 
                                                    FechaInicioEtapa, 
                                                    FechaFinEtapa, 
                                                    NombreInstructorLectivo, 
                                                    DireccionEmpresa, 
                                                    MunicipioCiudad, 
                                                    NombreJefeInmediato, 
                                                    TelefonoJefeInmediato, 
                                                    CorreoJefeInmediato, 
                                                    TipoAlternativaEtapaProductiva, 
                                                    InstructorSeguimiento,
                                                    DocumentosEntregados, 
                                                    Respuesmagna, 
                                                    Registroetapaproductiva, 
                                                    observaciones, 
                                                    FechaFormalizacion, 
                                                    FechaEvaluacionParcial, 
                                                    FechaEvaluacionFinal, 
                                                    FechaEstadoPorCertificar, 
                                                    FechaRespuestaCertificacion, 
                                                    URLFormulario, 
                                                    Estado, 
                                                    FechaSolicitudPazySalvo, 
                                                    FechaRespuestaCoordinador, 
                                                    ObservacionesSeguimiento, 
                                                    FormatoGFPIF023, 
                                                    CopiaContrato, 
                                                    FormatoGFPIF165, 
                                                    RUToNIT, 
                                                    EPS, 
                                                    ARL, 
                                                    FormatoGFPIF023Completo, 
                                                    FormatoGFPIF147Bitacoras, 
                                                    CertificacionFinalizacion, 
                                                    EstadoPorCertificar, 
                                                    CopiaCedula, 
                                                    PruebasTyT, 
                                                    DestruccionCarnet, 
                                                    CertificadoAPE, 
                                                    id_user, 
                                                    id_intructor
                                                ) VALUES (
                                                    '$FechaRegistro', 
                                                    '$r[1]', 
                                                    '$r[2]', 
                                                    '$r[3]', 
                                                    '$r[4]', 
                                                    '$r[5]', 
                                                    '$r[6]', 
                                                    '$r[7]', 
                                                    '$r[8]', 
                                                    '$fechaInicioEtapa', 
                                                    '$fechaFinEtapa', 
                                                    '$r[11]', 
                                                    '$r[12]', 
                                                    '$r[13]', 
                                                    '$r[14]', 
                                                    '$r[15]', 
                                                    '$r[16]', 
                                                    '$r[17]', 
                                                    '$r[18]',
                                                    '$r[19]', 
                                                    '$r[20]', 
                                                    '$r[21]', 
                                                    '$r[22]', 
                                                    '$fechaFormalizacion', 
                                                    '$fechaEvaluacionParcial', 
                                                    '$fechaEvaluacionFinal', 
                                                    '$fechaEstadoPorCertificar', 
                                                    '$fechaRespuestaCertificacion', 
                                                    '$r[28]', 
                                                    '$r[43]', 
                                                    '$fechaSolicitudPazySalvo', 
                                                    '$fechaRespuestaCoordinador', 
                                                    '$r[46]', 
                                                    '$r[29]', 
                                                    '$r[30]', 
                                                    '$r[31]', 
                                                    '$r[32]', 
                                                    '$r[33]', 
                                                    '$r[34]', 
                                                    '$r[35]', 
                                                    '$r[36]', 
                                                    '$r[37]', 
                                                    '$r[38]', 
                                                    '$r[39]', 
                                                    '$r[40]', 
                                                    '$r[41]', 
                                                    '$r[42]', 
                                                    '$usr_id',";
                                                
                                                if (!empty($idusuario)) {
                                                    $sql .= "'$idusuario')";
                                                } else {
                                                    $sql .= "NULL)";
                                                }
                                                
                                                $conexion->query($sql);
                                            
                                        }
                                    } catch (Exception $e) {
                                    }
                                    
                                    
                                } 

                      }else {
                            echo "no encontre datos que insertar " . '</br>';
                     }
                    }

        } else {
                    echo "Error al mover el archivo a la ubicación deseada.";
        }
} else {
    echo "Error al subir el archivo.";
}

echo "<script>
        alert ('EXCEL IMPORTADO CON EXITO');

        window.location='../../private/perfil.php';
        </script>";
?>
