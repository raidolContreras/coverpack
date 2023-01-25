<?php

class ControladorFormularios{

	/*=============================================
	Registro
	=============================================*/

	static public function ctrRegistro(){

		if(isset($_POST["nombreR"])){

			if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreR"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["registroEmail"]) &&
			   preg_match('/^[0-9a-zA-Z]+$/', $_POST["registroPassword"])){

				$tabla = "usuarios";

				$token = md5($_POST["nombreR"]."+".$_POST["registroEmail"]);

				$encriptarPassword = crypt($_POST["registroPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datos = array("token" => $token,
								"nombre" => $_POST["nombreR"],
					           "email" => $_POST["registroEmail"],
					           "level" => $_POST["level"],
					           "password" => $encriptarPassword);

				$respuesta = ModeloFormularios::mdlRegistro($tabla, $datos);

				return $respuesta;

			}else{

				$respuesta = "error";

				return $respuesta;

			}

		}

	}

	/*=============================================
	Registro Cliente
	=============================================*/

	static public function ctrRegistroClientes(){

		if(isset($_POST["nombreR"])){

			if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreR"])){

				$tabla = "registroclientes";

				$datos = array("nombre" => $_POST["nombreR"],
								"calle" => $_POST["calleR"],
								"colonia" => $_POST["coloniaR"],
								"exterior" => $_POST["exteriorR"],
								"interior" => $_POST["interiorR"],
								"ciudad" => $_POST["ciudadR"],
								"estado" => $_POST["estadoR"],
								"cp" => $_POST["cpR"],
								"telefono" => $_POST["telefonoR"]
				);

				$respuesta = ModeloFormularios::mdlRegistroClientes($tabla, $datos);

				return $respuesta;

				echo "<br>".$_POST['nombreR'];
				echo "<br>".$_POST['calleR'];
				echo "<br>".$_POST['coloniaR'];
				echo "<br>".$_POST['exteriorR'];
				echo "<br>".$_POST['interiorR'];
				echo "<br>".$_POST['ciudadR'];
				echo "<br>".$_POST['estadoR'];
				echo "<br>".$_POST['cpR'];
				echo "<br>".$_POST['telefonoR'];
			}else{

				$respuesta = "error";

				return $respuesta;

			}

		}

	}

	/*=============================================
	Seleccionar Registros
	=============================================*/

	static public function ctrSeleccionarRegistros($item, $valor){

		$tabla = "usuarios";

		$respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	Seleccionar Registros Clientes
	=============================================*/

	static public function ctrSeleccionarRegistrosClientes($item, $valor){

		$tabla = "registroclientes";

		$respuesta = ModeloFormularios::mdlSeleccionarRegistrosClientes($tabla, $item, $valor);
			
		return $respuesta;

	}

	/*=============================================
	Ingreso
	=============================================*/

	public function ctrIngreso(){

		if(isset($_POST["ingresoEmail"])){

			$tabla = "usuarios";
			$item = "email";
			$valor = $_POST["ingresoEmail"];

			$respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);

			$encriptarPassword = crypt($_POST["ingresoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			if($respuesta["email"] == $_POST["ingresoEmail"] && $respuesta["password"] == $encriptarPassword){

				ModeloFormularios::mdlActualizarIntentosFallidos($tabla, 0, $respuesta["token"]);

				$_SESSION["validarIngreso"] = "ok";
				$_SESSION["token"] = $respuesta["token"];
				$_SESSION["level"] = $respuesta["level"];
				$_SESSION["status"] = $respuesta["status"];
				$_SESSION["id"] = $respuesta["id"];
				$_SESSION["nombre"] = $respuesta["nombre"];

				echo '<script>

					if ( window.history.replaceState ) {

						window.history.replaceState( null, null, window.location.href );

					}

					window.location = "?pagina=pedidos";

				</script>';

			}else{

				if($respuesta["intentos_fallidos"] < 3){

					$tabla = "usuarios";

					$intentos_fallidos = $respuesta["intentos_fallidos"]+1;
					
					ModeloFormularios::mdlActualizarIntentosFallidos($tabla, $intentos_fallidos, $respuesta["token"]);

				}else{

					echo '<div class="alert alert-warning">RECAPTCHA Debes validar que no eres un robot</div>';

				}
			
				echo '<script>

					if ( window.history.replaceState ) {

						window.history.replaceState( null, null, window.location.href );

					}

				</script>';

				echo '<div class="alert alert-danger">Error al ingresar al sistema, el email o la contraseña no coinciden</div>';
			}
			
			

		}

	}

	/*=============================================
	Actualizar Registro
	=============================================*/
	static public function ctrActualizarRegistro(){

		if(isset($_POST["actualizarNombre"])){


			if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["actualizarNombre"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["actualizarEmail"])){

				$usuario = ModeloFormularios::mdlSeleccionarRegistros("usuarios", "token", $_POST["tokenUsuario"]);

				$compararToken = md5($usuario["nombre"]."+".$usuario["email"]);
				if($compararToken == $_POST["tokenUsuario"] && $_POST["idUsuario"] == $usuario["id"]){
					
					if($_POST["actualizarPassword"] != ""){

						if(preg_match('/^[0-9a-zA-Z]+$/', $_POST["actualizarPassword"])){

							$password = crypt($_POST["actualizarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

						}

					}else{

						$password = $_POST["passwordActual"];
					}

					$tabla = "usuarios";

					$actualizarToken = md5($_POST["actualizarNombre"]."+".$_POST["actualizarEmail"]);

					$datos = array( "id" => $_POST["idUsuario"],
									"token" => $actualizarToken,
									"nombre" => $_POST["actualizarNombre"],
									"telefono" => $_POST["actualizarTelefono"],
						           "email" => $_POST["actualizarEmail"],
						           "password" => $password);

					$respuesta = ModeloFormularios::mdlActualizarRegistro($tabla, $datos);

					return $respuesta;

				}else{

					$respuesta = "error";

					return $respuesta;

				}

			}else{

				$respuesta = "error";

				return $respuesta;

			}
	

		}


	}

	/*=============================================
	Eliminar Registro
	=============================================*/
	public function ctrEliminarRegistro(){

		if(isset($_POST["eliminarRegistro"])){

			$usuario = ModeloFormularios::mdlSeleccionarRegistros("usuarios", "token",  $_POST["eliminarRegistro"]);

			$compararToken = md5($usuario["nombre"]."+".$usuario["email"]);

			if($compararToken == $_POST["eliminarRegistro"]){

				$tabla = "usuarios";
				$valor = $_POST["eliminarRegistro"];

				$respuesta = ModeloFormularios::mdlEliminarRegistro($tabla, $valor);

				if($respuesta == "ok"){

					echo '<script>

						if ( window.history.replaceState ) {

							window.history.replaceState( null, null, window.location.href );

						}

						window.location = "?pagina=inicio";

					</script>';

				}

			}
		

		}

	}

	/*=============================================
	Activar Registro
	=============================================*/
	public function ctrActivarRegistro(){

		if(isset($_POST["activarRegistro"])){

			$usuario = ModeloFormularios::mdlSeleccionarRegistros("usuarios", "token",  $_POST["activarRegistro"]);

			$compararToken = md5($usuario["nombre"]."+".$usuario["email"]);

			if($compararToken == $_POST["activarRegistro"]){

				$tabla = "usuarios";
				$valor = $_POST["activarRegistro"];

				$respuesta = ModeloFormularios::mdlActivarRegistro($tabla, $valor);

				if($respuesta == "ok"){

					echo '<script>

						if ( window.history.replaceState ) {

							window.history.replaceState( null, null, window.location.href );

						}

						window.location = "?pagina=inicio";

					</script>';

				}

			}
		

		}

	}

	/*=============================================
	Registrar envios
	=============================================*/

	public function ctrRegistrarEnvios(){
		if(isset($_POST["nombreR"])){

			$tabla = "cliente";
			/*revisa si hay algo escrito en interior*/
			if ($_POST["interiorR"] != "") {
				$direccion = $_POST["calleR"]." ".$_POST["exteriorR"]." Interior: ".$_POST["interiorR"];
			}else{
				$direccion = $_POST["calleR"]." ".$_POST["exteriorR"];
			}

			if ($_POST["interiorD"] != "") {
				$direccionD = $_POST["calleD"]." ".$_POST["exteriorD"]." Interior: ".$_POST["interiorD"];
			}else{
				$direccionD = $_POST["calleD"]." ".$_POST["exteriorD"];
			}

			$datos = array("nombreR" => $_POST["nombreR"],
				           "direccionR" => $direccion,
				           "coloniaR" => $_POST["coloniaR"],
				           "estadoR" => $_POST["estadoR"],
				           "ciudadR" => $_POST["ciudadR"],
				           "cpR" => $_POST["cpR"],
				           "telefonoR" => $_POST["telefonoR"],
			/*tabla envio*/"nGuia" => $_POST['nomenclarura'].$_POST["nGuia"],
				           "servicio" => $_POST["servicio"],
/*tabla detalles de envio*/"agencia" => $_POST["agencia"],
				           "numero" => $_POST["nGuia"],
				           "nomenclatura" => $_POST['nomenclarura'],
				           "peso" => $_POST["peso"],
				           "volumen" => ($_POST["largo"]*$_POST["alto"]*$_POST["ancho"])/5000,
				           "largo" => $_POST["largo"],
				           "ancho" => $_POST["ancho"],
				           "alto" => $_POST["alto"],
				           "costo" => $_POST["costo"],
				           "costo_agencia" => $_POST["precio"],
				           "forma_pago" => $_POST["forma_pago"],
				           "fecha" => $_POST["fecha"],
				           "comentarios" => $_POST["comentarios"],
				           "nombreD" => $_POST["nombreD"],
				           "direccionD" => $direccionD,
				           "coloniaD" => $_POST["coloniaD"],
				           "estadoD" => $_POST["estadoD"],
				           "ciudadD" => $_POST["ciudadD"],
				           "cpD" => $_POST["cpD"],
				           "telefonoD" => $_POST["telefonoD"]

				       );

			$respuesta = ModeloFormularios::mdlRegistrarEnvios($tabla, $datos);			
			return $respuesta;

		}
	}

	/*=============================================
	Actualizar registro de envio
	=============================================*/

	static public function ctrActualizarEnvios($id){
		if(isset($_POST["nombreR"])){

			$datos = array("nombreR" => $_POST["nombreR"],
				           "direccionR" => $_POST['calleR'],
				           "coloniaR" => $_POST["coloniaR"],
				           "estadoR" => $_POST["estadoR"],
				           "ciudadR" => $_POST["ciudadR"],
				           "cpR" => $_POST["cpR"],
				           "telefonoR" => $_POST["telefonoR"],

						   "nGuia" => $_POST["nGuia"],
				           "servicio" => $_POST["servicio"],

						   "agencia" => $_POST["agencia"],
				           "peso" => $_POST["peso"],
				           "volumen" => ($_POST["largo"]*$_POST["alto"]*$_POST["ancho"])/5000,
				           "largo" => $_POST["largo"],
				           "ancho" => $_POST["ancho"],
				           "alto" => $_POST["alto"],
				           "costo" => $_POST["costo"],
				           "costo_agencia" => $_POST["precio"],
				           "forma_pago" => $_POST["forma_pago"],
				           "fecha" => $_POST["fecha"],
				           "comentarios" => $_POST["comentarios"],

				           "nombreD" => $_POST["nombreD"],
				           "direccionD" => $_POST['calleD'],
				           "coloniaD" => $_POST["coloniaD"],
				           "estadoD" => $_POST["estadoD"],
				           "ciudadD" => $_POST["ciudadD"],
				           "cpD" => $_POST["cpD"],
				           "telefonoD" => $_POST["telefonoD"]/**/

				       );

			$respuesta = ModeloFormularios::mdlActualizarEnvios($id, $datos);			
			return $respuesta;
		}

	}
	/*=============================================
	Seleccionar track
	=============================================*/

	static public function ctrSeleccionarTrack($busqueda){


		$respuesta = ModeloFormularios::mdlSeleccionarTrack($busqueda);

		return $respuesta;

	}
	
	/*=============================================
	Seleccionar Registros de Pedidos
	=============================================*/

	static public function ctrSeleccionarPedidos($busqueda){

		$tabla = "provedor";

		$respuesta = ModeloFormularios::mdlSeleccionarPedidos($busqueda);

		return $respuesta;

	}

	/*=============================================
	Contador
	=============================================*/

	static public function ctrContador(){

		$respuesta = ModeloFormularios::mdlContador();

		return $respuesta;

	}

	/*=============================================
	Seleccionar Registros de Pedidos Distribuidor
	=============================================*/

	static public function ctrSeleccionarPedidos2($item, $valor){

		$respuesta = ModeloFormularios::mdlSeleccionarPedidos2($item, $valor);

		return $respuesta;

	}

	/*=============================================
	Seleccionar Registros de Pedidos Especifico
	=============================================*/

	static public function ctrSeleccionarPedidos3($item){

		$respuesta = ModeloFormularios::mdlSeleccionarPedidos3($item);

		return $respuesta;

	}

	/*=============================================
	Seleccionar Registros por fechas
	=============================================*/

	static public function ctrSeleccionarPedidosFecha($del, $hasta){

		$respuesta = ModeloFormularios::mdlSeleccionarPedidosFecha($del, $hasta);

		return $respuesta;

	}

	/*=============================================
	Registrar envios
	=============================================*/

	public function ctrActualizarTrack(){

		if(isset($_POST["actualizarTrack"])){

			$tabla = "provedor";

			$datos = array("id" => $_POST["id"],
			           "track" => $_POST["actualizarTrack"],
			           "provedor" => $_POST["actualizarProveedor"],
			           "comentario" => $_POST["actualizarComentario"]
			       );
			$respuesta = ModeloFormularios::mdlActualizarTrack($tabla, $datos);			
			return $respuesta;
		}

	}

	/*=============================================
	Eliminar Pedido
	=============================================*/

	static public function ctrEliminarPedido($id){

		$respuesta = ModeloFormularios::mdlEliminarPedido($id);

		return $respuesta;

	}

	/*=============================================
	Seleccionar guia
	=============================================*/

	static public function ctrSeleccionarGuia($item, $valor){
		$tabla = "envio";
		$respuesta = ModeloFormularios::mdlSeleccionarGuia($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	Seleccionar guia
	=============================================*/

	static public function ctrSeleccionarGuia2(){

		$respuesta = ModeloFormularios::mdlSeleccionarGuia2();

		return $respuesta;

	}
	/*=============================================
	Seleccionar Country
	=============================================*/

	static public function ctrCountry(){

		$respuesta = ModeloFormularios::mdlCountry();

		return $respuesta;

	}



}