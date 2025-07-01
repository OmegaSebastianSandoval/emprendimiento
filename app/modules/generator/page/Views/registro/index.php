<div class="container py-5">
    <div class="row registro">
     <h1>Registro</h1>
        <form class="formulario-registro" action="/page/registro/insertar" enctype="multipart/form-data" data-toggle="validator"
            autocomplete="nope" method="post">
            <div class="form-group">
                <label for="usuario">Escoja el tipo de usuario</label>
                <select class="form-control" name="usuario" id="usuario" required onchange='cambiar_formulario();'>
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="2">Socio</option>
                    <option value="3">Invitado</option>
                    <option value="4">Expositor Socio</option>
                    <option value="5">Expositor Invitado</option>
                </select>
                <div class="help-block with-errors"></div>
            </div>
            <div id="form1" class="d-none">
                <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="correo">Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo" required placeholder="">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="telefono">Teléfono</label>
                    <input type="number" min="0" class="form-control" id="telefono" name="telefono" required placeholder="" data-remote="/core/user/validartelusuario">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group col-md-6" id="numero-accion">
                    <label for="accion" id="accion-label">Número de acción</label>
                    <input type="number" min="0" class="form-control" id="accion" name="accion" required placeholder=""
                        data-remote="/core/user/validaraccion">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group col-md-6" id="socio-nombre">
                    <label for="nombre_socio" id="nombre_socio-label">Nombre del socio que lo invito</label>
                    <input type="text" min="0" class="form-control" id="nombre_socio" name="nombre_socio" required placeholder=""
                       >
                    <div class="help-block with-errors"></div>
                </div>
                </div>
                <div class="form-row">
                <div class="form-group col-12">
                    <label for="usuario_persona">Cédula (usuario)</label>
                    <input type="text" class="form-control" id="usuario_persona" name="usuario_persona" required
                        placeholder="" data-remote="/core/user/validarusuario">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="contrasena_persona">Contraseña</label>
                    <input type="password" class="form-control" id="contrasena_persona" name="contrasena_persona"
                        required placeholder="" data-remote="/core/user/validarclave2">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="contrasena_persona" class="control-label">Repita la Contraseña</label>
                    <input type="password" value="" name="contrasena_personar" id="contrasena_personar"
                        data-match="#contrasena_persona" min="8" data-match-error="Las dos contrasenas no son iguales"
                        class="form-control" required>
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                </div>
            </div>
            <div id="form2" class="d-none">
                <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="negocio">Nombre del negocio</label>
                    <input type="text" class="form-control" name="negocio" required id="negocio" placeholder="">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="tiendas_imagen">Logo de la empresa</label>
                    <input type="file" name="tiendas_imagen" id="tiendas_imagen" class="form-control  file-image"
                        data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png">
                    <div class="help-block with-errors"></div>
                </div>
                </div>
                <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="pagina_web">Página web</label>
                    <input type="text" class="form-control" name="pagina_web" required id="pagina_web" placeholder="www.misitio.com">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group col-md-4">
                    <label for="facebook">Facebook</label>
                    <input type="text" class="form-control" name="facebook" required id="facebook" placeholder="@usuario">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group col-md-4">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" name="instagram" required id="instagram" placeholder="@usuario">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group col-md-4">
                    <label for="telefono_negocio">Teléfono</label>
                    <input type="number" min="0" class="form-control" name="telefono_negocio" required id="telefono_negocio" placeholder="" data-remote="/core/user/validartelnegocio">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group col-md-4">
                    <label for="whatsapp">Whatsapp</label>
                    <input type="number" min="0" class="form-control" name="whatsapp" required id="whatsapp" placeholder=""  data-remote="/core/user/validarwhatsappnegocio">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group col-md-4">
                    <label for="correo_negocio">Correo</label>
                    <input type="email" class="form-control" name="correo_negocio" required id="correo_negocio" placeholder="example@hotmail.com">
                    <div class="help-block with-errors"></div>
                </div>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción del negocio</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                </div>
                <div class="form-row">
                <div class="form-group col-md-6">
                <label for="categoria">Escoja la categoría del negocio</label>
                <select class="form-control" name="categoria" id="categoria" required>
                    <option disabled selected>Seleccione...</option>
                    <?php foreach($this->categorias as $key => $categoria){?>
                        <option value="<?php echo $categoria->categorias_id ?>"><?php echo $categoria->categorias_nombre ?></option>
                    <?php } ?>
                    
                </select>
                <div class="help-block with-errors"></div>
            </div>
        
            <div class="form-group col-md-6">
                    <label for="accion_negocio">Número de acción</label>
                    <input type="number" min="0" class="form-control" name="accion_negocio" required id="accion_negocio" placeholder=""  data-remote="/core/user/validaraccionnegocio">
                    <div class="help-block with-errors"></div>
                </div>
                </div>
                <div class="form-row">
                <div class="form-group col-12">
                    <label for="usuario_negocio">Cédula (usuario)</label>
                    <input type="number" min="0" class="form-control" name="usuario_negocio" required id="usuario_negocio" placeholder=""  data-remote="/core/user/validarnegocio">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="contrasena_negocio">Contraseña</label>
                    <input type="password" max="4" class="form-control" name="contrasena_negocio" required id="contrasena_negocio" placeholder=""  data-remote="/core/user/validarclave3">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="contrasena_negocio" class="control-label">Repita la Contraseña</label>
                    <input type="password" value="" max="4" name="contrasena_negocior" id="contrasena_negocior"
                        data-match="#contrasena_negocio" min="8" data-match-error="Las dos contrasenas no son iguales"
                        class="form-control" required>
                    </label>
                    <div class="help-block with-errors"></div>
                </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>
    </div>
</div>


<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-body">
                        No se ha podido enviar la solicitud de registro intentelo de nuevo
                    </div>

                </div>
            </div>
        </div>
<script>
	<?php if($_GET['error']=="true"){ ?>
	$('#myModal2').modal('show');
	<?php } ?>
</script>
<script>
function cambiar_formulario() {
    var usuario = $("#usuario").val();
    if (usuario == 2 || usuario == 3) {
        if(usuario == 3){
            $("#socio-nombre").removeClass("d-none");
            $("#numero-accion").addClass("d-none");
            $("#socio-nombre").children("input").prop('required', true);
            $("#numero-accion").children("input").prop('required', false);
        }else if(usuario == 2 ){
            $("#socio-nombre").addClass("d-none");
            $("#numero-accion").removeClass("d-none");
            $("#numero-accion").children("input").prop('required', true);
            $("#socio-nombre").children("input").prop('required', false);
          
        }
        $('#form2').addClass("d-none");
        $('#form1').removeClass("d-none");
        $("#form2 .form-group").children("input").prop('required', false);
        $("#form1 .form-group").children("input").prop('required', true);
        $("#form2 .form-group").children("input").val("");
        $("#form2 .form-group").children("select").val("");
        $("#form2 .form-group").children("textarea").val("");
    } else if (usuario == 4 || usuario == 5) {
        $('#form2').removeClass("d-none");
        $('#form1').addClass("d-none");
        $("#form1 .form-group").children("input").prop('required', false);
        $("#form2 .form-group").children("input").prop('required', true);
        $("#form1 .form-group").children("input").val("");
        $("#form2 .form-group").children("select").val("");
        $("#form2 .form-group").children("textarea").val("");
        $("#whatsapp").prop('required', false);
        $("#instagram").prop('required', false);
        $("#facebook").prop('required', false);
        $("#pagina_web").prop('required', false);
    }
}
</script>