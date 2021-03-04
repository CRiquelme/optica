<nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left uk-margin-medium-left">
        <a class="uk-navbar-item uk-logo" href="<?=base_url('dashboard');?>">
            <img src="<?php echo base_url('public/images/logo.jpg');?>">
        </a>
    </div>
    
    <div class="uk-navbar-left uk-margin-medium-left">
        <ul class="uk-navbar-nav">
            <?php // $activo viene de libraries > ViewComponents.php ?>

            <?php if(isset($logged_in) && $logged_in == 1) : ?>
                <li>
                    <a href="#offcanvas-nav" uk-toggle><i class="fas fa-ellipsis-v"></i> &nbsp; Menú</a>
                </li>
                <!-- <li class="<?//= $activo == 'inicio' || $activo == '' ? 'uk-active': 'uk-parent';?>"><a href="<?//=base_url('inicio')?>">Inicio</a></li> -->
            <?php else : ?>
                <!-- <li class="<?//= $activo == 'login' ? 'uk-active': 'uk-parent';?>"><a href="<?//=base_url('login')?>">Login</a></li> -->
                <!-- <li class="<?//= $activo == 'registro' ? 'uk-active': 'uk-parent';?>"><a href="<?//=base_url('registro')?>">Registro</a></li> -->
            <?php endif; ?>
        </ul>
    </div>
</nav>

<div id="offcanvas-nav" uk-offcanvas="overlay: true">
    <div class="uk-offcanvas-bar">
        <a class="uk-navbar-item uk-logo" href="<?=base_url('dashboard');?>">
            <img src="<?php echo base_url('public/images/logo.jpg');?>">
        </a>
        <ul class="uk-nav uk-nav-default">
            <li class="uk-parent"><a href="<?=base_url('dashboard')?>">Dashboard</a></li>
            <li class="uk-parent"><a href="<?=base_url('clientes')?>">Clientes</a></li>
            <li class="uk-parent">
                <a href="<?=base_url('productos')?>">Productos</a>
                <ul class="uk-nav-sub">
                    <li><a href="<?=base_url('ingreso_productos')?>">Ingresos</a></li>
                    <li><a href="<?=base_url('salida_productos')?>">Salida</a></li>
                    <li><a href="<?=base_url('stock_productos')?>">Stock por tiendas</a></li>
                    <li class="uk-parent"><a href="<?=base_url('traslados')?>">Traslados</a></li>
                </ul>
            </li>
            <li class="uk-parent"><a href="<?=base_url('cristales')?>">Cristales</a></li>
            <li class="uk-parent">
                <a href="#">Informes</a>
                <ul class="uk-nav-sub">
                    <li><a href="<?=base_url('informe-traslados')?>">Traslados</a></li>
                    <li><a href="<?=base_url('informe-stock-precios')?>">Precios stock</a></li>
                </ul>
            </li>
            <!-- <li class="uk-parent"><a href="<?//=base_url('sobre')?>">Registro sobre</a></li> -->
            <li class="uk-nav-divider"></li>
            <li class="uk-parent"><a href="<?=base_url('password')?>">Cambiar contraseña personal</a></li>
            <li class="uk-parent"><a href="<?=base_url('registro')?>">Usuarios</a></li>
            <li class="uk-nav-divider"></li>
            <li class="uk-parent"><a href="<?=base_url('logout')?>">Cerrar sesión</a></li>
            <!-- <li class="uk-parent">
                <a href="#">Parent</a>
                <ul class="uk-nav-sub">
                    <li><a href="#">Sub item</a></li>
                    <li><a href="#">Sub item</a></li>
                </ul> -->
            <!-- </li>
            <li class="uk-nav-header">Header</li>
            <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: table"></span> Item</a></li>
            <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Item</a></li>
            <li class="uk-nav-divider"></li>
            <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: trash"></span> Item</a></li> -->
        </ul>

    </div>
</div>