<?php

/**
*
*/
class Core_placetopayController extends Controllers_Abstract
{

    public function responseAction()
    {
        //error_reporting(1);
        $formularioModel = new Page_Model_DbTable_Pedidos();
        $placetopay = Payment_Placetopay::getInstance()->getPlacetopay();
        $id = $this->_getSanitizedParam("reference");
        $registro = $formularioModel->getById($id);
        $response = $placetopay->query($registro->request_id);
        if ($response->isSuccessful()) {
            //echo "<pre>";
            //print_r($response);
            //echo $response->payment[0]->authorization();
            // In order to use the functions please refer to the Dnetix\Redirection\Message\RedirectInformation class
            if ($response->status()->isApproved()) {
                $formularioModel->editField($id,"pedido_estado",'1');
                $formularioModel->editField($id,"pedido_estado_texto",'Aprobado');
                $formularioModel->editField($id,"pedido_estado_texto2","El pago ha sido aprobado exitosamente");
                $formularioModel->editField($id,"pedido_cus",$response->payment[0]->authorization());
                $formularioModel->editField($id,"pedido_franquicia",$response->payment[0]->paymentMethodName()." ".$response->payment[0]->issuerName());
                $this->enviarCompra1($id);
                header("Location: /page/respuesta?id=".$id);
            } else if( ($response->payment[0] && $response->payment[0]->status()->status() == 'PENDING') OR $response->status()->status()=='PENDING' ){
                $formularioModel->editField($id,"pedido_estado",'2');
                $formularioModel->editField($id,"pedido_estado_texto",'Pendiente');
                $formularioModel->editField($id,"pedido_estado_texto2","El pago se encuentra pendiente");
                if($response->payment[0]){
                    $cus = $response->payment[0]->authorization();
                    $formularioModel->editField($id,"pedido_franquicia",$response->payment[0]->paymentMethodName()." ".$response->payment[0]->issuerName());
                } else {
                    $cus = '';
                }
                $formularioModel->editField($id,"pedido_cus",$cus);
                header("Location: /page/respuesta?id=".$id);
            } else if( ($response->payment[0] && $response->payment[0]->status()->status() == 'FAILED') ){
                $formularioModel->editField($id,"pedido_estado",'4');
                $formularioModel->editField($id,"pedido_estado_texto",'Fallido');
                $formularioModel->editField($id,"pedido_estado_texto2","La petición ha sido cancelada por el usuario");
                if($response->payment[0]){
                    $cus = $response->payment[0]->authorization();
                    $formularioModel->editField($id,"pedido_franquicia",$response->payment[0]->paymentMethodName()." ".$response->payment[0]->issuerName());
                } else {
                    $cus = '';
                }
                $formularioModel->editField($id,"pedido_cus",$cus);
                if($registro->pedido_fecha >= "2020-04-21 12:24:00"){
                    $this->agregarproductos($id);
                }
                header("Location: /page/respuesta?id=".$id);
            } else {
                $formularioModel->editField($id,"pedido_estado",'3');
                $formularioModel->editField($id,"pedido_estado_texto",'Rechazada');
                $formularioModel->editField($id,"pedido_estado_texto2","El pago se encuentra rechazado");
                if($response->payment[0]){
                    $cus = $response->payment[0]->authorization();
                    $formularioModel->editField($id,"pedido_franquicia",$response->payment[0]->paymentMethodName()." ".$response->payment[0]->issuerName());
                } else {
                    $cus = '';
                }
                $formularioModel->editField($id,"pedido_cus",$cus);
                if($registro->pedido_fecha >= "2020-04-21 12:24:00"){
                    $this->agregarproductos($id);
                }
                header("Location: /page/respuesta?id=".$id);
            }
        } else {
            // There was some error with the connection so check the message
            //print_r($response->status()->message() . "\n");
            header("Location: /page/respuesta?error=1");
        }
    }

    //solo consulta
    public function response2Action()
    {
        error_reporting(1);
        $formularioModel = new Page_Model_DbTable_Pedidos();
        $placetopay = Payment_Placetopay::getInstance()->getPlacetopay();
        $id = $this->_getSanitizedParam("reference");
        $registro = $formularioModel->getById($id);
        $response = $placetopay->query($registro->request_id);
        if ($response->isSuccessful()) {
            echo "<pre>";
            print_r($response);
            //echo $response->payment[0]->authorization();
            // In order to use the functions please refer to the Dnetix\Redirection\Message\RedirectInformation class
            if ($response->status()->isApproved()) {
                $formularioModel->editField($id,"pedido_estado",'1');
                $formularioModel->editField($id,"pedido_estado_texto",'Aprobado');
                $formularioModel->editField($id,"pedido_estado_texto2","El pago ha sido aprobado exitosamente");
                $formularioModel->editField($id,"pedido_cus",$response->payment[0]->authorization());
                $formularioModel->editField($id,"pedido_franquicia",$response->payment[0]->paymentMethodName()." ".$response->payment[0]->issuerName());
            } else if(($response->payment[0] && $response->payment[0]->status()->status() == 'PENDING') OR $response->status()->status()=='PENDING'){
                echo "entro pendiente";
                print_r($response->payment[0]);
                echo $response->status()->reason();
                $formularioModel->editField($id,"pedido_estado",'2');
                $formularioModel->editField($id,"pedido_estado_texto",'Pendiente');
                $formularioModel->editField($id,"pedido_estado_texto2","El pago se encuentra pendiente");
                if($response->payment[0]){
                    $cus = $response->payment[0]->authorization();
                    $formularioModel->editField($id,"pedido_franquicia",$response->payment[0]->franchise()." ".$response->payment[0]->franchiseName());
                } else {
                    $cus = '';
                }
                $formularioModel->editField($id,"pedido_cus",$cus);
            } else if( ($response->payment[0] && $response->payment[0]->status()->status() == 'FAILED') ){
                $formularioModel->editField($id,"pedido_estado",'4');
                $formularioModel->editField($id,"pedido_estado_texto",'Fallido');
                $formularioModel->editField($id,"pedido_estado_texto2","La petición ha sido cancelada por el usuario");
                if($response->payment[0]){
                    $cus = $response->payment[0]->authorization();
                } else {
                    $cus = '';
                }
                $formularioModel->editField($id,"pedido_cus",$cus);
            } else {
                $formularioModel->editField($id,"pedido_estado",'3');
                $formularioModel->editField($id,"pedido_estado_texto",'Rechazada');
                $formularioModel->editField($id,"pedido_estado_texto2","El pago se encuentra rechazado");
                if($response->payment[0]){
                    $cus = $response->payment[0]->authorization();
                } else {
                    $cus = '';
                }
                $formularioModel->editField($id,"pedido_cus",$cus);
            }
        } else {
            // There was some error with the connection so check the message
            print_r($response->status()->message() . "\n");
            //header("Location: /page/respuesta?error=1");
        }
    }

    public function notificationAction()
    {
        $formularioModel = new Page_Model_DbTable_Pedidos();
        //error_reporting(1);
        header('Access-Control-Allow-Origin: *');
        $placetopay = Payment_Placetopay::getInstance()->getPlacetopay();
        try {
            $notification = $placetopay->readNotification();
            /*echo "<pre>";
            print_r($notification);*/
            $notification->isValidNotification();
            if ($notification->isValidNotification() == true) {
                if ($notification->isApproved()) {
                    $id = $notification->reference();
                    $formularioModel->editField($id,"pedido_estado",'1');
                    $formularioModel->editField($id,"pedido_estado_texto",'Aprobado');
                    $formularioModel->editField($id,"pedido_estado_texto2","El pago ha sido aprobado exitosamente");
                    $this->enviarCompra1($id);
                    //echo "aprobacion";
                } else {
                    $id = $notification->reference();
                    $formularioModel->editField($id,"pedido_estado",'3');
                    $formularioModel->editField($id,"pedido_estado_texto",'Rechazada');
                    $formularioModel->editField($id,"pedido_estado_texto2","El pago se encuentra rechazado ddd");
                    //echo "rechazo";
                }
            } else {
                //echo "no hay comunicacion con placetopay";
            }
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }

    public function sondaAction()
    {
        error_reporting(1);
        $placetopay = Payment_Placetopay::getInstance()->getPlacetopay();
        $formularioModel = new Page_Model_DbTable_Pedidos();
        $inscripciones = $formularioModel->getList(" pedido_medio = '2' AND pedido_estado='2' AND request_id IS NOT NULL ","");
        foreach ($inscripciones as $key => $inscripcion) {
            $id = $inscripcion->pedido_id;
            $response = $placetopay->query($inscripcion->request_id);
            if ($response->isSuccessful()) {
                //echo "<pre>";
                echo "<br>id:".$id."<br>";
                print_r($response->status());
                //echo $response->payment[0]->authorization();
                // In order to use the functions please refer to the Dnetix\Redirection\Message\RedirectInformation class
                if ($response->status()->isApproved()) {
                    $formularioModel->editField($id,"pedido_estado",'1');
                    $formularioModel->editField($id,"pedido_estado_texto",'Aprobado');
                    $formularioModel->editField($id,"pedido_estado_texto2","El pago ha sido aprobado exitosamente");
                    $formularioModel->editField($id,"pedido_cus",$response->payment[0]->authorization());
                    $formularioModel->editField($id,"pedido_franquicia",$response->payment[0]->paymentMethodName()." ".$response->payment[0]->issuerName());
                    $this->enviarCompra1($id);
                } else if(($response->payment[0] && $response->payment[0]->status()->status() == 'PENDING') OR $response->status()->status()=='PENDING'){
                    $formularioModel->editField($id,"pedido_estado",'2');
                    $formularioModel->editField($id,"pedido_estado_texto",'Pendiente');
                    $formularioModel->editField($id,"pedido_estado_texto2","El pago se encuentra pendiente");
                    if($response->payment[0]){
                        $cus = $response->payment[0]->authorization();
                        $formularioModel->editField($id,"pedido_franquicia",$response->payment[0]->paymentMethodName()." ".$response->payment[0]->issuerName());
                    } else {
                        $cus = '';
                    }
                    $formularioModel->editField($id,"pedido_cus",$cus);

                } else if($response->payment[0] && $response->payment[0]->status()->status() == 'FAILED'){
                    $formularioModel->editField($id,"pedido_estado",'4');
                    $formularioModel->editField($id,"pedido_estado_texto",'Fallido');
                    $formularioModel->editField($id,"pedido_estado_texto2","La petición ha sido cancelada por el usuario");
                    if($response->payment[0]){
                        $cus = $response->payment[0]->authorization();
                        $formularioModel->editField($id,"pedido_franquicia",$response->payment[0]->paymentMethodName()." ".$response->payment[0]->issuerName());
                    } else {
                        $cus = '';
                    }
                    $formularioModel->editField($id,"pedido_cus",$cus);
                    if($registro->pedido_fecha >= "2020-04-21 12:24:00"){
                        $this->agregarproductos($id);
                    }

                } else {
                    $formularioModel->editField($id,"pedido_estado",'3');
                    $formularioModel->editField($id,"pedido_estado_texto",'Rechazada');
                    $formularioModel->editField($id,"pedido_estado_texto2","El pago se encuentra rechazado");
                    $formularioModel->editField($id,"pedido_cus",$response->payment[0]->authorization());
                    if($registro->pedido_fecha >= "2020-04-21 12:24:00"){
                        $this->agregarproductos($id);
                    }
                }
            } else {
                //print_r($response->status()->message() . "\n");
            }
        }
    }

    public function pruebaenvioAction(){
        //$this->enviarCompra1(4);
    }

    public function enviarCompra1($id){
        $mail = new Core_Model_Sendingemail($this->_view);
        $error=0;

        $formularioModel = new Page_Model_DbTable_Pedidos();
        $pedido = $formularioModel->getById($id);
        if($pedido->pedido_fecha <= "2020-04-21 12:24:00"){
            $error = $this->descontarproductos($id);
        }
        if($error==0){
            $mail->enviarCompra($id);
        }else{
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



    public function agregarproductos($id){
        $mail = new Core_Model_Sendingemail($this->_view);

        $productoscarritoModel = new Page_Model_DbTable_Productoscarrito();
        $productosModel = new Page_Model_DbTable_Productos();
        $productoscarrito = $productoscarritoModel->getList(" id_carrito='$id' ","");

        $error=0;

        foreach ($productoscarrito as $key => $productocarrito) {
            $producto_id = $productocarrito->id_productos;
            $cantidad = $productocarrito->cantidad;
            $producto = $productosModel->getById($producto_id);
            $saldo = $producto->productos_cantidad*1 + $cantidad*1;
            $productosModel->editField($producto_id,"productos_cantidad",$saldo);
        }

        return $error;

    }

    public function agregarproductos2Action(){
        $id = $this->_getSanitizedParam("id");
        $mail = new Core_Model_Sendingemail($this->_view);

        $productoscarritoModel = new Page_Model_DbTable_Productoscarrito();
        $productosModel = new Page_Model_DbTable_Productos();
        $productoscarrito = $productoscarritoModel->getList(" id_carrito='$id' ","");

        $error=0;

        foreach ($productoscarrito as $key => $productocarrito) {
            $producto_id = $productocarrito->id_productos;
            $cantidad = $productocarrito->cantidad;
            $producto = $productosModel->getById($producto_id);
            $saldo = $producto->productos_cantidad*1 + $cantidad*1;
            $productosModel->editField($producto_id,"productos_cantidad",$saldo);
            echo "producto".$producto_id." saldo:".$saldo."<br>";
        }

        return $error;

    }


}