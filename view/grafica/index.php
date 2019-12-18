<?php 
	require_once 'conexion.php';

	$conexion = new Conexion();
	$conexion->conectar();

	$Cuantasp = Conexion::conectar()->prepare('SELECT puesto,salario FROM puestos ');
	$Cuantasp -> execute();
	$Resultado1=$Cuantasp->fetchAll();

	foreach ($Resultado1 as $key) {
		extract($key);

		$Datos[]=array($puesto,floatval($salario));
	}
	print_r($Datos);
	$datosC =json_encode($Datos);

	$puesto=Conexion::conectar()->prepare('SELECT puesto FROM puestos');
	$puesto->execute();
	$Resultado2=$puesto->fetchAll();

	foreach ($Resultado2 as $keys) {
		extract($keys);

		$puest[]=array($puesto);
	}
	print_r($puest);
	$puestos=json_encode($puest);
?>

<div id="container"></div>
<script type="text/javascript" src="graficas/highcharts.js"></script>
<script type="text/javascript" src="graficas/modules/exporting.js"></script>

<script type="text/javascript">
	Highcharts.chart('container',{
		chart: {
			type: 'pie'
		}, 
		title: {
			text: 'Grafica de puestos y salario'
		}, 
		xAxis: {
			categories: <?php echo $puestos ?>
		}, 
		series: [{
			name: <?php echo $puestos ?>, 
			data: <?php echo $datosC ?>
		}]
	});
</script>