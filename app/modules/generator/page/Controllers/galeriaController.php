<?php 

/**
*
*/

class Page_galeriaController extends Page_mainController
{

	public function indexAction()
	{

		$galeriaModel = new Administracion_Model_DbTable_Galeria();
	
		// $this->_view->categorias = $categorias = $categoriasModel->getList(" categorias_padre='0' "," orden ASC ");
		// foreach ($categorias as $key => $value) {
		// 	$padre = $value->categorias_id;
		// 	$hijos = $categoriasModel->getList(" categorias_padre='$padre' "," orden ASC ");
		// 	$value->hijos = $hijos;
		// }
		// $this->_view->categorias = $categorias;
		$this->_view->galeria = $galeriaModel->getList("","");

	}

	public function seleccionarAction()
	{
		$contenidoModel = new Page_Model_DbTable_Contenido();
		$this->_view->carta = $contenidoModel->getList("contenido_seccion = '13' AND contenido_estado='1' ", "orden ASC");
	}

}