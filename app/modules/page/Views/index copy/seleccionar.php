<?php
$hora = date("H:i:s");
?>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h2 class="titulo-principal contact text-center titulo-seleccione">Selecciona una opción</h2>
		</div>
		<div class="col-lg-10 offset-lg-1">
			<div class="row">
				<div class="col-lg-6 ancho45 margen_caja1">
					<div class="fondo_seleccion text-center">
						<?php if($hora<"15:00:00" and $hora>="10:00:00" and $_GET['cerrado']=="" or $_GET['abierto']=="1"){ ?>
							<div class="margen_express"><img src="/corte/nogal_express.png"></div>
						<?php }else{ ?>
							<div class="margen_express"><img src="/corte/nogal_express.png" style="filter: grayscale(100%);"></div>
						<?php } ?>
						<div class="texto_seleccion"><br>Menú para recoger en el Club<br>
						o recibir a domicilio en dos horas</div><br>
						<div class="pedidos_unicamente">Pedidos únicamente entre 10 a.m. a 3 p.m.</div>

						<?php if($hora<"15:00:00" and $hora>="10:00:00" and $_GET['cerrado']=="" or $_GET['abierto']=="1"){ ?>
							<div class="margen_boton1"><a href="https://express.clubelnogal.com/page/index"><button class="btn btn-verde">Ingresar</button></a></div>
						<?php }else{ ?>
							<?php echo $this->carta[0]->contenido_descripcion; ?>
							<div class="margen_boton1"><a onclick="$('#boton_modal').click();"><button class="btn btn-deshabilitado">Ingresar</button></a></div>
						<?php } ?>
					</div>
				</div>
				<div class="col-lg-1 text-center padding0">
					<div class="separador_vertical"></div>
				</div>
				<div class="col-lg-6 ancho45">
					<div class="fondo_seleccion text-center">
						<div><img src="/corte/logo_delivery.png"></div>
						<div class="texto_seleccion"><br>Recibe en tu casa o recoge<br>en el Club al día siguiente</div><br>
						<div class="texto_seleccion2">Los pedidos realizados antes de la 3 p.m. podrán ser enviados o
recogidos al día siguiente entre 9 a.m. y 1 p.m. Si el pedido se hace
después de la 3 p.m. podrá ser enviado o recogido dos días después.</div>
						<div class="margen_boton2"><a href="https://delivery.clubelnogal.com/page/index"><button class="btn btn-cafe2">Ingresar</button></a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" id="boton_modal" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Restaurante Express Cocina Nogal</h5>
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


<div class="d-none">
	<iframe src="https://express.clubelnogal.com/page/login/loginauto/?cedula=<?php echo $_SESSION['kt_cedula']; ?>"></iframe>
</div>