<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>" data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->galeria_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->galeria_id; ?>" />
			<?php }?>
			<div class="row">
				<div class="col-12 form-group">
					<label for="galeria_titulo"  class="control-label">titulo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->galeria_titulo; ?>" name="galeria_titulo" id="galeria_titulo" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="galeria_imagen" >imagen</label>
					<input type="file" name="galeria_imagen" id="galeria_imagen" class="form-control  file-image" data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png"  <?php if(!$this->content->galeria_id){ echo 'required'; } ?>>
					<div class="help-block with-errors"></div>
					<?php if($this->content->galeria_imagen) { ?>
						<div id="imagen_galeria_imagen">
							<img src="/images/<?= $this->content->galeria_imagen; ?>"  class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button" onclick="eliminarImagen('galeria_imagen','<?php echo $this->route."/deleteimage"; ?>')"><i class="glyphicon glyphicon-remove" ></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div>
				<div class="col-12 form-group">
					<label for="galeria_descripcion" class="form-label" >descripci&oacute;n</label>
					<textarea name="galeria_descripcion" id="galeria_descripcion"   class="form-control tinyeditor" rows="10"  required ><?= $this->content->galeria_descripcion; ?></textarea>
					<div class="help-block with-errors"></div>
				</div>
			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>