<ul>

<?php if($_SESSION['kt_login_level']=="1" or $_SESSION['kt_login_level']=="2"){ ?>
	<li <?php if($this->botonpanel == 1){ ?>class="activo"<?php } ?>><a href="/administracion/panel"><i class="fas fa-info-circle"></i> Información Página</a></li>
	<li <?php if($this->botonpanel == 2){ ?>class="activo"<?php } ?>><a href="/administracion/publicidad"><i class="far fa-images"></i> Administrar Banner</a></li>
	<li <?php if($this->botonpanel == 3){ ?>class="activo"<?php } ?>><a href="/administracion/contenido"><i class="fas fa-file-invoice"></i> Administrar Contenidos</a></li>
<?php } ?>

<?php if($_SESSION['kt_login_level']=="1" or $_SESSION['kt_login_level']=="3" or $_SESSION['kt_login_level']=="4"){ ?>
	<li <?php if($this->botonpanel == 5){ ?>class="activo"<?php } ?>><a href="/administracion/categorias"><i class="fas fa-file-invoice"></i> Administrar Categorías</a></li>

<?php } ?>

<?php if($_SESSION['kt_login_level']=="1"){ ?>
	<li <?php if($this->botonpanel == 4){ ?>class="activo"<?php } ?>><a href="/administracion/usuario"><i class="fas fa-users"></i> Administrar Usuarios</a></li>
	<li <?php if($this->botonpanel == 16){ ?>class="activo"<?php } ?>><a href="/administracion/tiendaclicks"><i class="fas fa-users"></i> Reporte tienda</a></li>
	<!-- <li <?php if($this->botonpanel == 16){ ?>class="activo"<?php } ?>><a href="/administracion/galeria"><i class="far fa-image"></i> Arte</a></li> -->
	<!-- <li <?php if($this->botonpanel == 17){ ?>class="activo"<?php } ?>><a href="/administracion/listadoimagen"><i class="far fa-image"></i> Imagenes de tiendas mayor a 2MB</a></li>
	<li <?php if($this->botonpanel == 18){ ?>class="activo"<?php } ?>><a href="/administracion/listadoimagenproductos"><i class="far fa-image"></i> Imagenes de productos mayor a 2MB</a></li> -->
<?php } ?>
</ul>