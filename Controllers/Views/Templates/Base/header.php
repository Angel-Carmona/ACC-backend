<?php

function comprimir_pagina($buffer)
{
    $busca = array('/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s');
    $reemplaza = array('>','<','\\1');
    return preg_replace($busca, $reemplaza, $buffer);
}


ob_start('comprimir_pagina');

use App\Globals\Globals;
use Controllers\User\User;
use Controllers\System\System;
use Controllers\Session\Session;

System::addVisita();

$onlyAdmin = User::getUserID() == 1 ? "" : "d-none";
User::getCurretnUser();
?>
<!DOCTYPE html>
<html lang="es" class="no-loaded">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Peritaciones AC</title>
	<style>
		<?php echo comprimir_pagina(file_get_contents(Globals::URL.'assets/plugins/aos/aos.css'))?>
		<?php echo comprimir_pagina(file_get_contents(Globals::URL.'assets/plugins/animate/animate.min.css'))?>
	</style>


	<script type="text/javascript">
		<?php echo comprimir_pagina(file_get_contents(Globals::URL.'assets/plugins/aos/aos.js'))?>
	</script>

	<!-- DevExtreme theme -->
	<link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/23.1.3/css/dx.light.css">

	<script type="text/javascript">
		<?php echo comprimir_pagina(file_get_contents(Globals::URL.'assets/js/jQuery.min.js'))?> ;
		<?php echo comprimir_pagina(file_get_contents(Globals::URL.'assets/plugins/sweetAlert/sweetAlert.min.js'))?>
	</script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"
		crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- DevExtreme library -->
	<script type="text/javascript"
		src="<?php echo Globals::URL?>assets/js/dx.all.js"></script>

	<?php if (defined('ADD_CUSTOM_CSS') && ADD_CUSTOM_CSS == 1) : ?>

	<link
		href="<?php echo Globals::URL; ?>assets/css/contextMenu.css"
		rel="stylesheet" type="text/css" />

	<script src="<?php echo Globals::URL; ?>assets/js/context-menu.js"
		type="text/javascript"></script>


	<link rel="stylesheet" type="text/css"
		href="<?php echo Globals::URL; ?>assets/plugins/dataTables/jquery.dataTables.min.css" />

	<script type="text/javascript"
		src="<?php echo Globals::URL; ?>assets/plugins/dataTables/jquery.dataTables.min.js">
	</script>

	<script type="text/javascript"
		src="<?php echo Globals::URL; ?>assets/plugins/dataTables/buttons.min.js">
	</script>

	<script type="text/javascript"
		src="<?php echo Globals::URL; ?>assets/plugins/dataTables/jszip.min.js">
	</script>

	<script type="text/javascript"
		src="<?php echo Globals::URL; ?>assets/plugins/dataTables/pdfmake.min.js">
	</script>

	<script type="text/javascript"
		src="<?php echo Globals::URL; ?>assets/plugins/dataTables/vfs_fonts.js">
	</script>

	<script type="text/javascript"
		src="<?php echo Globals::URL; ?>assets/plugins/dataTables/buttons.html5.min.js">
	</script>

	<script type="text/javascript"
		src="<?php echo Globals::URL; ?>assets/plugins/dataTables/buttons.print.min.js">
	</script>

	<script type="text/javascript"
		src="<?php echo Globals::URL; ?>assets/plugins/dataTables/dataTables.searchHighlight.min.js">
	</script>

	<script type="text/javascript"
		src="<?php echo Globals::URL; ?>assets/plugins/dataTables/jquery.highlight.js">
	</script>

	<script type="text/javascript"
		src="<?php echo Globals::URL; ?>assets/plugins/dataTables/colvis.min.js">
	</script>

	<?php endif; ?>

	<link
		href="<?php echo Globals::URL; ?>src/node_modules/bootstrap/dist/css/bootstrap.min.css"
		rel="stylesheet" />

	<script type="text/javascript"
		src="<?php echo Globals::URL; ?>src/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js">
	</script>

	<link rel="stylesheet"
		href="<?php echo Globals::URL; ?>assets/plugins/select2/dist/select2.min.css" />

	<link rel="stylesheet"
		href="<?php echo Globals::URL; ?>assets/plugins/select2/dist/select2-bootstrap-5-theme.min.css" />

	<link rel="stylesheet"
		href="<?php echo Globals::URL; ?>assets/plugins/select2/dist/select2-bootstrap-5-theme.rtl.min.css" />

	<script type="text/javascript"
		src="<?php echo Globals::URL;?>assets/plugins/select2/dist/select2.full.min.js">
	</script>

	<script type="text/javascript"
		src="<?php echo Globals::URL; ?>assets/plugins/moment/moment.min.js">
	</script>

	<script type="text/javascript"
		src="<?php echo Globals::URL; ?>assets/plugins/daterangepicker/daterangepicker.min.js">
	</script>

	<link rel="stylesheet" type="text/css"
		href="<?php echo Globals::URL; ?>assets/plugins/daterangepicker/daterangepicker.css" />


	<link rel="stylesheet"
		href="<?php echo Globals::TEMPLATE_URL ?>Templates/Dashboard/assets/css/css.css">


	<script type="text/javascript"
		src="<?php echo Globals::URL; ?>assets/js/globals.php">
	</script>

	<script>
		setWindow();
	</script>
</head>

<body class="background-general no-loaded">

	<?php if (!isset($_SESSION['loader'])) {
	    $_SESSION['loader'] = 1; ?>
	<div class="myLoad">
		<div class="content">
			<div class="ball red"></div>
			<div class="ball green"></div>
			<div class="ball yellow"></div>
			<div class="ball blue"></div>
			<div class="ball emerald-green"></div>
			<div class="ball pink"></div>
		</div>
	</div>
	<?php } ?>

	<header role="banner" class="nav-header-background">
		<a href="<?php echo Globals::URL; ?>">
			<img src="<?php echo Globals::LOGO; ?>"
				class="logo logos" alt="Logo">
		</a>
		<ul class="utilities">
			<li class="info-circle">
				<?php echo $_SESSION[Session::SESSION_FIELD]['username'] ?>
			</li>
			<li class="users"><a
					href="<?php echo Globals::URL ?>mi-cuenta">Mi
					cuenta</a></li>
			<li class="logout warn"><a
					href="<?php echo Globals::URL ?>?logout">Salir</a>
			</li>
		</ul>
	</header>

	<nav role='navigation' class="nav-header-background">
		<ul class="main">
			<li> <i class="fa fa-dashboard"></i> <a
					href="<?php echo Globals::URL ?>"><span
						class=navigator style=display:none> Escritorio</span></a></li>
			<li class="<?php echo $onlyAdmin ?>"><i
					class="fa fa-cog"></i><a
					href="<?php echo Globals::URL ?>theme-config"><span
						class=navigator style=display:none>Configuración</span></a></li>
			<li>
				<i class="fa fa-search"></i><a
					href="<?php echo Globals::URL ?>buscar"><span
						class=navigator style=display:none>Buscar</span></a>
			</li>
			<li class="<?php echo $onlyAdmin ?>"><i
					class="fa fa-users"></i><a
					href="<?php echo Globals::URL ?>usuarios"><span
						class=navigator style=display:none>Lista de usuarios</span></a></li>
			<li><i class="fa fa-file-excel-o"></i><a
					href="<?php echo Globals::URL ?>catastros"><span
						class=navigator style=display:none>Catastros</span></a></li>
			<li><i class="fa fa-file-excel-o"></i><a
					href="<?php echo Globals::URL ?>coa"><span
						class=navigator style=display:none>Coa</span></a></li>
			<li><i class="fa fa-file-excel-o"></i><a
					href="<?php echo Globals::URL ?>bancos"><span
						class=navigator style=display:none>Bancos</span></a></li>
		</ul>
	</nav>

	<main role="main">

		<section class="col-12 p-3">