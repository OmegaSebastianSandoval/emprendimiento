<script>
    $(document).ready(function() {
        <?php if ($_SESSION['video'] == "") { ?>
            $("#popup").modal("show");
            //   setTimeout(function() {$('#popup').modal('hide');}, 18000);
        <?php } ?>
    });
</script>
<div class="row no-gutters">
    <div class="col-md-1"></div>
    <div class="col-md-9">
        <div class="banner"><?php echo $this->bannerprincipal; ?></div>
        <a id="a" name="a"></a>
        <div>
            <div class="imagen-tienda d-none d-lg-block">
                <div class="tiendas">
                    <?php foreach ($this->categorias as $key => $categoria) { ?>
                        <div class="tienda tienda<?php echo $categoria->orden_categorias ?>" data-aos="fade-right" data-aos-offset="200">
                            <button type="button" onclick="window.location.href='/page/categoria?id=<?php echo $categoria->categorias_id ?>&page=1'" class="btn tooltip<?php echo $categoria->orden_categorias ?>" title="<?php echo $categoria->categorias_nombre ?>">
                                <img src="/images/<?php echo $categoria->categorias_imagen_tienda ?>">
                            </button>
                        </div>
                    <?php } ?>
                </div>
                <img src="/skins/page/images/fondo01.jpg" alt="">

            </div>

            <!-- Reponsive -->

            <div class="imagen-tienda d-block d-lg-none py-5 mb-4">
                <div id="categorias-carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($this->categorias as $key => $categoria) { ?>
                            <div class="carousel-item <?php if ($key == 0) {
                                                            echo 'active';
                                                        } ?>">
                                <div class="imagen-tiendas-responsive text-center">
                                    <a href="/page/categoria?id=<?php echo $categoria->categorias_id ?>&page=1"><img src="/images/<?php echo $categoria->categorias_imagen_tienda ?>"></a>
                                </div>
                                <h4 class="text-center" style="color:<?php echo $categoria->categorias_color ?>;font-weight:bold;"><?php echo $categoria->categorias_nombre ?></h4>
                            </div>
                        <?php } ?>
                    </div>
                    <button class="carousel-control-prev" href="#categorias-carousel" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                        </a>
                        <button class="carousel-control-next" href="#categorias-carousel" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                            </a>
                </div>
            </div>

        </div>
        <!-- <div class="container-fluid pestanas-cont">
            <div class="container">
                <div class="row pestanas">
                    <div class="col-lg-4 align-self-center filtro">
                        <div class="row text-center">
                            <div class="col-lg-6 filtrar d-none">
                                <i class="fas fa-filter"></i> Filtrar por categoría
                            </div>
                            <div class="col-lg-12 col-sm-12  boton-filtro">

                                <div id="menu" class="btn-productos btn no_cel">
                                    <ul>
                                        <li><a>Ver categorías</a>
                                            <ul>
                                                <?php foreach ($this->categorias as $key => $categoria) { ?>
                                                <li><a
                                                        href="?categoria=<?php echo $categoria->categorias_id; ?>&page=1#a"><?php echo $categoria->categorias_nombre; ?></a>
                                                    <?php if (count($categoria->hijos) > 0) { ?>
                                                    <ul>
                                                        <?php foreach ($categoria->hijos as $key2 => $subcategoria): ?>
                                                        <li><a
                                                                href="?categoria=<?php echo $categoria->categorias_id; ?>&subcategoria=<?php echo $subcategoria->categorias_id; ?>&page=1#a"><?php echo $subcategoria->categorias_nombre; ?></a>
                                                        </li>
                                                        <?php endforeach ?>
                                                    </ul>
                                                    <?php } ?>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    </ul>

                                </div>


                                <div class="solo_cel">


                                    <style type="text/css">
                                    #select_menu {
                                        text-align: center;
                                        text-align-last: center;
                                    }

                                    #select_menu option {
                                        text-align: left;
                                    }
                                    </style>

                                    <select id="select_menu" class="form-control btn-productos btn"
                                        onchange="filtrar_categoria();">
                                        <option value="/page/index/" style="text-align: center;">Ver categorías</option>

                                        <?php foreach ($this->categorias as $key => $categoria) { ?>
                                        <?php if ($categoria->categorias_nombre != "") { ?>
                                        <option
                                            value="/page/index/?categoria=<?php echo $categoria->categorias_id; ?>&page=1#a"
                                            <?php if ($categoria->categorias_id == $_GET['categoria']) {
                                                    echo 'selected';
                                                } ?>>
                                            <?php echo $categoria->categorias_nombre; ?></option>
                                        <?php if (count($categoria->hijos) > 0) { ?>
                                        <?php foreach ($categoria->hijos as $key2 => $subcategoria): ?>
                                        <?php if ($subcategoria->categorias_nombre != "") { ?>
                                        <option class="opcion2"
                                            value="/page/index/?categoria=<?php echo $categoria->categorias_id; ?>&subcategoria=<?php echo $subcategoria->categorias_id; ?>&page=1#a"
                                            <?php if ($subcategoria->categorias_id == $_GET['subcategoria']) {
                                                                echo 'selected';
                                                            } ?>>
                                            &nbsp;&nbsp;&nbsp;<?php echo $subcategoria->categorias_nombre; ?></option>
                                        <?php } ?>
                                        <?php endforeach ?>
                                        <?php } ?>
                                        <?php } ?>
                                        <?php } ?>


                                        <option></option>
                                    </select>

                                    <script type="text/javascript">
                                    function filtrar_categoria() {
                                        var url = $("#select_menu").val();
                                        window.location = url;
                                    }
                                    </script>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 text-center ciudad d-none">
                        Ciudad de Envío: Bogotá
                    </div>
                    <div class="col-lg-3 col-sm-12 buscar">
                        <form method="post" action="/page/index/#a" class="row">
                            <div class="col-lg-9 col-md-8 buscar-text">
                                <input type="input" class="form-control" name="buscar" id="buscar"
                                    value="<?php echo $_POST['buscar']; ?>" placeholder="Buscar">
                            </div>
                            <div class="col-lg-2 col-md-4 text-right text-end buscar-ico" onclick="$('#buscar_enviar').click();">
                                <i class="fas fa-search" align="right"></i>
                            </div>
                            <div class="d-none"><button type="submit" id="buscar_enviar"></button></div>
                        </form>
                    </div>
                    <div class="col-lg-5 text-center text-lg-right">
                        <div class="nombre">
                            <i class="fas fa-user" style="margin-right: 5px;"></i> Bienvenido,
                            <?php echo $this->socio->socio_nombre; ?> <a href="/page/login/logout"
                                class="btn btn-sm btn-cafe margen_salir">Salir</a>
                        </div>
                    </div>
                </div>
                <div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div align="center" class="col-lg-12">
                    <br>
                    <ul class="pagination justify-content-center">
                        <?php
                        $url = $this->route;
                        $max = $this->page + 6;
                        $min = $this->page - 6;
                        if ($this->page > 1) {
                            $max = $this->page + 3;
                            $min = $this->page - 3;
                        }
                        if ($this->page == 2) {
                            $max = $this->page + 5;
                        }
                        if ($this->page == 3) {
                            $max = $this->page + 4;
                        }
                        if ($this->totalpages > 1) {
                            for ($i = 1; $i <= $this->totalpages; $i++) {
                                if ($this->page == $i) {
                                    echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
                                } else {
                                    if ($i >= $min and $i <= $max) {
                                        echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . '&categoria=' . $_GET["categoria"] . '#a">' . $i . '</a></li>  ';
                                    }
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="row">
                <?php echo $this->productos; ?>
            </div>
            <div class="row">
                <div align="center" class="col-lg-12">
                    <br>
                    <ul class="pagination justify-content-center">
                        <?php
                        $url = $this->route;
                        if ($this->totalpages > 1) {
                            for ($i = 1; $i <= $this->totalpages; $i++) {
                                if ($this->page == $i) {
                                    echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
                                } else {
                                    if ($i >= $min and $i <= $max) {
                                        echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . '&categoria=' . $_GET["categoria"] . '#a">' . $i . '</a></li>  ';
                                    }
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div> -->
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
                                <a href="<?php echo $otro->contenido_enlace ?>" <?php if ($otro->contenido_enlace_abrir == 1) { ?> target="blank" <?php } ?> class="btn btn-block btn-vermas-index"> <?php if ($otro->contenido_vermas) { ?><?php echo $otro->contenido_vermas; ?><?php } else { ?>Ver Más<?php } ?></a>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if ($_SESSION['video'] == "" || $this->popup->publicidad_estado != 1) { ?>
    <div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="popupLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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