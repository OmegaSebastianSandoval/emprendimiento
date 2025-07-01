<?php

/**
*
*/

class Page_compraController extends Page_mainController
{

	public function indexAction()
	{
		$ciudadesModel =  new Page_Model_DbTable_Ciudad();
		$this->_view->ciudades = $ciudadesModel->getList("","nombre ASC");
		$productoModel =  new Page_Model_DbTable_Productos();
		$carrito = $this->getCarrito();
		$data = [];
		foreach ($carrito as $id => $cantidad) {
			$data[$id] = [];
			$data[$id]['detalle'] = $productoModel->getById($id);
			$data[$id]['cantidad'] = $cantidad;
		}
		$this->_view->carrito = $data;
		$this->getLayout()->setData("ocultarcarrito",1);

		$enviosModel =  new Page_Model_DbTable_Envio();
		$this->_view->envios = $enviosModel->getList("","");

		$portafoliosModel = new Page_Model_DbTable_Contenido();
		$this->_view->terminos= $portafoliosModel->getList(" contenido_seccion='10'","")[0];

		//log carrito
		$carrito_data = $data;
		$data = array();
		$logcarritoModel = new Administracion_Model_DbTable_Logcarrito();
		$data['log_cedula'] = $_SESSION['kt_cedula'];
		$data['log_detalle'] = "Comprar carrito";
		$data['log_log'] = print_r($carrito_data,true);
		$data['log_fecha'] = date("Y-m-d H:i:s");
		$logcarritoModel->insert($data);


		$kt_cedula = $_SESSION['kt_cedula'];
		$formularioModel = new Page_Model_DbTable_Pedidos();
		$ultimo = $formularioModel->getList(" pedido_forma_envio='1' AND pedido_documento='$kt_cedula' "," pedido_id DESC ")[0];
		$this->_view->ultimo = $ultimo;

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

	private function getData($total)
    {
        $data = array();
        $data['pedido_tipodocumento'] = $this->_getSanitizedParam("pedido_tipodocumento");
        $data['pedido_documento'] = $this->_getSanitizedParam("pedido_documento");
        $data['pedido_nombre'] = $this->_getSanitizedParam("pedido_nombre");
		$data['pedido_correo'] = $this->_getSanitizedParam("pedido_correo");
		if($this->_getSanitizedParam("pedido_telefono") == '' ) {
            $data['pedido_telefono'] = '0';
        } else {
            $data['pedido_telefono'] = $this->_getSanitizedParam("pedido_telefono");
        }
		$data['pedido_celular'] = $this->_getSanitizedParam("pedido_celular");
		$data['pedido_nomenclatura'] = $this->_getSanitizedParam("pedido_nomenclatura");
        $data['pedido_direccion'] = $this->_getSanitizedParam("pedido_direccion");
        $data['pedido_ciudad'] = $this->_getSanitizedParam("pedido_ciudad");
		$data['pedido_envio'] = $this->_getSanitizedParam("pedido_envio");
		$data['pedido_estado'] = $this->_getSanitizedParam("pedido_estado");
        $data['pedido_fecha'] = date("Y-m-d H:i:s");
        $data['pedido_valorpagar'] = $this->_getSanitizedParam("pedido_valorpagar1");

        $data['pedido_forma_envio'] = $this->_getSanitizedParam("pedido_forma_envio");
        $data['pedido_medio'] = $this->_getSanitizedParam("pedido_medio");

        $data['pedido_numero1'] = $this->_getSanitizedParam("numero1");
        $data['pedido_numero2'] = $this->_getSanitizedParam("numero2");
        $data['pedido_numero3'] = $this->_getSanitizedParam("numero3");
        $data['pedido_letra1'] = $this->_getSanitizedParam("letra1");
        $data['pedido_letra2'] = $this->_getSanitizedParam("letra2");
        $data['pedido_complemento'] = $this->_getSanitizedParam("complemento");
        $data['pedido_indicaciones'] = $this->_getSanitizedParam("indicaciones");
        $data['pedido_zona'] = $this->_getSanitizedParam("pedido_zona");

     	$data['pedido_direccion'] = $data['pedido_nomenclatura']." ".$data['pedido_numero1'].$data['pedido_letra1']." ".$data['pedido_numero2'].$data['pedido_letra2']."-".$data['pedido_numero3']." ".$data['pedido_complemento'];



		return $data;
	}

	public function enviarAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$productos =  $this->getProductos();
			$data = $this->getData($productos['total']);
			$formularioModel = new Page_Model_DbTable_Pedidos();
			if($_SESSION['carrito_actual']==""){
				$id = $formularioModel->insert($data);
				$_SESSION['carrito_actual']=$id;
			}else{
				$id = $_SESSION['carrito_actual'];
			}

			$formularioModel->editField($id,"pedido_numero1",$data['pedido_numero1']);
			$formularioModel->editField($id,"pedido_numero2",$data['pedido_numero2']);
			$formularioModel->editField($id,"pedido_numero3",$data['pedido_numero3']);
			$formularioModel->editField($id,"pedido_letra1",$data['pedido_letra1']);
			$formularioModel->editField($id,"pedido_letra2",$data['pedido_letra2']);
			$formularioModel->editField($id,"pedido_complemento",$data['pedido_complemento']);
			$formularioModel->editField($id,"pedido_indicaciones",$data['pedido_indicaciones']);
			$formularioModel->editField($id,"pedido_medio",$data['pedido_medio']);
			$formularioModel->editField($id,"pedido_forma_envio",$data['pedido_forma_envio']);
			$formularioModel->editField($id,"pedido_zona",$data['pedido_zona']);


			$formulario2Model = new Administracion_Model_DbTable_Carrito();
			$idc = $formulario2Model->insert($data);

			$error = $this->verificarsaldos($id);


			if($error==0){
				foreach ($productos as $key => $value) {
				   $this->agregarProducto($value,$id);
				}
				if($data['pedido_medio']=="2"){
					$error = $this->descontarproductos($id);
					if($error==0){
						$_SESSION['carrito'] = array();
						$_SESSION['carrito_actual']="";
						header("Location: /page/compra/generarpago/?id=".$id);
					}else{
						$mail = new Core_Model_Sendingemail($this->_view);
						$mail->enviarError($id);
						header("Location: /page/compra/?error=1");
					}
				}else{
			        $formularioModel->editField($id,"pedido_estado","1");
			        $formularioModel->editField($id,"pedido_estado_texto","Aprobado");
			        $formularioModel->editField($id,"pedido_estado_texto2","El pago se encuentra aprobado");
			        $_SESSION['carrito'] = array();
			        $_SESSION['carrito_actual']="";
					header("Location: /page/compra/enviopedido/?id=".$id);
				}
			}else{
				header("Location: /page/compra/?error=1");
			}




		}
	}


	public function enviopedidoAction(){
		$id = $this->_getSanitizedParam("id");
		$error = $this->descontarproductos($id);
		$mail = new Core_Model_Sendingemail($this->_view);
        if($error==0){
            $mail->enviarCompra($id);
        }else{
        	$formularioModel = new Page_Model_DbTable_Pedidos();
	        $formularioModel->editField($id,"pedido_estado","4");
	        $formularioModel->editField($id,"pedido_estado_texto","Fallido");
	        $formularioModel->editField($id,"pedido_estado_texto2","Inventario insuficiente");
            $mail->enviarError($id);
        }
	}


    public function descontarproductos($id){
        $mail = new Core_Model_Sendingemail($this->_view);

        $productoscarritoModel = new Page_Model_DbTable_Productoscarrito();
        $productosModel = new Page_Model_DbTable_Productos();
        $productoscarrito = $productoscarritoModel->getList(" id_carrito='$id' ","");

        $error=0;

        foreach ($productoscarrito as $key => $productocarrito) {
            $producto_id = $productocarrito->id_productos;
            $cantidad = $productocarrito->cantidad;
            $producto = $productosModel->getById($producto_id);
            $saldo = $producto->productos_cantidad*1 - $cantidad*1;
            if($saldo<0){
                $error=1;
            }
        }

        if($error==0){
            foreach ($productoscarrito as $key => $productocarrito) {
                $producto_id = $productocarrito->id_productos;
                $cantidad = $productocarrito->cantidad;
                $producto = $productosModel->getById($producto_id);
                $saldo = $producto->productos_cantidad*1 - $cantidad*1;
                $productosModel->editField($producto_id,"productos_cantidad",$saldo);

                $limite = $producto->productos_limite_pedido*1;
                if($saldo<$limite and $limite>0){
                    $mail->envioLimite($producto_id);
                }

            }
        }

        return $error;

    }

    public function verificarsaldos($id){

        $productoscarritoModel = new Page_Model_DbTable_Productoscarrito();
        $productosModel = new Page_Model_DbTable_Productos();
        $productoscarrito = $productoscarritoModel->getList(" id_carrito='$id' ","");

        $error=0;

        foreach ($productoscarrito as $key => $productocarrito) {
            $producto_id = $productocarrito->id_productos;
            $cantidad = $productocarrito->cantidad;
            $producto = $productosModel->getById($producto_id);
            $saldo = $producto->productos_cantidad*1 - $cantidad*1;
            if($saldo<0){
                $error=1;
            }
        }

        return $error;

    }

	private function getProductos(){
		$productoModel =  new Administracion_Model_DbTable_Productos();
		$carrito = $this->getCarrito();
		$total = 0;
		$data = [];
		foreach ($carrito as $id => $cantidad) {
			$data[$id] = [];
			$data[$id]['detalle'] = $productoModel->getById($id);
			$data[$id]['cantidad'] = $cantidad;
			$total = $total + ( $cantidad * $data[$id]['detalle']->productos_precio);
		}
		$data['total'] = $total;
		return $data;
	}

	private function agregarProducto($producto,$id){
		$data = [];
		$data['id_carrito'] = $id;
        $data['id_productos'] = $producto['detalle']->productos_id;
		$data['nombre'] = $producto['detalle']->productos_nombre;
		$data['nombre'] = str_replace("'", "\'",$data['nombre']);
		$data['cantidad'] = $producto['cantidad'];
        $data['imagen'] = $producto['detalle']->productos_imagen;
        $data['valor'] = $producto['detalle']->productos_precio;
        $data['valor_iva'] = $producto['detalle']->productos_precio;
		$formularioproductoModel = new Administracion_Model_DbTable_Productoscarrito();
		$formularioproductoModel->insert($data);
	}

	public function generarpagoAction(){
		$formularioModel = new Page_Model_DbTable_Pedidos();
		$id = $this->_getSanitizedParam("id");
		$pedido = $formularioModel->getById($id);
		$this->_view->id = $id;
		$this->_view->pedido = $pedido;

		$placetopay = Payment_Placetopay::getInstance()->getPlacetopay();
		$placetopayData = Payment_Placetopay::getInstance()->getData();
		$reference = $id;
		$request = [
			"locale"=> "es_CO",
			"buyer"=> [
				"name"=> $pedido->pedido_nombre,
				"surname"=> '',
				"email"=> $pedido->pedido_correo,
			],
			'payment' => [
				'reference' => $reference,
				'description' => 'Pago Nogal Delivery Ref: '.$id,
				'amount' => [
					'currency' => 'COP',
					'total' => $pedido->pedido_valorpagar,
				],
			],
			'expiration' => date('c', strtotime('+2 hour')),
			'returnUrl' => $placetopayData['returnUrl'].'?reference='.$reference,
			'ipAddress' => '127.0.0.1',
			'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
		];
		//var_dump($request);
		$response = $placetopay->request($request);
		//var_dump($response);
		if ($response->isSuccessful()) {
			$request_id = $response->requestId();
			$formularioModel->editField($id,"request_id",$request_id);
			header('Location: ' . $response->processUrl());
		} else {
			// There was some error so check the message and log it
			$response->status()->message();
		}

	}

	public function calcularenvioAction(){

		header('Content-Type:application/json');
		$this->setLayout('blanco');

		$nomenclatura = $this->_getSanitizedParam("nomenclatura");
		$numero1 =  $this->_getSanitizedParam("numero1");
		$numero2 =  $this->_getSanitizedParam("numero2");
		$complemento =  $this->_getSanitizedParam("complemento");

		if($nomenclatura=="Calle" or $nomenclatura=="Avenida Calle" or $nomenclatura=="Diagonal"){
			$calle = $numero1;
			$carrera = $numero2;
		}else{
			$calle = $numero2;
			$carrera = $numero1;
		}

		$zonaModel = new Administracion_Model_DbTable_Zonas();
		$existe = $zonaModel->getList(" (('$calle' >= zona_calle_min AND '$calle' <= zona_calle_max) OR ('$calle' >= zona_calle_min2 AND '$calle' <= zona_calle_max2)) AND '$carrera' >= zona_cra_min AND '$carrera' <= zona_cra_max ","");
		$maximo = $zonaModel->getList(""," valor DESC ");

		$valor = $existe[0]->zona_valor;

		$error=0;
		if(count($existe)==0){
			$error=1;
		}

		if(strtolower($complemento)=="sur"){
			$error=1;
		}

		$respuesta['valor']=$valor;
		$respuesta['error']=$error;
		$respuesta['zona_nombre'] = $existe[0]->zona_nombre;
		//$respuesta['consulta'] = "(('$calle' >= zona_calle_min AND '$calle' <= zona_calle_max) OR ('$calle' >= zona_calle_min2 AND '$calle' <= zona_calle_max2)) AND '$carrera' >= zona_cra_min AND '$carrera' <= zona_cra_max";
		echo json_encode($respuesta);


	}

}