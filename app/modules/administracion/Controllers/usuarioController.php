<?php
/**
 * Controlador de Usuario que permite la  creacion, edicion  y eliminacion de los Usuarios del Sistema
 */
class Administracion_usuarioController extends Administracion_mainController
{
	public $botonpanel = 4;
	/**
	 * $mainModel  instancia del modelo de  base de datos Usuarios
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
	protected $_csrf_section = "administracion_usuario";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
	 * Inicializa las variables principales del controlador usuario .
	 *
	 * @return void.
	 */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Usuario();
		$this->namefilter = "parametersfilterusuario";
		$this->route = "/administracion/usuario";
		$this->namepages = "pages_usuario";
		$this->namepageactual = "page_actual_usuario";
		$this->_view->route = $this->route;
		if (Session::getInstance()->get($this->namepages)) {
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
	 * Recibe la informacion y  muestra un listado de  Usuarios con sus respectivos filtros.
	 *
	 * @return void.
	 */
	public function indexAction()
	{
		$title = "Administración de Usuarios";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters = (object) Session::getInstance()->get($this->namefilter);
		$this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "";
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
		$this->_view->list_user_state = $this->getUserstate();
		$this->_view->list_user_level = $this->getUserlevel();
	}

	/**
	 * Genera la Informacion necesaria para editar o crear un  Usuario  y muestra su formulario
	 *
	 * @return void.
	 */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_usuario_" . date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->list_user_state = $this->getUserstate();
		$this->_view->list_user_level = $this->getUserlevel();
		$this->_view->list_categorias = $this->getCategorias();
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if ($content->user_id) {

				if($content->user_negocio > 0){
					$tiendaModel = new Administracion_Model_DbTable_Tiendas();
					$tienda = $tiendaModel->getById($content->user_negocio);
					$this->_view->tienda = $tienda;
				}

				$this->_view->content = $content;
				$this->_view->routeform = $this->route . "/update";
				$title = "Actualizar Usuario";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;



			} else {
				$this->_view->routeform = $this->route . "/insert";
				$title = "Crear Usuario";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route . "/insert";
			$title = "Crear Usuario";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
	 * Inserta la informacion de un Usuario  y redirecciona al listado de Usuarios.
	 *
	 * @return void.
	 */
	public function insertAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
			$data = $this->getData();
			$id = $this->mainModel->insert($data);

			//LOG
			$data['log_log'] = print_r($data, true);
			$data['log_tipo'] = "CREAR USUARIO";
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		header('Location: ' . $this->route . '' . '');
	}

	/**
	 * Recibe un identificador  y Actualiza la informacion de un Usuario  y redirecciona al listado de Usuarios.
	 *
	 * @return void.
	 */
	public function updateAction()
	{
		$tiendaModel = new Administracion_Model_DbTable_Tiendas();
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
			if ($this->_getSanitizedParam("user_negocio") != 0) {
				$tiendaModel->editField($this->_getSanitizedParam("user_negocio"), "tiendas_estado", $this->_getSanitizedParam("user_state"));
			}
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->user_id) {
				$data = $this->getData();
				$this->mainModel->update($data, $id);

				if (
					$this->_getSanitizedParam("edit") == 1 &&
					($content->user_state != $data['user_state']) &&
					($data['user_state'] == 1 || $data['user_state'] == 2)
				) {

					$infoUsuario = $this->mainModel->getById($id);
					if($data['user_state'] == 1){
						$tiendasModel = new Administracion_Model_DbTable_Tiendas();
						$tiendasModel->editField($infoUsuario->user_negocio, "tiendas_estado", $data['user_state']);
					}
					$mailModel = new Core_Model_Sendingemail($this->_view);
					$res = $mailModel->enviarInfoRegistro($infoUsuario);



				}

				//LOG
				$data['user_id'] = $id;
				$data['log_log'] = print_r($data, true);
				$data['log_tipo'] = "ACTUALIZAR USUARIO";
				$logModel = new Administracion_Model_DbTable_Log();
				$logModel->insert($data);
			}
		}
		header('Location: ' . $this->route . '?res=' . $res . '');
	}

	/**
	 * Recibe un identificador  y elimina un Usuario  y redirecciona al listado de Usuarios.
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
					$this->mainModel->deleteRegister($id);

					//LOG
					$data['user_id'] = $id;
					$data['log_log'] = print_r($data, true);
					$data['log_tipo'] = "BORRAR USUARIO";
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data);
				}
			}
		}
		header('Location: ' . $this->route . '' . '');
	}

	/**
	 * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Usuario.
	 *
	 * @return array con toda la informacion recibida del formulario.
	 */
	private function getData()
	{
		$data = array();
		if ($this->_getSanitizedParam("user_state") == '') {
			$data['user_state'] = '0';
		} else {
			$data['user_state'] = $this->_getSanitizedParam("user_state");
		}
		$data['user_date'] = date("Y-m-d");
		$data['user_names'] = $this->_getSanitizedParam("user_names");
		$data['user_email'] = $this->_getSanitizedParam("user_email");
		if ($this->_getSanitizedParam("user_level") == '') {
			$data['user_level'] = '0';
		} else {
			$data['user_level'] = $this->_getSanitizedParam("user_level");
		}
		$data['user_user'] = $this->_getSanitizedParam("user_user");
		$data['user_password'] = $this->_getSanitizedParam("user_password");
		$data['user_delete'] = '1';
		$data['user_current_user'] = '1';
		$data['user_code'] = '1';
		$data['user_accion'] = $this->numeroaccion($this->_getSanitizedParam("accion"));
		$data['user_telefono'] = $this->_getSanitizedParam("telefono");
		return $data;
	}

	/**
	 * Genera los valores del campo Estado.
	 *
	 * @return array cadena con los valores del campo Estado.
	 */
	private function getUserstate()
	{
		$array = array();
		$array['1'] = 'Activo';
		$array['2'] = 'Inactivo';
		return $array;
	}

	public function getCategorias(){
		$categoriasModel = new Administracion_Model_DbTable_Categorias();
		$categorias = $categoriasModel->getList("categorias_estado = 1", "categorias_nombre ASC");
		$array = array();
		foreach ($categorias as $categoria) {
			$array[$categoria->categorias_id] = $categoria->categorias_nombre;
		}
		return $array;
	}

	/**
	 * Genera los valores del campo Nivel.
	 *
	 * @return array cadena con los valores del campo Nivel.
	 */
	private function getUserlevel()
	{
		$array = array();
		$array['1'] = 'Superusuario';
		$array['2'] = 'Asociado';
		$array['3'] = 'Invitado';
		$array['4'] = 'Expositor Asociado';
		$array['5'] = 'Expositor Invitado';
		return $array;
	}

	/**
	 * Genera la consulta con los filtros de este controlador.
	 *
	 * @return array cadena con los filtros que se van a asignar a la base de datos
	 */
	protected function getFilter()
	{
		$filtros = " user_id <> 1 ";
		if (Session::getInstance()->get($this->namefilter) != "") {
			$filters = (object) Session::getInstance()->get($this->namefilter);
			if ($filters->user_state != '') {
				$filtros = $filtros . " AND user_state ='" . $filters->user_state . "'";
			}
			if ($filters->user_date != '') {
				$filtros = $filtros . " AND user_date LIKE '%" . $filters->user_date . "%'";
			}
			if ($filters->user_names != '') {
				$filtros = $filtros . " AND user_names LIKE '%" . $filters->user_names . "%'";
			}
			if ($filters->user_level != '') {
				$filtros = $filtros . " AND user_level ='" . $filters->user_level . "'";
			}
			if ($filters->user_user != '') {
				$filtros = $filtros . " AND user_user LIKE '%" . $filters->user_user . "%'";
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
			$parramsfilter['user_state'] = $this->_getSanitizedParam("user_state");
			$parramsfilter['user_date'] = $this->_getSanitizedParam("user_date");
			$parramsfilter['user_names'] = $this->_getSanitizedParam("user_names");
			$parramsfilter['user_level'] = $this->_getSanitizedParam("user_level");
			$parramsfilter['user_user'] = $this->_getSanitizedParam("user_user");
			Session::getInstance()->set($this->namefilter, $parramsfilter);
		}
		if ($this->_getSanitizedParam("cleanfilter") == 1) {
			Session::getInstance()->set($this->namefilter, '');
			Session::getInstance()->set($this->namepageactual, 1);
		}
	}
	public function exportarAction()
	{

		$filters = $this->getFilter();
		$list = $this->mainModel->getList($filters . 'AND (user_level=3 OR user_level=5)', '');
		$this->_view->usuarios = $list;
		$this->_view->list_user_state = $this->getUserstate();
		$this->_view->list_user_level = $this->getUserlevel();
		$this->setLayout('blanco');
		$hoy = date("YmdHis");
		$excel = $this->_getSanitizedParam("excel");

		if ($excel == 1) {
			header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
			header("Content-type:   application/x-msexcel; charset=utf-8");
			header("Content-Disposition: attachment; filename=usuario" . $hoy . ".xls");

		}

	}
	public function numeroaccion($x)
	{
		$x = str_pad($x, 8, "0", STR_PAD_LEFT);
		return $x;
	}

	public function getinvitadosAction()
	{
		$usuarionuxModel = new Administracion_Model_DbTable_Usuario();
		$usuarios2 = $usuarionuxModel->getInvitados(" (user_level = '5' OR user_level='3') AND user_date>='2020-07-29' AND user_accion!='00000000' ", " user_date ASC ");

		$this->setLayout('blanco');
		header('Content-Type:application/json');

		$array = (array) $usuarios2;

		$hash = $this->_getSanitizedParam("hash");
		$hash2 = md5(date("Y-m-d") . "OMEGA");
		if ($hash == $hash2) {
			echo json_encode($array);
		}

	}



	public function cargainvitadosAction()
	{
		$id = 1;
		$content = $this->mainModel->getById($id);
		$archivo = $content->archivo_cedulas;
		$archivo = "invitados_sabana.xlsx";
		$this->getLayout()->setTitle("Importar invitados");

		//leer archivo
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 300);
		$inputFileName = FILE_PATH . '/' . $archivo;
		$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		$infoexel = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		$usuarioModel = new Administracion_Model_DbTable_Usuario();
		$i = 0;
		$hoy = date("Y-m-d H:i:s");

		foreach ($infoexel as $fila) {
			$i++;

			if ($i > 1) {


				$user_state = $data['user_state'] = 1;
				$user_date = $data['user_date'] = date("Y-m-d");
				$user_names = $data['user_names'] = trim($fila[C]);
				$user_email = $data['user_email'] = "";
				$user_level = $data['user_level'] = 3;
				$user_user = $data['user_user'] = trim($fila[A]);
				$data['user_password'] = $data['user_user'];
				$user_password = password_hash($data['user_password'], PASSWORD_DEFAULT);
				$user_delete = $data['user_delete'] = 1;
				$user_current_user = $data['user_current_user'] = 1;
				$user_code = $data['user_code'] = 1;
				$user_negocio = $data['user_negocio'] = 0;
				$user_accion = $data['user_accion'] = "SABANA21";
				$user_telefono = $data['user_telefono'] = 0;
				$user_invitado_socio = $data['user_invitado_socio'] = 0;
				$user_envio_correo = $data['user_envio_correo'] = 0;
				$user_state_password = $data['user_state_password'] = 0;

				if (strpos($user_email, "@") === FALSE) {
					$user_email = $data['user_email'] = "";
				}


				$existe = $usuarioModel->getList(" user_user='$user_user' ", "");
				if (count($existe) == 0) {
					if ($data['user_user'] != "") {
						$id = $usuarioModel->insert($data);
					}
				} else {
					$socio1 = $existe[0];
					$id = $socio1->id;
					/*
															if($socio_estado!="" and $socio_estado!=$socio1->socio_estado){
																$sociosModel->editField($id,"socio_estado",$socio_estado);
															}
															*/

				}

			}


		}

	}

}