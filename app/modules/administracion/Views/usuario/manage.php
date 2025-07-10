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
				<?php if (!$_GET["edit"] == 1 && !$this->tienda) { ?>
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
				<?php } ?>

				<div class="form-group col-md-4">
					<label for="telefono">Teléfono</label>
					<input type="number" class="form-control disable-edit" value="<?= $this->content->user_telefono; ?>"
						id="telefono" name="telefono" placeholder="">
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group col-md-4">
					<label for="accion">Documento</label>
					<input type="number" class="form-control disable-edit" value="<?= $this->content->user_accion; ?>" id="accion"
						name="accion" placeholder="">
					<div class="help-block with-errors"></div>
				</div>
				<input type="hidden" name="user_delete" value="<?php echo $this->content->user_delete ?>">
				<input type="hidden" name="user_negocio" value="<?php echo $this->content->user_negocio ?>">
				<input type="hidden" name="user_current_user" value="<?php echo $this->content->user_current_user ?>">
				<input type="hidden" name="user_code" value="<?php echo $this->content->user_code ?>">
				<input type="hidden" name="user_lastnames" value="<?php echo $this->content->user_lastnames ?>">
				<input type="hidden" name="user_invitado_socio" value="<?php echo $this->content->user_invitado_socio ?>">

				<!-- Campos para tipo de persona -->
				<input type="hidden" name="persona_tipo" value="<?php echo $this->content->persona_tipo ?>">

				<!-- Campos Persona Natural -->
				<input type="hidden" name="pn_nombres" value="<?php echo $this->content->pn_nombres ?>">
				<input type="hidden" name="pn_apellidos" value="<?php echo $this->content->pn_apellidos ?>">
				<input type="hidden" name="pn_id_tipo" value="<?php echo $this->content->pn_id_tipo ?>">
				<input type="hidden" name="pn_documento" value="<?php echo $this->content->pn_documento ?>">
				<input type="hidden" name="pn_fecha_nacimiento" value="<?php echo $this->content->pn_fecha_nacimiento ?>">
				<input type="hidden" name="pn_telefono_contacto" value="<?php echo $this->content->pn_telefono_contacto ?>">
				<input type="hidden" name="pn_email" value="<?php echo $this->content->pn_email ?>">
				<input type="hidden" name="pn_nivel_estudio" value="<?php echo $this->content->pn_nivel_estudio ?>">
				<input type="hidden" name="pn_actividad" value="<?php echo $this->content->pn_actividad ?>">
				<input type="hidden" name="pn_departamento" value="<?php echo $this->content->pn_departamento ?>">
				<input type="hidden" name="pn_municipio" value="<?php echo $this->content->pn_municipio ?>">
				<input type="hidden" name="pn_direccion" value="<?php echo $this->content->pn_direccion ?>">

				<!-- Campos Persona Jurídica -->
				<input type="hidden" name="pj_razon_social" value="<?php echo $this->content->pj_razon_social ?>">
				<input type="hidden" name="pj_nit" value="<?php echo $this->content->pj_nit ?>">
				<input type="hidden" name="pj_email_notificaciones" value="<?php echo $this->content->pj_email_notificaciones ?>">
				<input type="hidden" name="pj_telefono" value="<?php echo $this->content->pj_telefono ?>">
				<input type="hidden" name="pj_direccion" value="<?php echo $this->content->pj_direccion ?>">
				<input type="hidden" name="pj_departamento" value="<?php echo $this->content->pj_departamento ?>">
				<input type="hidden" name="pj_municipio" value="<?php echo $this->content->pj_municipio ?>">
				<input type="hidden" name="pj_ciiu" value="<?php echo $this->content->pj_ciiu ?>">
				<input type="hidden" name="pj_tipo_empresa" value="<?php echo $this->content->pj_tipo_empresa ?>">
				<input type="hidden" name="pj_empleados_cargo" value="<?php echo $this->content->pj_empleados_cargo ?>">

				<!-- Campos Representante Legal -->
				<input type="hidden" name="pj_rep_apellido1" value="<?php echo $this->content->pj_rep_apellido1 ?>">
				<input type="hidden" name="pj_rep_apellido2" value="<?php echo $this->content->pj_rep_apellido2 ?>">
				<input type="hidden" name="pj_rep_nombres" value="<?php echo $this->content->pj_rep_nombres ?>">
				<input type="hidden" name="pj_rep_id_tipo" value="<?php echo $this->content->pj_rep_id_tipo ?>">
				<input type="hidden" name="pj_rep_id_numero" value="<?php echo $this->content->pj_rep_id_numero ?>">
				<input type="hidden" name="pj_rep_expedicion_lugar" value="<?php echo $this->content->pj_rep_expedicion_lugar ?>">
				<input type="hidden" name="pj_rep_expedicion_fecha" value="<?php echo $this->content->pj_rep_expedicion_fecha ?>">
				<input type="hidden" name="pj_rep_nacionalidad" value="<?php echo $this->content->pj_rep_nacionalidad ?>">
				<input type="hidden" name="pj_rep_fecha_nacimiento" value="<?php echo $this->content->pj_rep_fecha_nacimiento ?>">
				<input type="hidden" name="pj_rep_lugar_nacimiento" value="<?php echo $this->content->pj_rep_lugar_nacimiento ?>">

				<!-- Campos individuales para documentos - Persona Natural -->
				<input type="hidden" name="user_cc" value="<?php echo $this->content->user_cc ?>">
				<input type="hidden" name="user_certificacion" value="<?php echo $this->content->user_certificacion ?>">
				<input type="hidden" name="user_declaracion" value="<?php echo $this->content->user_declaracion ?>">

				<!-- Campos individuales para documentos - Persona Jurídica -->
				<input type="hidden" name="user_certificado_representacion" value="<?php echo $this->content->user_certificado_representacion ?>">
				<input type="hidden" name="user_rut" value="<?php echo $this->content->user_rut ?>">
				<input type="hidden" name="user_documento_identidad" value="<?php echo $this->content->user_documento_identidad ?>">
				<input type="hidden" name="user_certificado_bancario" value="<?php echo $this->content->user_certificado_bancario ?>">

				<!-- Campos adicionales para asociado jurídica -->
				<input type="hidden" name="pj_asociado_nombres" value="<?php echo $this->content->pj_asociado_nombres ?>">
				<input type="hidden" name="pj_asociado_apellidos" value="<?php echo $this->content->pj_asociado_apellidos ?>">
				<input type="hidden" name="pj_documento_asociado" value="<?php echo $this->content->pj_documento_asociado ?>">

				<?php if ($_GET["edit"] == 1) { ?>
					<input type="hidden" name="edit" value="1">
				<?php } ?>
			</div>
			<?php if ($_GET["edit"] == 1 && $this->content->user_state == 0 && $this->tienda) { ?>

				<div class="row">
					<div class="col-12 col-md-6">
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
					</div>
					<div class="col-12 col-md-6">
						<?php
						$user = $this->content; // Asumimos que $this->content es el objeto de usuario
						// Normalizamos el tipo por si viene con espacios o en minúsculas
						$tipo = isset($user->persona_tipo)
							? strtoupper(trim($user->persona_tipo))
							: '';
						?>
						<div class="card my-3" style="width: fit-content;">
							<h5 class="card-header">Información del emprendedor</h5>
							<div class="card-body">
								<?php if ($tipo === 'N'): // Persona Natural 
								?>
									<h6 class="card-title">Nombre:
										<span><?= ("{$user->pn_nombres} {$user->pn_apellidos}") ?></span>
									</h6>
									<p><strong>Tipo de persona </strong>
										Natural</p>
									<p><strong>Documento (<?= ($user->pn_id_tipo) ?>):</strong>
										<?= ($user->pn_documento) ?></p>
									<p><strong>Fecha de nacimiento:</strong>
										<?= ($user->pn_fecha_nacimiento) ?></p>
									<p><strong>Contacto:</strong>
										<?= ($user->pn_telefono_contacto) ?> /
										<?= ($user->pn_email) ?>
									</p>
									<p><strong>Dirección:</strong>
										<?= ($user->pn_direccion) ?></p>
									<p><strong>Departamento:</strong>
										<?= ($this->list_departamentos[$user->pn_departamento]) ?></p>
									<p><strong>Municipio:</strong>
										<?= ($this->list_municipios[$user->pn_municipio]) ?></p>
									<hr>
									<h6 class="card-subtitle mb-2">Documentos</h6>
								<?php elseif ($tipo === 'J'): // Persona Jurídica 
								?>
									<!-- Datos generales -->
									<h6 class="card-title">Razón social:
										<span><?= ($user->pj_razon_social) ?></span>
									</h6>
									<p><strong>Tipo de persona </strong>
										Jurídica</p>
									<p><strong>NIT:</strong> <?= ($user->pj_nit) ?></p>
									<p><strong>Email notificaciones:</strong>
										<?= ($user->pj_email_notificaciones) ?></p>
									<p><strong>Teléfono:</strong>
										<?= ($user->pj_telefono) ?></p>
		

										

									<!-- Ubicación (si tienes funciones para resolver código → nombre, descomenta) -->
									<p><strong>Departamento:</strong>
										<?= ($this->list_departamentos[$user->pj_departamento]) ?></p>
									<p><strong>Municipio:</strong>
										<?= ($this->list_municipios[$user->pj_municipio]) ?></p>

									<p><strong>CIIU:</strong> <?= ($user->pj_ciiu) ?></p>
									<p><strong>Tipo de empresa:</strong>
										<?= ($user->pj_tipo_empresa) ?></p>
									<p><strong>Tiene empleados a cargo:</strong>
										<?= ($user->pj_empleados_cargo == 1 ? 'Si' : 'No') ?></p>

									<hr>
									<!-- Datos de asociado, si aplica -->
									<?php if (!empty($user->pj_asociado_nombres)): ?>
										<h6 class="card-subtitle mb-2">Asociado</h6>
										<p>
											<?= ("{$user->pj_asociado_nombres} {$user->pj_asociado_apellidos}") ?>
											(<?= ($user->pj_documento_asociado) ?>)
										</p>
										<hr>
									<?php endif; ?>

									<!-- Representante legal -->
									<h6 class="card-subtitle mb-2">Representante legal</h6>
									<p>
										<?= (implode(' ', array_filter([
											$user->pj_rep_nombres,
											$user->pj_rep_apellido1,
											$user->pj_rep_apellido2,
										]))) ?>
									</p>
									<p><strong>Documento (<?= ($user->pj_rep_id_tipo) ?>):</strong>
										<?= ($user->pj_rep_id_numero) ?></p>
									<p><strong>Lugar expedición:</strong>
										<?= ($user->pj_rep_expedicion_lugar) ?></p>
									<p><strong>Fecha expedición:</strong>
										<?= ($user->pj_rep_expedicion_fecha) ?></p>
									<p><strong>Nacionalidad:</strong>
										<?= ($user->pj_rep_nacionalidad) ?></p>
									<p><strong>Fecha nacimiento:</strong>
										<?= ($user->pj_rep_fecha_nacimiento) ?></p>
									<p><strong>Lugar nacimiento:</strong>
										<?= ($user->pj_rep_lugar_nacimiento) ?></p>

									<hr>
									<h6 class="card-subtitle mb-2">Documentos</h6>
								<?php else: ?>
									<p class="text-warning">Tipo de persona desconocido.</p>
								<?php endif; ?>

								<?php
								// Lista de documentos según tipo de persona
								$docs = [];
								if ($tipo === 'N') {
									$docs = [
										'Cédula' => $user->user_cc,
										'Certificación' => $user->user_certificacion,
										'Declaración' => $user->user_declaracion,
										'Documento identidad' => $user->user_documento_identidad,
										'Certificado bancario' => $user->user_certificado_bancario,
									];
								} elseif ($tipo === 'J') {
									$docs = [
										'Certificado de representación' => $user->user_certificado_representacion,
										'RUT' => $user->user_rut,
										'Documento identidad' => $user->user_documento_identidad,
										'Certificado bancario' => $user->user_certificado_bancario,

									];
								}

								// Renderizamos sólo los que existan
								foreach ($docs as $label => $filename):
									if (!empty($filename)): ?>
										<a href="/files/<?= rawurlencode($filename) ?>" class="btn btn-sm btn-outline-primary me-2 mb-2"
											target="_blank">
											Ver <?= $label ?>
										</a>
								<?php
									endif;
								endforeach;
								?>

							</div>
						</div>

					</div>
				</div>

				<script>
					$("#user_state").change(function() {
						console.log($(this).val());
						if ($(this).val() == 1) {
							$("#btn-guardar").text("Guardar y activar tienda");
						} else {
							$("#btn-guardar").text("Guardar");
						}
					});
				</script>
			<?php } ?>
		</div>

		<div class="botones-acciones">
			<button class="btn btn-guardar" id="btn-guardar" type="submit">
				<?php if ($_GET["edit"] == 1 && $this->content->user_state == 0 && $this->tienda) { ?>
					Guardar y activar tienda
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
		$(document).ready(function() {

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