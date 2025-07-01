<?php
/**
* Controlador de Cuadros que permite la  creacion, edicion  y eliminacion de los cuadros del Sistema
*/
class Administracion_cuadrosController extends Administracion_mainController
{
	/**
	 * $mainModel  instancia del modelo de  base de datos cuadros
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
	protected $_csrf_section = "administracion_cuadros";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
     * Inicializa las variables principales del controlador cuadros .
     *
     * @return void.
     */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Cuadros();
		$this->namefilter = "parametersfiltercuadros";
		$this->route = "/administracion/cuadros";
		$this->namepages ="pages_cuadros";
		$this->namepageactual ="page_actual_cuadros";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
     * Recibe la informacion y  muestra un listado de  cuadros con sus respectivos filtros.
     *
     * @return void.
     */
	public function indexAction()
	{
		$title = "Administración de cuadros";
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
		$this->_view->tienda = $this->_getSanitizedParam("tienda");
	}

	/**
     * Genera la Informacion necesaria para editar o crear un  cuadro  y muestra su formulario
     *
     * @return void.
     */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_cuadros_".date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->tienda = $this->_getSanitizedParam("tienda");
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if($content->cuadros_id){
				$this->_view->content = $content;
				$this->_view->routeform = $this->route."/update";
				$title = "Actualizar cuadro";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}else{
				$this->_view->routeform = $this->route."/insert";
				$title = "Crear cuadro";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route."/insert";
			$title = "Crear cuadro";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
     * Inserta la informacion de un cuadro  y redirecciona al listado de cuadros.
     *
     * @return void.
     */
	public function insertAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {	
			$data = $this->getData();
			$uploadImage =  new Core_Model_Upload_Image();
			if($_FILES['cuadros_imagen']['name'] != ''){
				$data['cuadros_imagen'] = $uploadImage->upload("cuadros_imagen");
			}
			$id = $this->mainModel->insert($data);
			
			$data['cuadros_id']= $id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'CREAR CUADRO';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		$tienda = $this->_getSanitizedParam("cuadros_negocio");
		header('Location: '.$this->route.'?tienda='.$tienda.'');
	}

	/**
     * Recibe un identificador  y Actualiza la informacion de un cuadro  y redirecciona al listado de cuadros.
     *
     * @return void.
     */
	public function updateAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->cuadros_id) {
				$data = $this->getData();
				$uploadImage =  new Core_Model_Upload_Image();
				if($_FILES['cuadros_imagen']['name'] != ''){
					if($content->cuadros_imagen){
						$uploadImage->delete($content->cuadros_imagen);
					}
					$data['cuadros_imagen'] = $uploadImage->upload("cuadros_imagen");
				} else {
					$data['cuadros_imagen'] = $content->cuadros_imagen;
				}
				$this->mainModel->update($data,$id);
			}
			$data['cuadros_id']=$id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'EDITAR CUADRO';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);}
		$tienda = $this->_getSanitizedParam("cuadros_negocio");
		header('Location: '.$this->route.'?tienda='.$tienda.'');
	}

	/**
     * Recibe un identificador  y elimina un cuadro  y redirecciona al listado de cuadros.
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
					if (isset($content->cuadros_imagen) && $content->cuadros_imagen != '') {
						$uploadImage->delete($content->cuadros_imagen);
					}
					$this->mainModel->deleteRegister($id);$data = (array)$content;
					$data['log_log'] = print_r($data,true);
					$data['log_tipo'] = 'BORRAR CUADRO';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data); }
			}
		}
		$tienda = $this->_getSanitizedParam("tienda");
		header('Location: '.$this->route.'?tienda='.$tienda.'');
	}

	/**
     * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Cuadros.
     *
     * @return array con toda la informacion recibida del formulario.
     */
	private function getData()
	{
		$data = array();
		$data['cuadros_titulo'] = $this->_getSanitizedParam("cuadros_titulo");
		$data['cuadros_descripcion'] = $this->_getSanitizedParamHtml("cuadros_descripcion");
		$data['cuadros_imagen'] = "";
		if($this->_getSanitizedParam("cuadros_precio") == '' ) {
			$data['cuadros_precio'] = '0';
		} else {
			$data['cuadros_precio'] = $this->_getSanitizedParam("cuadros_precio");
		}
		$data['cuadros_contacto'] = $this->_getSanitizedParam("cuadros_contacto");
		$data['cuadros_artista'] = $this->_getSanitizedParam("cuadros_artista");
		if($this->_getSanitizedParam("cuadros_activo") == '' ) {
			$data['cuadros_activo'] = '0';
		} else {
			$data['cuadros_activo'] = $this->_getSanitizedParam("cuadros_activo");
		}
		$data['cuadros_negocio'] = $this->_getSanitizedParamHtml("cuadros_negocio");
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
		$tienda= $this->_getSanitizedParam("tienda");
		$filtros = $filtros." AND cuadros_negocio = '$tienda' ";
        if (Session::getInstance()->get($this->namefilter)!="") {
            $filters =(object)Session::getInstance()->get($this->namefilter);
            if ($filters->cuadros_titulo != '') {
                $filtros = $filtros." AND cuadros_titulo LIKE '%".$filters->cuadros_titulo."%'";
            }
            if ($filters->cuadros_imagen != '') {
                $filtros = $filtros." AND cuadros_imagen LIKE '%".$filters->cuadros_imagen."%'";
            }
            if ($filters->cuadros_precio != '') {
                $filtros = $filtros." AND cuadros_precio LIKE '%".$filters->cuadros_precio."%'";
            }
            if ($filters->cuadros_contacto != '') {
                $filtros = $filtros." AND cuadros_contacto LIKE '%".$filters->cuadros_contacto."%'";
            }
            if ($filters->cuadros_activo != '') {
                $filtros = $filtros." AND cuadros_activo LIKE '%".$filters->cuadros_activo."%'";
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
					$parramsfilter['cuadros_titulo'] =  $this->_getSanitizedParam("cuadros_titulo");
					$parramsfilter['cuadros_imagen'] =  $this->_getSanitizedParam("cuadros_imagen");
					$parramsfilter['cuadros_precio'] =  $this->_getSanitizedParam("cuadros_precio");
					$parramsfilter['cuadros_contacto'] =  $this->_getSanitizedParam("cuadros_contacto");
					$parramsfilter['cuadros_activo'] =  $this->_getSanitizedParam("cuadros_activo");Session::getInstance()->set($this->namefilter, $parramsfilter);
        }
        if ($this->_getSanitizedParam("cleanfilter") == 1) {
            Session::getInstance()->set($this->namefilter, '');
            Session::getInstance()->set($this->namepageactual,1);
        }
    }
}