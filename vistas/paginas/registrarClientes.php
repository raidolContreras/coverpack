<!-- Registro clientes -->

	<div class="d-flex">
		<hr class="my-auto flex-grow-1">
  			<a href="?pagina=registro" class="btn btn-primary">Registro Usuarios</a>
		<hr class="my-auto flex-grow-1">
		<hr class="my-auto flex-grow-1">
  			<button type="button" href="" class="btn btn-primary" disabled>Registro Cliente</button>
		<hr class="my-auto flex-grow-1">
	</div>

	<form class="p-5 bg-light" method="post">

		<div class="row pb-3">

			<div class="col-md-12 pb-3">
				<label for="Nombre"><h7>Nombre Completo*</h7></label>
				<input type="text" class="form-control" name="nombreR" required>
			</div>

			<div class="col-md-6 pb-3">
				<label for="calle"><h7>Calle*</h7></label>
				<input type="text" class="form-control" name="calleR" required>
			</div>

			<div class="col-md-6 pb-3">
				<label for="colonia"><h7>Colonia*</h7></label>
				<input type="text" class="form-control" name="coloniaR" required>
			</div>

			<div class="col-md-3 pb-3">
				<label for="exterior"><h7>N° exterior*</h7></label>
				<input type="text" class="form-control" name="exteriorR" required>
			</div>

			<div class="col-md-3 pb-3">
				<label for="interior"><h7>N° interior</h7></label>
				<input type="text" class="form-control" name="interiorR">
			</div>

			<div class="col-md-6 pb-3">
				<label for="ciudad"><h7>Ciudad*</h7></label>
				<input type="text" class="form-control" name="ciudadR" required>
			</div>

			<div class="col-md-4 pb-3">
				<label for="estado"><h7>Estado*</h7></label>
				<input type="text" class="form-control" name="estadoR" required>
			</div>

			<div class="col-md-4 pb-3">
				<label for="cp"><h7>C.P.*</h7></label>
				<input type="number" class="form-control" name="cpR" required>
			</div>

			<div class="col-md-4">
				<label for="telefono"><h7>Teléfono*</h7></label>
				<input type="number" class="form-control" name="telefonoR" required>
			</div>

		</div>

		<?php 

/*=============================================
FORMA EN QUE SE INSTANCIA LA CLASE DE UN MÉTODO NO ESTÁTICO 
=============================================*/

// $registro = new ControladorFormularios();
// $registro -> ctrRegistro();

/*=============================================
FORMA EN QUE SE INSTANCIA LA CLASE DE UN MÉTODO ESTÁTICO 
=============================================*/

$registroClientes = ControladorFormularios::ctrRegistroClientes();

if($registroClientes == "ok"){

	echo '<script>

	if ( window.history.replaceState ) {

		window.history.replaceState( null, null, window.location.href );

	}

	</script>';

	echo '<div class="alert alert-success">El Cliente ha sido registrado</div>';

}

if($registroClientes == "error"){

	echo '<script>

	if ( window.history.replaceState ) {

		window.history.replaceState( null, null, window.location.href );

	}

	</script>';

	echo '<div class="alert alert-danger">Error, no se permiten caracteres especiales</div>';

}

?>
<button type="submit" class="btn btn-success">Registrar Cliente</button>

</form>
