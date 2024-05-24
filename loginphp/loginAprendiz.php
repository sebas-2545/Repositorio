

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Login  - Sistema de Usuarios</title>
		<link rel="shortcut icon" href="../assets/etapa/icono.ico" type="image/x-icon">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../assets/etapa/style.css" />
		<!-- text fonts -->
		<link rel="stylesheet" href="../assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="../assets/css/ace.min.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="../assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">

							<div class="space-6"></div>

<div class="position-relative">
	<div id="login-box" class="login-box visible widget-box no-border">
		<div class="widget-body">
			<div class="widget-main">
				<h1>
					<i class="ico ico-sena green bigger-225 pull-left btn-lg"></i>
					<span class="gray">Sistema </span>
					<span class="green" id="id-text2">Etapa Productiva</span>
				</h1>
				<h5 class="header lighter smaller">
				<i class="bi bi-door-open"></i>
				INGRESO USUARIOS REGISTRADOS
				</h5>
				<div class="space-6"></div>
				<form action="../assets/controller/ControllerLogin.php" method="POST" >
					<fieldset>
					<label class="block clearfix">
					<span class="block input-icon input-icon-right">
					<input type="text" class="form-control"  name="user"placeholder="Usuario" required/>
					<i class="ace-icon fa fa-user"></i>
					</span>
					</label>
					<label class="block clearfix">
					<span class="block input-icon input-icon-right">
					<input type="password" name="pass"class="form-control" placeholder="Contraseña" required/>
					<i class="ace-icon fa fa-lock"></i>
					</span>
					</label>
			
					<div class="space"></div>
					
					<div class="clearfix">
					<button type="submit" class="width-100 btn btn-sm btn-primary">
					<i class="ace-icon fa fa-key"></i>
					<span class="bigger-110">Ingresar</span>
					</button>
					</div><!-- clearfix -->
					<div class="space-4"></div>
					</fieldset>
				</form>
																						
			</div>
			<div class="toolbar clearfix">
				<div>
				<a href="#" data-target="#forgot-box" class="forgot-password-link">
				<i class="ace-icon bi bi-key-fill"></i>
				Olvide mi contraseña
				</a>
				</div>

				<div><a href="registro.php"  class="forgot-password-link">
				<i class="ace-icon bi bi-key-fill"></i>
				registrarse
				</a></div>
				

			</div>
		</div><!-- /.widget-body -->
	</div><!-- /.login-box -->

	<div id="forgot-box" class="forgot-box widget-box no-border">
    <div class="widget-body">
        <div class="widget-main">
            <h4 class="header red lighter bigger">
                <i class="ace-icon fa fa-key"></i>
                Recuperar Contraseña
            </h4>
            <div class="space-6"></div>
            <p>
                Ingrese tu correo electrónico para recibir las instrucciones
            </p>
            <form method="POST" action="../assets/controller/ControllerRecuperar_contraseña.php">
                <fieldset>
                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <input type="email" name="email" class="form-control" placeholder="Email" required />
                            <i class="ace-icon fa fa-envelope"></i>
                        </span>
                    </label>
                    <div class="clearfix">
                        <button type="submit" class="width-35 pull-right btn btn-sm btn-danger">
                            <i class="ace-icon fa fa-lightbulb-o"></i>
                            <span class="bigger-110">Enviar</span>
                        </button>
                    </div>
                </fieldset>
            </form>
        </div><!-- /.widget-main -->
        <div class="toolbar center">
            <a href="#" data-target="#login-box" class="back-to-login-link">
                Regresar al Login
                <i class="ace-icon fa fa-arrow-right"></i>
            </a>
        </div>
    </div><!-- /.widget-body -->
</div><!-- /.forgot-box -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="../assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
		</script>
	</body>
</html>