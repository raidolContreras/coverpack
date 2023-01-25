$("#email").change(function(){

	$(".alert").remove();

	var email = $(this).val();
	
	var datos = new FormData();
	datos.append("validarEmail", email);

	$.ajax({

		url: "ajax/formularios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta){
			
			if(respuesta){

				$("#email").val("");

				$("#email").parent().after(`
					
					<div class="alert alert-danger">

							<i class="fas fa-times-circle"></i>

							El correo electrónico ya existe,  por favor ingrese uno diferente
					</div>


				`);

			}

		}

	});


})