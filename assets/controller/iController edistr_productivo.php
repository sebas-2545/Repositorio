<?php
include ("../../loginphp/conexion.php");
$observa="";

if(isset($_POST['observa'])){
   $observa = $_POST['observa'];
}
$identidad=$_POST['identidad'];
$nombre=$_POST['nombre'];
$ficha=$_POST['ficha'];
$correo=$_POST['correo'];
$celular=$_POST['celular'];
$nivel=$_POST['nivel'];
$programa=$_POST['programa'];
$instructor=$_POST['instructor'];
$productiva=$_POST['productiva'];
$fechainicio=$_POST['fechainicio'];
$fechacierre=$_POST['fechacierre'];
$ciudad=$_POST['ciudad'];
$jefe=$_POST['jefe'];
$direccem=$_POST['direccem'];
$correojefe=$_POST['correjefe'];
$celujefe=$_POST['celujefe'];
$instructoseg=$_POST['instructoseg'];
$alternativa=$_POST['alternativa'];
$id = $_POST['id'];
$fecres = $_POST['fecres'];
$fechacerti = $_POST['fechacerti'];
$fechares = $_POST['fechares'];
$fechafin = $_POST['fechafin'];
$fechaform = $_POST['fechaform'];
$fechaeva = $_POST['fechaeva'];
$fechapaz = $_POST['fechapaz'];
$respuestacor = $_POST['respuestacor'];
$rut = $_POST['rut'];
$eps = $_POST['eps'];
$arl = $_POST['arl'];
$form23par = $_POST['form23par'];
$form023 = $_POST['form023'];
$certifina = $_POST['certifina'];
$ape = $_POST['ape'];
$copi = $_POST['copi'];
$tyt = $_POST['tyt'];
$carnet = $_POST['carnet'];
$est = $_POST['est'];
$bita = $_POST['bita'];
$observacion = $_POST['observacion'];
$form165=$_POST['form165'];
$juicio=$_POST['tres'];
$dos=$_POST['dos'];
$link=$_POST['link'];
$sql = "UPDATE registroetapaproductiva SET 
       NumeroDocumentoIdentidad = '$identidad',
       NombreCompleto = '$nombre',
       NumeroFicha = '$ficha',
       CorreoElectronico = '$correo',
       NivelAcademico = '$nivel',
       ProgramaFormacion = '$programa',
       NumeroCelular = '$celular',
       EmpresaInicioEtapaProductiva = '$productiva',
       FechaInicioEtapa = '$fechainicio',
       FechaFinEtapa = '$fechacierre',
       NombreInstructorLectivo = '$instructor',
       DireccionEmpresa = '$direccem',
       MunicipioCiudad = '$ciudad',
       NombreJefeInmediato = '$jefe',
       TelefonoJefeInmediato = '$celujefe',
       CorreoJefeInmediato = '$correojefe',
       TipoAlternativaEtapaProductiva = '$alternativa',
       id_intructor = '$instructoseg',
        FechaEstadoPorCertificar = '$fechacerti',
        FechaRespuestaCertificacion = '$fechares',
        URLFormulario='$link',
        FechaEvaluacionFinal = '$fechafin',
        FechaFormalizacion = '$fechaform',
        FechaEvaluacionParcial = '$fechaeva',
        FechaSolicitudPazySalvo = '$fechapaz',
        FechaRespuestaCoordinador = '$respuestacor',
        RUToNIT = '$rut',
        EPS = '$eps',
        ARL = '$arl',
        FormatoGFPIF165='$form165',
        FormatoGFPIF023Completo = '$form23par',
        FormatoGFPIF023 = '$form023',
        CopiaContrato = '$dos',
        CertificacionFinalizacion = '$certifina',
        CertificadoAPE = '$ape',
        EstadoPorCertificar = '$juicio',
        CopiaCedula = '$copi',
        PruebasTyT = '$tyt',
        DestruccionCarnet = '$carnet',
        Estado = '$est',
        FormatoGFPIF147Bitacoras = '$bita',
        ObservacionesSeguimiento = '$observa',
        observaciones = '$observacion'
         WHERE id = $id";
         if ($conexion->query($sql) === true) {
            echo "<script>
               alert ('SU EDICION FUE EXITOSA');
            
               window.location='../../private/index.php'
               </script>";  
            }else {
            
               echo "error" . $sql ."<br>" . $conexion->error;
               
            }
?>

