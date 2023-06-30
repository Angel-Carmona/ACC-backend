	<!-- Sign Up -->
	<div class="container__form container--signup">
		<form action="" method="POST" class="form text-center" id="form1" style="transform:scale(.8)">
			<h6 class="w-100">ACCESO A USUARIOS</h6>
			<?php if($typeLogin == 1): ?>

			<div style="position:relative;width:100%;margin-top:20px">
				<div class="g-sign-in-button shadow origengbuton" onclick="jQuery('#username').focus();">
					<div class="content-wrapper">
						<div class="logo-wrapper-2">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
								<path
									d="M20.822 18.096c-3.439-.794-6.64-1.49-5.09-4.418 4.72-8.912 1.251-13.678-3.732-13.678-5.082 0-8.464 4.949-3.732 13.678 1.597 2.945-1.725 3.641-5.09 4.418-3.073.71-3.188 2.236-3.178 4.904l.004 1h23.99l.004-.969c.012-2.688-.092-4.222-3.176-4.935z" />
							</svg>
						</div>
						<span class="text-container-2">
							<span>
								<input type="text" name="username" value="&nbsp;" autocomplete="username" id=username
									class="form-control" placeholder="User" required>
							</span>
						</span>
						<label for="username" class="sr-only d-none" style="opacity:0;position:absolute">username</label>
					</div>
				</div>
			</div>
			<div style="position:relative;width:100%;">
				<div class="g-sign-in-button shadow origengbuton" onclick="jQuery('#email').focus();">
					<div class="content-wrapper">
						<div class="logo-wrapper-2">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
								<path
									d="M13.718 10.528c0 .792-.268 1.829-.684 2.642-1.009 1.98-3.063 1.967-3.063-.14 0-.786.27-1.799.687-2.58 1.021-1.925 3.06-1.624 3.06.078zm10.282 1.472c0 6.627-5.373 12-12 12s-12-5.373-12-12 5.373-12 12-12 12 5.373 12 12zm-5-1.194c0-3.246-2.631-5.601-6.256-5.601-4.967 0-7.744 3.149-7.744 7.073 0 3.672 2.467 6.517 7.024 6.517 2.52 0 4.124-.726 5.122-1.288l-.687-.991c-1.022.593-2.251 1.136-4.256 1.136-3.429 0-5.733-2.199-5.733-5.473 0-5.714 6.401-6.758 9.214-5.071 2.624 1.642 2.524 5.578.582 7.083-1.034.826-2.199.799-1.821-.756 0 0 1.212-4.489 1.354-4.975h-1.364l-.271.952c-.278-.785-.943-1.295-1.911-1.295-2.018 0-3.722 2.19-3.722 4.783 0 1.73.913 2.804 2.38 2.804 1.283 0 1.95-.726 2.364-1.373-.3 2.898 5.725 1.557 5.725-3.525z" />
							</svg>
						</div>
						<span class="text-container-2">
							<span>
								<input type="email" name="email" value="&nbsp;" id="email" class="form-control"
									placeholder="Email" required>
							</span>
						</span>
						<label for="email" class="sr-only d-none" style="opacity:0;position:absolute">email</label>
					</div>
				</div>
			</div>

			<?php elseif($typeLogin == 2): ?>

			<br>
			<br>
			<br>
			<div style="position:relative;width:100%;margin-top:20px">
				<div class="g-sign-in-button shadow origengbuton" onclick="jQuery('#username').focus();">
					<div class="content-wrapper">
						<div class="logo-wrapper-2">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
								<path
									d="M20.822 18.096c-3.439-.794-6.64-1.49-5.09-4.418 4.72-8.912 1.251-13.678-3.732-13.678-5.082 0-8.464 4.949-3.732 13.678 1.597 2.945-1.725 3.641-5.09 4.418-3.073.71-3.188 2.236-3.178 4.904l.004 1h23.99l.004-.969c.012-2.688-.092-4.222-3.176-4.935z" />
							</svg>
						</div>
						<span class="text-container-2">
							<span>
								<input type="text" name="username" value="&nbsp;" id=username class="form-control"
									placeholder="User" required>
							</span>
						</span>
						<label for="username" class="sr-only d-none" style="opacity:0;position:absolute">username</label>
					</div>
				</div>
			</div>

			<?php elseif($typeLogin == 3): ?>

			<br>
			<br>
			<br>
			<div style="position:relative;width:100%;">
				<div class="g-sign-in-button shadow origengbuton" onclick="jQuery('#email').focus();">
					<div class="content-wrapper">
						<div class="logo-wrapper-2">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
								<path
									d="M13.718 10.528c0 .792-.268 1.829-.684 2.642-1.009 1.98-3.063 1.967-3.063-.14 0-.786.27-1.799.687-2.58 1.021-1.925 3.06-1.624 3.06.078zm10.282 1.472c0 6.627-5.373 12-12 12s-12-5.373-12-12 5.373-12 12-12 12 5.373 12 12zm-5-1.194c0-3.246-2.631-5.601-6.256-5.601-4.967 0-7.744 3.149-7.744 7.073 0 3.672 2.467 6.517 7.024 6.517 2.52 0 4.124-.726 5.122-1.288l-.687-.991c-1.022.593-2.251 1.136-4.256 1.136-3.429 0-5.733-2.199-5.733-5.473 0-5.714 6.401-6.758 9.214-5.071 2.624 1.642 2.524 5.578.582 7.083-1.034.826-2.199.799-1.821-.756 0 0 1.212-4.489 1.354-4.975h-1.364l-.271.952c-.278-.785-.943-1.295-1.911-1.295-2.018 0-3.722 2.19-3.722 4.783 0 1.73.913 2.804 2.38 2.804 1.283 0 1.95-.726 2.364-1.373-.3 2.898 5.725 1.557 5.725-3.525z" />
							</svg>
						</div>
						<span class="text-container-2">
							<span>
								<input type="email" name="email" value="&nbsp;" id="email" class="form-control"
									placeholder="Email" required>
							</span>
						</span>
						<label for="email" class="sr-only d-none" style="opacity:0;position:absolute">email</label>
					</div>
				</div>
			</div>

			<?php else : ?>


			ERROR

			<?php endif; ?>

			<div style="position:relative;width:100%">
				<div class="g-sign-in-button shadow origengbuton" onclick="jQuery('#password').focus();">
					<div class="content-wrapper">
						<div class="logo-wrapper-2">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
								<path
									d="M17 19h4v2h-4v-2zm4-9v2h-5v10h5v2h-18v-14h3v-4c0-3.313 2.687-6 6-6s6 2.687 6 6v4h3zm-5 0v-4c0-2.206-1.795-4-4-4s-4 1.794-4 4v4h8zm1 8h4v-2h-4v2zm0-3h4v-2h-4v2z" />
							</svg>
						</div>
						<span class="text-container-2">
							<span>
								<input type="password" value="&nbsp;" name="password" autocomplete="current-password"
									id="password" class="form-control" placeholder="Password" required>
							</span>
						</span>
						<label for="username" class="sr-only d-none" style="opacity:0;position:absolute">username</label>
					</div>
				</div>
			</div>
			<br>
			<button class="btn" name="logear" type="submit">Acceder</button>

			<a href="#" class="link text-center" id="signIn2" onclick="$('input').val('');"
				style="bottom: -2.4em;">Registrarse</a>
		</form>
		<a href="#" class="link text-center" data-bs-toggle="modal" data-bs-target="#myModal"
			onclick="jQuery('.container').addClass('blur');">¿Ha olvidado su
			contraseña? <span class="text-muted">Pulse
				aquí</span></a>
	</div>