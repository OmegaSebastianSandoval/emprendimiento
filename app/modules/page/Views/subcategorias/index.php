<div class="container  container-list-products py-3">

	<h1 class="titulo-principal m-0">
		<?php echo $this->titlesection; ?>
	</h1>

	<?php if ($this->register_number > 0): ?>
		<form action="<?php echo $this->route; ?>" method="post">
			<div class="content-dashboard">
				<div class="row">
					<div class="col-3">
						<label>Nombre</label>
						<label class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text input-icono fondo-azul-claro "><i class="fas fa-pencil-alt"></i></span>
							</div>
							<input type="text" class="form-control" name="categorias_nombre"
								value="<?php echo $this->getObjectVariable($this->filters, 'categorias_nombre') ?>"></input>
						</label>
					</div>
					<div class="col-3">
						<label>Descripcion</label>
						<label class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text input-icono fondo-verde "><i class="fas fa-pencil-alt"></i></span>
							</div>
							<input type="text" class="form-control" name="categorias_descripcion"
								value="<?php echo $this->getObjectVariable($this->filters, 'categorias_descripcion') ?>"></input>
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
	<?php endif; ?>

	<?php if ($this->register_number > 0): ?>
		<div align="center">
			<ul class="pagination justify-content-center">
				<?php
				$url = $this->route;
				if ($this->totalpages > 1) {
					if ($this->page != 1)
						echo '<li class="page-item" ><a class="page-link"  href="' . $url . '?page=' . ($this->page - 1) . '"> &laquo; Anterior </a></li>';
					for ($i = 1; $i <= $this->totalpages; $i++) {
						if ($this->page == $i)
							echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
						else
							echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . '">' . $i . '</a></li>  ';
					}
					if ($this->page != $this->totalpages)
						echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page + 1) . '">Siguiente &raquo;</a></li>';
				}
				?>
			</ul>
		</div>
	<?php endif; ?>

	<div class="content-dashboard">
		<?php if ($this->register_number > 0): ?>
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
						<?php $padre = $_GET['padre'] * 1; ?>
						<?php if ($_SESSION['kt_login_level'] == "1" or $_SESSION['kt_login_level'] == "3") { ?>
							<div class="text-right text-end"><a class="btn btn-sm btn-success"
									href="<?php echo $this->route . "\manage?padre=" . $padre; ?>"> <i class="fas fa-plus-square"></i> Crear
									Nuevo</a></div>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="content-table">
				<table class=" table table-striped  table-hover table-administrator text-left">
					<thead>
						<tr>
							<td>Nombre</td>
							<td>Descripcion</td>
							<td width="100">Orden</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($this->lists as $content) { ?>
							<?php $id = $content->categorias_id; ?>
							<tr>
								<td><?= $content->categorias_nombre; ?></td>
								<td><?= $content->categorias_descripcion; ?></td>
								<td>
									<input type="hidden" id="<?= $id; ?>" value="<?= $content->orden; ?>"></input>
									<button class="up_table btn btn-primary btn-sm"><i class="fas fa-angle-up"></i></button>
									<button class="down_table btn btn-primary btn-sm"><i class="fas fa-angle-down"></i></button>
								</td>
								<td class="text-right text-end">
									<div>
										<!-- <?php if ($content->categorias_padre == 0) { ?>
										<a class="btn btn-verde btn-sm" href="<?php echo $this->route; ?>?padre=<?= $id ?>"
											data-toggle="tooltip" data-placement="top" title="Subcategorias"><i class="fa-solid fa-list"></i></a>
									<?php } ?>
 -->
										<a class="btn btn-warning btn-sm" href="/administracion/tiendas/?categoria=<?= $id ?>"
											data-toggle="tooltip" data-placement="top" title="Tiendas"><i class="fas fa-shopping-cart"></i></a>
										<?php if ($_SESSION['kt_login_level'] == "1" or $_SESSION['kt_login_level'] == "3") { ?>
											<a class="btn btn-azul btn-sm" href="<?php echo $this->route; ?>/manage?id=<?= $id ?>"
												data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pen"></i></a>

											<span data-toggle="tooltip" data-placement="top" title="Eliminar"><a class="btn btn-rojo btn-sm"
													data-bs-toggle="modal" data-bs-target="#modal<?= $id ?>"><i class="fas fa-trash-alt"></i></a></span>
										<?php } ?>
										<?php if ($_SESSION['kt_login_level'] == "4") { ?>
											<a class="btn btn-azul btn-sm" href="<?php echo $this->route; ?>/manage?id=<?= $id ?>"
												data-toggle="tooltip" data-placement="top" title="Ver"><i class="fas fa-eye"></i></a>
										<?php } ?>

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
													<div class="">¿Esta seguro de eliminar este registro?</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
													<a class="btn btn-danger"
														href="<?php echo $this->route; ?>/delete?id=<?= $id ?>&csrf=<?= $this->csrf; ?><?php echo ''; ?>">Eliminar</a>
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
			<input type="hidden" id="csrf" value="<?php echo $this->csrf ?>"><input type="hidden" id="order-route"
				value="<?php echo $this->route; ?>/order"><input type="hidden" id="page-route"
				value="<?php echo $this->route; ?>/changepage">
		<?php else: ?>
			<!-- Mensaje cuando no hay subcategorías -->
			<div class="text-center py-5">
				<div class="mb-4">
					<i class="fas fa-tags fa-5x text-muted"></i>
				</div>
				<h3 class="text-muted mb-3">No tienes subcategorías registradas</h3>
				<p class="text-muted mb-4">Comienza agregando tu primera subcategoría para organizar mejor tus productos.</p>
				<div class="d-flex justify-content-center gap-3">
					<?php if ($_SESSION['kt_login_level'] == "4" or $_SESSION['kt_login_level'] == "5") { ?>
						<a class="btn btn-orange btn-sm" href="<?php echo $this->route; ?>/manage">
							<i class="fas fa-plus-square"></i> Crear Primera Subcategoría</a>
					<?php } ?>
				</div>
			</div>
		<?php endif; ?>
	</div>

	<?php if ($this->register_number > 0): ?>
		<div align="center">
			<ul class="pagination justify-content-center">
				<?php
				$url = $this->route;
				if ($this->totalpages > 1) {
					if ($this->page != 1)
						echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page - 1) . '"> &laquo; Anterior </a></li>';
					for ($i = 1; $i <= $this->totalpages; $i++) {
						if ($this->page == $i)
							echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
						else
							echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . '">' . $i . '</a></li>  ';
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