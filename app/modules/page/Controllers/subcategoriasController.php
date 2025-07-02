<?php
/**
 * Controlador de Subcategorias que permite la creacion, edicion y eliminacion de subcategorias por emprendimiento
 */
class Page_subcategoriasController extends Page_mainController
{
	/**
	 * $mainModel  instancia del modelo de base de datos Categorias
	 * @var Administracion_Model_DbTable_Categorias
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
	protected $_csrf_section = "page_subcategorias";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;

	/**
	 * $namepageactual nombre de la variable para guardar la página actual
	 * @var string
	 */
	protected $namepageactual;



	/**
	 * Inicializa las variables principales del controlador subcategorias para emprendimientos.
	 *
	 * @return void.
	 */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Categorias();
		$this->namefilter = "parametersfiltersubcategorias";
		$this->route = "/page/subcategorias";
		$this->namepages = "pages_subcategorias";
		$this->namepageactual = "page_actual_subcategorias";
		$this->_view->route = $this->route;

		if (Session::getInstance()->get($this->namepages)) {
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}

		// Validación de autenticación del usuario emprendedor
		if (
			!Session::getInstance()->get("asociado") ||
			!Session::getInstance()->get("kt_login_id") ||
			!Session::getInstance()->get("user_negocio") ||
			!Session::getInstance()->get("user_negocio") > 0
		) {
			header('Location: /');
			exit;
		}

		parent::init();
	}


	/**
	 * Recibe la informacion y muestra un listado de Subcategorias del emprendimiento con sus respectivos filtros.
	 *
	 * @return void.
	 */
	public function indexAction()
	{
		// Validación de la tienda del usuario
		$tiendaId = Session::getInstance()->get('user_negocio');
		if (!$tiendaId) {
			header('Location: /');
			exit;
		}

		// Obtener información de la tienda
		$tiendaModel = new Administracion_Model_DbTable_Tiendas();
		$tiendaInfo = $tiendaModel->getById($tiendaId);

		$title = "Administración de Subcategorías";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->_view->tienda = $tiendaId;
		$this->_view->tiendaInfo = $tiendaInfo;

		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters = (object) Session::getInstance()->get($this->namefilter);
		$this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "orden ASC";

		// Agregar filtro para mostrar solo subcategorías del emprendimiento actual
		// Usamos categorias_padre para almacenar el ID de la tienda (reutilizando el campo existente)
		$filters .= " AND categorias_padre = '$tiendaId' ";

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

		// Obtener categorías principales disponibles
		$categoriasModel = new Administracion_Model_DbTable_Categorias();
		$this->_view->categorias_principales = $categoriasModel->getList("categorias_estado='1' AND categorias_padre='0'", "orden ASC");
	}

	/**
	 * Genera la Informacion necesaria para editar o crear una Subcategoria del emprendimiento y muestra su formulario
	 *
	 * @return void.
	 */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_subcategorias_" . date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];

		$tiendaId = Session::getInstance()->get('user_negocio');
		$this->_view->tienda = $tiendaId;

		// Obtener categorías principales disponibles
		$categoriasModel = new Administracion_Model_DbTable_Categorias();
		$this->_view->categorias_principales = $categoriasModel->getList("categorias_estado='1' AND categorias_padre='0'", "orden ASC");

		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if ($content && isset($content->categorias_id) && $content->categorias_padre == $tiendaId) {
				$this->_view->content = $content;
				$this->_view->routeform = $this->route . "/update";
				$title = "Actualizar Subcategoría";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			} else {
				$this->_view->routeform = $this->route . "/insert";
				$title = "Crear Subcategoría";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route . "/insert";
			$title = "Crear Subcategoría";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
	 * Inserta la informacion de una Subcategoria del emprendimiento y redirecciona al listado.
	 *
	 * @return void.
	 */
	public function insertAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
			$data = $this->getData();

			// Asegurar que la subcategoría pertenezca al emprendimiento actual
			$data['categorias_padre'] = Session::getInstance()->get('user_negocio');

			$uploadImage = new Core_Model_Upload_Image();
			if ($_FILES['categorias_banner']['name'] != '') {
				$data['categorias_banner'] = $uploadImage->upload("categorias_banner");
			}
			if ($_FILES['categorias_imagen_techo']['name'] != '') {
				$data['categorias_imagen_techo'] = $uploadImage->upload("categorias_imagen_techo");
			}
			if ($_FILES['categorias_imagen_tienda']['name'] != '') {
				$data['categorias_imagen_tienda'] = $uploadImage->upload("categorias_imagen_tienda");
			}
			$id = $this->mainModel->insert($data);
			$this->mainModel->changeOrder($id, $id);
			$data['categorias_id'] = $id;
			$data['log_log'] = print_r($data, true);
			$data['log_tipo'] = 'CREAR SUBCATEGORIA EMPRENDIMIENTO';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		header('Location: ' . $this->route . '');
	}

	/**
	 * Recibe un identificador y Actualiza la informacion de una Subcategoria del emprendimiento.
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
			$tiendaId = Session::getInstance()->get('user_negocio');

			// Verificar que la subcategoría pertenece al emprendimiento
			if ($content && isset($content->categorias_id) && $content->categorias_padre == $tiendaId) {
				$data = $this->getData();
				$data['categorias_padre'] = $tiendaId; // Asegurar pertenencia

				$uploadImage = new Core_Model_Upload_Image();
				if ($_FILES['categorias_banner']['name'] != '') {
					if ($content->categorias_banner) {
						$uploadImage->delete($content->categorias_banner);
					}
					$data['categorias_banner'] = $uploadImage->upload("categorias_banner");
				} else {
					$data['categorias_banner'] = $content->categorias_banner;
				}
				if ($_FILES['categorias_imagen_techo']['name'] != '') {
					if ($content->categorias_imagen_techo) {
						$uploadImage->delete($content->categorias_imagen_techo);
					}
					$data['categorias_imagen_techo'] = $uploadImage->upload("categorias_imagen_techo");
				} else {
					$data['categorias_imagen_techo'] = $content->categorias_imagen_techo;
				}
				if ($_FILES['categorias_imagen_tienda']['name'] != '') {
					if ($content->categorias_imagen_tienda) {
						$uploadImage->delete($content->categorias_imagen_tienda);
					}
					$data['categorias_imagen_tienda'] = $uploadImage->upload("categorias_imagen_tienda");
				} else {
					$data['categorias_imagen_tienda'] = $content->categorias_imagen_tienda;
				}
				$this->mainModel->update($data, $id);

				$data['categorias_id'] = $id;
				$data['log_log'] = print_r($data, true);
				$data['log_tipo'] = 'EDITAR SUBCATEGORIA EMPRENDIMIENTO';
				$logModel = new Administracion_Model_DbTable_Log();
				$logModel->insert($data);
			}
		}
		header('Location: ' . $this->route . '');
	}

	/**
	 * Recibe un identificador y elimina una Subcategoria del emprendimiento.
	 *
	 * @return void.
	 */
	public function deleteAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_csrf_section] == $csrf) {
			$id = $this->_getSanitizedParam("id");
			$tiendaId = Session::getInstance()->get('user_negocio');

			if (isset($id) && $id > 0) {
				$content = $this->mainModel->getById($id);
				// Verificar que la subcategoría pertenece al emprendimiento
				if (isset($content) && $content->categorias_padre == $tiendaId) {
					$this->mainModel->deleteRegister($id);
					$data = (array) $content;
					$data['log_log'] = print_r($data, true);
					$data['log_tipo'] = 'BORRAR SUBCATEGORIA EMPRENDIMIENTO';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data);
				}
			}
		}
		header('Location: ' . $this->route . '');
	}

	/**
	 * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Subcategorias.
	 *
	 * @return array con toda la informacion recibida del formulario.
	 */
	private function getData()
	{
		$data = array();
		$data['categorias_nombre'] = $this->_getSanitizedParam("categorias_nombre");
		$data['categorias_descripcion'] = $this->_getSanitizedParamHtml("categorias_descripcion");
		// No se asigna categorias_padre aquí ya que se asigna en insert/update con el ID de la tienda

		if ($this->_getSanitizedParam("categorias_banner") == '') {
			$data['categorias_banner'] = '0';
		} else {
			$data['categorias_banner'] = $this->_getSanitizedParam("categorias_banner");
		}
		$data['categorias_color'] = $this->_getSanitizedParamHtml("categorias_color");

		if ($this->_getSanitizedParam("categorias_imagen_techo") == '') {
			$data['categorias_imagen_techo'] = '0';
		} else {
			$data['categorias_imagen_techo'] = $this->_getSanitizedParam("categorias_imagen_techo");
		}

		if ($this->_getSanitizedParam("categorias_estado") == '') {
			$data['categorias_estado'] = '1'; // Por defecto activo para subcategorías de emprendimiento
		} else {
			$data['categorias_estado'] = $this->_getSanitizedParam("categorias_estado");
		}
		if ($this->_getSanitizedParam("categorias_imagen_tienda") == '') {
			$data['categorias_imagen_tienda'] = '0';
		} else {
			$data['categorias_imagen_tienda'] = $this->_getSanitizedParam("categorias_imagen_tienda");
		}
		if ($this->_getSanitizedParam("categorias_estado_imagen") == '') {
			$data['categorias_estado_imagen'] = '0';
		} else {
			$data['categorias_estado_imagen'] = $this->_getSanitizedParam("categorias_estado_imagen");
		}

		// Agregar campo para la categoría principal a la que pertenece esta subcategoría
		$data['categorias_categoria_principal'] = $this->_getSanitizedParam("categorias_categoria_principal");

		return $data;
	}
	/**
	 * Genera la consulta con los filtros de este controlador.
	 *
	 * @return string cadena con los filtros que se van a asignar a la base de datos
	 */
	protected function getFilter()
	{
		$filtros = " 1 = 1 ";

		if (Session::getInstance()->get($this->namefilter) != "") {
			$filters = (object) Session::getInstance()->get($this->namefilter);
			if ($filters->categorias_nombre != '') {
				$filtros = $filtros . " AND categorias_nombre LIKE '%" . $filters->categorias_nombre . "%'";
			}
			if ($filters->categorias_descripcion != '') {
				$filtros = $filtros . " AND categorias_descripcion LIKE '%" . $filters->categorias_descripcion . "%'";
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
			$parramsfilter['categorias_nombre'] = $this->_getSanitizedParam("categorias_nombre");
			$parramsfilter['categorias_descripcion'] = $this->_getSanitizedParam("categorias_descripcion");
			Session::getInstance()->set($this->namefilter, $parramsfilter);
		}
		if ($this->_getSanitizedParam("cleanfilter") == 1) {
			Session::getInstance()->set($this->namefilter, '');
			Session::getInstance()->set($this->namepageactual, 1);
		}
	}
}