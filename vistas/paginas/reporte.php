
	<title>COBERPACK</title>
<?php
$id = $_GET['numero'];
$usuarios = ControladorFormularios::ctrSeleccionarPedidos3($id);
?>
<div id="printableArea">
<?php include "consulta.php"; ?>

<hr style="color: #000; height: 0px; border:1px dashed;" />

<?php include "consulta.php"; ?>
</div>

<input type="button" class="btn btn-success col-12" onclick="printDiv('printableArea')" value="Imprimir" />

<script>
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}</script>
