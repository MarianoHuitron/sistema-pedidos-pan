<?php
    require_once "./controller/consultasHomeControlador.php";
    $consulta1 = new consultasHomeControlador();
    $res1 = $consulta1->contar_clientes_controlador();
    $res2 = $consulta1->contar_panes_controlador();
    $res3 = $consulta1->contar_cobros_pendientes_controlador();
?>

<style>
.enlacesCard {
    text-decoration: none;
    line-style: none;
    color: white;
}
.card-count {
    display: flex;
    flex-direction: column;
    align-items: center;
}
</style>
<h2>PANADERÍA SAN JOSÉ</h2>
<hr>
<div class="row" style="color:white;">
  <div class="col-md-4 mb-2">
    <div class="card text-white bg-primary ">
      <div class="card-body card-count" style="">
        <h5 class="card-title" ><i class="fas fa-store-alt fa-2x"></i></h5>
        <h3><?php echo $res1[0] ?></h3>
      </div>
      <div class="card-footer text-center card-count">
        <a href="<?php echo $serverurl; ?>cliente/" class="enlacesCard">Clientes <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
  <div class="col-md-4 mb-2">
    <div class="card text-white bg-success">
      <div class="card-body card-count">
        <h5 class="card-title"><i class="fas fa-cookie-bite fa-2x"></i></h5>
        <h3><?php echo $res2[0] ?></h3>
      </div>
      <div class="card-footer text-center card-count">
        <a href="<?php echo $serverurl;?>pan/" class="enlacesCard">Panes <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
  <div class="col-md-4 mb-2">
    <div class="card bg-danger text-white">
      <div class="card-body card-count ">
        <h5 class="card-title"><i class="fas fa-cash-register fa-2x"></i></h5>
        <h3><?php echo $res3[0] ?></h3>
      </div>
      <div class="card-footer text-center card-count">
        <a href="<?php echo $serverurl;?>pedidos/" class="enlacesCard">Pedidos pendientes <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
</div>
<hr>

<?php 
$res4 = $consulta1->calcular_promedio_pedidos_controlador();
$res5 = $consulta1->mostrar_datos_grafica1_controlador($res4);

// $array = [];
foreach($res5 as $value) {
  extract($value);
  $datos[] = array($nombre_negocio,(int)$cantidad);
}
// print_r($datos);
$datosJSON = json_encode($datos,JSON_UNESCAPED_UNICODE);
// echo $datosJSON;
// echo '<br>';
$res6 = $consulta1->mostrar_nombre_negocios_controlador();
foreach ($res6 as $key) {
    extract($key);

    $negocio[] = array($nombre_negocio);
}
// print_r($negocio);
$negocioJSON = json_encode($negocio,JSON_UNESCAPED_UNICODE);
// echo $negocioJSON;

?>
<div>
<div id="container" style="min-width: 300px; height: 400px; margin: 0 auto;" class="grafica"></div>

</div>

<script src="../view/grafica/graficas/highcharts.js"></script>
<script src="../view/grafica/graficas/modules/exporting.js"></script>

<script type="text/javascript">
  Highcharts.chart('container', {
    chart: {
      type: 'column'
    },
    title: {
      text:'Top mejores clientes'
    },
    xAxis: {
      categories: <?php echo $negocioJSON ?>		
    },
    series: [{
      name: <?php echo $negocioJSON ?>,
      data: <?php echo $datosJSON ?>
    }]
  })
</script>
