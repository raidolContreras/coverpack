
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

$usuarios = ControladorFormularios::ctrSeleccionarRegistrosClientes(null, null);
?>

<?php if ($_SESSION["level"] == 1 || $_SESSION["level"] == 2): ?>

<?php else: ?>
	<script>window.location = "?pagina=perfil";</script>

<?php endif ?>

<div class="btn-group mb-1 col-12">
  <a href="?pagina=inicio" class="btn btn-primary" >Usuarios</a>
  <button type="button" href="?pagina=clientes" class="btn btn-primary" disabled>Clientes</button>
</div>

<table class="table table-striped col-12" id="myTable">
	<thead>
		<tr>
			<th>#</th>
			<th>Nombre</th>
			<th data-orderable="false" >Dirección</th>
			<th data-orderable="false" style="width: 15%">Telófono</th> 
			<th style="width: 10%">Fecha</th>
			<th data-orderable="false" style="width: 10%;"></th>
		</tr>
	</thead>

	<tbody>

	<?php foreach ($usuarios as $key => $value): ?>

		<tr>
			<td><?php echo ($key+1) ?></td>
			<td><?php echo $value["nombre"]; ?></td>
			<td><?php echo "<b>Calle:</b> ".$value["calle"]."<br><b> Colonia: </b>".$value["colonia"]; ?></td>
			<td><?php echo $value["telefono"]; ?></td>
			<td><?php echo $value["fechaRegistro"]; ?></td>
			<td>

			<div class="btn-group">

				<form method="post" action="?pagina=destinatarios">
						
					<input type="hidden" value="1" name="cli">
					<input type="hidden" value="<?php echo $value["idRegCliente"]; ?>" name="id">
					<button type="submit" class="btn btn-success col-12"><i class="fas fa-check col-12"></i></button>

				</form>			

			</div>
				

			</td>
		</tr>
		
	<?php endforeach ?>	
	
	</tbody>
	
</table>