<?php
    $peticionAjax = true;
    require_once "../core/configGeneral.php";
    require_once "../controller/cobroControlador.php";
    $cobro = new cobroControlador();

    if (isset($_POST['campoFolio']) && isset($_POST['campoSubtotal']) && isset($_POST['campoCodigoPedido'])) {
        echo $cobro->guardar_cobro_controlador();
    } else {
        session_start(['name'=>'SPSJ']);
        session_destroy();
        echo '<script>
            window.location.href="'.$serverurl.'login/"
        </script>';
    }
    