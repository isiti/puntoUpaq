<!-- INFO: Collapsible Sidebar Using Bootstrap 4 -->
<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>UPAQ</h3>
            <strong>UQ</strong>
        </div>

        <ul class="list-unstyled components">
            <!-- menu -->
            <!-- <li class="active">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-home"></i> Inicio
                </a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li> 
                        <a href="#">Pedidos</a>
                    </li>
                    <li>
                        <a href="#">Cadetes</a>
                    </li>
                    <li>
                        <a href="#">Clientes</a>
                    </li>
                </ul>
            </li> -->
            <li>
        
                 <!-- links -->
            <?php 
                $type = get_db_row($_SESSION['id'],'type','users');
                if($type == 'dow'){?>
                    <li id="goInicio" class="d-none">
                        <a><span><i class="fas fa-home"></i> Inicio</span></a>
                    </li>

                    <li id="goPedidos" class="d-none">
                        <a><span><i class="fas fa-box-open"></i> Pedidos</span></a>
                    </li>

                    <li id="goPedidosDow">            
                        <a><span><i class="fas fa-box-open"></i> Pedidos <img src="<?="//$url_web/"?>assets/images/logos/dow_logo.png" alt="logo-dow" width="50px"></span></a>
                    </li>

                    <li id="goCadetes" class="d-none">      
                        <a><span><i class="fas fa-motorcycle"></i> Cadetes</span></a>
                    </li>

                    <li id="goClientes" class="d-none">
                        <a><span><i class="fas fa-user"></i> Clientes</span></a>
                    </li>

                    <li id="goTarifas" class="d-none">    
                        <a><span><i class="fas fa-dollar-sign"></i> Tarifas</span></a>
                    </li>
                <?php } else {?>
                    <li id="goInicio">
                        <a><span><i class="fas fa-home"></i> Inicio</span></a>
                    </li>

                    <li id="goPedidos">
                        <a><span><i class="fas fa-box-open"></i> Pedidos</span></a>
                    </li>

                    <li id="goPedidosDow">            
                        <a><span><i class="fas fa-box-open"></i> Pedidos <img src="<?="//$url_web/"?>assets/images/logos/dow_logo.png" alt="logo-dow" width="50px"></span></a>
                    </li>

                    <li id="goCadetes">      
                        <a><span><i class="fas fa-motorcycle"></i> Cadetes</span></a>
                    </li>

                    <li id="goClientes">
                        <a><span><i class="fas fa-user"></i> Clientes</span></a>
                    </li>

                    <li id="goTarifas">    
                        <a><span><i class="fas fa-dollar-sign"></i> Tarifas</span></a>
                    </li>
                <?php } ?>

        </ul>

    </nav>

    <!-- Page Content  -->
    <div id="content">                    
           
    </div>   
</div>