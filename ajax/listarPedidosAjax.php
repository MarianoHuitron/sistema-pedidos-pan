<?php
    session_start(['name'=>'SPSJ']);
    if(!isset($_SESSION['token_spsj'])) {
        header("Location: Error");
    } else {
        $peticionAjax = true;
        require_once "../core/configGeneral.php";
        require_once "../controller/pedidoControlador.php";
        $lista = new pedidoControlador();
        echo $lista->mostrar_pedido_controlador();
    }
    