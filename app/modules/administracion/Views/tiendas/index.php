<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form action="<?php echo $this->route . "?categoria=" . $this->categoria . ""; ?>" method="post">
		<div class="content-dashboard">
			<div class="row">
				<div class="col-3">
					<label>nombre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono fondo-azul "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" class="form-control" name="tiendas_nombre"
							value="<?php echo $this->getObjectVariable($this->filters, 'tiendas_nombre') ?>"></input>
					</label>
				</div>
				<div class="col-3">
					<label>whatsapp</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono fondo-verde-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" class="form-control" name="tiendas_whatsapp"
							value="<?php echo $this->getObjectVariable($this->filters, 'tiendas_whatsapp') ?>"></input>
					</label>
				</div>
				<div class="col-3">
					<label>imagen</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono fondo-verde "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" class="form-control" name="tiendas_imagen"
							value="<?php echo $this->getObjectVariable($this->filters, 'tiendas_imagen') ?>"></input>
					</label>
				</div>
				<div class="col-3">
					<label>&nbsp;</label>
					<button type="submit" class="btn btn-block btn-azul"> <i class="fas fa-filter"></i> Filtrar</button>
				</div>
				<div class="col-3">
					<label>&nbsp;</label>
					<a class="btn btn-block btn-azul-claro " href="<?php echo $this->route; ?>?cleanfilter=1"> <i
							class="fas fa-eraser"></i> Limpiar Filtro</a>
				</div>
			</div>
		</div>
	</form>
	<div align="center">
		<ul class="pagination justify-content-center">
			<?php
			$url = $this->route;
			if ($this->totalpages > 1) {
				if ($this->page != 1)
					echo '<li class="page-item" ><a class="page-link"  href="' . $url . '?page=' . ($this->page - 1) . '&categoria=' . $this->categoria . '"> &laquo; Anterior </a></li>';
				for ($i = 1; $i <= $this->totalpages; $i++) {
					if ($this->page == $i)
						echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
					else
						echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . '&categoria=' . $this->categoria . '">' . $i . '</a></li>  ';
				}
				if ($this->page != $this->totalpages)
					echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page + 1) . '&categoria=' . $this->categoria . '">Siguiente &raquo;</a></li>';
			}
			?>
		</ul>
	</div>
	<div class="content-dashboard">
		<div class="franja-paginas">
			<div class="row">
				<div class="col-5">
					<div class="titulo-registro">Se encontraron <?php echo $this->register_number; ?> Registros</div>
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
				<div class="col-3">
					<div class="text-right text-end"><a class="btn btn-sm btn-success"
							href="<?php echo $this->route . "\manage" . "?categoria=" . $this->categoria . ""; ?>"> <i
								class="fas fa-plus-square"></i> Crear Nuevo</a></div>
				</div>
			</div>
		</div>
		<div class="content-table">
			<table class=" table table-striped  table-hover table-administrator text-left">
				<thead>
					<tr>
						<td>nombre</td>
						<td>whatsapp</td>
						<td>imagen</td>
						<td width="150"></td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($this->lists as $content) { ?>
						<?php $id = $content->tiendas_id; ?>
						<tr>
							<td><?= $content->tiendas_nombre; ?></td>
							<td><?= $content->tiendas_whatsapp; ?></td>
							<td>
								<?php if ($content->tiendas_imagen) { ?>
									<img src="/images/<?= $content->tiendas_imagen; ?>" class="img-thumbnail thumbnail-administrator" />
								<?php } ?>
								<div><?= $content->tiendas_imagen; ?></div>
							</td>
							<td class="text-right text-end">
								<div>
									<a class="btn btn-azul btn-sm" href="<?php echo $this->route; ?>/manage?id=<?= $id ?>"
										data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pen-alt"></i></a>
									<a class="btn btn-warning btn-sm" href="/administracion/<?php if ($_GET['categoria'] == 12) {
										echo 'cuadros';
									} else {
										echo 'productos';
									} ?>/?tienda=<?= $id ?>" data-toggle="tooltip" data-placement="top" title="Productos"><i
											class="fas fa-shopping-cart"></i></a>
									<span data-toggle="tooltip" data-placement="top" title="Eliminar"><a class="btn btn-rojo btn-sm"
											data-bs-toggle="modal" data-bs-target="#modal<?= $id ?>"><i class="fas fa-trash-alt"></i></a></span>
								</div>
								<!-- Modal -->
								<div class="modal fade text-left" id="modal<?= $id ?>" tabindex="-1" role="dialog"
									aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<div class="">¿Está seguro de eliminar este registro?</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
												<a class="btn btn-danger"
													href="<?php echo $this->route; ?>/delete?id=<?= $id ?>&csrf=<?= $this->csrf; ?><?php echo '' . '&categoria=' . $this->categoria; ?>">Eliminar</a>
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<input type="hidden" id="csrf" value="<?php echo $this->csrf ?>"><input type="hidden" id="page-route"
			value="<?php echo $this->route; ?>/changepage">
	</div>
	<div align="center">
		<ul class="pagination justify-content-center">
			<?php
			$url = $this->route;
			if ($this->totalpages > 1) {
				if ($this->page != 1)
					echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page - 1) . '&categoria=' . $this->categoria . '"> &laquo; Anterior </a></li>';
				for ($i = 1; $i <= $this->totalpages; $i++) {
					if ($this->page == $i)
						echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
					else
						echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . '&categoria=' . $this->categoria . '">' . $i . '</a></li>  ';
				}
				if ($this->page != $this->totalpages)
					echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page + 1) . '&categoria=' . $this->categoria . '">Siguiente &raquo;</a></li>';
			}
			?>
		</ul>
	</div>
</div>