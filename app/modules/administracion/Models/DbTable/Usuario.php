<?php
/**
 * clase que genera la insercion y edicion  de Usuarios en la base de datos
 */
class Administracion_Model_DbTable_Usuario extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'user';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'user_id';

	/**
	 * insert recibe la informacion de un Usuario y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data)
	{
		$user_state = $data['user_state'];
		$user_date = $data['user_date'];
		$user_names = $data['user_names'];
		$user_lastnames = $data['user_lastnames'];
		$user_email = $data['user_email'];
		$user_level = $data['user_level'];
		$user_user = $data['user_user'];
		$user_password = password_hash($data['user_password'], PASSWORD_DEFAULT);
		$user_delete = $data['user_delete'];
		$user_current_user = $data['user_current_user'];
		$user_code = $data['user_code'];
		$user_negocio = $data['user_negocio'];
		$user_accion = $data['user_accion'];
		$user_telefono = $data['user_telefono'];
		$user_invitado_socio = $data['user_invitado_socio'];

		// Nuevos campos para tipo de persona
		$persona_tipo = isset($data['persona_tipo']) ? $data['persona_tipo'] : '';

		// Campos Persona Natural
		$pn_nombres = isset($data['pn_nombres']) ? $data['pn_nombres'] : '';
		$pn_apellidos = isset($data['pn_apellidos']) ? $data['pn_apellidos'] : '';
		$pn_id_tipo = isset($data['pn_id_tipo']) ? $data['pn_id_tipo'] : '';
		$pn_documento = isset($data['pn_documento']) ? $data['pn_documento'] : '';
		$pn_fecha_nacimiento = isset($data['pn_fecha_nacimiento']) ? $data['pn_fecha_nacimiento'] : '';
		$pn_telefono_contacto = isset($data['pn_telefono_contacto']) ? $data['pn_telefono_contacto'] : '';
		$pn_email = isset($data['pn_email']) ? $data['pn_email'] : '';
		$pn_nivel_estudio = isset($data['pn_nivel_estudio']) ? $data['pn_nivel_estudio'] : '';
		$pn_actividad = isset($data['pn_actividad']) ? $data['pn_actividad'] : '';
		$pn_departamento = isset($data['pn_departamento']) ? $data['pn_departamento'] : '';
		$pn_municipio = isset($data['pn_municipio']) ? $data['pn_municipio'] : '';
		$pn_direccion = isset($data['pn_direccion']) ? $data['pn_direccion'] : '';

		// Campos Persona Jurídica
		$pj_razon_social = isset($data['pj_razon_social']) ? $data['pj_razon_social'] : '';
		$pj_nit = isset($data['pj_nit']) ? $data['pj_nit'] : '';
		$pj_email_notificaciones = isset($data['pj_email_notificaciones']) ? $data['pj_email_notificaciones'] : '';
		$pj_telefono = isset($data['pj_telefono']) ? $data['pj_telefono'] : '';
		$pj_direccion = isset($data['pj_direccion']) ? $data['pj_direccion'] : '';
		$pj_departamento = isset($data['pj_departamento']) ? $data['pj_departamento'] : '';
		$pj_municipio = isset($data['pj_municipio']) ? $data['pj_municipio'] : '';
		$pj_ciiu = isset($data['pj_ciiu']) ? $data['pj_ciiu'] : '';
		$pj_tipo_empresa = isset($data['pj_tipo_empresa']) ? $data['pj_tipo_empresa'] : '';
		$pj_empleados_cargo = isset($data['pj_empleados_cargo']) ? $data['pj_empleados_cargo'] : '';

		// Campos Representante Legal
		$pj_rep_apellido1 = isset($data['pj_rep_apellido1']) ? $data['pj_rep_apellido1'] : '';
		$pj_rep_apellido2 = isset($data['pj_rep_apellido2']) ? $data['pj_rep_apellido2'] : '';
		$pj_rep_nombres = isset($data['pj_rep_nombres']) ? $data['pj_rep_nombres'] : '';
		$pj_rep_id_tipo = isset($data['pj_rep_id_tipo']) ? $data['pj_rep_id_tipo'] : '';
		$pj_rep_id_numero = isset($data['pj_rep_id_numero']) ? $data['pj_rep_id_numero'] : '';
		$pj_rep_expedicion_lugar = isset($data['pj_rep_expedicion_lugar']) ? $data['pj_rep_expedicion_lugar'] : '';
		$pj_rep_expedicion_fecha = isset($data['pj_rep_expedicion_fecha']) ? $data['pj_rep_expedicion_fecha'] : '';
		$pj_rep_nacionalidad = isset($data['pj_rep_nacionalidad']) ? $data['pj_rep_nacionalidad'] : '';
		$pj_rep_fecha_nacimiento = isset($data['pj_rep_fecha_nacimiento']) ? $data['pj_rep_fecha_nacimiento'] : '';
		$pj_rep_lugar_nacimiento = isset($data['pj_rep_lugar_nacimiento']) ? $data['pj_rep_lugar_nacimiento'] : '';

		// Campos individuales para documentos - Persona Natural
		$user_cc = isset($data['user_cc']) ? $data['user_cc'] : '';
		$user_certificacion = isset($data['user_certificacion']) ? $data['user_certificacion'] : '';
		$user_declaracion = isset($data['user_declaracion']) ? $data['user_declaracion'] : '';

		// Campos individuales para documentos - Persona Jurídica
		$user_certificado_representacion = isset($data['user_certificado_representacion']) ? $data['user_certificado_representacion'] : '';
		$user_rut = isset($data['user_rut']) ? $data['user_rut'] : '';
		$user_documento_identidad = isset($data['user_documento_identidad']) ? $data['user_documento_identidad'] : '';
		$user_certificado_bancario = isset($data['user_certificado_bancario']) ? $data['user_certificado_bancario'] : '';

		// Campos adicionales para asociado jurídica
		$pj_asociado_nombres = isset($data['pj_asociado_nombres']) ? $data['pj_asociado_nombres'] : '';
		$pj_asociado_apellidos = isset($data['pj_asociado_apellidos']) ? $data['pj_asociado_apellidos'] : '';
		$pj_documento_asociado = isset($data['pj_documento_asociado']) ? $data['pj_documento_asociado'] : '';

		$query = "INSERT INTO user( 
			user_state, user_date, user_names, user_lastnames, user_email, user_level, user_user, user_password, 
			user_delete, user_current_user, user_code, user_negocio, user_accion, user_telefono, user_invitado_socio,
			persona_tipo,
			pn_nombres, pn_apellidos, pn_id_tipo, pn_documento, pn_fecha_nacimiento, pn_telefono_contacto, 
			pn_email, pn_nivel_estudio, pn_actividad, pn_departamento, pn_municipio, pn_direccion,
			pj_razon_social, pj_nit, pj_email_notificaciones, pj_telefono, pj_direccion, pj_departamento, 
			pj_municipio, pj_ciiu, pj_tipo_empresa, pj_empleados_cargo,
			pj_rep_apellido1, pj_rep_apellido2, pj_rep_nombres, pj_rep_id_tipo, pj_rep_id_numero, 
			pj_rep_expedicion_lugar, pj_rep_expedicion_fecha, pj_rep_nacionalidad, pj_rep_fecha_nacimiento, 
			pj_rep_lugar_nacimiento, user_cc, user_certificacion, user_declaracion, user_certificado_representacion,
			user_rut, user_documento_identidad, user_certificado_bancario, pj_asociado_nombres, pj_asociado_apellidos,
			pj_documento_asociado
		) VALUES ( 
			'$user_state', '$user_date', '$user_names','$user_lastnames', '$user_email', '$user_level', '$user_user', '$user_password', 
			'$user_delete', '$user_current_user', '$user_code', '$user_negocio', '$user_accion', '$user_telefono', '$user_invitado_socio',
			'$persona_tipo',
			'$pn_nombres', '$pn_apellidos', '$pn_id_tipo', '$pn_documento', '$pn_fecha_nacimiento', '$pn_telefono_contacto', 
			'$pn_email', '$pn_nivel_estudio', '$pn_actividad', '$pn_departamento', '$pn_municipio', '$pn_direccion',
			'$pj_razon_social', '$pj_nit', '$pj_email_notificaciones', '$pj_telefono', '$pj_direccion', '$pj_departamento', 
			'$pj_municipio', '$pj_ciiu', '$pj_tipo_empresa', '$pj_empleados_cargo',
			'$pj_rep_apellido1', '$pj_rep_apellido2', '$pj_rep_nombres', '$pj_rep_id_tipo', '$pj_rep_id_numero', 
			'$pj_rep_expedicion_lugar', '$pj_rep_expedicion_fecha', '$pj_rep_nacionalidad', '$pj_rep_fecha_nacimiento', 
			'$pj_rep_lugar_nacimiento', '$user_cc', '$user_certificacion', '$user_declaracion', '$user_certificado_representacion',
			'$user_rut', '$user_documento_identidad', '$user_certificado_bancario', '$pj_asociado_nombres', '$pj_asociado_apellidos',
			'$pj_documento_asociado'
		)";
		$res = $this->_conn->query($query);
		return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Usuario  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data, $id)
	{

		$user_state = $data['user_state'];
		$user_date = $data['user_date'];
		$user_names = $data['user_names'];
		$user_lastnames = $data['user_lastnames'];
		$user_email = $data['user_email'];
		$user_level = $data['user_level'];
		$user_user = $data['user_user'];
		$changepasword = '';
		if ($data['user_password'] != '') {
			$user_password = password_hash($data['user_password'], PASSWORD_DEFAULT);
			$changepasword = " , user_password = '$user_password'";
		}
		$user_delete = $data['user_delete'];
		$user_current_user = $data['user_current_user'];
		$user_code = $data['user_code'];
		$user_accion = $data['user_accion'];
		$user_telefono = $data['user_telefono'];
		$user_invitado_socio = $data['user_invitado_socio'];

		// Nuevos campos para tipo de persona
		$persona_tipo = isset($data['persona_tipo']) ? $data['persona_tipo'] : '';

		// Campos Persona Natural
		$pn_nombres = isset($data['pn_nombres']) ? $data['pn_nombres'] : '';
		$pn_apellidos = isset($data['pn_apellidos']) ? $data['pn_apellidos'] : '';
		$pn_id_tipo = isset($data['pn_id_tipo']) ? $data['pn_id_tipo'] : '';
		$pn_documento = isset($data['pn_documento']) ? $data['pn_documento'] : '';
		$pn_fecha_nacimiento = isset($data['pn_fecha_nacimiento']) ? $data['pn_fecha_nacimiento'] : '';
		$pn_telefono_contacto = isset($data['pn_telefono_contacto']) ? $data['pn_telefono_contacto'] : '';
		$pn_email = isset($data['pn_email']) ? $data['pn_email'] : '';
		$pn_nivel_estudio = isset($data['pn_nivel_estudio']) ? $data['pn_nivel_estudio'] : '';
		$pn_actividad = isset($data['pn_actividad']) ? $data['pn_actividad'] : '';
		$pn_departamento = isset($data['pn_departamento']) ? $data['pn_departamento'] : '';
		$pn_municipio = isset($data['pn_municipio']) ? $data['pn_municipio'] : '';
		$pn_direccion = isset($data['pn_direccion']) ? $data['pn_direccion'] : '';

		// Campos Persona Jurídica
		$pj_razon_social = isset($data['pj_razon_social']) ? $data['pj_razon_social'] : '';
		$pj_nit = isset($data['pj_nit']) ? $data['pj_nit'] : '';
		$pj_email_notificaciones = isset($data['pj_email_notificaciones']) ? $data['pj_email_notificaciones'] : '';
		$pj_telefono = isset($data['pj_telefono']) ? $data['pj_telefono'] : '';
		$pj_direccion = isset($data['pj_direccion']) ? $data['pj_direccion'] : '';
		$pj_departamento = isset($data['pj_departamento']) ? $data['pj_departamento'] : '';
		$pj_municipio = isset($data['pj_municipio']) ? $data['pj_municipio'] : '';
		$pj_ciiu = isset($data['pj_ciiu']) ? $data['pj_ciiu'] : '';
		$pj_tipo_empresa = isset($data['pj_tipo_empresa']) ? $data['pj_tipo_empresa'] : '';
		$pj_empleados_cargo = isset($data['pj_empleados_cargo']) ? $data['pj_empleados_cargo'] : '';

		// Campos Representante Legal
		$pj_rep_apellido1 = isset($data['pj_rep_apellido1']) ? $data['pj_rep_apellido1'] : '';
		$pj_rep_apellido2 = isset($data['pj_rep_apellido2']) ? $data['pj_rep_apellido2'] : '';
		$pj_rep_nombres = isset($data['pj_rep_nombres']) ? $data['pj_rep_nombres'] : '';
		$pj_rep_id_tipo = isset($data['pj_rep_id_tipo']) ? $data['pj_rep_id_tipo'] : '';
		$pj_rep_id_numero = isset($data['pj_rep_id_numero']) ? $data['pj_rep_id_numero'] : '';
		$pj_rep_expedicion_lugar = isset($data['pj_rep_expedicion_lugar']) ? $data['pj_rep_expedicion_lugar'] : '';
		$pj_rep_expedicion_fecha = isset($data['pj_rep_expedicion_fecha']) ? $data['pj_rep_expedicion_fecha'] : '';
		$pj_rep_nacionalidad = isset($data['pj_rep_nacionalidad']) ? $data['pj_rep_nacionalidad'] : '';
		$pj_rep_fecha_nacimiento = isset($data['pj_rep_fecha_nacimiento']) ? $data['pj_rep_fecha_nacimiento'] : '';
		$pj_rep_lugar_nacimiento = isset($data['pj_rep_lugar_nacimiento']) ? $data['pj_rep_lugar_nacimiento'] : '';

		// Campos individuales para documentos - Persona Natural
		$user_cc = isset($data['user_cc']) ? $data['user_cc'] : '';
		$user_certificacion = isset($data['user_certificacion']) ? $data['user_certificacion'] : '';
		$user_declaracion = isset($data['user_declaracion']) ? $data['user_declaracion'] : '';

		// Campos individuales para documentos - Persona Jurídica
		$user_certificado_representacion = isset($data['user_certificado_representacion']) ? $data['user_certificado_representacion'] : '';
		$user_rut = isset($data['user_rut']) ? $data['user_rut'] : '';
		$user_documento_identidad = isset($data['user_documento_identidad']) ? $data['user_documento_identidad'] : '';
		$user_certificado_bancario = isset($data['user_certificado_bancario']) ? $data['user_certificado_bancario'] : '';

		$query = "UPDATE user SET  
			user_state = '$user_state', 
			user_names = '$user_names', 
			user_lastnames = '$user_lastnames',
			user_email = '$user_email', 
			user_level = '$user_level', 
			user_user = '$user_user', 
			user_delete = '$user_delete', 
			user_current_user = '$user_current_user', 
			user_code = '$user_code', 
			user_accion = '$user_accion', 
			user_telefono = '$user_telefono', 
			user_invitado_socio = '$user_invitado_socio',
			persona_tipo = '$persona_tipo',
			pn_nombres = '$pn_nombres',
			pn_apellidos = '$pn_apellidos',
			pn_id_tipo = '$pn_id_tipo',
			pn_documento = '$pn_documento',
			pn_fecha_nacimiento = '$pn_fecha_nacimiento',
			pn_telefono_contacto = '$pn_telefono_contacto',
			pn_email = '$pn_email',
			pn_nivel_estudio = '$pn_nivel_estudio',
			pn_actividad = '$pn_actividad',
			pn_departamento = '$pn_departamento',
			pn_municipio = '$pn_municipio',
			pn_direccion = '$pn_direccion',
			pj_razon_social = '$pj_razon_social',
			pj_nit = '$pj_nit',
			pj_email_notificaciones = '$pj_email_notificaciones',
			pj_telefono = '$pj_telefono',
			pj_direccion = '$pj_direccion',
			pj_departamento = '$pj_departamento',
			pj_municipio = '$pj_municipio',
			pj_ciiu = '$pj_ciiu',
			pj_tipo_empresa = '$pj_tipo_empresa',
			pj_empleados_cargo = '$pj_empleados_cargo',
			pj_rep_apellido1 = '$pj_rep_apellido1',
			pj_rep_apellido2 = '$pj_rep_apellido2',
			pj_rep_nombres = '$pj_rep_nombres',
			pj_rep_id_tipo = '$pj_rep_id_tipo',
			pj_rep_id_numero = '$pj_rep_id_numero',
			pj_rep_expedicion_lugar = '$pj_rep_expedicion_lugar',
			pj_rep_expedicion_fecha = '$pj_rep_expedicion_fecha',
			pj_rep_nacionalidad = '$pj_rep_nacionalidad',
			pj_rep_fecha_nacimiento = '$pj_rep_fecha_nacimiento',
			pj_rep_lugar_nacimiento = '$pj_rep_lugar_nacimiento',
			user_cc = '$user_cc',
			user_certificacion = '$user_certificacion',
			user_declaracion = '$user_declaracion',
			user_certificado_representacion = '$user_certificado_representacion',
			user_rut = '$user_rut',
			user_documento_identidad = '$user_documento_identidad',
			user_certificado_bancario = '$user_certificado_bancario'
			$changepasword 
			WHERE user_id = '" . $id . "'";
		$res = $this->_conn->query($query);
	}
	public function editFielduser($user, $field, $value)
	{
		$query = ' UPDATE user SET ' . $field . ' = "' . $value . '" WHERE user_user = "' . $user . '"';
		$res = $this->_conn->query($query);
	}


	public function getInvitados($filters = '', $order = '')
	{
		$filter = '';
		if ($filters != '') {
			$filter = ' WHERE ' . $filters;
		}
		$orders = "";
		if ($order != '') {
			$orders = ' ORDER BY ' . $order;
		}
		$select = 'SELECT * FROM user LEFT JOIN socios ON socio_carnet = LPAD(user_accion, 8, "0") ' . $filter . ' ' . $orders;
		$res = $this->_conn->query($select)->fetchAsObject();
		return $res;
	}

}