<div class="header-redes">
	<div class="container-fluid pestanas-cont">
		<div class="container">
			<div class="row pestanas">
				<div class="col-lg-2 align-self-center">
					<a href="/page/index"><img src="/corte/logo.jpg" class="logo"></a>
				</div>

				<div class="col-lg-3 col-sm-12 buscar">
					<form method="post" action="/page/index/#a" class="row">
						<div class="col-lg-9 col-md-8 buscar-text">
							<input type="input" class="form-control" name="buscar" id="buscar" value="<?php echo $_POST['buscar']; ?>" placeholder="Buscar">
						</div>
						<div class="col-lg-2 col-md-4 text-right text-end buscar-ico" onclick="$('#buscar_enviar').click();">
							<i class="fas fa-search" align="right"></i>
						</div>
						<div class="d-none"><button type="submit" id="buscar_enviar"></button></div>
					</form>
				</div>
				<?php if ($this->nombre != "") { ?>
					<div class="col-lg-7 text-center text-lg-right">
						<div class="row justify-content-end align-items-center">
							<div class="nombre">
								Bienvenido<br> <?php echo $this->nombre; ?>
							</div>
							<div class="cuenta">
								<a href="#" class="btn btn-sm text-white margen_salir">Cuenta</a>
							</div>
							<div class="salir">
								<a href="/page/login/logout" class="btn btn-sm text-white margen_salir">Salir</a>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
			<div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<!--<?php if ($this->infopage->info_pagina_telefono) { ?>
			<?php $telefono = intval(preg_replace('/[^0-9]+/', '', $this->infopage->info_pagina_telefono), 10);  ?>
			<a href="tel:<?php echo $telefono; ?>" target="_blank" class="red">
				<i class="fas fa-phone"></i>
				<span><?php echo $this->infopage->info_pagina_telefono ?></span>
			</a>
		<?php } ?>
		<?php if ($this->infopage->info_pagina_whatsapp) { ?>
			<?php $whatsapp = intval(preg_replace('/[^0-9]+/', '', $this->infopage->info_pagina_whatsapp), 10);  ?>
			<a href="https://api.whatsapp.com/send?phone=<?php echo $whatsapp; ?>" target="_blank" class="red" >
				<i class="fab fa-whatsapp"></i>
				<span><?php echo $this->infopage->info_pagina_whatsapp ?></span>
			</a>
		<?php } ?>
		<?php if ($this->infopage->info_pagina_facebook) { ?>
			<a href="<?php echo $this->infopage->info_pagina_facebook ?>" target="_blank" class="red">
				<i class="fab fa-facebook-f"></i>
			</a>
		<?php } ?>
		<?php if ($this->infopage->info_pagina_twitter) { ?>
			<a href="<?php echo $this->infopage->info_pagina_twitter ?>" target="_blank" class="red">
				<i class="fab fa-twitter"></i>
			</a>
		<?php } ?>
		<?php if ($this->infopage->info_pagina_instagram) { ?>
			<a href="<?php echo $this->infopage->info_pagina_instagram ?>" target="_blank" class="red">
				<i class="fab fa-instagram"></i>
			</a>
		<?php } ?>
		<?php if ($this->infopage->info_pagina_pinterest) { ?>
			<a href="<?php echo $this->infopage->info_pagina_pinterest ?>" target="_blank" class="red">
				<i class="fab fa-pinterest-p"></i>
			</a>
		<?php } ?>
		<?php if ($this->infopage->info_pagina_youtube) { ?>
			<a href="<?php echo $this->infopage->info_pagina_youtube ?>" target="_blank" class="red">
				<i class="fab fa-youtube"></i>
			</a>
		<?php } ?>
		<?php if ($this->infopage->info_pagina_linkdn) { ?>
			<a href="<?php echo $this->infopage->info_pagina_linkdn ?>" target="_blank" class="red">
				<i class="fab fa-linkedin-in"></i>
			</a>
		<?php } ?>
		<?php if ($this->infopage->info_pagina_google) { ?>
			<a href="<?php echo $this->infopage->info_pagina_google ?>" target="_blank" class="red">
				<i class="fab fa-google-plus-g"></i>
			</a>
		<?php } ?>
		<?php if ($this->infopage->info_pagina_flickr) { ?>
			<a href="<?php echo $this->infopage->info_pagina_flickr ?>" target="_blank" class="red">
				<i class="fab fa-flickr"></i>
			</a>
		<?php } ?>-->

</div>
</div>
<?php $hora = date("H:i:s"); ?>
<div class="header-content">
	<div class="container">
		<div class="row">

			<div class="col-sm-12 caja-items align-items-center">
				<nav>
					<ul id="menu2" class="align-self-center">
						<li><a href="/"><span>Inicio</span></a></li>
						<li><a href="/page/favoritos"><span>Favoritos</span></a></li>
						<li><a href="/"><span>Categorias</span></a>
							<ul>
								<?php foreach ($this->categorias as $key => $categoria) { ?>
									<li><a href="/page/categoria?id=<?php echo $categoria->categorias_id; ?>&page=1"><?php echo $categoria->categorias_nombre; ?></a>
										<?php if (count($categoria->hijos) > 0) { ?>
											<ul>
												<?php foreach ($categoria->hijos as $key2 => $subcategoria): ?>
													<li><a href="?categoria=<?php echo $categoria->categorias_id; ?>&subcategoria=<?php echo $subcategoria->categorias_id; ?>&page=1#a"><?php echo $subcategoria->categorias_nombre; ?></a></li>
												<?php endforeach ?>
											</ul>
										<?php } ?>
									</li>
								<?php } ?>
							</ul>
						</li>
						<li><a href="/page/entretenimiento"><span>Entretenimiento</span></a></li>
						<li><a href="/page/comprar"><span>¿Cómo comprar?</span></a></li>
						<li><a href="/page/formulario"><span>Contacto</span></a></li>

					</ul>
				</nav>
				<div class="row">
					<div class="col-4 mt-3"><a class="btn-menu text-left text-startd-block d-sm-block d-md-none navbar-toggle collapsed" data-toggle="collapse" data-target="#menu" aria-expanded="false"><i class="fas fa-bars fa-2x"></i></a></div>
					<div class="col-4 mt-3 img-responsive"><a href="/page/index"><img class="inline-block" src="/corte/logo.jpg" height="50"></a></div>
				</div>
			</div>
		</div>
	</div>

	<!-- <div class="carrito">
		<div class="ver-carrito lateral absolute"></div>
		<div class="carrito-cantidad absolute text-bold circle f-13 text-center cantidad" id="cantidad-total-items"></div>
	</div> -->
</div>

<!--RESPONSIVE-->
<div class="botonera-resposive navbar-collapse col-md-8 col-xs-12 collapse in" id="menu" aria-expanded="true">
	<div class=" col-12 col-md-8">
		<div class="col-md-4">
			<a class="btn-menu"><i class="fas fa-times-circle"></i></a>
		</div>
	</div>
	<table class="table table-striped">
		<tbody>
			<tr>
				<td>
					<li class="item"><a href="/" rel="noopener noreferrer"><i class="fas fa-home"></i> Inicio</a></li>
				</td>
			</tr>
			<tr>
				<td>
					<li class="item"><a href="/page/comprar" rel="noopener noreferrer"><i class="fas fa-shopping-bag"></i> ¿Cómo comprar?</a></li>
				</td>
			</tr>

			<tr>
				<td>
					<li class="item"><a href="/page/seguridadsanitaria" rel="noopener noreferrer"><i class="fas fa-lock"></i> Seguridad sanitaria</a></li>
				</td>
			</tr>

			<?php if ($hora < "15:00:00" and $hora >= "10:00:00" and $_GET['cerrado'] == "" or $_GET['abierto'] == "1") { ?>
				<tr>
					<td>
						<li class="item"><a href="https://express.clubelnogal.com/page/index/" rel="noopener noreferrer" style="color:#CDC82E"><i class="fas fa-door-open"></i> Ir a Restaurante Express</a></li>
					</td>
				</tr>
			<?php } else { ?>
				<tr>
					<td>
						<li class="item"><a href="https://express.clubelnogal.com/page/index/" rel="noopener noreferrer" style="color:#CDC82E"><i class="fas fa-door-open"></i> Ir a Restaurante Express</a></li>
					</td>
				</tr>
			<?php } ?>

			<tr>
				<td>
					<li class="item"><a href="/page/formulario" rel="noopener noreferrer"><i class="fas fa-headset"></i> Contacto</a></li>
				</td>
			</tr>
		</tbody>
	</table>
</div>