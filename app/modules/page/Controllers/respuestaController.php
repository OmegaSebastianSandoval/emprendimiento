<?php

/**
*
*/

class Page_respuestaController extends Page_mainController
{

	public function indexAction()
	{
        $id = $this->_getSanitizedParam("id");
        $pedidoModel = new Page_Model_DbTable_Pedidos();
        $this->_view->pedido = $pedidoModel->getById($id);
    }

}