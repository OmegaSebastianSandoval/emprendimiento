<style type="text/css">
body {
    max-height: 400px;
    overflow: hidden;
}
</style>


<div class="container">
    <div class="row">
        <div class="col-12 titulo-contact">
            <br>
            <h2 class="contact">Login</h2>
        </div>
    </div>
</div>

<div>
    <form method="post" action="/page/login/login2" class="col-md-12 ">
        <?php if($_GET['registro']==1){ ?>
        <div class="alert alert-warning">Estimado usuario, su registro se realizó de forma exitosa. por favor ingrese su
            información de acceso:</div>
        <?php } ?>
        <div align="center" class="caja_registro alto-login">
            <div class="col-md-12 col-lg-6 form-group">
                <div class="col-sm-12 col-md-12 margen_icono">
                    <div class="row">
                        <div class="col-md-12 text-left">
                            <h3 class="titulo-verde1">Usuario</h3>
                        </div>
                        <div class="col-md-12"><input type="text" name="usuario" required
                                class="form-control texto_normal campo_login" value="<?php echo $_GET['usuario']; ?>"
                                placeholder=""></div>

                    </div>
                </div>
                <div class="col-sm-12 col-md-12">
                    <div class="row">
                        <div class="col-md-12 text-left">
                            <h3 class="titulo-verde1">Contraseña</h3>
                        </div>
                        <div class="col-md-12"><input type="password" name="clave" required
                                class="form-control texto_normal campo_login" value="" placeholder=""></div>
                    </div>
                </div>

                <div class="col-md-12 text-center"><br><a href="#" data-toggle="modal" data-target="#olvido" class="enlace">Olvido de
                        contraseña</a> <span class="azul d-none">|</span> </div>
                <div class="col-md-12 text-center"><br><a href="/page/registro" class="enlace">Crear cuenta</a> <span
                        class="azul d-none">|</span> </div>

                <div class="col-md-12">
                    <br>
                    <button class="btn btn-primary enviar" type="submit">Ingresar</button>
                </div>
            </div>
        </div>


        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-body">
                        <?php if($_GET['usuario']=="persona"){ echo "Se ha registrado correctamente"; }else{echo "Se ha enviado la solicitud de registro correctamente";}?>
                       
                    </div>

                </div>
            </div>
        </div>
        <!-- Modal -->
     

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

    </form>
</div>

<div class="modal fade" id="olvido" tabindex="-1" role="dialog" aria-labelledby="olvidoLabel"
            aria-hidden="true">
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
                                    aria-describedby="emailHelp" placeholder="Ingrese su cédula" data-remote="/core/user/validarusuarioexiste" required>
                                <small id="emailHelp" class="form-text text-muted">Ingrese su cedula, enviaremos a su correo una nueva contraseña temporal</small>
                                <div class="help-block with-errors"></div>
                            </div>
              
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" value="enviar" id="enviar" name="enviar" class="btn btn-primary">Enviar</button>
                        
                        
                    </div>
                </div>
            </div>
            </form>
        </div>

        <div class="modal fade" id="recuperar" tabindex="-1" role="dialog" aria-labelledby="recuperarLabel"
            aria-hidden="true">
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
                    <input type="password"  class="form-control" name="contrasena" required id="contrasena" placeholder=""  data-remote="/core/user/validarclavelogin">
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
                        <button type="submit" value="enviar" id="enviar" name="enviar" class="btn btn-primary">Enviar</button>
                       
                        
                    </div>
                </div>
            </div>
            </form>
        </div>
<script>
<?php
if ($_GET['error'] == "false") {?>
    $('#myModal').modal('show'); <?php } ?>

    <?php
if ($_GET['recuperar'] == "1") {?>
    $('#recuperar').modal('show'); <?php } ?>
</script>
