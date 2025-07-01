<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>" data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->favoritos_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->favoritos_id; ?>" />
			<?php }?>
			<div class="row">
				<input type="hidden" name="favoritos_usuario"  value="<?php echo $this->content->favoritos_usuario ?>">
				<input type="hidden" name="favoritos_tienda"  value="<?php echo $this->content->favoritos_tienda ?>">
			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>