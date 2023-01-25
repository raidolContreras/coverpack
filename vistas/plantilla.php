<?php 
header('Content-Type: text/html; charset=utf-8');
session_start();
$title='';
?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="shortcut icon" href="vistas/imagen/Logo.svg" />
	<!--=====================================
	PLUGINS DE CSS
	======================================-->	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

	<!-- Latest compiled Fontawesome-->
	<script src="https://kit.fontawesome.com/e632f1f723.js" crossorigin="anonymous"></script>
	
</head>
<style>
	
	input[type=number]::-webkit-inner-spin-button, 
	input[type=number]::-webkit-outer-spin-button { 
	  -webkit-appearance: none; 
	  margin: 0; 
	}

	input[type=number] { -moz-appearance:textfield; }

</style>
<body>

	<!--=====================================
	LOGOTIPO
	======================================-->

	<div class="container-fluid">
		
		<h3 class="text-center py-3"><img src="vistas/imagen/Logo.svg" height="110" width="auto"></h3>

	</div>

	<!--=====================================
	BOTONERA
	======================================-->

	<div class="container-fluid  bg-light">
		
		<div class="container">

			<ul class="nav nav-justified py-2 nav-pills">
			
			<?php if (isset($_SESSION['level'])): ?>

				<!-- -->

				<?php if ($_GET["pagina"] == "pedidos"): ?>

					<title>COBERPACK PEDIDOS</title>
					<li class="nav-item">
						<a class="nav-link active" href="?pagina=pedidos">Pedidos</a>
					</li>
				
				<?php else: ?>

					<li class="nav-item">
						<a class="nav-link" href="?pagina=pedidos">Pedidos</a>
					</li>
					
				<?php endif ?>

				<!-- -->

				<?php if ($_SESSION['level'] == 1): ?>

					<!-- -->

					<?php if ($_GET['pagina'] == 'envios'): ?>
					<title>COBERPACK ENVIOS</title>

						<li class="nav-item">
							<a class="nav-link active" href="?pagina=envios">Registrar Envios</a>
						</li>
						
					<?php else: ?>
						
						<li class="nav-item">
							<a class="nav-link" href="?pagina=envios">Registrar Envios</a>
						</li>

					<?php endif ?>

					<!-- -->

					<?php if ($_GET['pagina'] == 'inicio' || $_GET['pagina'] == 'clientes'): ?>
					<title>COBERPACK</title>

						<li class="nav-item">
							<a class="nav-link active" href="?pagina=inicio">Lista de usuarios</a>
						</li>
						
					<?php else: ?>
						
						<li class="nav-item">
							<a class="nav-link" href="?pagina=inicio">Lista de usuarios</a>
						</li>

					<?php endif ?>

					<!-- -->

					<?php if ($_GET['pagina'] == 'registro' || $_GET['pagina'] == 'registrarClientes' ): ?>
					<title>COBERPACK REGISTRO</title>

						<li class="nav-item">
							<a class="nav-link active" href="?pagina=registro">Registrar usuarios</a>
						</li>
						
					<?php else: ?>
						
						<li class="nav-item">
							<a class="nav-link" href="?pagina=registro">Registrar usuarios</a>
						</li>

					<?php endif ?>

				<?php endif ?>

				<!-- -->

				<?php if ($_SESSION['level'] == 2): ?>

					<!-- -->

					<?php if ($_GET['pagina'] == 'envios'): ?>
					<title>COBERPACK ENVIOS</title>

						<li class="nav-item">
							<a class="nav-link active" href="?pagina=envios">Registrar Envios</a>
						</li>
						
					<?php else: ?>
						
						<li class="nav-item">
							<a class="nav-link" href="?pagina=envios">Registrar Envios</a>
						</li>

					<?php endif ?>
					
				<?php endif ?>

				<!-- -->

				<?php if ($_SESSION['level'] == 3): ?>
					

					<?php if ($_GET['pagina'] == 'envios'): ?>
					<title>COBERPACK ENVIOS</title>

						<li class="nav-item">
							<a class="nav-link active" href="?pagina=envios">Registrar Envios</a>
						</li>
						
					<?php else: ?>
						
						<li class="nav-item">
							<a class="nav-link" href="?pagina=envios">Registrar Envios</a>
						</li>

					<?php endif ?>
					
				<?php endif ?>

				
				<!-- -->

				<!-- -->
				<?php if ($_GET["pagina"] == "perfil"): ?>
					<title>PERFIL</title>

					<li class="nav-item">
						<a class="nav-link active" href="?pagina=perfil">Perfil</a>
					</li>
				
				<?php else: ?>

					<li class="nav-item">
						<a class="nav-link" href="?pagina=perfil">Perfil</a>
					</li>
					
				<?php endif ?>

				<li class="nav-item">
					<a class="nav-link" href="?pagina=salir">salir</a>
				</li>
				
			<?php else: ?>
					<title>COBERPACK</title>

				<li class="nav-item">
					<a class="nav-link" href="?pagina=ingreso">INICIA SESIÓN</a>
				</li>

			<?php endif ?>

			</ul>

		</div>

	</div>

	<!--=====================================
	CONTENIDO
	======================================-->

	<div class="">
		
		<div class="container py-3">

			<?php 

				#ISSET: isset() Determina si una variable está definida y no es NULL

				if(isset($_GET["pagina"])){

					if($_GET["pagina"] == "registro" ||
					   $_GET["pagina"] == "ingreso" ||
					   $_GET["pagina"] == "inicio" ||
					   $_GET["pagina"] == "editar" ||
					   $_GET["pagina"] == "pedidos" ||
					   $_GET["pagina"] == "perfil" ||
					   $_GET["pagina"] == "envios" ||
					   $_GET["pagina"] == "distribuidor" ||
					   $_GET["pagina"] == "reporte" ||
					   $_GET["pagina"] == "reportefecha" ||
					   $_GET["pagina"] == "eliminarRegistro" ||
					   $_GET["pagina"] == "registrarClientes" ||
					   $_GET["pagina"] == "clientes" ||
					   $_GET["pagina"] == "actualizarEnvios" ||
					   $_GET["pagina"] == "destinatarios" ||
					   $_GET["pagina"] == "salir"){

						include "paginas/".$_GET["pagina"].".php";

					}else{
						echo "<title>ERROR 404</title>";

						include "paginas/error404.php";
					}


				}else{

					include "paginas/ingreso.php";

				}

			?>

		</div>

	</div>


<script>
	$.extend( true, $.fn.dataTable.defaults, {
	    "info": false
	} );

	$(document).ready(function() {

    $('#myTable').DataTable( {
        "scrollX": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        "lengthMenu": [[20, 50, 100], [20, 50, 100]],
        "dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>'
    } );

    $('#myTable2').DataTable( {
    	"searching": false,
        "scrollX": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        "lengthMenu": [[20, 50, 100], [20, 50, 100]],
        "dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>'
    } );
    
} );

</script>
<script src="vistas/js/script.js"></script>
<script src="vistas/js/scriptGuia.js"></script>
<script>
	$('.input-number').on('input', function () { 
	    this.value = this.value.replace(/[^0-9]/g,'');
	});
	$('.input-lether').on('input', function () { 
	    this.value = this.value.replace(/[^aA-zZ]/g,'');
	});
</script>
    
</body>
</html>