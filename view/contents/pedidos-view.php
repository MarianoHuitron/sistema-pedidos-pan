<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $serverurl ?>home/">Principal</a></li>
    <li class="breadcrumb-item active" aria-current="page">Pedidos</li>
  </ol>
</nav>
<div class="row">
  <div class="col btnNuevo">
  <h3 class="text-center">
      <a href="<?php echo $serverurl ?>nuevopedido/">
          <button class="btn btn-primary btn-sm" style="border-radius: 30px;">Nuevo <i class="fas fa-plus"></i></button>
      </a>
  </h3>
  </div>
</div>

<div id="tabla">
  <table class="table table-striped" id="tablaPedidos">
    <thead calss="primary">
        <tr>
            <th class="text-center">Folio</th>
            <th class="text-center">Fecha</th>
            <th calss="text-center">Cliente</th>
            <th class="text-center">Cantidad</th>
            <th class="text-center">Total</th>
            <th class="text-center">Estado</th>
        </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>
<?php include "./view/modulos/tablaPedidos.php";?>

<script>
  function ponerTotal() {
    let campoSubtotal = $('#subtotal').val().replace("$","");
    let campoDevueltas = $('#devueltas').val();
    let descuento = campoDevueltas*4;
    // let arregloDescuento = $('#subtotal').val().replace(" ","");
    let campoDescuento = $('#descuento').val("$"+descuento);
    let total = campoSubtotal-descuento;

    let campoTotal = $('#total').val("$"+total);
  }
</script>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Realizar cobro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" data-form="save"  enctype="multipart/form-data" autocomplete="false" id="formPedidos">
          <div class="form-gorup">
            <label for="">Folio:</label>
            <input type="text" class="form-control" id="folio" name="folio" disabled required>
            <input type="hidden" name="codigoPedido" id="codigoPedido" required>
          </div>
          <div class="form-gorup">
            <label for="">Cliente:</label>
            <input type="text" class="form-control" id="cliente" name="cliente" disabled required>
          </div>
          <div class="form-gorup">
            <label for="">Subtotal:</label>
            <input type="text" class="form-control" id="subtotal" name="subtotal" disabled required>
          </div>
          <div class="form-gorup">
            <label for="">Piezas devueltas:</label>
            <input type="number" class="form-control" id="devueltas" name="devueltas" onkeyup="ponerTotal()" required>
          </div>
          <div class="form-gorup">
            <label for="">Cantidad descontada:</label>
            <input type="text" class="form-control" id="descuento" name="descuento" disabled required>
          </div>
          <div class="form-gorup">
            <label for="">Total:</label>
            <input type="text" class="form-control" id="total" name="total" disabled required>
          </div>
          <div style="display: flex; justify-content:space-between; padding-top:1.5rem;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" type="submit" id="btnSubmit">Realizar cobro</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
