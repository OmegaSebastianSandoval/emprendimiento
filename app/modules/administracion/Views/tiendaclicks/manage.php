<h1 class="titulo-principal"><i class="fas fa-cogs"></i> Detalle Reporte de tiendas</h1>

<div align="center">
	<ul class="pagination justify-content-center">
		<?php
		$url = $this->route2;
		if ($this->totalpages > 1) {
			if ($this->page != 1)
				echo '<li class="page-item" ><a class="page-link"  href="' . $url . '&page=' . ($this->page - 1) . '"> &laquo; Anterior </a></li>';
			for ($i = 1; $i <= $this->totalpages; $i++) {
				if ($this->page == $i)
					echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
				else
					echo '<li class="page-item"><a class="page-link" href="' . $url . '&page=' . $i . '">' . $i . '</a></li>  ';
			}
			if ($this->page != $this->totalpages)
				echo '<li class="page-item"><a class="page-link" href="' . $url . '&page=' . ($this->page + 1) . '">Siguiente &raquo;</a></li>';
		}
		?>
	</ul>
</div>
<div class="content-dashboard">
	<div class="franja-paginas">
		<div class="row">
			<div class="col-5">
				<div class="titulo-registro">Se encontraron <?php echo $this->register_number2; ?> Registros</div>
			</div>
			<div class="col-3 text-right text-end">
				<div class="texto-paginas">Registros por pagina:</div>
			</div>
			<div class="col-1">
				<select class="form-control form-control-sm selectpagination">
					<option value="20" <?php if ($this->pages == 20) {
																echo 'selected';
															} ?>>20</option>
					<option value="30" <?php if ($this->pages == 30) {
																echo 'selected';
															} ?>>30</option>
					<option value="50" <?php if ($this->pages == 50) {
																echo 'selected';
															} ?>>50</option>
					<option value="100" <?php if ($this->pages == 100) {
																echo 'selected';
															} ?>>100</option>
				</select>
			</div>
			<!-- <div class="col-3">
		    		<div class="text-right text-end"><a class="btn btn-sm btn-success" href="<?php echo $this->route . "\manage"; ?>"> <i class="fas fa-plus-square"></i> Crear Nuevo</a></div>
		    	</div> -->
		</div>
	</div>
	<div class="content-table">
		<table class=" table table-striped  table-hover table-administrator text-left">
			<thead>
				<tr>
					<td>Usuario</td>
					<!-- <td>fecha</td> -->
					<td>Fecha</td>
					<!-- <td width="100"></td> -->
				</tr>
			</thead>
			<tbody>
				<?php foreach ($this->lists as $content) { ?>
					<?php $id =  $content->id; ?>
					<tr>
						<td><?= $content->usuario; ?></td>
						<td><?= $content->fecha; ?> <?= $content->hora; ?></td>

						<!-- <td class="text-right text-end">
							<div>
								<a class="btn btn-azul btn-sm" href="<?php echo $this->route; ?>/manage?id=<?= $id ?>" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pen-alt"></i></a>
								<span data-toggle="tooltip" data-placement="top" title="Eliminar"><a class="btn btn-rojo btn-sm" data-bs-toggle="modal" data-bs-target="#modal<?= $id ?>"  ><i class="fas fa-trash-alt" ></i></a></span>
							</div> -->
						<!-- Modal -->
						<!-- <div class="modal fade text-left" id="modal<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  	<div class="modal-dialog" role="document">
							    	<div class="modal-content">
							      		<div class="modal-header">
							        		<h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
							        	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							      	</div>
							      	<div class="modal-body">
							        	<div class="">¿Esta seguro de eliminar este registro?</div>
							      	</div>
								      <div class="modal-footer">
								        	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
								        	<a class="btn btn-danger" href="<?php echo $this->route; ?>/delete?id=<?= $id ?>&csrf=<?= $this->csrf; ?><?php echo ''; ?>" >Eliminar</a>
								      </div>
							    	</div>
							  	</div>
							</div>
						</td> -->
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<input type="hidden" id="csrf" value="<?php echo $this->csrf ?>"><input type="hidden" id="page-route" value="<?php echo $this->route; ?>/changepage">
</div>