
<span class="ir-arriba icon-arrow-up2">Volver Arriba</span>
<div class="footer-redes">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 text-left">
				<div class="red1 titulosfooter">
					¿Necesitas ayuda?
				</div>
				<div class="text-footer">
					<p><a href="/page/formulario">Contacto</a></p>
					<p><a href="/page/comprar">¿Cómo comprar?</a></p>
					<p class="d-none"><a href="/page/preguntas">Preguntas frecuentes</a></p>
				</div>
			</div>
			<div class="col-lg-5 text-left">
			<div class="red1 titulosfooter">
					Información de contacto
				</div>
				<div class="text-footer">
					<span class="red"> <?php echo $this->infopage->info_pagina_informacion_contacto_footer; ?></span>
				</div>
			</div>
			<div class="col-lg-2 text-center puntos">
				<div class="row text-center">
					<div align="center" class="col-12">
						<img src="/corte/logo.jpg" style="height: 3.5rem;">
					</div>
			</div>
		</div>
	</div>
</div>
<div class="derechos">
	<span>© 2020</span> Todos los Derechos Reservados Corporación Club El Nogal | Desarrollado por <a href="http://www.omegasolucionesweb.com" target="_blank" class="enlacered1">Omega Soluciones Web</a>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
      	<iframe id="iframe_login" src="/page/login/" width="100%" scrolling="auto" frameborder="0" height="500"></iframe>
      </div>
    </div>
  </div>
</div>


</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" id="boton_modal2" data-toggle="modal" data-target="#exampleModal_express">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal_express" tabindex="-1" role="dialog" aria-labelledby="exampleModal_expressLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModal_expressLabel">Restaurante Express Cocina Nogal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<?php if($hora>="15:00:00"){ ?>
        	Apreciado socio, lo invitamos a realizar su pedido el día de mañana en el horario de 10 a.m. a 3 p.m. y disfrutar de nuestra carta.
    	<?php }else{ ?>
    		Apreciado socio, lo invitamos a realizar su pedido en el horario de 10 a.m. a 3 p.m. y disfrutar de nuestra carta.
    	<?php } ?>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>



