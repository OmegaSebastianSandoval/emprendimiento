<?php 

/**
*
*/

class Page_favoritosController extends Page_mainController
{
	public $botonpanel = 2;


	public function indexAction()
	{
		
		$this->_view->bannerprincipal = $this->template->bannerprincipal(5);
        $id_usuario=$_SESSION['kt_login_id'];

      

        $favoritosModel = new Administracion_Model_DbTable_Favoritos();
        $categoriasModel = new Administracion_Model_DbTable_Categorias();
        $tiendasModel = new Administracion_Model_DbTable_Tiendas();
        $productosModel = new Administracion_Model_DbTable_Productos();
	

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