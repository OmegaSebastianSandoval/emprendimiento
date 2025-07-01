<div class="titulo-proyecto">
    <h2 class="titulo-principal contact">Carrito de compras</h2>
</div>



<div class="contenidos-productos">
    <div class="container">
        <div class="row">


            <?php if ($_GET['error'] == "1") { ?>

                <div class="col-lg-12"><br></div>
                <div class='alert alert-danger text-center col-lg-12'>En este momento no es posible realizar tu pedido.</div>

                <br>
            <?php } ?>

            <div class="col-12">
                <?php if (count($this->carrito) > 0) { ?>
                    <?php $contador = count($this->carrito); ?>
                    <input type="hidden" value="<?php echo $contador; ?>" id="cantidad-carrito">
                    <div class="caja-pedido">
                        <form action="/page/compra/enviar" method="post">
                            <div>
                                <h3 class="titulo-verde1">Tu pedido</h3>
                                <?php $valortotal2 = 0;
                                $x = 0;
                                $error = 0; ?>
                                <?php foreach ($this->carrito as $key => $carrito) { ?>
                                    <?php $x++; ?>
                                    <?php
                                    $producto = $carrito['detalle'];
                                    $valor = $carrito['cantidad'] * $producto->productos_precio;
                                    $valortotal2 = $valortotal + $valor;
                                    ?>
                                    <?php
                                    $max = 20;
                                    if ($producto->productos_cantidad < $max) {
                                        $max  = $producto->productos_cantidad;
                                    }
                                    if ($producto->productos_limite_pedido != "" and $producto->productos_limite_pedido < $max) {
                                        $max = $producto->productos_limite_pedido;
                                    }
                                    ?>
                                    <div id="itempedido<?php echo $producto->productos_id; ?>">
                                        <div class="detalle-pedido">
                                            <div class="detalle-carrito">
                                                <div class="caja-item">
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-4">
                                                            <div class="titulo-producto-carrito" align="center">
                                                                <h5 <?php if ($x > 1) {
                                                                        echo 'class="solo_cel"';
                                                                    } ?>>Producto</h5>
                                                                <div class="valor-tienda-negocio"><?php echo $producto->productos_nombre; ?></div>
                                                            </div>
                                                            <?php if ($max == 0) { ?>
                                                                <div class="text-center" style="margin-top: 5px;" id="error2"><small class="alert alert-danger text-center">Producto no disponible</small></div>
                                                                <?php $error = 1; ?>
                                                            <?php } ?>
                                                            <?php if ($carrito['cantidad'] > $max and $max > 0) { ?>
                                                                <div class="text-center" style="margin-top: 5px;" id="error3"><small class="alert alert-danger text-center">Solo <?php echo $max; ?> unidad(es) disponible(s)</small></div>
                                                                <?php $error = 1; ?>
                                                            <?php } ?>

                                                        </div>
                                                        <input type="hidden" id="valorunitario<?php echo $producto->productos_id; ?>" value="<?php echo $producto->productos_precio; ?>">
                                                        <div class="col-lg-3" align="center">
                                                            <h5 <?php if ($x > 1) {
                                                                    echo 'class="solo_cel"';
                                                                } ?>>Valor unitario</h5>
                                                            <div class="valor-tienda-negocio">
                                                                <strong></strong> $ <span> <?php echo number_format($producto->productos_precio); ?></span> COP
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3" align="center">
                                                            <h5 <?php if ($x > 1) {
                                                                    echo 'class="solo_cel"';
                                                                } ?>>Valor total</h5>
                                                            <div class="valor-tienda-negocio">
                                                                <strong></strong> <span id="valortotal<?php echo $producto->productos_id; ?>"> <span> <?php echo number_format($carrito['cantidad'] * $producto->productos_precio);  ?></span></span> COP
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <h5 class="no_cel"><br></h5>
                                                            <div class="input-group input-group-sm mb-3" style="margin-top: 10px;">
                                                                <div class="input-group-prepend">
                                                                    <button onclick="ocultar_error();" class="btn btn-outline-secondary btn-minus" data-id="<?php echo $producto->productos_id; ?>" type="button" id="button-addon2"><i class="fas fa-minus"></i></button>
                                                                </div>
                                                                <input type="text" class="form-control number" id="cantidad<?php echo $producto->productos_id; ?>" placeholder="" value="<?php echo $carrito['cantidad']; ?>" min="0" max="<?php echo $max; ?>" disabled>
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-outline-secondary btn-plus" data-id="<?php echo $producto->productos_id; ?>" type="button" id="button-addon1"><i class="fas fa-plus"></i></button>
                                                                </div>



                                                            </div>
                                                        </div>

                                                        <div class="col-12 text-right text-end">
                                                            <a class="btn-eliminar-carrito" data-id="<?php echo $producto->productos_id; ?>" onclick="recarga()"><i class="fas fa-trash-alt eliminar"></i></a>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <script type="text/javascript">
                                    function recarga() {
                                        setTimeout(function() {
                                            window.location = window.location;
                                        }, 1000);
                                    }
                                </script>
                                <div class="total-carrito">
                                    <div class="row align-items-center">
                                        <div class="col-12 text-right text-end">
                                            <div class="row">
                                                <div class="col-9" align="right">
                                                    <h5 class="margen_subtotal">Subtotal: </h5>
                                                </div>
                                                <?php $valortottal =  $carrito['cantidad'] * $producto->productos_precio;  ?>
                                                <div class="valor-total-carrito col-3" id="totalpagar" align="right">
                                                    $<?php echo number_format($valortotal2); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="caja_gris">
                                <h3 class="titulo-verde1">Información del socio</h3>
                                <div class="row">
                                    <div class="col-lg-3 form-group">
                                        <label for="">Tipo documento:</label>
                                        <select name="pedido_tipodocumento" id="pedido_tipodocumento" class="form-control form-control-sm" required>
                                            <option value="CC" <?php if ($this->socio->socio_tipo_documento == "CC") {
                                                                    echo 'selected';
                                                                } ?>>CC</option>
                                            <option value="CE" <?php if ($this->socio->socio_tipo_documento == "CE") {
                                                                    echo 'selected';
                                                                } ?>>CE</option>
                                            <option value="PS" <?php if ($this->socio->socio_tipo_documento == "PS") {
                                                                    echo 'selected';
                                                                } ?>>PASAPORTE</option>
                                            <option value="NIT" <?php if ($this->socio->socio_tipo_documento == "NIT") {
                                                                    echo 'selected';
                                                                } ?>>NIT</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 form-group">
                                        <label for="">No. Documento</label>
                                        <input type="text" name="pedido_documento" value="<?php echo $this->socio->socio_cedula; ?>" id="pedido_documento" class="form-control form-control-sm" required readonly>
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="">Nombre completo</label>
                                        <input type="text" name="pedido_nombre" id="pedido_nombre" value="<?php echo $this->socio->socio_nombre; ?>" class="form-control form-control-sm" required readonly>
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label for="">Correo</label>
                                        <input type="email" name="pedido_correo" id="pedido_correo" value="<?php echo $this->socio->socio_correo; ?>" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-lg-4 form-group d-none">
                                        <label for="">Telefono Contacto</label>
                                        <input type="number" name="pedido_telefono" id="pedido_telefono" value="" class="form-control form-control-sm">
                                    </div>

                                    <div class="col-lg-4 form-group">
                                        <label for="">Celular contacto</label>
                                        <input type="number" name="pedido_celular" id="pedido_celular" value="<?php echo $this->socio->socio_celular; ?>" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label for="">Envío</label>
                                        <select name="pedido_forma_envio" id="pedido_forma_envio" class="form-control form-control-sm" onchange="forma_envio();" required>
                                            <option value="1">Domicilio</option>
                                            <option value="2">Recoger en el Club</option>
                                        </select>
                                    </div>

                                    <div class="col-12" id="div_recoger" style="display: none;">
                                        <br>
                                        <div class="alert alert-warning">Si elige esta opción, nos comunicaremos con usted al número de teléfono registrado, con el fin de informarle la hora para recoger el pedido en el Club<br>(Cr. 5 No. 78-75). </div>
                                    </div>

                                    <div class="col-12 margen_info div_direccion">
                                        <h3 class="titulo-verde1">Información de envío</h3>
                                    </div>
                                    <div class="col-lg-2 form-group div_direccion">
                                        <label for="">Nomenclatura</label>
                                        <select name="pedido_nomenclatura" id="pedido_nomenclatura" class="form-control form-control-sm" onchange="calcular_envio();" required>
                                            <option value="">Seleccione...</option>
                                            <option value="Avenida Calle">Avenida Calle</option>
                                            <option value="Avenida Carrera">Avenida Carrera</option>
                                            <option value="Calle">Calle</option>
                                            <option value="Carrera">Carrera</option>
                                            <option value="Diagonal">Diagonal</option>
                                            <option value="Transversal">Transversal</option>
                                        </select>
                                        <div class="ejemplo">Ej: Carrera</div>
                                    </div>
                                    <div class="col-lg-10 form-group div_direccion">
                                        <label for="">Dirección</label>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <input type="number" class="form-control form-control-sm" name="numero1" id="numero1" placeholder="número" onchange="calcular_envio();" onkeyup="calcular_envio();" min="1" required>
                                                <div class="ejemplo">7</div>
                                            </div>
                                            <div class="col-lg-2">
                                                <input type="text" class="form-control form-control-sm" name="letra1" placeholder="letra">
                                                <div class="ejemplo">A</div>
                                            </div>
                                            <div class="col-lg-1 col-lg-05 text-center">
                                                #
                                            </div>
                                            <div class="col-lg-2">
                                                <input type="number" class="form-control form-control-sm" name="numero2" id="numero2" onchange="calcular_envio();" onkeyup="calcular_envio();" placeholder="número" min="1" required>
                                                <div class="ejemplo">78</div>
                                            </div>
                                            <div class="col-lg-2">
                                                <input type="text" class="form-control form-control-sm" name="letra2" placeholder="letra">
                                                <div class="ejemplo">B</div>
                                            </div>
                                            <div class="col-lg-1 col-lg-05 text-center">
                                                -
                                            </div>
                                            <div class="col-lg-2">
                                                <input type="number" class="form-control form-control-sm" name="numero3" id="numero3" min="1" placeholder="número" required>
                                                <div class="ejemplo">96</div>
                                            </div>
                                            <div class="col-lg-4">
                                                <textarea name="complemento" id="complemento" class="form-control form-control-sm" placeholder="complemento" onchange="calcular_envio();" onkeyup="calcular_envio();"></textarea>
                                                <div class="ejemplo">Apartamento, casa, piso, interior, otros.</div>
                                            </div>
                                            <div class="col-lg-7">
                                                <textarea name="indicaciones" id="indicaciones" class="form-control form-control-sm" placeholder="indicaciones" onchange="calcular_envio();" onkeyup="calcular_envio();"></textarea>
                                                <div class="ejemplo">Indicaciones adicionales para llegar al domicilio</div>
                                            </div>
                                            <input type="hidden" name="pedido_estado" id="pedido_estado" value="2" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 form-group d-none">
                                        <label for="pedido_ciudad" class="control-label">Ciudad</label>
                                        <select name="pedido_ciudad" id="pedido_ciudad" class="form-control form-control-sm">
                                            <option value="">Seleccione...</option>
                                            <?php foreach ($this->ciudades as $key => $ciudad) { ?>
                                                <option value="<?php echo utf8_encode($ciudad->nombre); ?>"><?php echo utf8_encode($ciudad->nombre);
                                                                                                            ($ciudad->departamento) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-12 margen_info">
                                        <h3 class="titulo-verde1">Información de pago</h3>
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label for="">Método de pago</label>
                                        <select name="pedido_medio" id="pedido_medio" class="form-control form-control-sm" onchange="metodo_pago();" required>
                                            <option value=""></option>
                                            <option value="1">Cargo a la acción</option>
                                            <option value="2">Pago en línea</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="mensaje-autorizacion margen_politica">
                                            <div class="form-check" required>
                                                <input class="form-check-input" type="checkbox" id="gridCheck" required><a class="terminos" href="#ventana" data-toggle="modal"> Acepto términos y condiciones</a><br><br>

                                                <div class="alert alert-light"><?php echo $this->terminos->contenido_descripcion; ?></div>

                                                <label class="form-check-label" for="gridCheck">
                                                    <div class="modal fade" id="ventana">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" align="center"><?php echo $this->terminos->contenido_titulo; ?></h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <i class="far fa-times-circle"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p><?php echo $this->terminos->contenido_descripcion; ?> </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>

                                        </div>


                                        <div class="mensaje-autorizacion margen_politica" id="div_terminos2" style="display: none;">
                                            <div class="form-check" required>
                                                <input class="form-check-input" type="checkbox" id="gridCheck2" required><a class="terminos" href="#ventana21" data-toggle="modal"> Autorizo cargar a mi acción el valor total del servicio de domicilio (Nogal Delivery) solicitado a través de esta plataforma.</a>
                                                <label class="form-check-label" for="gridCheck2">
                                                    <div class="modal fade" id="ventana2">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" align="center"><?php echo $this->terminos->contenido_titulo; ?></h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <i class="far fa-times-circle"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p><?php echo $this->terminos->contenido_descripcion; ?> </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="row" style="margin-top:30px;">
                                            <div class="col-lg-12 text-right text-end">
                                                <h3 class="titulo-envio">Costo de envío: <span id="pedido_enviocosto"></span></h3><br>
                                                <h3 class="titulo-total">Total a pagar: <span id="pedido_valorpagar"></span></h3>
                                            </div>
                                        </div>
                                        <input type="hidden" id="pedido_valorpagar1" name="pedido_valorpagar1">

                                        <div id="error1"></div>

                                        <div class="col-12" align="center" id="div-comprar">
                                            <button type="submit" id="capturarvalortotal" class="btn-pagar">Pagar</button>
                                        </div>

                                    </div>

                                    <input type="hidden" name="pedido_zona" id="pedido_zona" value="">
                                    <input type="hidden" name="pedido_envio" id="pedido_envio" value="0">
                        </form>
                    </div>
                <?php } else { ?>
                    <div class="mensaje-alert" align="center">
                        <br>
                        <h3 class="titulo-verde1">No hay productos en tu carrito</h3>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
    function calcular_envio() {
        var nomenclatura = $("#pedido_nomenclatura").val();
        var numero1 = $("#numero1").val();
        var numero2 = $("#numero2").val();
        var complemento = $("#complemento").val();
        $.post("/page/compra/calcularenvio", {
            "nomenclatura": nomenclatura,
            "numero1": numero1,
            "numero2": numero2,
            "complemento": complemento
        }, function(res) {


            var total = 0;
            var cantidadtotal = 0;
            var envio = res.valor * 1;
            var forma = $("#pedido_forma_envio").val();
            if (forma == "2") {
                envio = 0;
            }
            $("#error1").html("");


            $(".btn-minus").each(function() {
                var id = $(this).attr("data-id");
                var cantidad = $("#cantidad" + id).val();
                var valorunitario = $("#valorunitario" + id).val();
                var valortotal = parseInt(valorunitario) * parseInt(cantidad);
                total = parseInt(total) + parseInt(valortotal);
                cantidadtotal = parseInt(cantidadtotal) + parseInt(cantidad);
            });
            var valorpagar = parseInt(envio) + total;

            function addCommas(nStr) {
                nStr += '';
                x = nStr.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }

            $("#pedido_valorpagar").html("$ " + addCommas(parseInt(valorpagar)) + " COP");
            $("#pedido_enviocosto").html("$ " + addCommas(parseInt(envio)) + " COP");
            $("#pedido_valorpagar1").val(parseInt(valorpagar));

            $("#capturarvalortotal").show();

            if (res.error != "0") {
                if (numero1 != "" && numero2 != "" && nomenclatura != "") {
                    $("#error1").html("<div class='alert alert-danger text-center'>Lo sentimos. El rango de cobertura para entrega a domicilio no incluye esta zona.</div>");
                    $("#capturarvalortotal").hide();
                }
            }

            $("#pedido_zona").val(res.zona_nombre);
            $("#pedido_envio").val(envio);

        });
    }

    function forma_envio() {
        var forma = $("#pedido_forma_envio").val();
        if (forma == "2") { //recoger en club
            $(".div_direccion").hide();
            $("#pedido_nomenclatura").prop("required", false);
            $("#numero1").prop("required", false);
            $("#numero2").prop("required", false);
            $("#numero3").prop("required", false);
            $("#numero1").val("");
            $("#numero2").val("");
            $("#numero3").val("");
            $("#div_recoger").show();
        } else {
            $(".div_direccion").show();
            $("#pedido_nomenclatura").prop("required", true);
            $("#numero1").prop("required", true);
            $("#numero2").prop("required", true);
            $("#numero3").prop("required", true);
            $("#div_recoger").hide();
        }
        calcular_envio();
    }

    function metodo_pago() {
        var metodo = $("#pedido_medio").val();
        if (metodo == "2" || metodo == "") {
            $("#div_terminos2").hide();
            $("#gridCheck2").prop("required", false);
        } else {
            $("#div_terminos2").show();
            $("#gridCheck2").prop("required", true);
        }
    }

    function ocultar_error() {
        $("#error2").hide();
        $("#error3").hide();
    }
</script>