<div class="contenidos-producto">
	<div class="container">
		<section id="interna">
			<div class="row">
				<div class="col-12 text-right text-end migadepan"><a href="/page/?categoria=<?php echo $this->categoria->categorias_id; ?>#a"><?php echo $this->categoria->categorias_nombre; ?></a> > <a href="/page/?categoria=<?php echo $this->categoria->categorias_id; ?>&subcategoria=<?php echo $this->subcategoria->categorias_id; ?>#a"><?php echo $this->subcategoria->categorias_nombre; ?></a></div>
				<div class="col-12">
					<h2 class="contact">Detalle de Producto</h2>
				</div>
				<div class="col-md-1 mt-5 mb-3"></div>
				<div class="col-md-10 mt-3 mb-3">
					<div class="caja-producto">
						<div class="row">
							<div class="col-md-5 mt-3">
								<div class="titulo-procucto2">
									<h3><?php echo $this->producto->productos_nombre; ?></h3>
								</div>
								<div class="caja-descripcion">
									<article class="text-center text-lg-left">
										<?php echo $this->producto->productos_descripcion; ?>
									</article>
									<?php if ($_SESSION['kt_cedula'] != "") { ?>
										<div class="precio">
											<i class="fas fa-tag"></i> <label>Precio</label> $
											<?php
											$iva = $this->informacion->info_pagina_iva;
											$valorivaproducto = ($this->producto->productos_precio * $iva) / 100;
											$precioproductoiva = $this->producto->productos_precio + $valorivaproducto;
											echo number_format($this->producto->productos_precio);
											?>
										</div>
										<div class="div_botones">
											<div class="row">
												<div class="col-lg-6">
													<button class="btn-carrito btn-compra additemsolo btn-block" data-id="<?php echo $this->producto->productos_id; ?>">
														<i class="fas fa-cart-plus"></i> Añadir al Carrito
													</button>
												</div>
												<div class="col-lg-6">
													<button class="btn-carrito btn-compra btn-block" href="/page/index">
														<a href="/page/index" class="enlace_blanco"> <i class="fas fa-retweet"></i> Seguir Comprando</a>
													</button>
												</div>
											</div>
										</div>

									<?php } else { ?>
										<div class="precio">
											<label>Precio $<?php echo number_format($this->producto->productos_precio); ?></label>
										</div>
									<?php }  ?>

								</div>
							</div>
							<div class="col-md-7 mt-3">
								<div class="imagen1 text-center">
									<?php if ($this->producto->productos_imagen != "" and file_exists($_SERVER['DOCUMENT_ROOT'] . "/images/" . $this->producto->productos_imagen) === true) { ?>
										<img src="/images/<?php echo $this->producto->productos_imagen; ?>">
									<?php } else { ?>
										<img src="/corte/product.png">
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<h5 class="titulo_h5">Productos Relacionados</h5>
					<style type="text/css">
						.contenidos-producto .div-imgoculto {
							top: 10px;
							left: 20px;
							height: 50%;
						}
					</style>
					<?php echo $this->productosrelacionados; ?>
				</div>
			</div>
		</section>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("#carousel_container").carousel({
			pause: 5000,
			quantity: 4,
			auto: 'false',
			sizes: {
				'968': 2,
				'500': 1
			}
		});
	});
</script>