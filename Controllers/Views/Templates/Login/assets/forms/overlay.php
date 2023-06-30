<?php

use App\Globals\Globals;
use Controllers\Session\Session;

?>
<!-- Overlay -->
<div class="container__overlay">
	<div class="overlay">
		<div class="overlay__panel overlay--left">
			<?php if(isset($_SESSION[Session::SESSION_ERROR])) { ?>
			<div class="errorMensaje">
				<?php echo $_SESSION[Session::SESSION_ERROR];?>
			</div>
			<?php } ?>
			<img src="<?php echo globals::TEMPLATE_URL ?>Templates/Login/assets/img/logo.webp"
				width="250" height="50" alt="" style="border-radius:5px">
			<a href="#" class="link text-white" id="signIn" onclick="$('input').val('')">Nueva cuenta</a>

		</div>
		<div class="overlay__panel overlay--right">
			<img src="<?php echo globals::TEMPLATE_URL ?>Templates/Login/assets/img/logo.webp"
				width="250" height="50" alt="" style="border-radius:5px">
			<a href="#" class="link text-white" id="signUp">Acceder</a>
		</div>
	</div>
</div>