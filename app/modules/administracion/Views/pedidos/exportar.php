<?php

if($_GET['excel']==""){
	function codificar($x){
		return $x;
	}
}else{
	function codificar($x){
		$x = utf8_decode($x);
		return $x;
	}
}


?>


<?php if($_GET['excel']==""){ ?>
<form id="form1" name="form1" method="get" action="/administracion/pedidos/exportar/">
  <table border="0" cellspacing="0" cellpadding="4">
    <tr>
      <td>Rango de fechas</td>
      <td><label>
        <input type="date" name="fecha1" id="fecha1" value="<?php echo $_GET['fecha1']; ?>" />
      </label></td>
      <td>-</td>
      <td><label>
        <input type="date" name="fecha2" id="fecha2" value="<?php echo $_GET['fecha2']; ?>" />
      </label></td>
      <td><label>
        <input name="filtro" type="submit" class="btn btn-primary" id="filtro" value="Filtrar" />
      </label></td>
      <td><label><a href="/administracion/pedidos/exportar/" class="btn btn-secondary">Limpiar</a></label></td>
      <td><label><a href="/administracion/pedidos/exportar/?fecha1=<?php echo $_GET['fecha1']; ?>&fecha2=<?php echo $_GET['fecha2']; ?>&excel=1" class="btn btn-primary">Exportar</a></label></td>
    </tr>
  </table>
</form>
<?php } ?>

<div class="container">
<table border="1" width="100%" bgcolor="#FFFFFF" style="font-size: 10px;">
	<tr>
		<th># de pedido</th>
		<th>Fecha y hora de pedido</th>
		<th>Zona</th>
		<th># de accion</th>
		<th>Nombre de socio</th>
		<th>Direccion</th>
		<th>Complemento</th>
		<th>Indicaciones</th>
		<th>Correo</th>
		<th>Contacto celular</th>
		<th>Metodo de envio</th>
		<th>Forma de pago</th>
		<th>Franquicia</th>
		<th>Estado de pago</th>
		<th>Categoria</th>
		<th>codigo producto</th>
		<th>nombre de producto</th>
		<th>cantidad</th>
		<th>valor total producto</th>
		<th>valor total pedido</th>

	</tr>
	<?php foreach ($this->pedidos as $key => $pedido): ?>
		<?php $socio = $this->array_socios[$pedido->pedido_documento]; ?>
		<?php foreach ($pedido->productos as $key2 => $producto) { ?>
			<tr>
				<td><?php echo $pedido->pedido_id; ?></td>
				<td><?php echo $pedido->pedido_fecha; ?></td>
				<td><?php echo $pedido->pedido_zona; ?></td>
				<td><?php echo $socio->socio_carnet; ?></td>
				<td><?php echo codificar($pedido->pedido_nombre); ?></td>
				<td><?php echo $pedido->pedido_direccion; ?></td>
				<td><?php echo $pedido->pedido_complemento; ?></td>
				<td><?php echo $pedido->pedido_indicaciones; ?></td>
				<td><?php echo $pedido->pedido_correo; ?></td>
				<td><?php echo $pedido->pedido_celular; ?></td>
				<td><?php echo codificar($this->list_pedido_forma_envio[$pedido->pedido_forma_envio]); ?></td>
				<td><?php echo codificar($this->list_pedido_medio[$pedido->pedido_medio]); ?></td>
				<td><?php echo codificar($pedido->pedido_franquicia); ?></td>
				<td><?php echo $this->list_pedido_estado[$pedido->pedido_estado]; ?></td>
				<td><?php echo codificar($this->array_categorias[$producto->id_productos]); ?></td>
				<td><?php echo $this->array_codigos[$producto->id_productos]; ?></td>
				<td><?php echo codificar($producto->nombre); ?></td>
				<td><?php echo $producto->cantidad; ?></td>
				<td><?php echo $producto->valor_iva*$producto->cantidad; ?></td>
				<td><?php echo $pedido->pedido_valorpagar; ?></td>
			</tr>
		<?php } ?>
	<?php endforeach ?>

</table>
</div>