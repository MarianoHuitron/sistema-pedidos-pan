<?php
    require_once "controller/clienteControlador.php";
    $consulta = new clienteControlador();
    $res = $consulta -> seleccionar_cliente_controlador();
    $localidades = $consulta->mostrar_localidades_controlador();
    foreach ($res as $key => $value) {
        
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $serverurl ?>home/">Principal</a></li>
    <li class="breadcrumb-item"><a href="<?php echo $serverurl ?>cliente/">Clientes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar Cliente</li>
  </ol>
</nav>
<form method="POST" action="<?php echo $serverurl; ?>ajax/clienteAjax.php" data-form="update" class="FormularioAjax" autocomplete="off">
    <div class="row">
        <div class="form-group col-sm-6">
            <label for="">Nombre de la tienda:</label>
            <input type="text" class="form-control" name="nombre_tienda" required onkeypress="return soloLetras(event)" value="<?php echo $value['nombre_negocio']  ?>">
            <input type="hidden" value="<?php echo $value['pk_cliente'] ?>" name="codigo-editar">
        </div>
        <div class="form-group col-sm-6">
            <label for="">Nombre del encargado:</label>
            <input type="text" class="form-control" name="nombre_encargado" required onkeypress="return soloLetras(event)" value="<?php echo $value['nombre_encargado']  ?>">
        </div>
        
    </div>
    <div class="row">
        <div class="form-group col-sm-6">
            <label for="">Número de Teléfono:</label>
            <input type="number" class="form-control" name="numero_tel" value="<?php echo $value['telefono']  ?>">
        </div> 
        <div class="form-group col-sm-6">
            <label for="localidad">Localidad</label>
            <select class="custom-select" name="localidad" id="localidadSelect" onchange="nuevaLocalidad()">
                <option selected="selected">Seleccione...</option>
                <?php
                    foreach($localidades as $value2) {
                        if($value['localidad'] == $value2['localidad']) {
                            echo '<option value="'.$value2['localidad'].'" selected="selected">'.$value2['localidad'].'</option>';
                        } else {
                            echo '<option value="'.$value2['localidad'].'">'.$value2['localidad'].'</option>';
                        }
                       
                    }
                ?>
                <option value="nuevo">Otra</option>
                <!-- <input type="text"> -->
            </select>
        </div> 
        <div class="form-group col-sm-6">
            <label for="">Dirección:</label>
            <textarea name="direccion" id="" cols="5" rows="4" class="form-control" ><?php echo $value['direccion'] ?></textarea>
        </div>
        <div class="form-group col-sm-6 d-none" id="localidadInput">
            <label for="">Escriba la localidad:</label>
            <input type="text" class="form-control" required onkeypress="return soloLetras(event)" >
        </div> 
       
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Actualizar <i class="fas fa-save"></i></button>
    </div>
    <div class="RespuestaAjax"></div>
</form>

<?php }?>