<?php
use Controllers\Session\Session;
use Controllers\User\User;

$MyData = User::getMyUser();
?>

<style>
	<?php require_once __DIR__ . '/assets/css/mi-cuenta.css'?>
</style>
<div class="row">
	<div class="col-lg-6">
		<div class='card shadow' style="min-height:40vh">
			<div class='card-body'>
				<h4>Editar mi perfil</h4>
				<br>
				<form action="" method='POST' id='myData' class='row'></form>
			</div>
		</div>

	</div>
	<div class="col-lg-6">
		<div class='card shadow' style="min-height:40vh">
			<div class='card-body openModal cursor-ponter' style="cursor:pointer!important" data-bs-toggle="modal"
				data-bs-target="#myModal">
				<h4>Accesos y claves</h4>
				<h2 class="text-center">
					<i class="fa fa-lock" style="font-size:5em"></i>
					<div>
						Cambiar contraseña
					</div>
				</h2>
			</div>
		</div>
	</div>
</div>
<!-- The Modal -->
<div class="modal" id="myModal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="border-radius:20px">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Editar registro</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form id="changePass" method="POST" class="w-100 form-row row">
					<input type="hidden" name="user_id"
						value="<?php echo User::getUserID() ?>">
					<div class="col-lg-12">
						<div class="">
							<label for="password-actual">Password actual</label>
							<input type="password" placeholder="Contraseña actual" class="form-control w-100"
								id="password-actual" autocomplete="new-password" required value="">
						</div>
					</div>
					<div class="col-lg-12">
						<div class="m">
							<label for="password-actual">Password actual</label>
							<input type="password" placeholder="Contraseña nueva" name="password"
								class="form-control w-100" id="password" autocomplete="new-password" required value="">
						</div>
					</div>
					<div class="col-lg-12">
						<div class="m">
							<label for="password-actual">Password actual</label>
							<input type="password" placeholder="Repi la contraseña nueva" id="password-nueva"
								class="form-control w-100" autocomplete="new-password" required value="">
						</div>
					</div>
					<input type="hidden" name="setPassword"
						value="<?php echo Session::SESSION_TOKEN; ?>">
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger cerrarModal" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success guardar-registro guardar-registro">Guardar</button>
			</div>

		</div>
	</div>
</div>

<script>
	let myData = <?php echo json_encode($MyData); ?> ;
	let divInput = "";
	for (let index = 0; index < myData.length; index++) {
		const element = myData[index];
		for (const key in element) {
			console.log(`${key}: ${element}`);
			if (['user_id', 'secret', 'date_updated', 'last_login', 'date_created', 'usergroup', 'can_delete',
					'user_status'
				].includes(key)) {
				divInput += `
                    <input hidden type="text" id="${key}" autocomplete="off" required value="${element[key]}">
                `;
			} else if (['password'].includes(key)) {

			} else {
				divInput += `
                <div class="col-lg-6">
                    <div class="m">
					<label for="${key}" class="text-uppercase">${key}</label>
                        <input type="text" class="form-control w-100" id="${key}" autocomplete="off" required value="${element[key]}">
                    </div>
                </div>`;
			}
		}
	}
	divInput += `
        <div class="col-lg-12">
            <div class="m text-right" style="text-align:right">
                <button class="btn button btn-color" tabindex="0" aria-controls="users" type="submit"><span>Guardar</span></button>
            </div>
        </div>`;


	jQuery('#myData').append(divInput);

	jQuery('.guardar-registro').on('click', function() {
		let passActual = $('#password-actual').val();
		let pass = $('#password').val();
		let passRepite = $('#password-nueva').val();
		if (pass !== passRepite) {
			swal({
				title: " ",
				text: "Las contaseñas no coinciden",
				icon: "error",
				timer: 1500,
				buttons: false
			}).then(() => {
				jQuery('#password-nueva').focus().select();
			});
		}
		$('#changePass').submit();
	});
</script>