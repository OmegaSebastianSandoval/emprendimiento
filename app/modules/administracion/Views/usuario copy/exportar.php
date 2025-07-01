<head>
  <meta charset="UTF-8">
</head>

<div class="container">
		<table width="100%" border="1">
			<tr>
				<th>Fecha de creción</th>
				<th>Nombres</th>
				<th>Nivel</th>
				<th>Usuario</th>
				<th>Correo</th>
				<th>Teléfono</th>
				<th>Persona que lo invito</th>
				<th>Numero de acción</th>
				<th>Estado</th>
			</tr>
			<?php foreach ($this->usuarios as $key => $value): ?>
				<tr>
					<td><?php echo ($value->user_date); ?></td>
					<td><?php echo ($value->user_names); ?></td>
					<td><?php echo ($this->list_user_level[$value->user_level]); ?></td>
					<td><?php echo ($value->user_user); ?></td>
					<td><?php echo ($value->user_email); ?></td>
					<td><?php echo ($value->user_telefono); ?></td>
					<td><?php echo ($value->user_invitado_socio); ?></td>
					<td><?php echo ($value->user_accion); ?></td>
					<td><?php echo ($this->list_user_state[$value->user_state]); ?></td>
				
				</tr>
			<?php endforeach ?>
		</table>
</div>