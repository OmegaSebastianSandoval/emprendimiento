


<div class="pt-5">
   
        <?php if($_GET['registro']==1){ ?>
        <div class="alert alert-warning">Estimado usuario, su registro se realizó de forma exitosa. por favor ingrese su
            información de acceso:</div>
        <?php } ?>
        
        <div align="center" class="caja_registro alto-login">
        <div class="col-md-12 col-lg-5">
        <ul class="nav nav-tabs" id="v-pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link  <?php if($_GET['invitado']!="1"){ echo ' active ';} ?>" id="v-pills-socio-tab" data-toggle="pill" href="#v-pills-socio" role="tab" aria-controls="v-pills-socio" aria-selected="true">Socio</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if($_GET['invitado']=="1"){ echo ' active ';} ?>" id="v-pills-invitado-tab" data-toggle="pill" href="#v-pills-invitado" role="tab" aria-controls="v-pills-invitado" aria-selected="true">Invitado</a>
  </li>

</ul>
        </div>
            <div class="col-md-12 col-lg-5 form-group caja-login">
            <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade <?php if($_GET['invitado']!="1"){ echo ' show active ';} ?>" id="v-pills-socio" role="tabpanel" aria-labelledby="v-pills-socio-tab">
            <form method="post" action="/page/login/login" class="col-md-12 ">
                <div class="col-sm-12 col-md-12 margen_icono">
                    <div class="row">
                        <!-- <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
                        Si es su primera visita, recuerde crear su usuario y contraseña de ingreso
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>  -->
                       

                        <div class="col-md-12 text-left">
                            <h3 class="titulo-verde1">Documento de identificación</h3>
                        </div>
                        <div class="col-md-12"><input type="text" name="cedula" required
                                class="form-control texto_normal campo_login" value="<?php echo $_GET['usuario']; ?>"
                                placeholder=""></div>

                    </div>
                </div>

                <div class="col-sm-12 col-md-12">
                    <div class="row">
                        <div class="col-md-12 text-left">
                            <h3 class="titulo-verde1">Número de acción</h3>
                        </div>
                        <div class="col-md-12"><input type="password" name="clave" required
                                class="form-control texto_normal campo_login" value="" placeholder=""></div>
                    </div>
                </div>
                <?php if ($_GET['error']=="1"): ?>
                            <div class="col-md-12"><br></div>
                            <div class="alert alert-danger col-md-12 text-center">El documento no es válido</div>
                            <?php endif ?>
                            <?php if ($_GET['error']=="2"): ?>
                            <div class="col-md-12"><br></div>
                            <div class="alert alert-danger col-md-12 text-center">Usuario inactivo</div>
                            <?php endif ?>
                            <?php if ($_GET['error']=="3"): ?>
                            <div class="col-md-12"><br></div>
                            <div class="alert alert-danger col-md-12 text-center">Usuario no permitido</div>
                            <?php endif ?>
                <div>
                    <div class="col-sm-12 caja-boton-login my-3 justify-content-center">
                        <div class="ingresar">
                            <button class="btn btn-primary enviar" type="submit">Ingresar</button>
                        </div>
                        <!-- <div class="olvido">
                            <a href="#" data-toggle="modal" data-target="#olvido" class="enlace">¿Olvidó de
                                contraseña?</a> <span class="azul d-none"></span>   
                                 <small id="emailHelp" class="form-text text-muted m-0">Recuerde cambiar su contraseña periódicamente</small>
                                   
                            <a href="#" data-toggle="modal" data-target="#olvidousuario" class="enlace">¿Olvidó de
                                usuario?</a> <span class="azul d-none"></span>
                        </div> -->

                    </div>
                   
                </div>
                <div class="col-md-12">
                    <div class="row no-gutters align-items-center">

                        <div class="linea1 col-4">
                        </div>
                        <div class="linea2 col-4">
                        </div>
                        <div class="linea1 col-4">
                        </div>

                    </div>
                </div>
                <div class="col-md-12 registro-login text-center my-3">
                    <span>Registrar negocio</span>
                    <a href="/page/registro?negocio=1" class="enlace">Registrar</a>
                </div>



          
            </form>
            </div>
            <div class="tab-pane fade <?php if($_GET['invitado']=="1"){ echo ' show active ';} ?>" id="v-pills-invitado" role="tabpanel" aria-labelledby="v-pills-invitado-tab">
            <form method="post" action="/page/login/login2" class="col-md-12 ">
                <div class="col-sm-12 col-md-12 margen_icono">
                    <div class="row">
                        <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
                        Si es su primera visita, recuerde crear su usuario de ingreso
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div> 
                       

                        <div class="col-md-12 text-left">
                            <h3 class="titulo-verde1">Cédula o usuario</h3>
                        </div>
                       
                        <div class="col-md-12"><input type="text" name="usuario" required
                                class="form-control texto_normal campo_login" value="<?php echo $_GET['usuario']; ?>"
                                placeholder=""></div>
                                <?php if ($_GET['error']=="1"): ?>
                            <div class="col-md-12"><br></div>
                            <div class="alert alert-danger col-md-12 text-center">El documento no es válido</div>
                            <?php endif ?>
                            <?php if ($_GET['error']=="2"): ?>
                            <div class="col-md-12"><br></div>
                            <div class="alert alert-danger col-md-12 text-center">Usuario inactivo</div>
                            <?php endif ?>
                            <?php if ($_GET['error']=="3"): ?>
                            <div class="col-md-12"><br></div>
                            <div class="alert alert-danger col-md-12 text-center">Usuario no permitido</div>
                            <?php endif ?>

                    </div>
                </div>

                <div>
                    <div class="col-sm-12 caja-boton-login my-3">
                        <div class="ingresar">
                            <button class="btn btn-primary enviar" type="submit">Ingresar</button>
                        </div>
                        <div class="olvido">                                   
                            <a href="#" data-toggle="modal" data-target="#olvidousuario" class="enlace">¿Olvidó su usuario?</a> <span class="azul d-none"></span>
                        </div>

                    </div>
                   
                </div>
                <div class="col-md-12">
                    <div class="row no-gutters align-items-center">

                        <div class="linea1 col-4">
                        </div>
                        <div class="linea2 col-4">
                        </div>
                        <div class="linea1 col-4">
                        </div>

                    </div>
                </div>
                <div class="col-md-12 registro-login text-center my-3">
                    <span>Registro</span>
                    <a href="/page/registro/?invitado=1" class="enlace">Crear cuenta</a>
                </div>



          
            </form>
         
            </div>
            </div>
        </div>
     

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-body">
                        <?php if($_GET['user']=="persona"){ echo "Se ha registrado correctamente"; }else{echo "Se ha enviado la solicitud de registro correctamente";}?>

                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="envio" tabindex="-1" role="dialog" aria-labelledby="envioLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-body text-center">
                        Se ha enviado una contraseña temporal al siguiente correo: <span
                            style="font-weight: bold;"><?php echo $_GET['correo'];?></span style="font-weight: bold;">
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="envio2" tabindex="-1" role="dialog" aria-labelledby="envio2Label"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-body text-center">
                        Se ha enviado el usuario al correo: <span
                            style="font-weight: bold;"><?php echo $_GET['correo'];?></span style="font-weight: bold;">
                    </div>

                </div>
            </div>
        </div>
        <!-- Modal -->


    

    
</div>

<div class="modal fade" id="olvido" tabindex="-1" role="dialog" aria-labelledby="olvidoLabel" aria-hidden="true">
    <form method="post" action="/page/login/olvido" id="form" data-toggle="validator">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="olvidoLabel">Olvido de contraseña</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="usuario">Cédula(usuario)</label>
                        <input type="number" class="form-control" id="usuario" name="usuario"
                            aria-describedby="emailHelp" placeholder="Ingrese su cédula"
                            data-error="El usuario no existe" data-remote="/core/user/validarusuarioexiste" required>
                        <small id="emailHelp" class="form-text text-muted">Ingrese su cedula, enviaremos a su correo una
                            nueva contraseña temporal</small>
                        <div class="help-block with-errors"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" value="enviar" id="enviar" name="enviar"
                        class="btn btn-primary">Enviar</button>


                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="olvidousuario" tabindex="-1" role="dialog" aria-labelledby="olvidousuarioLabel"
    aria-hidden="true">
    <form method="post" action="/page/login/olvidousuario" id="form" data-toggle="validator">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="olvidousuarioLabel">Olvido de usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input type="email" class="form-control" id="correo" name="correo" aria-describedby="emailHelp"
                            placeholder="Ingrese su correo"
                            data-error="El correo no es valido o no se encuentra registrado"
                            data-remote="/core/user/validarcorreoexiste" required>
                        <small id="emailHelp" class="form-text text-muted">Ingrese su correo, le enviaremos el usuario
                            registrado</small>
                        <div class="help-block with-errors"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" value="enviar" id="enviar" name="enviar"
                        class="btn btn-primary">Enviar</button>


                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="recuperar" tabindex="-1" role="dialog" aria-labelledby="recuperarLabel" aria-hidden="true">
    <form method="post" action="/page/login/cambiarpassword" data-toggle="validator">
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="recuperarLabel">Nueva contraseña</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="contrasena">Nueva contraseña</label>
                        <input type="password" class="form-control" name="contrasena" required id="contrasena"
                            placeholder="" data-error="La clave debe ser mayor a 4 caracteres"
                            data-remote="/core/user/validarclavelogin">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="contrasena" class="control-label">Repita la Contraseña</label>
                        <input type="password" value="" max="4" name="contrasenar" id="contrasenar"
                            data-match="#contrasena" min="8" data-match-error="Las dos contrasenas no son iguales"
                            class="form-control" required>
                        </label>
                        <div class="help-block with-errors"></div>
                        <input type="hidden" value="<?php echo $_GET["usuario"] ?>" name="usuario">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" value="enviar" id="enviar" name="enviar"
                        class="btn btn-primary">Enviar</button>


                </div>
            </div>
        </div>
    </form>
</div>
<script>
<?php
if ($_GET['error'] == "false") {
    ?>
    $('#myModal').modal('show'); <?php
} ?>

<?php
if ($_GET['recuperar'] == "1") {
    ?>
    $('#recuperar').modal('show'); <?php
} ?>

<?php
if ($_GET['envio'] == "1" && $_GET['correo'] != "") {
    ?>
    $('#envio').modal('show'); <?php
} ?>
<?php
if ($_GET['envio'] == "2" && $_GET['correo'] != "") {
    ?>
    $('#envio2').modal('show'); <?php
} ?>
<?php
if ($_GET['olvido'] == "1") {
    ?>
    $('#olvido').modal('show'); <?php
} ?>
</script>