<?php
    $peticionAjax = true;
    require_once "../core/configGeneral.php";
    if(isset($_POST['nombre_pan']) || isset($_POST['codigoDelete']) || isset($_POST['codigo-edit'])) {
        require_once "../controller/panControlador.php";
        $pan = new panControlador();

        if(isset($_POST['nombre_pan']) && isset($_POST['precio_pan']) && !isset($_POST['codigo-edit'])) {
            echo $pan->agregar_pan_controlador();
        }

        if(isset($_POST['codigoDelete'])) {
            echo $pan->eliminar_pan_controlador();
        }

        if(isset($_POST['codigo-edit']) && isset($_POST['nombre_pan']) && isset($_POST['precio_pan'])) {
            echo $pan->actualizar_pan_controlador();
        }
    } else {
        session_start();
        session_destroy();
        echo '<script>
            window.location.href="'.$serverurl.'login/"
        </script>';
    }