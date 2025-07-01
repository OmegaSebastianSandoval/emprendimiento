<div class="row no-gutters">
    <div class="col-md-1"></div>
    <div class="col-md-9">
        <div class="banner">
            <img src="/images/<?php echo $this->categorias->categorias_banner ?>" alt="">
        </div>
        <div class="container-fluid">
            <div class="row my-4">
                <a class="btn-volver py-1"
                    href="/page/categoria?id=<?php echo $this->categorias->categorias_id ?>">Volver</a>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="caja-imagen-tienda"
                        style="border-color:<?php echo $this->categorias->categorias_color ?>">
                        <div class="caja-tienda2">
                            <img src="/images/<?php echo $this->categorias->categorias_imagen_techo ?>" alt="">
                            <div>
                                <img class="px-4 imagen-tienda-int"
                                    src="/images/<?php echo $this->tienda->tiendas_imagen ?>" alt="">
                            </div>
                            <h3><?php echo $this->tienda->tiendas_nombre ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="caja-tienda-texto p-4">
                        <div id="favorito" class="text-right text-end">
                            <input type="hidden" value="<?php if (count($this->favoritos) > 0) {
                                echo 1;
                            } else {
                                echo 0;
                            } ?>" id="estado-favorito">
                            <i class="fa-solid fa-heart <?php if (count($this->favoritos) > 0) {
                                echo 'activo-favorito';
                            } ?>"
                                aria-hidden="true"></i>
                        </div>
                        <div class="descripcion-tienda">
                            <?php echo $this->tienda->tiendas_descripcion ?>
                        </div>
                        <div class="datos-tienda py-3">
                            <?php if ($this->tienda->tiendas_pagina != "") { ?>
                                        <span><a href="http://<?php echo enlacepagina($this->tienda->tiendas_pagina) ?>"
                                                target="_blank"><?php echo $this->tienda->tiendas_pagina ?></a></span><br>
                            <?php } ?>
                            <?php if ($this->tienda->tiendas_facebook != "") { ?>
                                        <span><a href="https://www.facebook.com/<?php echo enlaceredes($this->tienda->tiendas_facebook) ?>"
                                                target="_blank">facebook/<?php echo enlaceredes($this->tienda->tiendas_facebook) ?></a></span><br>
                            <?php } ?>
                            <?php if ($this->tienda->tiendas_instagram != "") { ?>
                                        <span>Instagram: <a
                                                href="https://www.instagram.com/<?php echo enlaceredes($this->tienda->tiendas_instagram) ?>"
                                                target="_blank">@<?php echo enlaceredes($this->tienda->tiendas_instagram) ?></a></span><br>
                            <?php } ?>
                            <?php if ($this->tienda->tiendas_telefono != "") { ?>
                                        <?php $telefono = intval(preg_replace('/[^0-9]+/', '', $this->tienda->tiendas_telefono), 10); ?>
                                        <span>Teléfono:<a href="tel:<?php echo $telefono ?>" target="_blank">
                                                <?php echo $this->tienda->tiendas_telefono ?></a></span><br>
                            <?php } ?>
                            <?php if ($this->tienda->tiendas_telefono2 != "") { ?>
                                        <?php $telefono2 = intval(preg_replace('/[^0-9]+/', '', $this->tienda->tiendas_telefono2), 10); ?>
                                        <span>Teléfono opción 2:<a href="tel:<?php echo $telefono2 ?>" target="_blank">
                                                <?php echo $this->tienda->tiendas_telefono2 ?></a></span>
                            <?php } ?>
                        </div>
                        <div class="whatsapp-tienda">
                            <?php if ($this->tienda->tiendas_whatsapp != "") { ?>
                                        <?php $whatsapp = intval(preg_replace('/[^0-9]+/', '', $this->tienda->tiendas_whatsapp), 10); ?>
                                        <a class="btn-whatsapp2"
                                            style="background-color:<?php echo $this->categorias->categorias_color ?>"
                                            href="https://api.whatsapp.com/send?phone=57<?php echo $whatsapp; ?>" target="_blank">
                                            <span>Para comprar contáctese a este enlace</span>
                                        </a>
                                    <?php
                                    $enlace = "https://api.whatsapp.com/send?phone=57" . $whatsapp;
                            } else if ($this->tienda->tiendas_pagina != "") { ?>
                                                <a class="btn-whatsapp2"
                                                    style="background-color:<?php echo $this->categorias->categorias_color ?>"
                                                    href="http://<?php echo enlacepagina($this->tienda->tiendas_pagina) ?>"
                                                    target="_blank">
                                                    <span>Para comprar contáctese a este enlace</span>
                                                </a>
                                            <?php
                                            $enlace = "https://www.facebook.com/" . enlaceredes($this->tienda->tiendas_facebook);
                            } else if ($this->tienda->tiendas_facebook != "") { ?>
                                                        <a class="btn-whatsapp2"
                                                            style="background-color:<?php echo $this->categorias->categorias_color ?>"
                                                            href="https://www.facebook.com/<?php echo enlaceredes($this->tienda->tiendas_facebook) ?>"
                                                            target="_blank">
                                                            <span>Para comprar contáctese a este enlace</span>
                                                        </a>
                                            <?php
                                            $enlace = "https://www.facebook.com/" . enlaceredes($this->tienda->tiendas_facebook);
                            } else if ($this->tienda->tiendas_instagram != "") { ?>
                                                                <a class="btn-whatsapp2"
                                                                    style="background-color:<?php echo $this->categorias->categorias_color ?>"
                                                                    href="https://www.instagram.com/<?php echo enlaceredes($this->tienda->tiendas_instagram) ?>"
                                                                    target="_blank">
                                                                    <span>Para comprar contáctese a este enlace</span>
                                                                </a>
                            <?php } else { ?>
                                        <?php $telefono = intval(preg_replace('/[^0-9]+/', '', $this->tienda->tiendas_telefono), 10); ?>
                                                                <a class="btn-whatsapp2"
                                                                    style="background-color:<?php echo $this->categorias->categorias_color ?>"
                                                                    href="tel:<?php echo $telefono; ?>" target="_blank">
                                                                    <span>Para comprar contáctese a este enlace</span>
                                                                </a>
                                            <?php
                                            $enlace = "tel:" . $telefono;
                            } ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-4">
                <?php foreach ($this->productos as $key => $producto) { ?>
                            <div class="col-md-4 pt-4">
                                <div class="caja-producto p-3">
                                    <div class="text-center">
                                        <img src="/images/<?php echo $producto->productos_imagen ?>" alt="">
                                    </div>
                                    <div class="descripcion-producto mt-2" id="des-prod">
                                        <h6><?php echo $producto->productos_nombre ?></h6>
                                        <span class="valor" style="color:<?php echo $this->categorias->categorias_color ?>">
                                            <?php if ($producto->productos_precio != "") { ?>
                                                        Valor:
                                                        <?php echo $producto->productos_precio ?></span>
                                    <?php } ?>
                                    <div class="des">
                                        <?php echo $producto->productos_descripcion ?>
                                    </div>

                                    </div>
                                    <div class="caja-vermas-producto">
                                        <a href="#" data-target="#detalle-producto<?php echo $producto->productos_id ?>"
                                            data-toggle="modal" data-id=" <?php echo $producto->productos_id ?>"
                                            class="vermas-producto">Ver mas</a>
                                    </div>
                                    <div class="modal fade modal-prod" id="detalle-producto<?php echo $producto->productos_id ?>"
                                        tabindex="-1" role="dialog" aria-labelledby="detalle-productoLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class=" img-modal-prod">

                                                                <img src="/images/<?php echo $producto->productos_imagen ?>" class="img-producto" alt="">

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="descripcion-producto-modal px-3">
                                                                <h4><?php echo $producto->productos_nombre ?></h2>
                                                                    <?php echo $producto->productos_descripcion ?>
                                                                    <span class="valor"
                                                                        style="color:<?php echo $this->categorias->categorias_color ?>">

                                                                        <?php if ($producto->productos_precio != "") { ?>
                                                                                    Valor:
                                                                                    <?php echo $producto->productos_precio ?></span>
                                                                <?php } ?>
                                                                <div class="datos-tienda py-3">
                                                                    <h6><strong> Datos de contacto</strong></h6>
                                                                    <?php if ($this->tienda->tiendas_pagina != "") { ?>
                                                                                <span><a href="http://<?php echo enlacepagina($this->tienda->tiendas_pagina) ?>"
                                                                                        target="_blank"><?php echo $this->tienda->tiendas_pagina ?></a></span><br>
                                                                    <?php } ?>
                                                                    <?php if ($this->tienda->tiendas_facebook != "") { ?>
                                                                                <span><a href="https://www.facebook.com/<?php echo enlaceredes($this->tienda->tiendas_facebook) ?>"
                                                                                        target="_blank">facebook/<?php echo enlaceredes($this->tienda->tiendas_facebook) ?></a></span><br>
                                                                    <?php } ?>
                                                                    <?php if ($this->tienda->tiendas_instagram != "") { ?>
                                                                                <span>Instagram: <a
                                                                                        href="https://www.instagram.com/<?php echo enlaceredes($this->tienda->tiendas_instagram) ?>"
                                                                                        target="_blank">@<?php echo enlaceredes($this->tienda->tiendas_instagram) ?></a></span><br>
                                                                    <?php } ?>
                                                                    <?php if ($this->tienda->tiendas_telefono != "") { ?>
                                                                                <?php $telefono = intval(preg_replace('/[^0-9]+/', '', $this->tienda->tiendas_telefono), 10); ?>
                                                                                <span>Teléfono:<a href="tel:<?php echo $telefono ?>" target="_blank">
                                                                                        <?php echo $this->tienda->tiendas_telefono ?></a></span><br>
                                                                    <?php } ?>
                                                                    <?php if ($this->tienda->tiendas_telefono2 != "") { ?>
                                                                                <?php $telefono2 = intval(preg_replace('/[^0-9]+/', '', $this->tienda->tiendas_telefono2), 10); ?>
                                                                                <span>Teléfono opción 2:<a href="tel:<?php echo $telefono2 ?>" target="_blank">
                                                                                        <?php echo $this->tienda->tiendas_telefono2 ?></a></span>
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="whatsapp-tienda mt-4">
                                                                    <?php if ($this->tienda->tiendas_whatsapp != "") { ?>
                                                                                <?php $whatsapp = intval(preg_replace('/[^0-9]+/', '', $this->tienda->tiendas_whatsapp), 10); ?>
                                                                                <a class="btn-whatsapp2"
                                                                                    style="background-color:<?php echo $this->categorias->categorias_color ?>"
                                                                                    href="https://api.whatsapp.com/send?phone=57<?php echo $whatsapp; ?>"
                                                                                    target="_blank">
                                                                                    <span>Para comprar contáctese a este enlace</span>
                                                                                </a>
                                                                            <?php
                                                                            $enlace = "https://api.whatsapp.com/send?phone=57" . $whatsapp;
                                                                    } else if ($this->tienda->tiendas_facebook != "") { ?>
                                                                                        <a class="btn-whatsapp2"
                                                                                            style="background-color:<?php echo $this->categorias->categorias_color ?>"
                                                                                            href="https://www.facebook.com/<?php echo enlaceredes($this->tienda->tiendas_facebook) ?>"
                                                                                            target="_blank">
                                                                                            <span>Para comprar contáctese a este enlace</span>
                                                                                        </a>
                                                                                    <?php
                                                                                    $enlace = "https://www.facebook.com/" . enlaceredes($this->tienda->tiendas_facebook);
                                                                    } else if ($this->tienda->tiendas_instagram != "") { ?>
                                                                                                <a class="btn-whatsapp2"
                                                                                                    style="background-color:<?php echo $this->categorias->categorias_color ?>"
                                                                                                    href="https://www.instagram.com/<?php echo enlaceredes($this->tienda->tiendas_instagram) ?>"
                                                                                                    target="_blank">
                                                                                                    <span>Para comprar contáctese a este enlace</span>
                                                                                                </a>
                                                                    <?php } else { ?>
                                                                                <?php $telefono = intval(preg_replace('/[^0-9]+/', '', $this->tienda->tiendas_telefono), 10); ?>
                                                                                                <a class="btn-whatsapp2"
                                                                                                    style="background-color:<?php echo $this->categorias->categorias_color ?>"
                                                                                                    href="tel:<?php echo $telefono; ?>" target="_blank">
                                                                                                    <span>Para comprar contáctese a este enlace</span>
                                                                                                </a>
                                                                                    <?php
                                                                                    $enlace = "tel:" . $telefono;
                                                                    } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="items-index">
            <div class="row no-gutters">
                <div class="col-12 actividades p-3 ">
                    <?php if ($this->actividadesVirtualesPadre->contenido_titulo_ver == 1) { ?>
                                <div class="titulo-index"> <span><?php echo $this->actividadesVirtualesPadre->contenido_titulo ?>
                                        <hr>
                                    </span> </div>
                    <?php } ?>
                    <?php if ($this->actividadesVirtuales->contenido_imagen != "") { ?>
                                <img src="/images/<?php echo $this->actividadesVirtuales->contenido_imagen ?>" alt="">
                    <?php } ?>
                    <div class="descripcion-index">
                        <?php if ($this->actividadesVirtuales->contenido_titulo_ver == 1) { ?>
                                    <h2><?php echo $this->actividadesVirtuales->contenido_titulo; ?></h2>
                        <?php } ?>
                        <?php echo $this->actividadesVirtuales->contenido_descripcion ?>
                    </div>
                </div>
                <div class="col-12 tarima p-3">
                    <?php if ($this->enTarimaPadre->contenido_titulo_ver == 1) { ?>
                                <div class="titulo-index"> <span><?php echo $this->enTarimaPadre->contenido_titulo ?>
                                        <hr>
                                    </span> </div>
                    <?php } ?>

                    <?php foreach ($this->enTarima as $key2 => $Tarima) { ?>

                                <?php if ($Tarima->contenido_imagen != "") { ?>
                                            <img src="/images/<?php echo $Tarima->contenido_imagen ?>" alt="">
                                <?php } ?>
                                <div class="descripcion-index">
                                    <?php if ($Tarima->contenido_titulo_ver == 1) { ?>
                                                <h2><?php echo $Tarima->contenido_titulo; ?></h2>
                                    <?php } ?>
                                    <?php echo $Tarima->contenido_descripcion ?>
                                </div>
                    <?php } ?>
                </div>

                <div class="col-12 otros p-3">
                    <?php if ($this->otrosPadre->contenido_titulo_ver == 1) { ?>
                                <div class="titulo-index"> <span><?php echo $this->otrosPadre->contenido_titulo ?>
                                        <hr>
                                    </span> </div>
                    <?php } ?>

                    <?php foreach ($this->otros as $key3 => $otro) { ?>

                                <?php if ($otro->contenido_imagen != "") { ?>
                                            <img src="/images/<?php echo $otro->contenido_imagen ?>" alt="">
                                <?php } ?>
                                <div class="descripcion-index">
                                    <?php if ($otro->contenido_titulo_ver == 1) { ?>
                                                <h2><?php echo $otro->contenido_titulo; ?></h2>
                                    <?php } ?>
                                    <?php echo $otro->contenido_descripcion ?>

                                </div>
                                <?php if ($otro->contenido_enlace) { ?>
                                            <div>
                                                <a href="<?php echo $otro->contenido_enlace ?>"
                                                    <?php if ($otro->contenido_enlace_abrir == 1) { ?> target="blank" <?php } ?>
                                                    class="btn btn-block btn-vermas-index">
                                                    <?php if ($otro->contenido_vermas) { ?>                        <?php echo $otro->contenido_vermas; ?>                <?php } else { ?>Ver
                                                            Más<?php } ?></a>
                                            </div>
                                <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $("#favorito i").click(function() {
        $(this).toggleClass("activo-favorito");
        var estado = $("#estado-favorito").val();
        var usuario = '<?php echo $_SESSION["kt_login_id"] ?>';
        var tienda = '<?php echo $this->tienda_id ?>';
        $.post("/page/tienda/cambiarestado", {
            "estado": estado,
            "tienda": tienda,
            "usuario": usuario
        }, function(res) {});
    });
</script>
<?php
function enlaceredes($x)
{
    $x = str_replace("@", "", $x);
    $x = str_replace("https://www.instagram.com", "", $x);
    $x = str_replace("https://es-la.facebook.com", "", $x);
    $x = str_replace("facebook.com", "", $x);
    $x = str_replace("instagram.com", "", $x);

    $x = str_replace("/", "", $x);
    $x = str_replace("https:m.", "", $x);
    $x = str_replace("https:www.", "", $x);
    $x = str_replace("www.", "", $x);
    $x = str_replace(" ", "_", $x);
    return $x;
}
function enlacepagina($x)
{
    $x = str_replace("https://", "", $x);
    $x = str_replace("http://", "", $x);
    return $x;
}

?>
<script>
    $(document).ready(function() {
        $('.img-producto')
            .wrap('<span style="display:inline-block"></span>')
            .css('display', 'block')
            .parent()
            .zoom();
    });
</script>
<!-- Modal -->