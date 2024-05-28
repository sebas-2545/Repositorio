<?php
require '../../vendor/autoload.php';

include ("../../loginphp/conexion.php");

$delete="TRUNCATE TABLE TYT";
$conn->query($sql);
use PhpOffice\PhpSpreadsheet\IOFactory;

$archivo_nombre = $_FILES["archivo_excel"]["name"];
$archivo_temporal = $_FILES["archivo_excel"]["tmp_name"];
$archivo_error = $_FILES["archivo_excel"]["error"];


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
                                          
                                             $sql = "INSERT INTO TYT(FechaReporte, DNI, Regional, ID_centro, Centro, Convocatoria, NIS, PrimerApellido, SegundoApellido, PrimerNombre, OtrosNombres, TiposDocumentos, NroDocumentos, CorreoPersonal, CorreoSoySena, PaisResidencia, DTPResidencia, CiudadReisden, Telefonos, Celular, CodigoMunicipio, MunicipioPrograma, Nivel, CodigoPrograma, VersionPrograna, Programa, ficha, EstadoFicha, Modalidad, Fechainicio, FechaFinElectiva, FechaFinFicha, AnoFechFin, EstadoAprendiz, ResulatadoRequeridos, ResultadosAprobados, PuntajeEB, FechaVencimiento, Registro, RegistraPruebaEnSOFIAPlus, SNPRegistradaEnSOFIAPlus, FechaPresentaciónDelSNP, AplicóBeneficioAnteriormente, RegistrodelBeneficio, AvanceBDPreliminarDOSSemestre, VENCIMIENTODETERMINOS, ValidacióndePruebaRegistrada, BeneficioParaConvocatoria, RegistraInscripciónSemestre, DatosdeInscripciónSemestre, EstadoSENABDPreliminar, ResponsablePagoBDPreliminar, ObservacionesBDPreliminar) VALUES ('$r[0]','$r[1]','$r[2]','$r[3]','$r[4]','$r[5]','$r[6]','$r[7]','$r[8]','$r[9]','$r[10]','$r[11]','$r[12]','$r[13]','$r[14]','$r[15]','$r[16]','$r[17]','$r[18]','$r[10]','$r[20]','$r[21]','$r[22]','$r[23]','$r[24]','$r[25]','$r[26]','$r[27]','$r[28]','$r[29]','$r[30]','$r[31]','$r[32]','$r[33]','$r[34]','$r[35]','$r[36]','$r[37]','$r[38]','$r[39]','$r[40]','$r[41]','$r[42]','$r[43]','$r[44]','$r[45]','$r[46]','$r[47]','$r[48]','$r[49]','$r[50]','$r[51]','$r[52]')";
                                             $conn->query($sql);
                                             
                        }  
                        
                    }

        } else {
            echo "<script>
            alert ('ERROR AL SUBIR EL ');
        
            window.location='../../private/Miaprendiz.php'
            </script>";  
        }
} else {
    echo "Error al subir el archivo.";
}
echo "lito";

?>