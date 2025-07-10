<?php if ($this->categoria->categorias_banner && file_exists(IMAGE_PATH . $this->categoria->categorias_banner)) { ?>
    <div class="banner">
        <img src="/images/<?php echo $this->categoria->categorias_banner ?>" alt="">
    </div>
<?php } ?>
<div class="container  py-3">
    <a class="btn-volver mt-2 mb-4"
        href="<?php
                if (isset($this->subcategoria_actual) && $this->subcategoria_actual && $this->categoria_padre) {
                    // Si estamos en subcategoría, volver a la categoría padre
                    echo '/page/categoria?id=' . $this->categoria_padre->categorias_id . '&page=' . $this->page . '&ordenar=' . $this->ordenar;
                } elseif ($this->categoria_padre) {
                    // Si estamos en categoría padre, volver a la categoría
                    echo '/page/categoria?id=' . $this->categoria_padre->categorias_id . '&page=' . $this->page . '&ordenar=' . $this->ordenar;
                } else {
                    // Fallback: volver a página anterior
                    echo 'javascript:history.back()';
                }
                ?>">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
    <div class="row">
        <div class="col-12 col-md-4 col-lg-3 p-0">
            <div class="list-top-categorias">

                <div class="border-bottom mb-2 ">
                    <h4 class="interes   fw-bold pb-3 mb-0 lh-1">Subcategorias</h4>
                </div>

                <!-- Select para responsive (móvil) -->
                <div class="d-block d-md-none mb-3 px-3">
                    <select name="buscar_categoria_mobile" id="buscar_categoria_mobile" class="form-select" onchange="buscar_categoria_mobile()">
                        <option value="">Selecciona una subcategoría</option>
                        <?php foreach ($this->categorias as $key => $categoria) { ?>
                            <option value="<?php echo $categoria->categorias_id ?>"
                                <?php echo ($categoria->categorias_id == $this->subcategoria_seleccionada) ? 'selected' : '' ?>>
                                <?php echo $categoria->categorias_nombre ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Lista para desktop -->
                <div class="list-group list-categorias d-none d-md-block">

                    <?php foreach ($this->categorias as $key => $categoria) { ?>

                        <a type="button"
                            href="/page/tienda?id=<?php echo $this->tienda->tiendas_id ?>&page=1&subtienda=<?= $this->tienda->tiendas_id ?>&subcategoria=<?php echo $categoria->categorias_id ?>&categoria=<?= $categoria->categorias_padre ?>"
                            class="list-group-item list-group-item-action <?php echo ($categoria->categorias_id == $this->subcategoria_seleccionada) ? 'active' : '' ?>"
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
                <div class="d-flex justify-content-between align-items-center gap-2">
                    <h5 class="text-info-categoria">
                        <?php if ($this->subcategoria_actual): ?>
                            <!-- Si estamos en una subcategoría, mostrar: Categoría Padre > Subcategoría > Tienda -->
                            <?php if ($this->categoria_padre): ?>
                                <a href="/page/categoria?id=<?php echo $this->categoria_padre->categorias_id ?>&page=<?php echo $this->page ?>&ordenar=<?php echo $this->ordenar ?>">
                                    <?php echo $this->categoria_padre->categorias_nombre ?>
                                </a>
                                <i class="fa-solid fa-angles-right"></i>
                            <?php endif; ?>
                            <a href="/page/tienda?id=<?php echo $this->tienda->tiendas_id ?>&categoria=<?php echo $this->categoria_padre ? $this->categoria_padre->categorias_id : '' ?>&subcategoria=<?php echo $this->subcategoria_actual->categorias_id ?>">
                                <?php echo $this->subcategoria_actual->categorias_nombre ?>
                            </a>
                            <i class="fa-solid fa-angles-right"></i>
                        <?php elseif ($this->categoria_padre): ?>
                            
                            <!-- Si estamos en categoría padre, mostrar: Categoría > Tienda -->
                            <a href="/page/categoria?id=<?php echo $this->categoria_padre->categorias_id ?>&page=<?php echo $this->page ?>&ordenar=<?php echo $this->ordenar ?>">
                                <?php echo $this->categoria_padre->categorias_nombre ?> <i class="fa-solid fa-angles-right"></i>
                            </a>
                        <?php endif; ?>
                        <span>
                            <?php echo $this->tienda->tiendas_nombre ?>
                        </span>
                    </h5>
                   <!--  <div id="favorito" class="text-right text-end">
                        <input type="hidden" value="<?php if (count($this->favoritos) > 0) {
                                                        echo 1;
                                                    } else {
                                                        echo 0;
                                                    } ?>" id="estado-favorito">
                        <i class="fa-solid fa-heart <?php if (count($this->favoritos) > 0) {
                                                        echo 'activo-favorito';
                                                    } ?>" aria-hidden="true"></i>
                    </div> -->
                </div>
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
                                    <?php
                                    // Determinar qué categoría usar para el color
                                    $categoria_color = '';
                                    if (isset($this->subcategoria_actual) && $this->subcategoria_actual && $this->subcategoria_actual->categorias_color) {
                                        $categoria_color = $this->subcategoria_actual->categorias_color;
                                    } elseif ($this->categoria_padre && $this->categoria_padre->categorias_color) {
                                        $categoria_color = $this->categoria_padre->categorias_color;
                                    } else {
                                        $categoria_color = '#007bff'; // Color por defecto
                                    }
                                    ?>
                                    <?php if ($producto->productos_precio != "" && is_numeric($producto->productos_precio)) { ?>
                                        <span class="valor" style="color:<?php echo $categoria_color ?>">
                                            $
                                            <?php echo number_format($producto->productos_precio) ?>
                                        </span>
                                    <?php } else { ?>
                                        <span class="valor" style="color:<?php echo $categoria_color ?>;">
                                            <?php echo $producto->productos_precio ?>
                                        </span>
                                    <?php } ?>
                                </div>

                                <!-- Botón de contacto en cada card -->
                            </div>
                            <div class="contacto-card contacto-card-product ">
                                <?php
                                // Usar el mismo color definido arriba
                                ?>
                                <?php if ($this->tienda->tiendas_whatsapp != "") { ?>
                                    <?php $whatsapp = intval(preg_replace('/[^0-9]+/', '', $this->tienda->tiendas_whatsapp), 10); ?>
                                    <a style="background-color:<?php echo $categoria_color ?>;"
                                        href="https://api.whatsapp.com/send?phone=57<?php echo $whatsapp; ?>&text=Hola, estoy interesado en el producto: <?php echo urlencode($producto->productos_nombre); ?>"
                                        target="_blank">
                                        <i class="fab fa-whatsapp"></i> Comprar <strong>aquí</strong> en <span>este
                                            enlace</span>
                                    </a>
                                <?php } else if ($this->tienda->tiendas_facebook != "") { ?>
                                    <a style="background-color:<?php echo $categoria_color ?>;"
                                        href="https://www.facebook.com/<?php echo enlaceredes($this->tienda->tiendas_facebook) ?>"
                                        target="_blank">
                                        <i class="fab fa-facebook"></i> Comprar <strong>aquí</strong> en <span>este
                                            enlace</span>
                                    </a>
                                <?php } else if ($this->tienda->tiendas_instagram != "") { ?>
                                    <a style="background-color:<?php echo $categoria_color ?>;"
                                        href="https://www.instagram.com/<?php echo enlaceredes($this->tienda->tiendas_instagram) ?>"
                                        target="_blank">
                                        <i class="fab fa-instagram"></i> Comprar <strong>aquí</strong> en <span>este
                                            enlace</span>
                                    </a>
                                <?php } else if ($this->tienda->tiendas_telefono != "") { ?>
                                    <?php $telefono = intval(preg_replace('/[^0-9]+/', '', $this->tienda->tiendas_telefono), 10); ?>
                                    <a style="background-color:<?php echo $categoria_color ?>;"
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
                                        <div class="row g-0">
                                            <div class="col-12">
                                                <div class="img-modal-prod">
                                                    <img src="/images/<?php echo $producto->productos_imagen ?>"
                                                        class="img-producto img-principal"
                                                        id="img-principal-<?php echo $producto->productos_id ?>"
                                                        alt="Imagen del producto <?php echo $producto->productos_nombre ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <div class="row g-2 imagenes-adicionales">
                                                    <!-- Imagen principal como miniatura -->
                                                    <div class="col-3">
                                                        <img src="/images/<?php echo $producto->productos_imagen ?>"
                                                            class="img-thumbnail img-miniatura active"
                                                            style="cursor: pointer; border: 2px solid <?php echo $this->categoria->categorias_color ?>;"
                                                            data-src="/images/<?php echo $producto->productos_imagen ?>"
                                                            data-producto="<?php echo $producto->productos_id ?>"
                                                            alt="Imagen principal">
                                                    </div>

                                                    <!-- Imágenes adicionales -->
                                                    <?php if (!empty($producto->productos_imagen_una) && file_exists(IMAGE_PATH . $producto->productos_imagen_una)): ?>
                                                        <div class="col-3">
                                                            <img src="/images/<?php echo $producto->productos_imagen_una ?>"
                                                                class="img-thumbnail img-miniatura"
                                                                style="cursor: pointer; border: 2px solid transparent;"
                                                                data-src="/images/<?php echo $producto->productos_imagen_una ?>"
                                                                data-producto="<?php echo $producto->productos_id ?>"
                                                                alt="Imagen adicional 1">
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (!empty($producto->productos_imagen_dos) && file_exists(IMAGE_PATH . $producto->productos_imagen_dos)): ?>
                                                        <div class="col-3">
                                                            <img src="/images/<?php echo $producto->productos_imagen_dos ?>"
                                                                class="img-thumbnail img-miniatura"
                                                                style="cursor: pointer; border: 2px solid transparent;"
                                                                data-src="/images/<?php echo $producto->productos_imagen_dos ?>"
                                                                data-producto="<?php echo $producto->productos_id ?>"
                                                                alt="Imagen adicional 2">
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (!empty($producto->productos_imagen_tres) && file_exists(IMAGE_PATH . $producto->productos_imagen_tres)): ?>
                                                        <div class="col-3">
                                                            <img src="/images/<?php echo $producto->productos_imagen_tres ?>"
                                                                class="img-thumbnail img-miniatura"
                                                                style="cursor: pointer; border: 2px solid transparent;"
                                                                data-src="/images/<?php echo $producto->productos_imagen_tres ?>"
                                                                data-producto="<?php echo $producto->productos_id ?>"
                                                                alt="Imagen adicional 3">
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (!empty($producto->productos_imagen_cuatro) && file_exists(IMAGE_PATH . $producto->productos_imagen_cuatro)): ?>
                                                        <div class="col-3">
                                                            <img src="/images/<?php echo $producto->productos_imagen_cuatro ?>"
                                                                class="img-thumbnail img-miniatura"
                                                                style="cursor: pointer; border: 2px solid transparent;"
                                                                data-src="/images/<?php echo $producto->productos_imagen_cuatro ?>"
                                                                data-producto="<?php echo $producto->productos_id ?>"
                                                                alt="Imagen adicional 4">
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="descripcion-producto-modal px-3">
                                            <div class="d-flex justify-content-between align-items-center gap-2">
                                                <h4 class="m-0"><?php echo $producto->productos_nombre ?></h4>

                                            </div>
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
    $("#favorito i").click(function() {
        $(this).toggleClass("activo-favorito");
        var estado = $("#estado-favorito").val();
        var usuario = '<?php echo $_SESSION["kt_login_id"] ?>';
        var tienda = '<?php echo $this->tienda_id ?>';
        $.post("/page/tienda/cambiarestado", {
            "estado": estado,
            "tienda": tienda,
            "usuario": usuario
        }, function(res) {});
    });

    function buscar_categoria_mobile() {
        var id = $("#buscar_categoria_mobile").val();
        if (id) {
            var url = '/page/tienda?id=<?php echo $this->tienda->tiendas_id ?>&page=1&subtienda=<?php echo $this->tienda->tiendas_id ?>&subcategoria=' + id + '&categoria=<?php echo isset($this->categoria->categorias_padre) ? $this->categoria->categorias_padre : $this->categoria->categorias_id ?>';
            window.location.href = url;
        }
    }
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
    $(document).ready(function() {
        // Color de la categoría - determinar según el contexto
        var colorCategoria = '<?php
                                if (isset($this->subcategoria_actual) && $this->subcategoria_actual && $this->subcategoria_actual->categorias_color) {
                                    echo $this->subcategoria_actual->categorias_color;
                                } elseif (isset($this->categoria_padre) && $this->categoria_padre && $this->categoria_padre->categorias_color) {
                                    echo $this->categoria_padre->categorias_color;
                                } else {
                                    echo "#007bff";
                                }
                                ?>';

        // Función para destruir completamente el zoom
        function destruirZoomCompleto(img) {
            var parent = img.parent();

            // Destruir zoom si existe
            if (parent.hasClass('zoom')) {
                parent.trigger('zoom.destroy');
            }

            // Remover cualquier elemento zoom residual
            parent.find('.zoomImg').remove();
            parent.find('.zoomLens').remove();

            // Desenvolver si está envuelto
            if (parent.is('span') && parent.css('display') === 'inline-block') {
                img.unwrap();
            }

            // Limpiar eventos
            img.off('zoom.destroy');
        }

        // Función para aplicar zoom a una imagen
        function aplicarZoom(img) {
            // Verificar que la imagen existe y está cargada
            if (!img.length || !img[0].complete) {
                console.log('Imagen no está lista para zoom');
                return;
            }

            // Destruir cualquier zoom existente en esta imagen
            destruirZoomCompleto(img);

            // Crear wrapper para zoom
            img.wrap('<span style="display:inline-block"></span>');

            // Aplicar zoom después de un pequeño delay
            setTimeout(function() {
                try {
                    img.css('display', 'block').parent().zoom({
                        on: 'mouseover',
                        magnify: 1.5
                    });
                    console.log('Zoom aplicado exitosamente para:', img.attr('src'));
                } catch (error) {
                    console.error('Error aplicando zoom:', error);
                }
            }, 20);
        }

        // Inicializar zoom para las imágenes principales cuando se abra el modal
        $('.modal-prod').on('shown.bs.modal', function() {
            var imgPrincipal = $(this).find('.img-producto');
            setTimeout(function() {
                aplicarZoom(imgPrincipal);
            }, 100);
        });

        // Manejar click en las imágenes miniatura
        $(document).on('click', '.img-miniatura', function() {
            var productoId = $(this).data('producto');
            var nuevaSrc = $(this).data('src');
            var imgPrincipal = $('#img-principal-' + productoId);
            var container = imgPrincipal.closest('.img-modal-prod');

            console.log('Cambiando imagen a:', nuevaSrc);

            // Actualizar los bordes de las miniaturas primero
            $('.img-miniatura[data-producto="' + productoId + '"]').each(function() {
                $(this).css('border', '2px solid transparent');
            });

            // Resaltar la miniatura seleccionada
            $(this).css('border', '2px solid ' + colorCategoria);

            // Destruir completamente el zoom existente
            destruirZoomCompleto(imgPrincipal);

            // Crear completamente un nuevo elemento imagen
            var nuevaImg = $('<img>')
                .attr('src', nuevaSrc)
                .attr('class', 'img-producto img-principal')
                .attr('id', 'img-principal-' + productoId)
                .attr('alt', imgPrincipal.attr('alt'));

            // Reemplazar la imagen existente
            imgPrincipal.replaceWith(nuevaImg);

            // Esperar a que la nueva imagen se cargue y aplicar zoom
            nuevaImg.on('load', function() {
                setTimeout(function() {
                    aplicarZoom(nuevaImg);
                    console.log('Zoom aplicado a nueva imagen:', nuevaSrc);
                }, 50);
            });

            // Si la imagen ya está en caché
            if (nuevaImg[0].complete) {
                setTimeout(function() {
                    aplicarZoom(nuevaImg);
                    console.log('Zoom aplicado a imagen cacheada:', nuevaSrc);
                }, 50);
            }
        });

        // Limpiar zoom cuando se cierre el modal
        $('.modal-prod').on('hidden.bs.modal', function() {
            var imgPrincipal = $(this).find('.img-producto');
            destruirZoomCompleto(imgPrincipal);
        });
    });
</script>
<!-- Modal -->
<style>
    .img-modal-prod {
        position: relative;
        overflow: hidden;
        width: 100%;
        height: 400px;
        /* Altura fija */
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 8px;
    }

    .img-producto {
        max-width: 100%;
        max-height: 100%;
        width: auto;
        height: auto;
        object-fit: contain;
        display: block;
    }

    .img-miniatura {
        width: 100%;
        height: 80px;
        object-fit: cover;
        transition: all 0.3s ease;
        border-radius: 4px;
    }

    .img-miniatura:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .img-miniatura.active {
        opacity: 1;
    }

    /*  .imagenes-adicionales {
        max-height: 100px;
        overflow-y: auto;
    }
 */
    .modal-prod .modal-xl {
        max-width: 1200px;
    }

    /* Asegurar que el contenedor de la imagen principal no cambie de tamaño */
    .modal-prod .col-md-6:first-child {
        min-height: 500px;
    }
</style>