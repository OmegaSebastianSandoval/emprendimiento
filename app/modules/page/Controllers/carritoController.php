<?php 

/**
*
*/

class Page_carritoController extends Page_mainController
{

	public function indexAction()
	{
		$this->setLayout("blanco");
		$productoModel =  new Administracion_Model_DbTable_Productos();
		$carrito = $this->getCarrito();
		$data = [];
		foreach ($carrito as $id => $cantidad) {
			$data[$id] = [];
			$data[$id]['detalle'] = $productoModel->getById($id);
			$data[$id]['cantidad'] = $cantidad;
		}
		$this->_view->carrito = $data;
	}

	public function getCarrito(){
		if(Session::getInstance()->get("carrito")){
			return Session::getInstance()->get("carrito");
		} else {
			return [];
		}
	}

	public function additemAction(){
		$this->setLayout("blanco");
		$id = $this->_getSanitizedParam("producto");
		$cantidad =  $this->_getSanitizedParam("cantidad");
		$carrito = $this->getCarrito();
		if($carrito[$id]){
			//echo "entro";
			$carrito[$id] = $carrito[$id]+$cantidad;
		} else {
			$carrito[$id] = $cantidad;
		}
		Session::getInstance()->set("carrito",$carrito);


		//log carrito
		$array['id']=$id;
		$array['cantidad']=$cantidad;
		$array['carrito']=$carrito;
		$logcarritoModel = new Administracion_Model_DbTable_Logcarrito();
		$data['log_cedula'] = $_SESSION['kt_cedula'];
		$data['log_detalle'] = "Agregar al carrito";
		$data['log_log'] = print_r($array,true);
		$data['log_fecha'] = date("Y-m-d H:i:s");
		$logcarritoModel->insert($data);

	}

	public function deleteitemAction(){
		$this->setLayout("blanco");
		$id = $this->_getSanitizedParam("producto");
		$carrito = $this->getCarrito();
		if($carrito[$id]){
			unset($carrito[$id]);
		}
		Session::getInstance()->set("carrito",$carrito);

		//log carrito
		$array['id']=$id;
		$array['carrito']=$carrito;
		$logcarritoModel = new Administracion_Model_DbTable_Logcarrito();
		$data['log_cedula'] = $_SESSION['kt_cedula'];
		$data['log_detalle'] = "Borrar del carrito";
		$data['log_log'] = print_r($array,true);
		$data['log_fecha'] = date("Y-m-d H:i:s");
		$logcarritoModel->insert($data);

	}

	public function changecantidadAction(){
		$this->setLayout("blanco");
		$id = $this->_getSanitizedParam("producto");
		$cantidad =  $this->_getSanitizedParam("cantidad");
		$carrito = $this->getCarrito();
		if($carrito[$id]){
			$carrito[$id] = $cantidad;
		}
		Session::getInstance()->set("carrito",$carrito);

		//log carrito
		$array['id']=$id;
		$array['cantidad']=$cantidad;
		$array['carrito']=$carrito;
		$logcarritoModel = new Administracion_Model_DbTable_Logcarrito();
		$data['log_cedula'] = $_SESSION['kt_cedula'];
		$data['log_detalle'] = "Cambiar cantidad carrito";
		$data['log_log'] = print_r($array,true);
		$data['log_fecha'] = date("Y-m-d H:i:s");
		$logcarritoModel->insert($data);

	}

}