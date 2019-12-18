<script>
    $('.pagina').removeClass('no-menu');
    $('.container').removeClass('no-menu');
</script>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $serverurl ?>home/">Principal</a></li>
    <li class="breadcrumb-item"><a href="<?php echo $serverurl ?>pedidos/">Pedidos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Nuevo Pedido</li>
  </ol>
</nav>

<div class="row">
    <div class="col">
        <label for="">Cliente</label>
        <select name="" id="clientePedido" class="form-control">
            <option value="">Seleccione...</option>
            <?php
                require_once "controller/clienteControlador.php";
                $consulta1 = new clienteControlador();
                $respuesta1 = $consulta1->mostrar_clientes_menu_controlador();
                foreach ($respuesta1 as $key => $value) {
                echo '<option value="'.$value['pk_cliente'].'">'.$value['nombre_negocio'].'</option>';
                }
            ?>
        </select>
    </div>
    <div class="col">
        <div class="form-group">
          <label for="">Fecha</label>
          <input type="date"
            class="form-control" name="fecha" id="fecha" aria-describedby="helpId" required>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
      <div class="table-responsive text-nowrap">
      <table class="table table-sm tablaDetallePedido">
            <thead>
                <th>Pieza</th>
                <th>Cantidad</th>
                <th>Importe</th>
                <th>Subtotal</th>
            </thead>
            <tbody id="detallePedido"></tbody>
        </table>
      </div>
        <a href="#" class="btn btn-primary btn-sm" id="guardarPedido">Finalizar</a>
    </div>
    <div class="col-md-6 scroll">
        <div class="row ">
        <?php 
            require_once "controller/panControlador.php";
            $consulta = new panControlador();
            $respuesta = $consulta->mostrar_panes_menu_interactivo_controlador();   
            
            foreach ($respuesta as $key => $value) {     
        ?>
            <a>
                <div class="card m-2">
                    <img src="<?php echo $value['imagen']  ?>" class="card-img-top panMenu" alt="..." width="90" height="90" value="<?php echo $value['pk_pan']  ?>" action="<?php echo $serverurl; ?>ajax/pedidoAjax.php">
                </div>
            </a>
            <?php
            }
        ?>
        </div>
    </div>
</div>
