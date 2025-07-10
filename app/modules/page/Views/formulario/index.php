<div class="co">
    <div class="banner"><?php echo $this->bannersimple; ?></div>

    <div class="titulo-internas2">
        <div class="container">
            <div class="row">
                <div class="col-12 titulo-contact">
                    <h2 class="contact">Contacto</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="contenidocontacto">
        <div class="container">
            <!-- Alerta simple de Bootstrap -->
            <?php if (isset($_GET['res'])): ?>
                <?php
                switch ($_GET['res']) {
                    case '1':
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>¡Éxito!</strong> Tu mensaje ha sido enviado correctamente.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                              </div>';
                        break;
                    case '2':
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Atención:</strong> Por favor completa todos los campos requeridos.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                              </div>';
                        break;
                    case '3':
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error:</strong> Verifica el captcha e intenta nuevamente.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                              </div>';
                        break;
                }
                ?>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-6 order-2 order-md-1">
                    <form action="/page/formulario/enviar" method="post" onsubmit="return miFuncion(this)">
                        <div class="row">
                            <div class="col-lg-11">
                                <div class="form-group">
                                    <input name="formulario_nombre" type="text" class="form-control"
                                        placeholder="Nombre:" required>
                                </div>
                                <div class="form-group">
                                    <input name="formulario_email" type="email" class="form-control"
                                        placeholder="E-mail:" required>
                                </div>
                                <div class="form-group">
                                    <input name="formulario_telefono" type="text" class="form-control"
                                        placeholder="Teléfono:" required>
                                </div>
                                <div class="form-group">
                                    <input name="formulario_ciudad" type="text" class="form-control"
                                        placeholder="Ciudad:" required>
                                </div>
                                <input type="hidden" name="formulario_correo">
                                <div class="form-group">
                                    <textarea style="resize:none;" class="form-control" name="formulario_mensaje" id=""
                                        rows="3" placeholder="Mensaje:" required=""></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-check margen_politica" required>
                            <input class="form-check-input" type="checkbox" id="gridCheck" required>
                            <label class="form-check-label" for="gridCheck">
                                <a class="terminos cafe" href="#ventana" data-bs-toggle="modal">Acepto politica de
                                    manejo de datos.</a>
                            </label>
                        </div>
                        <script src='https://www.google.com/recaptcha/api.js'></script>
                        <div class="g-recaptcha" data-sitekey="6LfFDZskAAAAAE2HmM7Z16hOOToYIWZC_31E61Sr"></div>
                        <div class=" col-md-11 text-center">
                            <button type="submit" id="submit-btn" class="btn btn-primary enviar"
                                style="margin-top: 10px;">Enviar</button>
                        </div>
                        <br>
                        <script>
                            function miFuncion(form) {
                                var response = grecaptcha.getResponse();
                                var submitBtn = document.getElementById('submit-btn');

                                if (response.length == 0) {
                                    alert("Por favor, completa la verificación captcha");
                                    return false;
                                }

                                // Validar campos requeridos antes de enviar
                                var requiredFields = ['formulario_nombre', 'formulario_email', 'formulario_telefono', 'formulario_ciudad', 'formulario_mensaje'];
                                var isValid = true;

                                requiredFields.forEach(function(fieldName) {
                                    var field = form.querySelector('[name="' + fieldName + '"]');
                                    if (!field.value.trim()) {
                                        field.style.borderColor = '#dc3545';
                                        isValid = false;
                                    } else {
                                        field.style.borderColor = '';
                                    }
                                });

                                // Validar checkbox de términos
                                var termsCheckbox = document.getElementById('gridCheck');
                                if (!termsCheckbox.checked) {
                                    alert("Debes aceptar la política de manejo de datos");
                                    return false;
                                }

                                if (!isValid) {
                                    alert("Por favor, completa todos los campos requeridos");
                                    return false;
                                }

                                // Deshabilitar botón y cambiar texto
                                submitBtn.disabled = true;
                                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';
                                submitBtn.style.opacity = '0.7';

                                return true;
                            }

                            // Limpiar bordes rojos al escribir
                            document.addEventListener('DOMContentLoaded', function() {
                                var inputs = document.querySelectorAll('input[required], textarea[required]');
                                inputs.forEach(function(input) {
                                    input.addEventListener('input', function() {
                                        if (this.value.trim()) {
                                            this.style.borderColor = '';
                                        }
                                    });
                                });
                            });
                        </script>
                    </form>
                </div>

                <div class="col-lg-6 order-1 order-md-2">
                    <div class="cont-info">
                        <?= $this->contenido ?>
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
                        <?php $whatsapp = intval(preg_replace('/[^0-9]+/', '', $this->infopage->info_pagina_whatsapp), 10); ?>
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



<div class="modal fade" id="ventana">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" align="center"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style="filter:invert(1);"></button>
            </div>
            <div class="modal-body">
                <p><?php echo $this->terminos; ?> </p>
            </div>
        </div>
    </div>
</div>