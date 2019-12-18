<?php
    if ($peticionAjax) {
        require_once "../model/pedidoModelo.php";
    } else {
        require_once "./model/pedidoModelo.php";
    }
    class pedidoControlador extends pedidoModelo {
        public function agregar_pedido_controlador() {
            $cliente = $_POST['cliente'];
            // $campoFecha = $_POST['fecho'];
            $fecha = $_POST['fecha'];
            // echo $campoFecha;
            // return 'error';
            // $fecha = date("Y-m-d");
            
            $consulta = mainModel::ejecutar_consulta_simple("SELECT pk_pedido FROM pedidos");
            $numero = ($consulta->rowCount())+1;
            
            $folio = mainModel::generar_codigo_aleatorio("DP",6,$numero);
            
            $dataPedido = [
                "Folio"=>$folio,
                "Cliente"=>$cliente,
                "Fecha"=>$fecha,
                "Estado"=>"pendiente"
            ];

            $guardarPedido = pedidoModelo::guardar_pedido_modelo($dataPedido);
            if($guardarPedido->rowCount()>=1) {
                return $folio;
            } else {
                return 'error';
            }
        }

        public function guardar_detalle_pedido_controlador() {
            $pan = $_POST['pan'];
            $cantidad = $_POST['cantidad'];
            $subtotal = $_POST['subtotal'];
            $folio = $_POST['folio'];

            // return $folio;

            $consulta = mainModel::ejecutar_consulta_simple("SELECT pk_pedido FROM pedidos WHERE folio = '$folio'");
            $pkPedido = $consulta->fetch();

            $dataDetalle = [
                "Pedido"=>$pkPedido['pk_pedido'],
                "Pan"=>$pan,
                "Cantidad"=>$cantidad,
                "Subtotal"=>$subtotal
            ];

            $guardarDetalle = pedidoModelo::guardar_detalle_pedido_modelo($dataDetalle);
            if($guardarDetalle->rowCount()>=1) {
                $consulta2 = mainModel::ejecutar_consulta_simple("SELECT SUM(cantidad) as 'cantidad',SUM(subtotal) as 'total' FROM detalle_pedido WHERE fk_pedido=".$pkPedido['pk_pedido']);
                
                $respuesta = $consulta2->fetch();

                // var_dump($respuesta);
                echo $respuesta['cantidad'];
                $dataActualizar = [
                    "Cantidad"=>$respuesta['cantidad'],
                    "Total"=>$respuesta['total'],
                    "Clave"=>$pkPedido['pk_pedido']
                ];

                $actualizarPedido = pedidoModelo::actualizar_pedido_modelo($dataActualizar);
                if($actualizarPedido->rowCount()>=1) {
                    return 'ok';
                } else {
                    return 'error';
                }
            } else {
                return 'error';
            }
        }
        
        public function mostrar_pedido_controlador() {
            $query = mainModel::ejecutar_consulta_simple("SELECT pk_pedido,folio,fecha_pedido,c.nombre_negocio as 'cliente', cantidad, total, estado FROM pedidos p, clientes c WHERE p.fk_cliente=c.pk_cliente");
            
            $arreglo['data'] = [];

            while($row =  $query->fetch(PDO::FETCH_ASSOC)) {
                $arreglo['data'][] = $row;
            }
            return json_encode($arreglo);
        }

        public function mostrar_datos_pedido_para_cobro_controlador() {
            $codigo = $_POST['codigoPedido'];
            $query = mainModel::ejecutar_consulta_simple("SELECT pk_pedido, folio, fk_cliente, c.nombre_negocio, total FROM pedidos p, clientes c where p.fk_cliente=c.pk_cliente AND pk_pedido=$codigo");
            return $query->fetch();
        }
    }