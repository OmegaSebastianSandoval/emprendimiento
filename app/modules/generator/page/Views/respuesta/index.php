<div class="titulo-proyecto">
    <h2 class="titulo-principal contact">Estado transacción</h2><br>
</div>
<div>
    <?php if($this->error != 1 && $this->pedido){ ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="row">
                        <div class="col-lg-6"><b>N° Pedido</b></div>
                        <div class="col-lg-6"><?php echo str_pad($this->pedido->pedido_id, 10, "0", STR_PAD_LEFT); ?></div>
                        <div class="col-lg-6"><b>Fecha Pedido</b></div>
                        <div class="col-lg-6"><?php echo $this->pedido->pedido_fecha; ?></div>
                        <div class="col-lg-6"><b>Valor Transacción</b></div>
                        <div class="col-lg-6">$<?php echo number_format($this->pedido->pedido_valorpagar); ?></div>
                        <div class="col-lg-6"><b>Estado Transacción</b></div>
                        <div class="col-lg-6"><?php echo $this->pedido->pedido_estado_texto; ?></div>
                        <div class="col-lg-6"><b>Detalle Estado</b></div>
                        <div class="col-lg-6"><?php echo $this->pedido->pedido_estado_texto2; ?></div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<br><br>
<div class="container">
    <div class="caja-respuesta">
    <?php //echo $this->getRoutPHP('modules/page/Views/formulario/detallecompra.php'); ?>
    </div>
</div>
<br><br>
