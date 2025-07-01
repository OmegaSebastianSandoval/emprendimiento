<?php
/**
* Controlador de Tiendas que permite la  creacion, edicion  y eliminacion de los tiendas del Sistema
*/
class Administracion_tiendasController extends Administracion_mainController
{
	/**
	 * $mainModel  instancia del modelo de  base de datos tiendas
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
	protected $pages ;

	/**
	 * $namefilter nombre de la variable a la fual se le van a guardar los filtros
	 * @var string
	 */
	protected $namefilter;

	/**
	 * $_csrf_section  nombre de la variable general csrf  que se va a almacenar en la session
	 * @var string
	 */
	protected $_csrf_section = "administracion_tiendas";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
     * Inicializa las variables principales del controlador tiendas .
     *
     * @return void.
     */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Tiendas();
		$this->namefilter = "parametersfiltertiendas";
		$this->route = "/administracion/tiendas";
		$this->namepages ="pages_tiendas";
		$this->namepageactual ="page_actual_tiendas";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
     * Recibe la informacion y  muestra un listado de  tiendas con sus respectivos filtros.
     *
     * @return void.
     */
	public function indexAction()
	{
		$title = "Administración de tiendas";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters =(object)Session::getInstance()->get($this->namefilter);
        $this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "";
		$list = $this->mainModel->getList($filters,$order);
		$amount = $this->pages;
		$page = $this->_getSanitizedParam("page");
		if (!$page && Session::getInstance()->get($this->namepageactual)) {
		   	$page = Session::getInstance()->get($this->namepageactual);
		   	$start = ($page - 1) * $amount;
		} else if(!$page){
			$start = 0;
		   	$page=1;
			Session::getInstance()->set($this->namepageactual,$page);
		} else {
			Session::getInstance()->set($this->namepageactual,$page);
		   	$start = ($page - 1) * $amount;
		}
		$this->_view->register_number = count($list);
		$this->_view->pages = $this->pages;
		$this->_view->totalpages = ceil(count($list)/$amount);
		$this->_view->page = $page;
		$this->_view->lists = $this->mainModel->getListPages($filters,$order,$start,$amount);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->categoria = $this->_getSanitizedParam("categoria");
	}

	/**
     * Genera la Informacion necesaria para editar o crear un  tienda  y muestra su formulario
     *
     * @return void.
     */
	public function manageAction()
	{
		$userModel = new Administracion_Model_DbTable_Usuario();
		$categoriasModel = new Administracion_Model_DbTable_Categorias();
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_tiendas_".date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->categoria = $this->_getSanitizedParam("categoria");
		$id = $this->_getSanitizedParam("id");
		$estado_form="";
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			$usuario = $userModel->getList("user_negocio='$id'","")[0];
			if($content->tiendas_id){
				$this->_view->categorias= $categoriasModel->getList("","");
				$this->_view->content = $content;
				$this->_view->usuario = $usuario;
				$this->_view->routeform = $this->route."/update";
				$title = "Actualizar tienda";
				$estado_form=0;
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}else{
				$this->_view->routeform = $this->route."/insert";
				$title = "Crear tienda";
				$estado_form=1;
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route."/insert";
			$title = "Crear tienda";
			$estado_form=1;
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
		$this->_view->estado_form = $estado_form;
	}

	/**
     * Inserta la informacion de un tienda  y redirecciona al listado de tiendas.
     *
     * @return void.
     */
	public function insertAction(){
		$usuarioModel = new Administracion_Model_DbTable_Usuario();
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {	
			$data = $this->getData();
			$uploadImage =  new Core_Model_Upload_Image();
			if($_FILES['tiendas_imagen']['name'] != ''){
				$data['tiendas_imagen'] = $uploadImage->upload("tiendas_imagen");
			}
			$id = $this->mainModel->insert($data);
			$datauser = $this->getDatausernegocio($id);
			$usuarioModel->insert($datauser);
			$data['tiendas_id']= $id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'CREAR TIENDA';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		$categoria = $this->_getSanitizedParam("tiendas_categoria");
		header('Location: '.$this->route.'?categoria='.$categoria.'');
	}

	/**
     * Recibe un identificador  y Actualiza la informacion de un tienda  y redirecciona al listado de tiendas.
     *
     * @return void.
     */
	public function updateAction(){
	    	// $usuarioModel = new Administracion_Model_DbTable_Usuario();
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->tiendas_id) {
			    // $usuario=$usuarioModel->getList("user_negocio='$id'","")[0];
			    // $usuarioModel->editField($usuario->user_id,"user_state",$this->_getSanitizedParam("tiendas_estado"));
				$data = $this->getData();
				$uploadImage =  new Core_Model_Upload_Image();
				if($_FILES['tiendas_imagen']['name'] != ''){
					if($content->tiendas_imagen){
						$uploadImage->delete($content->tiendas_imagen);
					}
					$data['tiendas_imagen'] = $uploadImage->upload("tiendas_imagen");
				} else {
					$data['tiendas_imagen'] = $content->tiendas_imagen;
				}
				$this->mainModel->update($data,$id);
			}
			$data['tiendas_id']=$id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'EDITAR TIENDA';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);}
		$categoria = $this->_getSanitizedParam("tiendas_categoria");
		header('Location: '.$this->route.'?categoria='.$categoria.'');
	}

	/**
     * Recibe un identificador  y elimina un tienda  y redirecciona al listado de tiendas.
     *
     * @return void.
     */
	public function deleteAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_csrf_section] == $csrf ) {
			$id =  $this->_getSanitizedParam("id");
			if (isset($id) && $id > 0) {
				$content = $this->mainModel->getById($id);
				if (isset($content)) {
					$uploadImage =  new Core_Model_Upload_Image();
					if (isset($content->tiendas_imagen) && $content->tiendas_imagen != '') {
						$uploadImage->delete($content->tiendas_imagen);
					}
					$this->mainModel->deleteRegister($id);$data = (array)$content;
					$data['log_log'] = print_r($data,true);
					$data['log_tipo'] = 'BORRAR TIENDA';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data); }
			}
		}
		$categoria = $this->_getSanitizedParam("categoria");
		header('Location: '.$this->route.'?categoria='.$categoria.'');
	}

	/**
     * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Tiendas.
     *
     * @return array con toda la informacion recibida del formulario.
     */
	private function getData()
	{
		$data = array();
		$data['tiendas_nombre'] = $this->_getSanitizedParam("tiendas_nombre");
		$data['tiendas_descripcion'] = $this->_getSanitizedParamHtml("tiendas_descripcion");
		$data['tiendas_pagina'] = $this->enlacepagina($this->_getSanitizedParam("tiendas_pagina"));
		$data['tiendas_facebook'] = $this->enlaceredes($this->_getSanitizedParam("tiendas_facebook"));
		$data['tiendas_instagram'] = $this->enlaceredes($this->_getSanitizedParam("tiendas_instagram"));
		$data['tiendas_telefono'] = $this->_getSanitizedParam("tiendas_telefono");
		$data['tiendas_telefono2'] = $this->_getSanitizedParam("tiendas_telefono2");
		$data['tiendas_datos'] = $this->_getSanitizedParamHtml("tiendas_datos");
		$data['tiendas_whatsapp'] = $this->_getSanitizedParam("tiendas_whatsapp");
		$data['tiendas_imagen'] = "";
		$data['tiendas_categoria'] = $this->_getSanitizedParamHtml("tiendas_categoria");
		if($this->_getSanitizedParam("tiendas_estado") == '' ) {
			$data['tiendas_estado'] = '0';
		} else {
			$data['tiendas_estado'] = $this->_getSanitizedParam("tiendas_estado");
		}
		return $data;
	}
	private function getDatausernegocio($id)
	{
	
		$data = array();
		if($this->_getSanitizedParam("tiendas_estado") == '' ) {
			$data['tiendas_estado'] = '0';
		} else {
			$data['tiendas_estado'] = $this->_getSanitizedParam("tiendas_estado");
		}
		$data['user_date'] = date("Y-m-d");
		$data['user_names'] = $this->_getSanitizedParam("tiendas_nombre");
		$data['user_email'] = $this->_getSanitizedParam("correo");
		if($this->_getSanitizedParam("usuario_tipo") == '' ) {
			$data['user_level'] = '0';
		} else {
			$data['user_level'] = $this->_getSanitizedParam("usuario_tipo");
		}
		$data['user_user'] = $this->_getSanitizedParam("usuario_negocio");
		$data['user_password'] = $this->_getSanitizedParam("usuario_negocio");
		$data['user_delete'] = '1' ;
		$data['user_current_user'] = '1' ;
		$data['user_code'] = '1' ;
		$data['user_negocio'] = $id ;
		$data['user_accion'] = $this->numeroaccion($this->_getSanitizedParam("accion_negocio")); 
		$data['user_telefono'] = $this->_getSanitizedParam("tiendas_telefono");
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
		$categoria= $this->_getSanitizedParam("categoria");
		if($this->_getSanitizedParam("categoria")){
			$filtros = $filtros." AND tiendas_categoria = '$categoria' ";
		}
	
        if (Session::getInstance()->get($this->namefilter)!="") {
            $filters =(object)Session::getInstance()->get($this->namefilter);
            if ($filters->tiendas_nombre != '') {
                $filtros = $filtros." AND tiendas_nombre LIKE '%".$filters->tiendas_nombre."%'";
            }
            if ($filters->tiendas_whatsapp != '') {
                $filtros = $filtros." AND tiendas_whatsapp LIKE '%".$filters->tiendas_whatsapp."%'";
            }
            if ($filters->tiendas_imagen != '') {
                $filtros = $filtros." AND tiendas_imagen LIKE '%".$filters->tiendas_imagen."%'";
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
        if ($this->getRequest()->isPost()== true) {
        	Session::getInstance()->set($this->namepageactual,1);
            $parramsfilter = array();
					$parramsfilter['tiendas_nombre'] =  $this->_getSanitizedParam("tiendas_nombre");
					$parramsfilter['tiendas_whatsapp'] =  $this->_getSanitizedParam("tiendas_whatsapp");
					$parramsfilter['tiendas_imagen'] =  $this->_getSanitizedParam("tiendas_imagen");Session::getInstance()->set($this->namefilter, $parramsfilter);
        }
        if ($this->_getSanitizedParam("cleanfilter") == 1) {
            Session::getInstance()->set($this->namefilter, '');
            Session::getInstance()->set($this->namepageactual,1);
        }
	}
	public function enlaceredes($x){
		$x = str_replace("@","",$x);
		$x=str_replace("https://www.instagram.com","",$x);
		$x=str_replace("https://es-la.facebook.com","",$x);
		$x=str_replace("/","",$x);
		$x=str_replace("https:m.","",$x);
		$x=str_replace("https:www.","",$x);
		$x=str_replace("www.","",$x);
		return $x;
	}
	public function enlacepagina($x){
		$x=str_replace("https://","",$x);
		$x=str_replace("http://","",$x);
		return $x;
	}
	public function numeroaccion($x){
		$x=str_pad($x, 8, "0", STR_PAD_LEFT);
		return $x;
	}
}