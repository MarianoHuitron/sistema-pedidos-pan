<?php
$construccion = false;
if(!$construccion) {

?>

<?php
    require_once "controller/panControlador.php";
    $consulta = new panControlador();
    $respuesta = $consulta->seleccionar_pan_controlador();
?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $serverurl ?>home/">Principal</a></li>
    <li class="breadcrumb-item"><a href="<?php echo $serverurl ?>pan/">Panes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar Pan</li>
  </ol>
</nav>
<form method="POST" action="<?php echo $serverurl ?>ajax/panAjax.php" data-form="update" class="FormularioAjax" enctype="multipart/form-data" autocomplete="false">
    <div class="row">
        <div class="form-group col-sm-6">
            <label for="">Nombre del pan:</label>
            <input type="text" class="form-control" name="nombre_pan" required onkeypress="return soloLetras(event)" value="<?php echo $respuesta['nombre_pan']?>">
            <input type="hidden" name="codigo-edit" value="<?php echo $respuesta['pk_pan']?>" required>
        </div>
        <div class="form-group col-sm-6">
            <label for="">Precio:</label>
            <input type="number" step="any" class="form-control" name="precio_pan" required value="<?php echo $respuesta['precio_pan']?>">
        </div>        
    </div>
    <div class="row">
        <div class="form-group col-sm-6">
            <label for="">Tipo de pan:</label>
            <input type="text" class="form-control" name="tipo_pan" onkeypress="return soloLetras(event)" value="<?php echo $respuesta['tipo_pan']?>">
        </div> 
        <div class="form-group col-sm-6">
            <label for="">Imagen:</label>
            <input type="file" class="form-control-file" name="imagen">
        </div> 
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Actualizar <i class="fas fa-save"></i></button>
    </div>
    <div class="RespuestaAjax"></div>
</form>

<?php
} else {
    ?>
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo $serverurl ?>home/">Principal</a></li>
        <li class="breadcrumb-item"><a href="<?php echo $serverurl ?>pan/">Panes</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editar Pan</li>
    </ol>
    </nav>
    <?php
    include "view/modulos/construccion.php";
}
?>