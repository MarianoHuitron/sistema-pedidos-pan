<?php
    session_start(['name'=>'SPSJ']);
    if(!isset($_SESSION['token_spsj'])) {
        header("Location: Error");
    } else {
        $peticionAjax = true;
        require_once "../core/configGeneral.php";
        require_once "../controller/panControlador.php";
        $lista = new panControlador();
        echo $lista->mostrar_panes_controlador();
    }
    