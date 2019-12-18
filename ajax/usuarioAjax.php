<?php
    $peticionAjax=true;
    require_once "../core/configGeneral.php";
    if(isset($_POST['usuario']) || isset($_POST['codigoDelete']) || isset($_POST['codigo-editar'])) {
        require_once "../controller/usuarioControlador.php";
        $usuario = new usuarioControlador();

        if(isset($_POST['usuario']) && isset($_POST['clave1']) && isset($_POST['clave2']) && !isset($_POST['codigo-editar'])) {
            echo $usuario->agregar_usuario_controlador();
        }

        if(isset($_POST['codigoDelete'])) {
            echo $usuario->eliminar_usuario_controlador();
        }

        if(isset($_POST['codigo-editar']) && isset($_POST['usuario']) && isset($_POST['clave1']) && isset($_POST['clave2'])) {
            echo $usuario->actualizar_usuario_controlador();
        }
    } else {
        session_start();
        session_destroy();
        echo '<script>
            window.location.href="'.$serverurl.'login/"
        </script>';
    }