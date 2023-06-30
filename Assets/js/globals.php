<?php

use App\Globals\Globals;
use Controllers\System\System;

require_once __DIR__ . '/../../vendor/autoload.php';

$theme = System::getStyles();

header("Content-Type: text/javascript");
function comprimir_pagina2($buffer)
{
    $buffer = strip_tags($buffer);
    $busca = array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s');
    $reemplaza = array('>', '<', '\\1');
    return preg_replace($busca, $reemplaza, $buffer);
}
ob_start('comprimir_pagina2');
?>
<script>
	<?php require_once __DIR__ . '/idioma.js'; ?>
	let valoresPorDefecto = {
		json: {
			"theme-styles": {
				"background-general": '#f2f2f2',
				"headers": "#e2a3107a",
				"headers-text": "#333333",
				"color-texto-general": '#333333',
				"nav-header-background": '#ffffff',
				"nav-header-a-color": '#33333',
				"active-bk": '#33333',
				"active-cl": '#ffffff',
			},
			"site-config": {
				"logourl": "Views/Templates/Login/assets/img/logo.webp",
				"token": '',
				"debug": true,
				"loginType": 1,
				"formSearchType": 1,
				"sessionLifeTime": (3600 * 60)
			}
		}
	};

	<?php if (count($theme) > 0) : ?>

	valoresPorDefecto = <?php echo json_encode($theme[0]); ?> ;

	console.log(valoresPorDefecto);

	<?php endif; ?>


	window.addToken = function addToken(data) {
		data = JSON.parse(data);
		data.push({
			name: "token",
			value: window.token
		});
		data = JSON.stringify(data);
		return data;
	};

	function notificacion(message, type = 'success', timer = 500) {
		let options = {
			title: "",
			text: message,
			icon: type,
			buttons: false,
			timer: timer
		};
		return swal(options);
	}

	window.callapi = function(data, callback = false, noti = false) {
		data = window.addToken(data);
		let a, b;
		a = $.ajax({
			url: window.apiUrl,
			type: 'POST',
			dataType: 'JSON',
			async: false,
			data: data,
			success: function(res) {
				if (window.debug) {
					console.log('apiCalled!', {
						request: JSON.parse(data),
						response: res
					});
				}
				if (noti) {
					window.notificacion(noti, 'success', 1500);
				}
				b = res;
			}
		}).fail((err) => {
			window.notificacion(noti, 'error', 1500);
			console.log(err);
		});

		$.when(a).then(function(data) {
			b = data;
			if (callback) {
				eval("window." + callback + "(" + JSON.stringify(b) + ")");
			}
		});

		return b;
	};

	function updateField(data, action) {
		let object = JSON.stringify([{
				name: "action",
				value: action
			},
			{
				name: "data",
				value: data
			}
		]);
		window.callapi(object);
	};

	function saveThemeConfig(valores) {
		let json = JSON.stringify([{
				value: 'saveConfig',
				name: "action",
			},
			{
				name: "data",
				value: valores
			}
		]);
		window.callapi(json);
	};



	function setWindow() {
		window.saveThemeConfig = saveThemeConfig;
		window.apiUrl = "<?php echo Globals::API_URL ?>";
		window.notificacion = notificacion;
		window.updateField = updateField;
		window.settings = valoresPorDefecto;
		window.debug = window.settings['json']['site-config']['debug'];
		window.token = valoresPorDefecto['json']['site-config']['token'];
		window.sessionLifeTime = parseInt(eval(valoresPorDefecto['json']['site-config']['sessionLifeTime']));
	}
</script>
<?php ob_end_flush(); ?>