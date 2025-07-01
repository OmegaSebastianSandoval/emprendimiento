<div class="banner">
    <img src="/images/<?php echo $this->categoria->categorias_banner ?>" alt="">
</div>
<div class="container">
    <a id="a" name="a"></a>
    <div class="container categoria">
        <form action="/page/categoria?id=<?php echo $this->id ?>" id="form-order" method="post">
            <div class="row my-4">
                <div class="offset-md-8 col-md-4 caja-buscar">
                    <div class="form-group row no-gutters m-0 py-2">
                        <div class="offset-sm-3 col-sm-3 d-flex align-items-center justify-content-center">
                            <label for="ordenar">Ordenar Por</label>
                        </div>
                        <div class="col-sm-6 d-flex align-items-center">
                            <select class="form-control" name="ordenar" id="ordenar">
                                <option value="ninguno">Ninguno</option>
                                <option <?php if ($this->orden == "recientes") {
                                    echo "selected ";
                                } ?>value="recientes">Recientes</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row mb-5">
            <?php if (is_countable($this->tiendas) && count($this->tiendas) > 0) { ?>
                <?php if ($this->categoria->categorias_id != 12) { ?>
                    <?php foreach ($this->tiendas as $key => $value) { ?>
                        <?php foreach ($this->productos as $key3 => $value3) { ?>
                            <?php if ($value3->productos_tienda == $value->tiendas_id) { ?>
                                <?php $cont = 0; ?>
                                <div class="col-md-4 mt-4">
                                    <div class="caja-tienda">
                                        <div align="center"><img src="/images/<?php echo $this->categoria->categorias_imagen_techo ?>"
                                                alt=""></div>
                                        <a
                                            href="/page/tienda?id=<?php echo $value->tiendas_id ?>&&categoria=<?php echo $this->categoria->categorias_id ?>">
                                            <div id="carousel<?php echo $value->tiendas_id ?>" class="carousel slide"
                                                data-bs-interval="false" data-bs-ride="false">
                                                <div class="carousel-inner prod">
                                                    <div class="carousel-item active img-productos mb-2">
                                                        <img class="" src="/images/<?php echo $value->tiendas_imagen ?>" alt="">
                                                    </div>
                                                    <?php foreach ($this->productos as $key2 => $value2) { ?>
                                                        <?php if ($value2->productos_tienda == $value->tiendas_id) { ?>
                                                            <?php if ($value2->productos_imagen && file_exists(IMAGE_PATH . $value2->productos_imagen)) { ?>

                                                                <div class="carousel-item img-productos mb-2">
                                                                    <img class="" src="/images/<?php echo $value2->productos_imagen ?>" alt="">
                                                                </div>
                                                                <?php $cont++; ?>
                                                            <?php } ?>

                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>

                                                <button class="carousel-control-prev"
                                                    data-bs-target="#carousel<?php echo $value->tiendas_id ?>" role="button"
                                                    data-bs-slide="prev">

                                                    <i class="fa-solid fa-chevron-left"></i>
                                                </button>
                                                <button class="carousel-control-next"
                                                    data-bs-target="#carousel<?php echo $value->tiendas_id ?>" role="button"
                                                    data-bs-slide="next">

                                                    <i class="fa-solid fa-chevron-right"></i>
                                                </button>
                                            </div>
                                        </a>

                                        <div class="caja-texto px-3 pb-2">
                                            <div class="titulo-tienda text-left">
                                                <h4><?php echo $value->tiendas_nombre ?></h4>
                                            </div>
                                            <div class="datos-tienda pb-3">
                                                <?php if ($value->tiendas_pagina != "" && enlacepagina($value->tiendas_pagina) != "") { ?>

                                                    <a href="http://<?php echo enlacepagina($value->tiendas_pagina) ?>" class="pagina"
                                                        target="_blank"><?php echo $value->tiendas_pagina ?></a>

                                                <?php } ?>
                                                <?php if ($value->tiendas_facebook != "" && enlaceredes($value->tiendas_facebook) != "") { ?>
                                                    <span>
                                                        <a class="facebook"
                                                            href="https://www.facebook.com/<?php echo enlaceredes($value->tiendas_facebook) ?>"
                                                            target="_blank">facebook/<?php echo enlaceredes($value->tiendas_facebook) ?></a>
                                                    </span>
                                                <?php } ?>
                                                <?php if ($value->tiendas_instagram != "" && enlaceredes($value->tiendas_instagram) != "") { ?>
                                                    <span class="insta">Instagram:
                                                        <a href="https://www.instagram.com/<?php echo enlaceredes($value->tiendas_instagram) ?>"
                                                            target="_blank">@<?php echo enlaceredes($value->tiendas_instagram) ?></a>
                                                    </span>
                                                <?php } ?>
                                                <?php if ($value->tiendas_telefono != "") { ?>
                                                    <?php $telefono = intval(preg_replace('/[^0-9]+/', '', $value->tiendas_telefono), 10); ?>
                                                    <span class="tel">Teléfono:<a href="tel:<?php echo $telefono ?>" target="_blank">
                                                            <?php echo $value->tiendas_telefono ?></a></span>
                                                <?php } ?>
                                                <?php if ($value->tiendas_telefono2 != "") { ?>
                                                    <?php $telefono2 = intval(preg_replace('/[^0-9]+/', '', $value->tiendas_telefono2), 10); ?>
                                                    <span class="tel">Teléfono opción 2:<a href="tel:<?php echo $telefono2 ?>" target="_blank">
                                                            <?php echo $value->tiendas_telefono2 ?></a></span>
                                                <?php } ?>
                                            </div>

                                            <div class="whatsapp-tienda">
                                                <?php if ($value->tiendas_whatsapp != "") { ?>
                                                    <?php $whatsapp = intval(preg_replace('/[^0-9]+/', '', $value->tiendas_whatsapp), 10); ?>
                                                    <a class="btn-whatsapp"
                                                        style="background-color:<?php echo $this->categoria->categorias_color ?>; color:#FFF; border:none;"
                                                        href="https://api.whatsapp.com/send?phone=57<?php echo $whatsapp; ?>" target="_blank">
                                                        <span>Para comprar contáctese a este enlace</span>
                                                    </a>
                                                <?php } else if ($value->tiendas_pagina != "") { ?>
                                                        <a class="btn-whatsapp"
                                                            style="background-color:<?php echo $this->categoria->categorias_color ?>; color:#FFF; border:none;"
                                                            href="http://<?php echo enlacepagina($value->tiendas_pagina) ?>" target="_blank">
                                                            <span>Para comprar contáctese a este enlace</span>
                                                        </a>
                                                <?php } else if ($value->tiendas_facebook != "") { ?>
                                                            <a class="btn-whatsapp"
                                                                style="background-color:<?php echo $this->categoria->categorias_color ?>; color:#FFF; border:none;"
                                                                href="https://www.facebook.com/<?php echo enlaceredes($value->tiendas_facebook) ?>"
                                                                target="_blank">
                                                                <span>Para comprar contáctese a este enlace</span>
                                                            </a>
                                                <?php } else if ($value->tiendas_instagram != "") { ?>
                                                                <a class="btn-whatsapp"
                                                                    style="background-color:<?php echo $this->categoria->categorias_color ?>; color:#FFF; border:none;"
                                                                    href="https://www.instagram.com/<?php echo enlaceredes($value->tiendas_instagram) ?>"
                                                                    target="_blank">
                                                                    <span>Para comprar contáctese a este enlace</span>
                                                                </a>
                                                <?php } else { ?>
                                                    <?php $telefono = intval(preg_replace('/[^0-9]+/', '', $value->tiendas_telefono), 10); ?>
                                                                <a class="btn-whatsapp"
                                                                    style="background-color:<?php echo $this->categoria->categorias_color ?>; color:#FFF; border:none;"
                                                                    href="tel:<?php echo $telefono; ?>" target="_blank">
                                                                    <span>Contactar por teléfono</span>
                                                                </a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php break; ?>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                <?php } else { ?>
                    <?php foreach ($this->tiendas as $key => $value) { ?>
                        <?php foreach ($this->cuadros as $key3 => $value3) { ?>
                            <?php if ($value3->cuadros_negocio == $value->tiendas_id) { ?>
                                <?php $cont = 0; ?>
                                <div class="col-md-4 mt-4">
                                    <a
                                        href="/page/galeria?id=<?php echo $value->tiendas_id ?>&&categoria=<?php echo $this->categoria->categorias_id ?>">
                                        <div class="caja-tienda">
                                            <img src="/images/<?php echo $this->categoria->categorias_imagen_techo ?>" alt="">
                                            <div id="carousel<?php echo $value->tiendas_id ?>" class="carousel slide"
                                                data-bs-interval="false" data-bs-ride="carousel">
                                                <div class="carousel-inner prod">
                                                    <div class="carousel-item active img-productos mb-2">
                                                        <img class="" src="/images/<?php echo $value->tiendas_imagen ?>" alt="">
                                                    </div>
                                                    <?php foreach ($this->cuadros as $key2 => $value2) { ?>
                                                        <?php if ($value2->cuadros_negocio == $value->tiendas_id) { ?>
                                                            <div class="carousel-item img-productos mb-2">
                                                                <img class="" src="/images/<?php echo $value2->cuadros_imagen ?>" alt="">
                                                            </div>
                                                            <?php $cont++; ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                                <button class="carousel-control-prev" href="#carousel<?php echo $value->tiendas_id ?>"
                                                    role="button" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" href="#carousel<?php echo $value->tiendas_id ?>"
                                                    role="button" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </button>
                                            </div>
                                            <div class="caja-texto px-3 pb-2">
                                                <div class="titulo-tienda text-left">
                                                    <h4><?php echo $value->tiendas_nombre ?></h4>
                                                </div>
                                                <div class="datos-tienda pb-3">
                                                    <?php if ($value->tiendas_pagina != "") { ?>
                                                        <span><a href="http://<?php echo enlacepagina($value->tiendas_pagina) ?>"
                                                                target="_blank"><?php echo $value->tiendas_pagina ?></a></span>
                                                    <?php } ?>
                                                    <?php if ($value->tiendas_facebook != "") { ?>
                                                        <span><a href="https://www.facebook.com/<?php echo enlaceredes($value->tiendas_facebook) ?>"
                                                                target="_blank">facebook/<?php echo enlaceredes($value->tiendas_facebook) ?></a></span>
                                                    <?php } ?>
                                                    <?php if ($value->tiendas_instagram != "") { ?>
                                                        <span>Instagram: <a
                                                                href="https://www.instagram.com/<?php echo enlaceredes($value->tiendas_instagram) ?>"
                                                                target="_blank">@<?php echo enlaceredes($value->tiendas_instagram) ?></a></span>
                                                    <?php } ?>
                                                    <?php if ($value->tiendas_telefono != "") { ?>
                                                        <?php $telefono = intval(preg_replace('/[^0-9]+/', '', $value->tiendas_telefono), 10); ?>
                                                        <span>Teléfono:<a href="tel:<?php echo $telefono ?>" target="_blank">
                                                                <?php echo $value->tiendas_telefono ?></a></span>
                                                    <?php } ?>
                                                    <?php if ($value->tiendas_telefono2 != "") { ?>
                                                        <?php $telefono2 = intval(preg_replace('/[^0-9]+/', '', $value->tiendas_telefono2), 10); ?>
                                                        <span>Teléfono opción 2:<a href="tel:<?php echo $telefono2 ?>" target="_blank">
                                                                <?php echo $value->tiendas_telefono2 ?></a></span>
                                                    <?php } ?>
                                                </div>

                                                <div class="whatsapp-tienda">
                                                    <?php if ($value->tiendas_whatsapp != "") { ?>
                                                        <?php $whatsapp = intval(preg_replace('/[^0-9]+/', '', $value->tiendas_whatsapp), 10); ?>
                                                        <a class="btn-whatsapp"
                                                            style="background-color:<?php echo $this->categoria->categorias_color ?>"
                                                            href="https://api.whatsapp.com/send?phone=57<?php echo $whatsapp; ?>"
                                                            target="_blank">
                                                            <span>Para comprar contáctese a este enlace</span>
                                                        </a>
                                                    <?php } else if ($value->tiendas_pagina != "") { ?>
                                                            <a class="btn-whatsapp"
                                                                style="background-color:<?php echo $this->categoria->categorias_color ?>"
                                                                href="http://<?php echo enlacepagina($value->tiendas_pagina) ?>" target="_blank">
                                                                <span>Para comprar contáctese a este enlace</span>
                                                            </a>
                                                    <?php } else if ($value->tiendas_facebook != "") { ?>
                                                                <a class="btn-whatsapp"
                                                                    style="background-color:<?php echo $this->categoria->categorias_color ?>"
                                                                    href="https://www.facebook.com/<?php echo enlaceredes($value->tiendas_facebook) ?>"
                                                                    target="_blank">
                                                                    <span>Para comprar contáctese a este enlace</span>
                                                                </a>
                                                    <?php } else if ($value->tiendas_instagram != "") { ?>
                                                                    <a class="btn-whatsapp"
                                                                        style="background-color:<?php echo $this->categoria->categorias_color ?>"
                                                                        href="https://www.instagram.com/<?php echo enlaceredes($value->tiendas_instagram) ?>"
                                                                        target="_blank">
                                                                        <span>Para comprar contáctese a este enlace</span>
                                                                    </a>
                                                    <?php } else { ?>
                                                        <?php $telefono = intval(preg_replace('/[^0-9]+/', '', $value->tiendas_telefono), 10); ?>
                                                                    <a class="btn-whatsapp"
                                                                        style="background-color:<?php echo $this->categoria->categorias_color ?>"
                                                                        href="tel:<?php echo $telefono; ?>" target="_blank">
                                                                        <span>Contactar por teléfono</span>
                                                                    </a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <?php break; ?>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            <?php } else { ?>
                <h2 class="w-100 text-center mt-5 text-muted font-weight-bold">Por el momento esta categoría no tiene
                    negocios asociados</h2>
            <?php } ?>
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

<script>
    $("#ordenar").on('change', function () {
        $("#form-order").submit();
    });
</script>