<?php 
    $url = new serverUrl();
    $serverurl = $url->SERVERURL();
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo EMPRESA ?></title>
    <link rel="stylesheet" href="<?php echo $serverurl ?>view/css/fontAwesome.min.css">
    <link rel="stylesheet" href="<?php echo $serverurl  ?>view/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $serverurl ?>view/css/mdb.min.css">
    <link rel="stylesheet" href="<?php echo $serverurl  ?>view/css/animated.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $serverurl  ?>view/css/dataTableJquery.css">
    <link rel="stylesheet" href="<?php echo $serverurl  ?>view/css/style.css">
    
    <?php include "view/modulos/scripts.php"; ?>
     <!--====== Scripts -->
     <script>
    function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }

    function nuevaLocalidad() {
    // guarda los elementos html en variables
    let localidadSelect = document.getElementById('localidadSelect');
    let localidadInput = document.getElementById('localidadInput');
    // selecciona el input
    let input = localidadInput.children[1];

    if(localidadSelect.value === "nuevo") {
        // remueve el atributo name
        localidadSelect.removeAttribute('name');
        // remueve la clase d-none para hacerlo visible
        localidadInput.classList.remove('d-none');
        // agrega el name al input
        input.setAttribute('name','localidad');
        input.setAttribute('required','')
       
    } else {
        localidadSelect.setAttribute('name','localidad');
        input.removeAttribute('name');
        console.log(localidadInput.className+=" d-none");
        input.removeAttribute('required')
    }
}
</script>

</head>
<body>
    <?php
        $peticionAjax = false;
        require_once "./controller/vistasControlador.php";
        $vt = new vistasControlador();
        $vistasR = $vt -> obtener_vistas_controlador();

        if($vistasR == "login" || $vistasR == "404"):
            if ($vistasR == "login") {
                require_once "./view/contents/login-view.php";
            } else {
                require_once "./view/contents/404-view.php";
            }
        else:
            // session_destroy();
            session_start(['name'=>'SPSJ']);
            require_once "./controller/loginControlador.php";
            $lc = new loginControlador();
            if(!isset($_SESSION['token_spsj']) || !isset( $_SESSION['usuario_spsj'])) {
                $lc->forzar_cierre_sesion_controlador();
            }
    ?>

    <div class="pagina">
        <?php
            include 'view/modulos/nav.php';
        ?>
        <main class="contenedor-principal">
            <!-- sidebar menu -->
            <?php include 'view/modulos/menu.php' ?>

            <!-- contenido -->
            <div class="contenido">
                <?php 
                    require_once   $vistasR; 
                ?>
            </div>
        </main>
    </div>

    <?php 
        include "./view/modulos/logoutScript.php";
        endif; 
    ?>

<script src="<?php echo $serverurl  ?>view/js/sweetalert.min.js"></script>
<script src="<?php echo $serverurl  ?>view/js/mdb.min.js"></script>
</body>
</html>