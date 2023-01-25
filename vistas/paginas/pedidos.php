
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
if (isset($_SESSION["validarIngreso"])) {
	if($_SESSION["status"] != "1"){
		echo "<script type='text/javascript'>alert('Usuario Eliminado'); window.location = '?pagina=salir';</script>";
	}
}

//Inicio del Contador

	$contador = ControladorFormularios::ctrContador();
	$num_total_rows = $contador['COUNT(id_cliente)'];

//Fin del Contador

if ($num_total_rows > 0) {
    $page = false;

    //examino la pagina a mostrar y el inicio del registro a mostrar
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    }

    if (!$page) {
        $start = 0;
        $page = 1;
    } else {
        $start = ($page - 1) * 50;
        echo $start;
    }
}

if ($_SESSION["level"]==3) {

	if (isset($_POST['busqueda'])) {

		$usuarios = ControladorFormularios::ctrSeleccionarPedidos2($_SESSION["nombre"], $_POST['busqueda']);

	}else{

		$usuarios = ControladorFormularios::ctrSeleccionarPedidos2($_SESSION["nombre"], null);

	}

}else{

	if (isset($_POST['busqueda'])) {

		$usuarios = ControladorFormularios::ctrSeleccionarPedidos($_POST['busqueda']);

	}else{

		$usuarios = ControladorFormularios::ctrSeleccionarPedidos(null);

	}

}
?>
	<div class="container-fluid  bg-light">
<?php if ($_SESSION["level"]==1): ?>
			
		<form action="?pagina=reportefecha" method="post">
			<div class="container d-flex justify-content-center text-center">

				<ul class="nav nav-justified py-2 nav-pills">

						<li class="nav-item">
							Del: <input type="date" class="form-control" name="d1">
						</li>

						<li class="nav-item">
							Hasta: <input type="date" class="form-control" name="d2">
						</li>

						<li class="nav-item mt-4 col-4">
							<input class="btn btn-primary align-content-end" type="submit" value="Buscar">
						</li>
				</ul>
			</div>
		</form>
<?php endif ?>

			
		<form action="" method="post">
			<div class="container d-flex justify-content-center text-center">

				<ul class="nav nav-justified py-2 nav-pills">

						<li class="nav-item">
							<input type="text" class="form-control" name="busqueda">
						</li>


						<li class="nav-item">
							<input class="btn btn-info " type="submit" value="Buscar">
						</li>
				</ul>
			</div>
		</form>
	</div>
	
<table class="row-border" id="myTable2" data-order="[[ 3, &quot;desc&quot; ]]" >
	<thead style="font-size:9px;">
		<tr>
			<th>Remitente</th>
			<th data-orderable="false">Datos Remitente</th>
			<th>Agencia</th>
			<th>Fecha</th>
			<th>Guia y servicio</th>
			<th data-orderable="false">Datos del paquete</th>
			<th>Destinatario</th>
			<th data-orderable="false">Datos del destinatario</th>
			<th data-orderable="false">Contenido</th>
			<th>Track</th>
			<th>Proveedor</th>
			<th data-orderable="false">Acciones</th>
			<th data-orderable="false">Eliminar</th>
		</tr>
	</thead>

	<tbody style="font-size:11px;">

	<?php foreach ($usuarios as $key => $value): ?>

		<tr style="height: 70px;">
			<td>
				<?php print $value["nombre"]; ?>
			</td>

			<td>
				<div class="dropdown">
				  <button class="btn btn-light dropdown-toggle btn-sm" type="button" data-toggle="dropdown" style="color: black;"><i class="fas fa-address-card"></i>
				  <span class="caret"></span></button>
				  <ul class="dropdown-menu" style="font-size:11px; text-align: justify;">
				    <li><?php print $value["direccion"]; ?></li>
				    <li><?php print $value["colonia"]; ?></li>
				    <li><?php print $value["ciudad"]; ?></li>
				    <li><?php print $value["estado"]; ?></li>
				    <li><?php print $value["cp"]; ?></li>
				    <li><?php print $value["telefono"]; ?></li>
				  </ul>
				</div>
			</td>

			<td>
				<?php print $value["agencia"];?>
			</td>

			<td>
				<?php print $value["fecha_agencia"]; ?>
			</td>

			<td>
				<?php print $value["n_guia"]."<br>Servicio: ".$value["tipo_servicio"]; ?>
			</td>

			<td>
				<div class="dropdown">
				  <button class="btn btn-light dropdown-toggle btn-sm" type="button" data-toggle="dropdown" style="color: black;"><i class="fas fa-box-open"></i>
				  <span class="caret"></span></button>
				  <ul class="dropdown-menu" style="font-size:11px;">
				    <li><?php print "Peso Fisico: ".$value["peso_fisico"]." kg"; ?></li>
				    <li><?php print "Peso Volumen: ".$value["peso_volumen"]." kg"; ?></li>
				    <li><?php print "Dimenciones: ".$value["largo"]." x ".$value["alto"]." x ".$value["ancho"]." cm"; ?></li>
				    <li><?php print "Costo: $".$value["costo"]; ?></li>
				    <li><?php print "Costo neto: $".$value["costo_agencia"]; ?></li>
				    <li><?php print "Tipo de pago: ".$value["forma_pago"]; ?></li>
				  </ul>
				</div>
			</td>

			<td>
				<?php print $value["nombre_des"]; ?>
			</td>

			<td>
				<div class="dropdown">
				  <button class="btn btn-light dropdown-toggle btn-sm" type="button" data-toggle="dropdown" style="color: black;"><i class="far fa-address-card"></i>
				  <span class="caret"></span></button>
				  <ul class="dropdown-menu" style="font-size:11px;">
				    <li><?php print $value["direccion_des"]; ?></li>
				    <li><?php print $value["colonia_des"]; ?></li>
				    <li><?php print $value["ciudad_des"]; ?></li>
				    <li><?php print $value["estado_des"]; ?></li>
				    <li><?php print $value["cp_des"]; ?></li>
				    <li><?php print $value["tel_des"]; ?></li>
				  </ul>
				</div>
			</td>

			<td>
				<div class="dropdown">
					<?php if ($value["observaciones"] == null): ?>
				  <button class="btn btn-light dropdown-toggle btn-sm" type="button" data-toggle="dropdown" disabled="" style="color: black;"><i class="far fa-eye-slash"></i>
				  <span class="caret"></span></button>
				  <ul class="dropdown-menu">
				    <li>
				    	<?php else: ?>

				  <button class="btn btn-light dropdown-toggle btn-sm" type="button" data-toggle="dropdown" style="color: black;"><i class="far fa-eye"></i>
				  <span class="caret"></span></button>
				  <ul class="dropdown-menu" style="font-size:11px;">
				    <li><?php print $value["observaciones"]; ?></li>

				    <?php endif ?>

				  </ul>
				</div>
			</td>

			<td>
				<?php print $value["track"]; ?>
			</td>

			<td>
				<?php print $value["provedor"]; ?>
			</td>

			<td>

				<div class="btn-group">

					<div class="px-1">
					<?php if ($value["comentario"]==''): ?>
						<a href="index.php?pagina=distribuidor&token=<?php echo $value["id_prov"]; ?>"  data-toggle="tooltip" title="Editar track"  class="btn btn-warning btn-sm">
							<i class="fas fa-pencil-alt">
							</i>
						</a>
					<?php else: ?>
						<a href="index.php?pagina=distribuidor&token=<?php echo $value["id_prov"]; ?>" data-toggle="tooltip" title="Editar track" class="btn btn-success btn-sm">
							<i class="fas fa-pencil-alt">
							</i>
						</a>
					<?php endif ?>

					</div>		
					<div class="px-1">
				<a class="btn btn-secondary btn-sm" data-toggle="tooltip" title="Editar datos" href="index.php?pagina=actualizarEnvios&id=<?php print $value["id_cliente"]; ?>"><i class="far fa-edit"></i></a>
					</div>	

				<a class="btn btn-info btn-sm" data-toggle="tooltip" title="imprimir" href="index.php?pagina=reporte&numero=<?php print $value["id_cliente"]; ?>"><i class="fas fa-print"></i></a>
				</div>
				
			</td>
			<td>	
				<a class="btn btn-danger btn-sm" data-toggle="tooltip" title="Eliminar" href="index.php?pagina=eliminarRegistro&numero=<?php print $value["id_cliente"]; ?>"><i class="fas fa-trash"></i></a>
			</td>
		</tr>
	<?php endforeach ?>	
	
	</tbody>
	
</table>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>