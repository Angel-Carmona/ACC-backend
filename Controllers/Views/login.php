<?php
use App\Globals\Globals;
use Controllers\System\System;

$typeLogin = (int) json_decode(System::getTypeLogin());

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Peritacines A.C - Login</title>

	<script src="<?php echo globals::URL ?>/assets/js/jQuery.min.js"></script>

	<script
		src="<?php echo globals::URL ?>/assets/plugins/sweetAlert/sweetalert.min.js">
	</script>
	<link
		href="<?php echo Globals::URL; ?>src/node_modules/bootstrap/dist/css/bootstrap.min.css"
		rel="stylesheet" />

	<script type="text/javascript"
		src="<?php echo Globals::URL; ?>src/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js">
	</script>

	<link rel="stylesheet"
		href="<?php echo globals::TEMPLATE_URL ?>Templates/Login/assets/css/css.css">

	<script src="https://unpkg.com/detect-autofill/dist/detect-autofill.js"></script>

	<style>
		.myLoad {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			min-height: 100vh;
			z-index: 999999;
			background: white;
			display: flex;
			align-items: center
		}
	</style>

</head>

<body class="no-loaded">

	<div class="myLoad">
		<div class="content">
			<img src="<?php echo Globals::TEMPLATE_URL ?>Templates/Login/assets/img/logo.webp"
				width="250" height="50" alt="Logo peritaciones AC" style="border-radius:5px">
		</div>
	</div>

	<section>
		<div class='air air1'></div>
		<div class='air air2'></div>
		<div class='air air3'></div>
		<div class='air air4'></div>
	</section>


	<div class="container right-panel-active carta">

		<?php require_once __DIR__ . '/Templates/Login/assets/forms/sing-up.php'; ?>
		<?php require_once __DIR__ . '/Templates/Login/assets/forms/sing-in.php'; ?>
		<?php require_once __DIR__ . '/Templates/Login/assets/forms/overlay.php'; ?>

	</div>

	<?php require_once __DIR__ . '/Templates/Login/assets/modal/modal-password.php'; ?>


	<footer class="fixed-bottom">
		<h6 style="text-align:center">&copy;
			<?php echo date('Y')?> Todos los
			derechos reservados - Peritaciones AC S.L
		</h6>
	</footer>
	<script>
		let register = false;
		<?php if(isset($_GET['regko']) && $_GET['regko'] == 3) { ?>
		swal({
			title: "",
			text: "El usuario o el email ya existen.",
			icon: 'error',
			timer: 3000,
			buttons: false

		});
		<?php } elseif(isset($_GET['regko']) && $_GET['regko'] == 2) { ?>
		swal({
			title: "",
			text: "Error al guardar el usuario. Contacte con el administrador.",
			icon: 'error',
			timer: 3000,
			buttons: false
		});
		<?php } ?>
	</script>
	<script
		src="<?php echo Globals::TEMPLATE_URL ?>Templates/Login/assets/js/js.js">
	</script>
	<script>
		$('[data-bs-dismiss]').click(
			function(){
				jQuery('.container').removeClass('blur');
			}
		);

		if (window.history.replaceState) {
			window.history.replaceState(null, null, window.location.href);
		}
	</script>
</body>

</html>