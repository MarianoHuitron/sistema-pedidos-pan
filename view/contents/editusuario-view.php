<?php 
    require_once "controller/usuarioControlador.php";
    $consulta = new usuarioControlador();
    $resupuesta = $consulta->seleccionar_usuario_controlador();
?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $serverurl ?>home/">Principal</a></li>
    <li class="breadcrumb-item"><a href="<?php echo $serverurl ?>usuarios/">Usuarios</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar Usuario</li>
  </ol>
</nav>
<form autocomplete="off" method="POST" action="<?php echo $serverurl ?>ajax/usuarioAjax.php" data-form="update" class="FormularioAjax" enctype="multipart/form-data">
    <div class="row">
        <div class="form-group col-sm-6">
            <label for="">Nombre del usuario:</label>
            <input type="text" class="form-control"  required name="usuario" value="<?php echo $resupuesta['nombre_usuario'] ?>" onkeypress="return soloLetras(event)">
            <input type="hidden" value="<?php echo $resupuesta['pk_usuario'] ?>" name="codigo-editar">
        </div>
        <div class="form-group col-sm-6">
            <label for="">Contraseña:</label>
            <input type="password" step="any" class="form-control" name="clave1" required>
        </div>        
    </div>
    <div class="row">
   
    <div class="form-group col-sm-6">
            <label for="">Confirmar contraseña:</label>
            <input type="password" step="any" class="form-control" name="clave2" required>
        </div>     
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success">Actualizar <i class="fas fa-save"></i></button>
    </div>

    <div class="RespuestaAjax"></div>
</form>