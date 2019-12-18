<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $serverurl ?>home/">Principal</a></li>
    <li class="breadcrumb-item active" aria-current="page">Panes</li>
  </ol>
</nav>
<div class="row">
  <div class="col btnNuevo">
    <h3 class="text-center">
        <a href="<?php echo $serverurl ?>nuevopan/">
            <button class="btn btn-primary btn-sm" style="border-radius: 30px;">Nuevo <i class="fas fa-plus"></i></button>
        </a>
    </h3>
  </div>
</div>

<table class="table" id="tablaPanes">
  <thead>
      <tr>
          <th class="text-center">Pan</th>
          <th class="text-center">Precio</th>
          <th calss="text-center">Tipo de pan</th>
          <th class="text-center">Imagen</th>
          <th class="text-center">Editar</th>
          <th class="text-center">Eliminar</th>
      </tr>
  </thead>
  <tbody></tbody>
</table>
<?php include "./view/modulos/tablaPanes.php";?>
