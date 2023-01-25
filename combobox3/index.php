<?php
include "db.php";
$db =  connect();
$query=$db->query("select * from country");
$countries = array();
while($r=$query->fetch_object()){ $countries[]=$r; }


?>
<!DOCTYPE html>
<html>
<head>
	<title>Combo 3 Niveles - Evilnapsis</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="jquery.min.js"></script>

</head>
<body>

<div class="container">
<div class="row">
<div class="col-md-12">
<h1>Combobox anidados con 3 niveles</h1>
<?php if(isset($_COOKIE["comboadd"])):?>
<p class="alert alert-success">Combo Agregado exitosamente!</p>
<?php setcookie("comboadd",0,time()-1); endif; ?>
</div>
</div>
<div class="row">
<div class="col-md-6">
<form method="post" action="add.php?opt=all">
  <div class="form-group">
    <label for="name1">Pais</label>
    <select id="country_id" class="form-control" name="country_id" required>
      <option value="">-- SELECCIONE --</option>
<?php foreach($countries as $c):?>
      <option value="<?php echo $c->id; ?>"><?php echo $c->name; ?></option>
<?php endforeach; ?>
    </select>
  </div>

  <div class="form-group">
    <label for="name1">Estado</label>
    <select id="state_id" class="form-control" name="state_id" required>
      <option value="">-- SELECCIONE --</option>
   </select>
  </div>

  <div class="form-group">
    <label for="name1">Ciudad</label>
    <select id="city_id" class="form-control" name="city_id" required>
      <option value="">-- SELECCIONE --</option>
   </select>
  </div>

  <button type="submit" class="btn btn-default">Agregar</button>
</form>
</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#country_id").change(function(){
			$.get("get_states.php","country_id="+$("#country_id").val(), function(data){
				$("#state_id").html(data);
				console.log(data);
			});
		});

		$("#state_id").change(function(){
			$.get("get_cities.php","state_id="+$("#state_id").val(), function(data){
				$("#city_id").html(data);
				console.log(data);
			});
		});
	});
</script>
</body>
</html>