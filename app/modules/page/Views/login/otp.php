<div class="container py-5 mx-auto">

  <div align="center" class="caja_registro alto-login">


    <div class="form-group caja-login p-3" style="max-width: 600px;">

      <div class="row">


        <div class="col-lg-10 col-md-12 mx-auto">
          <p class="login-par">
            Se ha enviado un código de verificación a su correo electrónico: <strong>

              <?php echo $this->email ?></strong> , por favor ingréselo a continuación.
          </p>
        </div>

        <div class="col-xxl-6 col-lg-8 col-9 mt-2 mx-auto">

          <form action="<?= $this->emp == 1 ? '/page/login/loginemp2' : '/page/login/login2' ?> " class="row"
            method="post" id="otpForm">

            <form action="/page/login/login2" class="row" method="post" id="otpForm">


              <div class="otp-container mb-3">
                <input type="number" maxlength="1" class="otp-input" id="otp1" name="otp1">
                <input type="number" maxlength="1" class="otp-input" id="otp2" name="otp2">
                <input type="number" maxlength="1" class="otp-input" id="otp3" name="otp3">
                <input type="number" maxlength="1" class="otp-input" id="otp4" name="otp4">
                <input type="number" maxlength="1" class="otp-input" id="otp5" name="otp5">
                <input type="number" maxlength="1" class="otp-input" id="otp6" name="otp6">
              </div>
              <input type="hidden" name="email" value="<?php echo $this->emailHidden ?>">
              <button type="submit" id="btn-sumbit-opt" class="btn enviar">INGRESAR</button>
              <a href="page/login<?= $this->emp == 1 ? '/emp=1' : ''?>" class="mt-2 volver">Volver al inicio de sesión</a>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .main-general {
    min-height: calc(100dvh - 380px);
    display: grid;
    place-items: center;
  }
</style>
<style>
  .otp-input {
    -moz-appearance: textfield;
    /* Para Firefox */
    -webkit-appearance: none;
    /* Para Chrome, Safari y Edge */
    appearance: none;
    /* Para navegadores modernos que soporten 'appearance' */

  }

  input[type="number"]::-webkit-inner-spin-button,
  input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const inputs = document.querySelectorAll('.otp-input');
    const btnOpt = document.getElementById('btn-sumbit-opt'); // Botón de envío

    inputs.forEach((input, index) => {
      // Manejar la entrada de datos
      input.addEventListener('input', () => {
        // Mover al siguiente input si se ingresa un valor y no es el último campo
        if (input.value.length === 1 && index < inputs.length - 1) {
          inputs[index + 1].focus();
        }

        // Ejecutar el formulario cuando se complete el último campo
        if (index === inputs.length - 1 && input.value.length === 1) {
          btnOpt.click(); // Simula el clic en el botón de envío
        }
      });

      // Manejar el retroceso con "Backspace"
      input.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace') {
          if (input.value === '' && index > 0) {
            inputs[index - 1].focus();
          } else {
            input.value = ''; // Limpia el valor actual
          }
        }
      });

      // Manejar el pegado de texto completo
      input.addEventListener('paste', (e) => {
        const paste = (e.clipboardData || window.clipboardData).getData('text');
        if (paste.length === inputs.length) {
          for (let i = 0; i < inputs.length; i++) {
            inputs[i].value = paste[i] || ''; // Manejar texto pegado
          }
          e.preventDefault();
          btnOpt.click(); // Enviar formulario si se pega el texto completo
        }
      });
    });
  });
</script>