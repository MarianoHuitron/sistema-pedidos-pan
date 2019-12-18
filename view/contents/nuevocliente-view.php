<?php
    require_once './controller/clienteControlador.php';
    $equis = new clienteControlador();
    $respuesta = $equis->mostrar_localidades_controlador();
?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $serverurl ?>home/">Principal</a></li>
    <li class="breadcrumb-item"><a href="<?php echo $serverurl ?>cliente/">Clientes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Nuevo</li>
  </ol>
</nav>
<form method="POST" action="<?php echo $serverurl; ?>ajax/clienteAjax.php" data-form="save" class="FormularioAjax" autocomplete="off">
    <div class="row">
        <div class="form-group col-sm-6">
            <label for="">Nombre de la tienda:</label>
            <input type="text" class="form-control" name="nombre_tienda" required onkeypress="return soloLetras(event)">
        </div>
        <div class="form-group col-sm-6">
            <label for="">Nombre del encargado:</label>
            <input type="text" class="form-control" name="nombre_encargado" required onkeypress="return soloLetras(event)">
        </div>
        
    </div>
    <div class="row">
        <div class="form-group col-sm-6">
            <label for="">Número de Teléfono:</label>
            <input type="number" class="form-control" name="numero_tel">
        </div> 
        <div class="form-group col-sm-6">
            <label for="localidad">Localidad</label>
            <select class="custom-select" name="localidad" id="localidadSelect" onchange="nuevaLocalidad()">
                <option selected="selected">Seleccione...</option>
                <?php
                    foreach($respuesta as $value) {
                        echo '<option value="'.$value['localidad'].'">'.$value['localidad'].'</option>';
                    }
                ?>
                <option value="nuevo">Otra</option>
                <!-- <input type="text"> -->
            </select>
        </div> 
        <div class="form-group col-sm-6">
            <label for="">Dirección:</label>
            <textarea name="direccion" id="" cols="5" rows="4" class="form-control"></textarea>
        </div>
        <div class="form-group col-sm-6 d-none" id="localidadInput">
            <label for="">Escriba la localidad:</label>
            <input type="text" class="form-control" required onkeypress="return soloLetras(event)" >
        </div> 
       
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
    </div>
    <div class="RespuestaAjax"></div>
</form>

<script>
    
</script>