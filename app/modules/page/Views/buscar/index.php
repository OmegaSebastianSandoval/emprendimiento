<div class="container py-5">
    <div class="row">
        <h1 class="titulo-buscador">Buscar</h1>
        <div class="col-md-12">
            <?php
            if (
                count($this->categorias2 ?? []) <= 0 &&
                count($this->tienda ?? []) <= 0 &&
                count($this->tienda2 ?? []) <= 0
            ) {
            ?>
                <h2>No se encontrarón resultados para la busquedad</h2>
            <?php } else { ?>
                <?php foreach ($this->categorias2 as $key => $value) { ?>
                    <div class="caja-buscador my-3">
                        <a href="/page/categoria?id=<?php echo $value->categorias_id ?>&page=1"><?php echo $value->categorias_nombre ?></a><br>
                    </div>
                <?php } ?>
                <?php foreach ($this->tienda as $key => $value) { ?>
                    <div class="caja-buscador my-3">
                        <a href="/page/tienda?id=<?php echo $value->tiendas_id ?>&categoria=<?php echo $value->tiendas_categoria ?>"><?php echo $value->tiendas_nombre ?></a><br>
                        <div class="descripcion-buscar">
                            <?php echo $value->tiendas_descripcion ?>
                        </div>
                    </div>
                <?php } ?>
                <?php foreach ($this->tienda2 as $key2 => $value2) { ?>
                    <?php foreach ($this->productos as $key => $value) { ?>

                        <?php if ($value2->tiendas_id == $value->productos_tienda) { ?>
                            <div class="caja-buscador my-3">
                                <a href="/page/tienda?id=<?php echo $value->productos_tienda ?>&categoria=<?php echo $value2->tiendas_categoria ?>"><?php echo $value->productos_nombre ?></a><br>
                                <div class="descripcion-buscar">
                                    <?php echo $value->productos_descripcion ?>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>