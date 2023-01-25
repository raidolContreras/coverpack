
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
	<!--=====================================
	PLUGINS DE JS
	======================================-->	

	<!-- jQuery library -->
	<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<?php

if(!isset($_SESSION["validarIngreso"])){

	echo '<script>window.location = "?pagina=ingreso";</script>';

	return;

}else{

	if($_SESSION["validarIngreso"] != "ok"){

		echo '<script>window.location = "?pagina=ingreso";</script>';

		return; 
	}
	
}

$usuarios = ControladorFormularios::ctrSeleccionarRegistros(null, null);
?>

<div class="btn-group mb-1 col-12">
  <button type="button" href="?pagina=inicio" class="btn btn-primary" disabled>Usuarios</button>
  <a href="?pagina=clientes" class="btn btn-primary">Clientes</a>
</div>
<?php if ($_SESSION["level"] == 1 || $_SESSION["level"] == 2): ?>

<?php else: ?>
	<script>window.location = "?pagina=perfil";</script>

<?php endif ?>

<table class="table table-striped" id="myTable">
	<thead>
		<tr>
			<th>#</th>
			<th>Nombre</th>
			<th>Email</th>
			<th>Cargo</th>
			<th>Fecha</th>
			<th>Status</th>
			<th data-orderable="false">Acciones</th>
		</tr>
	</thead>

	<tbody>

	<?php foreach ($usuarios as $key => $value): ?>

		<tr>
			<td><?php echo ($key+1); ?></td>
			<td><?php echo $value["nombre"]; ?></td>
			<td><?php echo $value["email"]; ?></td>
			<td><?php switch ($value["level"]) {
						case '1':
							echo "Administrador";
							break;
						case '2':
							echo "Empleado";
							break;
						case '3':
							echo "Agencia";
							break;
						
						default:
							echo "No identificado";
							break;
						}
			?></td>
			<td><?php echo $value["updated_at"]; ?></td>
			<td><?php switch ($value["status"]) {
						case '1':
							echo "<div class='alert alert-success'>Activo</div>";
							break;						
						default:
							echo "<div class='alert alert-danger'>Desactivo</div>";
							break;
						}
			?></td>
			<td>

			<div class="btn-group">

				<div class="px-1">
				
				<a href="index.php?pagina=editar&token=<?php echo $value["token"]; ?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>

				</div>

				<form method="post">
					<?php if ($value["status"] != 1): ?>
						
					<input type="hidden" value="<?php echo $value["token"]; ?>" name="activarRegistro">
					<button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>

					<?php
						$eliminar = new ControladorFormularios();
						$eliminar -> ctrActivarRegistro();
					?>

					<?php else: ?>
					<input type="hidden" value="<?php echo $value["token"]; ?>" name="eliminarRegistro">
					<button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>

					<?php

						$eliminar = new ControladorFormularios();
						$eliminar -> ctrEliminarRegistro();

					?>

					<?php endif ?>
					

				</form>			

			</div>
				

			</td>
		</tr>
		
	<?php endforeach ?>	
	
	</tbody>
	
</table>