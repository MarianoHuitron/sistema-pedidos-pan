<?php
    if ($peticionAjax) {
        require_once "../model/cobroModelo.php";
    } else {
        require_once "./model/cobroModelo.php";
    }
    class cobroControlador extends cobroModelo {
        public function guardar_cobro_controlador() {
            $folio = $_POST['campoFolio'];
            $subtotal = $_POST['campoSubtotal'];
            $devueltas = $_POST['campoDevueltas'];
            $descuento = $_POST['campoDescuento'];
            $total = $_POST['campoTotal'];
            $codigoPedido = $_POST['campoCodigoPedido'];
            $codigoCliente = $_POST['codigoCliente'];
            $fecha = date('Y-m-d');

            $dataCobro = [
                "CantidadCobrada"=>$total,
                "Cliente"=>$codigoCliente,
                "Pedido"=>$codigoPedido,
                "Fecha"=>$fecha,
                "CantidadDescontada"=>$descuento,
                "PanesDevueltos"=>$devueltas
            ];

            $guardarCobro = cobroModelo::guardar_cobro_modelo($dataCobro);
            if($guardarCobro == 'ok') {
                $actualizarEstado = mainModel::ejecutar_consulta_simple("UPDATE pedidos SET estado = 'pagado' WHERE folio = '$folio' AND pk_pedido = '$codigoPedido'");
                if ($actualizarEstado->rowCount()>=1) {
                    return 'ok';
                } else {
                    return 'error';
                }
                
            } else {
                return 'error';
            }
        }
    }
