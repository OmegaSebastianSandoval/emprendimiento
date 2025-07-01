<?php 
/**
* clase que genera la insercion y edicion  de Categorias en la base de datos
*/
class Administracion_Model_DbTable_Categorias extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'categorias';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'categorias_id';

	/**
	 * insert recibe la informacion de un Categoria y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$categorias_nombre = $data['categorias_nombre'];
		$categorias_descripcion = $data['categorias_descripcion'];
		$categorias_padre = $data['categorias_padre'];
		$categorias_banner = $data['categorias_banner'];
		$categorias_color = $data['categorias_color'];
		$categorias_imagen_techo = $data['categorias_imagen_techo'];
		$categorias_estado = $data['categorias_estado'];
		$categorias_estado_imagen = $data['categorias_estado_imagen'];
		$categorias_imagen_tienda = $data['categorias_imagen_tienda'];
		$query = "INSERT INTO categorias( categorias_nombre, categorias_descripcion, categorias_padre, categorias_banner, categorias_color,categorias_imagen_techo,categorias_estado,categorias_imagen_tienda,categorias_estado_imagen) VALUES ( '$categorias_nombre', '$categorias_descripcion', '$categorias_padre', '$categorias_banner', '$categorias_color', '$categorias_imagen_techo', '$categorias_estado', '$categorias_imagen_tienda','$categorias_estado_imagen')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Categoria  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$categorias_nombre = $data['categorias_nombre'];
		$categorias_descripcion = $data['categorias_descripcion'];
		$categorias_banner = $data['categorias_banner'];
		$categorias_color = $data['categorias_color'];
		$categorias_imagen_techo = $data['categorias_imagen_techo'];
		$categorias_estado = $data['categorias_estado'];
		$categorias_imagen_tienda = $data['categorias_imagen_tienda'];
		$categorias_estado_imagen = $data['categorias_estado_imagen'];
		$query = "UPDATE categorias SET  categorias_nombre = '$categorias_nombre', categorias_descripcion = '$categorias_descripcion', categorias_banner = '$categorias_banner', categorias_color = '$categorias_color', categorias_imagen_techo = '$categorias_imagen_techo', categorias_estado = '$categorias_estado', categorias_imagen_tienda = '$categorias_imagen_tienda', categorias_estado_imagen = '$categorias_estado_imagen'  WHERE categorias_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}