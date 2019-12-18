<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $serverurl ?>home/">Principal</a></li>
    <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
  </ol>
</nav>
<div class="row">
  <div class="col btnNuevo">
  <h3 class="text-center">
      <a href="<?php echo $serverurl ?>nuevousuario/">
          <button class="btn btn-primary btn-sm" style="border-radius: 30px;">Nuevo <i class="fas fa-plus"></i></button>
      </a>
  </h3>
  </div>
</div>

<table class="table " id="tablaUsuarios">
  <thead>
      <tr>
          <th class="tect-center">ID</th>
          <th class="tect-center">Nombre del Usuario</th>
          <th class="tect-center">Editar</th>
          <th class="tect-center">Eliminar</th>
      </tr>
  </thead>
  <tbody></tbody>
</table>
<?php include "./view/modulos/tablaUsuarios.php";?>