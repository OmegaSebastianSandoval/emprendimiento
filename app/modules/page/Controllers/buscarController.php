<?php

/**
 *
 */

class Page_buscarController extends Page_mainController
{

    public function indexAction()
    {
        $buscar = $this->_getSanitizedParam("buscar");

        $categoriasModel = new Administracion_Model_DbTable_Categorias();
        $productosModel = new Administracion_Model_DbTable_Productos();
        $tiendasModel = new Administracion_Model_DbTable_Tiendas();
        if ($buscar != "") {
            $this->_view->categorias2 = $categoriasModel->getList("categorias_nombre LIKE '%$buscar%' AND categorias_estado='1'", "");
            $this->_view->tienda = $tiendasModel->getList("(tiendas_nombre LIKE '%$buscar%' || tiendas_descripcion LIKE '%$buscar%')  AND tiendas_estado='1'", "");
            $this->_view->tienda2 = $tiendasModel->getList("tiendas_estado='1'", "");
            $this->_view->productos = $productosModel->getList("(productos_nombre LIKE '%$buscar%'|| productos_descripcion LIKE '%$buscar%')", "");
        }
    }
}
