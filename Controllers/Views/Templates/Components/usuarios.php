<?php

use Controllers\User\User;

tabla();
function tabla()
{

    $users = User::getUsers();
    $users = json_encode($users);
    $roles = User::getUsergroups();
    $roles = json_encode($roles);
    $query = "";
    if(isset($_POST['user_id'])) {
        $post_data = ($_POST);
        if(isset($_POST['editar'])) {
            $query = 'UPDATE users SET  ' ;
        } elseif(isset($_POST['insertar'])) {
            $query = 'INSERT INTO users SET  user_id=NULL ,' ;
        } elseif(isset($_POST['eliminar'])) {
            $query = 'DELETE FROM users' ;
        }
        $count = count($post_data);
        $i = 0;
        foreach ($post_data as $key => $data) {
            if($key != 'user_id' || $key != "editar") {
                if(!isset($_POST['eliminar'])) {
                    $query .=  $key . ' = "'. $post_data[$key] . '" , ';
                }
                if($i == ($count - 1)) {
                    if(!isset($_POST['eliminar'])) {
                        $query .=  $key . ' = "'. $post_data[$key] . '" ';
                    }
                    if(isset($_POST['editar']) || isset($_POST['eliminar'])) {
                        if(isset($_POST['eliminar']) && $post_data['user_id'] == 1) {
                            return $_SESSION['message'] = "fail";
                        }
                        $query .= ' WHERE user_id= ' .$post_data['user_id'];
                    }
                }
            }
            $i++;
        }
        if(isset($_POST['editar'])) {
            $query = str_replace(', editar = "1" , editar = "1"', '', $query);
        } elseif(isset($_POST['insertar'])) {
            $query = str_replace(', insertar = "1" , insertar = "1"', '', $query);
        }
        if(DB->query($query) > 0) {
            $users = User::getUsers();
            $users = json_encode($users);
            $_SESSION['message'] = "success";
        } else {
            $_SESSION['message'] = "fail";
        }
    }
    ?>
<?php if(isset($_SESSION['message']) && $_SESSION['message'] == 'success') : ?>
<script>
	swal({
		title: " ",
		text: "Registro editado correctamente",
		icon: "success",
		timer: 1500,
		buttons: false
	});
</script>
<?php
        unset($_SESSION['message']);
    endif;?>

<div class="p-3 col-lg-12 card shadow" style="min-height:80vh;max-height:auto" id="myTabContent">
	<div class="tab-pan fade col-lg-12 show borde pl-3 pr-3 pt-2 pb-2" id="home" role="tabpanel"
		aria-labelledby="home-tab">
		<div class="px-3 table-responsive">
			<table id="users" class="display compact">
				<thead style="margin-top:10px"></thead>
				<tbody></tbody>
			</table>
		</div>
		<!-- Button to Open the Modal -->
		<button type="button" class="btn btn-primary d-none openModal" data-bs-toggle="modal" data-bs-target="#myModal">
			Open modal
		</button>
		<!-- The Modal -->
		<div class="modal fade" id="myModal">
			<div class="modal-dialog modal-lg ">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Editar registro</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						<form id="editarPala" method="POST" class="w-100 form-row row"></form>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-danger cerrarModal" data-bs-dismiss="modal">Close</button>
						<button type="button" class="btn btn-success guardar-registro">Guardar</button>
					</div>

				</div>
			</div>
		</div>
		<script>
			let columns = [],
				thead = "",
				inputDiv = "",
				row;

			let users = window.callapi(JSON.stringify([{
				name: "action",
				value: "getUsers"
			}]));

			let roles = window.callapi(JSON.stringify([{
				name: "action",
				value: "getRoles"
			}]));

			thead += "<tr>";

			for (i = 0; i < 1; i++) {
				const laPala = users[i];
				for (const key in laPala) {
					if (Object.hasOwnProperty.call(laPala, key)) {
						const element = laPala[key];
						thead += '<td style="width:0px;text-align:left">' + key + '</td>';
						let miniCol = {
							data: key,
							visible: !["user_id", "password", "secret", "can_delete"].includes(key) ? true : false,
						};
						if (["date_created", "date_updated", "last_login"].includes(key)) {
							miniCol.render = function(data) {
								let output = '';
								var date = new Date(data);
								date.toLocaleDateString();
								if (date !== 'Invalid Date') {
									let horas = date.getHours();
									let minutos = date.getMinutes();
									let segundos = date.getSeconds();
									if (!isNaN(horas) && !isNaN(minutos) && !isNaN(segundos)) {
										output =
											`${date.toLocaleDateString()} - ${horas < 10 ? '0'+ horas : horas}:${minutos < 10 ? '0'+ minutos: minutos}:${segundos < 10 ? '0'+ segundos : segundos}`;
									}
								}
								return `${output}`;
							};
						} else if (["usergroup"].includes(key)) {
							miniCol.render = function(data) {
								var rol = roles.filter(e => parseInt(e.id_usergroup) === parseInt(data))[0].groupname;
								return rol;
							};
						}

						columns.push(miniCol);

						if (["user_id", "last_login", "date_updated", "secret", "date_created", "password"].includes(key)) {
							inputDiv += '<input style="display:none" hidden id="edi-' + key + '" name="' + key + '">';
						} else if (["usergroup", "can_delete"].includes(key)) {
							inputDiv += "<div class='col-lg-4' id='div-" + key + "'>";
							inputDiv += '<label for=edi-' + key + '>' + ((key).replace(/_/g, ' ')) + '</label>';
							inputDiv += '</div>';
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
			thead += '</tr>';
			jQuery('#users thead').append(thead);

			var table = jQuery('#users').DataTable({
				select: true,
				paging: true,
				lengthMenu: [
					[5, 8, 10, 25, 50, -1],
					[5, 8, 10, 25, 50, "All"]
				],
				pageLength: 8,
				fixedColumns: true,
				data: users,
				searchHighlight: true,
				columns: columns,
				dom: 'Bfrtip',
				heigth: '750px',
				buttons: [
					'select',
					{
						extend: 'pageLength',
					},
					{
						extend: 'copy',
						text: 'Copiar'
					},
					{
						extend: 'csv',
						text: 'Exportar a CSV'
					},
					{
						extend: 'excelHtml5',
						text: 'Exportar a Excel'
					},
					{
						extend: 'print',
						text: 'Imprimir'
					}
				],
				language: languageTable
			}).on('dblclick', 'tbody td', function() {
				row = table.row(this).data();


				for (const key in row) {
					if (Object.hasOwnProperty.call(row, key)) {
						const valor = row[key];
						jQuery('#edi-' + key).val(valor);
					}
				}
				jQuery('.openModal').click();
			}).on('mousedown', 'tbody td', function() {
				row = table.row(this).data();
			}).on('buttons-action', function(e, buttonApi, dataTable, node, config) {

				console.log({
					"e": e,
					buttonApi: buttonApi,
					dataTable: dataTable,
					node: node,
					config: config
				});
				console.log('Button ' + buttonApi.text() + ' was activated');
			});

			let selusergroup = '<select name="usergroup" id="edi-usergroup" class="custom-select form-select">';
			for (let index = 0; index < roles.length; index++) {
				const element = roles[index];
				selusergroup += '<option value="' + element.id_usergroup + '">' + element.groupname + '</option>';
			}
			selusergroup += '</select>';
			jQuery('#div-usergroup').append(selusergroup);

			let selcan_delete = '<select name="can_delete" id="edi-can_delete" class="custom-select form-select">';
			selcan_delete += '<option value="0">No se puede eliminar</option>';
			selcan_delete += '<option value="1">Se puede eleiminar</option>';
			selcan_delete += '</select>';
			jQuery('#div-can_delete').append(selcan_delete);

			jQuery(function($) {
				$.contextMenu({
					selector: 'tbody td',
					callback: function(key, options) {
						if (key == 'edit') {
							for (const key in row) {
								if (Object.hasOwnProperty.call(row, key)) {
									const valor = row[key];
									jQuery('#edi-' + key).val(valor);
								}
							}
							$('.modal input[name="eliminar"]').remove();
							$('.modal input[name="insertar"]').remove();
							$('.modal input[name="editar"]').remove();

							jQuery('.guardar-registro').unbind('click').off('click').on('click', function() {
								jQuery('#editarPala').append(
									'<input hidden name="editar" value="1">');
								jQuery('#editarPala').submit();
							});

							jQuery('.openModal').click();
						} else if (key == 'delete') {

							if (confirm('desea eliminar el registro ' + row.user_id) == true) {
								jQuery('#edi-id').val(row.user_id);
								jQuery('#editarPala').append('<input hidden name="eliminar" value="1">');
								jQuery('#editarPala').submit();
							}
						} else if (key == 'block') {
							if (confirm('Desea Bloquear el usuario ' + row.username) == true) {
								jQuery('#edi-id').val(row.user_id);
								jQuery('#editarPala').append('<input hidden name="bloquear" value="1">');
								jQuery('#editarPala').submit();
							}

						}
					},
					items: {
						"add": {
							icon: 'fa-plus',
							name: "Añadir"
						},
						"edit": {
							icon: 'fa-edit',
							name: "Editar"
						},
						"block": {
							icon: 'fa-lock',
							name: "Bloquear usuario"
						},
						"delete": {
							icon: 'fa-trash',
							name: "Eliminar"
						},
					}
				});
			});

			jQuery('.guardar-registro').on('click', function() {
				jQuery('#editarPala').append('<input hidden name="editar" value="1">');
				jQuery('#editarPala').submit();
			});

			jQuery('#editarPala').on('submit', function(e) {

			});
		</script>
	</div>
</div>
<style>
	select[name="users_length"] {
		min-width: 80px !important;
	}

	.display td {
		text-align: left;
		white-space: nowrap
	}
</style>
<?php
}
?>