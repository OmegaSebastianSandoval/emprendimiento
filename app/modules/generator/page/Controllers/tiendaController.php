<?php 

/**
*
*/

class Page_tiendaController extends Page_mainController
{

	public function indexAction()
	{
		
		$this->_view->bannerprincipal = $this->template->bannerprincipal(5);

	    $categoria = $this->_getSanitizedParam('categoria');
		$id = $this->_getSanitizedParam('id');
		$usuario=$_SESSION["kt_login_id"];
		$this->_view->tienda_id=$id;
		$favoritosModel = new Administracion_Model_DbTable_Favoritos();
		$this->_view->favoritos = $favoritosModel->getList("favoritos_tienda='$id' AND favoritos_usuario='$usuario'","");
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
		$this->_view->categorias= $categoriasModel->getById($categoria);
		$this->_view->tienda= $tiendasModel->getById($id);
		$this->_view->productos = $productosModel->getList("productos_tienda='$id'","");

	}

	public function seleccionarAction()
	{
		$contenidoModel = new Page_Model_DbTable_Contenido();
		$this->_view->carta = $contenidoModel->getList("contenido_seccion = '13' AND contenido_estado='1' ", "orden ASC");
	}
	public function cambiarestadoAction(){
		$estado = $this->_getSanitizedParam('estado');
		$tienda = $this->_getSanitizedParam('tienda');
		$usuario = $this->_getSanitizedParam('usuario');
		$favoritosModel = new Administracion_Model_DbTable_Favoritos();

		if($estado==0){
			$data['favoritos_usuario']=$usuario;
			$data['favoritos_tienda']=$tienda;
			$favoritosModel->insert($data);
		}else{
			$favoritosModel->borrar($usuario,$tienda);
		}

	}
	public function enlaceredes($x){
		$x = str_replace("@","",$x);
		$x=str_replace("https://www.instagram.com","",$x);
		$x=str_replace("https://es-la.facebook.com","",$x);
		$x=str_replace("/","",$x);
		return $x;
	}
	public function enlacepagina($x){
		$x=str_replace("https://","",$x);
		$x=str_replace("http://","",$x);
		return $x;
	}
}