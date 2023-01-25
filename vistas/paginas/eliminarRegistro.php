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
if (!isset($_GET['numero'])) {
	echo "<script>window.location = '?pagina=pedidos';</script>";
}else{

	$id=$_GET['numero'];

		$usuarios = ControladorFormularios::ctrEliminarPedido($id);

}

?>

<script>window.location = "?pagina=pedidos";</script>