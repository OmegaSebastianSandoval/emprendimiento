<?php 
/**
* clase que genera la insercion y edicion  de cuadros en la base de datos
*/
class Administracion_Model_DbTable_Cuadros extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'cuadros';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'cuadros_id';

	/**
	 * insert recibe la informacion de un cuadro y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$cuadros_titulo = $data['cuadros_titulo'];
		$cuadros_descripcion = $data['cuadros_descripcion'];
		$cuadros_imagen = $data['cuadros_imagen'];
		$cuadros_precio = $data['cuadros_precio'];
		$cuadros_contacto = $data['cuadros_contacto'];
		$cuadros_artista = $data['cuadros_artista'];
		$cuadros_activo = $data['cuadros_activo'];
		$cuadros_negocio = $data['cuadros_negocio'];
		$query = "INSERT INTO cuadros( cuadros_titulo, cuadros_descripcion, cuadros_imagen, cuadros_precio, cuadros_contacto, cuadros_artista, cuadros_activo, cuadros_negocio) VALUES ( '$cuadros_titulo', '$cuadros_descripcion', '$cuadros_imagen', '$cuadros_precio', '$cuadros_contacto', '$cuadros_artista', '$cuadros_activo', '$cuadros_negocio')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un cuadro  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$cuadros_titulo = $data['cuadros_titulo'];
		$cuadros_descripcion = $data['cuadros_descripcion'];
		$cuadros_imagen = $data['cuadros_imagen'];
		$cuadros_precio = $data['cuadros_precio'];
		$cuadros_contacto = $data['cuadros_contacto'];
		$cuadros_artista = $data['cuadros_artista'];
		$cuadros_activo = $data['cuadros_activo'];
		$cuadros_negocio = $data['cuadros_negocio'];
		$query = "UPDATE cuadros SET  cuadros_titulo = '$cuadros_titulo', cuadros_descripcion = '$cuadros_descripcion', cuadros_imagen = '$cuadros_imagen', cuadros_precio = '$cuadros_precio', cuadros_contacto = '$cuadros_contacto', cuadros_artista = '$cuadros_artista', cuadros_activo = '$cuadros_activo', cuadros_negocio = '$cuadros_negocio' WHERE cuadros_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}