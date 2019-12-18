<?php
    $peticionAjax = true;
    require_once "../core/configGeneral.php";
    if(isset($_POST['pan'])) {
        require_once "../controller/pedidoControlador.php";
        $pedido = new pedidoControlador();
        if(isset($_POST['pan']) && isset($_POST['cantidad']) && isset($_POST['subtotal']) && isset($_POST['folio'])) {
            echo $pedido->guardar_detalle_pedido_controlador();
        }
    } else {
        session_start(['name'=>'SPSJ']);
        session_destroy();
        echo '<script>
            window.location.href="'.$serverurl.'login/"
        </script>';
    }