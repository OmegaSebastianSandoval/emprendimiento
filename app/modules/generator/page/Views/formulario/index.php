<!--  +++++++++++++++++++++++++++++++++++++++++ INDEX DE CONTACTENOS +++++++++++++++++++++++++++++++++++++++   -->
<div class="co">
    <div class="banner"><?php echo $this->bannersimple; ?></div>
    <!--<div class="container">
    <div class="row pestanas">
        <div class="col-lg-6 align-self-center filtro">
            <div class="row">
                <div class="col-sm-6 filtrar">
                    <i class="fas fa-filter"></i> Filtrar por Categoría 
                </div>
                <div class="col-sm-6 text-right text-end boton-filtro">
                    <div class="btn-group">
                        <button type="button" class="btn btn-productos dropdown-toggle" style="backgrund-color:#fe0c05;" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                            Todos los Productos
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                        <?php foreach ($this->categorias as $key => $categoria) { ?>
                            <button class="dropdown-item" type="button"><?php echo $categoria->categorias_nombre; ?></button>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 text-center ciudad">
            Ciudad de Envío: Bogotá
        </div>
        <div class="col-lg-2 buscar">
            <div class="row">
                <div class="col-sm-6 buscar-text">
                    <span>Buscar</span>
                </div>
                <div class="col-sm-6 text-right text-end buscar-ico">
                    <i class="fas fa-search" align="right"></i>
                </div>
            </div> 
        </div>
    </div>
<div>-->
    <div class="titulo-internas2">
        <div class="container">
            <div class="row">
                <div class="col-12 titulo-contact">
                    <h2 class="contact">Contacto</h2>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="contenidocontacto" data-aos="fade-up-right">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <form action="/page/formulario/enviar" method="post" onsubmit="return miFuncion(this)">
                        <div class="row">
                            <div class="col-lg-11">
                                <div class="form-group">
                                    <input name="formulario_nombre" type="text" class="form-control" placeholder="Nombre:" required>
                                </div>
                                <div class="form-group">
                                    <input name="formulario_email" type="email" class="form-control" placeholder="E-mail:" required>
                                </div>
                                <div class="form-group">
                                    <input name="formulario_telefono" type="text" class="form-control" placeholder="Teléfono:" required>
                                </div>
                                <div class="form-group">
                                    <input name="formulario_ciudad" type="text" class="form-control" placeholder="Ciudad:" required>
                                </div>
                                <div class="form-group">
                                    <textarea style="resize:none;" class="form-control" name="formulario_mensaje" id="" rows="3" placeholder="Mensaje:" required=""></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-check margen_politica" required>
                            <input class="form-check-input" type="checkbox" id="gridCheck" required>
                            <label class="form-check-label" for="gridCheck">
                                <a class="terminos cafe" href="#ventana" data-toggle="modal">Acepto politica de manejo de datos.</a>
                            </label>
                        </div>
                        <script src='https://www.google.com/recaptcha/api.js'></script>
                        <div class="g-recaptcha" data-sitekey="6LepIukUAAAAADbg9KC_Y68CZ9sOc248eGC1UMHJ"></div>
                        <script>
                            function miFuncion(a) {
                                var response = grecaptcha.getResponse();

                                if (response.length == 0) {
                                    alert("Captcha no verificado");
                                    return false;
                                    event.preventDefault();
                                } else {
                                    return true;
                                }
                            }
                        </script>
                        <div class=" col-md-11 text-center">
                            <button type="submit" class="btn btn-primary enviar" style="margin-top: 10px;">Enviar</button>
                        </div>
                        <br>
                    </form>
                </div>

                <div class="col-lg-6">
                    <div class="cont-info">
                        <?php foreach ($this->informaciones as $key => $informacion) { ?>
                            <div>
                                <h3 class="informacion-contacto">Información de contacto</h3>
                                <div class="pro"><?php echo $informacion->info_pagina_informacion_contacto; ?></div>
                            </div>
                        <?php } ?>
                        <!-- INSTANCIAMOS SIN FOREACH -->
                        <div class=" margenredes">
                            <?php if ($this->infopage->info_pagina_facebook) { ?>
                                <a href="<?php echo $this->infopage->info_pagina_facebook ?>" target="_blank" class="red2">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            <?php } ?>
                            <?php if ($this->infopage->info_pagina_twitter) { ?>
                                <a href="<?php echo $this->infopage->info_pagina_twitter ?>" target="_blank" class="red">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            <?php } ?>
                            <?php if ($this->infopage->info_pagina_instagram) { ?>
                                <a href="<?php echo $this->infopage->info_pagina_instagram ?>" target="_blank" class="red">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            <?php } ?>
                            <!--<?php if ($this->infopage->info_pagina_whatsapp) { ?>
                        <?php $whatsapp = intval(preg_replace('/[^0-9]+/', '', $this->infopage->info_pagina_whatsapp), 10);  ?>
                        <a href="https://api.whatsapp.com/send?phone=<?php echo $whatsapp; ?>" target="_blank" class="red" >
                            <i class="fab fa-whatsapp"></i>
                            <span><?php echo $this->infopage->info_pagina_whatsapp ?></span>
                        </a>
                    <?php } ?>-->
                            <?php if ($this->infopage->info_pagina_pinterest) { ?>
                                <a href="<?php echo $this->infopage->info_pagina_pinterest ?>" target="_blank" class="red">
                                    <i class="fab fa-pinterest-p"></i>
                                </a>
                            <?php } ?>
                            <?php if ($this->infopage->info_pagina_youtube) { ?>
                                <a href="<?php echo $this->infopage->info_pagina_youtube ?>" target="_blank" class="red">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            <?php } ?>
                            <?php if ($this->infopage->info_pagina_linkedin) { ?>
                                <a href="<?php echo $this->infopage->info_pagina_linkedin ?>" target="_blank" class="red">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            <?php } ?>
                            <?php if ($this->infopage->info_pagina_google) { ?>
                                <a href="<?php echo $this->infopage->info_pagina_google ?>" target="_blank" class="red">
                                    <i class="fab fa-google-plus-g"></i>
                                </a>
                            <?php } ?>
                            <?php if ($this->infopage->info_pagina_flickr) { ?>
                                <a href="<?php echo $this->infopage->info_pagina_flickr ?>" target="_blank" class="red">
                                    <i class="fab fa-flickr"></i>
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


<div class="modal fade" id="ventana">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" align="center"><?php echo $this->terminos->contenido_titulo; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="far fa-times-circle"></i>
                </button>
            </div>
            <div class="modal-body">
                <p><?php echo $this->terminos->contenido_descripcion; ?> </p>
            </div>
        </div>
    </div>
</div>