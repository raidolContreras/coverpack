<?php
$item = "";
$message ="Datos Localizados!";
$color = "success";

if(!isset($_SESSION["validarIngreso"])){

    echo '<script>window.location = "?pagina=ingreso";</script>';

    return;

}else{

    if($_SESSION["validarIngreso"] != "ok"){

        echo '<script>window.location = "?pagina=ingreso";</script>';

        return;
    }

}

if (isset($_GET['correct']) and isset($_GET['id'])) {
    
    $message ="Datos Actualizados!";

    $color = "primary";

}
if (isset($_GET['id'])) {

    $item = $_GET['id'];

    if ($item != "" || $item != null) {

        $valor = "idRegCliente";

        $datos = ControladorFormularios::ctrSeleccionarPedidos3($item);
        echo '<div class="alert alert-'.$color.' alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Genial!</strong> '.$message.'
            </div>';

    }else{
        echo '<div class="alert alert-warning">Algo salio mal</div>';
    }
}
?>

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
    <div class="row">
        <div class="col-md-4">
            <label for="Nombre"><h7>Nombre Completo</h7></label>
            <input type="text" class="form-control" name="nombreR" value="<?php echo $datos["nombre"]; ?>" required>
        </div>
        <div class="col-md-8">
            <label for="calle"><h7>Direccion</h7></label>
            <input type="text" class="form-control" name="calleR" value="<?php echo $datos["direccion"]; ?>" required>
        </div>
        <div class="col-md-4">
            <label for="colonia"><h7>Colonia</h7></label>
            <input type="text" class="form-control" name="coloniaR" value="<?php echo $datos["colonia"]; ?>" required>
        </div>
        <div class="col-md-2">
            <label for="ciudad"><h7>Ciudad</h7></label>
            <input type="text" class="form-control" name="ciudadR" value="<?php echo $datos["ciudad"]; ?>" required>
        </div>
        <div class="col-md-2">
            <label for="estado"><h7>Estado</h7></label>
            <input type="text" class="form-control" name="estadoR" value="<?php echo $datos["estado"]; ?>" required>
        </div>
        <div class="col-md-2">
            <label for="cp"><h7>C.P.</h7></label>
            <input type="number" class="form-control input-number" name="cpR" value="<?php echo $datos["cp"]; ?>" required>
        </div>
        <div class="col-md-2">
            <label for="telefono"><h7>Teléfono</h7></label>
            <input type="number" class="form-control" name="telefonoR" value="<?php echo $datos["telefono"]; ?>" required>
        </div>
    </div>


    <!-- Datos de envio -->
    <div class="d-flex">
        <hr class="my-auto flex-grow-1">
        <div class="px-4"><i class="fas fa-share-square py-4 px-2"></i>Datos de envio</div>
        <hr class="my-auto flex-grow-1">
    </div>
    <div class="row">

        <div class="col-md-3">
            <label for="nGuia"><h7>N° guia</h7></label>
            <input type="text" class="form-control" id="nGuia" name="nGuia" maxlength="6" value="<?php echo $datos['n_guia'];?>" required>
        </div>

        <div class="col-md-3">
            <label for="agencia"><h7>Agencia</h7></label>

            <?php if ($_SESSION["level"] == 3): ?>

                <input class="form-control" type="text" value="<?php echo $_SESSION["agencia"]; ?>" disabled>
                <input type="hidden" name="agencia" value="<?php echo $_SESSION["agencia"]; ?>">

                <?php else: ?>

                    <select class="form-control" name="agencia" id="agencia" data-placeholder="-- Seleccionar --" required>
                        <option value="<?php echo $datos["agencia"]; ?>"><?php echo $datos["agencia"]; ?></option>
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

                    </select>

                <?php endif ?>



            </div>

            <div class="form-group col-md-2">
                <label for="peso"><h7>Peso fisico</h7></label>
                <div class="input-group">
                    <input type="number" step="any" class="form-control" name="peso" value="<?php echo $datos['peso_fisico'];?>" required/>
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
                    <input type="number" step="any" class="form-control" name="largo" value="<?php echo $datos['largo'];?>" required>
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
                    <input type="number" step="any" class="form-control" name="ancho" value="<?php echo $datos['ancho'];?>" required>
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
                    <input type="number" step="any" class="form-control" name="alto" value="<?php echo $datos['alto'];?>" required>
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

                    <option value="<?php echo $datos['forma_pago'];?>"><?php echo $datos['forma_pago'];?></option>
                    <option value="Efectivo">Efectivo</option>
                    <option value="Tarjeta">Tarjeta</option>
                    <option value="Crédito">Crédito</option>

                </select>

            </div>

            <div class="col-md-3">
                <label for="servicio"><h7>Servicio</h7></label>
                <input type="text" class="form-control" name="servicio" value="<?php echo $datos['tipo_servicio'];?>" required>
            </div>

            <div class="col-md-3">
                <label for="fecha"><h7>Fecha</h7></label>
                <input type="date" class="form-control" name="fecha" min="2020-01-01" max="2099-12-31" value="<?php echo $datos['fecha_agencia'];?>" required>
            </div>

            <div class="form-group col-md-2">
                <label for="costo"><h7>Costo</h7></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-dollar-sign"></i>
                        </span>
                    </div>
                    <input type="number" step="any" class="form-control" name="costo" id="costo" value="<?php echo $datos['costo'];?>" required>
                </div>
            </div>


            <div class="form-group col-md-2">
                <label for="porciento"><h7>porcentaje</h7></label>
                <div class="input-group">
                    <input type="number" step="any" class="form-control" name="porciento" id="utilidad" min="0" max="100" value="0" required>
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
                    <input type="number" step="any" class="form-control" name="precio" id="precio" value="<?php echo $datos['costo_agencia'];?>" required>
                </div>
            </div>

            <div class="col-md-12">
                <label for="comentarios"><h7>Observaciones</h7></label>
                <textarea name="comentarios" class="form-control" rows="3" ><?php echo $datos['observaciones'];?></textarea>
            </div>
        </div>

        <!-- Datos de envio -->
        <div class="d-flex">
            <hr class="my-auto flex-grow-1">
            <div class="px-4"><i class="fas fa-address-card py-4 px-2"></i>Datos destinatario</div>
            <hr class="my-auto flex-grow-1">
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="Nombre"><h7>Nombre Completo</h7></label>
                <input type="text" class="form-control" name="nombreD" value="<?php echo $datos['nombre_des'];?>" required>
            </div>
            <div class="col-md-4">
                <label for="calle"><h7>Dirección</h7></label>
                <input type="text" class="form-control" name="calleD" value="<?php echo $datos["direccion_des"]; ?>" required>
            </div>
            <div class="col-md-4">
                <label for="colonia"><h7>Colonia</h7></label>
                <input type="text" class="form-control" name="coloniaD" value="<?php echo $datos['colonia_des'];?>" required>
            </div>
            <div class="col-md-2">
                <label for="ciudad"><h7>Ciudad</h7></label>
                <input type="text" class="form-control" name="ciudadD" value="<?php echo $datos['ciudad_des'];?>" required>
            </div>
            <div class="col-md-2">
                <label for="estado"><h7>Estado</h7></label>
                <input type="text" class="form-control" name="estadoD" value="<?php echo $datos['estado_des'];?>" required>
            </div>
            <div class="col-md-2">
                <label for="cp"><h7>C.P.</h7></label>
                <input type="number" class="form-control input-number" name="cpD" value="<?php echo $datos['cp_des'];?>" required>
            </div>
            <div class="col-md-2">
                <label for="telefono"><h7>Teléfono</h7></label>
                <input type="number" class="form-control" name="telefonoD" value="<?php echo $datos['tel_des'];?>" required>
            </div>
        </div>
        <?php 

/*=============================================
FORMA EN QUE SE INSTANCIA LA CLASE DE UN MÉTODO NO ESTÁTICO 
=============================================*/

// $registro = new ControladorFormularios();
// $registro -> ctrRegistro();

/*=============================================
FORMA EN QUE SE INSTANCIA LA CLASE DE UN MÉTODO ESTÁTICO 
=============================================*/
$cliente = $datos['id_cliente'];
$registro = ControladorFormularios::ctrActualizarEnvios($cliente);

if($registro == "ok"){

    echo '<script>

    if ( window.history.replaceState ) {

        window.history.replaceState( null, null);

    }</script>';
    echo '
    <script>
        window.location = "?pagina=actualizarEnvios&id='.$item.'&correct=true";
    </script>

    ';

}

if($registro == "error"){

    echo '<script>

    if ( window.history.replaceState ) {

        window.history.replaceState( null, null, dale());

    }

    </script>';

    echo '<div class="alert alert-danger">Error, no se permiten caracteres especiales</div>';

}

?>
<div class="container p-5">
    <div class="row">
        <div class="col text-center">
            <input type="submit" class="btn btn-success px-5" value="Actualizar">
        </div>
    </div>
</div>
</form>
