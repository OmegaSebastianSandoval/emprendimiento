<?php

/**
 * Controlador para la gestión de Mi Tienda
 */

class Page_mitiendaController extends Page_mainController
{

  public function indexAction()
  {
    $this->getLayout()->setData("ocultarcarrito", 1);

    // Verificar que el usuario esté logueado y sea un emprendimiento
    if (!Session::getInstance()->get("kt_login_id") || !Session::getInstance()->get("emprendimiento")) {
      header('Location: /page/login?emp=1');
      exit;
    }

    // Obtener información de la tienda del usuario logueado
    $tiendaInfo = Session::getInstance()->get("tiendaInfo");
    $this->_view->tiendaInfo = $tiendaInfo;

    // Obtener información del usuario emprendedor
    $asociado = Session::getInstance()->get("asociado");
    $this->_view->asociado = $asociado;

    // Obtener categorías para mostrar en el menú
    $categoriasModel = new Administracion_Model_DbTable_Categorias();
    $this->_view->categoriasTienda = $categoriasModel->getList("categorias_estado='1' AND categorias_padre = '0'", "orden ASC");

    // Obtener productos de la tienda (si los hay)
    $productosModel = new Page_Model_DbTable_Productos();
    $userNegocio = Session::getInstance()->get("user_negocio");

    if ($userNegocio) {
      // Asegurar que los productos son un array válido
      $productos = $productosModel->getList("productos_tienda = '$userNegocio'", "productos_id DESC LIMIT 6");
      $this->_view->productos = is_array($productos) ? $productos : [];

      // Contar total de productos
      $totalProductos = $productosModel->getList("productos_tienda = '$userNegocio'", "");
      $this->_view->totalProductos = is_array($totalProductos) ? count($totalProductos) : 0;
    } else {
      $this->_view->productos = [];
      $this->_view->totalProductos = 0;
    }
  }

  public function productosAction()
  {
    // Verificar que el usuario esté logueado y sea un emprendimiento
    if (!Session::getInstance()->get("kt_login_id") || !Session::getInstance()->get("emprendimiento")) {
      header('Location: /page/login?emp=1');
      exit;
    }

    // Redirigir a la gestión de productos
    header('Location: /page/listproductos');
    exit;
  }

  public function categoriasAction()
  {
    // Verificar que el usuario esté logueado y sea un emprendimiento
    if (!Session::getInstance()->get("kt_login_id") || !Session::getInstance()->get("emprendimiento")) {
      header('Location: /page/login?emp=1');
      exit;
    }

    // Redirigir a la gestión de categorías
    header('Location: /page/subcategorias/');
    exit;
  }

  public function editartiendaAction()
  {
    // Verificar que el usuario esté logueado y sea un emprendimiento
    if (!Session::getInstance()->get("kt_login_id") || !Session::getInstance()->get("emprendimiento")) {
      header('Location: /page/login?emp=1');
      exit;
    }

    // Configurar CSRF
    $this->_csrf_section = "edit_mitienda_" . date("YmdHis");
    $this->_csrf->generateCode($this->_csrf_section);
    $this->_view->csrf_section = $this->_csrf_section;
    $this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];

    // Obtener información actual de la tienda
    $userNegocio = Session::getInstance()->get("user_negocio");
    $tiendasModel = new Administracion_Model_DbTable_Tiendas();

    if ($userNegocio) {
      $tiendaInfo = $tiendasModel->getById($userNegocio);
      $this->_view->tiendaInfo = $tiendaInfo;
    } else {
      $this->_view->tiendaInfo = null;
    }

    // Obtener información del usuario
    $asociado = Session::getInstance()->get("asociado");
    $this->_view->asociado = $asociado;

    // Configurar formulario
    $this->_view->routeform = "/page/mitienda/updatetienda";

    // Configurar meta datos
    $this->getLayout()->setData("metadescription", "Editar información de mi tienda");
    $this->getLayout()->setData("metakeywords", "editar, tienda, emprendimiento, información");
  }

  public function updatetiendaAction()
  {

    $this->setLayout('blanco');

    // Verificar que el usuario esté logueado y sea un emprendimiento
    if (!Session::getInstance()->get("kt_login_id") || !Session::getInstance()->get("emprendimiento")) {
      header('Location: /page/login?emp=1');
      exit;
    }

    // Verificar CSRF
    $csrf = $this->_getSanitizedParam("csrf");
    if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {

      $userNegocio = Session::getInstance()->get("user_negocio");
      if ($userNegocio) {
        $tiendasModel = new Administracion_Model_DbTable_Tiendas();
        $tiendaInfo = $tiendasModel->getById($userNegocio);

        if ($tiendaInfo) {
          $data = $this->getDataTienda();

          // Manejar imagen
          $uploadImage = new Core_Model_Upload_Image();
          if ($_FILES['tiendas_imagen']['name'] != '') {
            if ($tiendaInfo->tiendas_imagen) {
              $uploadImage->delete($tiendaInfo->tiendas_imagen);
            }
            $data['tiendas_imagen'] = $uploadImage->upload("tiendas_imagen");
          } else {
            $data['tiendas_imagen'] = $tiendaInfo->tiendas_imagen;
          }

          // Actualizar tienda
          $tiendasModel->update($data, $userNegocio);

          // Actualizar información del usuario asociado
          $userModel = new core_Model_DbTable_User();
          $userId = Session::getInstance()->get("kt_login_id");
          /* $userModel->editField($userId, "user_names", $data['tiendas_nombre']);
          $userModel->editField($userId, "user_email", $this->_getSanitizedParam("user_email"));
          $userModel->editField($userId, "user_phone", $data['tiendas_telefono']); */

          // Actualizar sesión con nueva información
          $tiendaActualizada = $tiendasModel->getById($userNegocio);
          Session::getInstance()->set("tiendaInfo", $tiendaActualizada);
          $_SESSION["tiendaInfo"] = $tiendaActualizada;

          // Log de la acción
          $logData = $data;
          $logData['tiendas_id'] = $userNegocio;
          $logData['log_log'] = print_r($data, true);
          $logData['log_tipo'] = 'EDITAR MI TIENDA';
          $logModel = new Administracion_Model_DbTable_Log();
          $logModel->insert($logData);

          // Establecer mensaje de éxito
          Session::getInstance()->set("mensaje_exito", "Información de la tienda actualizada correctamente");
        }
      }
    }

    header('Location: /page/mitienda');
  }

  /**
   * Obtiene los datos del formulario de edición de tienda
   */
  private function getDataTienda()
  {
    $data = array();
    $data['tiendas_nombre'] = $this->_getSanitizedParam("tiendas_nombre");
    $data['tiendas_descripcion'] = $this->_getSanitizedParamHtml("tiendas_descripcion");
    $data['tiendas_pagina'] = $this->enlacepagina($this->_getSanitizedParam("tiendas_pagina"));
    $data['tiendas_facebook'] = $this->enlaceredes($this->_getSanitizedParam("tiendas_facebook"));
    $data['tiendas_instagram'] = $this->enlaceredes($this->_getSanitizedParam("tiendas_instagram"));
    $data['tiendas_telefono'] = $this->_getSanitizedParam("tiendas_telefono");
    $data['tiendas_telefono2'] = $this->_getSanitizedParam("tiendas_telefono2");
    $data['tiendas_whatsapp'] = $this->_getSanitizedParam("tiendas_whatsapp");
    $data['tiendas_categoria'] = $this->_getSanitizedParam("tiendas_categoria");
    $data['tiendas_correo'] = $this->_getSanitizedParam("tiendas_correo");

    if ($this->_getSanitizedParam("tiendas_estado") == '') {
      $data['tiendas_estado'] = '0';
    } else {
      $data['tiendas_estado'] = $this->_getSanitizedParam("tiendas_estado");
    }

    return $data;
  }

  /**
   * Limpia enlaces de redes sociales
   */
  private function enlaceredes($x)
  {
    $x = str_replace("@", "", $x);
    $x = str_replace("https://www.instagram.com", "", $x);
    $x = str_replace("https://es-la.facebook.com", "", $x);
    $x = str_replace("/", "", $x);
    $x = str_replace("https:m.", "", $x);
    $x = str_replace("https:www.", "", $x);
    $x = str_replace("www.", "", $x);
    return $x;
  }

  /**
   * Limpia enlaces de páginas web
   */
  private function enlacepagina($x)
  {
    $x = str_replace("https://", "", $x);
    $x = str_replace("http://", "", $x);
    return $x;
  }
}
