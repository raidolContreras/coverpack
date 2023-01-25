<?php

require_once "conexion.php";

class ModeloFormularios{

	/*=============================================
	Registro
	=============================================*/

	static public function mdlRegistro($tabla, $datos){

		#statement: declaración

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(token, nombre, email, level, password) VALUES (:token, :nombre, :email, :level, :password)");

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stmt->bindParam(":token", $datos["token"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":level", $datos["level"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;	

	}

	/*=============================================
	Seleccionar Registros
	=============================================*/

	static public function mdlSeleccionarRegistros($tabla, $item, $valor){

		if($item == null && $valor == null){

			$stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(updated_at, '%d/%m/%Y') AS updated_at FROM $tabla ORDER BY id DESC");

			$stmt->execute();

			return $stmt -> fetchAll();

		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(updated_at, '%d/%m/%Y') AS updated_at FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt -> fetch();
		}

		$stmt->close();

		$stmt = null;	

	}

	/*=============================================
	Seleccionar Registros
	=============================================*/

	static public function mdlSeleccionarRegistrosClientes($tabla, $item, $valor){

		if($item == null && $valor == null){

			$stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(fechaRegistro, '%d/%m/%Y') AS fechaRegistro  FROM $tabla ORDER BY idRegCliente DESC");

			$stmt->execute();

			return $stmt -> fetchAll();

		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $valor = $item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt -> fetch();
		}

		$stmt->close();

		$stmt = null;	

	}

	/*=============================================
	Actualizar Registro
	=============================================*/

	static public function mdlActualizarRegistro($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET token = :token, nombre=:nombre, email=:email, telefono=:telefono, password=:password WHERE id = :id");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":token", $datos["token"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;	

	}

	/*=============================================
	Eliminar Registro
	=============================================*/
	static public function mdlEliminarRegistro($tabla, $valor){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET status = 0 WHERE token = :token");
		$stmt->bindParam(":token", $valor, PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;	
	}

	/*=============================================
	Eliminar Pedido
	=============================================*/
	static public function mdlEliminarPedido($id){
	
		$stmt = Conexion::conectar()->prepare("DELETE FROM cliente WHERE cliente.id_cliente = $id");
		$stmt->bindParam(":token", $valor, PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;	
	}

	/*=============================================
	Activar Registro
	=============================================*/
	static public function mdlActivarRegistro($tabla, $valor){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET status = 1 WHERE token = :token");
		$stmt->bindParam(":token", $valor, PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;	
	}

	/*=============================================
	Actualizar Intentos fallidos
	=============================================*/

	static public function mdlActualizarIntentosFallidos($tabla, $valor, $token){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET intentos_fallidos=:intentos_fallidos WHERE token = :token");
		$stmt->bindParam(":intentos_fallidos", $valor, PDO::PARAM_INT);
		$stmt->bindParam(":token", $token, PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";
		}else{
			print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;
	}

	/*=============================================
	Registro envios
	=============================================*/

	static public function mdlRegistrarEnvios($tabla, $datos){
		
		# La nomenclatura   .=    se utiliza para sobreescribir el string anterior por el mismo concatenando el nuevo
		
		$sql = "INSERT INTO cliente(nombre, direccion, colonia, estado, ciudad, cp, telefono) VALUES (:nombreR, :direccionR, :coloniaR, :estadoR, :ciudadR, :cpR, :telefonoR);";

		$sql.= "INSERT INTO envio(id_cliente_envio, n_guia, tipo_servicio) VALUES ((SELECT MAX(id_cliente) FROM cliente),:nGuia, :servicio);";

		$sql.= "INSERT INTO detalle_envio(id_envio_detalle, observaciones, peso_fisico, largo, ancho, alto, peso_volumen, costo, costo_agencia, forma_pago, agencia, fecha_agencia) VALUES ((SELECT MAX(id_envio) FROM envio),:comentarios, :peso, :largo, :ancho, :alto, :volumen, :costo, :costo_agencia, :forma_pago, :agencia, :fecha);";

		$sql.= "INSERT INTO destinatario(id_envio_des, nombre_des, direccion_des, colonia_des, estado_des, ciudad_des, cp_des, tel_des) VALUES ((SELECT MAX(id_envio) FROM envio),:nombreD, :direccionD, :coloniaD, :estadoD, :ciudadD, :cpD, :telefonoD);";

		$sql.= "INSERT INTO provedor(id_envio_p) VALUES ((SELECT id_envio FROM envio ORDER BY id_envio DESC LIMIT 1));";

		$sql.= "INSERT INTO gen_guia(nomenclatura, numero) VALUES (:nomenclatura, :numero);";


		$stmt = Conexion::conectar()->prepare($sql);


			$stmt->bindParam(":nombreR", $datos["nombreR"], PDO::PARAM_STR);
			$stmt->bindParam(":direccionR", $datos["direccionR"], PDO::PARAM_STR);
			$stmt->bindParam(":coloniaR", $datos["coloniaR"], PDO::PARAM_STR);
			$stmt->bindParam(":estadoR", $datos["estadoR"], PDO::PARAM_STR);
			$stmt->bindParam(":ciudadR", $datos["ciudadR"], PDO::PARAM_STR);
			$stmt->bindParam(":cpR", $datos["cpR"], PDO::PARAM_STR);
			$stmt->bindParam(":telefonoR", $datos["telefonoR"], PDO::PARAM_STR);/*datos remitente*/

			$stmt->bindParam(":nGuia", $datos["nGuia"], PDO::PARAM_STR);
			$stmt->bindParam(":servicio", $datos["servicio"], PDO::PARAM_STR);/*datos envio*/

			$stmt->bindParam(":peso", $datos["peso"], PDO::PARAM_STR);
			$stmt->bindParam(":volumen", $datos["volumen"], PDO::PARAM_STR);
			$stmt->bindParam(":largo", $datos["largo"], PDO::PARAM_STR);
			$stmt->bindParam(":ancho", $datos["ancho"], PDO::PARAM_STR);
			$stmt->bindParam(":alto", $datos["alto"], PDO::PARAM_STR);
			$stmt->bindParam(":costo", $datos["costo"], PDO::PARAM_STR);
			$stmt->bindParam(":costo_agencia", $datos["costo_agencia"], PDO::PARAM_STR);
			$stmt->bindParam(":forma_pago", $datos["forma_pago"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
			$stmt->bindParam(":agencia", $datos["agencia"], PDO::PARAM_STR);
			$stmt->bindParam(":comentarios", $datos["comentarios"], PDO::PARAM_STR);/*detalles envio*/

			$stmt->bindParam(":nombreD", $datos["nombreD"], PDO::PARAM_STR);
			$stmt->bindParam(":direccionD", $datos["direccionD"], PDO::PARAM_STR);
			$stmt->bindParam(":coloniaD", $datos["coloniaD"], PDO::PARAM_STR);
			$stmt->bindParam(":estadoD", $datos["estadoD"], PDO::PARAM_STR);
			$stmt->bindParam(":ciudadD", $datos["ciudadD"], PDO::PARAM_STR);
			$stmt->bindParam(":cpD", $datos["cpD"], PDO::PARAM_STR);
			$stmt->bindParam(":telefonoD", $datos["telefonoD"], PDO::PARAM_STR);/*datos destinatarios*/

			$stmt->bindParam(":nomenclatura", $datos["nomenclatura"], PDO::PARAM_STR);
			$stmt->bindParam(":numero", $datos["numero"], PDO::PARAM_INT);/*nomenclatura y numero*/

		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;	

	}
	

	/*=============================================
	Registro envios
	=============================================*/

	static public function mdlActualizarEnvios($id, $datos){
		
		# La nomenclatura   .=    se utiliza para sobreescribir el string anterior por el mismo concatenando el nuevo
	
		$sql = "UPDATE cliente SET nombre = :nombreR, direccion = :direccionR, colonia = :coloniaR, ciudad = :ciudadR, estado = :estadoR, cp = :cpR, telefono = :telefonoR WHERE id_cliente = $id;";

		$sql .="UPDATE envio SET n_guia= :nGuia, tipo_servicio = :servicio WHERE id_cliente_envio = $id;";

		$sql .="UPDATE detalle_envio SET observaciones = :comentarios ,peso_fisico = :peso ,largo = :largo ,ancho = :ancho ,alto = :alto ,peso_volumen = :volumen ,costo = :costo ,costo_agencia = :costo_agencia ,agencia = :agencia ,fecha_agencia = :fecha ,forma_pago = :forma_pago WHERE id_envio_detalle = $id;";

		$sql .= "UPDATE  destinatario  SET nombre_des = :nombreD , direccion_des = :direccionD , colonia_des = :coloniaD , ciudad_des = :ciudadD , estado_des = :estadoD , cp_des = :cpD , tel_des = :telefonoD  WHERE  id_envio_des  = $id;";

		$stmt = Conexion::conectar()->prepare($sql);


			$stmt->bindParam(":nombreR", $datos["nombreR"], PDO::PARAM_STR);
			$stmt->bindParam(":direccionR", $datos["direccionR"], PDO::PARAM_STR);
			$stmt->bindParam(":coloniaR", $datos["coloniaR"], PDO::PARAM_STR);
			$stmt->bindParam(":estadoR", $datos["estadoR"], PDO::PARAM_STR);
			$stmt->bindParam(":ciudadR", $datos["ciudadR"], PDO::PARAM_STR);
			$stmt->bindParam(":cpR", $datos["cpR"], PDO::PARAM_STR);
			$stmt->bindParam(":telefonoR", $datos["telefonoR"], PDO::PARAM_STR);

			$stmt->bindParam(":nGuia", $datos["nGuia"], PDO::PARAM_STR);
			$stmt->bindParam(":servicio", $datos["servicio"], PDO::PARAM_STR);

			$stmt->bindParam(":comentarios", $datos["comentarios"], PDO::PARAM_STR);
			$stmt->bindParam(":peso", $datos["peso"], PDO::PARAM_STR);
			$stmt->bindParam(":largo", $datos["largo"], PDO::PARAM_STR);
			$stmt->bindParam(":ancho", $datos["ancho"], PDO::PARAM_STR);
			$stmt->bindParam(":alto", $datos["alto"], PDO::PARAM_STR);
			$stmt->bindParam(":volumen", $datos["volumen"], PDO::PARAM_STR);
			$stmt->bindParam(":costo", $datos["costo"], PDO::PARAM_STR);
			$stmt->bindParam(":costo_agencia", $datos["costo_agencia"], PDO::PARAM_STR);
			$stmt->bindParam(":agencia", $datos["agencia"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
			$stmt->bindParam(":forma_pago", $datos["forma_pago"], PDO::PARAM_STR);

			$stmt->bindParam(":nombreD", $datos["nombreD"], PDO::PARAM_STR);
			$stmt->bindParam(":direccionD", $datos["direccionD"], PDO::PARAM_STR);
			$stmt->bindParam(":coloniaD", $datos["coloniaD"], PDO::PARAM_STR);
			$stmt->bindParam(":estadoD", $datos["estadoD"], PDO::PARAM_STR);
			$stmt->bindParam(":ciudadD", $datos["ciudadD"], PDO::PARAM_STR);
			$stmt->bindParam(":cpD", $datos["cpD"], PDO::PARAM_STR);
			$stmt->bindParam(":telefonoD", $datos["telefonoD"], PDO::PARAM_STR);/**/


		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;	

	}
	

	/*=============================================
	Seleccionar Registros maximo
	=============================================*/

	static public function mdlContador(){

			$stmt = Conexion::conectar()->prepare("SELECT COUNT(id_cliente) FROM cliente");

			if($stmt->execute()){

			return $stmt -> fetch();

			}else{

				print_r(Conexion::conectar()->errorInfo());

			}


		$stmt->close();

		$stmt = null;	

	}

	/*=============================================
	Seleccionar Registros
	=============================================*/

	static public function mdlSeleccionarPedidos($busqueda){

		if ($busqueda == null) {

			$sql = "SELECT * FROM cliente a INNER JOIN envio b INNER JOIN detalle_envio c INNER JOIN destinatario d INNER JOIN provedor p WHERE a.id_cliente = b.id_cliente_envio and b.id_envio = c.id_envio_detalle AND b.id_envio = d.id_envio_des AND b.id_envio = p.id_envio_p ORDER BY id_cliente DESC LIMIT 0, 60";

			$stmt = Conexion::conectar()->prepare($sql);

			$stmt->execute();

			return $stmt -> fetchAll();

		}else{

			$sql = "SELECT * FROM cliente a INNER JOIN envio b INNER JOIN detalle_envio c INNER JOIN destinatario d INNER JOIN provedor p WHERE a.id_cliente = b.id_cliente_envio and b.id_envio = c.id_envio_detalle AND b.id_envio = d.id_envio_des AND b.id_envio = p.id_envio_p and (nombre like '%$busqueda%' OR agencia like'%$busqueda%' OR n_guia like '%$busqueda%' OR nombre_des like '%$busqueda%' OR track like '%$busqueda%' OR provedor like '%$busqueda%') ORDER BY id_cliente DESC";

			$stmt = Conexion::conectar()->prepare($sql);

			$stmt->execute();

			return $stmt -> fetchAll();

		}

		$stmt->close();

		$stmt = null;	

	}

	/*=============================================
	Seleccionar Registros Distribuidores
	=============================================*/

	static public function mdlSeleccionarPedidos2($item, $valor){

		if($valor == null) {

			$sql = "SELECT * FROM cliente a INNER JOIN envio b INNER JOIN detalle_envio c INNER JOIN destinatario d INNER JOIN provedor p WHERE a.id_cliente = b.id_cliente_envio and b.id_envio = c.id_envio_detalle AND b.id_envio = d.id_envio_des AND b.id_envio = p.id_envio_p and c.agencia = '$item' ORDER BY id_cliente DESC LIMIT 0, 60 ";

			$stmt = Conexion::conectar()->prepare($sql);

			$stmt->execute();

			return $stmt -> fetchAll();

		}else{
			
			$sql = "SELECT * FROM cliente a INNER JOIN envio b INNER JOIN detalle_envio c INNER JOIN destinatario d INNER JOIN provedor p WHERE a.id_cliente = b.id_cliente_envio and b.id_envio = c.id_envio_detalle AND b.id_envio = d.id_envio_des AND b.id_envio = p.id_envio_p and c.agencia = '$item' and (nombre like '%$valor%' OR agencia like'%$valor%' OR n_guia like '%$valor%' OR nombre_des like '%$valor%' OR track like '%$valor%' OR provedor like '%$valor%') ORDER BY id_cliente DESC";

			$stmt = Conexion::conectar()->prepare($sql);

			$stmt->execute();

			return $stmt -> fetchAll();
		}

		$stmt->close();

		$stmt = null;	

	}


	/*=============================================
	Seleccionar Registros para pdf
	=============================================*/

	static public function mdlSeleccionarPedidos3($item){

		if($item != null) {

			$sql = "SELECT * FROM cliente a INNER JOIN envio b INNER JOIN detalle_envio c INNER JOIN destinatario d INNER JOIN provedor p WHERE a.id_cliente = b.id_cliente_envio and b.id_envio = c.id_envio_detalle AND b.id_envio = d.id_envio_des AND b.id_envio = p.id_envio_p and a.id_cliente = '$item'";

			$stmt = Conexion::conectar()->prepare($sql);

			$stmt->execute();

			return $stmt -> fetch();

		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM provedor");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt -> fetch();
		}

		$stmt->close();

		$stmt = null;	

	}

	/*=============================================
	Seleccionar Registros por fechas
	=============================================*/

	static public function mdlSeleccionarPedidosFecha($del, $hasta){

		if($del != null) {

			$sql = "SELECT * FROM cliente a INNER JOIN envio b INNER JOIN detalle_envio c INNER JOIN destinatario d INNER JOIN provedor p WHERE (c.fecha_agencia BETWEEN '$del' AND '$hasta') AND a.id_cliente = b.id_cliente_envio and b.id_envio = c.id_envio_detalle AND b.id_envio = d.id_envio_des AND b.id_envio = p.id_envio_p ORDER BY c.fecha_agencia ASC";

			$stmt = Conexion::conectar()->prepare($sql);

			$stmt->execute();

			return $stmt -> fetchAll();

		}

		$stmt->close();

		$stmt = null;	

	}

	/*=============================================
	Seleccionar Track
	=============================================*/

	static public function mdlSeleccionarTrack($busqueda){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM `provedor` WHERE `id_prov` = $busqueda");

			if($stmt->execute()){

			return $stmt -> fetch();

			}else{

				print_r(Conexion::conectar()->errorInfo());

			}


		$stmt->close();

		$stmt = null;	

	}


	/*=============================================
	Actualizar Registro
	=============================================*/

	static public function mdlActualizarTrack($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET track=:track, provedor=:provedor, comentario=:comentario WHERE id_prov = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
		$stmt->bindParam(":track", $datos["track"], PDO::PARAM_STR);
		$stmt->bindParam(":provedor", $datos["provedor"], PDO::PARAM_STR);
		$stmt->bindParam(":comentario", $datos["comentario"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;	

	}



	/*=============================================
	Registro Clientes
	=============================================*/

	static public function mdlRegistroClientes($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO registroclientes(nombre, calle, colonia, exterior, interior, ciudad, estado, cp, telefono) VALUES (:nombre, :calle, :colonia, :exterior, :interior, :ciudad, :estado, :cp, :telefono)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":calle", $datos["calle"], PDO::PARAM_STR);
		$stmt->bindParam(":colonia", $datos["colonia"], PDO::PARAM_STR);
		$stmt->bindParam(":exterior", $datos["exterior"], PDO::PARAM_STR);
		$stmt->bindParam(":interior", $datos["interior"], PDO::PARAM_STR);
		$stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":cp", $datos["cp"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt->close();

		$stmt = null;	

	}

	/*=============================================
	Seleccionar Registros
	=============================================*/

	static public function mdlSeleccionarGuia($tabla, $item, $valor){

			$stmt = Conexion::conectar()->prepare("SELECT n_guia FROM $tabla WHERE n_guia LIKE '%$valor'");

			if($stmt->execute()){

			return $stmt -> fetch();

			}else{

				print_r(Conexion::conectar()->errorInfo());

			}


		$stmt->close();

		$stmt = null;	

	}

	/*=============================================
	Seleccionar Registros maximo
	=============================================*/

	static public function mdlSeleccionarGuia2(){

			$stmt = Conexion::conectar()->prepare("SELECT MAX(numero) FROM gen_guia");

			if($stmt->execute()){

			return $stmt -> fetch();

			}else{

				print_r(Conexion::conectar()->errorInfo());

			}


		$stmt->close();

		$stmt = null;	

	}
	
	
	
	/*=============================================
	Seleccionar Country
	=============================================*/


	static public function mdlCountry(){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM country");

		$stmt->execute();

		return $stmt -> fetchAll();

	}

}