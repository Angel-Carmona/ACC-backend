<?php

use Controllers\User\User;

require_once __DIR__ . '/../../../../vendor/autoload.php';

tabla('id_coa_relations', 'coa_relations');


function tabla($primaria, $tabla)
{ ?>

    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary d-none openModal" data-bs-toggle="modal"
        data-bs-target="#myModal"></button>
    <!-- The Modal -->
    <div class="modal fade" id="myModal" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered animate__animated  animate__backInLeft">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Editar registro</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="editarPala" method="POST" class="w-100 form-row row"></form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger cerrarModal" data-bs-dismiss="modal"
                        onclick="$('#myTabContent').removeClass('filterBlur');">Cancelar</button>
                    <button type="button" class="btn btn-success guardar-registro" data-bs-dismiss="modal"
                        onclick="$('#myTabContent').removeClass('filterBlur');">Guardar</button>
                </div>

            </div>
        </div>
    </div>
    <div class="p-3 col-lg-12 card shadow" style="min-height:80vh;max-height:auto" id="myTabContent">
        <div class="tab-pan fade col-lg-12 show borde pl-3 pr-3 pt-2 pb-2" id="home" role="tabpanel"
            aria-labelledby="home-tab">
            <div class="px-3 table-responsive">
                <table id="coas" class="display compact bg-white">
                    <thead style="margin-top:10px"></thead>
                    <tbody></tbody>
                </table>
            </div>

            <script>
                let row, table, inputDiv = "";
                let seleccionados = [];
                let columns = [];
            
                let excluir = ["fecha_baremo", "ipri", "ipri_acumulado", "id", "checkbox"];
                let selectArray = ["id_provincia", "id_concepto"];

                let config = {
                    primaryKey: '<?php echo $primaria ?>'
                };

                let coas = window.callapi(JSON.stringify([{
                    name: "action",
                    value: "getCoas"
                }]));

                let roles = window.callapi(JSON.stringify([{
                    name: "action",
                    value: "getRoles"
                }]));

                let provincias = window.callapi(JSON.stringify([{
                    name: "action",
                    value: "getProvincias"
                }]));

                let conceptos = window.callapi(JSON.stringify([{
                    name: "action",
                    value: "getConceptos"
                }]));

                for (i = 0; i < 1; i++) {

                    for (const key in coas[i]) {

                        if (Object.hasOwnProperty.call(coas[i], key)) {

                            let miniCol = {
                                data: key,
                                visible: ![config.primaryKey].includes(key) ? true : false,
                                orderable: true,
                                searchable: true,
                            };

                            if (["id_concepto"].includes(key)) {
                                miniCol.render = function (data) {
                                    var concepto = conceptos.filter(e => parseInt(e.id_concepto) === parseInt(data));
                                    return concepto[0].concepto_code + '. ' + concepto[0].concepto;
                                }
                            }
                            if (["id_provincia"].includes(key)) {
                                miniCol.render = function (data) {
                                    var provincia = provincias.filter(e => parseInt(e.id_provincia) === parseInt(data))[0].provincia;
                                    return provincia;
                                };
                            }
                            columns.push(
                                miniCol
                            );
                            if ([config.primaryKey].includes(key)) {
                                inputDiv += '<input style="display:none" hidden id="edi-' + key + '" name="' + key + '">';
                            } else if (selectArray.includes(key)) {
                                inputDiv += "<div class='col-lg-4' id='div-" + key + "'>";
                                inputDiv += '<label for=edi-' + key + '>' + ((key).replace(/_/g, ' ')) + '</label>';
                                inputDiv += '</div>';
                            } else if (excluir.includes(key)) {

                            } else {
                                inputDiv += "<div class='col-lg-4' id='div-" + key + "'>";
                                inputDiv += '<label for=edi-' + key + '>' + ((key).replace(/_/g, ' ')) + '</label>';
                                inputDiv += '<input id="edi-' + key + '" name="' + key + '">';
                                inputDiv += '</div>';
                            }
                        }
                    }
                    jQuery('#editarPala').append(inputDiv);
                }

            $(document).ready(function () {

                    addTabla(coas);

                    function addTabla(coas) {

                        try {
                            coas = JSON.parse(coas);
                        } catch (error) {
                            
                        }

                        if (table) table.destroy();
                        
                        var thead = "";
                        thead += "<tr>";
                        for (i = 0; i < 1; i++) {
                            for (const key in coas[i]) {
                                if (Object.hasOwnProperty.call(coas[i], key)) {
                                    const element = coas[i][key];
                                    thead += '<td controls="example" style="width:0px;text-align:left;text-transform:uppercase;font-weight:bold;">' + key.replace(/id_/g, '') + '</td>';
                                }
                            }
                        }
                        thead += '</tr>';
                        jQuery('#coas thead').empty().append(thead);

                        table = jQuery('#coas').DataTable({
                            select: true,
                            paging: true,
                            lengthMenu: [
                                [5, 8, 10, 25, 50, -1],
                                [5, 8, 10, 25, 50, "All"]
                            ],
                            pageLength: 8,
                            fixedColumns: true,
                            searchHighlight: true,
                            data: coas,
                            columns: columns,
                            fixedHeader: {
                                header: true
                            },
                            dom: 'Bfrtip',
                            heigth: '750px',
                            columnDefs: [{ targets: 0, className: 'noVis'}],
                            buttons: [ 'select',{ extend: 'pageLength',},{ extend: 'copy', text: 'Copiar', exportOptions:{ columns: ':visible'}},{ extend: 'csv', text: 'Exportar a CSV', exportOptions:{ columns: ':visible'}},{ extend: 'excelHtml5', text: 'Exportar a Excel', exportOptions:{ columns: ':visible'}},{ extend: 'print', text: 'Imprimir', exportOptions:{ columns: ':visible'}} <?php if (User::getUserID()==1): ?>,{ text: 'Importar', action: function (e, dt, node, config){ window.location.href='/excel/plugins/importar-excel/importBancos/index.php';}} <?php endif; ?>,{ extend: 'colvis', columns: ':not(.noVis)'} ],
                        language: languageTable
                    }).on('dblclick', 'tbody td', function () {
                        row = table.row(this).data();

                        for (const key in row) {
                            if (Object.hasOwnProperty.call(row, key)) {
                                const valor = row[key];
                                jQuery('#edi-' + key).val(valor);
                            }
                        }

                        jQuery('.openModal').click();
                        $('#myTabContent').addClass('filterBlur');

                    }).on('mouseup', 'tbody tr', function (e) {

                        row = table.row(this).data();

                        if (e.which !== 3) {
                            if ($(this).hasClass('active')) {
                                $(this).removeClass("active");
                                seleccionados = seleccionados.filter((value) => value[config.primaryKey] !== row[config.primaryKey]);
                            } else {
                                $(this).addClass("active");
                                seleccionados.push(row);
                            }
                            console.log(seleccionados);
                        }


                    }).on('mousedown', 'tbody td', function () {
                        row = table.row(this).data();
            
                    })
                }

                let selProvincias = '<select name="id_provincia" id="edi-id_provincia" class="custom-select form-select">';
                for (let index = 0; index < provincias.length; index++) {
                    const element = provincias[index];
                    selProvincias += '<option value="' + element.id_provincia + '">' + element.provincia + '</option>';
                }
                selProvincias += '</select>';
                jQuery('#div-id_provincia').append(selProvincias);

                let selConceptos = '<select name="id_concepto" id="edi-id_concepto" class="custom-select form-select">';
                for (let index = 0; index < conceptos.length; index++) {
                    const element = conceptos[index];
                    selConceptos += '<option value="' + element.id_concepto + '">' + element.concepto_code + '. ' + element
                        .concepto + '</option>';
                }
                selConceptos += '</select>';
                jQuery('#div-id_concepto').append(selConceptos);

                $('select').select2();

                jQuery(function ($) {
                    $.contextMenu({
                        selector: 'tbody td',
                        callback: function (key, options) {

                            $('.modal input[name="eliminar"]').remove();
                            $('.modal input[name="insertar"]').remove();
                            $('.modal input[name="editar"]').remove();

                            if (key == 'edit') {
                                for (const key in row) {
                                    if (Object.hasOwnProperty.call(row, key)) {
                                        const valor = row[key];
                                        jQuery('#edi-' + key).val(valor);
                                    }
                                }
           
                                jQuery('.guardar-registro').unbind('click').off('click').on('click', function () {
                                    let inputEditar = jQuery('<input>').attr({
                                        name: 'editar',
                                        value: '1',
                                        hidden: 'hidden'
                                    });
                                    jQuery('#editarPala').append($(inputEditar));
                                    jQuery('#editarPala').submit();
                                });

                                $('#myTabContent').addClass('filterBlur');
                                jQuery('.openModal').click();

                            } else if (key == 'add') {
                                for (const key in row) {
                                    if (Object.hasOwnProperty.call(row, key)) {
                                        const valor = row[key];
                                        jQuery('#edi-' + key).val("");
                                    }
                                }
                                jQuery('.guardar-registro').unbind('click').off('click').on('click', function () {
                                    let inputEditar = jQuery('<input>').attr({
                                        name: 'insertar',
                                        value: '1',
                                        hidden: 'hidden'
                                    });
                                    jQuery('#editarPala').append($(inputEditar));
                                    jQuery('#editarPala').submit();
                                });
                                $('#myTabContent').addClass('filterBlur');
                                jQuery('.openModal').click();
                            } else if (key == 'delete') {

                                if (confirm('desea eliminar el registro ' + row[config.primaryKey]) == true) {
                                    jQuery('#edi-' + config.primaryKey).val(row[config.primaryKey]);
                                    jQuery('#editarPala').append('<input hidden name="eliminar" value="1">');
                                    jQuery('#editarPala').submit();
                                }
                            }
                        },
                        items: { "add":{ icon: 'fa-plus', name: "Añadir"}, "edit":{ icon: 'fa-edit', name: "Editar"}, "delete":{ icon: 'fa-trash', name: "Eliminar"},}
                    });
                });

                jQuery('.guardar-registro').on('click', function () {

                    $('.modal input[name="eliminar"]').remove();
                    $('.modal input[name="insertar"]').remove();
                    $('.modal input[name="editar"]').remove();

                    jQuery('#editarPala').append('<input hidden name="editar" value="1">');
                    jQuery('#editarPala').submit();
                });

                jQuery('#editarPala').on('submit', function (e) {

                    e.preventDefault();

                    let dataSend = JSON.stringify([{
                        name: "action",
                        value: "setValues"
                    }, {
                        name: config.primaryKey,
                        value: row[config.primaryKey],
                    }, {
                        name: "primaria",
                        value: config.primaryKey,
                    }, {
                        name: 'data',
                        value: $(this).serializeArray()
                    }, {
                        name: 'tabla',
                        value: '<?php echo $tabla ?>'
                    }]);

                    window.callapi(dataSend, false, "Registro editado correctamente.");

                    coas = window.callapi(JSON.stringify([{
                        name: "action",
                        value: "getCoas"
                    }]) , `addTabla`);

                    return false;
                });

                window.addTabla = addTabla;
            });
            </script>
        </div>
    </div>

    <?php
}
?>