<div class="caja-carrito">
    <div class="btn-cerrar-carrito">
        <i class="fas fa-times-circle"></i>
    </div>
    <div class="detalle-carrito">
        <div class="container">
            <h2 class="titulo-carrito">Tu carrito de compras</h2>
            <?php $valortotal = 0; ?>
            <?php if (count($this->carrito) > 0) { ?>
                <?php foreach ($this->carrito as $key => $carrito) { ?>
                    <?php
                    $producto = $carrito['detalle'];
                    $valor = $carrito['cantidad'] * $producto->productos_precio;
                    $valortotal = $valortotal + $valor;
                    ?>
                    <div class="row item-carrito">
                        <div class="col-sm-3 cajax">
                            <?php if ($producto->productos_imagen != "") { ?>
                                <img src="/images/<?php echo $producto->productos_imagen; ?>">
                            <?php } else { ?>
                                <img src="/corte/product.png">
                            <?php } ?>
                        </div>
                        <div class="col-sm-6 cajax2">
                            <h4 class="titulo-product-carrito"><?php echo $producto->productos_nombre; ?></h4>
                            <div>Unid. $<span style="font-family:'Myriad Pro';"><?php echo number_format($producto->productos_precio); ?></div>
                            <div class="precio-product-carrito">Total: <span id="valortotal<?php echo $producto->productos_id; ?>" style="font-family:'Myriad Pro';">$<?php echo number_format($producto->productos_precio * $carrito['cantidad']) ?></span></div>


                        </div>

                        <?php
                        $max = 20;
                        if ($producto->productos_cantidad < $max) {
                            $max  = $producto->productos_cantidad;
                        }
                        if ($producto->productos_limite_pedido != "" and $producto->productos_limite_pedido < $max) {
                            $max  = $producto->productos_limite_pedido;
                        }
                        ?>
                        <div class="col-sm-3 cajax">
                            <div class="inptt" align="left">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary btn-minus" data-id="<?php echo $producto->productos_id; ?>" type="button" id="button-addon2"><i class="fas fa-minus"></i></button>
                                    </div>
                                    <input type="text" class="form-control cantidad_item" id="cantidad<?php echo $producto->productos_id; ?>" placeholder="" value="<?php echo $carrito['cantidad']; ?>" min="0" max="<?php echo $max; ?>" disabled>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary btn-plus" data-id="<?php echo $producto->productos_id; ?>" type="button" id="button-addon1"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-12 text-right text-end div_eliminar">
                            <a class="btn-eliminar-carrito" data-id="<?php echo $producto->productos_id; ?>"><i class="fas fa-trash-alt eliminar"></i></a>
                        </div>

                        <input type="hidden" id="valorunitario<?php echo $producto->productos_id; ?>" value="<?php echo $producto->productos_precio; ?>">
                        <div class="divisor"></div>
                    </div>
                <?php } ?>
                <div class="row justify-content-center total-carrito">
                    <div class="col-sm-7 valor_pagar">
                        Valor a pagar:
                    </div>
                    <div class="col-sm-4" align="right">
                        <div class="col-sm-12 valor" id="totalpagar">$<?php echo $valortotal ?></div>
                    </div>

                    <div class="col-12 fondo_puntas d-none">
                    </div>
                    <div class="col-12 mb-3 fondo_cafe" align="right">
                        <div class="pagar" align="right"><a href="/page/compra" class="btn btn-sm btn-primary-carrito">Iniciar pago</a></div>
                        <div class="pagar" align="right"><a class="btn btn-sm btn-primary-carrito pointer" onclick="$('.btn-cerrar-carrito').click();">Seguir comprando</a></div>
                    </div>
                <?php } else { ?>
                    <div class="logo-alert" align="center">
                        <img class="aloe" src="/corte/logo2.jpg" height="120" alt="">
                    </div>
                    <div class="mensaje-alert" align="center">
                        <p>No hay productos en tu carrito</p>
                    </div>
                <?php } ?>
                </div>
        </div>
    </div>