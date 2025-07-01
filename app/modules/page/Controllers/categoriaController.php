<?php

/**
 *
 */

class Page_categoriaController extends Page_mainController
{

	/**
	 * $pages cantidad de registros a mostrar por pagina para tiendas en categoria
	 * @var integer
	 */
	protected $pages;

	/**
	 * $namepages nombre de la variable en la cual se va a guardar el numero de seccion en la paginacion de tiendas categoria
	 * @var string
	 */
	protected $namepages;

	/**
	 * $namepageactual nombre de la variable en la cual se va a guardar la pagina actual de tiendas categoria
	 * @var string
	 */
	protected $namepageactual;

	/**
	 * Inicializa las variables principales del controlador categoria para paginacion de tiendas.
	 *
	 * @return void.
	 */
	public function init()
	{
		$this->namepages = "pages_tiendas_categoria";
		$this->namepageactual = "page_actual_tiendas_categoria";

		if (Session::getInstance()->get($this->namepages)) {
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 9; // 12 tiendas por pagina en categoria
		}
		parent::init();
	}

	public function indexAction()
	{

		$this->_view->bannerprincipal = $this->template->bannerprincipal(5);

		// $catgoria = $this->_getSanitizedParam('categoria');
		$id = $this->_getSanitizedParam('id');
		// $subcategoria = $this->_getSanitizedParam('subcategoria');
		// $buscar = $this->_getSanitizedParam('buscar');
		// if ($catgoria != "") {
		// 	$this->_view->productos = $this->template->getProductosf($catgoria,$subcategoria);
		// }elseif ($catgoria == "") {
		// 	$this->_view->productos = $this->template->getProductos($buscar);
		// }

		$categoriasModel = new Administracion_Model_DbTable_Categorias();
		$productosModel = new Administracion_Model_DbTable_Productos();
		$cuadrosModel = new Administracion_Model_DbTable_Cuadros();
		$tiendasModel = new Administracion_Model_DbTable_Tiendas();
		$tiendasClicksModel = new Administracion_Model_DbTable_Tiendaclicks();
		// $this->_view->categorias = $categorias = $categoriasModel->getList(" categorias_padre='0' "," orden ASC ");
		// foreach ($categorias as $key => $value) {
		// 	$padre = $value->categorias_id;
		// 	$hijos = $categoriasModel->getList(" categorias_padre='$padre' "," orden ASC ");
		// 	$value->hijos = $hijos;
		// }
		// $this->_view->categorias = $categorias;
		$orden = "RAND()";

		if ($this->_getSanitizedParam('ordenar') == "recientes") {
			$orden = "tiendas_id DESC";
			$this->_view->orden = "recientes";
		}
		if ($this->_getSanitizedParam('ordenar') == "ascendente") {
			$orden = "tiendas_nombre ASC";
			$this->_view->orden = "ascendente";
		}
		if ($this->_getSanitizedParam('ordenar') == "descendente") {
			$orden = "tiendas_nombre DESC";
			$this->_view->orden = "descendente";
		}

		// Implementacion de paginacion para tiendas en categoria
		$filters = "tiendas_categoria='$id' AND tiendas_estado=1";
		$page = $this->_getSanitizedParam("page");
		$amount = $this->pages;
		$orden = "tiendas_nombre ASC"; // Orden por defecto

		if (!$page && Session::getInstance()->get($this->namepageactual)) {
			$page = Session::getInstance()->get($this->namepageactual);
			$start = ($page - 1) * $amount;
		} else if (!$page) {
			$start = 0;
			$page = 1;
			Session::getInstance()->set($this->namepageactual, $page);
		} else {
			Session::getInstance()->set($this->namepageactual, $page);
			$start = ($page - 1) * $amount;
		}

		if ($this->_getSanitizedParam('ordenar') == "visitados") {
		
			$orden = "clics DESC";
			$this->_view->orden = "visitados";
			$group = "id_tienda";
			// Para visitados necesitamos obtener el total primero
			$totalList = $tiendasClicksModel->getListClicks2($filters, $orden, $group);
			$this->_view->register_number = count($totalList);
			$this->_view->totalpages = ceil(count($totalList) / $amount);
			// Obtener tiendas paginadas para visitados (si el modelo lo soporta)
			$this->_view->tiendas = $tiendasClicksModel->getListClicks2($filters, $orden . " LIMIT $start, $amount", $group);
		} else {
			

			// Para otros ordenamientos
			$list = $tiendasModel->getList($filters, $orden);
			$this->_view->register_number = count($list);
			$this->_view->totalpages = ceil(count($list) / $amount);
			$this->_view->tiendas = $tiendasModel->getList($filters, $orden . " LIMIT $start, $amount");
		}

		// Variables para la vista de paginacion
		$this->_view->pages = $this->pages;
		$this->_view->page = $page;
		$this->_view->id = $id;
		$this->_view->categoria = $categoriasModel->getById($id);

		// Cargar todas las categorias para el sidebar
		$this->_view->categorias = $categoriasModel->getList(" categorias_padre='0' AND categorias_estado='1' AND categorias_estado_imagen='1'", " orden_categorias ASC ");

		$this->_view->productos = $productosModel->getList("", "");
		$this->_view->cuadros = $cuadrosModel->getList("", "");

	}


	public function seleccionarAction()
	{
		$contenidoModel = new Page_Model_DbTable_Contenido();
		$this->_view->carta = $contenidoModel->getList("contenido_seccion = '13' AND contenido_estado='1' ", "orden ASC");
	}

}