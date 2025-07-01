<?php 

/**
*
*/

class Page_productosController extends Page_mainController
{

	public function indexAction()
	{
		$this->_view->bannerprincipal = $this->template->bannerprincipal(1);
		$productosModel = new Page_Model_DbTable_Productos();
		//$this->_view->informacion = $informacionModel->getList("","orden ASC")[0];

		$categoria = $this->_getSanitizedParam("categoria");

		if ($categoria) {
			$filters = "productos_categorias = $categoria";
			$order = "orden ASC";
			$list = $productosModel->getList($filters,$order);
			$amount = 12;
			$page = $this->_getSanitizedParam("page");
			if (!$page) {
			   	$start = 0;
			   	$page=1;
			}
			else {
			   	$start = ($page - 1) * $amount;
			}
			$this->_view->totalpages = ceil(count($list)/$amount);
			$this->_view->page = $page;
			$this->_view->productos = $productosModel->getListPages($filters,$order,$start,$amount);
		} else {
			$filters = "";
			$order = "orden ASC";
			$list = $productosModel->getList($filters,$order);
			$amount = 12;
			$page = $this->_getSanitizedParam("page");
			if (!$page) {
			   	$start = 0;
			   	$page=1;
			}
			else {
			   	$start = ($page - 1) * $amount;
			}
			$this->_view->totalpages = ceil(count($list)/$amount);
			$this->_view->page = $page;
			$this->_view->productos = $productosModel->getListPages($filters,$order,$start,$amount);
		}
           $this->_view->lateral = $lateral;
    }
	public function detalleAction(){
		$lateral = $this->_view->getRoutPHP('modules/page/Views/partials/lateral.php');
		$this->_view->lateral = $lateral;
		$categoria = $this->_getSanitizedParam("categoria");
		$productosModel = new Page_Model_DbTable_Productos();
		$informacionModel = new Page_Model_DbTable_Informacion();
		$this->_view->informacion = $informacionModel->getList("","orden ASC")[0];
		$id = $this->_getSanitizedParam("id");
		$categoria = $this->_getSanitizedParam("categoria");
		$this->_view->producto = $producto = $productosModel->getById($id);

		if($producto->productos_cantidad*1==0){
			header("Location:/page/");
		}

		$categoria = $producto->productos_categorias;
		$subcategoria = $producto->productos_subcategoria;
		$this->_view->productosrelacionados = $this->_view->productos = $this->template->getRelacionados($categoria,$subcategoria,$id);

		$categoriaModel = new Page_Model_DbTable_Categorias();
		$this->_view->categoria = $categoriaModel->getById($producto->productos_categorias);
		$this->_view->subcategoria = $categoriaModel->getById($producto->productos_subcategoria);
	}
	public function destacadosAction(){
		$this->_view->bannerprincipal = $this->template->bannerprincipal(1);
		$lateral = $this->_view->getRoutPHP('modules/page/Views/partials/lateral.php');
		$this->_view->lateral = $lateral;
		$categoria = $this->_getSanitizedParam("categoria");
		$productosModel = new Page_Model_DbTable_Productos();
		$informacionModel = new Page_Model_DbTable_Informacion();
		$this->_view->informacion = $informacionModel->getList("","orden ASC")[0];
		$filters = "productos_destacado = 1";
			$order = "orden ASC";
			$list = $productosModel->getList($filters,$order);
			$amount = 12;
			$page = $this->_getSanitizedParam("page");
			if (!$page) {
			   	$start = 0;
			   	$page=1;
			}
			else {
			   	$start = ($page - 1) * $amount;
			}
			$this->_view->totalpages = ceil(count($list)/$amount);
			$this->_view->page = $page;
			$this->_view->productos = $productosModel->getListPages($filters,$order,$start,$amount);
	}

}