<script type="text/javascript">
    function buscar_categoria () {
        var id = $("#buscar_categoria").val();
        window.location.href = '/page/categoria?id=' + id + '&page=1';
    }
</script>

<div class="banner"><?php echo $this->bannerprincipal; ?></div>
<a id="a" name="a"></a>

<div class="container py-4">

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
        <div class="col-12 col-md-4 col-lg-3 p-0">
            <div class="list-top-categorias">

                <div class="border-bottom mb-2 ">
                    <h4 class="interes   fw-bold pb-3 mb-0 lh-1">Categorias</h4>
                </div>

                <div class="list-group list-categorias">

                    <?php foreach ($this->categorias as $key => $categoria) { ?>

                        <a type="button" href="/page/categoria?id=<?php echo $categoria->categorias_id ?>&page=1"
                            class="list-group-item list-group-item-action" aria-current="true">
                            <?php echo $categoria->categorias_nombre ?>
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    <?php } ?>

                </div>
            </div>
        </div>

        <div class="col-12 col-md-8 col-lg-9 ">
            <div class="border-bottom mb-2" style="padding-bottom: 7px;">
                <h6 class="text-center  fw-semibold interes pb-3 mb-0 lh-1">Te podría interesar...</h6>
            </div>

            <?php foreach ($this->tiendas as $key => $value) { ?>
                <div class="mt-4 row">
                    <div class="col-4">

                        <a href="/page/tienda?id=<?php echo $value->tiendas_id ?>&categoria=<?php echo $value->categoria->categorias_id ?>"
                            class="enlace-tienda">
                            <div class="imagen-tienda">
                                <?php if ($value->tiendas_imagen && file_exists(IMAGE_PATH . $value->tiendas_imagen)) { ?>
                                    <img class="shadow-sm" src="/images/<?php echo $value->tiendas_imagen ?>"
                                        alt="Imagen del producto <?php echo $value->tiendas_nombre ?>">
                                <?php } else { ?>
                                    <img class="shadow-sm" src="/corte/stock.png"
                                        alt="Imagen del producto <?php echo $value->tiendas_nombre ?>">
                                <?php } ?>
                            </div>

                        </a>


                    </div>
                    <div class="col-8">

                        <div class="caja-texto">
                            <div class="categoria-tienda text-left">
                                <h5><?php echo $value->categoria->categorias_nombre ?></h5>
                            </div>
                            <div class="titulo-tienda text-left">
                                <h4><?php echo $value->tiendas_nombre ?></h4>
                            </div>
                            <div class="descripcion-tienda">
                                <?php echo $value->tiendas_descripcion ?>
                            </div>

                            <div class="enlace-catalogo">
                                <a href="/page/tienda?id=<?php echo $value->tiendas_id ?>&categoria=<?php echo $value->categoria->categorias_id ?>"
                                    class="btn btn-producto"
                                    style="background-color: <?= $value->categoria->categorias_color ?>;">
                                    ver catálogo
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>

            <!-- Paginacion de tiendas -->

            <?php if ($this->totalpages && $this->totalpages > 1) { ?>
                <div class="mt-4 mb-4">
                    <div class="d-flex justify-content-center">
                        <ul class="pagination">
                            <?php
                            $url = '/page/index';
                            if ($this->totalpages > 1) {
                                if ($this->page != 1)
                                    echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page - 1) . '"> &laquo; Anterior </a></li>';
                                for ($i = 1; $i <= $this->totalpages; $i++) {
                                    if ($this->page == $i)
                                        echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
                                    else
                                        echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . '">' . $i . '</a></li>  ';
                                }
                                if ($this->page != $this->totalpages)
                                    echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page + 1) . '">Siguiente &raquo;</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="text-center mt-2">
                        <small class="text-muted">
                            Mostrando <?php echo count($this->tiendas); ?> de <?php echo $this->register_number; ?> tiendas
                        </small>
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