<script type="text/javascript">
    function buscar_categoria () {
        var id = $("#buscar_categoria").val();
        window.location.href = '/page/categoria?id=' + id + '&page=1';
    }
</script>

<div class="banner"><?php echo $this->bannerprincipal; ?></div>
<a id="a" name="a"></a>

<div class="container pt-4">

    <!--         <div class="col-lg-3 mt-2 mb-2 text-center">
            <select name="buscar_categoria" id="buscar_categoria" class="form-control" onchange="buscar_categoria()">
                <option value=""></option>
                <?php foreach ($this->categorias2 as $key => $categoria) { ?>
                    <option value="<?php echo $categoria->categorias_id ?>"><?php echo $categoria->categorias_nombre ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-lg-9 mt-2 mb-2 text-center d-flex gap-1 flex-wrap justify-content-center">
            <?php foreach ($this->categorias as $key => $categoria) { ?>
                <button type="btn" class="btn btn-cafe btn-sm "
                    onclick="window.location.href='/page/categoria?id=<?php echo $categoria->categorias_id ?>&page=1'"><?php echo $categoria->categorias_nombre ?></button>
            <?php } ?>
        </div> -->



    <div class="row">
        <div class="col-12 col-md-4 col-lg-3 ">
            <div class="border-bottom mb-2 ">
                <h4 class="interes   fw-bold pb-3 mb-0 lh-1">Categorias</h4>
            </div>

            <div class="list-group list-categorias">

                <?php foreach ($this->categorias as $key => $categoria) { ?>

                    <a type="button" href="/page/categoria?id=<?php echo $categoria->categorias_id ?>&page=1'"
                        class="list-group-item list-group-item-action" aria-current="true">
                        <?php echo $categoria->categorias_nombre ?>
                        <i class="fa-solid fa-angles-right"></i>
                    </a>
                <?php } ?>

            </div>
        </div>

        <div class="col-12 col-md-8 col-lg-9 ">
            <div class="border-bottom mb-2" style="padding-bottom: 6px;">
                <h6 class="text-center  fw-semibold interes pb-3 mb-0 lh-1">Te podría interesar...</h6>
            </div>

            <?php foreach ($this->tiendas as $key => $value) { ?>
                <div class="mt-4 row">
                    <div class="col-4">

                        <a
                            href="/page/tienda?id=<?php echo $value->tiendas_id ?>&categoria=<?php echo $value->categoria->categorias_id ?>">
                            <div class="imagen-tienda">
                                <img class="" src="/images/<?php echo $value->tiendas_imagen ?>" alt="">
                            </div>

                        </a>


                    </div>
                    <div class="col-8">

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
                                        style="background-color:<?php echo $this->categoria->categorias_color ?>"
                                        href="https://api.whatsapp.com/send?phone=57<?php echo $whatsapp; ?>" target="_blank">
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
                </div>

            <?php } ?>
        </div>
    </div>
</div>




<?php if ($this->popup && $this->popup->publicidad_estado == 1) { ?>
    <div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="popupLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-header bg-transparent border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style="filter:invert(1)"></button>
            </div>
            <div class="modal-content">
                <div class="modal-body">
                    <?php if ($this->popup->publicidad_video != "") { ?>
                        <div class="fondo-video-youtube">
                            <div class="banner-video-youtube" id="videobanner<?php echo $this->popup->publicidad_id; ?> "
                                data-video="<?php echo $this->id_youtube($this->popup->publicidad_video); ?>"></div>
                        </div>
                    <?php } ?>
                    <?php if ($this->popup->publicidad_imagen != "") { ?>
                        <?php if ($this->popup->publicidad_enlace != "") { ?> <a
                                href="<?php echo $this->popup->publicidad_enlace ?>" <?php if ($this->popup->publicidad_enlace == 1) {
                                       echo "target='_blank'";
                                   } ?>> <?php } ?><img src="/images/<?php echo $this->popup->publicidad_imagen ?>"
                                alt=""><?php if ($this->popup->publicidad_enlace != "") { ?> </a><?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#popup").modal("show");
        });
    </script>

<?php } ?>
<?php if ($this->emp == 1 && $this->registro == 1) { ?>
    <div class="modal fade" id="popupregistro" tabindex="-1" role="dialog" aria-labelledby="popupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-transparent border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <?php if ($this->mail == 1) { ?>
                        <div class="alert alert-success w-100 m-0" role="alert">
                            <h4 class="alert-heading">¡Registro exitoso!</h4>
                            <p>Hemos notificado al administrador para validar tu información.</p>
                            <p>Te enviaremos un correo cuando se complete la validación del emprendimiento.</p>
                            <hr>
                            <p class="mb-0">Si tienes dudas o necesitas ayuda, contáctanos por correo o teléfono.</p>
                        </div>
                    <?php } ?>
                    <?php if ($this->mail == 2) { ?>
                        <div class="alert alert-warning w-100 m-0" role="alert">
                            <h4 class="alert-heading">¡Registro recibido!</h4>
                            <p>No pudimos enviar el correo al administrador. Por favor, contáctalo directamente para validar
                                tu
                                información.</p>
                            <p>Te avisaremos por correo cuando se complete la validación del emprendimiento.</p>
                            <hr>
                            <p class="mb-0">Si tienes dudas o necesitas ayuda, contáctanos por correo o teléfono.</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#popupregistro").modal("show");
        });
    </script>

<?php } ?>



<script type="text/javascript">
    $(document).ready(function () {
        $('#buscar_categoria').select2({
            width: '100%',
        });
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