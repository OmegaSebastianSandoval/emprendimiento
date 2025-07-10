<!-- Archivo de prueba para verificar alertas -->
<!DOCTYPE html>
<html>

<head>
  <title>Test Alertas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
  <div class="container mt-5">
    <h2>Test de Alertas</h2>

    <!-- Alerta de prueba -->
    <div class="alert alert-success alert-dismissible fade show" role="alert"
      style="margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
      <i class="fas fa-check-circle" style="margin-right: 10px; font-size: 1.2em;"></i>
      <strong>¡Mensaje enviado exitosamente! Te contactaremos pronto.</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <!-- Enlaces de prueba -->
    <p>
      <a href="?res=1" class="btn btn-success">Probar Éxito</a>
      <a href="?res=2" class="btn btn-warning">Probar Campos Faltantes</a>
      <a href="?res=3" class="btn btn-danger">Probar Error Captcha</a>
    </p>

    <?php if (isset($_GET['res'])): ?>
      <div class="mt-3 p-3 bg-light">
        <strong>Parámetro recibido:</strong> res = <?php echo htmlspecialchars($_GET['res']); ?>
      </div>

      <?php
      $alertClass = '';
      $alertMessage = '';
      $alertIcon = '';

      switch ($_GET['res']) {
        case '1':
          $alertClass = 'alert-success';
          $alertMessage = '¡Mensaje enviado exitosamente! Te contactaremos pronto.';
          $alertIcon = 'fas fa-check-circle';
          break;
        case '2':
          $alertClass = 'alert-warning';
          $alertMessage = 'Por favor, completa todos los campos requeridos.';
          $alertIcon = 'fas fa-exclamation-triangle';
          break;
        case '3':
          $alertClass = 'alert-danger';
          $alertMessage = 'Error en la verificación. Por favor, completa el captcha e intenta nuevamente.';
          $alertIcon = 'fas fa-times-circle';
          break;
      }
      ?>

      <div class="alert <?php echo $alertClass; ?> alert-dismissible fade show" role="alert"
        style="margin-top: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <i class="<?php echo $alertIcon; ?>" style="margin-right: 10px; font-size: 1.2em;"></i>
        <strong><?php echo $alertMessage; ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>