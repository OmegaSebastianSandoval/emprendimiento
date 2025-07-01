<?php if ($this->id > 0){ ?>
<?php
	$usuarioId='98608';//codigo payu
	$llave='13d4b0650cf'; //codigo payu
	$refVenta=$this->pedido->pedido_id;//identificador del pedido
	$valor= $this->pedido->pedido_valorpagar;//costo transaccion
	$moneda= 'COP';
	$iva=0;
	$valorbase=0;
	$firma=$llave."~".$usuarioId."~".$refVenta."~".$valor."~".$moneda;
?>
<form action="https://gateway.pagosonline.net/apps/gateway/index.html" id="formpayu" method="post">
<input type="hidden" name="usuarioId" value="<?php echo $usuarioId;?>" />
<input type="hidden" name="refVenta" value="<?php echo $refVenta; ?>" />
<input type="hidden" name="descripcion" value="Venta Sweet Love Referencia:<?php echo $this->pedido->pedido_id; ?>" />
<input type="hidden" id="valor" name="valor" value="<?php echo $valor; ?>" />
<input type="hidden" name="iva" value="<?php echo $iva; ?>" />
<input type="hidden" name="baseDevolucionIva" value="<?php echo $valorbase ; ?>" />
<input type="hidden" name="firma" value="<?php echo md5($firma); ?>" />
<input type="hidden" name="moneda" value="<?php echo $moneda; ?>" />
<input type="hidden" name="prueba" value="0" />
<input type="hidden" name="buyerEmail" value="<?php echo $this->pedido->pedido_correo; ?>" />
<input type="hidden" name="payerFullName" value="<?php echo $this->pedido->pedido_nombre; ?>" />
<input type="hidden" name="mobilePhone" value="<?php echo $this->pedido->pedido_celular; ?>" />
<input type="hidden" name="payerPhone" value="<?php echo $this->pedido->pedido_telefono; ?>" />
<input type="hidden" name="responseUrl" value="/page/respuesta" />
<input type="hidden" name="confirmationUrl" value="page/confirmacion" />


</form>
<script type="text/javascript">
	document.getElementById('formpayu').submit();
</script> 
<?php }else{?>
    <script type="text/javascript">
        window.location='/page';
    </script>
<?php }?> 