<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>" data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->cuadros_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->cuadros_id; ?>" />
			<?php }?>
			<div class="row">
				<div class="col-12 form-group">
					<label for="cuadros_titulo"  class="control-label">titulo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-morado " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->cuadros_titulo; ?>" name="cuadros_titulo" id="cuadros_titulo" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="cuadros_descripcion" class="form-label" >descripcion</label>
					<textarea name="cuadros_descripcion" id="cuadros_descripcion"   class="form-control tinyeditor" rows="10"   ><?= $this->content->cuadros_descripcion; ?></textarea>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="cuadros_imagen" >imagen</label>
					<input type="file" name="cuadros_imagen" id="cuadros_imagen" class="form-control  file-image" data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png"  <?php if(!$this->content->cuadros_id){ echo 'required'; } ?>>
					<div class="help-block with-errors"></div>
					<?php if($this->content->cuadros_imagen) { ?>
						<div id="imagen_cuadros_imagen">
							<img src="/images/<?= $this->content->cuadros_imagen; ?>"  class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button" onclick="eliminarImagen('cuadros_imagen','<?php echo $this->route."/deleteimage"; ?>')"><i class="glyphicon glyphicon-remove" ></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div>
				<div class="col-12 form-group">
					<label for="cuadros_precio"  class="control-label">precio</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rojo-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->cuadros_precio; ?>" name="cuadros_precio" id="cuadros_precio" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<!-- <div class="col-12 form-group">
					<label for="cuadros_contacto"  class="control-label">contacto</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-cafe " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->cuadros_contacto; ?>" name="cuadros_contacto" id="cuadros_contacto" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div> -->
				<div class="col-12 form-group">
					<label for="cuadros_artista"  class="control-label">artista</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->cuadros_artista; ?>" name="cuadros_artista" id="cuadros_artista" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
		<div class="col-12 form-group">
			<label   class="control-label">activo</label>
				<input type="checkbox" name="cuadros_activo" value="1" class="form-control switch-form " <?php if ($this->getObjectVariable($this->content, 'cuadros_activo') == 1) { echo "checked";} ?>   ></input>
				<div class="help-block with-errors"></div>
		</div>
				<input type="hidden" name="cuadros_negocio"  value="<?php if($this->content->cuadros_negocio){ echo $this->content->cuadros_negocio; } else { echo $this->tienda; } ?>">
			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>?tienda=<?php if($this->content->cuadros_negocio){ echo $this->content->cuadros_negocio; } else { echo $this->tienda; } ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>