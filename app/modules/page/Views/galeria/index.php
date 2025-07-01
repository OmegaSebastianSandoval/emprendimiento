<div class="fondo-galeria" style="background-image: url('/skins/page/images/sofa.jpg');">
  <div id="galeria-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
      <?php foreach ($this->cuadros as $key => $item) { ?>
        <li data-target="#galeria-carousel" data-bs-slide-to="<?php echo $key ?>" class="<?php if ($key == 0) {
                                                                                            echo 'active';
                                                                                          } ?>"></li>
      <?php } ?>
    </ol>
    <div class="carousel-inner">
      <?php foreach ($this->cuadros as $key => $item) { ?>
        <div class="carousel-item <?php if ($key == 0) {
                                    echo ' active ';
                                  } ?> text-center">
          <div class="container-fluid mt-5 px-5">
            <div class="row align-items-center">
              <div class="descripcion-galeria col-md-3">
                <?php echo $item->cuadros_descripcion ?>
              </div>
              <div class="col-md-6 d-flex align-items-center">
                <div class="img-galeria m-auto">
                  <img class="" src="/images/<?php echo $item->cuadros_imagen ?>">
                </div>
              </div>
              <div class="col-md-3">
                <div class="titulo-galeria mb-5">
                  <h1 class="mb-0"><strong><?php echo $item->cuadros_titulo ?></strong></h1>
                  <span style="font-size:22px;"><strong>Precio:</strong>$<?php echo $item->cuadros_precio ?></span>
                </div>

                <?php if ($this->tienda->tiendas_whatsapp != "") { ?>
                  <?php $whatsapp = intval(preg_replace('/[^0-9]+/', '', $this->tienda->tiendas_whatsapp), 10);  ?>
                  <a class="btn btn-comprargaleria"
                    href="https://api.whatsapp.com/send?phone=57<?php echo $whatsapp; ?>" target="_blank">
                    <span>Comprar</span>
                  </a>
                <?php
                  $enlace = "https://api.whatsapp.com/send?phone=57" . $whatsapp;
                } else if ($this->tienda->tiendas_pagina != "") { ?>
                  <a class="btn btn-comprargaleria"
                    href="http://<?php echo enlacepagina($this->tienda->tiendas_pagina) ?>"
                    target="_blank">
                    <span>comprar</span>
                  </a>
                <?php
                  $enlace = "https://www.facebook.com/" . enlaceredes($this->tienda->tiendas_facebook);
                } else if ($this->tienda->tiendas_facebook != "") { ?>
                  <a class="btn btn-comprargaleria"
                    href="https://www.facebook.com/<?php echo enlaceredes($this->tienda->tiendas_facebook) ?>"
                    target="_blank">
                    <span>Comprar</span>
                  </a>
                <?php
                  $enlace = "https://www.facebook.com/" . enlaceredes($this->tienda->tiendas_facebook);
                } else if ($this->tienda->tiendas_instagram != "") { ?>
                  <a class="btn btn-comprargaleria"
                    href="https://www.instagram.com/<?php echo enlaceredes($this->tienda->tiendas_instagram) ?>"
                    target="_blank">
                    <span>Comprar</span>
                  </a>
                <?php } else { ?>
                  <?php $telefono = intval(preg_replace('/[^0-9]+/', '', $this->tienda->tiendas_telefono), 10);  ?>
                  <a class="btn btn-comprargaleria"
                    href="tel:<?php echo $telefono; ?>" target="_blank">
                    <span>Comprar</span>
                  </a>
                <?php
                  $enlace = "tel:" . $telefono;
                } ?>


              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
    <button class="carousel-control-prev" href="#galeria-carousel" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
      </a>
      <button class="carousel-control-next" href="#galeria-carousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
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