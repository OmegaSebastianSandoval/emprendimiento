<?php

/**
 *
 */

class Page_listproductosController extends Page_mainController
{

	/**
	 * $mainModel  instancia del modelo de  base de datos productos
	 * @var modeloContenidos
	 */
	public $mainModel;

	/**
	 * $route  url del controlador base
	 * @var string
	 */
	protected $route;

	/**
	 * $pages cantidad de registros a mostrar por pagina]
	 * @var integer
	 */
	protected $pages;

	/**
	 * $namefilter nombre de la variable a la fual se le van a guardar los filtros
	 * @var string
	 */
	protected $namefilter;

	/**
	 * $_csrf_section  nombre de la variable general csrf  que se va a almacenar en la session
	 * @var string
	 */
	protected $_csrf_section = "administracion_productos";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;

	/**
	 * $namepageactual nombre de la variable en la cual se va a guardar el numero de pagina actual
	 * @var string
	 */
	protected $namepageactual;

	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Productos();
		$this->namefilter = "parametersfilterproductos";
		$this->route = "/page/listproductos";
		$this->namepageactual = "page_actual_productos";
		$this->_view->route = $this->route;
		$this->namepages = 20;

		if (Session::getInstance()->get($this->namepages)) {
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}

		if (!Session::getInstance()->get("asociado") || !Session::getInstance()->get("kt_login_id")) {
			header('Location: /');
			exit;
		}
		parent::init();
	}
	public function indexAction()
	{
		$tiendaId = Session::getInstance()->get('user_negocio');

		 if (!$tiendaId) {
			header('Location: /');
			exit;
		} 
		$title = "Administración de productos";
		$this->_view->titlesection = $title;

		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];

		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters = (object) Session::getInstance()->get($this->namefilter);
		$this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "orden ASC";
		$filters = $filters . " AND productos_tienda = '$tiendaId' ";
		$list = $this->mainModel->getList($filters, $order);

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
		$this->_view->register_number = count($list);
		$this->_view->pages = $this->pages;
		$this->_view->totalpages = ceil(count($list) / $amount);
		$this->_view->page = $page;
		$this->_view->lists = $this->mainModel->getListPages($filters, $order, $start, $amount);
		$this->_view->csrf_section = $this->_csrf_section;

	}
	public function detalleAction()
	{

	}
	public function destacadosAction()
	{

	}

	/**
	 * Genera la Informacion necesaria para editar o crear un  productos  y muestra su formulario
	 *
	 * @return void.
	 */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_productos_" . date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->categoria = $this->_getSanitizedParam("categoria");
		$this->_view->subcategoria = $this->_getSanitizedParam("subcategoria");
		$this->_view->tienda = $this->_getSanitizedParam("tienda");
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if ($content->productos_id) {
				$this->_view->content = $content;
				$this->_view->routeform = $this->route . "/update";
				$title = "Actualizar productos";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			} else {
				$this->_view->routeform = $this->route . "/insert";
				$title = "Crear productos";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route . "/insert";
			$title = "Crear productos";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
	 * Inserta la informacion de un productos  y redirecciona al listado de productos.
	 *
	 * @return void.
	 */
	public function insertAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
			$data = $this->getData();
			$uploadImage = new Core_Model_Upload_Image();
			if ($_FILES['productos_imagen']['name'] != '') {
				$data['productos_imagen'] = $uploadImage->upload("productos_imagen");
			}
			$id = $this->mainModel->insert($data);
			$this->mainModel->changeOrder($id, $id);
			$data['productos_id'] = $id;
			$data['log_log'] = print_r($data, true);
			$data['log_tipo'] = 'CREAR PRODUCTOS';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		$categoria = $this->_getSanitizedParam("productos_categorias");
		$subcategoria = $this->_getSanitizedParam("productos_subcategoria");
		$tienda = $this->_getSanitizedParam("productos_tienda");
		header('Location: ' . $this->route . '?categoria=' . $categoria . '&subcategoria=' . $subcategoria . '&tienda=' . $tienda . '');
	}

	/**
	 * Recibe un identificador  y Actualiza la informacion de un productos  y redirecciona al listado de productos.
	 *
	 * @return void.
	 */
	public function updateAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->productos_id) {
				$data = $this->getData();
				$uploadImage = new Core_Model_Upload_Image();
				if ($_FILES['productos_imagen']['name'] != '') {
					if ($content->productos_imagen) {
						$uploadImage->delete($content->productos_imagen);
					}
					$data['productos_imagen'] = $uploadImage->upload("productos_imagen");
				} else {
					$data['productos_imagen'] = $content->productos_imagen;
				}
				$this->mainModel->update($data, $id);
			}
			$data['productos_id'] = $id;
			$data['log_log'] = print_r($data, true);
			$data['log_tipo'] = 'EDITAR PRODUCTOS';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		$categoria = $this->_getSanitizedParam("productos_categorias");
		$subcategoria = $this->_getSanitizedParam("productos_subcategoria");
		$tienda = $this->_getSanitizedParam("productos_tienda");
		header('Location: ' . $this->route . '?categoria=' . $categoria . '&subcategoria=' . $subcategoria . '&tienda=' . $tienda . '');
	}

	/**
	 * Recibe un identificador  y elimina un productos  y redirecciona al listado de productos.
	 *
	 * @return void.
	 */
	public function deleteAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_csrf_section] == $csrf) {
			$id = $this->_getSanitizedParam("id");
			if (isset($id) && $id > 0) {
				$content = $this->mainModel->getById($id);
				if (isset($content)) {
					$uploadImage = new Core_Model_Upload_Image();
					if (isset($content->productos_imagen) && $content->productos_imagen != '') {
						$uploadImage->delete($content->productos_imagen);
					}
					$this->mainModel->deleteRegister($id);
					$data = (array) $content;
					$data['log_log'] = print_r($data, true);
					$data['log_tipo'] = 'BORRAR PRODUCTOS';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data);
				}
			}
		}
		$categoria = $this->_getSanitizedParam("categoria");
		$subcategoria = $this->_getSanitizedParam("subcategoria");
		$tienda = $this->_getSanitizedParam("tienda");
		header('Location: ' . $this->route . '?categoria=' . $categoria . '&subcategoria=' . $subcategoria . '&tienda=' . $tienda . '');
	}

	/**
	 * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Productos.
	 *
	 * @return array con toda la informacion recibida del formulario.
	 */
	private function getData()
	{
		$data = array();
		$data['productos_nombre'] = $this->_getSanitizedParam("productos_nombre");
		$data['productos_descripcion'] = $this->_getSanitizedParamHtml("productos_descripcion");
		$data['productos_imagen'] = "";
		$data['productos_destacado'] = $this->_getSanitizedParam("productos_destacado");
		$data['productos_precio'] = $this->_getSanitizedParam("productos_precio");
		$data['productos_nuevo'] = $this->_getSanitizedParam("productos_nuevo");
		$data['productos_cantidad'] = $this->_getSanitizedParam("productos_cantidad");
		$data['productos_categorias'] = $this->_getSanitizedParamHtml("productos_categorias");
		$data['productos_subcategoria'] = $this->_getSanitizedParamHtml("productos_subcategoria");
		$data['producto_activo'] = $this->_getSanitizedParam("producto_activo");
		$data['productos_codigo'] = '';
		$data['productos_cantidad_minima'] = $this->_getSanitizedParam("productos_cantidad_minima");
		$data['productos_limite_pedido'] = $this->_getSanitizedParam("productos_limite_pedido");
		$data['productos_tienda'] = $this->_getSanitizedParamHtml("productos_tienda");
		return $data;
	}
	/**
	 * Genera la consulta con los filtros de este controlador.
	 *
	 * @return array cadena con los filtros que se van a asignar a la base de datos
	 */
	protected function getFilter()
	{
		$filtros = " 1 = 1 ";
		$tienda = $this->_getSanitizedParam("tienda");
		if ($this->_getSanitizedParam("tienda")) {
			$filtros = $filtros . " AND productos_tienda = '$tienda' ";
		}
		if (Session::getInstance()->get($this->namefilter) != "") {
			$filters = (object) Session::getInstance()->get($this->namefilter);
			if ($filters->productos_nombre != '') {
				$filtros = $filtros . " AND productos_nombre LIKE '%" . $filters->productos_nombre . "%'";
			}
			if ($filters->productos_descripcion != '') {
				$filtros = $filtros . " AND productos_descripcion LIKE '%" . $filters->productos_descripcion . "%'";
			}
			if ($filters->productos_imagen != '') {
				$filtros = $filtros . " AND productos_imagen LIKE '%" . $filters->productos_imagen . "%'";
			}
			if ($filters->productos_precio != '') {
				$filtros = $filtros . " AND productos_precio LIKE '%" . $filters->productos_precio . "%'";
			}
		}
		return $filtros;
	}

	/**
	 * Recibe y asigna los filtros de este controlador
	 *
	 * @return void
	 */
	protected function filters()
	{
		if ($this->getRequest()->isPost() == true) {
			Session::getInstance()->set($this->namepageactual, 1);
			$parramsfilter = array();
			$parramsfilter['productos_nombre'] = $this->_getSanitizedParam("productos_nombre");
			$parramsfilter['productos_descripcion'] = $this->_getSanitizedParam("productos_descripcion");
			$parramsfilter['productos_imagen'] = $this->_getSanitizedParam("productos_imagen");
			$parramsfilter['productos_precio'] = $this->_getSanitizedParam("productos_precio");
			Session::getInstance()->set($this->namefilter, $parramsfilter);
		}
		if ($this->_getSanitizedParam("cleanfilter") == 1) {
			Session::getInstance()->set($this->namefilter, '');
			Session::getInstance()->set($this->namepageactual, 1);
		}
	}

}