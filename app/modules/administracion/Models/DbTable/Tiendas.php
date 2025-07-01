<?php 
/**
* clase que genera la insercion y edicion  de tiendas en la base de datos
*/
class Administracion_Model_DbTable_Tiendas extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'tiendas';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'tiendas_id';

	/**
	 * insert recibe la informacion de un tienda y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$tiendas_nombre = $data['tiendas_nombre'];
		$tiendas_descripcion = $data['tiendas_descripcion'];
		$tiendas_datos = $data['tiendas_datos'];
		$tiendas_pagina = $data['tiendas_pagina'];
		$tiendas_facebook = $data['tiendas_facebook'];
		$tiendas_instagram = $data['tiendas_instagram'];
		$tiendas_telefono = $data['tiendas_telefono'];
		$tiendas_telefono2 = $data['tiendas_telefono2'];
		$tiendas_whatsapp = $data['tiendas_whatsapp'];
		$tiendas_imagen = $data['tiendas_imagen'];
		$tiendas_categoria = $data['tiendas_categoria'];
		$tiendas_estado = $data['tiendas_estado'];
		$query = "INSERT INTO tiendas( tiendas_nombre, tiendas_descripcion, tiendas_pagina, tiendas_facebook, tiendas_instagram, tiendas_telefono, tiendas_telefono2, tiendas_datos, tiendas_whatsapp, tiendas_imagen, tiendas_categoria, tiendas_estado) VALUES ( '$tiendas_nombre', '$tiendas_descripcion','$tiendas_pagina', '$tiendas_facebook', '$tiendas_instagram', '$tiendas_telefono','$tiendas_telefono2',  '$tiendas_datos', '$tiendas_whatsapp', '$tiendas_imagen', '$tiendas_categoria', '$tiendas_estado')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un tienda  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$tiendas_nombre = $data['tiendas_nombre'];
		$tiendas_descripcion = $data['tiendas_descripcion'];
		$tiendas_datos = $data['tiendas_datos'];
		$tiendas_pagina = $data['tiendas_pagina'];
		$tiendas_facebook = $data['tiendas_facebook'];
		$tiendas_instagram = $data['tiendas_instagram'];
		$tiendas_telefono = $data['tiendas_telefono'];
		$tiendas_telefono2 = $data['tiendas_telefono2'];
		$tiendas_whatsapp = $data['tiendas_whatsapp'];
		$tiendas_imagen = $data['tiendas_imagen'];
		$tiendas_categoria = $data['tiendas_categoria'];
		$tiendas_estado = $data['tiendas_estado'];
		$query = "UPDATE tiendas SET  tiendas_nombre = '$tiendas_nombre', tiendas_descripcion = '$tiendas_descripcion',tiendas_pagina = '$tiendas_pagina',tiendas_facebook = '$tiendas_facebook',tiendas_instagram = '$tiendas_instagram',tiendas_telefono = '$tiendas_telefono',tiendas_telefono2 = '$tiendas_telefono2', tiendas_datos = '$tiendas_datos', tiendas_whatsapp = '$tiendas_whatsapp', tiendas_imagen = '$tiendas_imagen', tiendas_categoria = '$tiendas_categoria', tiendas_estado = '$tiendas_estado' WHERE tiendas_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}