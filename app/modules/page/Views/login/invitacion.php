<style type="text/css">

body{
    max-height: 400px;
    overflow: hidden;
}

.titulo-verde1, .contact{
	color: #123C5B;
}
.enviar {
    background-color: #123C5B;
    border: 1px solid #123C5B;
}
</style>


<div class="container">
    <div class="row">
        <div class="col-12 titulo-contact">
            <br><h2 class="contact">Enviar invitación</h2>
        </div>
    </div>
</div>


<?php if($_SESSION['kt_login_level']!=5 and $_SESSION['kt_login_level']!=3 and $_SESSION['kt_accion']!="" and count($this->invitados)<5){ ?>
<div>
	<form method="post" action="/page/login/enviarinvitacion" class="col-md-12 ">
		<?php if($_GET['registro']==1 or $_GET['error']=="false"){ ?>
			<div class="alert alert-warning text-center">Apreciado usuario, su registro se realizó de forma exitosa. por favor ingrese su información de acceso:</div>
		<?php } ?>
		<div align="center" class="caja_registro alto-login container">
			<div class="row">
				<div class="col-md-12 col-lg-5 form-group">
					<div class="col-sm-12 col-md-12 margen_icono d-none">
						<div class="row">
							<div class="col-md-12 text-left"><h3 class="titulo-verde1">Documento de identificación del invitado</h3></div>
							<div class="col-md-12"><input type="text" name="cedula" class="form-control texto_normal campo_login" value="<?php echo $_GET['cedula']; ?>" placeholder=""></div>

						</div>
					</div>
					<div class="col-sm-12 col-md-12 d-none">
						<div class="row">
							<div class="col-md-12 text-left"><h3 class="titulo-verde1">Nombre del invitado</h3></div>
							<div class="col-md-12"><input type="text" name="nombre" class="form-control texto_normal campo_login" value="" placeholder=""></div>
						</div>
					</div>

					<div class="col-sm-12 col-md-12">
						<div class="row">
							<div class="col-md-12 text-left"><h3 class="titulo-verde1">Correo del invitado</h3></div>
							<div class="col-md-12"><input type="email" name="correo" required class="form-control texto_normal campo_login" value="" placeholder=""></div>
						</div>
					</div>

				</div>

				<div class="col-lg-7 text-left">
					<b style="font-weight: bold;">Proceso para registrar un invitado a Nogal Delivery o La Taberna Express</b>
				    <ul>
				    	<li>Diligenciar en el presente formulario el E-mail de su invitado. </li>
				    	<li>Luego usted y su invitado recibirán un correo de notificación indicando el E-mail del invitado. Allí podrán encontrar un link de registro.</li>
				    	<li>El invitado debe diligenciar el formulario de registro con los siguientes campos: número de documento, nombre, teléfono y correo electrónico.</li>
				    	<li>Una vez creada la cuenta el invitado podrá ingresar a:<br>
				    		- Nux Feria Virtual: https://nux.clubelnogal.com<br>
				    		- Nogal Delivery y La Taberna Express: https://delivery.clubelnogal.com/
				    	</li>
				    </ul>
					<b style="font-weight: bold;">Para tener en cuenta:</b>
					<ul>
						<li>Podrá invitar hasta cinco personas por mes.</li>
						<li>Los pagos de los invitados se realizarán únicamente por pasarela de pagos (tarjeta débito o crédito)</li>
					</ul>
				</div>
			</div>
			<div class="col-md-12">
				<br>
				<button class="btn btn-primary enviar" type="submit">Enviar invitación</button>
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


	</form>
</div>
<?php } ?>

<?php if(count($this->invitados)>=5){ ?>
<div class="container">
	<div class="row">
		<div class="col-12 text-center">Estimado Socio, puede invitar hasta 5 personas por mes</div>
	</div>
</div>
<?php } ?>


<?php if($_GET['enviado']=="1"){ ?>
<script type="text/javascript">
	alert("Su invitación fue enviada.");
</script>
<?php } ?>