<div
    style="font-family: Arial, sans-serif; color: #1c3455; background-color: #f4f5f5; padding-top: 20px; padding-bottom: 20px;">
    <div
        style="width: 100%; max-width: 500px; margin: auto; padding: 16px; background-color: #735CA3; border-radius: 25px; color: #f4f5f5;">
        <div style="text-align: center; padding: 5px; background-color: darkgray; border-radius: 32px; margin:0">
            <h2 style="margin:0">Nueva Solicitud Recibida</h2>
        </div>
        <p style="font-size: 17px;">
            <br>

            Estimado/a administrador/a,
            <br><br>
            Se ha recibido una nueva solicitud de registro con los siguientes detalles:
            <br><br>

            Nombre del emprendimiento: <strong><?php echo $this->infoTienda->tiendas_nombre; ?></strong>
            <br>
            Número de documento: <strong><?php echo $this->infoUser->user_user; ?></strong>
            <br>
            Fecha de recepción: <strong><?php echo date('d-m-Y H:i:s'); ?></strong>
            <br><br>
            Por favor, acceda al panel de administración para revisar y procesar la solicitud.
        </p>
        <div style="text-align: center;">

            <a href="<?php echo $this->link; ?>"
                style="display:block;margin:0 auto; text-align: center; padding: 5px 15px; background-color: #7F0080; border-radius: 10px; margin-top: 20px; color: #f4f5f5; text-decoration: none; font-weight: bold;font-size: 17px; cursor:pointer;">Ir
                al Panel de Administración</a>
        </div>
    </div>
</div>