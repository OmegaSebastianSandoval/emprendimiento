<?php

/**
 *
 */

class Page_tiendaController extends Page_mainController
{

	public function testAction()
	{
		$productosModel = new Administracion_Model_DbTable_Productos();
		$productos = $productosModel->getList();
		//borrar caracteres extraños, dejar solo numeros, sin puntos ni letras ni nada!
		foreach ($productos as $producto) {
			$precio = $producto->productos_precio;
			$precio = str_replace(" ", "", $precio);
			$precio = str_replace("$", "", $precio);
			$precio = str_replace(".", "", $precio);
			$precio = str_replace(",", "", $precio);


			$productosModel->editField($producto->productos_id, 'productos_precio', $precio);
		}
	}

	public function indexAction()
	{

		$this->_view->bannerprincipal = $this->template->bannerprincipal(5);

		$categoria = $this->_getSanitizedParam('categoria');
		$id = $this->_getSanitizedParam('id');
		$this->_view->ordenar = $this->_getSanitizedParam('ordenar');
		$this->_view->page = $this->_getSanitizedParam('page');

		$usuario = $_SESSION["kt_login_id"];
		$this->_view->tienda_id = $id;
		$favoritosModel = new Administracion_Model_DbTable_Favoritos();
		$this->_view->favoritos = $favoritosModel->getList("favoritos_tienda='$id' AND favoritos_usuario='$usuario'", "");

		$categoriasModel = new Administracion_Model_DbTable_Categorias();
		$productosModel = new Administracion_Model_DbTable_Productos();
		$tiendasModel = new Administracion_Model_DbTable_Tiendas();

		$this->_view->categoria = $categoriasModel->getById($categoria);
		$this->_view->tienda = $tiendasModel->getById($id);

		// Obtener subcategoría si existe
		$subcategoria = $this->_getSanitizedParam('subcategoria');
		$this->_view->subcategoria_seleccionada = $subcategoria;

		// Obtener información de la categoría padre
		$this->_view->categoria_padre = null;
		if ($categoria && $categoria != '') {
			$this->_view->categoria_padre = $categoriasModel->getById($categoria);
		}

		// Filtrar productos según si hay subcategoría seleccionada o no
		if ($subcategoria && $subcategoria != '') {
	
			// Si hay subcategoría, mostrar solo productos de esa subcategoría
			$this->_view->productos = $productosModel->getList("productos_tienda='$id' AND productos_categorias='$categoria' AND productos_subcategoria='$subcategoria'", "orden ASC");
			// Obtener la subcategoría actual
			$subcategoriaObj = $categoriasModel->getById($subcategoria);
			if ($subcategoriaObj) {
			
				$this->_view->subcategoria_actual = $subcategoriaObj;
				
				// Si no tenemos categoría padre, la obtenemos de la subcategoría
				if (!$this->_view->categoria_padre && $subcategoriaObj->categorias_padre) {
					$this->_view->categoria_padre = $categoriasModel->getById($subcategoriaObj->categorias_padre);
				}
			}
		} else {
			// Si no hay subcategoría, mostrar productos de la categoría padre
			if ($categoria && $categoria != '') {
				$this->_view->productos = $productosModel->getList("productos_tienda='$id' AND productos_categorias='$categoria'", "orden ASC");
			} else {
				// Si no hay categoría específica, mostrar todos los productos de la tienda
				$this->_view->productos = $productosModel->getList("productos_tienda='$id'", "orden ASC");
			}
		}


		$tiendaclicksModel = new Administracion_Model_DbTable_Tiendaclicks();
		$data = array();
		$data['id_tienda'] = $id;
		$data['usuario'] = $_SESSION["kt_login_user"] ?? $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
		$data['fecha'] = date("Y-m-d");
		$data['hora'] = date("h:i:s");
		$tiendaclicksModel->insert($data);

		// Obtener las subcategorías (categorías hijas) de la categoría padre
		$subcategoria = $this->_getSanitizedParam('subcategoria');

		// Obtener todas las subcategorías de esta tienda para la categoría padre
		if ($categoria && $categoria != '') {
			$this->_view->categorias = $categoriasModel->getList("categorias_padre='$categoria' AND categoria_subcategoriatienda='$id' AND categorias_estado='1'", "categorias_nombre ASC");
		} else {
			// Si no hay categoría padre, obtener las categorías principales de la tienda
			$this->_view->categorias = $categoriasModel->getList("categoria_subcategoriatienda='$id' AND categorias_estado='1' AND (categorias_padre='' OR categorias_padre IS NULL)", "categorias_nombre ASC");
		}

		// Pasar la subcategoría seleccionada a la vista
		$this->_view->subcategoria_seleccionada = $subcategoria;
	}

	public function seleccionarAction()
	{
		$contenidoModel = new Page_Model_DbTable_Contenido();
		$this->_view->carta = $contenidoModel->getList("contenido_seccion = '13' AND contenido_estado='1' ", "orden ASC");
	}
	public function cambiarestadoAction()
	{
		$estado = $this->_getSanitizedParam('estado');
		$tienda = $this->_getSanitizedParam('tienda');
		$usuario = $this->_getSanitizedParam('usuario');
		$favoritosModel = new Administracion_Model_DbTable_Favoritos();

		if ($estado == 0) {
			$data['favoritos_usuario'] = $usuario;
			$data['favoritos_tienda'] = $tienda;
			$favoritosModel->insert($data);
		} else {
			$favoritosModel->borrar($usuario, $tienda);
		}
	}
	public function enlaceredes($x)
	{
		$x = str_replace("@", "", $x);
		$x = str_replace("https://www.instagram.com", "", $x);
		$x = str_replace("https://es-la.facebook.com", "", $x);
		$x = str_replace("/", "", $x);
		$x = str_replace("https:m.", "", $x);
		$x = str_replace("https:www.", "", $x);
		return $x;
	}
	public function enlacepagina($x)
	{
		$x = str_replace("https://", "", $x);
		$x = str_replace("http://", "", $x);
		return $x;
	}
}
