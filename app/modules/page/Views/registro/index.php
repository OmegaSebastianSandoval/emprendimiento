<div class="container py-5">
  <div class="registro">
    <h3>Registro de emprendimiento</h3>
    <form class="formulario-registro mt-4" action="/page/registro/insertar" enctype="multipart/form-data" method="post"
      id="formulario-registro" autocomplete="off" data-toggle="validator">
      <div class="row">
        <!-- 1. Tipo de persona -->
        <div class="form-group mb-4 col-md-4 col-lg-3">
          <label for="persona_tipo">Tipo de persona</label>
          <select class="form-control" name="persona_tipo" id="persona_tipo" required>
            <option value="" disabled selected>Seleccione...</option>
            <option value="N">Persona Natural</option>
            <option value="J">Persona Jurídica</option>
          </select>
        </div>
      </div>

      <!-- 2. Sección Persona Natural -->
      <div id="form_natural" class="w-100 d-none">
        <h6>Datos Persona Natural</h6>
        <div class="row">
          <div class="form-group mb-3 col-md-4 col-lg-3">
            <label for="pn_nombres">Nombre</label>
            <input type="text" class="form-control natural-field" name="pn_nombres" id="pn_nombres">
          </div>
          <div class="form-group mb-3 col-md-4 col-lg-3">
            <label for="pn_apellidos">Apellidos</label>
            <input type="text" class="form-control natural-field" name="pn_apellidos" id="pn_apellidos">
          </div>
          <div class="form-group mb-3 col-md-4 col-lg-3">
            <label for="pn_id_tipo">Tipo de identidad</label>
            <select class="form-control natural-field" name="pn_id_tipo" id="pn_id_tipo">
              <option value="" disabled selected>Seleccione…</option>
              <option value="C.C.">C.C.</option>
              <option value="C.E.">C.E.</option>
              <option value="NIT">NIT</option>
              <option value="NUIP">NUIP</option>
              <option value="PASAPORTE">PASAPORTE</option>
            </select>
          </div>
          <?php if ($_GET['negocio'] == "1") { ?>
            <div class="form-group mb-4 col-md-4 col-lg-3">
              <label for="documento_asociado">Número de documento</label>
              <input type="number" min="0" class="form-control natural-field" name="documento_asociado"
                id="documento_asociado" placeholder="" data-error="Número de documento no válido"
                data-remote="/core/user/validaraccionnegocio">
              <div class="help-block with-errors"></div>
            </div>
          <?php } ?>
          <?php if ($_GET['invitado'] == "1") { ?>
            <div class="form-group mb-4 col-md-4 col-lg-3">
              <label for="documento_asociado">Número de documento</label>
              <input type="number" min="0" class="form-control natural-field" name="documento_asociado"
                id="documento_asociado" placeholder="" data-error="Número de documento no válido">
              <div class="help-block with-errors"></div>
            </div>
          <?php } ?>
          <div class="form-group mb-3 col-md-4 col-lg-3">
            <label for="pn_fecha_nacimiento">Fecha de nacimiento</label>
            <input type="date" class="form-control natural-field"
              max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>" name="pn_fecha_nacimiento"
              id="pn_fecha_nacimiento">
          </div>
          <div class="form-group mb-3 col-md-4 col-lg-3">
            <label for="pn_telefono_contacto">Teléfono de contacto</label>
            <input type="text" class="form-control natural-field" name="pn_telefono_contacto" id="pn_telefono_contacto">
          </div>
          <div class="form-group mb-3 col-md-4 col-lg-3">
            <label for="pn_email">Correo electrónico</label>
            <input type="email" class="form-control natural-field" name="pn_email" id="pn_email"
              data-error="El correo ya está registrado">
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group mb-3 col-md-6 col-lg-3">
            <label for="pn_nivel_estudio">Nivel de estudio</label>
            <select class="form-control natural-field" name="pn_nivel_estudio" id="pn_nivel_estudio">
              <option value="" disabled selected>Seleccione…</option>
              <option value="Primaria">Primaria</option>
              <option value="Bachiller">Bachiller</option>
              <option value="Técnico">Técnico</option>
              <option value="Tecnológico">Tecnológico</option>
              <option value="Universitario">Universitario</option>
              <option value="Posgrado">Posgrado</option>
              <option value="Magister">Magister</option>
              <option value="Otro">Otro</option>
            </select>
          </div>

          <div class="form-group mb-3 col-md-6 col-lg-3">
            <label for="pn_actividad">Actividad económica / ocupación</label>
            <input type="text" class="form-control natural-field" name="pn_actividad" id="pn_actividad">
          </div>

          <div class="form-group mb-3 col-md-6 col-lg-3">
            <label for="pn_departamento">Departamento</label>
            <select name="pn_departamento" id="pn_departamento" class="form-control natural-field">
              <option value="" disabled selected>Seleccione…</option>
              <?php foreach ($this->departamentos as $key => $departamento) { ?>
                <option value="<?php echo $departamento->id_departamento ?>">
                  <?php echo $departamento->departamento ?>
                </option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group mb-3 col-md-6 col-lg-3">
            <label for="pn_municipio">Municipio</label>
            <select name="pn_municipio" id="pn_municipio" class="form-control natural-field">
              <option value="" disabled selected>Seleccione…</option>

            </select>
          </div>


          <div class="form-group mb-3 col-md-6 col-lg-3">
            <label for="pn_direccion">Dirección</label>
            <input type="text" class="form-control natural-field" name="pn_direccion" id="pn_direccion">
          </div>


        </div>
      </div>

      <!-- 3. Sección Persona Jurídica -->
      <div id="form_juridica" class="w-100 d-none">
        <h6>Datos Persona Jurídica</h6>
        <div class="row">
          <div class="form-group mb-3 col-md-4  col-lg-3">
            <label for="pj_razon_social">Razón Social</label>
            <input type="text" class="form-control juridica-field" name="pj_razon_social" id="pj_razon_social"
              data-error="La razón social ya está registrada">
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group mb-3 col-md-4 col-lg-3">
            <label for="pj_nit">NIT</label>
            <input type="text" class="form-control juridica-field" name="pj_nit" id="pj_nit"
              data-error="Formato de NIT no válido">
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group mb-3 col-md-4 col-lg-3">
            <label for="pj_email_notificaciones">E-mail notificaciones</label>
            <input type="email" class="form-control juridica-field" name="pj_email_notificaciones"
              id="pj_email_notificaciones" data-error="El correo ya está registrado">
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group mb-3 col-md-4 col-lg-3">
            <label for="pj_telefono">Teléfono</label>
            <input type="text" class="form-control juridica-field" name="pj_telefono" id="pj_telefono">
          </div>
          <div class="form-group mb-3 col-md-6 col-lg-3">
            <label for="pj_direccion">Dirección domicilio principal</label>
            <input type="text" class="form-control juridica-field" name="pj_direccion" id="pj_direccion">
          </div>
          <div class="form-group mb-3 col-md-4 col-lg-3">
            <label for="pj_departamento">Departamento</label>
            <select name="pj_departamento" id="pj_departamento" class="form-control juridica-field">
              <option value="" disabled selected>Seleccione…</option>
              <?php foreach ($this->departamentos as $key => $departamento) { ?>
                <option value="<?php echo $departamento->id_departamento ?>">
                  <?php echo $departamento->departamento ?>
                </option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group mb-3 col-md-4 col-lg-3">
            <label for="pj_municipio">Ciudad</label>
            <select name="pj_municipio" id="pj_municipio" class="form-control juridica-field">
              <option value="" disabled selected>Seleccione…</option>

            </select>
          </div>


          <div class="form-group mb-3 col-md-4 col-lg-3">
            <label for="pj_ciiu">Código CIIU</label>
            <input type="text" class="form-control juridica-field" name="pj_ciiu" id="pj_ciiu">
          </div>
          <div class="form-group mb-3 col-md-4 col-lg-3">
            <label for="pj_tipo_empresa">Tipo de empresa</label>
            <select class="form-control juridica-field" name="pj_tipo_empresa" id="pj_tipo_empresa">
              <option value="" disabled selected>Seleccione…</option>
              <option value="Pública">Pública</option>
              <option value="Privada">Privada</option>
              <option value="Mixta">Mixta</option>
              <option value="Otro">Otro</option>
            </select>
          </div>
          <div class="form-group mb-3 col-md-4 col-lg-3">
            <label>Empleados a cargo</label>
            <div class="d-flex gap-3 mt-2">
              <label class="d-flex gap-1 align-items-center">
                <input type="radio" name="pj_empleados_cargo" class="juridica-field" value="1">
                Sí
              </label>
              <label class="ml-3 d-flex gap-1 align-items-center">
                <input type="radio" name="pj_empleados_cargo" class="juridica-field" value="0">
                No
              </label>
            </div>
          </div>
          <!-- Representante legal -->
          <div class="w-100">
            <h6>Representante Legal</h6>
          </div>
          <div class="form-group mb-3 col-md-4 col-lg-3">
            <label for="pj_rep_apellido1">Primer Apellido</label>
            <input type="text" class="form-control juridica-field" name="pj_rep_apellido1" id="pj_rep_apellido1">
          </div>
          <div class="form-group mb-3 col-md-4 col-lg-3">
            <label for="pj_rep_apellido2">Segundo Apellido</label>
            <input type="text" class="form-control juridica-field" name="pj_rep_apellido2" id="pj_rep_apellido2">
          </div>
          <div class="form-group mb-3 col-md-4  col-lg-3">
            <label for="pj_rep_nombres">Nombres</label>
            <input type="text" class="form-control juridica-field" name="pj_rep_nombres" id="pj_rep_nombres">
          </div>
          <div class="form-group mb-3 col-md-4  col-lg-3">
            <label for="pj_rep_id_tipo">Tipo de documento de identidad</label>
            <select class="form-control juridica-field" name="pj_rep_id_tipo" id="pj_rep_id_tipo">
              <option value="" disabled selected>Seleccione…</option>
              <option value="C.C.">C.C.</option>
              <option value="NIT">NIT</option>
              <option value="C.E.">C.E.</option>
              <option value="P.P.">P.P.</option>
            </select>
          </div>
          <div class="form-group mb-3 col-md-4 col-lg-3">
            <label for="pj_rep_id_numero">Número de documento de identidad</label>
            <input type="text" class="form-control juridica-field" name="pj_rep_id_numero" id="pj_rep_id_numero">
          </div>
          <div class="form-group mb-3 col-md-4 col-lg-3">
            <label for="pj_rep_expedicion_lugar">Lugar expedición</label>
            <input type="text" class="form-control juridica-field" name="pj_rep_expedicion_lugar"
              id="pj_rep_expedicion_lugar">
          </div>
          <div class="form-group mb-3 col-md-4 col-lg-3 ">
            <label for="pj_rep_expedicion_fecha">Fecha expedición</label>
            <input type="date" class="form-control juridica-field" name="pj_rep_expedicion_fecha"
              id="pj_rep_expedicion_fecha">
          </div>
          <div class="form-group mb-3 col-md-4 col-lg-3">
            <label for="pj_rep_nacionalidad">Nacionalidad</label>
            <input type="text" class="form-control juridica-field" name="pj_rep_nacionalidad" id="pj_rep_nacionalidad">
          </div>
          <div class="form-group mb-3 col-md-4 col-lg-3">
            <label for="pj_rep_fecha_nacimiento">Fecha nacimiento</label>
            <input type="date" class="form-control juridica-field"
              max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>" name="pj_rep_fecha_nacimiento"
              id="pj_rep_fecha_nacimiento">
          </div>
          <div class="form-group mb-3 col-md-4 col-lg-3 ">
            <label for="pj_rep_lugar_nacimiento">Lugar nacimiento</label>
            <input type="text" class="form-control juridica-field" name="pj_rep_lugar_nacimiento"
              id="pj_rep_lugar_nacimiento">
          </div>

        </div>
      </div>

      <div class="row">

        <div class="form-group mb-4 col-md-4 col-lg-3">
          <label for="usuario">Escoja el tipo de usuario</label>
          <select class="form-control" name="usuario" id="usuario" required onchange='cambiar_formulario();'>
            <option value="" disabled selected>Seleccione...</option>

            <?php if ($_GET['negocio'] == "1") { ?>
              <option value="4" <?php if ($_GET['negocio'] == "1") {
                                  echo "selected";
                                } ?>>Expositor
                asociado
              </option>
            <?php } ?>
            <?php if ($_GET['invitado'] == "1") { ?>
              <option value="5" <?php if ($_GET['invitado'] == "1") {
                                  echo "selected";
                                } ?>>Expositor
                invitado
              </option>
            <?php } ?>
          </select>

          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group mb-4 col-md-4 col-lg-3">
          <label for="categoria">Escoja la categoría del negocio</label>
          <select class="form-control" name="categoria" id="categoria" required>
            <option disabled selected>Seleccione...</option>
            <?php foreach ($this->categorias as $key => $categoria) { ?>
              <option value="<?php echo $categoria->categorias_id ?>">
                <?php echo $categoria->categorias_nombre ?>
              </option>
            <?php } ?>

          </select>
          <div class="help-block with-errors"></div>
        </div>

        <div class="form-group mb-4 col-md-4 col-lg-3">
          <label for="negocio">Nombre del negocio</label>
          <input type="text" class="form-control" name="negocio" data-error="El nombre del negocio es obligatorio"
            required id="negocio" placeholder="">
          <div class="help-block with-errors"></div>
        </div>

        <!-- Campos adicionales para Persona Jurídica -->
        <div id="campos_asociado_juridica" class="d-none w-100">
          <div class="row">
            <div class="form-group mb-4 col-md-4 col-lg-3">
              <label for="pj_asociado_nombres">Nombre del asociado</label>
              <input type="text" class="form-control juridica-extra-field" name="pj_asociado_nombres"
                id="pj_asociado_nombres" placeholder="">
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group mb-4 col-md-4 col-lg-3">
              <label for="pj_asociado_apellidos">Apellido del asociado</label>
              <input type="text" class="form-control juridica-extra-field" name="pj_asociado_apellidos"
                id="pj_asociado_apellidos" placeholder="">
              <div class="help-block with-errors"></div>
            </div>
            <?php if ($_GET['negocio'] == "1") { ?>

              <div class="form-group mb-4 col-md-4 col-lg-3">
                <label for="pj_documento_asociado">Documento del asociado</label>
                <input type="number" min="0" class="form-control juridica-extra-field" name="pj_documento_asociado"
                  id="pj_documento_asociado" placeholder="" data-error="Número de documento no válido"
                  data-remote="/core/user/validaraccionnegocio">
                <div class="help-block with-errors"></div>
              </div>
            <?php } ?>
            <?php if ($_GET['invitado'] == "1") { ?>
              <div class="form-group mb-4 col-md-4 col-lg-3">
                <label for="pj_documento_asociado">Documento del asociado</label>
                <input type="number" min="0" class="form-control juridica-extra-field" name="pj_documento_asociado"
                  id="pj_documento_asociado" placeholder="" data-error="Número de documento no válido">
                <div class="help-block with-errors"></div>
              </div>
            <?php } ?>
          </div>
        </div>
        <div class="form-group mb-4 col-md-4 col-lg-3">
          <label for="tiendas_imagen">Logo de la empresa</label>
          <input type="file" name="tiendas_imagen" id="tiendas_imagen" class="form-control  file-image"
            data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png">
          <div class="help-block with-errors"></div>
        </div>

        <div class="form-group mb-4 col-md-4 col-lg-3">
          <label for="pagina_web">Página web</label>
          <input type="text" class="form-control" name="pagina_web" required id="pagina_web"
            placeholder="www.misitio.com">
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group mb-4 col-md-4 col-lg-3">
          <label for="facebook">Facebook</label>
          <input type="text" class="form-control" name="facebook" required id="facebook" placeholder="@usuario">
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group mb-4 col-md-4 col-lg-3">
          <label for="instagram">Instagram</label>
          <input type="text" class="form-control" name="instagram" required id="instagram" placeholder="@usuario">
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group mb-4 col-md-4 col-lg-3">
          <label for="telefono_negocio">Teléfono</label>
          <input type="number" min="0" class="form-control" name="telefono_negocio" id="telefono_negocio"
            autocomplete="new-phone" placeholder=""
            data-error="El número de telefono debe ser minimo de 7 dígitos o máximo de 10 dígitos"
            data-remote="/core/user/validartelnegocio">
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group mb-4 col-md-4 col-lg-3">
          <label for="whatsapp">Whatsapp</label>
          <input type="number" min="0" class="form-control" name="whatsapp" required id="whatsapp" placeholder=""
            data-error="El numero de whatsapp debe ser de 10 dígitos" data-remote="/core/user/validarwhatsappnegocio">
          <div class="help-block with-errors"></div>
        </div>
        <div class="form-group mb-4 col-md-4 col-lg-3">
          <label for="correo_negocio">Correo</label>
          <input type="email" class="form-control" name="correo_negocio" required id="correo_negocio"
            data-error="Correo no válido" placeholder="example@hotmail.com"
            data-remote="/core/user/validarcorreonegocio">
          <div class="help-block with-errors"></div>
        </div>
      </div>


      <div id="documents_natural" class="w-100 d-none">
        <div class="row">
          <div class="col-12 col-md-4 form-group ">
            <label for="user_cc">Fotocopia de la cédula de ciudadanía</label>
            <input type="file" name="user_cc" id="user_cc" class="form-control file-document natural-doc"
              data-buttonName="btn-primary" accept="image/jpg, image/jpeg, image/png, application/pdf">
            <div class="help-block with-errors"></div>
          </div>

          <div class="col-12 col-md-4 form-group ">
            <label for="user_certificacion">Certificación laboral y/o certificación de ingresos</label>
            <input type="file" name="user_certificacion" id="user_certificacion"
              class="form-control file-document natural-doc" data-buttonName="btn-primary" accept="application/pdf">
            <div class="help-block with-errors"></div>
          </div>

          <div class="col-12 col-md-4 form-group ">
            <label for="user_declaracion">Declaración de renta reciente.
            </label>
            <input type="file" name="user_declaracion" id="user_declaracion"
              class="form-control file-document natural-doc" data-buttonName="btn-primary" accept="application/pdf">
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div>



      <div id="documents_juridica" class="w-100 d-none">
        <div class="row">
          <div class="col-12 col-md-6 form-group ">
            <label for="user_certificado_representacion">Certificado de existencia y representación legal
              (vigencia ≤ 1 mes)</label>
            <input type="file" name="user_certificado_representacion" id="user_certificado_representacion"
              class="form-control file-document juridica-doc" data-buttonName="btn-primary"
              accept="image/jpg, image/jpeg, image/png, application/pdf">
            <div class="help-block with-errors"></div>
          </div>

          <div class="col-12 col-md-6 form-group ">
            <label for="user_rut">Copia del RUT

            </label>
            <input type="file" name="user_rut" id="user_rut" class="form-control file-document juridica-doc"
              data-buttonName="btn-primary" accept="application/pdf">
            <div class="help-block with-errors"></div>
          </div>

          <div class="col-12 col-md-6 form-group ">
            <label for="user_documento_identidad">Documento de identidad del representante legal
            </label>
            <input type="file" name="user_documento_identidad" id="user_documento_identidad"
              class="form-control file-document juridica-doc" data-buttonName="btn-primary" accept="application/pdf">
            <div class="help-block with-errors"></div>
          </div>

          <div class="col-12 col-md-6 form-group ">
            <label for="user_certificado_bancario">Certificación bancaria

            </label>
            <input type="file" name="user_certificado_bancario" id="user_certificado_bancario"
              class="form-control file-document juridica-doc" data-buttonName="btn-primary" accept="application/pdf">
            <div class="help-block with-errors"></div>
          </div>
        </div>
      </div>
      <div class="form-group mb-4 mt-4">
        <label for="descripcion">Descripción del negocio</label>
        <textarea class="form-control tinyeditor-simple" id="descripcion" name="descripcion" rows="3"></textarea>
        <small class="w-100 d-block text-end" id="char-count">0/700</small>
        <small class="error-msg text-danger "></small>
      </div>



      <?php if ($_GET['negocio'] == "1" || $_GET['invitado'] == "1") { ?>
        <div class="d-flex justify-content-center align-items-center">
          <button type="submit" class="btn-naranja-outline" id="button-send">Enviar</button>
        </div>
      <?php } ?>

    </form>
  </div>
</div>



<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body">
        No se ha podido enviar la solicitud de registro intentelo de nuevo
      </div>

    </div>
  </div>
</div>



<script>
  <?php if ($_GET['error'] == "true") { ?>
    $('#myModal2').modal('show');
  <?php } ?>
</script>
<script>
  $(document).ready(function() {
    var usuario = $("#usuario").val();
    if (usuario == 4) {
      $('#form2').removeClass("d-none");

      $("#form2 .form-group mb-4").children("input").prop('required', true);

      $("#form2 .form-group mb-4").children("select").val("");
      $("#form2 .form-group mb-4").children("textarea").val("");
      $("#whatsapp").prop('required', false);
      $("#instagram").prop('required', false);
      $("#facebook").prop('required', false);
      $("#pagina_web").prop('required', false);

    }

  });

  function cambiar_formulario() {
    var usuario = $("#usuario").val();
    if (usuario == 4 || usuario == 5) {
      $('#form2').removeClass("d-none");
      $("#form2 .form-group mb-4").children("input").prop('required', true);
      $("#form2 .form-group mb-4").children("select").val("");
      $("#form2 .form-group mb-4").children("textarea").val("");
      $("#whatsapp").prop('required', false);
      $("#instagram").prop('required', false);
      $("#facebook").prop('required', false);
      $("#pagina_web").prop('required', false);
    }
  }

  function f1() {
    cambiar_formulario();
  }
  setTimeout('f1()', 1000);
  setTimeout('f1()', 3000);
  setTimeout('f1()', 5000);
</script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const formulario = document.getElementById("formulario-registro");
    const buttonSend = document.getElementById("button-send");
    formulario.addEventListener("submit", function(event) {
      if (!formulario.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();

        return;
      }

      buttonSend.disabled = true;
      buttonSend.innerHTML = "Enviando...";
    });
  });
</script>

<script>
  const municipios = <?php echo json_encode($this->municipios); ?>;
</script>
<script>
  // — JS para alternar formularios y deshabilitar botón como tenías antes —
  document.getElementById('persona_tipo').addEventListener('change', function() {
    const tipoPersona = this.value;

    // Mostrar/ocultar secciones
    document.getElementById('form_natural').classList.toggle('d-none', tipoPersona !== 'N');
    document.getElementById('form_juridica').classList.toggle('d-none', tipoPersona !== 'J');
    document.getElementById('documents_natural').classList.toggle('d-none', tipoPersona !== 'N');
    document.getElementById('documents_juridica').classList.toggle('d-none', tipoPersona !== 'J');
    document.getElementById('campos_asociado_juridica').classList.toggle('d-none', tipoPersona !== 'J');

    // Gestionar atributos required
    const naturalFields = document.querySelectorAll('.natural-field, .natural-doc');
    const juridicaFields = document.querySelectorAll('.juridica-field, .juridica-doc');
    const juridicaExtraFields = document.querySelectorAll('.juridica-extra-field');

    if (tipoPersona === 'N') {
      // Persona Natural: agregar required a campos naturales, quitar de jurídicos
      naturalFields.forEach(field => {
        field.setAttribute('required', 'required');
      });
      juridicaFields.forEach(field => {
        field.removeAttribute('required');
      });
      juridicaExtraFields.forEach(field => {
        field.removeAttribute('required');
      });

      // Activar validaciones remotas para persona natural
      const pnEmail = document.getElementById('pn_email');
      if (pnEmail) {
        pnEmail.setAttribute('data-remote', '/core/user/validarpnemail');
      }

      // Desactivar validaciones remotas para persona jurídica
      const pjRazonSocial = document.getElementById('pj_razon_social');
      if (pjRazonSocial) {
        pjRazonSocial.removeAttribute('data-remote');
      }

      const pjEmail = document.getElementById('pj_email_notificaciones');
      if (pjEmail) {
        pjEmail.removeAttribute('data-remote');
      }

      // Manejar validación especial para documento_asociado
      const documentoAsociado = document.getElementById('documento_asociado');
      if (documentoAsociado) {
        // Solo mantener la validación remota si es negocio = 1 (asociado)
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('negocio') === '1') {
          documentoAsociado.setAttribute('data-remote', '/core/user/validaraccionnegocio');
          documentoAsociado.setAttribute('required', 'required');
        } else {
          // Si no es asociado, quitar validación remota pero mantener como requerido
          documentoAsociado.removeAttribute('data-remote');
          documentoAsociado.setAttribute('required', 'required');
        }
      }

      // Quitar validación del documento asociado jurídica
      const pjDocumentoAsociado = document.getElementById('pj_documento_asociado');
      if (pjDocumentoAsociado) {
        pjDocumentoAsociado.removeAttribute('data-remote');
        pjDocumentoAsociado.removeAttribute('required');
      }

      // Quitar validación remota del NIT para persona natural
      const nitField = document.getElementById('pj_nit');
      if (nitField) {
        nitField.removeAttribute('data-remote');
      }

    } else if (tipoPersona === 'J') {
      // Persona Jurídica: agregar required a campos jurídicos, quitar de naturales
      juridicaFields.forEach(field => {
        // Para radio buttons, solo requerir uno del grupo
        if (field.type === 'radio') {
          // Para radio buttons, marcar required en todos los del mismo grupo
          if (field.name === 'pj_empleados_cargo') {
            field.setAttribute('required', 'required');
          }
        } else {
          field.setAttribute('required', 'required');
        }
      });

      // Agregar required a campos extra de jurídica
      juridicaExtraFields.forEach(field => {
        field.setAttribute('required', 'required');
      });

      naturalFields.forEach(field => {
        field.removeAttribute('required');
      });

      // Activar validaciones remotas para persona jurídica
      const pjRazonSocial = document.getElementById('pj_razon_social');
      if (pjRazonSocial) {
        pjRazonSocial.setAttribute('data-remote', '/core/user/validarpjrazonsocial');
      }

      const pjEmail = document.getElementById('pj_email_notificaciones');
      if (pjEmail) {
        pjEmail.setAttribute('data-remote', '/core/user/validarpjemail');
      }

      // Desactivar validaciones remotas para persona natural
      const pnEmail = document.getElementById('pn_email');
      if (pnEmail) {
        pnEmail.removeAttribute('data-remote');
      }

      // Para persona jurídica, quitar validación remota del documento_asociado natural
      const documentoAsociado = document.getElementById('documento_asociado');
      if (documentoAsociado) {
        documentoAsociado.removeAttribute('data-remote');
        documentoAsociado.removeAttribute('required');
      }

      // Agregar validación al documento asociado jurídica
      const pjDocumentoAsociado = document.getElementById('pj_documento_asociado');
      if (pjDocumentoAsociado) {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('negocio') === '1') {
          pjDocumentoAsociado.setAttribute('data-remote', '/core/user/validaraccionnegocio');
        }
        pjDocumentoAsociado.setAttribute('required', 'required');
      }

      // Activar validación remota del NIT para persona jurídica
      const nitField = document.getElementById('pj_nit');
      if (nitField) {
        nitField.setAttribute('data-remote', '/core/user/validarnit');
      }

    } else {
      // Sin selección: quitar required de todos
      naturalFields.forEach(field => field.removeAttribute('required'));
      juridicaFields.forEach(field => field.removeAttribute('required'));
      juridicaExtraFields.forEach(field => field.removeAttribute('required'));

      // Quitar todas las validaciones remotas cuando no hay selección
      const pnEmail = document.getElementById('pn_email');
      if (pnEmail) {
        pnEmail.removeAttribute('data-remote');
      }

      const pjRazonSocial = document.getElementById('pj_razon_social');
      if (pjRazonSocial) {
        pjRazonSocial.removeAttribute('data-remote');
      }

      const pjEmail = document.getElementById('pj_email_notificaciones');
      if (pjEmail) {
        pjEmail.removeAttribute('data-remote');
      }

      // Quitar validación remota cuando no hay selección
      const documentoAsociado = document.getElementById('documento_asociado');
      if (documentoAsociado) {
        documentoAsociado.removeAttribute('data-remote');
        documentoAsociado.removeAttribute('required');
      }

      const pjDocumentoAsociado = document.getElementById('pj_documento_asociado');
      if (pjDocumentoAsociado) {
        pjDocumentoAsociado.removeAttribute('data-remote');
        pjDocumentoAsociado.removeAttribute('required');
      }

      // Quitar validación remota del NIT cuando no hay selección
      const nitField = document.getElementById('pj_nit');
      if (nitField) {
        nitField.removeAttribute('data-remote');
      }
    }
  });
  // Añadir/remover socios dinámicamente
  document.getElementById('add-socio')?.addEventListener('click', () => {
    const tpl = document.querySelector('.pj-socio-row').cloneNode(true);
    tpl.querySelectorAll('input').forEach(i => i.value = '');
    document.getElementById('pj_socios_container').appendChild(tpl);
  });
  document.getElementById('pj_socios_container')?.addEventListener('click', e => {
    if (e.target.classList.contains('remove-socio'))
      e.target.closest('.pj-socio-row').remove();
  });

  document.addEventListener('DOMContentLoaded', function() {

    // Cargar municipios al seleccionar departamento
    document.getElementById('pn_departamento')?.addEventListener('change', function() {
      const departamentoId = this.value;
      const municipioSelect = document.getElementById('pn_municipio');
      municipioSelect.innerHTML = '<option value="" disabled selected>Seleccione…</option>';
      municipios.forEach(municipio => {
        if (municipio.departamento_id == departamentoId) {
          const option = document.createElement('option');
          option.value = municipio.id_municipio;
          option.textContent = municipio.municipio;
          municipioSelect.appendChild(option);
        }
      });


    });

    document.getElementById('pj_departamento')?.addEventListener('change', function() {
      const departamentoId = this.value;
      const municipioSelect = document.getElementById('pj_municipio');
      municipioSelect.innerHTML = '<option value="" disabled selected>Seleccione…</option>';
      municipios.forEach(municipio => {
        if (municipio.departamento_id == departamentoId) {
          const option = document.createElement('option');
          option.value = municipio.id_municipio;
          option.textContent = municipio.municipio;
          municipioSelect.appendChild(option);
        }
      });
    });
  });

  // Manejar errores de validación remota para documento_asociado
  document.addEventListener('DOMContentLoaded', function() {
    // No necesitamos JavaScript adicional para validación remota
    // Bootstrap Validator se encarga automáticamente usando data-remote
    // Solo necesitamos cargar municipios
  });
</script>