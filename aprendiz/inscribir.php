<?php
include ("../loginphp/conexion.php");
session_start();

if(isset($_SESSION['cedula'])){
    $cedula=$_SESSION['cedula'];
    $id_rol= $_SESSION['id_rol'];
    $use="SELECT * FROM user WHERE cedula='$cedula'";
    $res=$conexion->query($use);
    $row=$res->fetch_assoc();
   $id=$row['id'];
   $email=$row['email'];
    $eta="SELECT * FROM registroetapaproductiva where id_user='$id'";
    $ress=$conexion->query($eta);
    $r=$ress->fetch_assoc();

    if($id_rol!=5){
        header("Location:  ../loginphp/loginAprendiz.php");
    }

}else{
    header("Location:  ../loginphp/loginAprendiz.php");
    exit();
}
?>

<!DOCTYPE html>

<html lang="es">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Sistema - Panel Principal</title>
		<link rel="shortcut icon" href="../assets/etapa/icono.ico" type="image/x-icon">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../assets/datatables/datatables.css" />
		<link href="../assets/css/hebbo.css" rel="stylesheet">
        <link href="../assets/css/inscribir.css" rel="stylesheet">

		<link rel="stylesheet" href="../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-rtl.min.css" />
		<script src="../assets/js/ace-extra.min.js"></script>

	</head>

	<body class="no-skin">
		<?php require_once("encabeza.php"); ?>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container','fixed')}catch(e){}
			</script>
				
				<!-- MOSTRAR EL MENU  -->
				<?php require_once("menulateral.php"); ?>
				<!-- fin Menu Lateral -->

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="aprendiz.php">Inicio</a>
							</li>
							<li class="active">Panel Principal </li>
						</ul><!-- /.breadcrumb -->

						<!--
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Buscar ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div> /.nav-search -->
					</div>

					<div class="page-content">

						<div class="row">
							<div class="col-xs-12">
								
							
							<!-- PAGE CONTENT BEGINS -->

								<div class="page-header clearfix">
                       			 <h2 class="pull-left">Registro Etapa Productiva  <?php echo $email?></h2>
                    			</div>

<div class="row">
<div class="form">
                        <H1>   </H1>
        <form action="../assets/controller/ControllerRegistro_productivo.php" method="post"  id="miFormulario"class="formulario">
            <div class="box">
                <div class="box1">
                    <label for="">Documento de identidad*</label>
                    <input type="number" name="identidad"  placeholder="11082638273"   value="<?php if($ress->num_rows>0){ echo $r['NumeroDocumentoIdentidad']; } ?>" required>
                </div>
                
                <div class="box1">
                    <label for="">nombre completo*</label>
                    <input type="text" name="nombre"  placeholder="Juan Perez"   value="<?php if($ress->num_rows>0){ echo $r['NombreCompleto']; } ?>" required>
                </div>
                
            
                <div class="box1">
                 <label for="">número de ficha*</label>
                    <input type="number" name="ficha"  placeholder="2558068"   value="<?php if($ress->num_rows>0){ echo $r['NombreCompleto']; } ?>" required>
                </div>
                
                
            </div>

            <div class="box">

            <div class="box1">
                 <label for=""> correo electrónico*</label>
                    <input type="email" name="correo"  placeholder="<?php echo $email ?>"   value="<?php if($ress->num_rows>0){ echo $r['CorreoElectronico']; } ?>" required>
                </div>

                <div class="box1">
                     <label for=""> número de su celular o familiar cercano* </label>
                <input type="number" name="celular"  placeholder="35638167347"   value="<?php if($ress->num_rows>0){ echo $r['NumeroCelular']; } ?>" required>
                </div>
                <div class="box1">
                <label for="">nivel académico que esta cursando*</label>
                <select name="nivel" id=""   value="<?php if($ress->num_rows>0){ echo $r['NivelAcademico']; } ?>" required>
                    <option value=" <?php if($ress->num_rows>0){ echo $r['NivelAcademico']; } ?>"><?php if($ress->num_rows>0){ echo $r['NivelAcademico']; } ?></option>
                    <option value="Operario">Operario</option>
                    <option value="Tecnico">Técnico</option>
                    <option value="Tecnologo">Tecnológo</option>
                </select>
                </div>
                
            </div>

            <div class="box">
                <div class="box1">
                <label for="">Programa de formacion*</label> 
                <input type="text" name="programa"  placeholder="Analisis y desarrollo de sofware"   value="<?php if($ress->num_rows>0){ echo $r['ProgramaFormacion']; } ?>" required>
            
                </div>
                <div class="box1">
                <label for="">instructor técnico en la etapa lectiva* </label>
                <input type="text" name="instructor"  placeholder="Sara perez"   value="<?php if($ress->num_rows>0){ echo $r['NombreInstructorLectivo']; } ?>" required>
                </div>
                <div class="box1">
                <label for="">Empresa donde inicia la etapa productiva*</label>
                <input type="text" name="productiva"  placeholder="softonline"   value="<?php if($ress->num_rows>0){ echo $r['EmpresaInicioEtapaProductiva']; } ?>" required>
            
                </div>
            </div>

            <div class="box">
                
                <div class="box1">
                <label for="">Fecha en la que inicio la etapa productiva* <br>
                en la empresa</label>
                <input type="date" name="fechainicio"  placeholder="Juan Perez"   value="<?php if($ress->num_rows>0){ echo $r['FechaInicioEtapa']; } ?>" required>
                </div>
               
           
                <div class="box1">
                <label for="">Fecha en la que termina la etapa <br> productiva en la empresa*</label>
                <input type="date" name="fechacierre"  placeholder="11082638273"   value="<?php if($ress->num_rows>0){ echo $r['FechaInicioEtapa']; } ?>" required>
                </div>
           
                <div class="box1">
                <label for=""> Municipio o ciudad donde esta realizando <br> la etapa productiva*</label>
                <input type="text" name="ciudad"  placeholder="Ibague"   value="<?php if($ress->num_rows>0){ echo $r['MunicipioCiudad']; } ?>" required>
                </div>
                
            </div>
            <div class="box">

            <div class="box1">
                <label for=""> Direccion Empresa*</label>
                <input type="text" name="direccem"  placeholder="Ibague"   value="<?php if($ress->num_rows>0){ echo $r['DireccionEmpresa']; } ?>" required>
            </div>
                <div class="box1">
                <label for="">Nombre del Jefe Inmediato*</label>
                <input type="text" name="jefe"  placeholder="Carlos Ramirez"   value="<?php if($ress->num_rows>0){ echo $r['NombreJefeInmediato']; } ?>" required>
              
                </div>
                
                <div class="box1">
                <label for="">Número de teléfono del jefe inmediato*</label>
                <input type="number" name="celujefe"  placeholder="31567899876"   value="<?php if($ress->num_rows>0){ echo $r['TelefonoJefeInmediato']; } ?>" required>
                </div>
              
                
               
            </div>
            <div class="box">
            <div class="box1">
                <label for="">correo del jefe inmediato*</label>
                <input type="email" name="correjefe"  placeholder="31567899876"    value="<?php if($ress->num_rows>0){ echo $r['CorreoJefeInmediato']; } ?>" required>
                </div>

            <div class="box1">
            <label for="">alternativa de etapa productiva que esta realizando*</label>
                <select name="alternativa" id=""   required>
                    <option value="<?php if($ress->num_rows>0){ echo $r['TipoAlternativaEtapaProductiva']; } ?>">  <?php if($ress->num_rows>0){ echo $r['TipoAlternativaEtapaProductiva']; } ?>  </option>
                    <option value="Contrato de aprendizaje">Contrato de aprendizaje</option>
                    <option value="Vinculo Laboral">Vinculo Laboral</option>
                    <option value="Pasantía - PYME">Pasantía - PYME</option>
                    <option value="Pasantía. Institución estatal nacional, territorial, o una ONG, o una entidad sin animo de lucro">Pasantía. Institución estatal nacional, territorial, o una ONG, o una entidad sin animo de lucro</option>
                    <option value="Proyecto productivo">Proyecto productivo</option>
                    <option value=" Pasantía - Proyecto productivo - Unidad productiva familiar"> Pasantía - Proyecto productivo - Unidad productiva familiar</option>
                    <option value="Monitoría">Monitoría</option>
                </select>
                </div>
                <div class="box1">
                <label for=""> Nombre del Instructor de seguimiento*
                </label>
                <select name="instructoseg" id=""   value="" required>
    <option value="">Seleccione</option>
    <?php
    $sql = "SELECT * FROM usuarios";
    $res = $conexion->query($sql); 
    while ($row = $res->fetch_assoc()) {
        echo "<option value='" . $row['idusuarios'] . "'>" . $row['Nombre'] . "</option>";
    }
    ?>
</select>

            </div>
            </div>
                <input type="text"  name="fecharegi" value="<?php echo date("Y-m-d");  ?> "  id="mi_input" style="display: none;">
                <input type="text"  name="id_user" value="<?php echo $id;  ?> "  id="mi_input" style="display: none;">

                
                
            <div class="confirmar">
                <label>
                    <p>Confirme si ya entregó los documentos de formalización al instructor de seguimiento
                        (Formato-f-GFPI-023-concertación de actividades, Copia del Contrato, Copia de la cédula,
                        EPS, ARL, Formato-f-GFPI-165). Si no los ha entregado, lo invitamos a que lo haga de forma urgente para que quede 
                        formalizada y aceptada su etapa productiva. Debe enviarlos en PDF al correo electrónico del instructor de seguimiento*.</p>
                </label>
                <input aria-posinset="1" aria-setsize="1" aria-labelledby="QuestionChoiceOption17" aria-checked="true" role="checkbox" type="checkbox" class="-hm-81"  name="confirmar" value="Si"  required>

            </div>
            <button class="brn" type="submit">

  <div class="svg-wrapper-1">
    <div class="svg-wrapper">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        width="24"
        height="24"
      >
        <path fill="none" d="M0 0h24v24H0z"></path>
        <path
          fill="currentColor"
          d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"
        ></path>
      </svg>
    </div>
  </div>
  <span>ENVIA</span>
</button>
</form>
    </div>
									



								
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
			
			<?php require_once("piedepagina.php"); ?>
			<!-- /.Pie de pagina -->
			
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<script src="../assets/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript">
			window.jQuery || document.write("<script src='../assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../assets/js/bootstrap.min.js"></script>
		<script src="../assets/js/jquery-ui.custom.min.js"></script>
		<script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../assets/js/jquery.easypiechart.min.js"></script>
		<script src="../assets/js/jquery.sparkline.index.min.js"></script>
		<script src="../assets/js/jquery.flot.min.js"></script>
		<script src="../assets/js/jquery.flot.pie.min.js"></script>
		<script src="../assets/js/jquery.flot.resize.min.js"></script>
		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>
		<script src="../assets/datatables/datatables.min.js"></script>
		<script src="../assets/datatables/revisar.js"></script>
	</body>
</html>
