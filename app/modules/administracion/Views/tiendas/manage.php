<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform; ?>"
		data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->tiendas_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->tiendas_id; ?>" />
			<?php } ?>
			<div class="row">
				<div class="col-2 form-group">
					<label class="control-label" for="contenido_estado">Activar tienda</label><br>
					<input type="checkbox" name="tiendas_estado" id="tiendas_estado" value="1" data-toggle="toggle"
						class="form-control" data-onstyle="success" <?php if ($this->getObjectVariable($this->content, 'tiendas_estado') == 1) {
							echo "checked";
						} ?> data-on="Activado" data-off="Desactivado"
						data-offstyle="danger"></input>
					<div class="help-block with-errors"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-md-8 form-group">
					<label for="tiendas_nombre" class="control-label">nombre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->tiendas_nombre; ?>" name="tiendas_nombre" id="tiendas_nombre"
							class="form-control" required>
					</label>
					<div class="help-block with-errors"></div>

				</div>
				<div class="col-12 col-md-4 form-group">
					<label for="tiendas_imagen">Logo</label>
					<input type="file" name="tiendas_imagen" id="tiendas_imagen" class="form-control  file-image"
						data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png">
					<div class="help-block with-errors"></div>
					<?php if ($this->content->tiendas_imagen) { ?>
						<div id="imagen_tiendas_imagen">
							<img src="/images/<?= $this->content->tiendas_imagen; ?>" class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button"
									onclick="eliminarImagen('tiendas_imagen','<?php echo $this->route . "/deleteimage"; ?>')"><i
										class="glyphicon glyphicon-remove"></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div>


				<?php if ($this->estado_form == 0) { ?>
					<div class="col-4 col-md-4 form-group">
						<label class="control-label">Categoría de la tienda</label>
						<label class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text input-icono  fondo-cafe "><i class="far fa-list-alt"></i></span>
							</div>
							<select class="form-control" name="tiendas_categoria" id="tiendas_categoria" required>
								<option selected disabled value="">Seleccione...</option>
								<?php foreach ($this->categorias as $key => $value) { ?>
									<option <?php if ($this->content->tiendas_categoria == $value->categorias_id) { ?> selected <?php } ?>value="<?php echo $value->categorias_id ?>"><?php echo $value->categorias_nombre ?></option>
								<?php } ?>
							</select>
						</label>
						<div class="help-block with-errors"></div>
					</div>
				<?php } ?>
				<div class="col-12 col-md-4 form-group">
					<label for="usuario_negocio" class="control-label">Cedula(usuario negocio)</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input <?php if ($this->estado_form == 0) {
							echo " disabled ";
						} ?> type="number" min="0"
							value="<?= $this->usuario->user_user; ?>" name="usuario_negocio" id="usuario_negocio" class="form-control"
							data-remote="/core/user/validarnegocio" <?php if ($this->estado_form != 0) {
								echo "required";
							} ?>>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-md-4 form-group">
					<label for="correo" class="control-label">Correo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input <?php if ($this->estado_form == 0) {
							echo " disabled ";
						} ?> type="email"
							value="<?= $this->usuario->user_email; ?>" name="correo" id="correo" class="form-control" <?php if ($this->estado_form != 0) {
									echo "required";
								} ?>>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<!-- <div class="col-12 form-group">
					<label for="accion_negocio" class="control-label">Número de documento</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input <?php if ($this->estado_form == 0) {
							echo " disabled ";
						} ?> type="number" min="0"
							value="<?= numeroaccion($this->usuario->user_accion); ?>" name="accion_negocio" id="accion_negocio"
							class="form-control" data-remote="/core/user/validaraccionnegocio" <?php if ($this->estado_form != 0) {
								echo "required";
							} ?>>
					</label>
					<div class="help-block with-errors"></div>
				</div> -->
				<input type="hidden" name="accion_negocio" id="accion_negocio" value="<?= $this->usuario->user_accion ?>">
				<div class="col-12 col-md-4 form-group">
					<label for="negocio_accion" class="control-label">Tipo de expositor</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<select name="usuario_tipo" class="form-control" id="usuario_tipo" <?php if ($this->estado_form != 0) {
							echo " required ";
						} ?><?php if ($this->estado_form == 0) {
							 echo "disabled ";
						 } ?>>
							<option selected disabled value="">Seleccione...</option>
							<option <?php if ($this->usuario->user_level == 4) { ?> selected <?php } ?>value="4">Expositor asociado
							</option>
							<option <?php if ($this->usuario->user_level == 5) { ?> selected <?php } ?> value="5">Expositor invitado
							</option>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-6  col-md-4 form-group">
					<label for="tiendas_telefono" class="control-label">Teléfono</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="number" min="0" value="<?= $this->content->tiendas_telefono; ?>" name="tiendas_telefono"
							id="tiendas_telefono" class="form-control" data-remote="/core/user/validartelnegocio" required>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-6  col-md-4 form-group">
					<label for="tiendas_telefono2" class="control-label">Teléfono 2</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="number" min="0" value="<?= $this->content->tiendas_telefono2; ?>" name="tiendas_telefono2"
							id="tiendas_telefono2" class="form-control" data-remote="/core/user/validartelnegocio">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<!-- <div class="col-12 form-group">
					<label for="tiendas_datos" class="form-label" >datos</label>
					<textarea name="tiendas_datos" id="tiendas_datos"   class="form-control tinyeditor" rows="10"   ><?= $this->content->tiendas_datos; ?></textarea>
					<div class="help-block with-errors"></div>
				</div> -->
				<div class="col-12  col-md-4 form-group">
					<label for="tiendas_whatsapp" class="control-label">whatsapp</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="number" min="0" value="<?= $this->content->tiendas_whatsapp; ?>" name="tiendas_whatsapp"
							id="tiendas_whatsapp" class="form-control" data-error="El numero de whatsapp debe ser de 10 dígitos"
							data-remote="/core/user/validarwhatsappnegocio">
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-6  col-md-4 form-group">
					<label for="tiendas_pagina" class="control-label">Pagina web</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->tiendas_pagina; ?>" name="tiendas_pagina" id="tiendas_pagina"
							class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-6  col-md-4 form-group">
					<label for="tiendas_facebook" class="control-label">Facebook</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->tiendas_facebook; ?>" name="tiendas_facebook"
							id="tiendas_facebook" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-6  col-md-4 form-group">
					<label for="tiendas_instagram" class="control-label">Instagram</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->tiendas_instagram; ?>" name="tiendas_instagram"
							id="tiendas_instagram" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-12 form-group">
					<label for="tiendas_descripcion" class="form-label">descripci&oacute;n</label>
					<textarea name="tiendas_descripcion" id="tiendas_descripcion" class="form-control tinyeditor"
						rows="10"><?= $this->content->tiendas_descripcion; ?></textarea>
					<div class="help-block with-errors"></div>
				</div>





				<?php if ($this->estado_form != 0) { ?>

					<input type="hidden" name="tiendas_categoria" value="<?php if ($this->content->tiendas_categoria) {
						echo $this->content->tiendas_categoria;
					} else {
						echo $this->categoria;
					} ?>">
				<?php } ?>
			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>?categoria=<?php if ($this->content->tiendas_categoria) {
					 echo $this->content->tiendas_categoria;
				 } else {
					 echo $this->categoria;
				 } ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>
<?php
function numeroaccion($x)
{
	$x = str_pad($x, 8, "0", STR_PAD_LEFT);
	return $x;
}
?>