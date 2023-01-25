
	<html lang="en"><head>

		<title>Buscar paquete</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<link rel="icon" type="image/png" href="/images/Logo.ico">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	</head>
	<style>
		.a {
			font-size: 19px;
		}
		.b {
			font-size: 12px;
		}
	</style>

	<body>

		<div class="a">
			<div class="card-body col-12">
				<div class="container-fluid  bg-light">
		
					<div class="container">

						<ul class="nav nav-item py-2 nav-pills">

								<img class="col-md-3 col-sm-12 col-xl-3" src="vistas/imagen/Logo.svg">

								<li class="nav-item b col-md-3 col-sm-12 col-xl-3">
									Uruapan, Michoacán. CP 60000<br>
									Avenida de las Américas 4A.<br>
									Col. Centro. <br><br>


									<b style="font-size: 10px">Agencia:</b> <i style="font-size: 15px"><?php print $usuarios["agencia"];?><br></i>
								</li>

								<li class="nav-item b col-md-3 col-sm-12 col-xl-3">
									<b>Tel: </b> (452) 14 8 78 38<br>
									<b>E-mail: </b>gerencia@coberpack.com <br><br><br>


									<b style="font-size: 10px">N° Guía:</b> <i style="font-size: 15px"><?php print $usuarios["n_guia"]; ?><br></i>
								</li>

								<li class="nav-item b col-md-3 col-sm-12 col-xl-3">
									<strong>Fecha: </strong><?php print $usuarios["fecha_agencia"]; ?><br><br>
									<b class="a">Sitio Web: coberpack.com</b>
								</li>

							</ul>
						</div>
					</div>
				<div class="row justify-content-center">
					<div class="col-md-4 text-right"><strong>Servicio: </strong><?php print $usuarios["tipo_servicio"]; ?></div>
					<div class="col-md-4 text-center"><strong>Track: </strong><?php print $usuarios["track"]; ?></div>
					<div class="col-md-4 text-left"><strong>Provedor: </strong><?php print $usuarios["provedor"]; ?></div>
				</div>

			</div>
			<div class="row text-uppercase ">
				<div class="col-md-6">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-bordered">
							<thead class="thead-dark">
								<tr>
									<th scope="col">Remitente</th>
									<th scope="col"><?php print $usuarios["nombre"]; ?></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<strong>Dirección: </strong>
									</td>
									<td>
										<?php print $usuarios["direccion"]; ?>
									</td>
								</tr>
										
								<tr>
									<td style="text-align: justify;">
										<strong>Colonia: </strong><br>
										<strong>Municipio: </strong><br>
										<strong>Estado: </strong><br>
										<strong>CP: </strong><br>
										<strong>Telefono: </strong>
									</td>
									<td>
										<?php print $usuarios["colonia"]; ?><br>
										<?php print $usuarios["ciudad"]; ?><br>
										<?php print $usuarios["estado"]; ?><br>
										<?php print $usuarios["cp"]; ?><br>
										<?php print $usuarios["telefono"]; ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

				<div class="col-md-6">
					<div class="table-responsive">
						<table class="table table-hover table-bordered">
							<thead class="thead-dark">
								<tr>
									<th scope="col">Destinatario</th>
									<th scope="col"><?php print $usuarios["nombre_des"]; ?></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<strong>Dirección: </strong>
									</td>
									<td>
										<?php print $usuarios["direccion_des"]; ?>
									</td>
								</tr>
								<tr>
									<td style="text-align: justify;">
										<strong>Colonia: </strong><br>
										<strong>Municipio: </strong><br>
										<strong>Estado: </strong><br>
										<strong>CP: </strong><br>
										<strong>Telefono: </strong>
									</td>
									<td>
										<?php print $usuarios["colonia_des"]; ?><br>
										<?php print $usuarios["ciudad_des"]; ?><br>
										<?php print $usuarios["estado_des"]; ?><br>
										<?php print $usuarios["cp_des"]; ?><br>
										<?php print $usuarios["tel_des"]; ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-12">
					<table class="table table-hover table-bordered table-bordered">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Dimenciones</th>
								<th scope="col" style="width: 500px">Contenido</th>
								<th scope="col">Costo</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="font-size: 16px;">
									<?php print "Peso Fisico: ".$usuarios["peso_fisico"]." kg"; ?><br>
									<?php print "Peso Volumen: ".$usuarios["peso_volumen"]." kg"; ?><br>
									<?php print "Dimenciones: ".$usuarios["largo"]." x ".$usuarios["alto"]." x ".$usuarios["ancho"]." cm"; ?>
								</td>
								<td style="font-size: 15px; text-transform: uppercase; text-align: justify;">

									<?php print $usuarios["observaciones"]; ?>
									
								</td>
								<td colspan="2">
									<?php print "Costo: $".$usuarios["costo"]; ?>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="d-flex justify-content-center text-center">
								FIRMA <BR><BR>
								______________________________________
					</div>
				</div>
			</div>
		</div>