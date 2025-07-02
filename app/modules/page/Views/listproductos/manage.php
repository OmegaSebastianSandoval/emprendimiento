<div class="container  container-list-products py-3">

	<h1 class="titulo-principal m-0">
		<?php echo $this->titlesection; ?>
	</h1>

	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform; ?>"
		data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->productos_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->productos_id; ?>" />
			<?php } ?>
			<div class="row">
				<div class="col-12 col-md-6 form-group">
					<label for="productos_nombre" class="control-label">Nombre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-cafe "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->productos_nombre; ?>" name="productos_nombre"
							id="productos_nombre" class="form-control" required>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-md-6 form-group">
					<label for="productos_precio" class="control-label">Precio</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->productos_precio; ?>" name="productos_precio"
							id="productos_precio" class="form-control" required>
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-12 form-group">
					<label for="productos_imagen">Imagen principal</label>
					<input type="file" name="productos_imagen" id="productos_imagen" class="form-control  file-image"
						data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png">
					<div class="help-block with-errors"></div>
					<?php if ($this->content->productos_imagen) { ?>
						<div id="imagen_productos_imagen">
							<img src="/images/<?= $this->content->productos_imagen; ?>" class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button"
									onclick="eliminarImagen('productos_imagen','<?php echo $this->route . "/deleteimage"; ?>')"><i
										class="glyphicon glyphicon-remove"></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div>
				<!-- <div class="col-12 form-group">
			<label   class="control-label">destacado</label>
				<input type="checkbox" name="productos_destacado" value="1" class="form-control switch-form " <?php if ($this->getObjectVariable($this->content, 'productos_destacado') == 1) {
					echo "checked";
				} ?>	 ></input>
				<div class="help-block with-errors"></div>
		</div> -->

				<!-- <div class="col-12 form-group">
			<label   class="control-label">nuevo</label>
				<input type="checkbox" name="productos_nuevo" value="1" class="form-control switch-form " <?php if ($this->getObjectVariable($this->content, 'productos_nuevo') == 1) {
					echo "checked";
				} ?>	 ></input>
				<div class="help-block with-errors"></div>
		</div>  -->
				<div class="col-6 form-group d-none">
					<label for="productos_cantidad" class="control-label">Cantidad</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-morado "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->productos_cantidad; ?>" name="productos_cantidad"
							id="productos_cantidad" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<input type="hidden" name="productos_categorias" value="<?php if ($this->content->productos_categorias) {
					echo $this->content->productos_categorias;
				} else {
					echo $this->categoria;
				} ?>">
				<input type="hidden" name="productos_subcategoria" value="<?php if ($this->content->productos_subcategoria) {
					echo $this->content->productos_subcategoria;
				} else {
					echo $this->subcategoria;
				} ?>">
				<!-- <div class="col-12 form-group">
			<label   class="control-label">activo</label>
				<input type="checkbox" name="producto_activo" value="1" class="form-control switch-form " <?php if ($this->getObjectVariable($this->content, 'producto_activo') == 1) {
					echo "checked";
				} ?>	 ></input>
				<div class="help-block with-errors"></div>
		</div> -->
				<input type="hidden" name="productos_codigo" value="<?php echo $this->content->productos_codigo ?>">
				<div class="col-6 form-group d-none">
					<label for="productos_cantidad_minima" class="control-label">Cantidad mínima</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->productos_cantidad_minima; ?>"
							name="productos_cantidad_minima" id="productos_cantidad_minima" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-6 form-group d-none">
					<label for="productos_limite_pedido" class="control-label">Límite del pedido</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->productos_limite_pedido; ?>" name="productos_limite_pedido"
							id="productos_limite_pedido" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="productos_descripcion" class="form-label">Descripci&oacute;n</label>
					<textarea name="productos_descripcion" id="productos_descripcion" class="form-control tinyeditor-simple"
						rows="10"><?= $this->content->productos_descripcion; ?></textarea>
					<div class="help-block with-errors"></div>
				</div>
				<input type="hidden" name="productos_tienda" value="<?php if ($this->content->productos_tienda) {
					echo $this->content->productos_tienda;
				} else {
					echo $this->tienda;
				} ?>">
			</div>
		</div>
		<div class="botones-acciones d-flex justify-content-end gap-2">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>?categoria=<?php if ($this->content->productos_categorias) {
					 echo $this->content->productos_categorias;
				 } else {
					 echo $this->categoria;
				 } ?>&subcategoria=<?php if ($this->content->productos_subcategoria) {
						echo $this->content->productos_subcategoria;
					} else {
						echo $this->subcategoria;
					} ?>&tienda=<?php if ($this->content->productos_tienda) {
						 echo $this->content->productos_tienda;
					 } else {
						 echo $this->tienda;
					 } ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>