
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
	<!--=====================================
	PLUGINS DE JS
	======================================-->	

	<!-- jQuery library -->
	<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<?php
$cli = $_POST['cli'];
$id = $_POST['id'];
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

<div class="row justify-content-center">
    <h3 class="col-5 ">No agregar destinatario</h3>
        <form class="" method="post" action="?pagina=envios">
    			
    		<input type="hidden" value="<?php echo $cli; ?>" name="cli">
    		<input type="hidden" value="<?php echo $id; ?>" name="id">
    		<button type="submit" class="btn btn-danger"><i class="fas fa-ban"></i></button>
    
    	</form>	
</div>


<table class="table table-striped col-12" id="myTable">
	<thead>
		<tr>
			<th>#</th>
			<th>Nombre</th>
			<th data-orderable="false" >Dirección</th>
			<th data-orderable="false" style="width: 15%">Telófono</th> 
			<th style="width: 10%">Fecha</th>
			<th></th>
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

				<form method="post" action="?pagina=envios">
						
					<input type="hidden" value="<?php echo $id; ?>" name="id">
					<input type="hidden" value="2" name="cli">
					<input type="hidden" value="<?php echo $value["idRegCliente"]; ?>" name="dest">
					<button type="submit" class="btn btn-info"><i class="fas fa-check"></i></button>

				</form>			

			</div>
				

			</td>
		</tr>
		
	<?php endforeach ?>	
	
	</tbody>
	
</table>