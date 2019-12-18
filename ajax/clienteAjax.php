<?php
    $peticionAjax = true;
    require_once "../core/configGeneral.php";
    if(isset($_POST['nombre_tienda']) || isset($_POST['codigoDelete']) || isset($_POST['codigo']) || isset($_POST['codigo-editar'])) {
        require_once "../controller/clienteControlador.php";
        $cliente = new clienteControlador();

        if(isset($_POST['nombre_tienda']) && isset($_POST['nombre_encargado']) && !isset($_POST['codigo-editar'])) {
            echo $cliente->agregar_cliente_controlador();
        }

        if(isset($_POST['codigoDelete']) ) {
            echo $cliente->eliminar_cliente_controlador();
        }

        if(isset($_POST['codigo-editar']) && isset($_POST['nombre_tienda']) && isset($_POST['nombre_encargado'])) {
            echo $cliente->actualizar_cliente_controlador();
        }
    } else {
        session_start(['name'=>'SPSJ']);
        session_destroy();
        echo '<script>
            window.location.href="'.$serverurl.'login/"
        </script>';
    }