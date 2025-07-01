<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform; ?>"
		data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->user_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->user_id; ?>" />
			<?php } ?>
			<div class="row">


				<div class="col-4 offset-8 form-group">
					<label class="control-label">Estado</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro "><i
									class="fas fa-clipboard-check"></i></span>
						</div>
						<select class="form-control" name="user_state" id="user_state" required>
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_user_state as $key => $value) { ?>
								<option <?php if ($this->getObjectVariable($this->content, "user_state") == $key) {
									echo "selected";
								} ?>
									value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<input type="hidden" name="user_date" value="<?php echo $this->content->user_date ?>">
				<div class="col-4 form-group">
					<label for="user_names" class="control-label">Nombres</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-morado "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->user_names; ?>" name="user_names" id="user_names"
							class="form-control disable-edit" required>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-4 form-group">
					<label for="user_email" class="control-label">correo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde-claro "><i class="fas fa-envelope"></i></span>
						</div>
						<input type="email" value="<?= $this->content->user_email; ?>" name="user_email" id="user_email"
							class="form-control disable-edit" required
							data-remote="/core/user/validationemail?csrf=1&email=<?= $this->content->user_email; ?>">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-4 form-group">
					<label class="control-label">Nivel</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rojo-claro "><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control disable-edit" name="user_level" required>
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_user_level as $key => $value) { ?>
								<option <?php if ($this->getObjectVariable($this->content, "user_level") == $key) {
									echo "selected";
								} ?>
									value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-4 form-group">
					<label for="user_user" class="control-label">Usuario</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado "><i class="fas fa-user-tie"></i></span>
						</div>
						<input type="text" value="<?= $this->content->user_user; ?>" name="user_user" id="user_user"
							class="form-control disable-edit" required
							data-remote="/core/user/validation?csrf=1&user=<?= $this->content->user_user; ?>">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-4 form-group">
					<label for="user_password" class="control-label">Contrase&ntilde;a</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-cafe "><i class="fas fa-key"></i></span>
						</div>
						<input type="password" value="" name="user_password" id="user_password" class="form-control disable-edit"
							<?php if (!$this->content->user_id) { ?>required <?php } ?> data-remote="/core/user/validarclave">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-4 form-group">
					<label for="user_password" class="control-label">Repita Contrase&ntilde;a</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-cafe "><i class="fas fa-key"></i></span>
						</div>
						<input type="password" value="" name="user_passwordr" id="user_passwordr" data-match="#user_password"
							min="8" data-match-error="Las dos contraseñas no son iguales" class="form-control disable-edit" <?php if (!$this->content->user_id) { ?>required <?php } ?>>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group col-md-6">
					<label for="telefono">Teléfono</label>
					<input type="number" class="form-control disable-edit" value="<?= $this->content->user_telefono; ?>"
						id="telefono" name="telefono" placeholder="">
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group col-md-6">
					<label for="accion">Documento</label>
					<input type="number" class="form-control disable-edit" value="<?= $this->content->user_accion; ?>" id="accion"
						name="accion" placeholder="">
					<div class="help-block with-errors"></div>
				</div>
				<input type="hidden" name="user_delete" value="<?php echo $this->content->user_delete ?>">
				<input type="hidden" name="user_negocio" value="<?php echo $this->content->user_negocio ?>">
				<input type="hidden" name="user_current_user" value="<?php echo $this->content->user_current_user ?>">
				<input type="hidden" name="user_code" value="<?php echo $this->content->user_code ?>">
				<?php if ($_GET["edit"] == 1) { ?>
					<input type="hidden" name="edit" value="1">
				<?php } ?>
			</div>
			<?php if ($_GET["edit"] == 1 && $this->content->user_state == 0 && $this->tienda) { ?>
				

				<div class="card my-3" style="width: fit-content;">
					<h5 class="card-header">Información de la tienda</h5>
					<div class="card-body">

						<h6 class="card-title">Nombre:
							<span>
								<?= $this->tienda->tiendas_nombre ?>
							</span>
						</h6>

						<?php if ($this->tienda->tiendas_imagen) { ?>
							<div class="imagen">
								<span>Logo: </span>
								<img class="img-fluid" src="/images/<?= $this->tienda->tiendas_imagen ?>" alt="Logo de la tienda">
							</div>
						<?php } ?>

						<?php if ($this->tienda->tiendas_categoria) { ?>
							<div class="categoria">
								<span>Categoría: </span>
								<?= $this->list_categorias[$this->tienda->tiendas_categoria] ?>
							</div>
						<?php } ?>

						<?php if ($this->tienda->tiendas_descripcion) { ?>
							<div class="card-text">
								<span>Descripción: </span>

								<?= $this->tienda->tiendas_descripcion ?>
							</div>
						<?php } ?>

						<a class="btn btn-outline-success w-auto my-2"
							href="/administracion/tiendas/manage?id=<?= $this->content->user_negocio ?>" target="_blank">Ver
							tienda</a>
					</div>
				</div>

				<script>
					$(document).ready(function () {
						$("#user_state").change(function () {
							if ($(this).val() == 1) {
								$("#btn-guardar").text("Guardar y activar tienda");
							} else{
								$("#btn-guardar").text("Guardar");
							}
						});
					});
				</script>
			<?php } ?>
		</div>

		<div class="botones-acciones">
			<button class="btn btn-guardar" id="btn-guardar" type="submit">
				<?php if ($_GET["edit"] == 1 && $this->content->user_state == 0 && $this->tienda) { ?>
					Guardar
				<?php } else { ?>
					Guardar
				<?php } ?>
			</button>
			<a href="<?php echo $this->route; ?>" class="btn btn-cancelar">Cancelar</a>
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
<?php if ($_GET["edit"] == 1) { ?>
	<script>
		$(document).ready(function () {

			$(".disable-edit").prop("readonly", true);

		});
	</script>
	<style>
		.disable-edit {
			background-color: #d5d5d5;
			cursor: not-allowed;
		}
	</style>
<?php } ?>
<style>
	.card-title {
		color: #797979;
		font-weight: 800;
	}

	.card-title span {
		font-weight: 400;
	}

	.imagen span {
		font-weight: 800;
		display: block;
		color: #797979;


	}

	.imagen img {
		width: 100%;
		max-width: 200px;
	}

	.categoria {
		margin-top: 15px;
		color: #797979;

	}

	.categoria span {
		font-weight: 800;
		display: block;
		color: #797979;
	}

	.card-text {
		margin-top: 15px;
		color: #797979;
	}

	.card-text span {
		font-weight: 800;
		display: block;
		color: #797979;
	}
</style>