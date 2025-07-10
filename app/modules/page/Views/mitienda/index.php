<div class="container contenedor-mi-tienda py-4">

  <div class="card border-0 shadow-sm">
    <div class="card-header">
      <h4 class="mb-0 titulo">
        <i class="fas fa-store"></i> Mi Tienda
        <?php if ($tiendaInfo): ?>
          - <?php echo ($tiendaInfo->tiendas_nombre ?? ''); ?>
        <?php endif; ?>
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

      <?php if ($tiendaInfo): ?>
        <div class="row mb-4">
          <div class="col-md-8">
            <h5>Información de la Tienda</h5>
            <p><strong>Nombre:</strong> <?php echo ($tiendaInfo->tiendas_nombre ?? ''); ?></p>
            <?php if (!empty($tiendaInfo->tiendas_descripcion)): ?>
              <p><strong>Descripción:</strong> <?php echo ($tiendaInfo->tiendas_descripcion); ?></p>
            <?php endif; ?>
          </div>
          <div class="col-md-4 text-right">
            <div class="card bg-light">
              <div class="card-body text-center">
                <h6>Total de Productos</h6>
                <h2 class="text-orange"><?php echo ($totalProductos); ?></h2>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <!-- Botones de Acción Principal -->
      <div class="row mb-4">
        <div class="col-12">
          <h5 class="mb-3">Panel de Administración</h5>
        </div>
        <div class="col-md-4 mb-3">
          <div class="card h-100 border-orange">
            <div class="card-body text-center">
              <div class="mb-3">
                <i class="fas fa-box fa-3x text-orange"></i>
              </div>
              <h5 class="card-title">Productos</h5>
              <p class="card-text">Gestiona todos los productos de tu tienda. Agrega, edita o elimina productos.</p>
              <a href="/page/mitienda/productos" class="btn btn-orange">
                <i class="fas fa-arrow-right"></i> Ir a Productos
              </a>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-3">
          <div class="card h-100 border-orange">
            <div class="card-body text-center">
              <div class="mb-3">
                <i class="fas fa-tags fa-3x text-orange"></i>
              </div>
              <h5 class="card-title">Categorías</h5>
              <p class="card-text">Organiza tus productos en categorías para facilitar la navegación.</p>
              <a href="/page/mitienda/categorias" class="btn btn-orange">
                <i class="fas fa-arrow-right"></i> Ir a Categorías
              </a>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-3">
          <div class="card h-100 border-orange">
            <div class="card-body text-center">
              <div class="mb-3">
                <i class="fas fa-edit fa-3x text-orange"></i>
              </div>
              <h5 class="card-title">Editar Tienda</h5>
              <p class="card-text">Personaliza la información y configuración de tu tienda.</p> <a href="/page/mitienda/editartienda" class="btn btn-orange ">
                <i class="fas fa-arrow-right"></i> Editar Tienda
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Productos Recientes -->
      <?php if (is_array($this->productos) && count($this->productos) > 0): ?>
        <div class="row">
          <div class="col-12">
            <h5 class="mb-3">Productos Recientes</h5>
            <div class="row">
              <?php foreach ($this->productos as $producto): ?>
                <?php if (isset($producto->productos_id)): ?>
                  <div class="col-12 col-md-4 mb-3">
                    <a href="/page/listproductos/manage?id=<?php echo ($producto->productos_id); ?>" class="text-decoration-none">
                      <div class="card h-100">
                        <?php if (!empty($producto->productos_imagen)): ?>
                          <img src="/images/<?php echo ($producto->productos_imagen); ?>" class="card-img-top" alt="<?php echo ($producto->productos_nombre ?? ''); ?>" style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                          <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-image fa-3x text-muted"></i>
                          </div>
                        <?php endif; ?>

                        <div class="card-body">
                          <h6 class="card-title"><?php echo ($producto->productos_nombre ?? ''); ?></h6>
                          <p class="card-text text-muted small">
                            <?php
                            $descripcion = $producto->productos_descripcion ?? '';
                            echo (strlen($descripcion) > 100 ? substr($descripcion, 0, 100) . '...' : $descripcion);
                            ?>
                          </p>
                          <?php if (!empty($producto->productos_precio)): ?>
                            <p class="card-text">
                              <strong class="text-primary">$<?php echo number_format((float)$producto->productos_precio, 0, ',', '.'); ?></strong>
                            </p>
                          <?php endif; ?>
                        </div>
                      </div>
                    </a>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>
            <?php if ($totalProductos > 6): ?>
              <div class="text-center mt-3">
                <a href="/page/mitienda/productos" class="btn btn-outline-primary">
                  Ver todos los productos (<?php echo ($totalProductos); ?>)
                </a>
              </div>
            <?php endif; ?>
          </div>
        </div>
      <?php else: ?>
        <div class="row">
          <div class="col-12">
            <div class="alert alert-info text-center">
              <h5><i class="fas fa-info-circle"></i> ¡Bienvenido a tu tienda!</h5>
              <p>Aún no tienes productos registrados. Comienza agregando tu primer producto para empezar a vender.</p>
              <a href="/page/mitienda/productos" class="btn btn-primary">
                <i class="fas fa-plus"></i> Agregar Primer Producto
              </a>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <!-- Enlaces de Navegación -->
      <div class="row mt-4 pt-4 border-top">
        <div class="col-12 text-center">
          <a href="/" class="btn btn-outline-secondary me-3">
            <i class="fas fa-home"></i> Volver al Inicio
          </a>
          <a href="/page/logout" class="btn btn-outline-danger">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
          </a>
        </div>
      </div>
    </div>
  </div>
</div>


<style>
  .card {
    transition: transform 0.2s;
  }

  .card:hover {
    transform: translateY(-2px);
  }

  .border-primary {
    border-color: #007bff !important;
  }

  .border-success {
    border-color: #28a745 !important;
  }

  .border-warning {
    border-color: #ffc107 !important;
  }


  @media (max-width: 768px) {
    .btn-lg {
      width: 100%;
    }

    .text-right {
      text-align: center !important;
    }
  }
</style>