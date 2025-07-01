<?php 

/**
*
*/

class Page_categoriaController extends Page_mainController
{

	public function indexAction()
	{
		
		$this->_view->bannerprincipal = $this->template->bannerprincipal(5);

		// $catgoria = $this->_getSanitizedParam('categoria');
		$id = $this->_getSanitizedParam('id');
		// $subcategoria = $this->_getSanitizedParam('subcategoria');
		// $buscar = $this->_getSanitizedParam('buscar');
		// if ($catgoria != "") {
		// 	$this->_view->productos = $this->template->getProductosf($catgoria,$subcategoria);
		// }elseif ($catgoria == "") {
		// 	$this->_view->productos = $this->template->getProductos($buscar);
		// }

		$categoriasModel = new Administracion_Model_DbTable_Categorias();
		$productosModel = new Administracion_Model_DbTable_Productos();
		$tiendasModel = new Administracion_Model_DbTable_Tiendas();
		// $this->_view->categorias = $categorias = $categoriasModel->getList(" categorias_padre='0' "," orden ASC ");
		// foreach ($categorias as $key => $value) {
		// 	$padre = $value->categorias_id;
		// 	$hijos = $categoriasModel->getList(" categorias_padre='$padre' "," orden ASC ");
		// 	$value->hijos = $hijos;
		// }
		// $this->_view->categorias = $categorias;
		$this->_view->categoria = $categoriasModel->getById($id);
		$this->_view->tiendas = $tiendasModel->getList("tiendas_categoria='$id' AND tiendas_estado=1","");
		$this->_view->productos = $productosModel->getList("","");

	}

	public function seleccionarAction()
	{
		$contenidoModel = new Page_Model_DbTable_Contenido();
		$this->_view->carta = $contenidoModel->getList("contenido_seccion = '13' AND contenido_estado='1' ", "orden ASC");
	}

}