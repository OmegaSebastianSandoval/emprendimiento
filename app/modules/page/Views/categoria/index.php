<div class="banner">
    <img src="/images/<?php echo $this->categoria->categorias_banner ?>" alt="">
</div>

<a id="a" name="a"></a>
<div class="container categoria  py-4">

    <div class="row">
        <div class="col-12 col-md-4 col-lg-3">
            <div class="list-top-categorias">

                <div class="border-bottom mb-2 ">
                    <h4 class="interes   fw-bold pb-3 mb-0 lh-1">Categorias</h4>
                </div>

                <div class="list-group list-categorias">

                    <?php foreach ($this->categorias as $key => $categoria) { ?>

                        <a type="button" href="/page/categoria?id=<?php echo $categoria->categorias_id ?>&page=1"
                            class="list-group-item list-group-item-action <?php echo $categoria->categorias_id == $this->categoria->categorias_id ? 'active' : '' ?>"
                            aria-current="true">
                            <?php echo $categoria->categorias_nombre ?>
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    <?php } ?>

                </div>
            </div>
        </div>
        <div class="col-12 col-md-8 col-lg-9 d-flex flex-column gap-3 ">

            <!-- Formulario de ordenamiento -->
            <div class="mb-3 d-none">
                <form method="get" action="/page/categoria" id="form-order" class="row">
                    <input type="hidden" name="id" value="<?php echo $this->id; ?>">
                    <input type="hidden" name="page" value="1">
                    <div class="col-12 col-md-6">
                        <label for="ordenar" class="form-label">Ordenar por:</label>
                        <select class="form-control" name="ordenar" id="ordenar">
                            <option value="" <?php echo (!isset($this->orden) || $this->orden == '') ? 'selected' : ''; ?>>Aleatorio</option>
                            <option value="recientes" <?php echo (isset($this->orden) && $this->orden == 'recientes') ? 'selected' : ''; ?>>Más recientes</option>
                            <option value="ascendente" <?php echo (isset($this->orden) && $this->orden == 'ascendente') ? 'selected' : ''; ?>>Nombre (A-Z)</option>
                            <option value="descendente" <?php echo (isset($this->orden) && $this->orden == 'descendente') ? 'selected' : ''; ?>>Nombre (Z-A)</option>
                            <option value="visitados" <?php echo (isset($this->orden) && $this->orden == 'visitados') ? 'selected' : ''; ?>>Más visitados</option>
                        </select>
                    </div>
                </form>
            </div>

            <?php if (is_countable($this->tiendas) && count($this->tiendas) > 0) { ?>
                <?php if ($this->categoria->categorias_id != 12) { ?>
                    <?php foreach ($this->tiendas as $tienda): ?>
                        <div class=" row">
                            <div class="col-4">
                                <a href="/page/tienda?id=<?= $tienda->tiendas_id ?>&categoria=<?= $this->categoria->categorias_id ?>"
                                    class="enlace-tienda">
                                    <div class="imagen-tienda">


                                        <?php if ($tienda->tiendas_imagen && file_exists(IMAGE_PATH . $tienda->tiendas_imagen)) { ?>
                                            <img class="shadow-sm img-fluid" src="/images/<?php echo $tienda->tiendas_imagen ?>"
                                                alt="Imagen de la tienda <?php echo $value->tiendas_nombre ?>">
                                        <?php } else { ?>
                                            <img class="shadow-sm img-fluid" src="/corte/stock.png"
                                                alt="Imagen de la tienda <?php echo $value->tiendas_nombre ?>">
                                        <?php } ?>
                                    </div>
                                </a>
                            </div>
                            <div class="col-8">
                                <div class="caja-texto">
                                    <div class="categoria-tienda text-left">
                                        <h5><?= $this->categoria->categorias_nombre ?></h5>
                                    </div>
                                    <div class="titulo-tienda text-left">
                                        <h4><?= $tienda->tiendas_nombre ?></h4>
                                    </div>
                                    <div class="descripcion-tienda">
                                        <?= $tienda->tiendas_descripcion ?>
                                    </div>
                                    <div class="enlace-catalogo mt-3">
                                        <a href="/page/tienda?id=<?= $tienda->tiendas_id ?>&categoria=<?= $this->categoria->categorias_id ?>&ordenar=<?= isset($this->orden) ? $this->orden : '' ?>&page=<?= $this->page ?>"
                                            class="btn btn-producto"
                                            style="background-color: <?= $this->categoria->categorias_color ?>;">
                                            ver catálogo
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                <?php } ?>
            <?php } else { ?>
                <h2 class="w-100 text-center mt-5 text-muted font-weight-bold">Por el momento esta categoría no tiene
                    negocios asociados</h2>
            <?php } ?>

            <!-- Paginacion de tiendas -->

            <?php if ($this->totalpages && $this->totalpages >= 1 && is_countable($this->tiendas) && count($this->tiendas) > 0) { ?>
                <div class="mt-4 mb-4">
                    <div class="d-flex justify-content-center">
                        <ul class="pagination">
                            <?php
                            $url = '/page/categoria';
                            $params = '?id=' . $this->id;
                            if (isset($this->orden) && $this->orden != '') {
                                $params .= '&ordenar=' . $this->orden;
                            }

                            if ($this->totalpages > 1) {
                                if ($this->page != 1)
                                    echo '<li class="page-item"><a class="page-link" href="' . $url . $params . '&page=' . ($this->page - 1) . '"> &laquo; Anterior </a></li>';
                                for ($i = 1; $i <= $this->totalpages; $i++) {
                                    if ($this->page == $i)
                                        echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
                                    else
                                        echo '<li class="page-item"><a class="page-link" href="' . $url . $params . '&page=' . $i . '">' . $i . '</a></li>  ';
                                }
                                if ($this->page != $this->totalpages)
                                    echo '<li class="page-item"><a class="page-link" href="' . $url . $params . '&page=' . ($this->page + 1) . '">Siguiente &raquo;</a></li>';
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