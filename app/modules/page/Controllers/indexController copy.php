<?php 

/**
*
*/

class Page_indexController extends Page_mainController
{

	public function indexAction()
	{

		$this->_view->bannerprincipal = $this->template->bannerprincipal(1);
		$publicidadModel = new Administracion_Model_DbTable_Publicidad();
		$popup=$publicidadModel->getList("publicidad_seccion=6","")[0];

		$catgoria = $this->_getSanitizedParam('categoria');
		$subcategoria = $this->_getSanitizedParam('subcategoria');
		$buscar = $this->_getSanitizedParam('buscar');
		if ($catgoria != "") {
			$this->_view->productos = $this->template->getProductosf($catgoria,$subcategoria);
		}elseif ($catgoria == "") {
			$this->_view->productos = $this->template->getProductos($buscar);
		}

		$categoriasModel = new Administracion_Model_DbTable_Categorias();
		$this->_view->categorias = $categorias = $categoriasModel->getList(" categorias_padre='0' AND categorias_estado='1' AND categorias_estado_imagen='1'","orden_categorias ASC LIMIT 9 ");
		foreach ($categorias as $key => $value) {
			$padre = $value->categorias_id;
			$hijos = $categoriasModel->getList(" categorias_padre='$padre' "," orden ASC ");
			$value->hijos = $hijos;
		}
		$this->_view->categorias = $categorias;
		$this->_view->popup = $popup;

		header("Location:/page/index/index2");

	}


	public function index2Action()
	{
// $asociado = $this->getAsociado();
		$this->_view->bannerprincipal = $this->template->bannerprincipal(1);
		$publicidadModel = new Administracion_Model_DbTable_Publicidad();
		$popup=$publicidadModel->getList("publicidad_seccion=6","")[0];

		$catgoria = $this->_getSanitizedParam('categoria');
		$subcategoria = $this->_getSanitizedParam('subcategoria');
		$buscar = $this->_getSanitizedParam('buscar');
		if ($catgoria != "") {
			$this->_view->productos = $this->template->getProductosf($catgoria,$subcategoria);
		}elseif ($catgoria == "") {
			$this->_view->productos = $this->template->getProductos($buscar);
		}

		$categoriasModel = new Administracion_Model_DbTable_Categorias();
		$this->_view->categorias = $categorias = $categoriasModel->getList(" categorias_padre='0' AND categorias_estado='1' AND categorias_estado_imagen='1'"," orden_categorias ASC LIMIT 9 ");

		$this->_view->categorias2 = $categorias2 = $categoriasModel->getList(" categorias_padre='0' AND categorias_estado='1' AND categorias_estado_imagen='1'"," categorias_nombre ASC ");

		foreach ($categorias as $key => $value) {
			$padre = $value->categorias_id;
			$hijos = $categoriasModel->getList(" categorias_padre='$padre' "," orden ASC ");
			$value->hijos = $hijos;
		}

		foreach ($categorias2 as $key => $value) {
			$padre = $value->categorias_id;
			$hijos = $categoriasModel->getList(" categorias_padre='$padre' "," orden ASC ");
			$value->hijos = $hijos;
		}

		$this->_view->categorias = $categorias;
		$this->_view->categorias2 = $categorias2;
		$this->_view->popup = $popup;

		$productosModel = new Administracion_Model_DbTable_Productos();
		$tiendasModel = new Administracion_Model_DbTable_Tiendas();
		$categoriasModel = new Administracion_Model_DbTable_Categorias();
		$this->_view->tiendas = $tiendas =  $tiendasModel->getList(" tiendas_estado='1' "," rand() LIMIT 9 ");
		foreach ($tiendas as $key => $value) {
			$tienda_id = $value->tiendas_id;
			$value->productos = $productosModel->getList(" productos_tienda='$tienda_id' ","");
			$id = $value->tiendas_categoria;
			$value->categoria = $categoriasModel->getById($id);
		}
		$this->_view->tiendas = $tiendas;

	}

	public function seleccionarAction()
	{
		$contenidoModel = new Page_Model_DbTable_Contenido();
		$this->_view->carta = $contenidoModel->getList("contenido_seccion = '13' AND contenido_estado='1' ", "orden ASC");
	}


	public function enviarbackupAction(){

		$this->setLayout("blanco");
		$hoy = date("Y-m-d");
        $emailModel = new Core_Model_Mail();
        $asunto = "Backup nux ".$hoy;

		$content = "Backup nux ".$hoy;

        $emailModel->getMail()->addBCC("soporteomega@omegawebsystems.com");
        $emailModel->getMail()->addAddress("glozano@clubelnogal.com");

        $archivo = "nuxclube_bd.sql.zip";
		$emailModel->getMail()->AddAttachment($_SERVER['DOCUMENT_ROOT']."/backups/".$archivo, "".$archivo);

        $emailModel->getMail()->Subject = $asunto;
        $emailModel->getMail()->msgHTML($content);
        $emailModel->getMail()->AltBody = $content;
        $emailModel->getMail()->SMTPDebug = 0;
        $emailModel->sed();
        echo $emailModel->getMail()->ErrorInfo;

        header("HTTP/1.1 200 OK");
	}

}