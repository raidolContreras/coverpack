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

if(!isset($_SESSION["validarIngreso"])){

	echo '<script>window.location = "?pagina=ingreso";</script>';

	return;

}else{

	if($_SESSION["validarIngreso"] != "ok"){

		echo '<script>window.location = "?pagina=ingreso";</script>';

		return; 
	}
	
}


if(isset($_GET["token"])){

	$valor = $_GET["token"];

	$usuario = ControladorFormularios::ctrSeleccionarTrack($valor);

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
						<i class="fas fa-barcode"></i>
					</span>
				</div>

				<input type="number" class="form-control" value="<?php echo $usuario["track"]; ?>" placeholder="Escriba el Track" id="actualizarTrack" name="actualizarTrack">

			</div>
			
		</div>

		<div class="form-group">

			<div class="input-group">
				
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fas fa-shipping-fast"></i>
					</span>
				</div>
				
				<input type="text" class="form-control" value="<?php echo $usuario["provedor"]; ?>" onkeyup="javascript:this.value=this.value.toLowerCase();" placeholder="Escriba al proveedor" id="actualizarProveedor" name="actualizarProveedor">

			</div>
			
		</div>

		<div class="form-group">

			<div class="input-group">
				
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fas fa-shipping-fast"></i>
					</span>
				</div>
				<textarea class="form-control" placeholder="Comentarios" id="actualizarComentario" name="actualizarComentario"cols="100" rows="5" minlength="5" maxlength="500"><?php echo $usuario["comentario"]; ?></textarea>

			</div>
			
		</div>

		<div class="form-group">

				<input type="hidden" name="id" value="<?php echo $valor; ?>">

		</div>


		<?php

		$actualizar = ControladorFormularios::ctrActualizarTrack();
		
		if($actualizar == "ok"){

			echo '<script>

			if ( window.history.replaceState ) {

				window.history.replaceState( null, null, dale());

			}</script>';

		}

		if($actualizar == "error"){

			echo '<script>

			if ( window.history.replaceState ) {

				window.history.replaceState( null, null, window.location.href );

			}

			</script>';

			echo '<div class="alert alert-danger">Error al actualizar el track</div>';

		}

		?>
		
		<button type="submit" class="btn btn-primary">Actualizar</button>

	</form>

</div>