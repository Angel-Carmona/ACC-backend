<?php

use Controllers\System\System;
use Controllers\User\User;

$addFecha = "https://apps.fomento.gob.es/BoletinOnline/?nivel=2&orden=08000000";
?>
<style>
tbody tr {
    border-bottom: 1px solid #cac4c4 !important
}

td,
th {
    vertical-align: middle !important;
    padding: 2px !important;
}

td {
    font-weight: bold;
    padding-left: 8px
}

.form-control {
    padding: 0.095rem 0.75rem !important;
}

form label,
form legend {
    display: block;
    margin: 0.2rem 0.2em;
    font-size: .9em;
}

table thead {
    display: none
}

button.dt-button {
    padding: 1px 6px 1px 6px !important;
    color: #444 !important;
    border-radius: 5px !important;
}

.dataTables_info {
    display: none
}

.slider-wrapper {
    --slider-height: .3em;
    --slider-value: 0;
    display: flex;
    align-items: center;
    position: relative;
    border-radius: 3.125em;
    padding: 0.25em;
    width: 100%;
    background-image: linear-gradient(to bottom, #cdccd7, #efeef2);
    box-shadow: 0 1px 1px rgba(255, 255, 255, 0.6);
}

.slider-wrapper:nth-child(1) {
    --slider-color: #1664e4;
}

.slider-wrapper:nth-child(2) {
    --slider-color: #e5681c;
}

.slider-track {
    display: flex;
    align-items: center;
    position: relative;
    border-radius: inherit;
    height: var(--slider-height);
    width: calc(100%);
    background-image: linear-gradient(to bottom, #fff, transparent), linear-gradient(to right, var(--slider-color) 0% calc(var(--slider-value) * 1%), #cccbd2 calc(var(--slider-value) * 1%) 100%);
    background-blend-mode: overlay, normal;
    box-shadow: inset 0 0.0625em 0.125em rgba(0, 0, 0, 0.4);
}

.slider-input {
    -moz-appearance: none;
    -webkit-appearance: none;
    appearance: none;
    position: absolute;
    z-index: 1;
    top: 0;
    left: 50%;
    transform: translate(-50%);
    border-radius: inherit;
    width: calc(100% + .875em);
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.slider-input::-webkit-slider-thumb {
    -moz-appearance: none;
    -webkit-appearance: none;
    appearance: none;
    border-radius: 50%;
    padding: 0.5em;
    width: 1.25em;
    height: 1.25em;
}

.slider-input::-moz-range-thumb {
    -moz-appearance: none;
    -webkit-appearance: none;
    appearance: none;
    border-radius: 50%;
    padding: 0.5em;
    width: 1.25em;
    height: 1.25em;
}

.slider-thumb {
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    left: calc(var(--slider-value) / 100 * (100% - var(--slider-height)) + var(--slider-height) / 2);
    transform: translateX(-50%);
    border-radius: 50%;
    width: 2.25em;
    height: 2.25em;
    background-image: linear-gradient(to bottom, #f39f2b, #ebb631);
    box-shadow: 0 0.125em 0.25em rgba(0, 0, 0, 0.3);
}

.slider-thumb::before {
    content: "";
    position: absolute;
    border-radius: inherit;
    width: 68%;
    height: 68%;
    background-image: linear-gradient(to bottom, #c5c5cf, #f0f0f2);
}

.tr-resalte {
    background: #ffa50036 !important
}

td:not(.tr-resalte td) {
    font-weight: 300 !important
}

.text-small {
    font-size: 10px !important
}

.cursor-help {
    cursor: help !important;
}

.tooltip {
    font-size: 11px !important;
}

.table-results tr,
.table-results td {
    transition: display .5s !important;
    font-size: 14px !important
}


.dataTables_filter {
    position: absolute;
    top: -50px;
    right: 1px;
}

.dataTables_filter label input {
    padding: 0 !important
}

div.dt-buttons {
    position: absolute;
    left: -34px;
    right: 0;
    margin: auto;
    justify-content: center;
    display: flex;
    top: -50px;
}

table {
    margin-top: 10px
}

@media screen and (min-width: 900px) {
    .panel.important {
        width: 100%;
    }
}

.need {
    position: absolute;
    right: -5px;
    z-index: 10;
    cursor: help !important
}

.noneed {
    position: absolute;
    right: -5px;
    z-index: 10;
    cursor: help !important
}

a.text-blue {
    font-size: 12px
}

label {
    position: relative
}

.need svg {
    height: 15px;
    fill: #e59f0070;
    margin-right: 5px;
}

.noneed svg {
    height: 15px;
    fill: #00800059
}
</style>

<div class="panel important">
    <div class="row m-0 p-0">
        <div class="col-lg-6 px-1" style="transform:scale(.98)">
            <form action="" method="post" class="form form-row row pb-4">
                <div class="col-lg-6 col-lg-12 mt-1 mb-1" style="position:relative;">
                    <label for="fechaSiniestro">IPRI actual (%)&nbsp;&nbsp;&nbsp;&nbsp;
                        <small>
                            <a href="<?= $addFecha ?>" target="_blank" class="text-blue">
                                <span class="fa fa-hand-pointer-o"></span>&nbsp;Consultar IPRI actual
                            </a>
                        </small>
                        <span class="need" data-bs-toggle="tooltip" title="Campo obligatorio"><svg
                                xmlns="http://www.w3.org/2000/svg" clip-rule="evenodd" fill-rule="evenodd"
                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24">
                                <path
                                    d="m12.002 21.534c5.518 0 9.998-4.48 9.998-9.998s-4.48-9.997-9.998-9.997c-5.517 0-9.997 4.479-9.997 9.997s4.48 9.998 9.997 9.998zm0-8c-.414 0-.75-.336-.75-.75v-5.5c0-.414.336-.75.75-.75s.75.336.75.75v5.5c0 .414-.336.75-.75.75zm-.002 3c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1z"
                                    fill-rule="nonzero" />
                            </svg>
                        </span>
                        <span class="noneed d-none" data-bs-toggle="tooltip" title="Campo obligatorio"><svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M0 12.116l2.053-1.897c2.401 1.162 3.924 2.045 6.622 3.969 5.073-5.757 8.426-8.678 14.657-12.555l.668 1.536c-5.139 4.484-8.902 9.479-14.321 19.198-3.343-3.936-5.574-6.446-9.679-10.251z" />
                            </svg>
                        </span>
                    </label>
                    <input type="number" class="form-control " value="130" name="valor_fecha_ipri" id="valor_fecha_ipri"
                        placeholder="...">
                </div>
                <div class="col-lg-6 mt-1 mb-1">
                    <label for="Provincia">Provincia
                        <span class="need" data-bs-toggle="tooltip" title="Campo obligatorio"><svg
                                xmlns="http://www.w3.org/2000/svg" clip-rule="evenodd" fill-rule="evenodd"
                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24">
                                <path
                                    d="m12.002 21.534c5.518 0 9.998-4.48 9.998-9.998s-4.48-9.997-9.998-9.997c-5.517 0-9.997 4.479-9.997 9.997s4.48 9.998 9.997 9.998zm0-8c-.414 0-.75-.336-.75-.75v-5.5c0-.414.336-.75.75-.75s.75.336.75.75v5.5c0 .414-.336.75-.75.75zm-.002 3c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1z"
                                    fill-rule="nonzero" />
                            </svg></span>
                    </label>
                    <div class="provincia-div">
                        <select name="provincia" id="provincia" placeholder="..." class="custom-select shadow">
                            <?php $provincias = User::getProvinces(); ?>
                            <option value="">
                                Seleccione una provincia
                            </option>
                            <?php foreach ($provincias as $provincia): ?>
                            <option value="<?php echo $provincia['id_provincia'] ?>">
                                <?php echo $provincia['provincia'] ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 mt-1 mb-1">
                    <label for="Provincia">Año actual</label>
                    <div class="">
                        <select name="fecha_actual" id="fecha_actual" placeholder="..." class="custom-select shadow">
                            <option value="">
                                Seleccione un año
                            </option>
                            <option value="<?php echo date('Y') + 1; ?>">
                                <?php echo date('Y') + 1; ?>
                            </option>
                            <?php for ($i = date('Y'); $i > (date('Y') - 100); $i--): ?>
                            <option <?php echo $i == date('Y') ? 'selected' : "" ?> value="<?php echo $i ?>">
                                <?php echo $i ?>
                            </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 mt-1 mb-1">
                    <label for="fecha_construccion">Año Construcción
                        <span class="need" data-bs-toggle="tooltip" title="Campo obligatorio"><svg
                                xmlns="http://www.w3.org/2000/svg" clip-rule="evenodd" fill-rule="evenodd"
                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24">
                                <path
                                    d="m12.002 21.534c5.518 0 9.998-4.48 9.998-9.998s-4.48-9.997-9.998-9.997c-5.517 0-9.997 4.479-9.997 9.997s4.48 9.998 9.997 9.998zm0-8c-.414 0-.75-.336-.75-.75v-5.5c0-.414.336-.75.75-.75s.75.336.75.75v5.5c0 .414-.336.75-.75.75zm-.002 3c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1z"
                                    fill-rule="nonzero" />
                            </svg></span>
                    </label>
                    <div class="">
                        <select name="fecha_construccion" id="fecha_construccion" placeholder="..."
                            class="custom-select shadow">
                            <option value="">
                                Seleccione un año
                            </option>
                            <?php for ($i = (date('Y') - 1); $i > ((date('Y') - 1) - 100); $i--): ?>
                            <option value="<?php echo $i ?>">
                                <?php echo $i ?>
                            </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 mt-1 mb-1">
                    <label for="banco">Criterio de cálculo
                        <span class="need" data-bs-toggle="tooltip" title="Campo obligatorio"><svg
                                xmlns="http://www.w3.org/2000/svg" clip-rule="evenodd" fill-rule="evenodd"
                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24">
                                <path
                                    d="m12.002 21.534c5.518 0 9.998-4.48 9.998-9.998s-4.48-9.997-9.998-9.997c-5.517 0-9.997 4.479-9.997 9.997s4.48 9.998 9.997 9.998zm0-8c-.414 0-.75-.336-.75-.75v-5.5c0-.414.336-.75.75-.75s.75.336.75.75v5.5c0 .414-.336.75-.75.75zm-.002 3c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1z"
                                    fill-rule="nonzero" />
                            </svg></span>
                    </label>
                    <div class="">
                        <select name="banco" id="banco" placeholder="Seleccciona un banco" class="custom-select shadow">
                            <option value="">
                                Seleccione un criterio
                            </option>
                            <?php foreach (["Bancos", "Coa", "Catastros"] as $banco): ?>
                            <option value="<?php echo $banco ?>">
                                <?php echo $banco ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 mt-1 mb-1">
                    <label for="concepto">Uso <span class="need" data-bs-toggle="tooltip" title="Campo obligatorio"><svg
                                xmlns="http://www.w3.org/2000/svg" clip-rule="evenodd" fill-rule="evenodd"
                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24">
                                <path
                                    d="m12.002 21.534c5.518 0 9.998-4.48 9.998-9.998s-4.48-9.997-9.998-9.997c-5.517 0-9.997 4.479-9.997 9.997s4.48 9.998 9.997 9.998zm0-8c-.414 0-.75-.336-.75-.75v-5.5c0-.414.336-.75.75-.75s.75.336.75.75v5.5c0 .414-.336.75-.75.75zm-.002 3c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1z"
                                    fill-rule="nonzero" />
                            </svg></span>
                    </label>
                    <div class="">
                        <select name="concepto" id="concepto" placeholder="concepto" class="custom-select shadow">
                            <?php $conceptos = User::getConceptos(); ?>
                            <option value="">
                                Seleccione un uso
                            </option>
                            <?php foreach ($conceptos as $concepto): ?>
                            <option value="<?php echo $concepto['id_concepto'] ?>">
                                <?php echo $concepto['concepto_code'] ?>.
                                <?php echo $concepto['concepto'] ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>


                <?php if (System::getTypeForm() == 1) {
					require_once __DIR__ . '/Componentes/form-slider.php';
				} elseif (System::getTypeForm() == 2) {
					require_once __DIR__ . '/Componentes/form-inputs.php';
				} ?>


                <div class="col-lg-6 mt-3 mb-3 d-none" style="position:relative;">
                    <button class="btn btn-primary w-100 mt-4 p-0" style="height:30px" type="button"><i
                            class="fa fa-search"></i>
                        &nbsp;Buscar</button>
                </div>
            </form>

        </div>
        <div class="col-lg-6 px-4 mt-4" style="transform:scale(1)">
            <div class="card shadow card-body">
                <h5>RESULTADO</h5>
                <br>
                <table class="table-results w-100">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row" style="width:25%;border:0">
                                PEM <i class="fa fa-info-circle text-small cursor-help" data-bs-toggle="tooltip"
                                    title="En el mundo de la construcción se conoce como PEM al Presupuesto de Ejecución Material. Este presupuesto, en pocas palabras, se trata de la suma de todas las unidades de una construcción en base a su precio unitario.">
                                </i>
                            </td>
                            <td style="width:1%;border:0" class="pem">
                                S/N
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" style="width:25%;border:0">
                                IPRI <i class="fa fa-info-circle text-small cursor-help" data-bs-toggle="tooltip"
                                    title="El Índice de Precios Industriales (IPRI) mide la evolución mensual de los precios de los productos fabricados por la industria y vendidos en el mercado interior en la primera etapa de su comercialización.">
                                </i>

                            </td>
                            <td style="width:1%;border:0" class="ipri">
                                S/N
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" style="width:25%;border:0">
                                IPRI Acumulado
                            </td>
                            <td style="width:1%;border:0" class="ipri_acumulado">
                                S/N
                            </td>
                        </tr>
                        <tr class="tr-resalte">
                            <td scope="row" style="width:25%;border:0">
                                PEM Actualizado
                            </td>
                            <td style="width:1%;border:0" class="pem_actualizado">
                                S/N
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" style="width:25%;border:0">
                                Beneficio Industrial
                            </td>
                            <td style="width:1%;border:0" class="beneficio_industrial">
                                S/N
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" style="width:25%;border:0">
                                Gastos Generales
                            </td>
                            <td style="width:1%;border:0" class="gastos_generales">
                                S/N
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" style="width:25%;border:0">
                                Total
                            </td>
                            <td style="width:1%;border:0" class="totalTd">
                                S/N
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" style="width:25%;border:0">
                                IVA
                            </td>
                            <td style="width:1%;border:0" class="ivaResult">
                                S/N
                            </td>
                        </tr>
                        <tr class="tr-resalte">
                            <td scope="row" style="width:25%;border:0">
                                Presupuesto de Contrata
                            </td>
                            <td style="width:1%;border:0" class="pcResults">
                                S/N
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" style="width:25%;border:0">
                                Honorarios Técnicos
                            </td>
                            <td style="width:1%;border:0" class="honorarios_tecnicos">
                                S/N
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" style="width:25%;border:0">
                                IVA de honorarios
                            </td>
                            <td style="width:1%;border:0" class="honorarios_tecnicos_iva">
                                S/N
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" style="width:25%;border:0">
                                Tasas municipales
                            </td>
                            <td style="width:1%;border:0" class="tasas_result">
                                S/N
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" style="width:25%;border:0">
                                ICIO
                            </td>
                            <td style="width:1%;border:0" class="icio_result">
                                S/N
                            </td>
                        </tr>
                        <tr class="tr-resalte">
                            <td scope="row" style="width:25%;border:0">
                                Presupuesto General
                            </td>
                            <td style="width:1%;border:0" class="pg_result">
                                S/N
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" style="width:25%;border:0">
                                Valor residual
                            </td>
                            <td style="width:1%;border:0" class="valor_residial_result">
                                S/N
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" style="width:25%;border:0">
                                Antigüedad
                            </td>
                            <td style="width:1%;border:0" class="antiguedad_r">
                                S/N
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" style="width:25%;border:0">
                                Depreciación
                            </td>
                            <td style="width:1%;border:0" class="depreciacion">
                                S/N
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" style="width:25%;border:0">
                                Valor real
                            </td>
                            <td style="width:1%;border:0" class="valor_real">
                                S/N
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" style="width:25%;border:0">
                                Valor nuevo
                            </td>
                            <td style="width:1%;border:0" class="valor_nuevo">
                                S/N
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$('table').DataTable({
    paging: false,
    lengthMenu: [
        [5, 8, 10, 25, 50, -1],
        [5, 8, 10, 25, 50, "All"]
    ],
    pageLength: 'all',
    fixedColumns: false,
    searchHighlight: true,
    fixedHeader: {
        header: false
    },
    dom: 'Bfrtip',
    buttons: [{
        extend: 'copy',
        text: 'Copiar',
    }, {
        extend: 'csv',
        text: 'Exportar a CSV',
    }, {
        extend: 'excelHtml5',
        text: 'Exportar a Excel',
    }, {
        extend: 'print',
        text: 'Imprimir',
    }],
    language: languageTable
});
</script>

<script type="text/javascript">
let provincia, banco, concepto, valor_fecha_ipri, gastor_generales, beneficio_industrial, IVA_IGIC,
    honorarios_tecnicos, tasas, icio, valor_residual, vida_util, limite_valor_nuevo, fecha_construccion_input;

$('form .btn').click(calcular);
$('form input').change(calcular);
$('form select').change(calcular);

function calcular() {
    let v = ($(this).val());

    if ((v) !== "") {
        $(this).closest('.col-lg-6').find('.need').addClass('d-none');
        $(this).closest('.col-lg-6').find('.noneed').removeClass('d-none');
    } else if ((v) === "") {
        $(this).closest('.col-lg-6').find('.need').removeClass('d-none');
        $(this).closest('.col-lg-6').find('.noneed').addClass('d-none');
    }
    provincia = $('#provincia');
    banco = $('#banco');
    concepto = $('#concepto');
    valor_fecha_ipri = $('#valor_fecha_ipri');
    gastor_generales = $('#gastor_generales');
    beneficio_industrial = $('#beneficio_industrial');
    IVA_IGIC = $('#IVA_IGIC');
    honorarios_tecnicos = $('#honorarios_tecnicos');
    tasas = $('#tasas');
    icio = $('#icio');
    valor_residual = $('#valor_residual');
    vida_util = $('#vida_util');
    limite_valor_nuevo = $('#limite_valor_nuevo');
    fecha_construccion_input = $('#fecha_construccion');

    let object = JSON.stringify([{
            name: 'action',
            value: 'getIpri'
        },
        {
            name: "data",
            value: {
                provinciaId: parseInt($(provincia).val()),
                tabla: $(banco).val().toLowerCase(),
                conceptoId: parseInt($(concepto).val())
            }
        }
    ]);

    let ipriAndEuros = validar(object);

    if (!ipriAndEuros) {
        return validar({}, '', true);
    }
    if (!ipriAndEuros.hasOwnProperty('ipri')) {
        return validar({}, '', true);
    }

    $('.ipri').empty().append(ipriAndEuros.ipri + '%');

    let valor_fecha_ipri_numerico = parseFloat(parseNumerico($(valor_fecha_ipri).val()));
    let valor_irpi_numerico = parseFloat(parseNumerico(ipriAndEuros.ipri));

    let ipriAcumulado = (valor_fecha_ipri_numerico - valor_irpi_numerico);
    ipriAcumulado = redondeo(ipriAcumulado / 100);

    if (isNaN(ipriAcumulado)) {
        return;
    }
    $('.ipri_acumulado').empty().append(ipriAcumulado + '%');

    let nameObject = $(banco).val().substring(0, $(banco).val().length - 1).toLowerCase();
    if (nameObject == 'co') {
        nameObject = 'coa'
    }

    let pem = parseNumerico(ipriAndEuros[nameObject + '_euros']);
    if (isNaN(pem)) {
        return;
    }
    $('.pem').empty().append(addCommas(pem)).append('€');

    let pem_actualizado = pem * (1 + ipriAcumulado);
    pem_actualizado = redondeo(pem_actualizado);

    $('.pem_actualizado').empty().append(pem_actualizado).append('€');
    if (isNaN(pem_actualizado)) {
        return;
    }

    let beneficio_industrial_total = (parseFloat($(beneficio_industrial).val().replace(',', '.')) / 100);
    beneficio_industrial_total = beneficio_industrial_total * pem_actualizado;
    beneficio_industrial_total = redondeo(beneficio_industrial_total);
    if (isNaN(beneficio_industrial_total)) {
        return;
    }
    $('.beneficio_industrial').empty().append(addCommas(beneficio_industrial_total)).append('€');

    let gastos_generales_total = (parseFloat($(gastor_generales).val().replace(',', '.')) / 100);
    gastos_generales_total = gastos_generales_total * beneficio_industrial_total;
    gastos_generales_total = redondeo(gastos_generales_total);
    if (isNaN(gastos_generales_total)) {
        return;
    }
    $('.gastos_generales').empty().append(addCommas(gastos_generales_total)).append('€');


    let total = (pem_actualizado) + (beneficio_industrial_total) + (gastos_generales_total);
    total = redondeo(total);
    if (isNaN(total)) {
        return;
    }
    $('.totalTd').empty().append(addCommas(total)).append('€');


    let ivaValor = (parseFloat($(IVA_IGIC).val().replace(',', '.')) / 100);
    let IVA_IGIC_TOTAL = (parseFloat($(IVA_IGIC).val().replace(',', '.')) / 100);
    IVA_IGIC_TOTAL = total * IVA_IGIC_TOTAL;
    IVA_IGIC_TOTAL = redondeo(IVA_IGIC_TOTAL);
    if (isNaN(IVA_IGIC_TOTAL)) {
        return;
    }
    $('.ivaResult').empty().append(addCommas(IVA_IGIC_TOTAL)).append('€');

    let pc = total + IVA_IGIC_TOTAL;
    pc = redondeo(pc);
    if (isNaN(pc)) {
        return;
    }
    $('.pcResults').empty().append(addCommas(pc)).append('€');


    let honorarios_tecnicos_total = (parseFloat($(honorarios_tecnicos).val().replace(',', '.')) / 100);
    honorarios_tecnicos_total = honorarios_tecnicos_total * pem_actualizado;
    honorarios_tecnicos_total = redondeo(honorarios_tecnicos_total);
    if (isNaN(honorarios_tecnicos_total)) {
        return;
    }
    $('.honorarios_tecnicos').empty().append(addCommas(honorarios_tecnicos_total)).append('€');

    let honorarios_tecnicos_total_iva = (honorarios_tecnicos_total * ivaValor);
    honorarios_tecnicos_total_iva = redondeo(honorarios_tecnicos_total_iva);
    if (isNaN(honorarios_tecnicos_total_iva)) {
        return;
    }
    $('.honorarios_tecnicos_iva').empty().append(addCommas(honorarios_tecnicos_total_iva)).append('€');

    let tasas_total = (parseFloat($(tasas).val().replace(',', '.')) / 100);
    tasas_total = tasas_total * pem_actualizado;
    tasas_total = redondeo(tasas_total);
    if (isNaN(tasas_total)) {
        return;
    }
    $('.tasas_result').empty().append(addCommas(tasas_total)).append('€');

    let icio_total = (parseFloat($(icio).val().replace(',', '.')) / 100);
    icio_total = icio_total * pem_actualizado;
    icio_total = redondeo(icio_total);
    if (isNaN(icio_total)) {
        return;
    }
    $('.icio_result').empty().append(addCommas(icio_total)).append('€');


    let totalGp = honorarios_tecnicos_total + honorarios_tecnicos_total_iva + tasas_total + icio_total + pc;
    totalGp = redondeo(totalGp);
    if (isNaN(totalGp)) {
        return;
    }
    $('.pg_result').empty().append(addCommas(totalGp)).append('€');


    let valor_residial_total = (parseFloat($(valor_residual).val().replace(',', '.')) / 100);
    valor_residial_total = redondeo(valor_residial_total);
    if (isNaN(valor_residial_total)) {
        return;
    }
    $('.valor_residial_result').empty().append(addCommas(valor_residial_total)).append('€');

    let vida_util_value = (parseFloat($(vida_util).val().replace(',', '.')) / 100);
    vida_util_value = redondeo(vida_util_value);
    if (isNaN(vida_util_value)) {
        return;
    }
    if ((parseInt($('#fecha_actual').val()) < parseInt($('#fecha_construccion').val()))) {
        return error('#fecha_construccion', "El año de construcción no puedes ser mayor que el año actual.", type =
            'select', true);
    }
    let antigu = (parseInt($('#fecha_actual').val()) - parseInt($(fecha_construccion_input).val()));
    if (isNaN(antigu)) {
        return;
    }
    $('.antiguedad_r').empty().append(antigu).append(' Años');

    let depreciacion = ((100 - parseFloat(valor_residial_total)) / 100) * parseInt(antigu) / parseFloat(
        vida_util_value);
    depreciacion = redondeo(depreciacion);
    if (isNaN(depreciacion)) {
        return;
    }
    $('.depreciacion').empty().append(addCommas(depreciacion)).append(' %');

    let valor_real = ((100 - parseFloat(depreciacion))) * parseFloat(pem_actualizado);
    valor_real = redondeo(valor_real);
    $('.valor_real').empty().append(addCommas(valor_real)).append(' €');
    if (isNaN(valor_real)) {
        return;
    }
    let valor_nuevo = valor_real + ((parseFloat($(limite_valor_nuevo).val().replace(',', '.')))) * parseFloat(
        pem_actualizado); - pem_actualizado;
    valor_nuevo = redondeo(valor_nuevo);
    if (isNaN(valor_nuevo)) {
        return;
    }
    $('.valor_nuevo').empty().append(addCommas(valor_nuevo)).append(' €');


}



function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? ',' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}

function parseNumerico(string) {
    string = string.replace('.', '').replace(',', '.').replace('€', '').trim();
    return string;
}

function redondeo(num, decimales = 2) {
    var signo = (num >= 0 ? 1 : -1);
    num = num * signo;
    if (decimales === 0)
        return signo * Math.round(num);
    num = num.toString().split('e');
    num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
    num = num.toString().split('e');
    return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
}

function validar(object, swal = false) {
    let type;
    if ($(provincia).val() == "") {
        return error(provincia, "Selecciona una provincia", type = 'select', false);
    }
    if ($(banco).val() == "") {
        return error(banco, "Selecciona una banco", type = 'select', false);
    }
    if ($(concepto).val() == "") {
        return error(concepto, "Selecciona un concepto", type = 'select', false);
    }
    if ($(gastor_generales).val() == "") {
        return error(gastor_generales, "Rellena los gastos genarales", type = 'input', false);
    }
    if ($(valor_fecha_ipri).val() == "") {
        return error(valor_fecha_ipri, "Rellena el valor de Fecha IPRI", type = 'input', false);
    }
    if ($(IVA_IGIC).val() == "") {
        return error(IVA_IGIC, "Rellena el valor de IVA", type = 'input', false);
    }
    if ($(honorarios_tecnicos).val() == "") {
        return error(honorarios_tecnicos, "Rellena el valor de honorarios", type = 'input', false);
    }
    if ($(tasas).val() == "") {
        return error(tasas, "Rellena el valor de Tasas", type = 'input', false);
    }
    if ($(icio).val() == "") {
        return error(icio, "Rellena el valor de icio", type = 'input', false);
    }
    if ($('#fecha_construccion').val() == "") {
        return error('#fecha_construccion', "El año de construcción no puede estar vacío.", type = 'input', false);
    }

    return window.callapi(object, false, false)[0];
}

function error(quien, mensaje, type = 'input', swall) {
    if (swall == true) {
        return swal({
            title: '',
            text: mensaje,
            icon: 'error',
            buttons: false,
            timer: 2050
        }).then(() => {
            switch (type) {
                case 'select':
                    $(quien).select2('open');
                case 'input':
                    $(quien).focus();
            }
        });
    } else {
        switch (type) {
            case 'select':
                $(quien).select2('open');
            case 'input':
                $(quien).focus();
        }
    }
}

$.each($('input,select'), function(i, e) {
    $(e).val("");
});

$.each($('input,select'), function(i, e) {
    let v = ($(e).val());
    if ((v) !== "") {
        $(e).closest('.col-lg-6').find('.need').addClass('d-none');
        $(e).closest('.col-lg-6').find('.noneed').removeClass('d-none');
    } else if ((v) === "") {
        $(e).closest('.col-lg-6').find('.need').removeClass('d-none');
        $(e).closest('.col-lg-6').find('.noneed').addClass('d-none');
    }
    $('#fecha_actual').val(new Date().getFullYear());
});
</script>