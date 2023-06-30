<?php
use Controllers\User\User;

?>
</section>
</main>

<script>
	$(document).ready(function() {

		if (typeof window.settings !== 'undefined' && window.settings['json'] && window.settings['json'][
				'theme-styles'
			]) {

			for (const key in window.settings['json']['theme-styles']) {
				if (Object.hasOwnProperty.call(window.settings['json']['theme-styles'], key)) {
					const value = window.settings['json']['theme-styles'][key];
					switch (key) {
						case 'background-general':
						case 'nav-header-background':
							$('.' + key + ':not(.colors.' + key + ')').css('background-color', value);
							try {
								$('.' + key + '.colors').dxColorBox('instance').option('value', value);
							} catch (error) {

							}
							break;
						case 'headers':
							var strin = `
						<style>
							.dx-popup-title.dx-toolbar, .card-header, .modal-header, thead:not(.drp-calendar thead)
							{
								background : ${value};
								background-color : ${value};
							}
							button.dt-button, div.dt-button, a.dt-button, input.dt-button {
								background : ${value};
								background-color : ${value};
							}
							.dx-checkbox-container {
								border: 1px solid ${value};
							}
							.paginate_button.current {
								background: ${value}!important;
							}
						</style>
						`;
							jQuery('head').append(strin);
							try {
								$('.' + key + '.colors').dxColorBox('instance').option('value', value);
							} catch (error) {

							}
							break;
						case 'headers-text':
							$('.card-header h5,.dx-popup-title.dx-toolbar, .card-header, .modal-header, thead:not(.drp-calendar thead),button.dt-button, div.dt-button, a.dt-button, input.dt-button,.paginate_button.current,.dataTables_wrapper .dataTables_paginate .paginate_button.current,.dataTables_wrapper .dataTables_paginate .paginate_button.current,.dataTables_wrapper .dataTables_paginate .paginate_button.current')
								.css('color', value);

							$('.' + key + '.colors').css('color', value);
							try {
								$('.' + key + '.colors').dxColorBox('instance').option('value', value);
							} catch (error) {

							}
							break;
						case 'color-texto-general':
							$('body').css('color', value);
							try {
								$('.' + key + '.colors').dxColorBox('instance').option('value', value);
							} catch (error) {

							}
							break;
						case 'nav-header-a-color':
							$('a,.dx-datagrid .dx-link,.dx-datagrid .dx-link a').css('color', value);
							try {
								$('.' + key + '.colors').dxColorBox('instance').option('value', value);
							} catch (error) {

							}
							break;
						case 'active-bk':
							setTimeout(() => {
								$('.active,.dx-item-selected,:selected').css('background', value);
								$('.active,.dx-item-selected :selected').css('background-color', value);
							}, 2);
							try {
								$('.' + key + '.colors').dxColorBox('instance').option('value', value);
							} catch (error) {

							}
							break;
						case 'active-cl':
							setTimeout(() => {
								$('.active,.dx-item-selected,:selected').css('color', value);
							}, 2);
							try {
								$('.' + key + '.colors').dxColorBox('instance').option('value', value);
							} catch (error) {

							}
							break;
					}
				}
			}
		}
		if (typeof window.settings !== 'undefined' && window.settings['json'] && window.settings['json'][
				'site-config'
			]) {
			for (const key in window.settings['json']['site-config']) {
				if (Object.hasOwnProperty.call(window.settings['json']['site-config'], key)) {
					const value = window.settings['json']['site-config'][key];
					switch (key) {
						case 'loginType':
							try {
								$('#withTextUsusario').dxRadioGroup('instance').option('value', value)
							} catch (error) {}
							break;
						case 'formSearchType':
							try {
								$('.for-buscar').dxRadioGroup('instance').option('value', value)
							} catch (error) {}
							break;
						case 'logourl':
							$('.logo,.logos').attr('src', value);
							break;
					}
				}
			}
		}
	})
</script>

<script>
	//AOS.init();
</script>

<script>
	if (window.history.replaceState) {
		window.history.replaceState(null, null, window.location.href);
	}

	$(window).on('load', function() {

		if ($('.myLoad').slideUp('slow')) {
			$('html,body').removeClass('no-loaded');
		};

		$('.select').select2({
			placeholder: $(this).data('placeholder'),
		});

		let valueDateRangePicker = {};

		$('input.date').daterangepicker({
			"singleDatePicker": true,
			"showDropdowns": true,
			"timePicker": false,
			"autoApply": true,
			"parentEl": $(this).closest('div'),
			"locale": {
				"format": "YYYY",
				"separator": " - ",
				"applyLabel": "Aplicar",
				"cancelLabel": "Cancelar",
				"fromLabel": "Desde",
				"toLabel": "Hasta",
				"customRangeLabel": "Entre",
				"weekLabel": "S",
				"daysOfWeek": ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
				"monthNames": ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto",
					"Septiembre", "Octubre", "Noviembre", "Diciembre"
				],
				"firstDay": 1
			},
			"startDate": moment(),

		}, function(start, end) {
			start.format('YYYY');
		}).on('hide.daterangepicker', function() {


		}).on('apply.daterangepicker', function() {

			valueDateRangePicker[$(this).attr('id')] = $(this).val();
			console.log(valueDateRangePicker);
		});


		$('select').select2({
			placeholder: $(this).data('placeholder'),
			dropdownAutoWidth: true
		});
		$('[data-bs-toggle="tooltip"]').tooltip();
	});


	<?php if(User::getUserID() != 1) : ?>

	function controlSesion() {
		window.location.href = window.location.href + '?logout';
	};

	var refreshIntervalId = setTimeout(controlSesion, 600000);

	/* later */
	let aumento = 0;
	$(window).on('focus', () => {
		if (aumento == 0) {
			clearTimeout(refreshIntervalId);
			refreshIntervalId = setTimeout(controlSesion, 600000);
			aumento++;
		}
		setTimeout(() => {
			aumento = 0;
		}, 100);
	});
	<?php endif;?>
</script>
</body>

</html>

<?php
ob_end_flush();
?>