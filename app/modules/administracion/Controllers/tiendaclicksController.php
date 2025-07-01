<?php
/**
* Controlador de Tiendaclicks que permite la  creacion, edicion  y eliminacion de los Tienda Clicks del Sistema
*/
class Administracion_tiendaclicksController extends Administracion_mainController
{
	/**
	 * $mainModel  instancia del modelo de  base de datos Tienda Clicks
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
	protected $_csrf_section = "administracion_tiendaclicks";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
     * Inicializa las variables principales del controlador tiendaclicks .
     *
     * @return void.
     */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Tiendaclicks();
		$this->namefilter = "parametersfiltertiendaclicks";
		$this->route = "/administracion/tiendaclicks";
		$this->namepages ="pages_tiendaclicks";
		$this->namepageactual ="page_actual_tiendaclicks";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
     * Recibe la informacion y  muestra un listado de  Tienda Clicks con sus respectivos filtros.
     *
     * @return void.
     */
	public function indexAction()
	{
		$title = "Reporte de tiendas";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->filters();
		$this->_view->list_tiendas = $this->getTiendas();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters =(object)Session::getInstance()->get($this->namefilter);
        $this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "";
		$group = "id_tienda";
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
	
		$this->_view->pages = $this->pages;
	
		$this->_view->page = $page;
		$this->_view->lists = $list2=$this->mainModel->getListPagesClicks($filters,$order,$start,$amount,$group);
		$list3=$this->mainModel->getListClicks($filters,$order,$group);
		$this->_view->totalpages =$h= ceil(count($list3)/$amount);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->register_number = count($list2);
	}

	/**
     * Genera la Informacion necesaria para editar o crear un  Clicks  y muestra su formulario
     *
     * @return void.
     */
	public function manageAction()
	{

		$this->_csrf_section = "manage_tiendaclicks_".date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$filters = $this->getFilter();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$id = $this->_getSanitizedParam("id");
		$this->_view->route2 = "/administracion/tiendaclicks/manage?id=$id";
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
		$this->_view->pages = $this->pages;
	
		$this->_view->page = $page;
		$this->_view->lists = $this->mainModel->getListPages2($filters.' AND tienda_clicks.id_tienda='.$id.'',"",$start,$amount);
		$lists = $this->mainModel->getList2($filters. ' AND tienda_clicks.id_tienda='.$id.'',"");
		$this->_view->totalpages = ceil(count($lists)/$amount);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->register_number2 = count($lists);

	}

	/**
     * Inserta la informacion de un Clicks  y redirecciona al listado de Tienda Clicks.
     *
     * @return void.
     */
	public function insertAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {	
			$data = $this->getData();
			$id = $this->mainModel->insert($data);
			
			$data['id']= $id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'CREAR CLICKS';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y Actualiza la informacion de un Clicks  y redirecciona al listado de Tienda Clicks.
     *
     * @return void.
     */
	public function updateAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->id) {
				$data = $this->getData();
					$this->mainModel->update($data,$id);
			}
			$data['id']=$id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'EDITAR CLICKS';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y elimina un Clicks  y redirecciona al listado de Tienda Clicks.
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
					$this->mainModel->deleteRegister($id);$data = (array)$content;
					$data['log_log'] = print_r($data,true);
					$data['log_tipo'] = 'BORRAR CLICKS';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data); }
			}
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Tiendaclicks.
     *
     * @return array con toda la informacion recibida del formulario.
     */
	private function getData()
	{
		$data = array();
		if($this->_getSanitizedParam("id_tienda") == '' ) {
			$data['id_tienda'] = '0';
		} else {
			$data['id_tienda'] = $this->_getSanitizedParam("id_tienda");
		}
		$data['usuario'] = $this->_getSanitizedParam("usuario");
		$data['fecha'] = $this->_getSanitizedParam("fecha");
		return $data;
	}
	/**
     * Genera la consulta con los filtros de este controlador.
     *
     * @return array cadena con los filtros que se van a asignar a la base de datos
     */
	private function getTiendas()
    {
        $modelData = new Administracion_Model_DbTable_Tiendas();
        $data = $modelData->getList();
        $array = array();
        foreach ($data as $key => $value) {
            $array[$value->tiendas_id] = $value->tiendas_nombre;
        }
        return $array;
	}
	public function exportarAction(){

		$filters = $this->getFilter();
		$id = $this->_getSanitizedParam("id");
		$nombre = $this->_getSanitizedParam("nombre");
		$list = $this->mainModel->getList2($filters. 'AND tienda_clicks.id_tienda='.$id.'',"");
		$this->_view->tiendas = $list;

		$this->setLayout('blanco');
		$hoy = date("YmdHis");
		$excel = $this->_getSanitizedParam("excel");
	
		if($excel==1){
	
			header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
			header("Content-type:   application/x-msexcel; charset=utf-8");
			header("Content-Disposition: attachment; filename=negocio_".$nombre."_".$hoy.".xls");
		
		
		}

	}
    protected function getFilter()
    {
    	$filtros = " 1 = 1 ";
        if (Session::getInstance()->get($this->namefilter)!="") {
            $filters =(object)Session::getInstance()->get($this->namefilter);
            if ($filters->id_tienda != '') {
                $filtros = $filtros." AND tiendas.tiendas_nombre LIKE '%".$filters->id_tienda."%'";
            }
            if ($filters->usuario != '') {
                $filtros = $filtros." AND usuario LIKE '%".$filters->usuario."%'";
            }
            if ($filters->fecha1 != '' & $filters->fecha2 != '') {
                $filtros = $filtros." AND fecha BETWEEN '$filters->fecha1' AND '$filters->fecha2'";
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
					$parramsfilter['id_tienda'] =  $this->_getSanitizedParam("id_tienda");
					$parramsfilter['usuario'] =  $this->_getSanitizedParam("usuario");
					$parramsfilter['fecha1'] =  $this->_getSanitizedParam("fecha1");
					$parramsfilter['fecha2'] =  $this->_getSanitizedParam("fecha2");
					Session::getInstance()->set($this->namefilter, $parramsfilter);
        }
        if ($this->_getSanitizedParam("cleanfilter") == 1) {
            Session::getInstance()->set($this->namefilter, '');
            Session::getInstance()->set($this->namepageactual,1);
        }
	}
	
}