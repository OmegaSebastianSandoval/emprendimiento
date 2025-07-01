<?php
/**
* Controlador de Categorias que permite la  creacion, edicion  y eliminacion de los Categorias del Sistema
*/
class Administracion_listadoimagenproductosController extends Administracion_mainController
{
	/**
	 * $mainModel  instancia del modelo de  base de datos Categorias
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
	protected $_csrf_section = "administracion_categorias";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
     * Inicializa las variables principales del controlador categorias .
     *
     * @return void.
     */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Productos();
		$this->namefilter = "parametersfilterlistadoimagenproductos";
		$this->route = "/administracion/listadoimagenproductos";
		$this->namepages ="pages_listadoimagenes";
		$this->namepageactual ="page_actual_listadoimagenes";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
     * Recibe la informacion y  muestra un listado de  Categorias con sus respectivos filtros.
     *
     * @return void.
     */
	public function indexAction()
	{
		$title = "Listado de imagenes productos";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters =(object)Session::getInstance()->get($this->namefilter);
        $this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "";
		$lists = 
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
		// $this->_view->register_number = count($lists);
		$this->_view->pages = $this->pages;

		$this->_view->page = $page;
		$this->_view->lists = $this->mainModel->getList($filters,$order);
		$this->_view->csrf_section = $this->_csrf_section;
	}

	/**
     * Genera la Informacion necesaria para editar o crear un  Categoria  y muestra su formulario
     *
     * @return void.
     */


	/**
     * Inserta la informacion de un Categoria  y redirecciona al listado de Categorias.
     *
     * @return void.
     */
	

	/**
     * Recibe un identificador  y Actualiza la informacion de un Categoria  y redirecciona al listado de Categorias.
     *
     * @return void.
     */


	/**
     * Recibe un identificador  y elimina un Categoria  y redirecciona al listado de Categorias.
     *
     * @return void.
     */


	/**
     * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Categorias.
     *
     * @return array con toda la informacion recibida del formulario.
     */

	/**
     * Genera la consulta con los filtros de este controlador.
     *
     * @return array cadena con los filtros que se van a asignar a la base de datos
     */
    protected function getFilter()
    {
    	$filtros = " 1 = 1";


        if (Session::getInstance()->get($this->namefilter)!="") {
            $filters =(object)Session::getInstance()->get($this->namefilter);
            if ($filters->categorias_nombre != '') {
                $filtros = $filtros." AND categorias_nombre LIKE '%".$filters->categorias_nombre."%'";
            }
            if ($filters->categorias_descripcion != '') {
                $filtros = $filtros." AND categorias_descripcion LIKE '%".$filters->categorias_descripcion."%'";
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
					$parramsfilter['categorias_nombre'] =  $this->_getSanitizedParam("categorias_nombre");
					$parramsfilter['categorias_descripcion'] =  $this->_getSanitizedParam("categorias_descripcion");Session::getInstance()->set($this->namefilter, $parramsfilter);
        }
        if ($this->_getSanitizedParam("cleanfilter") == 1) {
            Session::getInstance()->set($this->namefilter, '');
            Session::getInstance()->set($this->namepageactual,1);
        }
    }
}