<meta charset="UTF-8">
<style>
	.progress{
    width: 150px;
    height: 150px;
    line-height: 150px;
    background: none;
    margin: 0 auto;
    box-shadow: none;
    position: relative;
}
/* .progress:after{
    content: "";
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 12px solid #fff;
    position: absolute;
    top: 0;
    left: 0;
} */
.progress > span{
    width: 50%;
    height: 100%;
    overflow: hidden;
    position: absolute;
    top: 0;
    z-index: 1;
}
/* .progress .progress-left{
    left: 0;
} */
.progress .progress-bar{
    width: 100%;
    height: 100%;
    background: none;
    border-width: 12px;
    border-style: solid;
    position: absolute;
    top: 0;
}
.progress .progress-left .progress-bar{
    left: 100%;
    border-top-right-radius: 80px;
    border-bottom-right-radius: 80px;
    border-left: 0;
    -webkit-transform-origin: center left;
    transform-origin: center left;
}
.progress .progress-right{
    right: 0;
}
.progress .progress-right .progress-bar{
    left: -100%;
    border-top-left-radius: 80px;
    border-bottom-left-radius: 80px;
    border-right: 0;
    -webkit-transform-origin: center right;
    transform-origin: center right;
    animation: loading-1 0.5s linear forwards;
}
.progress .progress-value{
    width: 90%;
    height: 90%;
    border-radius: 50%;
    background: #44484b;
    font-size: 16px;
    color: #fff;
    line-height: 135px;
    text-align: center;
    position: absolute;
    top: 5%;
    left: 5%;
}
.progress.blue .progress-bar{
    border-color: #049dff;
}
.progress.blue .progress-left .progress-bar{
    animation: loading-2 0.5s linear 0.5s forwards;
}

@keyframes loading-1{
    0%{
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100%{
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg);
    }
}
@keyframes loading-2{
    0%{
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100%{
        -webkit-transform: rotate(170deg);
        transform: rotate(180deg);
    }
}

@media only screen and (max-width: 990px){
    .progress{ margin-bottom: 20px; }
}

</style>
<?php

if(isset($_SESSION["id"])){

	$item = "id";
	$valor = $_SESSION["id"];

	$usuario = ControladorFormularios::ctrSeleccionarRegistros($item, $valor);

}


if(!isset($_SESSION["validarIngreso"])){

	echo '<script>window.location = "?pagina=ingreso";</script>';

	return;

}else{

	if($_SESSION["validarIngreso"] != "ok"){

		echo '<script>window.location = "?pagina=ingreso";</script>';

		return;
	}
	
}


?>
        <div class="modal js-loading-bar">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body">

                <div class="progress blue">
                  <span class="progress-left">
                    <span class="progress-bar"></span>
                  </span>
                  <span class="progress-right">
                    <span class="progress-bar"></span>
                  </span>
                  <div class="progress-value">Actualizando</div>
                </div>

              </div>
            </div>
          </div>
      </div>



      <script>// Setup
this.$(".js-loading-bar").modal({
  backdrop: "static",
  show: false
});

function dale() {
  var $modal = $(".js-loading-bar"),
      $bar = $modal.find(".progress");
  
  $modal.modal("show");
  $bar.addClass("animate");

  setTimeout(function() {
    $bar.removeClass("animate");
    $modal.modal("hide");
    window.history.back();
  }, 1000);
};
</script>

<div class="d-flex justify-content-center text-center">

	<form class="p-5 bg-light" method="post">

		<div class="form-group">

			<div class="input-group">
				
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fas fa-user"></i>
					</span>
				</div>

				<input type="text" class="form-control" value="<?php echo $usuario["nombre"]; ?>" placeholder="Escriba su nombre" id="actualizarNombre" name="actualizarNombre">

			</div>
			
		</div>

		<div class="form-group">

			<div class="input-group">
				
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fas fa-user"></i>
					</span>
				</div>

				<input type="text" class="form-control" value="<?php echo $usuario["telefono"]; ?>" placeholder="Escriba su Telefono" id="actualizarTelefono" name="actualizarTelefono">

			</div>
			
		</div>

		<div class="form-group">

			<div class="input-group">
				
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fas fa-envelope"></i>
					</span>
				</div>

				<input type="email" class="form-control" value="<?php echo $usuario["email"]; ?>" placeholder="Escriba su email" id="actualizarEmail" name="actualizarEmail">
			
			</div>
			
		</div>

		<div class="form-group">

			<div class="input-group">
				
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fas fa-lock"></i>
					</span>
				</div>

				<input type="password" class="form-control" placeholder="Nueva contraseña" id="pwd" name="actualizarPassword">

				<input type="hidden" name="passwordActual" value="<?php echo $usuario["password"]; ?>">
				<input type="hidden" name="tokenUsuario" value="<?php echo $usuario["token"]; ?>">
				<input type="hidden" name="idUsuario" value="<?php echo $usuario["id"]; ?>">

			</div>

		</div>


		<?php

		$actualizar = ControladorFormularios::ctrActualizarRegistro();
		
		if($actualizar == "ok"){

			echo '<script>

			if ( window.history.replaceState ) {

				window.history.replaceState( null, null, window.location.href );

			}

			var datos = new FormData();
			datos.append("validarToken", "'.$usuario["token"].'");

			$.ajax({

				url: "ajax/formularios.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success:function(respuesta){

					$("#actualizarNombre").val(respuesta["nombre"]);	
					$("#actualizarEmail").val(respuesta["email"]);	
				}

			})
			if ( window.history.replaceState ) {

				window.history.replaceState( null, null, dale());

			}
			</script>';

			echo '<div class="alert alert-success">El usuario ha sido actualizado</div>';

		}

		if($actualizar == "error"){

			echo '<script>

			if ( window.history.replaceState ) {

				window.history.replaceState( null, null, window.location.href );

			}

			</script>';

			echo '<div class="alert alert-danger">Error al actualizar el usuario</div>';

		}


		?>
		
		<button type="submit" class="btn btn-primary">Actualizar</button>

	</form>

</div>