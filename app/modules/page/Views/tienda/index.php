<div class="banner">
    <img src="/images/<?php echo $this->categoria->categorias_banner ?>" alt="">
</div>
<div class="container  pb-4">
    <a class="btn-volver my-4"
        href="/page/categoria?id=<?php echo $this->categoria->categorias_id ?>&page=<?php echo $this->page ?>&ordenar=<?php echo $this->ordenar ?>">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
    <div class="row">
        <div class="col-12 col-md-4 col-lg-3 p-0">
            <div class="list-top-categorias">

                <div class="border-bottom mb-2 ">
                    <h4 class="interes   fw-bold pb-3 mb-0 lh-1">Categorias</h4>
                </div>

                <div class="list-group list-categorias">

                    <?php foreach ($this->categorias as $key => $categoria) { ?>

                        <a type="button" href="/page/categoria?id=<?php echo $categoria->categorias_id ?>&page=1"
                            class="list-group-item list-group-item-action  <?php echo $categoria->categorias_id == $this->categoria->categorias_id ? 'active' : '' ?>"
                            aria-current="true">
                            <?php echo $categoria->categorias_nombre ?>
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    <?php } ?>

                </div>
            </div>
        </div>
        <div class="col-12 col-md-8 col-lg-9">
            <div class="border-bottom mb-2" style="padding-bottom: 5px;">
                <h5 class="text-info-categoria">
                    <a
                        href="/page/categoria?id=<?php echo $this->categoria->categorias_id ?>&page=<?php echo $this->page ?>&ordenar=<?php echo $this->ordenar ?>">
                        <?php echo $this->categoria->categorias_nombre ?> <i class="fa-solid fa-angles-right"></i>
                    </a>
                    <span>
                        <?php echo $this->tienda->tiendas_nombre ?>
                    </span>
                </h5>
            </div>
            <div class="row g-2">
                <!-- Cards de productos -->
                <?php foreach ($this->productos as $key => $producto) { ?>
                    <div class="col-md-4">
                        <div class="caja-producto shadow-sm">
                            <div class="text-center">
                                <?php if ($producto->productos_imagen && file_exists(IMAGE_PATH . $producto->productos_imagen)) { ?>


                                    <img src="/images/<?php echo $producto->productos_imagen ?>"
                                        alt="Imagen del producto <?php echo $producto->productos_nombre ?>"
                                        style="cursor: pointer;"
                                        data-bs-target="#detalle-producto<?php echo $producto->productos_id ?>"
                                        data-bs-toggle="modal">
                                <?php } else { ?>

                                    <img src="/corte/stock.png"
                                        alt="Imagen del producto <?php echo $producto->productos_nombre ?>"
                                        style="cursor: pointer;"
                                        data-bs-target="#detalle-producto<?php echo $producto->productos_id ?>"
                                        data-bs-toggle="modal">
                                <?php } ?>

                            </div>
                            <div class="p-3 d-flex flex-column justify-content-between gap-2">
                                <div class="descripcion-producto d-flex flex-column justify-content-between gap-2"
                                    id="des-prod">
                                    <h6><?php echo $producto->productos_nombre ?></h6>

                                    <div class="des">
                                        <?php echo $producto->productos_descripcion ?>
                                    </div>
                                    <?php if ($producto->productos_precio != "" && is_numeric($producto->productos_precio)) { ?>
                                        <span class="valor" style="color:<?php echo $this->categoria->categorias_color ?>">
                                            $
                                            <?php echo number_format($producto->productos_precio) ?>
                                        </span>
                                    <?php } else { ?>
                                        <span class="valor" style="color:<?php echo $this->categoria->categorias_color ?>;">
                                            <?php echo $producto->productos_precio ?>
                                        </span>
                                    <?php } ?>
                                </div>

                                <!-- Botón de contacto en cada card -->
                            </div>
                            <div class="contacto-card contacto-card-product ">
                                <?php if ($this->tienda->tiendas_whatsapp != "") { ?>
                                    <?php $whatsapp = intval(preg_replace('/[^0-9]+/', '', $this->tienda->tiendas_whatsapp), 10); ?>
                                    <a style="background-color:<?php echo $this->categoria->categorias_color ?>;"
                                        href="https://api.whatsapp.com/send?phone=57<?php echo $whatsapp; ?>&text=Hola, estoy interesado en el producto: <?php echo urlencode($producto->productos_nombre); ?>"
                                        target="_blank">
                                        <i class="fab fa-whatsapp"></i> Comprar <strong>aquí</strong> en <span>este
                                            enlace</span>
                                    </a>
                                <?php } else if ($this->tienda->tiendas_facebook != "") { ?>
                                        <a style="background-color:<?php echo $this->categoria->categorias_color ?>;"
                                            href="https://www.facebook.com/<?php echo enlaceredes($this->tienda->tiendas_facebook) ?>"
                                            target="_blank">
                                            <i class="fab fa-facebook"></i> Comprar <strong>aquí</strong> en <span>este
                                                enlace</span>
                                        </a>
                                <?php } else if ($this->tienda->tiendas_instagram != "") { ?>
                                            <a style="background-color:<?php echo $this->categoria->categorias_color ?>;"
                                                href="https://www.instagram.com/<?php echo enlaceredes($this->tienda->tiendas_instagram) ?>"
                                                target="_blank">
                                                <i class="fab fa-instagram"></i> Comprar <strong>aquí</strong> en <span>este
                                                    enlace</span>
                                            </a>
                                <?php } else if ($this->tienda->tiendas_telefono != "") { ?>
                                    <?php $telefono = intval(preg_replace('/[^0-9]+/', '', $this->tienda->tiendas_telefono), 10); ?>
                                                <a style="background-color:<?php echo $this->categoria->categorias_color ?>;"
                                                    href="tel:<?php echo $telefono; ?>" target="_blank">
                                                    <i class="fas fa-phone"></i> Comprar <strong>aquí</strong> en <span>este enlace</span>
                                                </a>
                                <?php } ?>
                            </div>

                            <!-- <button role="button" data-bs-target="#detalle-producto<?php echo $producto->productos_id ?>"
                                data-bs-toggle="modal" data-id="<?php echo $producto->productos_id ?>"
                                class="vermas-producto vermas-tienda"
                                style="color:<?php echo $this->categoria->categorias_color ?>; border:1px solid <?php echo $this->categoria->categorias_color ?>">
                                Ver más
                            </button> -->
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- Modales de productos separados -->
            <?php foreach ($this->productos as $key => $producto) { ?>
                <div class="modal fade modal-prod" id="detalle-producto<?php echo $producto->productos_id ?>" tabindex="-1"
                    role="dialog" aria-labelledby="detalle-productoLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                        <div class="modal-content bg-transparent border-0">
                            <div class="modal-header bg-transparent border-0 px-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    style="filter:invert(1)"></button>
                            </div>
                            <div class="modal-body bg-white">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="img-modal-prod">
                                            <img src="/images/<?php echo $producto->productos_imagen ?>"
                                                class="img-producto"
                                                alt="Imagen del producto <?php echo $producto->productos_nombre ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="descripcion-producto-modal px-3">
                                            <h4><?php echo $producto->productos_nombre ?></h4>
                                            <div class="des-modal">
                                                <?php echo $producto->productos_descripcion ?>
                                            </div>

                                            <?php if ($producto->productos_precio != "" && is_numeric($producto->productos_precio)) { ?>
                                                <span class="valor"
                                                    style="color:<?php echo $this->categoria->categorias_color ?>;">
                                                    $<?php echo number_format($producto->productos_precio) ?>
                                                </span>
                                            <?php } else { ?>
                                                <span class="valor"
                                                    style="color:<?php echo $this->categoria->categorias_color ?>;">
                                                    <?php echo $producto->productos_precio ?>
                                                </span>
                                            <?php } ?>


                                            <div class="datos-tienda py-3">
                                                <h6><strong>Datos de contacto</strong></h6>
                                                <?php if ($this->tienda->tiendas_pagina != "") { ?>
                                                    <span>
                                                        <a href="http://<?php echo enlacepagina($this->tienda->tiendas_pagina) ?>"
                                                            target="_blank" class="pagina">
                                                            <?php echo $this->tienda->tiendas_pagina ?>
                                                        </a>
                                                    </span>
                                                    <br>
                                                <?php } ?>
                                                <?php if ($this->tienda->tiendas_facebook != "") { ?>
                                                    <span class="facebook">Facebook:
                                                        <a href="https://www.facebook.com/<?php echo enlaceredes($this->tienda->tiendas_facebook) ?>"
                                                            target="_blank">/<?php echo enlaceredes($this->tienda->tiendas_facebook) ?>
                                                        </a>
                                                    </span>
                                                    <br>
                                                <?php } ?>
                                                <?php if ($this->tienda->tiendas_instagram != "") { ?>
                                                    <span class="insta">Instagram:
                                                        <a href="https://www.instagram.com/<?php echo enlaceredes($this->tienda->tiendas_instagram) ?>"
                                                            target="_blank">@<?php echo enlaceredes($this->tienda->tiendas_instagram) ?>
                                                        </a>
                                                    </span>
                                                    <br>
                                                <?php } ?>
                                                <?php if ($this->tienda->tiendas_telefono != "") { ?>
                                                    <?php $telefono = intval(preg_replace('/[^0-9]+/', '', $this->tienda->tiendas_telefono), 10); ?>
                                                    <span class="tel">Teléfono:
                                                        <a href="tel:<?php echo $telefono ?>" target="_blank">
                                                            <?php echo $this->tienda->tiendas_telefono ?>
                                                        </a>
                                                    </span>
                                                    <br>
                                                <?php } ?>
                                                <?php if ($this->tienda->tiendas_telefono2 != "") { ?>
                                                    <?php $telefono2 = intval(preg_replace('/[^0-9]+/', '', $this->tienda->tiendas_telefono2), 10); ?>
                                                    <span class="tel">Teléfono opción 2:
                                                        <a href="tel:<?php echo $telefono2 ?>" target="_blank">
                                                            <?php echo $this->tienda->tiendas_telefono2 ?>
                                                        </a>
                                                    </span>
                                                <?php } ?>
                                            </div>

                                            <div class="modal-comunicacion-tienda">
                                                <?php if ($this->tienda->tiendas_whatsapp != "") { ?>
                                                    <?php $whatsapp = intval(preg_replace('/[^0-9]+/', '', $this->tienda->tiendas_whatsapp), 10); ?>
                                                    <a class="btn-comunicacion"
                                                        style="background-color:<?php echo $this->categoria->categorias_color ?>"
                                                        href="https://api.whatsapp.com/send?phone=57<?php echo $whatsapp; ?>&text=Hola, estoy interesado en el producto: <?php echo urlencode($producto->productos_nombre); ?>"
                                                        target="_blank">
                                                        <span>Para comprar contáctese a este enlace</span>
                                                    </a>
                                                <?php } else if ($this->tienda->tiendas_facebook != "") { ?>
                                                        <a class="btn-comunicacion"
                                                            style="background-color:<?php echo $this->categoria->categorias_color ?>"
                                                            href="https://www.facebook.com/<?php echo enlaceredes($this->tienda->tiendas_facebook) ?>"
                                                            target="_blank">
                                                            <span>Para comprar contáctese a este enlace</span>
                                                        </a>
                                                <?php } else if ($this->tienda->tiendas_instagram != "") { ?>
                                                            <a class="btn-comunicacion"
                                                                style="background-color:<?php echo $this->categoria->categorias_color ?>"
                                                                href="https://www.instagram.com/<?php echo enlaceredes($this->tienda->tiendas_instagram) ?>"
                                                                target="_blank">
                                                                <span>Para comprar contáctese a este enlace</span>
                                                            </a>
                                                <?php } else if ($this->tienda->tiendas_telefono != "") { ?>
                                                    <?php $telefono = intval(preg_replace('/[^0-9]+/', '', $this->tienda->tiendas_telefono), 10); ?>
                                                                <a class="btn-comunicacion"
                                                                    style="background-color:<?php echo $this->categoria->categorias_color ?>"
                                                                    href="tel:<?php echo $telefono; ?>" target="_blank">
                                                                    <span>Para comprar contáctese a este enlace</span>
                                                                </a>
                                                <?php } ?>
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

<script>
    $("#favorito i").click(function () {
        $(this).toggleClass("activo-favorito");
        var estado = $("#estado-favorito").val();
        var usuario = '<?php echo $_SESSION["kt_login_id"] ?>';
        var tienda = '<?php echo $this->tienda_id ?>';
        $.post("/page/tienda/cambiarestado", {
            "estado": estado,
            "tienda": tienda,
            "usuario": usuario
        }, function (res) { });
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
    $(document).ready(function () {
        $('.img-producto')
            .wrap('<span style="display:inline-block"></span>')
            .css('display', 'block')
            .parent()
            .zoom();
    });
</script>
<!-- Modal -->