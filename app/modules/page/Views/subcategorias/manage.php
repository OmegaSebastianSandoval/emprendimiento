<div class="container  container-list-products py-3">

	<h1 class="titulo-principal m-0">
		<?php echo $this->titlesection; ?>
	</h1>
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform; ?>"
		data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->categorias_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->categorias_id; ?>" />
			<?php } ?>
			<div class="row">

				<div class="col-12 col-md-3 form-group">
					<label class="control-label" for="categorias_estado">Activar Categoría</label><br>
					<input type="checkbox" name="categorias_estado" id="categorias_estado" value="1" data-toggle="toggle"
						class="form-control" data-onstyle="success" <?php if ($this->getObjectVariable($this->content, 'categorias_estado') == 1) {
							echo "checked";
						} ?> data-on="Activado" data-off="Desactivado"
						data-offstyle="danger"></input>
					<div class="help-block with-errors"></div>
				</div>
				<!-- <div class="col-4 form-group">
					<label for="categorias_color" class="control-label"> Color</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->categorias_color; ?>" name="categorias_color"
							id="categorias_color" class="form-control colorpicker">
					</label>
					<div class="help-block with-errors"></div>
				</div> -->

				<div class="col-12 col-md-9 form-group">
					<label for="categorias_nombre" class="control-label">Nombre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-morado "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->categorias_nombre; ?>" name="categorias_nombre"
							id="categorias_nombre" class="form-control" required>
					</label>
					<div class="help-block with-errors"></div>
				</div>


				<!-- <div class="col-6 form-group">
					<label for="categorias_banner">Imagen banner</label>
					<input type="file" name="categorias_banner" id="categorias_banner" class="form-control  file-image"
						data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png">
					<div class="help-block with-errors"></div>
					<?php if ($this->content->categorias_banner) { ?>
						<div id="imagen_categorias_banner">
							<img src="/images/<?= $this->content->categorias_banner; ?>"
								class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button"
									onclick="eliminarImagen('categorias_banner','<?php echo $this->route . "/deleteimage"; ?>')"><i
										class="glyphicon glyphicon-remove"></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div> -->
				<!-- <div class="col-6 form-group">
					<label for="categorias_imagen_tienda">Imagen tienda</label>
					<input type="file" name="categorias_imagen_tienda" id="categorias_imagen_tienda"
						class="form-control  file-image" data-buttonName="btn-primary"
						accept="image/gif, image/jpg, image/jpeg, image/png">
					<div class="help-block with-errors"></div>
					<?php if ($this->content->categorias_imagen_tienda) { ?>
						<div id="imagen_categorias_imagen_tienda">
							<img src="/images/<?= $this->content->categorias_imagen_tienda; ?>"
								class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button"
									onclick="eliminarImagen('categorias_imagen_tienda','<?php echo $this->route . "/deleteimage"; ?>')"><i
										class="glyphicon glyphicon-remove"></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div> -->

				<div class="col-12 form-group">
					<label for="categorias_descripcion" class="form-label">Descripcion</label>
					<textarea name="categorias_descripcion" id="categorias_descripcion" class="form-control tinyeditor-simple"
						rows="10"><?= $this->content->categorias_descripcion; ?></textarea>
					<div class="help-block with-errors"></div>
				</div>
				<!-- <div class="col-6 form-group">
					<label for="categorias_imagen_techo" >Imagen techo</label>
					<input type="file" name="categorias_imagen_techo" id="categorias_imagen_techo" class="form-control  file-image" data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png"  >
					<div class="help-block with-errors"></div>
					<?php if ($this->content->categorias_imagen_techo) { ?>
						<div id="imagen_categorias_imagen_techo">
							<img src="/images/<?= $this->content->categorias_imagen_techo; ?>"  class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button" onclick="eliminarImagen('categorias_imagen_techo','<?php echo $this->route . "/deleteimage"; ?>')"><i class="glyphicon glyphicon-remove" ></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div> -->


				<!-- <div class="col-4 form-group">
					<label class="control-label" for="categorias_estado_imagen">Activar Imagen</label><br>
					<input type="checkbox" name="categorias_estado_imagen" id="categorias_estado_imagen" value="1"
						data-toggle="toggle" class="form-control" data-onstyle="success" <?php if ($this->getObjectVariable($this->content, 'categorias_estado_imagen') == 1) {
							echo "checked";
						} ?>
						data-on="Activado" data-off="Desactivado" data-offstyle="danger"></input>
					<div class="help-block with-errors"></div>
				</div> -->


				<input type="hidden" name="padre" value="<?php echo $_GET['padre']; ?>">
			</div>
		</div>
		<div class="botones-acciones d-flex justify-content-end gap-2">

			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>