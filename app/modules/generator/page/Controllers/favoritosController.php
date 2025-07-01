<?php 

/**
*
*/

class Page_favoritosController extends Page_mainController
{

	public function indexAction()
	{
		
		$this->_view->bannerprincipal = $this->template->bannerprincipal(5);

		// $catgoria = $this->_getSanitizedParam('categoria');
        $id = $this->_getSanitizedParam('id');
        $id_usuario=$_SESSION['kt_login_id'];
		// $subcategoria = $this->_getSanitizedParam('subcategoria');
		// $buscar = $this->_getSanitizedParam('buscar');
		// if ($catgoria != "") {
		// 	$this->_view->productos = $this->template->getProductosf($catgoria,$subcategoria);
		// }elseif ($catgoria == "") {
		// 	$this->_view->productos = $this->template->getProductos($buscar);
		// }

        $favoritosModel = new Administracion_Model_DbTable_Favoritos();
        $categoriasModel = new Administracion_Model_DbTable_Categorias();
        $tiendasModel = new Administracion_Model_DbTable_Tiendas();
        $productosModel = new Administracion_Model_DbTable_Productos();
	
		// $this->_view->categorias = $categorias = $categoriasModel->getList(" categorias_padre='0' "," orden ASC ");
		// foreach ($categorias as $key => $value) {
		// 	$padre = $value->categorias_id;
		// 	$hijos = $categoriasModel->getList(" categorias_padre='$padre' "," orden ASC ");
		// 	$value->hijos = $hijos;
		// }
		// $this->_view->categorias = $categorias;

        $this->_view->favoritos = $favoritosModel->getList("favoritos_usuario='$id_usuario'","");
        $this->_view->categorias = $categoriasModel->getList("","");
        $this->_view->tiendas = $tiendasModel->getList("","");
        $this->_view->productos = $productosModel->getList("","");


	}

	public function seleccionarAction()
	{
		$contenidoModel = new Page_Model_DbTable_Contenido();
		$this->_view->carta = $contenidoModel->getList("contenido_seccion = '13' AND contenido_estado='1' ", "orden ASC");
	}

}