<div class="header-redes">
	<div class="container">
		<div class="row g-0">
			<div class="col-6 col-lg-4">


				<a href="/" class="mt-1">
					<img src="/skins/page/images/logofendyshop.svg" class="logo">
				</a>
			</div>
			<div class="col-6 col-lg-8  flex-column d-flex gap-3 justify-content-center justify-content-lg-start">

				<div class="d-flex justify-content-end align-items-center gap-3">

					<div class="buscar d-none d-md-flex">
						<form method="post" action="/page/buscar" class="w-100  d-flex gap-2 align-items-center m-0" id="form-buscar">
							<div class=" text-right text-end buscar-ico" onclick="$('#buscar_enviar').click();">
								<i class="fa-solid fa-magnifying-glass fa-flip-horizontal" style="color: #ffffff;"></i>
							</div>
							<div class=" buscar-text">
								<input type="input" class="form-control" name="buscar" id="buscar" required placeholder="Buscar">
							</div>

							<div class="d-none"><button type="submit" id="buscar_enviar"></button></div>
						</form>
					</div>
					<?php if ($this->nombre != "") { ?>
						<div class="text-center text-lg-right d-none d-md-flex">
							<div class="d-flex gap-2 justify-content-end align-items-center">

								<span class="nombre  w-auto ">
									Bienvenido<br> <?php echo $this->nombre; ?>
								</span>
								<?php if ($_SESSION["emprendimiento"] == 1) { ?>
									<div class="vr bg-white"></div>
									<span class="salir  w-auto">
										<a href="/page/listproductos" class="btn btn-sm  margen_salir btn-header">Productos</a>
									</span>
								<?php } ?>
								<div class="vr bg-white"></div>
								<span class="salir  w-auto">
									<a href="/page/login/logout" class="btn btn-sm  margen_salir btn-header">Salir</a>
								</span>
							</div>
						</div>
					<?php } else { ?>
						<div class=" text-center text-lg-right d-none d-md-flex">
							<div class="row justify-content-end align-items-center">
								<span class="nombre  w-auto ">
									<a href="/page/login" class="btn btn-header btn-sm margen_salir">Ingresar</a>
								</span>
							</div>
						</div>
					<?php } ?>
					<span class="btn-menu d-flex d-lg-none p-0">
						<i class="fas fa-bars"></i>
					</span>
				</div>
				<nav>
					<ul id="menu2" class="align-self-center">
						<li class="parent <?= $this->botonpanel == 1 ? 'active' : '' ?>"><a href="/"><span>Inicio</span></a></li>
						<li class="parent"><a href="/page/favoritos"><span>Favoritos</span></a></li>
						<li class="parent"><a href="/"><span>Categorías</span></a>
							<ul>
								<?php foreach ($this->categorias as $key => $categoria) { ?>
									<li><a
											href="/page/categoria?id=<?php echo $categoria->categorias_id; ?>&page=1"><?php echo $categoria->categorias_nombre; ?></a>
										<?php if (is_countable($categoria->hijos) && count($categoria->hijos) > 0) { ?>
											<ul>
												<?php foreach ($categoria->hijos as $key2 => $subcategoria): ?>
													<li><a
															href="?categoria=<?php echo $categoria->categorias_id; ?>&subcategoria=<?php echo $subcategoria->categorias_id; ?>&page=1#a"><?php echo $subcategoria->categorias_nombre; ?></a>
													</li>
												<?php endforeach ?>
											</ul>
										<?php } ?>
									</li>
								<?php } ?>
							</ul>
						</li>
						<li class="parent"><a href="/page/entretenimiento"><span>Entretenimiento</span></a></li>
						<li class="parent"><a href="/page/comprar"><span>¿Cómo comprar?</span></a></li>
						<li class="parent"><a href="/page/formulario"><span>Contacto</span></a></li>
					</ul>
				</nav>
			</div>
		</div>




		<!-- <div class="row align-items-center">
			<div class="col-4 mt-2 ">
				<?php if ($_SESSION["asociado"] || $this->nombre) { ?>
					<a class="btn-menu d-block  d-lg-none">
						<i class="fas fa-bars"></i>
					</a>
				<?php } ?>
			</div>
			<div class="col-4 mt-2 img-responsive"><a href="/"><img class="inline-block"
						src="/skins/page/images/logofendyshop.svg" height="50"></a></div>
		</div> -->
	</div>
</div>



<!--RESPONSIVE-->
<div class="botonera-resposive">
	<div class="row  align-items-center g-0 px-3" style="height: 5rem;">
		<div class="col-8">
			<span class="title-menu-responsive"> Menú</span>
		</div>
		<div class="col-4">
			<a class="btn-menu">

				<i class="fa-solid fa-circle-xmark"></i>
			</a>
		</div>
	</div>
	<table class="table table-striped">
		<tbody>
			<tr>
				<td>
					<li class="item"><a href="/" rel="noopener noreferrer">Inicio</a></li>
				</td>
			</tr>
			<tr>
				<td>
					<li class="item"><a href="/page/favoritos"><span>Favoritos</span></a></li>
				</td>
			</tr>
			<tr>
				<td>
					<li class="item">
						<a href="#" role="button" data-bs-toggle="collapse" data-bs-target="#sub-menu22"><span> Categorías<i
									class="fas fa-angle-down ml-2"></i></span></a>
						<ul class="sub-menu1 collapse" id="sub-menu22">
							<table class="table table-striped">
								<tbody>
									<?php foreach ($this->categorias as $key => $categoria) { ?>
										<tr>
											<td>
												<li><a
														href="/page/categoria?id=<?php echo $categoria->categorias_id; ?>&page=1"><?php echo $categoria->categorias_nombre; ?></a>
												</li>
											</td>
										</tr>
									<?php } ?>

								</tbody>
							</table>
						</ul>
					</li>
				</td>
			</tr>

			<tr>
				<td>
					<li class="item"><a href="/page/entretenimiento" rel="noopener noreferrer">Entretenimiento</a></li>
				</td>
			</tr>

			<tr>
				<td>
					<li class="item"><a href="/page/formulario"><span> Contacto</span></a></li>
					</li>
				</td>
			</tr>

		</tbody>
	</table>
	<?php if ($this->nombre != "") { ?>
		<div class="p-3">
			<div class="text-start text-lg-end">
				<div class="row  text-white cuenta-responsive">
					<div class="col-12 text-start mb-2">
						Bienvenido, <?php echo $this->nombre; ?>
					</div>

					<div class="col-12  text-start">
						<a href="/page/login/logout" class="btn btn-header btn-sm  text-start">Salir</a>
					</div>
				</div>
			</div>
		</div>
	<?php } else { ?>
		<div class="p-3">
			<a href="/page/login" class="btn btn-header btn-sm  text-center w-100">Ingresar</a>
		</div>

<?php } ?>


<div class="redes2-responsive p-3">
	<div class=" align-self-center ">
		<?php if ($this->infopage->info_pagina_whatsapp) { ?>
			<?php $whatsapp = intval(preg_replace('/[^0-9]+/', '', $this->infopage->info_pagina_whatsapp), 10); ?>
			<a href="https://api.whatsapp.com/send?phone=<?php echo $whatsapp; ?>" target="_blank" class="red mr-4">
				<i class="fab fa-whatsapp mr-2"></i>
				<span><?php echo $this->infopage->info_pagina_whatsapp ?></span>
			</a>
		</div>
		<div class=" align-self-center">
		<?php } ?>
		<?php if ($this->infopage->info_pagina_correos_contacto) { ?>
			<a href="mailto:<?php echo $this->infopage->info_pagina_correos_contacto; ?>" target="_blank"
				class="text-white text-decoration-none d-flex gap-2 align-items-center"> <i
					class="fas fa-envelope mr-2"></i><span><?php echo $this->infopage->info_pagina_correos_contacto; ?></span></a>
		<?php } ?>
	</div>
</div>
</div>