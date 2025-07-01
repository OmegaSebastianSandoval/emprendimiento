<div class="py-5">

    <div align="center" class="caja_registro alto-login">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link <?= $_GET["emp"] != '1' ? 'active' : '' ?> " id="nav-home-tab"
                    data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                    aria-selected="true">Asociado</button>
                <button class="nav-link <?= $_GET["emp"] == '1' ? 'active' : '' ?>" id="nav-profile-tab"
                    data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab"
                    aria-controls="nav-profile" aria-selected="false">Emprendedor</button>

            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade <?= $_GET["emp"] != '1' ? 'show active' : '' ?> " id="nav-home" role="tabpanel"
                aria-labelledby="nav-home-tab" tabindex="0">

                <div class="form-group caja-login">

                    <form method="post" action="/page/login/login" class="col-md-12 ">
                        <div class="col-sm-12 col-md-12 margen_icono">
                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <h3 class="titulo-verde1">Documento de identificación</h3>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" name="user" required
                                        class="form-control texto_normal campo_login" placeholder="">
                                </div>

                            </div>
                        </div>


                        <?php if ($this->error && $this->error["error"] == 1) { ?>

                            <div class="alert alert-danger w-100 mt-2" role="alert">
                                <?php echo $this->error["message"]; ?>
                            </div>
                        <?php } ?>
                        <div>
                            <div class="col-sm-12 caja-boton-login my-3 justify-content-center">
                                <div class="ingresar">
                                    <button class="btn enviar" type="submit">Validar</button>
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
                            <a href="/page/registro?negocio=1" class="enlace btn-morado-outline">Registrar emprendimiento</a>
                        </div>

                    </form>
                </div>

            </div>
            <div class="tab-pane fade <?= $_GET["emp"] == '1' ? 'show active' : '' ?>" id="nav-profile" role="tabpanel"
                aria-labelledby="nav-profile-tab" tabindex="0">

                <div class="form-group caja-login">

                    <form method="post" action="/page/login/loginemp" class="col-md-12 ">
                        <div class="col-sm-12 col-md-12 margen_icono">
                            <div class="row">


                                <div class="col-md-12 text-left">
                                    <h3 class="titulo-verde1">Documento de identificación</h3>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" name="user" required
                                        class="form-control texto_normal campo_login" placeholder="">
                                </div>
                                <input type="hidden" name="emp" value="1">

                            </div>
                        </div>



                        <?php if ($this->error_emp && $this->error_emp["error"] == 1) { ?>

                            <div class="alert alert-danger w-auto mt-2" role="alert">
                                <?php echo $this->error_emp["message"]; ?>
                            </div>
                        <?php } ?>
                        <div>
                            <div class="col-sm-12 caja-boton-login my-3 justify-content-center">
                                <div class="ingresar">
                                    <button class="btn btn-primary enviar" type="submit">Validar</button>
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
                            <a href="/page/registro?negocio=1" class="enlace btn-morado-outline">Registrar emprendimiento</a>
                        </div>

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
<script>
    document.querySelectorAll('form').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            var btn = form.querySelector('button[type="submit"]');
            if (btn) {
                btn.disabled = true;
                btn.innerText = 'Validando...'; // Opcional: cambia el texto del botón
            }
        });
    });
</script>