<?php if ($_SESSION["asociado"]) { ?>
	<span class="ir-arriba icon-arrow-up2">Volver Arriba</span>
<?php } ?>

<div class="footer-redes">
	<div class="container">
		<div class="row g-3">
			<div class="col-lg-4 text-center d-flex align-items-center justify-content-center justify-content-lg-start">

				<img src="/skins/page/images/logofendyshop.svg" style="height: 3.5rem;">

			</div>
			<div class="col-lg-4 text-left">
				<div class="d-block d-lg-flex align-items-center gap-3 text-center text-lg-start">
					<div class="icon">
						<i class="fa-solid fa-circle-info"></i>
					</div>
					<div>
						<h2 class="red1 titulosfooter text-center text-lg-start">
							Información de contacto
						</h2>
						<div class="text-footer">
							<?php echo $this->infopage->info_pagina_informacion_contacto; ?>
						</div>
					</div>
				</div>

			</div>
			<div class="col-lg-4 text-left">
				<div class="d-block d-lg-flex  align-items-center gap-3 text-center text-lg-start">
					<div class="icon">
						<i class="fa-regular fa-circle-question"></i>
					</div>
					<div>
						<h2 class="red1 titulosfooter text-center text-lg-start">
							¿Necesitas ayuda?
						</h2>
						<div class="text-footer">
							<?php echo $this->infopage->info_pagina_informacion_contacto_footer; ?>
						</div>
					</div>
				</div>
			</div>

			<div class="col-12 text-center text-white">
				<hr class="text-white">
				<p class="">
					<span class="text-center text-white">© <?= date("Y") ?></span> Todos los Derechos Reservados Fendesa |
					Desarrollado por <a href="http://www.omegasolucionesweb.com" target="_blank" class="enlacered1">Omega
						Soluciones Web</a>
				</p>

			</div>
		</div>
	</div>