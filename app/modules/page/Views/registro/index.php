<div class="container py-5">
    <div class="registro">
        <h1>Registro de emprendimiento</h1>
        <form class="formulario-registro" action="/page/registro/insertar" enctype="multipart/form-data" method="post"
            id="formulario-registro" autocomplete="off">
            <div class="row">
                <!-- 1. Tipo de persona -->
                <div class="form-group mb-4 col-md-4">
                    <label for="persona_tipo">Tipo de persona</label>
                    <select class="form-control" name="persona_tipo" id="persona_tipo" required>
                        <option value="" disabled selected>Seleccione...</option>
                        <option value="N">Persona Natural</option>
                        <option value="J">Persona Jurídica</option>
                    </select>
                </div>

                <!-- 2. Sección Persona Natural -->
                <div id="form_natural" class="w-100 d-none">
                    <h3>Datos Persona Natural</h3>
                    <div class="row">
                        <div class="form-group mb-3 col-md-6">
                            <label for="pn_nombres">Nombres</label>
                            <input type="text" class="form-control" name="pn_nombres" id="pn_nombres" required>
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label for="pn_apellidos">Apellidos</label>
                            <input type="text" class="form-control" name="pn_apellidos" id="pn_apellidos" required>
                        </div>
                        <div class="form-group mb-3 col-md-4">
                            <label for="pn_cedula">Cédula</label>
                            <input type="text" class="form-control" name="pn_cedula" id="pn_cedula" required>
                        </div>
                        <div class="form-group mb-3 col-md-4">
                            <label for="pn_fecha_nacimiento">Fecha de nacimiento</label>
                            <input type="date" class="form-control" name="pn_fecha_nacimiento" id="pn_fecha_nacimiento"
                                required>
                        </div>
                        <div class="form-group mb-3 col-md-4">
                            <label for="pn_telefono_contacto">Teléfono de contacto</label>
                            <input type="text" class="form-control" name="pn_telefono_contacto"
                                id="pn_telefono_contacto" required>
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label for="pn_email">Correo electrónico</label>
                            <input type="email" class="form-control" name="pn_email" id="pn_email" required>
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label for="pn_direccion">Dirección</label>
                            <input type="text" class="form-control" name="pn_direccion" id="pn_direccion" required>
                        </div>
                        <!-- Aquí puedes añadir más campos de declaraciones/autorizaciones si los necesitas -->
                    </div>
                </div>

                <!-- 3. Sección Persona Jurídica -->
                <div id="form_juridica" class="w-100 d-none">
                    <h3>Datos Persona Jurídica</h3>
                    <div class="row">
                        <div class="form-group mb-3 col-md-6">
                            <label for="pj_razon_social">Razón Social</label>
                            <input type="text" class="form-control" name="pj_razon_social" id="pj_razon_social"
                                required>
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label for="pj_nit">NIT</label>
                            <input type="text" class="form-control" name="pj_nit" id="pj_nit" required>
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label for="pj_email_notificaciones">E-mail notificaciones</label>
                            <input type="email" class="form-control" name="pj_email_notificaciones"
                                id="pj_email_notificaciones" required>
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label for="pj_telefono">Teléfono</label>
                            <input type="text" class="form-control" name="pj_telefono" id="pj_telefono" required>
                        </div>
                        <div class="form-group mb-3 col-md-12">
                            <label for="pj_direccion">Dirección domicilio principal</label>
                            <input type="text" class="form-control" name="pj_direccion" id="pj_direccion" required>
                        </div>
                        <div class="form-group mb-3 col-md-4">
                            <label for="pj_departamento">Departamento</label>
                            <input type="text" class="form-control" name="pj_departamento" id="pj_departamento"
                                required>
                        </div>
                        <div class="form-group mb-3 col-md-4">
                            <label for="pj_ciudad">Ciudad</label>
                            <input type="text" class="form-control" name="pj_ciudad" id="pj_ciudad" required>
                        </div>
                        <div class="form-group mb-3 col-md-4">
                            <label for="pj_pagina_web">Página web</label>
                            <input type="text" class="form-control" name="pj_pagina_web" id="pj_pagina_web">
                        </div>
                        <div class="form-group mb-3 col-md-4">
                            <label for="pj_ciiu">Código CIIU</label>
                            <input type="text" class="form-control" name="pj_ciiu" id="pj_ciiu">
                        </div>
                        <div class="form-group mb-3 col-md-4">
                            <label for="pj_tipo_empresa">Tipo de empresa</label>
                            <select class="form-control" name="pj_tipo_empresa" id="pj_tipo_empresa" required>
                                <option value="" disabled selected>Seleccione…</option>
                                <option value="Pública">Pública</option>
                                <option value="Privada">Privada</option>
                                <option value="Mixta">Mixta</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-md-4">
                            <label>Empleados a cargo</label><br>
                            <label><input type="radio" name="pj_empleados_cargo" value="1"> Sí</label>
                            <label class="ml-3"><input type="radio" name="pj_empleados_cargo" value="0"> No</label>
                        </div>
                        <!-- Representante legal -->
                        <div class="w-100">
                            <h4>Representante Legal</h4>
                        </div>
                        <div class="form-group mb-3 col-md-4">
                            <label for="pj_rep_apellido1">Primer Apellido</label>
                            <input type="text" class="form-control" name="pj_rep_apellido1" id="pj_rep_apellido1"
                                required>
                        </div>
                        <div class="form-group mb-3 col-md-4">
                            <label for="pj_rep_apellido2">Segundo Apellido</label>
                            <input type="text" class="form-control" name="pj_rep_apellido2" id="pj_rep_apellido2">
                        </div>
                        <div class="form-group mb-3 col-md-4">
                            <label for="pj_rep_nombres">Nombres</label>
                            <input type="text" class="form-control" name="pj_rep_nombres" id="pj_rep_nombres" required>
                        </div>
                        <div class="form-group mb-3 col-md-4">
                            <label for="pj_rep_id_tipo">Tipo de identidad</label>
                            <select class="form-control" name="pj_rep_id_tipo" id="pj_rep_id_tipo" required>
                                <option value="" disabled selected>Seleccione…</option>
                                <option value="C.C.">C.C.</option>
                                <option value="NIT">NIT</option>
                                <option value="C.E.">C.E.</option>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-md-4">
                            <label for="pj_rep_id_numero">Número identidad</label>
                            <input type="text" class="form-control" name="pj_rep_id_numero" id="pj_rep_id_numero"
                                required>
                        </div>
                        <div class="form-group mb-3 col-md-4">
                            <label for="pj_rep_expedicion_lugar">Lugar expedición</label>
                            <input type="text" class="form-control" name="pj_rep_expedicion_lugar"
                                id="pj_rep_expedicion_lugar" required>
                        </div>
                        <div class="form-group mb-3 col-md-4">
                            <label for="pj_rep_expedicion_fecha">Fecha expedición</label>
                            <input type="date" class="form-control" name="pj_rep_expedicion_fecha"
                                id="pj_rep_expedicion_fecha" required>
                        </div>
                        <div class="form-group mb-3 col-md-4">
                            <label for="pj_rep_nacionalidad">Nacionalidad</label>
                            <input type="text" class="form-control" name="pj_rep_nacionalidad" id="pj_rep_nacionalidad"
                                required>
                        </div>
                        <div class="form-group mb-3 col-md-4">
                            <label for="pj_rep_fecha_nacimiento">Fecha nacimiento</label>
                            <input type="date" class="form-control" name="pj_rep_fecha_nacimiento"
                                id="pj_rep_fecha_nacimiento" required>
                        </div>
                        <div class="form-group mb-3 col-md-4">
                            <label for="pj_rep_lugar_nacimiento">Lugar nacimiento</label>
                            <input type="text" class="form-control" name="pj_rep_lugar_nacimiento"
                                id="pj_rep_lugar_nacimiento" required>
                        </div>
                        <!-- Aquí podrías añadir más bloques: financieros, bancarios, referencias… -->
                    </div>
                </div>
                <div class="row">

                    <div class="form-group mb-4 col-md-4">
                        <label for="usuario">Escoja el tipo de usuario</label>
                        <select class="form-control" name="usuario" id="usuario" required
                            onchange='cambiar_formulario();'>
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
                    <div class="form-group mb-4 col-md-4">
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
                    <?php if ($_GET['negocio'] == "1") { ?>
                        <div class="form-group mb-4 col-md-4">
                            <label for="documento_asociado">Número de documento</label>
                            <input type="number" min="0" class="form-control" name="documento_asociado" required
                                id="documento_asociado" placeholder="" data-error="Número de documento no válido"
                                data-remote="/core/user/validaraccionnegocio" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    <?php } ?>
                    <?php if ($_GET['invitado'] == "1") { ?>
                        <div class="form-group mb-4 col-md-4">
                            <label for="documento_asociado">Número de documento</label>
                            <input type="number" min="0" class="form-control" name="documento_asociado" required
                                id="documento_asociado" placeholder="" data-error="Número de documento no válido" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    <?php } ?>



                    <div class="form-group mb-4 col-md-6">
                        <label for="negocio">Nombre del negocio</label>
                        <input type="text" class="form-control" name="negocio"
                            data-error="El nombre del negocio es obligatorio" required id="negocio" placeholder="">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group mb-4 col-md-6">
                        <label for="tiendas_imagen">Logo de la empresa</label>
                        <input type="file" name="tiendas_imagen" id="tiendas_imagen" class="form-control  file-image"
                            data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png">
                        <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group mb-4 col-md-4">
                        <label for="pagina_web">Página web</label>
                        <input type="text" class="form-control" name="pagina_web" required id="pagina_web"
                            placeholder="www.misitio.com">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group mb-4 col-md-4">
                        <label for="facebook">Facebook</label>
                        <input type="text" class="form-control" name="facebook" required id="facebook"
                            placeholder="@usuario">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group mb-4 col-md-4">
                        <label for="instagram">Instagram</label>
                        <input type="text" class="form-control" name="instagram" required id="instagram"
                            placeholder="@usuario">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group mb-4 col-md-4">
                        <label for="telefono_negocio">Teléfono</label>
                        <input type="number" min="0" class="form-control" name="telefono_negocio" required
                            id="telefono_negocio" placeholder=""
                            data-error="El número de telefono debe ser minimo de 7 dígitos o máximo de 10 dígitos"
                            data-remote="/core/user/validartelnegocio">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group mb-4 col-md-4">
                        <label for="whatsapp">Whatsapp</label>
                        <input type="number" min="0" class="form-control" name="whatsapp" required id="whatsapp"
                            placeholder="" data-error="El numero de whatsapp debe ser de 10 dígitos"
                            data-remote="/core/user/validarwhatsappnegocio">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group mb-4 col-md-4">
                        <label for="correo_negocio">Correo</label>
                        <input type="email" class="form-control" name="correo_negocio" required id="correo_negocio"
                            data-error="Correo no válido" placeholder="example@hotmail.com">
                        <div class="help-block with-errors"></div>
                    </div>


                    <div class="form-group mb-4 mt-4">
                        <label for="descripcion">Descripción del negocio</label>
                        <textarea class="form-control tinyeditor-simple" id="descripcion" name="descripcion" rows="3"
                            required></textarea>
                    </div>


                </div>


                <!--  Lugar y fecha del diligenciamiento -->
    <div class="form-group mb-3 col-md-6">
      <label for="pn_ciudad_diligenciamiento">Ciudad de diligenciamiento</label>
      <input type="text" class="form-control" name="pn_ciudad_diligenciamiento" id="pn_ciudad_diligenciamiento" required>
    </div>
    <div class="form-group mb-3 col-md-6">
      <label for="pn_fecha_diligenciamiento">Fecha de diligenciamiento</label>
      <input type="date" class="form-control" name="pn_fecha_diligenciamiento" id="pn_fecha_diligenciamiento" required>
    </div>

    <!-- Declaraciones y autorizaciones -->
    <div class="form-group mb-3 col-12">
      <label>Declaraciones y autorizaciones</label><br>
      <label><input type="checkbox" name="pn_decl_origen" required> Declaración de origen lícito</label><br>
      <label><input type="checkbox" name="pn_decl_listas_sanciones" required> No estoy en listas ONU/OFAC/EU</label><br>
      <label><input type="checkbox" name="pn_aut_riesgo" required> Autorización consulta CIFIN</label><br>
      <label><input type="checkbox" name="pn_aut_datos" required> Autorización tratamiento datos personales</label><br>
      <label><input type="checkbox" name="pn_aut_imagen" required> Autorización uso de imagen corporativa</label>
    </div>

    <!-- Documentos para adjuntar -->
    <div class="form-group mb-3 col-md-6">
      <label for="pn_doc_identidad">Copia documento identidad</label>
      <input type="file" class="form-control" name="pn_doc_identidad" id="pn_doc_identidad" required accept="image/*,application/pdf">
    </div>
    <div class="form-group mb-3 col-md-6">
      <label for="pn_doc_declaracion_origen">Declaración de origen (PDF)</label>
      <input type="file" class="form-control" name="pn_doc_declaracion_origen" id="pn_doc_declaracion_origen" required accept="application/pdf">
    </div>

    <!-- Firma y huella -->
    <div class="form-group mb-3 col-md-6">
      <label for="pn_firma">Firma (imagen o PDF)</label>
      <input type="file" class="form-control" name="pn_firma" id="pn_firma" required accept="image/*,application/pdf">
    </div>
    <div class="form-group mb-3 col-md-6">
      <label for="pn_huella">Huella (imagen)</label>
      <input type="file" class="form-control" name="pn_huella" id="pn_huella" required accept="image/*">
    </div>
  </div>
</div>

<!-- — Persona Jurídica — -->
<div id="form_juridica" class="w-100 d-none">
  <h3>Datos Persona Jurídica</h3>
  <div class="row">
    <!-- Ciudad y fecha diligenciamiento -->
    <div class="form-group mb-3 col-md-6">
      <label for="pj_ciudad_diligenciamiento">Ciudad de diligenciamiento</label>
      <input type="text" class="form-control" name="pj_ciudad_diligenciamiento" id="pj_ciudad_diligenciamiento" required>
    </div>
    <div class="form-group mb-3 col-md-6">
      <label for="pj_fecha_diligenciamiento">Fecha de diligenciamiento</label>
      <input type="date" class="form-control" name="pj_fecha_diligenciamiento" id="pj_fecha_diligenciamiento" required>
    </div>

    <!-- Tipo de solicitud -->
    <div class="form-group mb-3 col-md-12">
      <label>Tipo de solicitud</label><br>
      <label><input type="radio" name="pj_tipo_solicitud" value="Nuevo" required> Nuevo</label>
      <label class="ml-4"><input type="radio" name="pj_tipo_solicitud" value="Actualización"> Actualización de datos</label>
    </div>

    <!-- Fax -->
    <div class="form-group mb-3 col-md-6">
      <label for="pj_fax">Fax</label>
      <input type="text" class="form-control" name="pj_fax" id="pj_fax">
    </div>

    <!-- Recursos/poder público/reconocimiento público/vínculo PEP -->
    <div class="form-group mb-3 col-md-6">
      <label>¿Maneja recursos públicos?</label><br>
      <label><input type="radio" name="pj_recursos_publicos" value="1" required> Sí</label>
      <label class="ml-3"><input type="radio" name="pj_recursos_publicos" value="0"> No</label>
    </div>
    <div class="form-group mb-3 col-md-6">
      <label>¿Ejerció poder público?</label><br>
      <label><input type="radio" name="pj_poder_publico" value="1" required> Sí</label>
      <label class="ml-3"><input type="radio" name="pj_poder_publico" value="0"> No</label>
    </div>
    <div class="form-group mb-3 col-md-12">
      <label>¿Reconocimiento público?</label><br>
      <label><input type="radio" name="pj_reconocimiento" value="1" required> Sí</label>
      <label class="ml-3"><input type="radio" name="pj_reconocimiento" value="0"> No</label>
      <input type="text" class="form-control mt-2" name="pj_reconocimiento_detalle" placeholder="¿Cuál y hace cuánto?">
    </div>
    <div class="form-group mb-3 col-md-12">
      <label>¿Vínculo con PEP?</label><br>
      <label><input type="radio" name="pj_pep" value="1" required> Sí</label>
      <label class="ml-3"><input type="radio" name="pj_pep" value="0"> No</label>
      <textarea class="form-control mt-2" name="pj_pep_detalle" placeholder="Nombres e identificación de la(s) PEP"></textarea>
    </div>

    <!-- Identificación de socios (>5%) -->
    <div class="form-group mb-3 col-12">
      <label>Socios/Accionistas (>5% capital)</label>
      <div id="pj_socios_container">
        <div class="row mb-2 pj-socio-row">
          <div class="col-md-3">
            <input type="text" class="form-control" name="pj_socio_nombre[]" placeholder="Denominación social">
          </div>
          <div class="col-md-2">
            <select class="form-control" name="pj_socio_id_tipo[]">
              <option value="P.P.">P.P.</option><option value="C.C.">C.C.</option>
              <option value="C.E.">C.E.</option><option value="C.D.">C.D.</option>
              <option value="NIT">NIT</option>
            </select>
          </div>
          <div class="col-md-3">
            <input type="text" class="form-control" name="pj_socio_id_numero[]" placeholder="No. identificación">
          </div>
          <div class="col-md-2">
            <input type="number" class="form-control" name="pj_socio_porcentaje[]" placeholder="% participación">
          </div>
          <div class="col-md-2">
            <button type="button" class="btn btn-sm btn-outline-danger remove-socio">–</button>
          </div>
        </div>
      </div>
      <button type="button" class="btn btn-sm btn-outline-primary" id="add-socio">Añadir socio</button>
    </div>

    <!-- Información financiera y tributaria -->
    <div class="form-group mb-3 col-md-4">
      <label for="pj_patrimonio">Patrimonio (COP)</label>
      <input type="number" class="form-control" name="pj_patrimonio" id="pj_patrimonio" required>
    </div>
    <div class="form-group mb-3 col-md-4">
      <label for="pj_activos">Activos (COP)</label>
      <input type="number" class="form-control" name="pj_activos" id="pj_activos" required>
    </div>
    <div class="form-group mb-3 col-md-4">
      <label for="pj_pasivos">Pasivos (COP)</label>
      <input type="number" class="form-control" name="pj_pasivos" id="pj_pasivos" required>
    </div>
    <div class="form-group mb-3 col-md-4">
      <label for="pj_ingresos_mensuales">Ingresos mensuales (COP)</label>
      <input type="number" class="form-control" name="pj_ingresos_mensuales" id="pj_ingresos_mensuales" required>
    </div>
    <div class="form-group mb-3 col-md-4">
      <label for="pj_otros_ingresos">Otros ingresos (COP)</label>
      <input type="number" class="form-control" name="pj_otros_ingresos" id="pj_otros_ingresos">
    </div>
    <div class="form-group mb-3 col-md-4">
      <label for="pj_egresos_mensuales">Egresos mensuales (COP)</label>
      <input type="number" class="form-control" name="pj_egresos_mensuales" id="pj_egresos_mensuales" required>
    </div>
    <div class="form-group mb-3 col-md-4">
      <label for="pj_otros_egresos">Otros egresos (COP)</label>
      <input type="number" class="form-control" name="pj_otros_egresos" id="pj_otros_egresos">
    </div>

    <!-- Origen de fondos -->
    <div class="form-group mb-3 col-md-12">
      <label for="pj_origen_fondos">Origen de los fondos</label>
      <textarea class="form-control" name="pj_origen_fondos" id="pj_origen_fondos" rows="2" required></textarea>
    </div>

    <!-- Régimen tributario y declaraciones -->
    <div class="form-group mb-3 col-md-6">
      <label>Tipo de contribuyente</label>
      <select class="form-control" name="pj_tipo_contribuyente" required>
        <option value="Simplificado">Régimen Simplificado</option>
        <option value="Comun">Régimen Común</option>
        <option value="Especial">Régimen Especial</option>
        <option value="Otro">Otro</option>
      </select>
    </div>
    <div class="form-group mb-3 col-md-6">
      <label>Gran contribuyente</label><br>
      <label><input type="radio" name="pj_gran_contribuyente" value="1" required> Sí</label>
      <label class="ml-3"><input type="radio" name="pj_gran_contribuyente" value="0"> No</label>
      <input type="text" class="form-control mt-2" name="pj_gran_contribuyente_resolucion" placeholder="N° Resolución">
    </div>
    <div class="form-group mb-3 col-md-6">
      <label>Autorretenedor</label><br>
      <label><input type="radio" name="pj_autorretenedor" value="1" required> Sí</label>
      <label class="ml-3"><input type="radio" name="pj_autorretenedor" value="0"> No</label>
    </div>
    <div class="form-group mb-3 col-md-6">
      <label>Declarante de Renta</label><br>
      <label><input type="radio" name="pj_declarante_renta" value="1" required> Sí</label>
      <label class="ml-3"><input type="radio" name="pj_declarante_renta" value="0"> No</label>
    </div>
    <div class="form-group mb-3 col-md-6">
      <label>Declarante de Patrimonio</label><br>
      <label><input type="radio" name="pj_declarante_patrimonio" value="1" required> Sí</label>
      <label class="ml-3"><input type="radio" name="pj_declarante_patrimonio" value="0"> No</label>
    </div>

    <!-- Información bancaria -->
    <div class="form-group mb-3 col-md-12">
      <label>Información bancaria</label>
      <div class="row mb-2">
        <div class="col-md-4"><input type="text" class="form-control" name="pj_banco_entidad[]" placeholder="Entidad bancaria"></div>
        <div class="col-md-4">
          <select class="form-control" name="pj_banco_tipo[]">
            <option value="Corriente">Corriente</option>
            <option value="Ahorros">Ahorros</option>
          </select>
        </div>
        <div class="col-md-4"><input type="text" class="form-control" name="pj_banco_numero[]" placeholder="No. cuenta"></div>
      </div>
      <!-- duplicar otra fila -->
      <div class="row">
        <div class="col-md-4"><input type="text" class="form-control" name="pj_banco_entidad[]" placeholder="Entidad bancaria"></div>
        <div class="col-md-4">
          <select class="form-control" name="pj_banco_tipo[]">
            <option value="Corriente">Corriente</option>
            <option value="Ahorros">Ahorros</option>
          </select>
        </div>
        <div class="col-md-4"><input type="text" class="form-control" name="pj_banco_numero[]" placeholder="No. cuenta"></div>
      </div>
    </div>

    <!-- Operaciones internacionales -->
    <div class="form-group mb-3 col-md-6">
      <label>Transacciones en moneda extranjera</label><br>
      <label><input type="radio" name="pj_trans_ext" value="1" required> Sí</label>
      <label class="ml-3"><input type="radio" name="pj_trans_ext" value="0"> No</label>
      <input type="text" class="form-control mt-2" name="pj_trans_ext_detalle" placeholder="¿Cuál?">
    </div>
    <div class="form-group mb-3 col-md-6">
      <label>Productos financieros en el exterior</label><br>
      <label><input type="radio" name="pj_prod_ext" value="1" required> Sí</label>
      <label class="ml-3"><input type="radio" name="pj_prod_ext" value="0"> No</label>
    </div>
    <div class="form-group mb-3 col-md-12">
      <label>Detalle productos/ext</label>
      <textarea class="form-control" name="pj_prod_ext_detalle" rows="2" placeholder="Tipo, No., Entidad, Monto, Moneda, Ciudad, País"></textarea>
    </div>

    <!-- Referencias comerciales -->
    <div class="form-group mb-3 col-12">
      <label>Referencias Comerciales</label>
      <table class="table table-sm">
        <thead>
          <tr>
            <th>Empresa</th><th>Ciudad</th><th>Contacto</th><th>Teléfono</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="text" class="form-control" name="pj_ref_empresa[]"></td>
            <td><input type="text" class="form-control" name="pj_ref_ciudad[]"></td>
            <td><input type="text" class="form-control" name="pj_ref_contacto[]"></td>
            <td><input type="text" class="form-control" name="pj_ref_telefono[]"></td>
          </tr>
          <!-- puedes duplicar más filas si hace falta -->
        </tbody>
      </table>
    </div>

    <!-- Documentos para adjuntar -->
    <div class="form-group mb-3 col-md-4">
      <label for="pj_doc_existencia">Certificado existencia y rep. legal</label>
      <input type="file" class="form-control" name="pj_doc_existencia" id="pj_doc_existencia" required accept="application/pdf">
    </div>
    <div class="form-group mb-3 col-md-4">
      <label for="pj_doc_rut">Fotocopia RUT</label>
      <input type="file" class="form-control" name="pj_doc_rut" id="pj_doc_rut" required accept="application/pdf">
    </div>
    <div class="form-group mb-3 col-md-4">
      <label for="pj_doc_rep_legal">Copia doc. identidad Rep. Legal</label>
      <input type="file" class="form-control" name="pj_doc_rep_legal" id="pj_doc_rep_legal" required accept="application/pdf">
    </div>
    <div class="form-group mb-3 col-md-4">
      <label for="pj_doc_estados_financieros">Estados Financieros</label>
      <input type="file" class="form-control" name="pj_doc_estados_financieros" id="pj_doc_estados_financieros" accept="application/pdf">
    </div>
    <div class="form-group mb-3 col-md-4">
      <label for="pj_doc_cert_bancaria">Certificación Bancaria</label>
      <input type="file" class="form-control" name="pj_doc_cert_bancaria" id="pj_doc_cert_bancaria" accept="application/pdf">
    </div>

    <!-- Verificación interna FENDESA (solo lectura para el asistente) -->
    <div class="form-group mb-3 col-md-12">
      <label>Verificación (uso exclusivo FENDESA)</label>
      <div class="row">
        <div class="col-md-3"><input type="text" class="form-control" name="pj_verif_asistente_nombre" placeholder="Nombre Asistente"></div>
        <div class="col-md-3"><input type="datetime-local" class="form-control" name="pj_verif_asistente_fecha"></div>
        <div class="col-md-3"><input type="text" class="form-control" name="pj_verif_oficial_nombre" placeholder="Nombre Oficial"></div>
        <div class="col-md-3"><input type="datetime-local" class="form-control" name="pj_verif_oficial_fecha"></div>
      </div>
      <div class="row mt-2">
        <div class="col-md-6"><textarea class="form-control" name="pj_verif_medios" placeholder="Medios utilizados / códigos de consulta"></textarea></div>
        <div class="col-md-6"><textarea class="form-control" name="pj_verif_obs" placeholder="Observaciones adicionales"></textarea></div>
      </div>
      <div class="row mt-2">
        <div class="col-md-4">
          <label>Resultado</label><br>
          <label><input type="radio" name="pj_verif_resultado" value="Aceptado"> Aceptado</label><br>
          <label><input type="radio" name="pj_verif_resultado" value="Rechazado"> Rechazado</label>
        </div>
        <div class="col-md-4"><input type="text" class="form-control" name="pj_verif_responsable" placeholder="Responsable grabación"></div>
        <div class="col-md-4"><input type="datetime-local" class="form-control" name="pj_verif_grabacion_fecha"></div>
      </div>
    </div>
  </div>
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
    $(document).ready(function () {
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

    function cambiar_formulario () {
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

    function f1 () {
        cambiar_formulario();
    }
    setTimeout('f1()', 1000);
    setTimeout('f1()', 3000);
    setTimeout('f1()', 5000);
</script>
<!-- <script>
   document.getElementById("usuario_persona").addEventListener("change", myFunction);
   function myFunction() {
       alert("hola");
    if($('#cedula').hasClass("has-error")){
                console.log("hola");
                $('#recuperar').removeClass("d-none");
                $('#recuperar').addClass("d-block");
            }else{
                $('#recuperar').removeClass("d-block");
                $('#recuperar').addClass("d-none");
            }
}
</script> -->
<style>
    .main-general {
        /* min-height: calc(100dvh - 436px); */
    }

    body {
        /* margin-top: 55px; */
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const formulario = document.getElementById("formulario-registro");
        const buttonSend = document.getElementById("button-send");
        formulario.addEventListener("submit", function (event) {
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
// — JS para alternar formularios y deshabilitar botón como tenías antes —
document.getElementById('persona_tipo').addEventListener('change', function () {
  document.getElementById('form_natural').classList.toggle('d-none', this.value!=='N');
  document.getElementById('form_juridica').classList.toggle('d-none', this.value!=='J');
});
// Añadir/remover socios dinámicamente
document.getElementById('add-socio').addEventListener('click', () => {
  const tpl = document.querySelector('.pj-socio-row').cloneNode(true);
  tpl.querySelectorAll('input').forEach(i=>i.value='');
  document.getElementById('pj_socios_container').appendChild(tpl);
});
document.getElementById('pj_socios_container').addEventListener('click', e => {
  if (e.target.classList.contains('remove-socio'))
    e.target.closest('.pj-socio-row').remove();
});
</script>