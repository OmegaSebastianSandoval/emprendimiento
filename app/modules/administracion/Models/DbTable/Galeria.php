<?php 
/**
* clase que genera la insercion y edicion  de galeria en la base de datos
*/
class Administracion_Model_DbTable_Galeria extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'galeria';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'galeria_id';

	/**
	 * insert recibe la informacion de un galeria y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$galeria_titulo = $data['galeria_titulo'];
		$galeria_imagen = $data['galeria_imagen'];
		$galeria_descripcion = $data['galeria_descripcion'];
		$query = "INSERT INTO galeria( galeria_titulo, galeria_imagen, galeria_descripcion) VALUES ( '$galeria_titulo', '$galeria_imagen', '$galeria_descripcion')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un galeria  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$galeria_titulo = $data['galeria_titulo'];
		$galeria_imagen = $data['galeria_imagen'];
		$galeria_descripcion = $data['galeria_descripcion'];
		$query = "UPDATE galeria SET  galeria_titulo = '$galeria_titulo', galeria_imagen = '$galeria_imagen', galeria_descripcion = '$galeria_descripcion' WHERE galeria_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}