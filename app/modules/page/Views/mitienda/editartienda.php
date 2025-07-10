<div class="container contenedor-mi-tienda py-4">

  <div class="card border-0 shadow-sm">
    <div class="card-header ">
      <h4 class="mb-0 titulo">
        <i class="fas fa-edit"></i> Editar Mi Tienda
      </h4>
    </div>
    <div class="card-body">

      <!-- Mensaje de éxito -->
      <?php if (Session::getInstance()->get("mensaje_exito")): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="fas fa-check-circle"></i> <?php echo Session::getInstance()->get("mensaje_exito"); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php Session::getInstance()->set("mensaje_exito", ""); ?>
      <?php endif; ?>

      <?php if ($this->tiendaInfo): ?>
        <!-- Formulario de edición -->
        <form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform; ?>" data-toggle="validator">
          <input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
          <input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">

          <div class="content-dashboard">
            <!-- Estado de la tienda -->
            <div class="row mb-4">
              <div class="col-12">
                <div class="alert alert-info">
                  <h6><i class="fas fa-info-circle"></i> Estado actual de tu tienda</h6>
                  <?php if ($this->tiendaInfo->tiendas_estado == 1): ?>
                    <span class="badge bg-success fs-6">Tu tienda está ACTIVA y visible para los clientes</span>
                  <?php else: ?>
                    <span class="badge bg-danger fs-6">Tu tienda está INACTIVA y no es visible para los clientes</span>
                  <?php endif; ?>
                </div>
              </div>
            </div>

            <!-- Información básica -->
            <div class="row">
              <div class="col-12 col-md-8 col-lg-7 form-group mb-3">
                <label for="tiendas_nombre" class="control-label"><strong>Nombre de la Tienda *</strong></label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-primary text-white"><i class="fas fa-store"></i></span>
                  </div>
                  <input type="text" value="<?= htmlspecialchars($this->tiendaInfo->tiendas_nombre); ?>"
                    name="tiendas_nombre" id="tiendas_nombre" class="form-control" readonly required>
                </div>
                <div class="help-block with-errors"></div>
              </div>

              <div class="col-12 col-md-4 col-lg-5  form-group mb-3">
                <label for="tiendas_imagen"><strong>Logo de la Tienda</strong></label>
                <input type="file" name="tiendas_imagen" id="tiendas_imagen"
                  class="form-control file-image" accept="image/gif, image/jpg, image/jpeg, image/png">
                <div class="help-block with-errors"></div>
                <?php if ($this->tiendaInfo->tiendas_imagen): ?>
                  <div id="imagen_tiendas_imagen" class="mt-2">
                    <img src="/images/<?= $this->tiendaInfo->tiendas_imagen; ?>"
                      class="img-thumbnail" style="max-width: 150px;" />
                    <small class="d-block text-muted">Logo actual</small>
                  </div>
                <?php endif; ?>
              </div>
            </div>

            <!-- Información de contacto -->
            <div class="row">
              <div class="col-12 col-md-4 col-lg-3  form-group mb-3">
                <label for="tiendas_correo" class="control-label"><strong>Correo Electrónico *</strong></label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-info text-white"><i class="fas fa-envelope"></i></span>
                  </div>
                  <input type="email" value="<?= $this->tiendaInfo->tiendas_correo; ?>"
                    name="tiendas_correo" id="tiendas_correo" class="form-control" readonly required>
                </div>
                <div class="help-block with-errors"></div>
              </div>

              <div class="col-12 col-md-4 col-lg-3  form-group mb-3">
                <label for="tiendas_telefono" class="control-label"><strong>Teléfono Principal *</strong></label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-success text-white"><i class="fas fa-phone"></i></span>
                  </div>
                  <input type="number" min="0" value="<?= $this->tiendaInfo->tiendas_telefono; ?>"
                    name="tiendas_telefono" id="tiendas_telefono" data-error="El número de telefono debe ser minimo de 7 dígitos o máximo de 10 dígitos"
                    data-remote="/core/user/validartelnegocio" class="form-control" required>
                </div>
                <div class="help-block with-errors"></div>
              </div>

              <div class="col-12 col-md-4 col-lg-3  form-group mb-3">
                <label for="tiendas_telefono2" class="control-label"><strong>Teléfono Secundario</strong></label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-success text-white"><i class="fas fa-phone"></i></span>
                  </div>
                  <input type="number" min="0" value="<?= $this->tiendaInfo->tiendas_telefono2; ?>"
                    name="tiendas_telefono2" id="tiendas_telefono2" data-error="El numero de whatsapp debe ser de 10 dígitos" data-remote="/core/user/validarwhatsappnegocio" class="form-control">
                </div>
                <div class="help-block with-errors"></div>
              </div>
         
              <div class="col-12 col-md-4 col-lg-3  form-group mb-3">
                <label for="tiendas_whatsapp" class="control-label"><strong>WhatsApp</strong></label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-success text-white"><i class="fab fa-whatsapp"></i></span>
                  </div>
                  <input type="number" min="0" value="<?= $this->tiendaInfo->tiendas_whatsapp; ?>"
                    name="tiendas_whatsapp" id="tiendas_whatsapp" data-error="El numero de whatsapp debe ser de 10 dígitos" data-remote="/core/user/validarwhatsappnegocio" class="form-control">
                </div>
                <div class="help-block with-errors"></div>
              </div>
            </div>

            <!-- Redes sociales y página web -->
            <div class="row">
              <div class="col-12 col-md-4 col-lg-3  form-group mb-3">
                <label for="tiendas_pagina" class="control-label"><strong>Página Web</strong></label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-primary text-white"><i class="fas fa-globe"></i></span>
                  </div>
                  <input type="text" value="<?= $this->tiendaInfo->tiendas_pagina; ?>"
                    name="tiendas_pagina" id="tiendas_pagina" class="form-control"
                    placeholder="ejemplo.com">
                </div>
                <div class="help-block with-errors"></div>
              </div>

              <div class="col-12 col-md-4 col-lg-3  form-group mb-3">
                <label for="tiendas_facebook" class="control-label"><strong>Facebook</strong></label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-primary text-white"><i class="fab fa-facebook"></i></span>
                  </div>
                  <input type="text" value="<?= $this->tiendaInfo->tiendas_facebook; ?>"
                    name="tiendas_facebook" id="tiendas_facebook" class="form-control"
                    placeholder="nombre_usuario">
                </div>
                <div class="help-block with-errors"></div>
              </div>

              <div class="col-12 col-md-4 col-lg-3  form-group mb-3">
                <label for="tiendas_instagram" class="control-label"><strong>Instagram</strong></label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-danger text-white"><i class="fab fa-instagram"></i></span>
                  </div>
                  <input type="text" value="<?= $this->tiendaInfo->tiendas_instagram; ?>"
                    name="tiendas_instagram" id="tiendas_instagram" class="form-control"
                    placeholder="@nombre_usuario">
                </div>
                <div class="help-block with-errors"></div>
              </div>
            </div>

            <!-- Descripción -->
            <div class="row">
              <div class="col-12 form-group mb-3">
                <label for="tiendas_descripcion" class="form-label"><strong>Descripción de la tienda</strong></label>
                <textarea name="tiendas_descripcion" id="tiendas_descripcion"
                  class="form-control tinyeditor-simple" rows="5"
                  placeholder="Describe tu tienda, productos y servicios..."><?= $this->tiendaInfo->tiendas_descripcion; ?></textarea>
                <small class="w-100 d-block text-end" id="char-count">0/700</small>
                <div class="help-block with-errors"></div>
                <small class="text-muted">Esta descripción aparecerá en tu perfil de tienda y ayudará a los clientes a conocer mejor tu negocio.</small>
              </div>
            </div>

            <!-- Campo oculto para mantener el estado actual -->
            <input type="hidden" name="tiendas_estado" value="<?= $this->tiendaInfo->tiendas_estado; ?>">

            <input type="hidden" name="tiendas_categoria" value="<?= $this->tiendaInfo->tiendas_categoria; ?>">
          </div>

          <!-- Botones de acción -->
          <div class="botones-acciones d-flex justify-content-end gap-2">
            <button class="btn btn-guardar" type="submit">
              Guardar Cambios
            </button>
            <a href="/page/mitienda" class="btn btn-cancelar ">
              Cancelar
            </a>
          </div>
        </form>

      <?php else: ?>
        <!-- Sin información de tienda -->
        <div class="alert alert-warning text-center">
          <h5><i class="fas fa-exclamation-triangle"></i> Sin información de tienda</h5>
          <p>No se encontró información de la tienda asociada a este emprendimiento.</p>
          <a href="/page/mitienda" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Volver a Mi Tienda
          </a>
        </div>
      <?php endif; ?>

    </div>
  </div>
</div>

<style>
  .input-group-text {
    min-width: 45px;
    justify-content: center;
  }

  .form-control:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
  }

  .btn-lg {
    padding: 0.75rem 2rem;
    font-size: 1.1rem;
  }

  .file-image {
    padding: 0.375rem 0.75rem;
  }

  .img-thumbnail {
    max-height: 100px;
    object-fit: cover;
  }

  .badge {
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
  }

  input:read-only {
    background-color: #f8f9fa;
    border-color: #ced4da;
    cursor: not-allowed;
  }

  @media (max-width: 768px) {
    .me-3 {
      margin-bottom: 0.5rem;
      display: block;
      width: 100%;
    }

    /* .btn {
      width: 100%;
      margin-bottom: 0.5rem;
    } */

    .input-group-text {
      min-width: 40px;
    }
  }
</style>