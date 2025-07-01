<?php 

/**
*
*/

class Page_galeriaController extends Page_mainController
{

	public function indexAction()
	{

		$cuadrosModel = new Administracion_Model_DbTable_Cuadros();
		$tiendasModel = new Administracion_Model_DbTable_Tiendas();
	
		// $this->_view->categorias = $categorias = $categoriasModel->getList(" categorias_padre='0' "," orden ASC ");
		// foreach ($categorias as $key => $value) {
		// 	$padre = $value->categorias_id;
		// 	$hijos = $categoriasModel->getList(" categorias_padre='$padre' "," orden ASC ");
		// 	$value->hijos = $hijos;
		// }
		// $this->_view->categorias = $categorias;
		$id= $this->_getSanitizedParam('id');
		$this->_view->tienda= $tiendasModel->getById($id);
		$this->_view->cuadros = $cuadrosModel->getList("cuadros_activo=1 AND cuadros_negocio='$id'","");

	}

	public function seleccionarAction()
	{
		$contenidoModel = new Page_Model_DbTable_Contenido();
		$this->_view->carta = $contenidoModel->getList("contenido_seccion = '13' AND contenido_estado='1' ", "orden ASC");
	}

}