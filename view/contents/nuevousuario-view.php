<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $serverurl ?>home/">Principal</a></li>
    <li class="breadcrumb-item"><a href="<?php echo $serverurl ?>usuarios/">Usuarios</a></li>
    <li class="breadcrumb-item active" aria-current="page">Nuevo Usuario</li>
  </ol>
</nav>
<form autocomplete="off" method="POST" action="<?php echo $serverurl ?>ajax/usuarioAjax.php" data-form="save" class="FormularioAjax" enctype="multipart/form-data">
    <div class="row">
        <div class="form-group col-sm-6">
            <label for="">Nombre del usuario:</label>
            <input type="text" class="form-control"  required name="usuario" onkeypress="return soloLetras(event)">
        </div>
        <div class="form-group col-sm-6">
            <label for="">Contraseña:</label>
            <input type="password" step="any" class="form-control" name="clave1" required>
        </div>        
    </div>
    <div class="row">
   
    <div class="form-group col-sm-6">
            <label for="">Repetir contraseña:</label>
            <input type="password" step="any" class="form-control" name="clave2" required>
        </div>     
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
    </div>

    <div class="RespuestaAjax"></div>
</form>

