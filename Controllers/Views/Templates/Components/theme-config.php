<?php

use App\Globals\Globals;
use Controllers\System\System;

?>
<style>
	.dx-radiobutton {
		width: 50%;
	}

	.dx-radiogroup-horizontal .dx-collection {
		flex-wrap: nowrap;
	}
</style>

<div class="card-columns pr-4" style="padding-right:15px">
	<div class="card shadow">
		<div class="">
			<div class="card-header">
				<h5 class="text-left text-uppercase">Configuración visual</h5>
				<i class="fa fa-refresh cursor-pointer" title="Restablecer a valores por defecto"
					style="position:absolute;right:10px;top:15px"></i>
			</div>
			<div class="card-body">
				<div class="col-lg-12">
					<form action="" method="POST">
						<div class="dx-viewport demo-container">
							<div class="form form-row row">
								<!-- Background -->
								<div class=" col-lg-6 mb-2 border-right">
									<h6>FONDOS</h6>
									<div class="mb-2 mt-3 texto">
										Color de fondo
									</div>
									<div class="hero-block">
										<div class="hero-color-box">
											<div class="colors background-general">

											</div>
										</div>
									</div>
									<div class="mb-2 mt-3 texto">
										Color de fondo para de las cabeceras
									</div>
									<div class="hero-block">
										<div class="hero-color-box">
											<div class="colors headers">

											</div>
										</div>
									</div>
									<div class="mb-2 mt-3 texto">
										Color de fondo para la barra de navegación
									</div>
									<div class="hero-block">
										<div class="hero-color-box">
											<div class="colors nav-header-background">

											</div>
										</div>
									</div>
									<div class="mb-2 mt-3 texto">
										Color de fondo para los item activos
									</div>
									<div class="hero-block">
										<div class="hero-color-box">
											<div class="colors  active-bk">

											</div>
										</div>
									</div>
								</div>
								<!-- color -->
								<div class="col-lg-6 mb-2">
									<h6>FUENTE</h6>
									<div class="mb-2 mt-3 texto">
										Color para el texto
									</div>
									<div class="hero-block">
										<div class="hero-color-box">
											<div class="colors color-texto-general">

											</div>
										</div>
									</div>
									<div class="mb-2 mt-3 texto">
										Color para los títulos de las cabeceras
									</div>
									<div class="hero-block">
										<div class="hero-color-box">
											<div class="colors headers-text">

											</div>
										</div>
									</div>
									<div class="mb-2 mt-3 texto">
										Color para los enlaces de la web
									</div>
									<div class="hero-block">
										<div class="hero-color-box">
											<div class="colors nav-header-a-color">

											</div>
										</div>
									</div>
									<div class="mb-2 mt-3 texto">
										Color para los elemntos activos
									</div>
									<div class="hero-block">
										<div class="hero-color-box">
											<div class="colors active-cl">

											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="card shadow">
		<div class="">
			<div class="card-header">
				<h5 class="text-left text-uppercase">Logo</h5>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-4">
						<img src="<?php echo Globals::TEMPLATE_URL ?>Templates/Login/assets/img/logo.webp"
							alt="Logo" srcset="" class="img-fluid logos">
					</div>
					<div class="col-lg-8">
						<div class="demo-container">
							<div class="widget-container flex-box">
								<div id="dropzone-external" class="flex-box dx-theme-border-color">
									<img id="dropzone-image" src="#" hidden alt="" />
									<div id="dropzone-text" class="flex-box">
										<span>
											<i class="fa fa-exclamation-triangle"></i> Si no dispones de la imagen
											anterior no
											puedes revertir el cambio.
										</span>
									</div>
									<div id="upload-progress"></div>
								</div>
								<div id="file-uploader"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card shadow">
		<div class="">
			<div class="card-header">
				<h5 class="text-left text-uppercase">Plugins</h5>
			</div>
			<div class="card-body">
				<?php System::getPluginsList() ?>
			</div>
		</div>
	</div>
	<div class="card shadow">
		<div class="">
			<div class="card-header">
				<h5 class="text-left text-uppercase">Formulario buscar</h5>
			</div>
			<div class="card-body">
				<div class="for-buscar"></div>
				<script>
					let vaBuscar = [{
						id: 1,
						text: 'Slider',
						imagen: `<img src="<?php echo Globals::URL ?>assets/img/slider.png" alt="Logo" class="img-field" style="width:120px">`
					}, {
						id: 2,
						text: 'Caja numérica',
						imagen: `<img src="<?php echo Globals::URL ?>assets/img/texto.png" alt="Logo" class="img-field" style="width:70px">`

					}];
					$(".for-buscar").dxRadioGroup({
						width: '100%',
						items: vaBuscar,
						valueExpr: 'id',
						displayExpr: 'text',
						layout: 'horizontal',
						value: vaBuscar[0],
						itemTemplate: (item) => {
							let isActive = $(".for-buscar").dxRadioGroup('instance').option('value').id !== item.id;
							if (isActive) {
								$('.for-buscar .dx-item-selected').css('background', window.settings['json'][
									'theme-styles'
								]['active-bk']);
							}
							return `<div class="col-lg-12"><h6>${item.text}</h6>${item.imagen}</div>`;
						},
						onValueChanged(value) {
							let isActive = $(".for-buscar").dxRadioGroup('instance').option('value').id === value.id;
							if (isActive) {
								$('.for-buscar .dx-radiobutton').css('background', '');
								$('.for-buscar .dx-item-selected').css('background', window.settings['json']['theme-styles'][
									'active-bk'
								]);
							}
							if (window.settings['json']['site-config']['formSearchType'] !== value.value) {
								window.settings['json']['site-config']['formSearchType'] = value.value;
								window.saveThemeConfig(window.settings);
							}
						}
					}).dxRadioGroup('instance');
				</script>
			</div>
		</div>
	</div>
	<div class="card shadow">
		<div class="">
			<div class="card-header">
				<h5 class="text-left text-uppercase">Grupos de usuario</h5>
			</div>
			<div class="card-body">
				<div class="demo-container">
					<div id="data-grid-demo">
						<div id="gridContainer"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card shadow">
		<div class="">
			<div class="card-header">
				<h5 class="text-left text-uppercase">Clave de acceso para consultar la API REST</h5>
			</div>
			<div class="card-body">
				<form action="">

					<div class="input-group">
						<input type="password" class="form-control no-border" id="tokenApi" name="token" value="">
						<button class="btn btn-primary text-dark" type="button"
							onclick="jQuery('.copy-fa').toggleClass('disabled');if(jQuery('.ojos').hasClass('fa-eye')){jQuery(this).find('.fa-eye').toggleClass('fa-eye').toggleClass('fa-eye-slash');jQuery('#tokenApi').attr('type', 'text');}else{jQuery(this).find('.fa-eye-slash').toggleClass('fa-eye').toggleClass('fa-eye-slash');jQuery('#tokenApi').attr('type', 'password');}"><i
								class="fa fa-eye ojos"></i></button>
						<button class="btn btn-primary text-dark copy-fa disabled" type="button"
							onclick=" let el = jQuery('#tokenApi').select();document.execCommand('copy');swal({title:'',text:'Token copiado al portapapeles',icon:'success',timer:1500,buttons:false}).then(()=>{jQuery('#tokenApi').attr('type', 'password');$(this).addClass('disabled')})"><i
								class="fa fa-copy"></i></button>
						<button class="btn btn-primary text-dark" type="button"><i class="fa fa-save"></i></button>
						<script>
							document.getElementById('tokenApi').value = window.token;
						</script>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="card shadow">
		<div class="">
			<div class="card-header">
				<h5 class="text-left text-uppercase">Login</h5>
			</div>
			<div class="card-body">
				<form action="">

					<div id="withTextUsusario"></div>

					<script>
						let va = [{
								id: 1,
								text: 'Usuario email y contraseña',
								imagen: `<img src="<?php echo Globals::URL ?>assets/img/texto.png" alt="Logo" class="img-field" style="width:70px">`
							},
							{
								id: 2,
								text: 'Sólo usuario y contraseña',
								imagen: `<img src="<?php echo Globals::URL ?>assets/img/texto.png" alt="Logo" class="img-field" style="width:70px">`
							},
							{
								id: 3,
								text: 'Sólo email y contraseña',
								imagen: `<img src="<?php echo Globals::URL ?>assets/img/texto.png" alt="Logo" class="img-field" style="width:70px">`
							},
						];
						$("#withTextUsusario").dxRadioGroup({
							width: '100%',
							items: va,
							valueExpr: 'id',
							displayExpr: 'text',
							layout: 'horizontal',
							value: va[0],
							itemTemplate: (item) => {
								let isActive = $("#withTextUsusario").dxRadioGroup('instance').option('value').id !== item.id;
								if (isActive) {
									$('#withTextUsusario .dx-item-selected').css('background', window.settings['json'][
										'theme-styles'
									]['active-bk']);
								}
								return `<div class="col-lg-12"><h6>${item.text}</h6>${item.imagen}</div>`;
							},
							onValueChanged(value) {
								let isActive = $("#withTextUsusario").dxRadioGroup('instance').option('value').id === value.id;
								if (isActive) {
									$('#withTextUsusario .dx-radiobutton').css('background', '');
									$('#withTextUsusario .dx-item-selected').css('background', window.settings['json'][
										'theme-styles'
									]['active-bk']);
								}
								if (window.settings['json']['site-config']['loginType'] !== value.value) {
									window.settings['json']['site-config']['loginType'] = value.value;
									window.saveThemeConfig(window.settings);
								}
							}
						}).dxRadioGroup('instance');
					</script>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(() => {

		console.log(window.settings);

		$('.background-general.colors').dxColorBox({
			value: '#fefefe',
			applyValueMode: 'instantly',
			showDropDownButton: true,
			editAlphaChannel: true,
			elementAttr: {
				id: "background-background-general",
			},
			inputAttr: {
				id: "background-general",
			},
			onValueChanged(e) {
				$('.background-general:not(.background-general.colors)').css('background-color', e
					.component.option('value'));
				if (window.settings['json']['theme-styles']['background-general'] !== e.component.option(
						'value')) {
					window.settings['json']['theme-styles']['background-general'] = e.component.option(
						'value');
					window.saveThemeConfig(window.settings);
				}
			},
			onInput(e) {
				$('.background-general:not(.background-general.colors)').css('background-color', e.event
					.target.value);
				window.settings['json']['theme-styles']['background-general'] = e.component.option(
					'value');
				window.saveThemeConfig(window.settings);
			}
		});

		$('.active-cl.colors').dxColorBox({
			value: '#e2a310',
			applyValueMode: 'instantly',
			editAlphaChannel: true,
			elementAttr: {
				id: "active-cl-element",
			},
			inputAttr: {
				id: "active-cl",
			},
			onValueChanged(e) {
				$('.active,.dx-item-selected').css('color', e.component.option('value'));
				if (window.settings['json']['theme-styles']['active-cl'] !== e.component.option('value')) {
					window.settings['json']['theme-styles']['active-cl'] = e.component.option('value');
					window.saveThemeConfig(window.settings);
				}
			},
			onInput(e) {
				$('.active,.dx-item-selected').css('color', e.event.target.value);
				window.settings['json']['theme-styles']['active-cl'] = e.component.option('value');
				window.saveThemeConfig(window.settings);
			},
		});


		$('.headers.colors').dxColorBox({
			value: '#e2a310',
			applyValueMode: 'instantly',
			editAlphaChannel: true,
			elementAttr: {
				id: "headers-element",
			},
			inputAttr: {
				id: "headers",
			},
			onValueChanged(e) {
				$('.card-header').css('background-color', e.component.option('value'));
				if (window.settings['json']['theme-styles']['headers'] !== e.component.option('value')) {
					window.settings['json']['theme-styles']['headers'] = e.component.option('value');
					window.saveThemeConfig(window.settings);
				}
			},
			onInput(e) {
				$('.card-header').css('background-color', e.event.target.value);
				window.settings['json']['theme-styles']['headers'] = e.component.option('value');
				window.saveThemeConfig(window.settings);
			},
		});

		$('.active-bk.colors').dxColorBox({
			value: '#e2a310',
			applyValueMode: 'instantly',
			editAlphaChannel: true,
			elementAttr: {
				id: " active-bk-element",
			},
			inputAttr: {
				id: "active-bk",
			},
			onValueChanged(e) {
				$('.active,.dx-item-selected').css('background-color', e.component.option('value'));
				if (window.settings['json']['theme-styles']['active-bk'] !== e.component.option('value')) {
					window.settings['json']['theme-styles']['active-bk'] = e.component.option('value');
					window.saveThemeConfig(window.settings);
				}
			},
			onInput(e) {
				$('.active,.dx-item-selected').css('background-color', e.event.target.value);
				window.settings['json']['theme-styles']['active-bk'] = e.component.option('value');
				window.saveThemeConfig(window.settings);
			},
		});


		$('.nav-header-background.colors').dxColorBox({
			value: '#ffffff',
			applyValueMode: 'instantly',
			editAlphaChannel: true,
			elementAttr: {
				id: "nav-header-background",
				class: "class-name"
			},
			onValueChanged(e) {
				$('nav,header').css('background-color', e.component.option('value'));
				if (window.settings['json']['theme-styles']['nav-header-background'] !== e.component
					.option('value')) {
					window.settings['json']['theme-styles']['nav-header-background'] = e.component.option(
						'value');
					window.saveThemeConfig(window.settings);
				}
			},
			onInput(e) {
				$('nav,header').css('background-color', e.event.target.value);
				window.settings['json']['theme-styles']['nav-header-background'] = e.component.option(
					'value');
				window.saveThemeConfig(window.settings);
			},
		});


		$('.color-texto-general.colors').dxColorBox({
			value: '#333333',
			applyValueMode: 'instantly',
			editAlphaChannel: true,

			elementAttr: {
				id: "color-texto-general",
				class: "class-name"
			},
			onValueChanged(e) {
				$('.texto').css('color', e.component.option('value'));
				if (window.settings['json']['theme-styles']['color-texto-general'] !== e.component.option(
						'value')) {
					window.settings['json']['theme-styles']['color-texto-general'] = e.component.option(
						'value');
					window.saveThemeConfig(window.settings);
				}
			},
			onInput(e) {
				$('.texto').css('color', e.event.target.value);
				window.settings['json']['theme-styles']['color-texto-general'] = e.component.option(
					'value');
				window.saveThemeConfig(window.settings);
			},
		});


		$('.nav-header-a-color.colors').dxColorBox({
			value: '#333333',
			applyValueMode: 'instantly',
			editAlphaChannel: true,
			elementAttr: {
				id: "nav-header-a-color",
				class: "class-name"
			},
			onValueChanged(e) {
				$('a').css('color', e.component.option('value'));
				if (window.settings['json']['theme-styles']['nav-header-a-color'] !== e.component.option(
						'value')) {
					window.settings['json']['theme-styles']['nav-header-a-color'] = e.component.option(
						'value');
					window.saveThemeConfig(window.settings);
				}
			},
			onInput(e) {
				$('a').css('color', e.event.target.value);
				window.settings['json']['theme-styles']['nav-header-a-color'] = e.component.option(
					'value');
				window.saveThemeConfig(window.settings);
			},
		});

		$('.headers-text.colors').dxColorBox({
			value: '#333333',
			applyValueMode: 'instantly',
			editAlphaChannel: true,
			elementAttr: {
				id: "headers-text",
				class: "class-name"
			},
			onValueChanged(e) {
				$('.card-header h5').css('color', e.component.option('value'));
				if (window.settings['json']['theme-styles']['headers-text'] !== e.component.option(
						'value')) {
					window.settings['json']['theme-styles']['headers-text'] = e.component.option('value');
					window.saveThemeConfig(window.settings);
				}
			},
			onInput(e) {
				$('.card-header h5').css('color', e.event.target.value);
				window.settings['json']['theme-styles']['headers-text'] = e.component.option('value');
				window.saveThemeConfig(window.settings);
			},
		});

		$('#file-uploader').dxFileUploader({
			dialogTrigger: '#dropzone-external',
			dropZone: '#dropzone-external',
			multiple: false,
			allowedFileExtensions: ['.jpg', '.jpeg', '.gif', '.png', '.svg', '.webp'],
			uploadMode: 'instantly',
			uploadUrl: apiUrl,
			visible: false,
			onUploadError: function(e) {
				var xhttp = e.request;
				if (xhttp.readyState == 4 && xhttp.status == 0) {
					console.log("Connection refused.");
				}
			},
			onDropZoneEnter(e) {
				if (e.dropZoneElement.id === 'dropzone-external') {
					toggleDropZoneActive(e.dropZoneElement, true);
				}
			},
			onDropZoneLeave(e) {
				if (e.dropZoneElement.id === 'dropzone-external') {
					toggleDropZoneActive(e.dropZoneElement, false);
				}
			},
			onUploaded(e) {
				const {
					file
				} = e;

				console.log(file);
				const dropZoneText = document.getElementById('dropzone-text');
				const fileReader = new FileReader();
				fileReader.onload = function() {
					toggleDropZoneActive(document.getElementById('dropzone-external'), false);
					const dropZoneImage = document.getElementById('dropzone-image');
					dropZoneImage.src = fileReader.result;
					$('.logos').attr('src', fileReader.result);
				};
				fileReader.readAsDataURL(file);
				dropZoneText.style.display = 'none';
				uploadProgressBar.option({
					visible: false,
					value: 0,
				});
				window.settings['json']['site-config']['logourl'] =
					"<?php echo Globals::URL ?>assets/img/" + file
					.name;
				window.saveThemeConfig(window.settings);
			},
			onProgress(e) {
				uploadProgressBar.option('value', (e.bytesLoaded / e.bytesTotal) * 100);
			},
			onUploadStarted() {
				toggleImageVisible(false);
				uploadProgressBar.option('visible', true);
			},

		});

		const uploadProgressBar = $('#upload-progress').dxProgressBar({
			min: 0,
			max: 100,
			width: '30%',
			showStatus: false,
			visible: false,
		}).dxProgressBar('instance');

		function toggleDropZoneActive(dropZone, isActive) {
			if (isActive) {
				dropZone.classList.add('dx-theme-accent-as-border-color');
				dropZone.classList.remove('dx-theme-border-color');
				dropZone.classList.add('dropzone-active');
			} else {
				dropZone.classList.remove('dx-theme-accent-as-border-color');
				dropZone.classList.add('dx-theme-border-color');
				dropZone.classList.remove('dropzone-active');
			}
		}

		function toggleImageVisible(visible) {
			const dropZoneImage = document.getElementById('dropzone-image');
			dropZoneImage.hidden = !visible;
		}

		document.getElementById('dropzone-image').onload = function() {
			toggleImageVisible(true);
		};


		$('#gridContainer').dxDataGrid({
			dataSource: <?php echo json_encode(System::getGroups()) ?> ,
			keyExpr: 'id_usergroup',
			showBorders: false,
			editing: {
				mode: 'popup',
				allowUpdating: true,
				allowAdding: true,
				allowDeleting: true,
				useIcons: true,
				popup: {
					title: 'Añadir grupo de usuario',
					showTitle: true,
					width: 400,
					height: 255,
				},
				form: {
					items: [{
						dataField: 'id_usergroup',
						editorType: 'dxNumberBox',
						colSpan: 2,
						visible: false,
						editorOptions: {
							height: 100,
							visible: false
						},
					}, {
						dataField: 'groupname',
						text: "Nombre",
						editorType: 'dxTextBox',
						colSpan: 2,
						visible: true,
						editorOptions: {
							label: {
								label: ''
							},
							height: 100,
							visible: true
						},
					}],
				},
			},
			columns: [{
				dataField: 'id_usergroup',
				caption: 'Id',
				visible: false,
			}, {
				dataField: 'groupname',
				caption: 'Nombre',
			}, {
				dataField: 'contador',
				caption: 'Nº Usuarios',
			}],
			onEditingStart(row) {

			},
			onInitNewRow() {

			},
			onRowInserting() {

			},
			onRowInserted(row) {
				let datos = {
					groupname: row.data.groupname
				};
				window.updateField(datos, 'updateUserGroupName');
			},
			onRowUpdating() {

			},
			onRowUpdated(row) {
				window.updateField(row.data, 'updateUserGroupName');
			},
			onRowRemoving() {

				console.log('RowRemoved');
			},
			onRowRemoved(row) {
				let datos = {
					id_usergroup: row.data.id_usergroup
				};
				window.updateField(datos, 'deleteUserGroup');
			},
			onSaving(row) {
				console.log('Saving', row);
			},
			onSaved() {
				console.log('Saved');
			},
			onEditCanceling() {
				console.log('EditCanceling');
			},
			onEditCanceled() {
				console.log('EditCanceled');
			},
		});
	});
</script>