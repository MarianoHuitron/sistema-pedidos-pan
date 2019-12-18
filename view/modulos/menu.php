<aside class="sidebar">
    <div class="usuario">
        <img src="<?php echo $serverurl ?>view/assets/img/user.png" alt="user">
        <p>Bienvenid@: <span><?php echo $_SESSION['usuario_spsj']; ?> </span> </p>
    </div>
    
    <div class="menu-admin">
        <h2 style="color: #fff;">Menú de administración</h2>
        <ul class="menu">
            <li><a href="<?php echo $serverurl ?>home/"><i class="fa fa-home"></i> Inicio</a></li>
            <li>
                <a href="#">
                    <i class="fa fa-address-book"></i>
                    Clientes
                </a>
                <ul>
                    <li>
                        <a href="<?php echo $serverurl ?>cliente/">
                            <i class="fa fa-list"></i> 
                            Ver Todos
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $serverurl ?>nuevocliente/">
                            <i class="fa fa-plus"></i> 
                            Agregar Nuevo
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-chart-line"></i>
                    Pedidos
                </a>
                <ul>
                    <li>
                        <a href="<?php echo $serverurl ?>pedidos/">
                            <i class="fa fa-list"></i> 
                            Ver Todos
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $serverurl ?>nuevopedido/">
                            <i class="fa fa-plus"></i> 
                            Agregar Nuevo
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-box"></i>
                    Productos
                </a>
                <ul>
                    <li>
                        <a href="<?php echo $serverurl ?>pan/">
                            <i class="fa fa-list"></i> 
                            Ver Todos
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $serverurl ?>nuevopan/">
                            <i class="fa fa-plus"></i> 
                            Agregar Nuevo
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-users"></i>
                    Usuarios
                </a>
                <ul>
                    <li>
                        <a href="<?php echo $serverurl ?>usuarios/">
                            <i class="fa fa-list"></i> 
                            Ver Todos
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $serverurl ?>nuevousuario/">
                            <i class="fa fa-plus"></i> 
                            Agregar Nuevo
                        </a>
                    </li>
                </ul>

            </li>
        </ul>
    </div>
</aside>