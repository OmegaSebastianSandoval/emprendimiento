<?php
// Funciones helper para simplificar el código
function obtenerCategoriaId($tienda, $categorias)
{
    foreach ($categorias as $categoria) {
        if ($tienda->tiendas_categoria == $categoria->categorias_id) {
            return $categoria->categorias_id;
        }
    }
    return '';
}

function obtenerCategoriaNombre($tienda, $categorias)
{
    foreach ($categorias as $categoria) {
        if ($tienda->tiendas_categoria == $categoria->categorias_id) {
            return $categoria->categorias_nombre;
        }
    }
    return '';
}

function obtenerCategoriaColor($tienda, $categorias)
{
    foreach ($categorias as $categoria) {
        if ($tienda->tiendas_categoria == $categoria->categorias_id) {
            return $categoria->categorias_color;
        }
    }
    return '#007bff'; // Color por defecto
}
?>

<div class="container favoritos py-4">
    <h2 class="contact">Tiendas favoritas</h2>
    <div class="row">
        <?php foreach ($this->favoritos as $key => $favorito) { ?>
            <?php foreach ($this->tiendas as $key2 => $tienda) { ?>
                <?php if ($favorito->favoritos_tienda == $tienda->tiendas_id) { ?>
                    <div class="col-12 col-md-6">

                        <div class="mt-4 row">
                            <div class="col-4">

                                <a href="/page/tienda?id=<?php echo $tienda->tiendas_id ?>&categoria=<?php echo obtenerCategoriaId($tienda, $this->categorias) ?>"
                                    class="enlace-tienda">
                                    <div class="imagen-tienda">
                                        <?php if ($tienda->tiendas_imagen && file_exists(IMAGE_PATH . $tienda->tiendas_imagen)) { ?>
                                            <img class="shadow-sm" src="/images/<?php echo $tienda->tiendas_imagen ?>"
                                                alt="Imagen del producto <?php echo $tienda->tiendas_nombre ?>">
                                        <?php } else { ?>
                                            <img class="shadow-sm" src="/corte/stock.png"
                                                alt="Imagen del producto <?php echo $tienda->tiendas_nombre ?>">
                                        <?php } ?>
                                    </div>

                                </a>


                            </div>
                            <div class="col-8">

                                <div class="caja-texto">
                                    <div class="categoria-tienda text-left">
                                        <h5>
                                            <?php echo obtenerCategoriaNombre($tienda, $this->categorias) ?>
                                        </h5>
                                    </div>
                                    <div class="titulo-tienda text-left">
                                        <h4><?php echo $tienda->tiendas_nombre ?></h4>
                                    </div>
                                    <div class="descripcion-tienda">
                                        <?php echo $tienda->tiendas_descripcion ?>
                                    </div>

                                    <div class="enlace-catalogo">
                                        <a href="/page/tienda?id=<?php echo $tienda->tiendas_id ?>&categoria=<?php echo obtenerCategoriaId($tienda, $this->categorias) ?>"
                                            class="btn btn-producto"
                                            style="background-color: <?php echo obtenerCategoriaColor($tienda, $this->categorias) ?>;">
                                            ver catálogo
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            <?php } ?>
        <?php } ?>
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
<style>
    .main-general {
        min-height: calc(100dvh - 305px);
        display: grid;
        place-items: center;
    }

    body {
        margin-top: 103px;
    }
</style>
<script>
    $(document).ready(function () {
        // Color de la categoría
        var colorCategoria = '<?php echo isset($this->categoria->categorias_color) ? $this->categoria->categorias_color : "#007bff" ?>';

        // Función para destruir completamente el zoom
        function destruirZoomCompleto (img) {
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
        function aplicarZoom (img) {
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
            setTimeout(function () {
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
        $('.modal-prod').on('shown.bs.modal', function () {
            var imgPrincipal = $(this).find('.img-producto');
            setTimeout(function () {
                aplicarZoom(imgPrincipal);
            }, 100);
        });

        // Manejar click en las imágenes miniatura
        $(document).on('click', '.img-miniatura', function () {
            var productoId = $(this).data('producto');
            var nuevaSrc = $(this).data('src');
            var imgPrincipal = $('#img-principal-' + productoId);
            var container = imgPrincipal.closest('.img-modal-prod');

            console.log('Cambiando imagen a:', nuevaSrc);

            // Actualizar los bordes de las miniaturas primero
            $('.img-miniatura[data-producto="' + productoId + '"]').each(function () {
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
            nuevaImg.on('load', function () {
                setTimeout(function () {
                    aplicarZoom(nuevaImg);
                    console.log('Zoom aplicado a nueva imagen:', nuevaSrc);
                }, 50);
            });

            // Si la imagen ya está en caché
            if (nuevaImg[0].complete) {
                setTimeout(function () {
                    aplicarZoom(nuevaImg);
                    console.log('Zoom aplicado a imagen cacheada:', nuevaSrc);
                }, 50);
            }
        });

        // Limpiar zoom cuando se cierre el modal
        $('.modal-prod').on('hidden.bs.modal', function () {
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