<?php
    $peticionAjax = true;
    require_once "../core/configGeneral.php";
    if (isset($_POST['clave']) || isset($_POST['cliente']) || isset($_POST['cantidad']) || isset($_POST['codigoPedido'])) {
        require_once "../controller/panControlador.php";
        require_once "../controller/pedidoControlador.php";
        $pan = new panControlador();
        $pedido = new pedidoControlador();

        if(isset($_POST['clave'])) {
            echo json_encode($pan->mostrar_datos_pan_detalle_controlador());
        }

        if(isset($_POST['cliente']) && isset($_POST['fecha'])) {
            echo $pedido->agregar_pedido_controlador();
        }

        if(isset($_POST['codigoPedido'])) {
            echo json_encode($pedido->mostrar_datos_pedido_para_cobro_controlador());
        }

        
    } else {
        session_start(['name'=>'SPSJ']);
        session_destroy();
        echo '<script>
            window.location.href="'.$serverurl.'login/"
        </script>';
    }
    