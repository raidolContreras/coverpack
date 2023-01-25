<?php

if(!isset($_SESSION["validarIngreso"])){

	echo '<script>window.location = "?pagina=pedidos";</script>';

	return;

}else{

	if($_SESSION["validarIngreso"] != "ok"){

		echo '<script>window.location = "?pagina=pedidos";</script>';

		return;
	}

}


?>

<?php if ($_SESSION["level"] != 1): ?>
	<script>window.location = "?pagina=pedidos";</script>
<?php endif ?>

<?php if ($_SESSION["level"] == 1): ?>
	<div class="d-flex">
		<hr class="my-auto flex-grow-1">
  			<button type="button" href="" class="btn btn-primary" disabled>Registro Usuarios</button>
		<hr class="my-auto flex-grow-1">
		<hr class="my-auto flex-grow-1">
  			<a href="?pagina=registrarClientes" class="btn btn-primary">Registro Clientes</a>
		<hr class="my-auto flex-grow-1">
	</div>
	<div class="d-flex justify-content-center">

		<div class="col-lg-4 col-md-5 text-center">


			<form class="p-5 bg-light" method="post">

				<div class="form-group">
					<label for="nombre">Nombre Completo:</label>

					<div class="input-group">

						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="fas fa-user"></i>
							</span>
						</div>

						<input type="text" class="form-control" id="nombre" name="nombreR">

					</div>

				</div>

				<div class="form-group">

					<label for="email">Correo electrónico:</label>

					<div class="input-group">

						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="fas fa-envelope"></i>
							</span>
						</div>

						<input type="email" class="form-control" id="email" name="registroEmail">

					</div>

				</div>

				<div class="form-group">

					<label for="Level">Rango:</label>

					<div class="input-group">

						<select name="level" class="custom-select">
							<option selected>Selecciona el tipo</option>
							<option value="1">Administrador</option>
							<option value="2">Empleado</option>
							<option value="3">Agencia</option>
						</select>

					</div>

				</div>

				<div class="form-group">
					<label for="pwd">Contraseña:</label>

					<div class="input-group">

						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="fas fa-lock"></i>
							</span>
						</div>

						<input type="password" class="form-control" id="pwd" name="registroPassword">

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

$registro = ControladorFormularios::ctrRegistro();

if($registro == "ok"){

	echo '<script>

	if ( window.history.replaceState ) {

		window.history.replaceState( null, null, window.location.href );

	}

	</script>';

	echo '<div class="alert alert-success">El usuario ha sido registrado</div>';

}

if($registro == "error"){

	echo '<script>

	if ( window.history.replaceState ) {

		window.history.replaceState( null, null, window.location.href );

	}

	</script>';

	echo '<div class="alert alert-danger">Error, no se permiten caracteres especiales</div>';

}

?>

<input type="submit" class="btn btn-success" value="Registrar">

</form>

</div>

<?php else: 

	echo '<script>window.location = "?pagina=inicio";</script>';

	return;
	?>


<?php endif ?>


</div>