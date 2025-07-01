<head>
  <meta charset="UTF-8">
</head>

<div class="container">
		<table width="100%" border="1">
			<tr>
				<th>Usuario</th>
				<th>Fecha</th>
			</tr>
			<?php foreach ($this->tiendas as $key => $value): ?>
				<tr>
					<td><?php echo ($value->usuario); ?></td>
					<td><?php echo ($value->fecha); ?> <?php echo ($value->hora); ?></td>
				
				</tr>
			<?php endforeach ?>
		</table>
</div>