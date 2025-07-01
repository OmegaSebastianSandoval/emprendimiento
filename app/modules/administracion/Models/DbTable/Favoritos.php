<?php 
/**
* clase que genera la insercion y edicion  de favoritos en la base de datos
*/
class Administracion_Model_DbTable_Favoritos extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'favoritos';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'favoritos_id';

	/**
	 * insert recibe la informacion de un favoritos y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$favoritos_usuario = $data['favoritos_usuario'];
		$favoritos_tienda = $data['favoritos_tienda'];
		$query = "INSERT INTO favoritos( favoritos_usuario, favoritos_tienda) VALUES ( '$favoritos_usuario', '$favoritos_tienda')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un favoritos  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$favoritos_usuario = $data['favoritos_usuario'];
		$favoritos_tienda = $data['favoritos_tienda'];
		$query = "UPDATE favoritos SET  favoritos_usuario = '$favoritos_usuario', favoritos_tienda = '$favoritos_tienda' WHERE favoritos_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
	public function borrar($usuario,$tienda){
		
		$query = "DELETE FROM favoritos WHERE  favoritos_usuario = '$usuario' AND favoritos_tienda = '$tienda' ";
		$res = $this->_conn->query($query);
	}
}