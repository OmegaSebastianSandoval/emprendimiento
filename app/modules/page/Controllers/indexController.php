<?php

/**
 *
 */

class Page_indexController extends Page_mainController
{

	public $botonpanel = 1;

	/**
	 * $pages cantidad de registros a mostrar por pagina para tiendas
	 * @var integer
	 */
	protected $pages;

	/**
	 * $namepages nombre de la variable en la cual se va a guardar el numero de seccion en la paginacion de tiendas
	 * @var string
	 */
	protected $namepages;

	/**
	 * $namepageactual nombre de la variable en la cual se va a guardar la pagina actual de tiendas
	 * @var string
	 */
	protected $namepageactual;

	/**
	 * Inicializa las variables principales del controlador index para paginacion de tiendas.
	 *
	 * @return void.
	 */
	public function init()
	{
		$this->namepages = "pages_tiendas_index";
		$this->namepageactual = "page_actual_tiendas_index";

		if (Session::getInstance()->get($this->namepages)) {
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 9; // Mantengo 9 como en el codigo original
		}
		parent::init();
	}

	public function indexAction()
	{

		$this->_view->bannerprincipal = $this->template->bannerprincipal(1);
		$publicidadModel = new Administracion_Model_DbTable_Publicidad();
		$popup = $publicidadModel->getList("publicidad_seccion=6  AND publicidad_estado ='1'", "")[0];

		/* $catgoria = $this->_getSanitizedParam('categoria');
			$subcategoria = $this->_getSanitizedParam('subcategoria');
			$buscar = $this->_getSanitizedParam('buscar'); */
		/* if ($catgoria != "") {
				$this->_view->productos = $this->template->getProductosf($catgoria,$subcategoria);
			}elseif ($catgoria == "") {
				$this->_view->productos = $this->template->getProductos($buscar);
			}
	 */
		$categoriasModel = new Administracion_Model_DbTable_Categorias();
		$this->_view->categorias = $categorias = $categoriasModel->getList(" categorias_padre='0' AND categorias_estado='1' AND categorias_estado_imagen='1'", " categorias_nombre ASC ");

		$this->_view->categorias2 = $categorias2 = $categoriasModel->getList(" categorias_padre='0' AND categorias_estado='1' AND categorias_estado_imagen='1'", " categorias_nombre ASC ");

		foreach ($categorias as $key => $value) {
			$padre = $value->categorias_id;
			$hijos = $categoriasModel->getList(" categorias_padre='$padre' ", " orden ASC ");
			$value->hijos = $hijos;
		}

		foreach ($categorias2 as $key => $value) {
			$padre = $value->categorias_id;
			$hijos = $categoriasModel->getList(" categorias_padre='$padre' ", " orden ASC ");
			$value->hijos = $hijos;
		}

		$this->_view->categorias = $categorias;
		$this->_view->categorias2 = $categorias2;
		$this->_view->popup = $popup;

		$productosModel = new Administracion_Model_DbTable_Productos();
		$tiendasModel = new Administracion_Model_DbTable_Tiendas();
		$categoriasModel = new Administracion_Model_DbTable_Categorias();

		// Implementacion de paginacion para tiendas
		$filters = " tiendas_estado='1' ";
		$order = "tiendas_nombre ASC"; // Cambio de rand() a orden alfabetico
		$list = $tiendasModel->getList($filters, $order);
		$amount = $this->pages;
		$page = $this->_getSanitizedParam("page");

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

		// Variables para la vista de paginacion
		$this->_view->register_number = count($list);
		$this->_view->pages = $this->pages;
		$this->_view->totalpages = ceil(count($list) / $amount);
		// echo $this->_view->totalpages;
		$this->_view->page = $page;

		// Obtener las tiendas paginadas
		$this->_view->tiendas = $tiendas = $tiendasModel->getList($filters, $order . " LIMIT $start, $amount");

		foreach ($tiendas as $key => $value) {
			$tienda_id = $value->tiendas_id;
			$value->productos = $productosModel->getList(" productos_tienda='$tienda_id' ", "");
			$id = $value->tiendas_categoria;
			$value->categoria = $categoriasModel->getById($id);
		}
		$this->_view->tiendas = $tiendas;


		$emp = $this->_getSanitizedParam('emp');
		$registro = $this->_getSanitizedParam('registro');
		$mail = $this->_getSanitizedParam('mail');

		$this->_view->emp = $emp;
		$this->_view->registro = $registro;
		$this->_view->mail = $mail;
	}


	public function index2Action()
	{
		// $asociado = $this->getAsociado();
		$this->_view->bannerprincipal = $this->template->bannerprincipal(1);
		$publicidadModel = new Administracion_Model_DbTable_Publicidad();
		$popup = $publicidadModel->getList("publicidad_seccion=6", "")[0];

		$catgoria = $this->_getSanitizedParam('categoria');
		$subcategoria = $this->_getSanitizedParam('subcategoria');
		$buscar = $this->_getSanitizedParam('buscar');
		if ($catgoria != "") {
			$this->_view->productos = $this->template->getProductosf($catgoria, $subcategoria);
		} elseif ($catgoria == "") {
			$this->_view->productos = $this->template->getProductos($buscar);
		}

		$categoriasModel = new Administracion_Model_DbTable_Categorias();
		$this->_view->categorias = $categorias = $categoriasModel->getList(" categorias_padre='0' AND categorias_estado='1' AND categorias_estado_imagen='1'", " orden_categorias ASC LIMIT 9 ");

		$this->_view->categorias2 = $categorias2 = $categoriasModel->getList(" categorias_padre='0' AND categorias_estado='1' AND categorias_estado_imagen='1'", " categorias_nombre ASC ");

		foreach ($categorias as $key => $value) {
			$padre = $value->categorias_id;
			$hijos = $categoriasModel->getList(" categorias_padre='$padre' ", " orden ASC ");
			$value->hijos = $hijos;
		}

		foreach ($categorias2 as $key => $value) {
			$padre = $value->categorias_id;
			$hijos = $categoriasModel->getList(" categorias_padre='$padre' ", " orden ASC ");
			$value->hijos = $hijos;
		}

		$this->_view->categorias = $categorias;
		$this->_view->categorias2 = $categorias2;
		$this->_view->popup = $popup;

		$productosModel = new Administracion_Model_DbTable_Productos();
		$tiendasModel = new Administracion_Model_DbTable_Tiendas();
		$categoriasModel = new Administracion_Model_DbTable_Categorias();
		$this->_view->tiendas = $tiendas = $tiendasModel->getList(" tiendas_estado='1' ", " rand() LIMIT 9 ");
		foreach ($tiendas as $key => $value) {
			$tienda_id = $value->tiendas_id;
			$value->productos = $productosModel->getList(" productos_tienda='$tienda_id' ", "");
			$id = $value->tiendas_categoria;
			$value->categoria = $categoriasModel->getById($id);
		}
		$this->_view->tiendas = $tiendas;

	}

	public function seleccionarAction()
	{
		$contenidoModel = new Page_Model_DbTable_Contenido();
		$this->_view->carta = $contenidoModel->getList("contenido_seccion = '13' AND contenido_estado='1' ", "orden ASC");
	}


	public function enviarbackupAction()
	{

		$this->setLayout("blanco");
		$hoy = date("Y-m-d");
		$emailModel = new Core_Model_Mail();
		$asunto = "Backup nux " . $hoy;

		$content = "Backup nux " . $hoy;

		$emailModel->getMail()->addBCC("soporteomega@omegawebsystems.com");
		$emailModel->getMail()->addAddress("glozano@clubelnogal.com");

		$archivo = "nuxclube_bd.sql.zip";
		$emailModel->getMail()->AddAttachment($_SERVER['DOCUMENT_ROOT'] . "/backups/" . $archivo, "" . $archivo);

		$emailModel->getMail()->Subject = $asunto;
		$emailModel->getMail()->msgHTML($content);
		$emailModel->getMail()->AltBody = $content;
		$emailModel->getMail()->SMTPDebug = 0;
		$emailModel->sed();
		echo $emailModel->getMail()->ErrorInfo;

		header("HTTP/1.1 200 OK");
	}

}