
	<title>COBERPACK REPORTE</title>
    <style>
        table th {
		  text-align: center;
		}
		table tr {
		  text-align: center;
		}
		.btn-default {
		  box-shadow: 1px 2px 5px #000000;
		}
	</style>


<input type="button" class="btn btn-success col-12" onclick="printDiv()" value="Imprimir" />

<div id='DivIdToPrint'>
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
$del = $_POST['d1'];
$hasta = $_POST['d2'];

	$usuarios = ControladorFormularios::ctrSeleccionarPedidosFecha($del, $hasta);
$total = 0;
$total2 = 0;
?>
<?php if ($_SESSION["level"]!=1): ?>
	<script>window.location = "?pagina=pedidos";</script>
<?php endif ?>
<div class="mr-7">
<table class="table table-striped table-bordered display" >
	<thead style="font-size:9px;">
		<tr>
			<th>Remitente</th>
			<th >Datos Remitente</th>
			<th >Agencia</th>
			<th >Fecha</th>
			<th >Guia y servicio</th>
			<th >Datos del paquete</th>
			<th >Destinatario</th>
			<th >Datos del destinatario</th>
			<th >Contenido</th>
			<th >Track y Proveedor</th>
			<th >Costo Cliente</th>
			<th >Costo Agencia</th>
		</tr>
	</thead>

	<tbody style="font-size:11px;">

	<?php foreach ($usuarios as $key => $value): ?>

		<tr style="height: 70px;">
			<td>
				<?php print $value["nombre"]; ?>
			</td>

			<td style="font-size:9px; text-align: justify;">
				    <?php print $value["direccion"]; ?>
				    <?php print $value["colonia"]; ?>
				    <?php print $value["ciudad"]; ?>
				    <?php print $value["estado"]; ?>
				    <?php print $value["cp"]; ?>
				    <?php print $value["telefono"]; ?>
			</td>

			<td>
				<?php print $value["agencia"];?>
			</td>

			<td>
				<?php print $value["fecha_agencia"]; ?>
			</td>

			<td style="font-size: 10px">
				<?php print $value["n_guia"]."<br>Servicio: ".$value["tipo_servicio"]; ?>
			</td>

			<td style="font-size:9px; text-align: justify;">
				<?php print "Peso Fisico: ".$value["peso_fisico"]." kg"; ?><br>
				<?php print "Peso Volumen: ".$value["peso_volumen"]." kg"; ?>
				<?php print "Dimenciones: ".$value["largo"]." x ".$value["alto"]." x ".$value["ancho"]." cm"; ?>
				<?php print "Tipo de pago: ".$value["forma_pago"]; ?>
			</td>

			<td>
				<?php print $value["nombre_des"]; ?>
			</td>

			<td style="font-size:9px; text-align: justify;">
				<?php print $value["direccion_des"]; ?>
				<?php print $value["colonia_des"]; ?>
				<?php print $value["ciudad_des"]; ?>
				<?php print $value["estado_des"]; ?>
				<?php print $value["cp_des"]; ?>
				<?php print $value["tel_des"]; ?>
			</td>

			<td style="text-align: justify;">
				  <?php print $value["observaciones"]; ?>
			</td>

			<td>
				<?php print $value["track"]; ?><br>
				<?php print $value["provedor"]; ?>
			</td>

			<td>
				<?php print "$".$value["costo"]; $total=$total+$value["costo"];?>
			</td>
			
			<td>
				<?php print "$".$value["costo_agencia"]; $total2=$total2+$value["costo_agencia"];?>
			</td>
		</tr>
	<?php endforeach ?>	
	
		<tr>
			<td colspan="10" style="text-align: right; font-size: 20px"><B>TOTAL</B></td>
			<td>$<?php echo $total; ?> MXN</td>
			<td>$<?php echo $total2; ?> MXN</td>
		</tr>
	</tbody>
	
</table>
</div>

<script>function printDiv() 
{

     var divToPrint=document.getElementById('DivIdToPrint');

     var newWin=window.open('','Print-Window');

     newWin.document.open();

     newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

     newWin.document.close();

     setTimeout(function(){newWin.close();},10);

}</script>

  </body>
</html>
