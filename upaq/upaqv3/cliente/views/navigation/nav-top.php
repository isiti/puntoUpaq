<section id="nav-top">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <span class="col navbar-brand logo-top-nav" id="sidebar-action">
            <img src="<?="//$url_web/"?>assets/images/logos/upaqLogo.png" alt="logo-upaq">
        </span>
        <button class="col icon-top navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li>
                    <a class="dropdown-item" id="nuevo_pedido" href="<?="//$url_web/"?>home">Nuevo Pedido</a>
                </li>
                <li>
                    <span class="dropdown-item" id="mis_pedidos">Mis Pedidos</span>
                </li>
                <li>
                    <a class="dropdown-item" id="mi_perfil" href="<?="//$url_web/"?>perfil">Perfil</a>
                </li>
                <li>
                    <a class="dropdown-item" href="?logout=true">Salir de Upaq</a>
                </li>                
            </ul>
        </div>
    </nav>       
</section>

<!-- 
// donde estoy: 
    0: nuevo Pedido
    1: mis pedidos
    2: perfil 
-->
<input id="wia" type="text" value="" hidden/>

<separador_nav></separador_nav>