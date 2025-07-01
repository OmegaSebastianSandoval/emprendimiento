<?php 
/**
* clase que genera la insercion y edicion  de Tienda Clicks en la base de datos
*/
class Administracion_Model_DbTable_Tiendaclicks extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'tienda_clicks';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'id';

	/**
	 * insert recibe la informacion de un Clicks y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$id_tienda = $data['id_tienda'];
		$usuario = $data['usuario'];
		$fecha = $data['fecha'];
		$hora = $data['hora'];
		$query = "INSERT INTO tienda_clicks( id_tienda, usuario, fecha,hora) VALUES ( '$id_tienda', '$usuario', '$fecha','$hora')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Clicks  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$id_tienda = $data['id_tienda'];
		$usuario = $data['usuario'];
		$fecha = $data['fecha'];
		$hora = $data['hora'];
		$query = "UPDATE tienda_clicks SET  id_tienda = '$id_tienda', usuario = '$usuario', fecha = '$fecha', hora = '$hora' WHERE id = '".$id."'";
		$res = $this->_conn->query($query);
	}

	public function getListPagesClicks($filters = '' ,$order = '' ,$page,$amount,$group)
    {
       $filter = '';
        if($filters != ''){
            $filter = ' WHERE '.$filters;
        }
        $orders ="";
        if($order != ''){
            $orders = ' ORDER BY '.$order;
        }
        $groups ='';
        if($group != ''){
            $groups = ' GROUP BY '.$group;
        }
    $select = 'SELECT id_tienda, COUNT(id_tienda) AS "clics" FROM '.$this->_name.' LEFT JOIN tiendas ON tienda_clicks.id_tienda = tiendas.tiendas_id '.$filter.' '.$orders.''.$groups.' LIMIT '.$page.' , '.$amount;
      $res = $this->_conn->query($select)->fetchAsObject();
         return $res;
	}
	public function getListClicks($filters = '',$order = '',$group = '')
    {
        $filter = '';
        if($filters != ''){
            $filter = ' WHERE '.$filters;
        }
        $orders ="";
        if($order != ''){
            $orders = ' ORDER BY '.$order;
		}
		$groups ='';
        if($group != ''){
            $groups = ' GROUP BY '.$group;
        }
		 $select = 'SELECT id_tienda, COUNT(id_tienda) AS "clics" FROM '.$this->_name.' LEFT JOIN tiendas ON tienda_clicks.id_tienda = tiendas.tiendas_id '.$filter.' '.$orders.''.$groups.'';

        $res = $this->_conn->query( $select )->fetchAsObject();
        return $res;
    }
    
    public function getListClicks2($filters = '',$order = '',$group = '')
    {
        $filter = '';
        if($filters != ''){
            $filter = ' WHERE '.$filters;
        }
        $orders ="";
        if($order != ''){
            $orders = ' ORDER BY '.$order;
		}
		$groups ='';
        if($group != ''){
            $groups = ' GROUP BY '.$group;
        }
		$select = 'SELECT tiendas.tiendas_id, tiendas.tiendas_nombre,tiendas.tiendas_descripcion,tiendas.tiendas_pagina,tiendas.tiendas_facebook,tiendas.tiendas_instagram,tiendas.tiendas_telefono,tiendas.tiendas_telefono2,tiendas.tiendas_datos,tiendas.tiendas_whatsapp,tiendas.tiendas_imagen,tiendas.tiendas_categoria,tiendas.tiendas_estado, COUNT(id_tienda) AS "clics" FROM '.$this->_name.' LEFT JOIN tiendas ON tienda_clicks.id_tienda = tiendas.tiendas_id '.$filter.' '.$groups.''.$orders.' ';

        $res = $this->_conn->query( $select )->fetchAsObject();
        return $res;
	}
	
	
	public function getList2($filters = '',$order = '')
    {
        $filter = '';
        if($filters != ''){
            $filter = ' WHERE '.$filters;
        }
        $orders ="";
        if($order != ''){
            $orders = ' ORDER BY '.$order;
        }
        $select = 'SELECT * FROM '.$this->_name.', tiendas '.$filter.' AND tienda_clicks.id_tienda=tiendas.tiendas_id '.$orders;
        $res = $this->_conn->query( $select )->fetchAsObject();
        return $res;
    }

    public function getListPages2($filters = '' ,$order = '' ,$page,$amount)
    {
       $filter = '';
        if($filters != ''){
            $filter = ' WHERE '.$filters;
        }
        $orders ="";
        if($order != ''){
            $orders = ' ORDER BY '.$order;
        }
       $select = 'SELECT * FROM '.$this->_name.', tiendas '.$filter.' AND tienda_clicks.id_tienda=tiendas.tiendas_id '.$orders.' LIMIT '.$page.' , '.$amount;
        $res = $this->_conn->query($select)->fetchAsObject();
         return $res;
    }

  

}