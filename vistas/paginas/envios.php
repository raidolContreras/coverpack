<?php
$item = "";

if(!isset($_SESSION["validarIngreso"])){

    echo '<script>window.location = "?pagina=ingreso";</script>';

    return;

}else{

    if($_SESSION["validarIngreso"] != "ok"){

        echo '<script>window.location = "?pagina=ingreso";</script>';

        return;
    }
    
}
    
$country = ControladorFormularios::ctrCountry();
    $usuario = ControladorFormularios::ctrSeleccionarGuia2();

    $resultado = $usuario['MAX(numero)']; 

    $guia = $resultado+1;

if (isset($_POST['id'])) {
   
    $item = $_POST['id'];
    $dest = $_POST['dest'];
    $cli = $_POST['cli'];

    if ($item != "" || $item != null) {

    $valor = "idRegCliente";
       
        $usuarios = ControladorFormularios::ctrSeleccionarRegistrosClientes($item, $valor);
        if  ($cli == "1"){
            echo '<div class="alert alert-success">Cliente Localizado!</div>';
        }else{
        $destinatarios = ControladorFormularios::ctrSeleccionarRegistrosClientes($dest, $valor);
            echo '<div class="alert alert-info">Remitente y Destinatario Localizado!</div>';
        }

    }else{
        echo '<div class="alert alert-warning">Usuario no encontrado</div>';
    }
}

?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"/>
<!-- --------------------------------- -->

<script>
    $(document).ready(function() {
    $("input").on("change", function() {
    calcular();
    });
    
    function calcular(){
        var costo= $("#costo").val();
        var utilidad= $("#utilidad").val();
        var precio = $("#precio").val();
    
            precio =parseFloat(costo) - (parseFloat(costo) * parseFloat(utilidad) / 100);
            $("#precio").val(precio);
        } 
    });
</script>

<!-- --------------------------------- -->

<form class="pb-5 pt-3 pl-5 pr-5 bg-light" method="post">

    <div class="d-flex">
        <hr class="my-auto flex-grow-1">
        <div class="px-4"><i class="fas fa-share-square py-3 px-2"></i>Remitente</div>
        <hr class="my-auto flex-grow-1">
    </div>
    <!-- Datos de Cliente -->
<?php if ($item == "" || $item == null): ?>

    <div class="row">
        <div class="col-md-4">
            <label for="Nombre"><h7>Nombre Completo</h7></label>
            <input type="text" class="form-control" name="nombreR" required>
        </div>
        <div class="col-md-4">
            <label for="calle"><h7>Calle</h7></label>
            <input type="text" class="form-control" name="calleR" required>
        </div>
        <div class="col-md-2">
            <label for="exterior"><h7>N° exterior</h7></label>
            <input type="text" class="form-control" name="exteriorR" required>
        </div>
        <div class="col-md-2">
            <label for="interior"><h7>N° interior</h7></label>
            <input type="text" class="form-control" name="interiorR">
        </div>
        <div class="col-md-4">
            <label for="colonia"><h7>Colonia</h7></label>
            <input type="text" class="form-control" name="coloniaR" required>
        </div>
        <div class="col-md-2">
            <label for="name1">Pais</label>
                 <input type="text" class="form-control" name="paisR" >
           <!--  <select id="country_id" class="form-control" name="paisR" >
           <option value="">PAIS</option>
            
            <?php foreach ($country as $key => $value): ?>
            <option value="<?php echo $value["id"]; ?>"><?php echo $value["name"]; ?></option>
            <?php endforeach ?> 
            
            </select>-->
        </div>
        <div class="col-md-2">
            <label for="name1">Estado</label>
            <input type="text" class="form-control" name="estadoR" >
          <!--  <select id="state_id" class="form-control" name="estadoR" >
            <option value="">ESTADO</option>
            </select> -->
        </div>
        <div class="col-md-2">
            <label for="name1">Ciudad</label>
            <input type="text" class="form-control" name="ciudadR" >
           <!-- <select id="city_id" class="form-control" name="ciudadR" >
            <option value="">CIUDAD</option>
            </select>-->
        </div>
        <div class="col-md-2">
            <label for="cp"><h7>C.P.</h7></label>
            <input type="number" class="form-control input-number" name="cpR" required>
        </div>
        <div class="col-md-2">
            <label for="telefono"><h7>Teléfono</h7></label>
            <input type="number" class="form-control" name="telefonoR" required>
        </div>
    </div>

    <?php else: ?>

        <div class="row">
            <div class="col-md-4">
                <label for="Nombre"><h7>Nombre Completo</h7></label>
                <input type="text" class="form-control" name="nombreR" value="<?php echo $usuarios["nombre"]; ?>" required>
            </div>
            <div class="col-md-4">
                <label for="calle"><h7>Calle</h7></label>
                <input type="text" class="form-control" name="calleR" value="<?php echo $usuarios["calle"]; ?>" required>
            </div>
            <div class="col-md-2">
                <label for="exterior"><h7>N° exterior</h7></label>
                <input type="text" class="form-control" name="exteriorR" value="<?php echo $usuarios["exterior"]; ?>" required>
            </div>
            <div class="col-md-2">
                <label for="interior"><h7>N° interior</h7></label>
                <input type="text" class="form-control" name="interiorR" value="<?php echo $usuarios["interior"]; ?>" >
            </div>
            <div class="col-md-4">
                <label for="colonia"><h7>Colonia</h7></label>
                <input type="text" class="form-control" name="coloniaR" value="<?php echo $usuarios["colonia"]; ?>" required>
            </div>
            <div class="col-md-2">
                <label for="ciudad"><h7>Ciudad</h7></label>
                <input type="text" class="form-control" name="ciudadR" value="<?php echo $usuarios["ciudad"]; ?>" required>
            </div>
            <div class="col-md-2">
                <label for="estado"><h7>Estado</h7></label>
                <input type="text" class="form-control" name="estadoR" value="<?php echo $usuarios["estado"]; ?>" required>
            </div>
            <div class="col-md-2">
                <label for="cp"><h7>C.P.</h7></label>
                <input type="number" class="form-control input-number" name="cpR" value="<?php echo $usuarios["cp"]; ?>" required>
            </div>
            <div class="col-md-2">
                <label for="telefono"><h7>Teléfono</h7></label>
                <input type="number" class="form-control" name="telefonoR" value="<?php echo $usuarios["telefono"]; ?>" required>
            </div>
        </div>

<?php endif ?>


    <!-- Datos de envio -->
    <div class="d-flex">
        <hr class="my-auto flex-grow-1">
        <div class="px-4"><i class="fas fa-share-square py-4 px-2"></i>Datos de envio</div>
        <hr class="my-auto flex-grow-1">
    </div>
    <div class="row">

        <div class="col-md-1">
            <label for="nomenclarura"><h7>Letra</h7></label>
            <input type="text" class="form-control" name="nomenclarura" maxlength="1" onkeyup="this.value = this.value.toUpperCase();" required>
        </div>
        <div class="col-md-2">
            <label for="nGuia"><h7>N° guia</h7></label>
            <input type="text" class="form-control input-number" id="nGuia" name="nGuia" maxlength="5" value="<?php echo $guia;?>" required>
        </div>

        <div class="col-md-3">
            <label for="agencia"><h7>Agencia</h7></label>
        
<?php if ($_SESSION["level"] == 3): ?>

    <input class="form-control" type="text" value="<?php echo $_SESSION["nombre"]; ?>" disabled>
    <input type="hidden" name="agencia" value="<?php echo $_SESSION["nombre"]; ?>">

<?php else: ?>

            <select class="form-control" name="agencia" id="agencia" data-placeholder="-- Seleccionar --" required>
                <option value="CoberPack">CoberPack</option>
                <option value="Viajes nueva Italia">Viajes Nueva Italia</option>
                <option value="Envíos nueva Italia">Envíos Nueva Italia</option>
                <option value="Copifax">Copifax</option>
                <option value="Regalos Licha">Regalos Licha</option>
                <option value="Deportes la estrella">Deportes la Estrella</option>
                <option value="Mundo de papel">Mundo de Papel</option>
                <option value="Mueblería Saturno">Mueblería Saturno</option>
                <option value="Medellín SPORT">Medellín SPORT</option>
                <option value="Multiservicios">Multiservicios</option>
                <option value="Vinateria del Centro">Vinateria del Centro</option>


            </select>
    
<?php endif ?>

            

        </div>

        <div class="form-group col-md-2">
            <label for="peso"><h7>Peso fisico</h7></label>
            <div class="input-group">
                <input type="number" step="any" class="form-control" name="peso" required/>
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        Kg
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group col-md-2">
            <label for="largo"><h7>Largo</h7></label>
            <div class="input-group">
                <input type="number" step="any" class="form-control" name="largo" required>
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        cm
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group col-md-2">
            <label for="ancho"><h7>Ancho</h7></label>
            <div class="input-group">
                <input type="number" step="any" class="form-control" name="ancho" required>
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        cm
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group col-md-2">
            <label for="alto"><h7>Alto</h7></label>
            <div class="input-group">
                <input type="number" step="any" class="form-control" name="alto" required>
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        cm
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <label for="agencia"><h7>Forma de pago</h7></label>
        
            <select class="form-control" name="forma_pago" data-placeholder="-- Seleccionar --" required>

                <option value="Efectivo">Efectivo</option>
                <option value="Tarjeta">Tarjeta</option>
                <option value="Crédito">Crédito</option>

            </select>

        </div>

        <div class="col-md-3">
            <label for="servicio"><h7>Servicio</h7></label>
        
            <select class="form-control" name="servicio" data-placeholder="-- Seleccionar --" required>

                <option value="Paquetería Express">Paquetería Express</option>
                <option value="Documento express">Documento express</option>
                <option value="Económico">Económico</option>
                <option value="Medicamento express">Medicamento Express</option>
                <option value="Documento express">Medicamento Prioritario</option>
                <option value="Nacional Terrestre">Nacional Terrestre</option>
                <option value="Nacional Express">Nacional Express</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="fecha"><h7>Fecha</h7></label>
            <input type="date" class="form-control" name="fecha" min="2020-01-01" max="2099-12-31" value="<?php echo date("Y-m-d");?>" required>
        </div>

        <div class="form-group col-md-2">
            <label for="costo"><h7>Costo</h7></label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-dollar-sign"></i>
                    </span>
                </div>
                <input type="number" step="any" class="form-control" name="costo" id="costo" required>
            </div>
        </div>


        <div class="form-group col-md-2">
            <label for="porciento"><h7>porcentaje</h7></label>
            <div class="input-group">
                <input type="number" step="any" class="form-control" name="porciento" id="utilidad" min="0" max="100" required>
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-percent"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="form-group col-md-2">
            <label for="costo"><h7>Costo total</h7></label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-dollar-sign"></i>
                    </span>
                </div>
                <input type="number" step="any" class="form-control" name="precio" id="precio" required>
            </div>
        </div>

        <div class="col-md-12">
            <label for="comentarios"><h7>Observaciones</h7></label>
            <textarea name="comentarios" class="form-control" rows="3"></textarea>
        </div>
    </div>

    <!-- Datos de envio -->

    <div class="d-flex">
        <hr class="my-auto flex-grow-1">
        <div class="px-4"><i class="fas fa-address-card py-4 px-2"></i>Datos destinatario</div>
        <hr class="my-auto flex-grow-1">
    </div>
<?php if ($item == "" || $item == null): ?>
    <div class="row">
        <div class="col-md-4">
            <label for="Nombre"><h7>Nombre Completo</h7></label>
            <input type="text" class="form-control" name="nombreD" required>
        </div>
        <div class="col-md-4">
            <label for="calle"><h7>Calle</h7></label>
            <input type="text" class="form-control" name="calleD" required>
        </div>
        <div class="col-md-2">
            <label for="exterior"><h7>N° exterior</h7></label>
            <input type="text" class="form-control" name="exteriorD" required>
        </div>
        <div class="col-md-2">
            <label for="interior"><h7>N° interior</h7></label>
            <input type="text" class="form-control" name="interiorD">
        </div>
        <div class="col-md-4">
            <label for="colonia"><h7>Colonia</h7></label>
            <input type="text" class="form-control" name="coloniaD" required>
        </div>
        <div class="col-md-2">
            <label for="name1">Pais</label>
                             <input type="text" class="form-control" name="paisD" >

          <!--  <select id="country_idD" class="form-control" name="paisD" required>
            <option value="">PAIS</option>
            
            <?php foreach ($country as $key => $value): ?>
            <option value="<?php echo $value["id"]; ?>"><?php echo $value["name"]; ?></option>
            <?php endforeach ?> 
            
            </select> -->
        </div>
        <div class="col-md-2">
            <label for="name1">Estado</label>
                             <input type="text" class="form-control" name="estadoD" >

           <!-- <select id="state_idD" class="form-control" name="estadoD" required>
            <option value="">ESTADO</option>
            </select> -->
        </div>
        <div class="col-md-2">
            <label for="name1">Ciudad</label>
                             <input type="text" class="form-control" name="ciudadD" >

        <!-- <select id="city_idD" class="form-control" name="ciudadD" required>

            <option value="">CIUDAD</option>
            </select> -->
        </div>
        <div class="col-md-2">
            <label for="cp"><h7>C.P.</h7></label>
            <input type="number" class="form-control input-number" name="cpD" required>
        </div>
        <div class="col-md-2">
            <label for="telefono"><h7>Teléfono</h7></label>
            <input type="number" class="form-control" name="telefonoD" required>
        </div>
    </div>
    <?php else: ?>


        <div class="row">
            <div class="col-md-4">
                <label for="Nombre"><h7>Nombre Completo</h7></label>
                <input type="text" class="form-control" name="nombreD" value="<?php echo $destinatarios["nombre"]; ?>" required>
            </div>
            <div class="col-md-4">
                <label for="calle"><h7>Calle</h7></label>
                <input type="text" class="form-control" name="calleD" value="<?php echo $destinatarios["calle"]; ?>" required>
            </div>
            <div class="col-md-2">
                <label for="exterior"><h7>N° exterior</h7></label>
                <input type="text" class="form-control" name="exteriorD" value="<?php echo $destinatarios["exterior"]; ?>" required>
            </div>
            <div class="col-md-2">
                <label for="interior"><h7>N° interior</h7></label>
                <input type="text" class="form-control" name="interiorD" value="<?php echo $destinatarios["interior"]; ?>" >
            </div>
            <div class="col-md-4">
                <label for="colonia"><h7>Colonia</h7></label>
                <input type="text" class="form-control" name="coloniaD" value="<?php echo $destinatarios["colonia"]; ?>" required>
            </div>
            <div class="col-md-2">
                <label for="ciudad"><h7>Ciudad</h7></label>
                <input type="text" class="form-control" name="ciudadD" value="<?php echo $destinatarios["ciudad"]; ?>" required>
            </div>
            <div class="col-md-2">
                <label for="estado"><h7>Estado</h7></label>
                <input type="text" class="form-control" name="estadoD" value="<?php echo $destinatarios["estado"]; ?>" required>
            </div>
            <div class="col-md-2">
                <label for="cp"><h7>C.P.</h7></label>
                <input type="number" class="form-control input-number" name="cpD" value="<?php echo $destinatarios["cp"]; ?>" required>
            </div>
            <div class="col-md-2">
                <label for="telefono"><h7>Teléfono</h7></label>
                <input type="number" class="form-control" name="telefonoD" value="<?php echo $destinatarios["telefono"]; ?>" required>
            </div>
        </div>

<?php endif ?>
    <?php 

        /*=============================================
        FORMA EN QUE SE INSTANCIA LA CLASE DE UN MÉTODO NO ESTÁTICO 
        =============================================*/
        
        // $registro = new ControladorFormularios();
        // $registro -> ctrRegistro();

        /*=============================================
        FORMA EN QUE SE INSTANCIA LA CLASE DE UN MÉTODO ESTÁTICO 
        =============================================*/

        $registro = ControladorFormularios::ctrRegistrarEnvios();

        if($registro == "ok"){

            echo '<script>

                if ( window.history.replaceState ) {

                    window.history.replaceState( null, null, window.location.href );

                }

            </script>';

            echo '<div class="alert alert-success">¡Envió Registrado Exitosamente!</div>';
        
        }

        if($registro == "error"){

            echo '<script>

                if ( window.history.replaceState ) {

                    window.history.replaceState( null, null, window.location.href );

                }

            </script>';

            echo '<div class="alert alert-danger">Error, no se permiten caracteres especiales</div>';

        }

        ?>
    <div class="container p-5">
        <div class="row">
            <div class="col text-center">
                <input type="submit" class="btn btn-success px-5" value="Registrar">
            </div>
        </div>
    </div>
</form>


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

<script type="text/javascript">
    $(document).ready(function(){
        $("#country_idD").change(function(){
            $.get("get_states2.php","country_idD="+$("#country_idD").val(), function(data){
                $("#state_idD").html(data);
                console.log(data);
            });
        });

        $("#state_idD").change(function(){
            $.get("get_cities2.php","state_idD="+$("#state_idD").val(), function(data){
                $("#city_idD").html(data);
                console.log(data);
            });
        });
    });
</script>