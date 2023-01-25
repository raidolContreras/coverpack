$("#nGuia").change(function(){

	$(".alert").remove();

	var nGuia = $(this).val();
	
	var texting = nGuia;

	var datos = new FormData();
	datos.append("validarGuia", nGuia);

	$.ajax({

		url: "ajax/formularios2.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta){

			if(respuesta){

			//	$("#nGuia").val("");

				$("#nGuia").after(`
					
					<div class="alert alert-warning align-text-bottom text-center font-weight-light" >

							El Numero de Guia `+respuesta[0]+` ya existe

					</div>
				`);

			}

		}

	});


})