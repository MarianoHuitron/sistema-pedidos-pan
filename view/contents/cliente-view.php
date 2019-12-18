<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $serverurl ?>home/">Principal</a></li>
    <li class="breadcrumb-item active" aria-current="page">Clientes</li>
  </ol>
</nav>
<div class="row">
  <div class="col btnNuevo">
  <h3 class="text-center">
      <a href="<?php echo $serverurl ?>nuevocliente/">
          <button class="btn btn-primary btn-sm" style="border-radius: 30px;">Nuevo <i class="fas fa-plus"></i></button>
      </a>
  </h3>
  </div>
</div>

<div id="tabla">
  <table class="table" id="tablaClientes">
    <thead>
        <tr>
            <th class="text-center">Tienda</th>
            <th class="text-center">Encargado</th>
            <th calss="text-center">Teléfono</th>
            <th class="text-center">Dirección</th>
            <th class="text-center">Localidad</th>
            <th class="text-center">Editar</th>
            <th class="text-center">Eliminar</th>
        </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>
<?php include "./view/modulos/tablaClientes.php";?>