<?php

/**
 * Controlador para la gestión de productos en el módulo de páginas
 * Maneja el listado, creación, edición y eliminación de productos
 * 
 * @author Sistema de Emprendimiento
 * @version 1.0
 */
class Page_listproductosController extends Page_mainController
{
	// ========================================
	// PROPIEDADES DE LA CLASE
	// ========================================

	/**
	 * Instancia del modelo de base de datos para productos
	 * @var Administracion_Model_DbTable_Productos
	 */
	public $mainModel;

	/**
	 * URL base del controlador
	 * @var string
	 */
	protected $route;

	/**
	 * Cantidad de registros a mostrar por página
	 * @var integer
	 */
	protected $pages;

	/**
	 * Nombre de la variable de sesión para guardar los filtros
	 * @var string
	 */
	protected $namefilter;

	/**
	 * Nombre de la sección CSRF para validación de formularios
	 * @var string
	 */
	protected $_csrf_section = "administracion_productos";

	/**
	 * Nombre de la variable de sesión para el número de página en la paginación
	 * @var string
	 */
	protected $namepages;

	/**
	 * Nombre de la variable de sesión para guardar la página actual
	 * @var string
	 */
	protected $namepageactual;

	// ========================================
	// MÉTODOS DE INICIALIZACIÓN
	// ========================================

	/**
	 * Inicializa el controlador configurando variables y validando la sesión
	 * Configura el modelo, rutas, paginación y valida que el usuario esté autenticado
	 * 
	 * @return void
	 */
	public function init()
	{
		// Configuración del modelo y variables de controlador
		$this->mainModel = new Administracion_Model_DbTable_Productos();
		$this->namefilter = "parametersfilterproductos";
		$this->route = "/page/listproductos";
		$this->namepageactual = "page_actual_productos";
		$this->_view->route = $this->route;
		$this->namepages = 20;

		// Configuración de la paginación desde sesión o valor por defecto
		if (Session::getInstance()->get($this->namepages)) {
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}

		// Validación de autenticación del usuario
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
	// ========================================
	// ACCIONES PRINCIPALES DEL CONTROLADOR
	// ========================================

	/**
	 * Acción principal que muestra el listado de productos con paginación y filtros
	 * Valida la tienda del usuario y configura la vista con todos los datos necesarios
	 * 
	 * @return void
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

		// Configuración inicial de la vista
		$this->_view->tienda = $tiendaId;
		$this->_view->tiendaInfo = $tiendaInfo;
		$this->_view->titlesection = "Administración de productos";
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];

		// Procesamiento de filtros
		$this->filters();
		$filters = (object) Session::getInstance()->get($this->namefilter);
		$this->_view->filters = $filters;

		// Construcción de filtros para la consulta
		$filterQuery = $this->getFilter();
		$order = "orden ASC";
		$filterQuery = $filterQuery . " AND productos_tienda = '$tiendaId' ";

		// Obtener lista completa para contar registros
		$list = $this->mainModel->getList($filterQuery, $order);

		// Verificar si existen productos y configurar variables para la vista
		$this->_view->hasProducts = count($list) > 0;
		$this->_view->categoria = $this->_getSanitizedParam("categoria");
		$this->_view->subcategoria = $this->_getSanitizedParam("subcategoria");

		// Configuración de la paginación
		$amount = $this->pages;
		$page = $this->_getSanitizedParam("page");

		if (!$page && Session::getInstance()->get($this->namepageactual)) {
			// Usar página guardada en sesión
			$page = Session::getInstance()->get($this->namepageactual);
			$start = ($page - 1) * $amount;
		} else if (!$page) {
			// Primera página por defecto
			$start = 0;
			$page = 1;
			Session::getInstance()->set($this->namepageactual, $page);
		} else {
			// Página específica solicitada
			Session::getInstance()->set($this->namepageactual, $page);
			$start = ($page - 1) * $amount;
		}

		// Configuración final de la vista con datos de paginación
		$this->_view->register_number = count($list);
		$this->_view->pages = $this->pages;
		$this->_view->totalpages = ceil(count($list) / $amount);
		$this->_view->page = $page;
		$this->_view->lists = $this->mainModel->getListPages($filterQuery, $order, $start, $amount);
		$this->_view->csrf_section = $this->_csrf_section;
	}

	/**
	 * Acción para mostrar el detalle de un producto específico
	 * TODO: Implementar funcionalidad de detalle
	 * 
	 * @return void
	 */
	public function detalleAction()
	{
		// TODO: Implementar lógica para mostrar detalle del producto
	}

	/**
	 * Acción para mostrar productos destacados
	 * TODO: Implementar funcionalidad de productos destacados
	 * 
	 * @return void
	 */
	public function destacadosAction()
	{
		// TODO: Implementar lógica para mostrar productos destacados
	}

	// ========================================
	// GESTIÓN DE PRODUCTOS (CRUD)
	// ========================================

	/**
	 * Prepara el formulario para crear o editar un producto
	 * Configura la vista con la información necesaria según si es creación o edición
	 * 
	 * @return void
	 */
	public function manageAction()
	{
		// Configuración básica del formulario
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_productos_" . date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];

		// Pasar parámetros de URL a la vista
		$this->_view->categoria = $this->_getSanitizedParam("categoria");
		$this->_view->subcategoria = $this->_getSanitizedParam("subcategoria");
		$this->_view->tienda = $this->_getSanitizedParam("tienda");

		$id = $this->_getSanitizedParam("id");

		if ($id > 0) {
			// Modo edición: buscar producto existente
			$content = $this->mainModel->getById($id);
			if ($content->productos_id) {
				// Producto encontrado - configurar para edición
				$this->_view->content = $content;
				$this->_view->routeform = $this->route . "/update";
				$title = "Actualizar productos";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			} else {
				// Producto no encontrado - configurar para creación
				$this->_view->routeform = $this->route . "/insert";
				$title = "Crear productos";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			// Modo creación: nuevo producto
			$this->_view->routeform = $this->route . "/insert";
			$title = "Crear productos";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
	 * Crea un nuevo producto en la base de datos
	 * Valida CSRF, procesa los datos del formulario, maneja la subida de imágenes
	 * y registra la acción en el log del sistema
	 * 
	 * @return void
	 */
	public function insertAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");

		// Validación CSRF
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
			// Obtener datos del formulario
			$data = $this->getData();

			// Manejo de subida de imagen
			$uploadImage = new Core_Model_Upload_Image();
			if ($_FILES['productos_imagen']['name'] != '') {
				$data['productos_imagen'] = $uploadImage->upload("productos_imagen");
			}

			// Insertar producto y configurar orden
			$id = $this->mainModel->insert($data);
			$this->mainModel->changeOrder($id, $id);

			// Registrar en el log del sistema
			$data['productos_id'] = $id;
			$data['log_log'] = print_r($data, true);
			$data['log_tipo'] = 'CREAR PRODUCTOS';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}

		// Redirección con parámetros de filtro
		$categoria = $this->_getSanitizedParam("productos_categorias");
		$subcategoria = $this->_getSanitizedParam("productos_subcategoria");
		$tienda = $this->_getSanitizedParam("productos_tienda");
		header('Location: ' . $this->route . '?categoria=' . $categoria . '&subcategoria=' . $subcategoria . '&tienda=' . $tienda . '');
	}

	/**
	 * Actualiza un producto existente en la base de datos
	 * Valida CSRF, busca el producto, procesa los datos y maneja imágenes
	 * 
	 * @return void
	 */
	public function updateAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");

		// Validación CSRF
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);

			if ($content->productos_id) {
				// Obtener datos del formulario
				$data = $this->getData();
				$uploadImage = new Core_Model_Upload_Image();

				// Manejo de imagen: subir nueva o mantener existente
				if ($_FILES['productos_imagen']['name'] != '') {
					// Eliminar imagen anterior si existe
					if ($content->productos_imagen) {
						$uploadImage->delete($content->productos_imagen);
					}
					$data['productos_imagen'] = $uploadImage->upload("productos_imagen");
				} else {
					// Mantener imagen existente
					$data['productos_imagen'] = $content->productos_imagen;
				}

				// Actualizar producto
				$this->mainModel->update($data, $id);
			}

			// Registrar en el log del sistema
			$data['productos_id'] = $id;
			$data['log_log'] = print_r($data, true);
			$data['log_tipo'] = 'EDITAR PRODUCTOS';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}

		// Redirección con parámetros de filtro
		$categoria = $this->_getSanitizedParam("productos_categorias");
		$subcategoria = $this->_getSanitizedParam("productos_subcategoria");
		$tienda = $this->_getSanitizedParam("productos_tienda");
		header('Location: ' . $this->route . '?categoria=' . $categoria . '&subcategoria=' . $subcategoria . '&tienda=' . $tienda . '');
	}

	/**
	 * Elimina un producto de la base de datos
	 * Valida CSRF, elimina la imagen asociada si existe y registra la acción
	 * 
	 * @return void
	 */
	public function deleteAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");

		// Validación CSRF
		if (Session::getInstance()->get('csrf')[$this->_csrf_section] == $csrf) {
			$id = $this->_getSanitizedParam("id");

			if (isset($id) && $id > 0) {
				$content = $this->mainModel->getById($id);

				if (isset($content)) {
					// Eliminar imagen asociada si existe
					$uploadImage = new Core_Model_Upload_Image();
					if (isset($content->productos_imagen) && $content->productos_imagen != '') {
						$uploadImage->delete($content->productos_imagen);
					}

					// Eliminar producto de la base de datos
					$this->mainModel->deleteRegister($id);

					// Registrar eliminación en el log
					$data = (array) $content;
					$data['log_log'] = print_r($data, true);
					$data['log_tipo'] = 'BORRAR PRODUCTOS';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data);
				}
			}
		}

		// Redirección con parámetros de filtro
		$categoria = $this->_getSanitizedParam("categoria");
		$subcategoria = $this->_getSanitizedParam("subcategoria");
		$tienda = $this->_getSanitizedParam("tienda");
		header('Location: ' . $this->route . '?categoria=' . $categoria . '&subcategoria=' . $subcategoria . '&tienda=' . $tienda . '');
	}

	// ========================================
	// MÉTODOS AUXILIARES Y UTILIDADES
	// ========================================

	/**
	 * Procesa y sanitiza los datos del formulario de producto
	 * Recopila todos los campos del formulario y los devuelve en formato array
	 * 
	 * @return array Datos del producto sanitizados y listos para insertar/actualizar
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
	// ========================================
	// SISTEMA DE FILTROS Y BÚSQUEDA
	// ========================================

	/**
	 * Construye la consulta SQL con filtros aplicados
	 * Combina filtros de URL y filtros guardados en sesión para generar la consulta WHERE
	 * 
	 * @return string Cadena SQL con las condiciones de filtro
	 */
	protected function getFilter()
	{
		$filtros = " 1 = 1 ";

		// Filtro por tienda desde parámetro URL
		$tienda = $this->_getSanitizedParam("tienda");
		if ($this->_getSanitizedParam("tienda")) {
			$filtros = $filtros . " AND productos_tienda = '$tienda' ";
		}

		// Aplicar filtros guardados en sesión
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
	 * Procesa y gestiona los filtros de búsqueda
	 * Maneja tanto la aplicación de nuevos filtros como la limpieza de filtros existentes
	 * 
	 * @return void
	 */
	protected function filters()
	{
		if ($this->getRequest()->isPost() == true) {
			// Aplicar nuevos filtros desde formulario POST
			Session::getInstance()->set($this->namepageactual, 1); // Resetear a primera página

			$parramsfilter = array();
			$parramsfilter['productos_nombre'] = $this->_getSanitizedParam("productos_nombre");
			$parramsfilter['productos_descripcion'] = $this->_getSanitizedParam("productos_descripcion");
			$parramsfilter['productos_imagen'] = $this->_getSanitizedParam("productos_imagen");
			$parramsfilter['productos_precio'] = $this->_getSanitizedParam("productos_precio");

			Session::getInstance()->set($this->namefilter, $parramsfilter);
		}

		// Limpiar filtros si se solicita
		if ($this->_getSanitizedParam("cleanfilter") == 1) {
			Session::getInstance()->set($this->namefilter, '');
			Session::getInstance()->set($this->namepageactual, 1);
		}
	}

}