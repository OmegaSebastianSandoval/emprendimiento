<div style=" background: #6e6e6e20; padding: 50px; font-size: 15px;">
  <table style="max-width: 600px; background: #FFF; border: 2px solid #192a4b; margin: auto; padding: 20px;">
    <tr>
      <td style="border-bottom: 2px solid #192a4b;">
        <img src="https://www.fendesa.com/skins/page/images/logofendesa.png" alt="Logo Fendesa" height="100"  style="display:block; margin:auto; margin-bottom:10px">
      </td> 
    </tr>
    <tr>
      <td style="padding: 10px 20px; padding-bottom: 20px;">
        <span style="color: #202020;">
          <b>
            <?php echo $this->data['formulario_nombre']?>
          </b>
          ha enviado una consulta con los siguientes datos:
        </span>
      </td>
    </tr>
    <tr>
      <td style="padding: 3px 20px;">
        <span style="color: #6e6e6e;">
          <b>
            Correo electrónico:
          </b>
          <?php echo $this->data['formulario_email'] ?>
        </span>
      </td>
    </tr>
    <tr>
      <td style="padding: 3px 20px;">
        <span style="color: #6e6e6e;">
          <b>
            Teléfono:
          </b>
          <?php echo $this->data['formulario_telefono'] ?>
      </td>
    </tr>
    <tr>
      <td style="padding: 3px 20px;">
        <span style="color: #6e6e6e;">
          <b>
            Ciudad:
          </b>
          <?php echo $this->data['formulario_ciudad'] ?>
      </td>
    </tr>
    <tr>
      <td style="padding: 3px 20px; padding-bottom: 30px;">
        <span style="color: #6e6e6e;">
          <b>
            Mensaje:
          </b>
          <?php echo $this->data['formulario_mensaje'] ?>
      </td>
    </tr>
  </table>
</div>