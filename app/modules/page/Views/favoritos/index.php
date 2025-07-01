<div class="row no-gutters">
    <div class="col-md-1"></div>
    <div class="col-md-9 my-4">
        <div class="container-fluid favoritos">
            <div class="row">
                <?php foreach ($this->favoritos as $key => $favorito) { ?>
                    <?php foreach ($this->tiendas as $key2 => $tienda) { ?>
                        <?php if ($favorito->favoritos_tienda == $tienda->tiendas_id) { ?>
                            <?php $cont = 0; ?>
                            <div class="col-md-4 mt-4">
                                <?php foreach ($this->categorias as $key3 => $categoria) { ?> <?php if ($tienda->tiendas_categoria == $categoria->categorias_id) { ?><a href="/page/tienda?id=<?php echo $tienda->tiendas_id ?>&&categoria=<?php echo $categoria->categorias_id ?>"><?php } ?> <?php } ?>
                                    <div class="caja-tienda">
                                        <?php foreach ($this->categorias as $key4 => $categoria) { ?> <?php if ($tienda->tiendas_categoria == $categoria->categorias_id) { ?> <img src="/images/<?php echo $categoria->categorias_imagen_techo ?>" alt=""><?php } ?> <?php } ?>
                                        <div id="carousel<?php echo $tienda->tiendas_id ?>" class="carousel slide"
                                            data-bs-interval="false" data-bs-ride="carousel">
                                            <div class="carousel-inner prod">
                                                <div class="carousel-item active img-productos mb-2">
                                                    <img class="" src="/images/<?php echo $tienda->tiendas_imagen ?>" alt="">
                                                </div>
                                                <?php foreach ($this->productos as $key2 => $value2) { ?>
                                                    <?php if ($value2->productos_tienda == $tienda->tiendas_id) { ?>
                                                        <div class="carousel-item img-productos mb-2">
                                                            <img class="" src="/images/<?php echo $value2->productos_imagen ?>" alt="">
                                                        </div>

                                                        <?php $cont++; ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                            <button class="carousel-control-prev" href="#carousel<?php echo $tienda->tiendas_id ?>"
                                                role="button" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                        </a>
                                        <button class="carousel-control-next" href="#carousel<?php echo $tienda->tiendas_id ?>"
                                            role="button" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                            </a>
                            </div>
                            <div class="caja-texto px-3 pb-2">
                                <div class="titulo-tienda text-left">
                                    <h4><?php echo $tienda->tiendas_nombre ?></h4>
                                </div>
                                <div class="datos-tienda pb-3">
                                    <?php if ($tienda->tiendas_pagina != "") { ?>
                                        <span><a href="http://<?php echo enlacepagina($tienda->tiendas_pagina) ?>" target="_blank"><?php echo $tienda->tiendas_pagina ?></a></span>
                                    <?php } ?>
                                    <?php if ($tienda->tiendas_facebook != "") { ?>
                                        <span><a href="https://www.facebook.com/<?php echo enlaceredes($tienda->tiendas_facebook) ?>" target="_blank">facebook/<?php echo enlaceredes($tienda->tiendas_facebook) ?></a></span>
                                    <?php } ?>
                                    <?php if ($tienda->tiendas_instagram != "") { ?>
                                        <span>Instagram: <a href="https://www.instagram.com/<?php echo enlaceredes($tienda->tiendas_instagram) ?>" target="_blank">@<?php echo enlaceredes($tienda->tiendas_instagram) ?></a></span>
                                    <?php } ?>
                                    <?php if ($tienda->tiendas_telefono != "") { ?>
                                        <?php $telefono = intval(preg_replace('/[^0-9]+/', '', $tienda->tiendas_telefono), 10);  ?>
                                        <span>Teléfono:<a href="tel:<?php echo $telefono ?>" target="_blank"> <?php echo $tienda->tiendas_telefono ?></a></span>
                                    <?php } ?>
                                    <?php if ($tienda->tiendas_telefono2 != "") { ?>
                                        <?php $telefono2 = intval(preg_replace('/[^0-9]+/', '', $tienda->tiendas_telefono2), 10);  ?>
                                        <span>Teléfono:<a href="tel:<?php echo $telefono2 ?>" target="_blank"> <?php echo $tienda->tiendas_telefono2 ?></a></span>
                                    <?php } ?>
                                </div>

                                <div class="whatsapp-tienda">
                                    <?php if ($tienda->tiendas_whatsapp != "") { ?>
                                        <?php $whatsapp = intval(preg_replace('/[^0-9]+/', '', $tienda->tiendas_whatsapp), 10);  ?>
                                        <a class="btn-whatsapp"
                                            style="background-color:<?php foreach ($this->categorias as $key4 => $categoria) { ?> <?php if ($tienda->tiendas_categoria == $categoria->categorias_id) { ?><?php echo $categoria->categorias_color ?><?php } ?> <?php } ?>"
                                            href="https://api.whatsapp.com/send?phone=57<?php echo $whatsapp; ?>"
                                            target="_blank">
                                            <span>Para comprar contáctese a este enlace</span>
                                        </a>
                                    <?php } else if ($tienda->tiendas_pagina != "") { ?>
                                        <a class="btn-whatsapp"
                                            style="background-color:<?php foreach ($this->categorias as $key5 => $categoria) { ?> <?php if ($tienda->tiendas_categoria == $categoria->categorias_id) { ?><?php echo $categoria->categorias_color ?><?php } ?> <?php } ?>"
                                            href="http://<?php echo enlacepagina($tienda->tiendas_pagina) ?>" target="_blank">
                                            <span>Para comprar contáctese a este enlace</span>
                                        </a>
                                    <?php } else if ($tienda->tiendas_facebook != "") { ?>
                                        <a class="btn-whatsapp"
                                            style="background-color:<?php foreach ($this->categorias as $key5 => $categoria) { ?> <?php if ($tienda->tiendas_categoria == $categoria->categorias_id) { ?><?php echo $categoria->categorias_color ?><?php } ?> <?php } ?>"
                                            href="https://www.facebook.com/<?php echo enlaceredes($tienda->tiendas_facebook) ?>" target="_blank">
                                            <span>CPara comprar contáctese a este enlace</span>
                                        </a>
                                    <?php } else if ($tienda->tiendas_instagram != "") { ?>
                                        <a class="btn-whatsapp"
                                            style="background-color:<?php foreach ($this->categorias as $key6 => $categoria) { ?> <?php if ($tienda->tiendas_categoria == $categoria->categorias_id) { ?><?php echo $categoria->categorias_color ?><?php } ?> <?php } ?>"
                                            href="https://www.instagram.com/<?php echo enlaceredes($tienda->tiendas_instagram) ?>" target="_blank">
                                            <span>Para comprar contáctese a este enlace</span>
                                        </a>
                                    <?php } else { ?>
                                        <?php $telefono = intval(preg_replace('/[^0-9]+/', '', $tienda->tiendas_telefono), 10);  ?>
                                        <a class="btn-whatsapp"
                                            style="background-color:<?php foreach ($this->categorias as $key7 => $categoria) { ?> <?php if ($tienda->tiendas_categoria == $categoria->categorias_id) { ?><?php echo $categoria->categorias_color ?><?php } ?> <?php } ?>"
                                            href="tel:<?php echo $telefono; ?>" target="_blank">
                                            <span>Contactar por teléfono</span>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
            </div>
            </a>
        </div>
    <?php } ?>
<?php } ?>
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
                                <?php if ($otro->contenido_vermas) { ?><?php echo $otro->contenido_vermas; ?><?php } else { ?>Ver
                                Más<?php } ?></a>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>
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