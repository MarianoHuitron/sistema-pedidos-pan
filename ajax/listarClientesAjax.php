<?php
    session_start(['name'=>'SPSJ']);
    if(!isset($_SESSION['token_spsj'])) {
        header("Location: Error");
    } else {
        $peticionAjax = true;
        require_once "../core/configGeneral.php";
        require_once "../controller/clienteControlador.php";
        $lista = new clienteControlador();
        echo $lista->mostrar_clientes_controlador();
    }
    