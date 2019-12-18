<?php
session_start(['name'=>'SPSJ']);
 if(isset($_SESSION['token_spsj'])) {
    echo '<script>
    window.location.href="'.$serverurl.'home/"</script>';
 }
?>

<style>
.container-login {
  /* background-image: url(view/assets/img/hands.jpg); */
  /* background: #2371a5; */
  background: #373B44;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #4286f4, #373B44);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #4286f4, #373B44); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

  height: 100%;
  display: flex;
	align-items: center;
  justify-content: center;
  text-align: center;

}
</style>
<div class="text-center  d-flex justify-content-center container-login" style="height: 100vh;">
    <!-- Default form contact -->
    <form class="text-center border border-light p-5  logInForm" style="max-width: 360px; margin: auto auto; background: #fff;" action="" method="POST" autocomplete="off">

        <p class="h4 mb-4">Iniciar Sesión</p>

        <!-- Name -->
        <input type="text" name="Usuario" class="form-control mb-4" placeholder="Usuario" required>

        <!-- Email -->
        <input type="password" name="Clave" class="form-control mb-4" placeholder="Contraseña" required>

        <!-- Send button -->
        <button class="btn btn-info btn-block" type="submit">Entrar</button>
            <!-- <span class="spinner  spinner-border-sm" role="status" aria-hidden="true"></span> -->
            <!-- <span class="textoBtn">Entrar</span> -->

        <div class="alert alert-danger mt-3 alerta d-none" role="alert">
            Usuario no encontrado
        </div>
    </form>
    <!-- Default form contact -->
</div>

<?php

    if(isset($_POST['Usuario']) && isset($_POST['Clave'])) {
        require_once "./controller/loginControlador.php";
        $entrar = new loginControlador();
        echo $entrar->iniciar_sesion_controlador();
    }
?>

