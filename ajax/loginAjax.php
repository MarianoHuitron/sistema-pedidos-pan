<?php
    $peticionAjax = true;
    require_once "../core/configGeneral.php";
    if(isset($_GET['Token'])) {
        require_once "../controller/loginControlador.php";
        $logout = new loginControlador();
        echo $logout->cerrar_sesion_controlador();
    } else {
        session_start();
        session_destroy();
        echo '<script>
            window.location.href="'.$serverurl.'login/"
        </script>';
    }