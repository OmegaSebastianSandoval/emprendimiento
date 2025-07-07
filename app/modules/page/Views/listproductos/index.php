<div class="container  container-list-products py-4">

	<h1 class="titulo-principal m-0">
		<?php echo $this->titlesection; ?>
	</h1>

	<?php if ($this->hasProducts): ?>
		<form action="<?php echo $this->route ?>" method="post">
			<div class="content-dashboard my-2">
				<div class="row">
					<div class="col-12 col-lg-6">
						<label>Nombre</label>
						<label class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text input-icono fondo-rojo-claro "><i class="fas fa-pencil-alt"></i></span>
							</div>
							<input type="text" class="form-control" name="productos_nombre"
								value="<?php echo $this->getObjectVariable($this->filters, 'productos_nombre') ?>"></input>
						</label>
					</div>


					<div class="col-6 col-lg-3">
						<label>&nbsp;</label>
						<button type="submit" class="btn btn-block btn-morado"> <i class="fas fa-filter"></i> Filtrar</button>
					</div>
					<div class="col-6 col-lg-3">
						<label>&nbsp;</label>
						<a class="btn btn-block btn-morado-claro " href="<?php echo $this->route; ?>?cleanfilter=1"> <i
								class="fas fa-eraser"></i> Limpiar Filtro</a>
					</div>
				</div>
			</div>
		</form>
	<?php endif; ?>

	<?php if ($this->hasProducts): ?>
		<div align="center">
			<ul class="pagination justify-content-center">
				<?php
				$url = $this->route;
				$min = $this->page - 10;
				$max = $this->page + 10;
				if ($this->totalpages > 1) {
					if ($this->page != 1)
						echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page - 1) . '"> &laquo; Anterior </a></li>';
					for ($i = 1; $i <= $this->totalpages; $i++) {
						if ($i >= $min and $i <= $max) {
							if ($this->page == $i) {
								echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
							} else {
								echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . '">' . $i . '</a></li>  ';
							}
						}
					}
					if ($this->page != $this->totalpages)
						echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page + 1) . '">Siguiente &raquo;</a></li>';
				}
				?>
			</ul>
		</div>
	<?php endif; ?>

	<div class="content-dashboard">
		<?php if ($this->hasProducts): ?>
			<div class="franja-paginas mb-3 mb-lg-0">
				<div class="row gap-3">
					<div class="col-12 col-lg-3">
						<div class="titulo-registro">Se encontraron <?php echo $this->register_number; ?> Registros</div>
					</div>
					<div class="col-5 col-lg-3 text-right text-start text-lg-end">
						<div class="texto-paginas">Registros por pagina:</div>
					</div>
					<div class="col-2 col-lg-1">
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
					<div class="col-12 col-lg-5">
						<div class="justify-content-lg-end d-flex align-items-center gap-2">
							<a class="btn btn-orange btn-sm " href="/page/subcategorias/">
								<i class="fa-solid fa-list"></i> Configurar subcategorias</a>
							<a class="btn btn-sm btn-orange"
								href="<?php echo $this->route . "\manage" . "?categoria=" . $this->categoria . "" . "&subcategoria=" . $this->subcategoria . "" . "&tienda=" . $this->tienda . ""; ?>">
								<i class="fas fa-plus-square"></i> Crear Nuevo</a>
						</div>
					</div>
				</div>
			</div>

			<div class="content-table">
				<table class=" table table-striped  table-hover table-administrator text-left">
					<thead>
						<tr>
							<th scope="col">Nombre</th>
							<!-- <th scope="col">Descripci&oacute;n</th> -->
							<th scope="col">Imagen</th>
							<th scope="col">Precio</th>
							<th scope="col" width="100"></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($this->lists as $content) { ?>
							<?php $id = $content->productos_id; ?>
							<tr>
								<td data-label="Nombre"><?= $content->productos_nombre; ?></td>
								<!-- <td><?= $content->productos_descripcion; ?></td> -->
								<td data-label="Imagen">
									<?php if ($content->productos_imagen) { ?>
										<img src="/images/<?= $content->productos_imagen; ?>" class="img-thumbnail thumbnail-administrator" />
									<?php } ?>
									<div><?= $content->productos_imagen; ?></div>
								</td>
								<td data-label="Precio"><?= $content->productos_precio; ?></td>

								<td data-label="Acciones" class="text-right text-end">
									<div>
										<a class="btn btn-azul btn-sm" href="<?php echo $this->route; ?>/manage?id=<?= $id ?>"
											data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pen-alt"></i></a>
										<span data-toggle="tooltip" data-placement="top" title="Eliminar"><a class="btn btn-rojo btn-sm"
												data-bs-toggle="modal" data-bs-target="#modal<?= $id ?>"><i class="fas fa-trash-alt"></i></a></span>
									</div>
									<!-- Modal -->
									<div class="modal fade text-left" id="modal<?= $id ?>" tabindex="-1" role="dialog"
										aria-labelledby="myModalLabel">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header bg-white">
													<h4 class="modal-title text-secondary" id="myModalLabel">Eliminar producto</h4>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													<div class="">¿Esta seguro de eliminar este producto?</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
													<a class="btn btn-danger"
														href="<?php echo $this->route; ?>/delete?id=<?= $id ?>&csrf=<?= $this->csrf; ?><?php echo '' . '&categoria=' . $this->categoria . '&subcategoria=' . $this->subcategoria . '&tienda=' . $this->tienda; ?>">Eliminar</a>
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
			<input type="hidden" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" id="order-route" value="<?php echo $this->route; ?>/order">
			<input type="hidden" id="page-route" value="<?php echo $this->route; ?>/changepage">
		<?php else: ?>
			<!-- Mensaje cuando no hay productos -->
			<div class="text-center py-5">
				<div class="mb-4">
					<i class="fas fa-box-open fa-5x text-muted"></i>
				</div>
				<h3 class="text-muted mb-3">No tienes productos registrados</h3>
				<p class="text-muted mb-4">Comienza agregando tu primer producto para gestionar tu inventario.</p>
				<div class="d-flex justify-content-center gap-3">

					<a class="btn btn-orange btn-sm"
						href="<?php echo $this->route . "\manage" . "?categoria=" . $this->tiendaInfo->tiendas_categoria . "" . "&subcategoria=" . $this->subcategoria . "" . "&tienda=" . $this->tienda . ""; ?>">
						<i class="fas fa-plus-square"></i> Crear Primer Producto</a>
					<a class="btn btn-orange btn-sm" href="/page/subcategorias/manage">
						<i class="fa-solid fa-list"></i> Configurar subcategorias</a>
				</div>
			</div>
		<?php endif; ?>
	</div>

	<?php if ($this->hasProducts): ?>
		<div align="center">
			<ul class="pagination justify-content-center">
				<?php
				$url = $this->route;
				$min = $this->page - 10;
				$max = $this->page + 10;
				if ($this->totalpages > 1) {
					if ($this->page != 1)
						echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page - 1) . '"> &laquo; Anterior </a></li>';
					for ($i = 1; $i <= $this->totalpages; $i++) {
						if ($i >= $min and $i <= $max) {
							if ($this->page == $i) {
								echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
							} else {
								echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . '">' . $i . '</a></li>  ';
							}
						}
					}
					if ($this->page != $this->totalpages)
						echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page + 1) . '">Siguiente &raquo;</a></li>';
				}
				?>
			</ul>
		</div>
	<?php endif; ?>
</div>
<style>
	.main-general {
		min-height: calc(100dvh - 303px);

	}
</style>