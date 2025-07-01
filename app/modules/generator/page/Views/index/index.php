<div class="row no-gutters">
    <div class="col-md-1"></div>
    <div class="col-md-9">
        <div class="banner"><?php echo $this->bannerprincipal; ?></div>
        <a id="a" name="a"></a>
        <div>
            <div class="imagen-tienda d-none d-md-block">
                <div class="tiendas">
                    <div class="tienda tienda1" data-aos="fade-right" data-aos-offset="200">
                        <button type="button" id="tooltip-top" onclick="window.location.href='/page/categoria?id=11&page=1'" class="btn tooltip1" title="Joyeria accesorios y bistureria">
                            <img src="/skins/page/images/Joyeria-accesorios-y-bisuteria.png">
                        </button>
                    </div>
                    <div class="tienda tienda2" data-aos="flip-left" data-aos-offset="200">
                        <button type="button" onclick="window.location.href='/page/categoria?id=1&page=1'" class="btn tooltip2" title="Decoración para el hogar">
                            <img src="/skins/page/images/Decoracion-para-el-hogar.png" alt="">
                        </button>
                    </div>
                    <div class="tienda tienda3" data-aos="zoom-in" data-aos-offset="200">
                        <button type="button" onclick="window.location.href='/page/categoria?id=2&page=1'" class="btn tooltip3" title="Libros y papelería">
                            <img src="/skins/page/images/Libros-ypapeleria.png" alt="">
                        </button>
                    </div>
                    <div class="tienda tienda4" data-aos="flip-down" data-aos-offset="200">
                        <button type="button" onclick="window.location.href='/page/categoria?id=3&page=1'" class="btn tooltip4" title="Carteras, cinturones y zapatos">
                            <img src="/skins/page/images/Carteras-cinturones-zapatos_.png" alt="">
                        </button>
                    </div>
                    <div class="tienda tienda5" data-aos="zoom-out-up" data-aos-offset="200">
                        <button type="button" onclick="window.location.href='/page/categoria?id=4&page=1'" class="btn tooltip5" data-placement="top" title="Ropa">
                            <img src="/skins/page/images/ropa.png" alt="">
                        </button>
                    </div>
                    <div class="tienda tienda6" data-aos="fade-up" data-aos-offset="200">
                        <button type="button" onclick="window.location.href='/page/categoria?id=5&page=1'" class="btn tooltip6" data-placement="top" title="Bienestar y belleza">
                            <img src="/skins/page/images/Bienestar-y-belleza.png" alt="">
                        </button>
                    </div>
                    <div class="tienda tienda7" data-aos="zoom-out" data-aos-offset="200">
                        <button type="button" onclick="window.location.href='/page/categoria?id=6&page=1'" class="btn tooltip7" data-placement="top" title="Alimentos, vinos y licores">
                            <img src="/skins/page/images/Alimentos-vinos-y-licores.png" alt="">
                        </button>
                    </div>
                    <div class="tienda tienda8" data-aos="fade-up-left" data-aos-offset="200">
                        <button type="button" onclick="window.location.href='/page/categoria?id=10&page=1'" class="btn tooltip8" data-placement="top" title="Otros">
                            <img src="/skins/page/images/Otros.png" alt="">
                        </button>
                    </div>
                    <div class="tienda tienda10" data-aos="zoom-out-up" data-aos-offset="200">
                        <button type="button" onclick="window.location.href='/page/categoria?id=7&page=1'" class="btn tooltip9" data-placement="top" title="Bebés">
                            <img src="/skins/page/images/Bebes.png" alt="">
                        </button>
                    </div>
                    <div class="tienda tienda9" data-aos="fade-right" data-aos-offset="200">
                        <button type="button" onclick="window.location.href='/page/categoria?id=8&page=1'" class="btn tooltip10" data-placement="top" title="Mascotas">
                            <img src="/skins/page/images/Mascotas.png" alt="">
                        </button>
                    </div>
                    <div class="tienda item1" data-aos="zoom-out" data-aos-offset="200">
                        <button type="button" onclick="window.location.href='/page/entretenimiento'" class="btn tooltip11" data-placement="top" title="Entretenimiento">
                            <img src="/skins/page/images/Entretenimiento.png" alt="">
                        </button>
                    </div>
                    <div class="tienda item2" data-aos="fade-right" data-aos-offset="200">
                        <button type="button" class="btn tooltip11" data-placement="top" title="Mapa del sitio">
                            <img src="/skins/page/images/Mapa-del-sitio.png" alt="">
                        </button>
                    </div>
                    <div class="tienda radio " data-aos="zoom-out" id="     " data-aos-offset="200">
                        <button type="button" class="btn tooltip11" id="btn-radio" data-placement="left" title="Apagar música">
                            <img src="/skins/page/images/Apagar-musica.png" alt="">
                        </button>
                    </div>
                </div>
                <img src="/skins/page/images/fondo01.jpg" alt="">

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

<div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="popupLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="fondo-video-youtube">
                    <div class="banner-video-youtube" id="videobanner<?php echo $this->popup->publicidad_id; ?> " data-video="<?php echo $this->id_youtube($this->popup->publicidad_video); ?>"></div>
                </div>
            </div>

        </div>
    </div>
</div>
<div style="display: none">
    <div id="video-placeholder"></div>
</div>




<script>
    $(document).ready(function() {
        $("#popup").modal("show");
        //   setTimeout(function() {$('#popup').modal('hide');}, 18000);
    });
</script>
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