<header class="header">
    <div class="nombre-sitio">
        <h3 class="escritorio" style="color: white;">Panadería San José <small style="font-size: 1.1rem;">&copy;</small></h3>
        <h1 class="movil">SJ<small style="font-size: 1.1rem;">&copy;</small></h1>
    </div>
    <div class="barra">
        <div class="menu-izquierdo">
            <div class="bars">
            <i class="fas fa-bars"></i>
            </div>
        </div>
        <div class="menu-derecho">
            <div class="caja cerrar">
                <a href="<?php echo $lc->encryption($_SESSION['token_spsj']) ?>" class="btn-exit-system">Cerrar Sesión</a>
            </div>
        </div>
    </div>
</header>