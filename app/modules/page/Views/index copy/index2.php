<script>
    $(document).ready(function() {
        <?php if ($_SESSION['video'] == "") { ?>
            $("#popup").modal("show");
            //   setTimeout(function() {$('#popup').modal('hide');}, 18000);
        <?php } ?>
    });
</script>

<script type="text/javascript">
    function buscar_categoria() {
        var id = $("#buscar_categoria").val();
        window.location.href = '/page/categoria?id=' + id + '&page=1';
    }
</script>

<div class="row no-gutters">
    <div class="col-md-12">
        <div class="banner"><?php echo $this->bannerprincipal; ?></div>
        <a id="a" name="a"></a>
    </div>

    <div class="col-lg-1"></div>
    <div class="col-lg-2 mt-2 mb-2 text-center">
        <select name="buscar_categoria" id="buscar_categoria" class="form-control" onchange="buscar_categoria()">
            <option value=""></option>
            <?php foreach ($this->categorias2 as $key => $categoria) { ?>
                <option value="<?php echo $categoria->categorias_id ?>"><?php echo $categoria->categorias_nombre ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-lg-8 mt-2 mb-2 text-center">
        <?php foreach ($this->categorias as $key => $categoria) { ?>
            <button type="btn" class="btn btn-cafe btn-sm mb-2" onclick="window.location.href='/page/categoria?id=<?php echo $categoria->categorias_id ?>&page=1'"><?php echo $categoria->categorias_nombre ?></button>
        <?php } ?>
    </div>

    <div class="col-lg-10 offset-lg-1">
        <div class="row mb-5">

            <div class="col-md-12 text-center mt-4">Te podría interesar...</div>

            <?php foreach ($this->tiendas as $key => $value) { ?>
                <div class="col-md-4 mt-4">
                    <a href="/page/tienda?id=<?php echo $value->tiendas_id ?>&categoria=<?php echo $value->categoria->categorias_id ?>">
                        <div class="caja-tienda">
                            <div align="center"><img src="/images/<?php echo $value->categoria->categorias_imagen_techo ?>" alt=""></div>
                            <div id="carousel<?php echo $value->tiendas_id ?>" class="carousel slide"
                                data-bs-interval="false" data-bs-ride="carousel">
                                <div class="carousel-inner prod">
                                    <div class="carousel-item active img-productos mb-2">
                                        <img class="" src="/images/<?php echo $value->tiendas_imagen ?>" alt="">
                                    </div>
                                    <?php foreach ($value->productos as $key2 => $value2) { ?>
                                        <div class="carousel-item img-productos mb-2">
                                            <img class="" src="/images/<?php echo $value2->productos_imagen ?>" alt="">
                                        </div>
                                    <?php } ?>
                                </div>
                                <button class="carousel-control-prev" href="#carousel<?php echo $value->tiendas_id ?>"
                                    role="button" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                    </a>
                    <button class="carousel-control-next" href="#carousel<?php echo $value->tiendas_id ?>"
                        role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                        </a>
                </div>
                <div class="caja-texto px-3 pb-2">
                    <div class="titulo-tienda text-left">
                        <h4><?php echo $value->tiendas_nombre ?></h4>
                    </div>
                    <div class="datos-tienda pb-3">
                        <?php if ($value->tiendas_pagina != "") { ?>
                            <span><a href="http://<?php echo enlacepagina($value->tiendas_pagina) ?>" target="_blank"><?php echo $value->tiendas_pagina ?></a></span>
                        <?php } ?>
                        <?php if ($value->tiendas_facebook != "") { ?>
                            <span><a href="https://www.facebook.com/<?php echo enlaceredes($value->tiendas_facebook) ?>" target="_blank">facebook/<?php echo enlaceredes($value->tiendas_facebook) ?></a></span>
                        <?php } ?>
                        <?php if ($value->tiendas_instagram != "") { ?>
                            <span>Instagram: <a href="https://www.instagram.com/<?php echo enlaceredes($value->tiendas_instagram) ?>" target="_blank">@<?php echo  enlaceredes($value->tiendas_instagram) ?></a></span>
                        <?php } ?>
                        <?php if ($value->tiendas_telefono != "") { ?>
                            <?php $telefono = intval(preg_replace('/[^0-9]+/', '', $value->tiendas_telefono), 10);  ?>
                            <span>Teléfono:<a href="tel:<?php echo $telefono ?>" target="_blank"> <?php echo $value->tiendas_telefono ?></a></span>
                        <?php } ?>
                        <?php if ($value->tiendas_telefono2 != "") { ?>
                            <?php $telefono2 = intval(preg_replace('/[^0-9]+/', '', $value->tiendas_telefono2), 10);  ?>
                            <span>Teléfono opción 2:<a href="tel:<?php echo $telefono2 ?>" target="_blank"> <?php echo $value->tiendas_telefono2 ?></a></span>
                        <?php } ?>
                    </div>

                    <div class="whatsapp-tienda">
                        <?php if ($value->tiendas_whatsapp != "") { ?>
                            <?php $whatsapp = intval(preg_replace('/[^0-9]+/', '', $value->tiendas_whatsapp), 10);  ?>
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
                                href="https://www.facebook.com/<?php echo enlaceredes($value->tiendas_facebook) ?>" target="_blank">
                                <span>Para comprar contáctese a este enlace</span>
                            </a>
                        <?php } else if ($value->tiendas_instagram != "") { ?>
                            <a class="btn-whatsapp"
                                style="background-color:<?php echo $this->categoria->categorias_color ?>"
                                href="https://www.instagram.com/<?php echo enlaceredes($value->tiendas_instagram) ?>" target="_blank">
                                <span>Para comprar contáctese a este enlace</span>
                            </a>
                        <?php } else { ?>
                            <?php $telefono = intval(preg_replace('/[^0-9]+/', '', $value->tiendas_telefono), 10);  ?>
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

<?php } ?>

</div>
</div>

</div>

<?php if ($_SESSION['video'] == "" || $this->popup->publicidad_estado != 1) { ?>
    <div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="popupLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-content">
                <div class="modal-body">
                    <?php if ($this->popup->publicidad_video != "") { ?>
                        <div class="fondo-video-youtube">
                            <div class="banner-video-youtube" id="videobanner<?php echo $this->popup->publicidad_id; ?> " data-video="<?php echo $this->id_youtube($this->popup->publicidad_video); ?>"></div>
                        </div>
                    <?php } ?>
                    <?php if ($this->popup->publicidad_imagen != "") { ?>
                        <?php if ($this->popup->publicidad_enlace != "") { ?> <a href="<?php echo $this->popup->publicidad_enlace ?>" <?php if ($this->popup->publicidad_enlace == 1) {
                                                                                                                                            echo "target='_blank'";
                                                                                                                                        } ?>> <?php } ?><img src="/images/<?php echo $this->popup->publicidad_imagen ?>" alt=""><?php if ($this->popup->publicidad_enlace != "") { ?> </a><?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<div style="display: none">
    <div id="video-placeholder"></div>
</div>





<script>
    var play;

    function onYouTubeIframeAPIReady() {
        play = new YT.Player('video-placeholder', {
            width: 600,
            height: 400,
            videoId: 'SJ1aTPM-dyE',
            events: {
                onReady: initialize
            }
        });
    }

    function initialize() {

        // Update the controls on load


        // Clear any old interval
        AOS.init();
        // Start interval to update elapsed time display and
        if ($("#play").hasClass("play")) {
            play.playVideo();
            $('#btn-radio').tooltipster('content', 'Apagar música');
        } else {
            play.pauseVideo();
            $('#btn-radio').tooltipster('content', 'Encender música');
        }
        // the elapsed part of the progress bar every second.
    }




    $('#play').on('click', function() {
        if ($("#play").hasClass("play")) {
            $(this).removeClass("play")
            play.pauseVideo();
            $('#btn-radio').tooltipster('content', 'Encender música');
        } else {
            $(this).addClass("play")
            play.playVideo();
            $('#btn-radio').tooltipster('content', 'Apagar música');
        }

    });
</script>
<script src="https://www.youtube.com/iframe_api"></script>
<script src="/components/aos-master/dist/aos.js"></script>

<?php Session::getInstance()->set("video", "1"); ?>

<div class="d-none">
    <iframe src="https://delivery.clubelnogal.com/page/login/loginauto/?cedula=<?php echo $_SESSION['kt_cedula']; ?>&level=<?php echo $_SESSION['kt_login_nivel']; ?>&celular=<?php echo $_SESSION['kt_celular']; ?>&email=<?php echo $_SESSION['kt_correo']; ?>&a=<?php echo $_SESSION['kt_accion']; ?>&q=<?php echo $_SESSION['quien_accion']; ?>&nombre=<?php echo $_SESSION['kt_login_name']; ?>"></iframe>
    <iframe src="https://express.clubelnogal.com/page/login/loginauto/?cedula=<?php echo $_SESSION['kt_cedula']; ?>&level=<?php echo $_SESSION['kt_login_nivel']; ?>&celular=<?php echo $_SESSION['kt_celular']; ?>&email=<?php echo $_SESSION['kt_correo']; ?>&a=<?php echo $_SESSION['kt_accion']; ?>&q=<?php echo $_SESSION['quien_accion']; ?>&nombre=<?php echo $_SESSION['kt_login_name']; ?>"></iframe>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#buscar_categoria').select2();
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