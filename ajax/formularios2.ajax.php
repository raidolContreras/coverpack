<?php

require_once "../controladores/formularios.controlador.php";
require_once "../modelos/formularios.modelo.php";

/*=============================================
Clase de AJAX
=============================================*/

class AjaxFormulario{

	/*=============================================
	VALIDAR EMAIL EXISTENTE
	=============================================*/	
	public $validarGuia;

	public function ajaxValidarGuia(){

		$item = "numero";
		$valor = $this->validarGuia;

		$respuesta = ControladorFormularios::ctrSeleccionarGuia($item, $valor);
		echo json_encode($respuesta);
	}

}

/*=============================================
Objeto de AJAX que recibe la variable POST
=============================================*/

if(isset($_POST["validarGuia"])){

	$valGuia = new AjaxFormulario();
	$valGuia -> validarGuia = $_POST["validarGuia"];
	$valGuia -> ajaxValidarGuia();

}
