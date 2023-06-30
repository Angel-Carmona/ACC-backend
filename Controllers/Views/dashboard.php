<section class="panel important ">
	<div style="display:grid;" class="colums-fr">
		<div class="cardMenu <?php echo $onlyAdmin?>"
			onclick="window.location.href='theme-config'">
			<div>
				<img src="<?php echo TEMPLATE_DIRECTORY?>Dashboard/assets/img/config.png"
					style="height:100%;max-width:100%;max-height:300px;position:absolute" alt="">
				<div class="cardMenuTitle">
					<h3>Configuración</h3>
				</div>
			</div>
		</div>
		<div class="cardMenu <?php echo $onlyAdmin?>"
			onclick="window.location.href='usuarios'">
			<div>
				<img src="<?php echo TEMPLATE_DIRECTORY?>Dashboard/assets/img/users.png"
					style="height:100%;max-width:100%;max-height:300px;position:absolute" alt="">
				<div class="cardMenuTitle">
					<h3>Usuarios</h3>
				</div>
			</div>
		</div>
		<div class="cardMenu" onclick="window.location.href='buscar'">
			<div>
				<img src="<?php echo TEMPLATE_DIRECTORY?>Dashboard/assets/img/lupa.png"
					style="height:100%;max-width:100%;max-height:300px;position:absolute" alt="">
				<div class="cardMenuTitle">
					<h3>Buscar</h3>
				</div>
			</div>
		</div>
		<div class="cardMenu" onclick="window.location.href='catastros'">
			<div>
				<img src="<?php echo TEMPLATE_DIRECTORY?>Dashboard/assets/img/excell.png"
					style="height:100%;max-width:100%;max-height:300px;position:absolute" alt="">
				<div class="cardMenuTitle">
					<h3>Catastros</h3>
				</div>
			</div>
		</div>
		<div class="cardMenu" onclick="window.location.href='coa'">
			<div>
				<img src="<?php echo TEMPLATE_DIRECTORY?>Dashboard/assets/img/excell.png"
					style="height:100%;max-width:100%;max-height:300px;position:absolute" alt="">
				<div class="cardMenuTitle">
					<h3>Coa</h3>
				</div>
			</div>
		</div>
		<div class="cardMenu" onclick="window.location.href='bancos'">
			<div>
				<img src="<?php echo TEMPLATE_DIRECTORY?>Dashboard/assets/img/excell.png"
					style="height:100%;max-width:100%;max-height:300px;position:absolute" alt="">
				<div class="cardMenuTitle">
					<h3>Bancos</h3>
				</div>
			</div>
		</div>
	</div>
</section>