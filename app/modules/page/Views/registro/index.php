<div class="container py-5">
    <div class="registro">
        <h1>Registro de emprendimiento</h1>
        <form class="formulario-registro" action="/page/registro/insertar" enctype="multipart/form-data"
            data-toggle="validator" autocomplete="nope" method="post" id="formulario-registro">
            <div class="row">

                <div class="form-group mb-4 col-md-4">
                    <label for="usuario">Escoja el tipo de usuario</label>
                    <select class="form-control" name="usuario" id="usuario" required onchange='cambiar_formulario();'>
                        <option value="" disabled selected>Seleccione...</option>

                        <?php if ($_GET['negocio'] == "1") { ?>
                            <option value="4" <?php if ($_GET['negocio'] == "1") {
                                echo "selected";
                            } ?>>Expositor asociado
                            </option>
                        <?php } ?>
                        <?php if ($_GET['invitado'] == "1") { ?>
                            <option value="5" <?php if ($_GET['invitado'] == "1") {
                                echo "selected";
                            } ?>>Expositor invitado
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