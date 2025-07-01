<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>" data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->pedido_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->pedido_id; ?>" />
			<?php }?>
			<div class="row">
				<div class="col-lg-4 form-group">
					<label class="control-label">Tipo Documento</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="pedido_tipodocumento"   >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_pedido_tipodocumento AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"pedido_tipodocumento") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-lg-4 form-group">
					<label for="pedido_documento"  class="control-label">Documento</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_documento; ?>" name="pedido_documento" id="pedido_documento" class="form-control"   readonly>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-lg-4 form-group">
					<label for="pedido_nombre"  class="control-label">Nombre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_nombre; ?>" name="pedido_nombre" id="pedido_nombre" class="form-control"  readonly >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-lg-4 form-group">
					<label for="pedido_correo"  class="control-label">Correo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rojo-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_correo; ?>" name="pedido_correo" id="pedido_correo" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-lg-4 form-group d-none">
					<label for="pedido_telefono"  class="control-label">Telefono</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-morado " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_telefono; ?>" name="pedido_telefono" id="pedido_telefono" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-lg-4 form-group">
					<label for="pedido_celular"  class="control-label">Celular</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_celular; ?>" name="pedido_celular" id="pedido_celular" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<input type="hidden" name="pedido_nomenclatura"  value="<?php echo $this->content->pedido_nomenclatura ?>">

				<input type="hidden" name="pedido_ciudad"  value="<?php echo $this->content->pedido_ciudad ?>">

				<div class="col-lg-4 form-group">
					<label class="control-label">Metodo de pago</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="pedido_medio"   >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_pedido_medio AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"pedido_medio") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-lg-4 form-group">
					<label class="control-label">Forma de envio</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-cafe " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="pedido_forma_envio"   >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_pedido_forma_envio AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"pedido_forma_envio") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-lg-6 form-group">
					<label for="pedido_direccion"  class="control-label">Direcci&oacute;n</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_direccion; ?>" name="pedido_direccion" id="pedido_direccion" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-lg-4 form-group">
					<label for="pedido_fecha"  class="control-label">Fecha</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_fecha; ?>" name="pedido_fecha" id="pedido_fecha" class="form-control"  readonly >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-lg-4 form-group">
					<label for="pedido_envio"  class="control-label">Valor Envío</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-cafe " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_envio; ?>" name="pedido_envio" id="pedido_envio" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-lg-4 form-group">
					<label for="pedido_valorpagar"  class="control-label">Valor total</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_valorpagar; ?>" name="pedido_valorpagar" id="pedido_valorpagar" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<input type="hidden" name="pedido_zona"  value="<?php echo $this->content->pedido_zona ?>">
				<div class="col-lg-4 form-group">
					<label class="control-label">Estado</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="pedido_estado"   >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_pedido_estado AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"pedido_estado") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-lg-4 form-group d-none">
					<label for="pedido_estado_texto"  class="control-label">Estado texto</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_estado_texto; ?>" name="pedido_estado_texto" id="pedido_estado_texto" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-lg-4 form-group d-none">
					<label for="pedido_estado_texto2"  class="control-label">Estado texto2</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rojo-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_estado_texto2; ?>" name="pedido_estado_texto2" id="pedido_estado_texto2" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-lg-4 form-group d-none">
					<label for="pedido_cus"  class="control-label">Cus</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-morado " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_cus; ?>" name="pedido_cus" id="pedido_cus" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-lg-4 form-group d-none">
					<label for="request_id"  class="control-label">Request</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->request_id; ?>" name="request_id" id="request_id" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
			</div>


	        <div class="col-lg-12">
				<br>
		        <h2>Pedido</h2>
	        	<table width="100%" cellpadding="5" border="1">
	        		<tr>
	        			<th>Producto</th>
	        			<th><div align="center">Cantidad</div></th>
	        			<th><div align="right">Valor unitario</div></th>
	        			<th><div align="right">Valor total</div></th>
	        		</tr>
	        		<?php foreach ($this->productos as $producto): ?>
		        		<tr>
		        			<td><?php echo $producto->nombre; ?></td>
		        			<td align="center"><?php echo $producto->cantidad; ?></td>
		        			<td align="right">$<?php echo number_format($producto->valor); ?></td>
		        			<td align="right">$<?php echo number_format($producto->valor*$producto->cantidad); ?></td>
		        		</tr>
	        		<?php endforeach ?>
						<tr>
							<td colspan="3"><b>Costo envío</b></td>
							<td align="right">$<?php echo number_format($this->content->pedido_envio*1); ?></td>
						</tr>
						<tr>
							<td colspan="3"><b>Total</b></td>
							<td align="right">$<?php echo number_format($this->content->pedido_valorpagar); ?></td>
						</tr>
	        	</table>
	        </div>

		</div>






		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>

<script type="text/javascript">
	<?php if($_SESSION['kt_login_level']=="4"){ ?>
		function f1(){
			$("input").prop("disabled", true);
			$("select").prop("disabled", true);
			$(".btn-guardar").hide();
		}
		setTimeout(f1(),1000);
		setTimeout(f1(),2000);
		setTimeout(f1(),3000);
	<?php } ?>
</script>