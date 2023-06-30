<div class="col-lg-6 mt-3 mb-3 px-5" style="position:relative;">
	<label for="gastos">Gastos generales</label>
	<div class="slider-wrapper">
		<div class="slider-track">
			<input class="slider-input" id="gastor_generales" step="0.01" min="0" max="100" type="range"
				name="gastor_generales" value="50">
			<div class="slider-thumb"></div>
		</div>
	</div>
	<input type="number" step="0.01" min="0" max="100" class="total text-center" value="50.00">
</div>
<div class="col-lg-6 mt-3 mb-3 px-5" style="position:relative;">
	<label for="gastos">Beneficio industrial</label>
	<div class="slider-wrapper">
		<div class="slider-track">
			<input class="slider-input" id="beneficio_industrial" step="0.01" min="0" max="100" type="range"
				name="beneficio_industrial" value="50.00">
			<div class="slider-thumb"></div>
		</div>
	</div>
	<input type="number" step="0.01" min="0" max="100" class="total text-center" value="50.00">
</div>
<div class="col-lg-6 mt-3 mb-3 px-5" style="position:relative;">
	<label for="gastos">IVA IGIC</label>
	<div class="slider-wrapper">
		<div class="slider-track">
			<input class="slider-input" id="IVA_IGIC" step="0.01" min="0" max="100" type="range" name="IVA_IGIC"
				value="50.00">
			<div class="slider-thumb"></div>
		</div>
	</div>
	<input type="number" step="0.01" min="0" max="100" class="total text-center" value="50.00">
</div>
<div class="col-lg-6 mt-3 mb-3 px-5" style="position:relative;">
	<label for="gastos">Tasas municipales</label>
	<div class="slider-wrapper">
		<div class="slider-track">
			<input class="slider-input" id="Tasas_municipales" step="0.01" min="0" max="100" type="range"
				name="Tasas_municipales" value="50.00">
			<div class="slider-thumb"></div>
		</div>
	</div>
	<input type="number" step="0.01" min="0" max="100" class="total text-center" value="50.00">
</div>
<div class="col-lg-6 mt-3 mb-3 px-5" style="position:relative;">
	<label for="gastos">Impuesto sobre la Construcción (ICIO)</label>
	<div class="slider-wrapper">
		<div class="slider-track">
			<input class="slider-input" id="ICIO" type="range" step="0.01" min="0" max="100" type="range" name="ICIO"
				value="50.00">
			<div class="slider-thumb"></div>
		</div>
	</div>
	<input type="number" step="0.01" min="0" max="100" class="total text-center" value="50.00">
</div>
<div class="col-lg-6 mt-3 mb-3 px-5" style="position:relative;">
	<label for="gastos">Honorarios técnicos</label>
	<div class="slider-wrapper">
		<div class="slider-track">
			<input class="slider-input" id="honorarios_tecnicos" step="0.01" min="0" max="100" type="range"
				name="honorarios_tecnicos" value="50.00">
			<div class="slider-thumb"></div>
		</div>
	</div>
	<input type="number" step="0.01" min="0" max="100" class="total text-center" value="50.00">
</div>
<div class="col-lg-6 mt-3 mb-3 px-5" style="position:relative;">
	<label for="gastos">Valor Residual</label>
	<div class="slider-wrapper">
		<div class="slider-track">
			<input class="slider-input" id="ValorResidual" step="0.01" min="0" max="100" type="range"
				name="ValorResidual" value="50.00">
			<div class="slider-thumb"></div>
		</div>
	</div>
	<input type="number" step="0.01" min="0" max="100" class="total text-center" value="50.00">
</div>
<div class="col-lg-6 mt-3 mb-3 px-5" style="position:relative;">
	<label for="gastos">Límite del Valor Nuevo</label>
	<div class="slider-wrapper">
		<div class="slider-track">
			<input class="slider-input" id="limiteValorNuevo" step="0.01" min="0" max="100" type="range"
				name="limiteValorNuevo" value="50.00">
			<div class="slider-thumb"></div>
		</div>
	</div>
	<input type="number" step="0.01" min="0" max="100" class="total text-center" value="50.00">
</div>


<script>
	const sliderWrappers = document.querySelectorAll('.slider-wrapper');
	sliderWrappers.forEach(sliderWrapper => {
		const sliderInput = sliderWrapper.querySelector('.slider-input');
		const minValue = +sliderInput.min || 0;
		const maxValue = +sliderInput.max || 100;
		const updateSlider = () => {
			sliderWrapper.style.setProperty('--slider-value', 100 * +sliderInput.value / (maxValue -
				minValue));
		};

		sliderInput.addEventListener('input', () => {
			updateSlider();
		});

		let cajaTextos = jQuery(sliderWrapper.closest('.col-lg-6')).find('input[type="number"]');

		for (let index = 0; index < cajaTextos.length; index++) {
			cajaTextos[index].addEventListener('keyup', () => {

				if (parseFloat(cajaTextos[index].value) > 100) {
					cajaTextos[index].value = 100.00;
				}

				let valo = 100 * +parseFloat(cajaTextos[index]
					.value) / (
					maxValue - minValue);

				sliderWrapper.style.setProperty('--slider-value', valo);
			});
		}
		updateSlider();
	});

	$('input[type="range"]').on('input', function() {
		$(this).closest('.col-lg-6').find('.total').empty().append(this.value + '%');
		$(this).closest('.col-lg-6').find('input.total').val(this.value);
	});
</script>