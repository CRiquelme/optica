<nav class="uk-navbar-container no-print" uk-navbar>
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
            <?php else : ?>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<div id="offcanvas-nav" uk-offcanvas="overlay: true" class="no-print">
	<div class="uk-offcanvas-bar no-print">
		<?php if(isset($tipo_de_usuario) && $tipo_de_usuario === "1") : ?>
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
								<li><a href="<?=base_url('informe-salidas-diaria')?>">Salidas diaria</a></li>
								<li><a href="<?=base_url('libros')?>">Libros</a></li>
						</ul>
				</li>
				<li class="uk-parent"><a href="<?=base_url('detalle-compra')?>">Detalle de compra</a></li>
				<li class="uk-parent"><a href="<?=base_url('rendicion-caja')?>">Rendición de caja</a></li>
				<li class="uk-nav-divider"></li>
				<li class="uk-parent"><a href="<?=base_url('password')?>">Cambiar contraseña personal</a></li>
				<li class="uk-parent"><a href="<?=base_url('registro')?>">Usuarios</a></li>
				<li class="uk-nav-divider"></li>
				<li class="uk-parent"><a href="<?=base_url('logout')?>">Cerrar sesión</a></li>
			</ul>
		<?php elseif(isset($tipo_de_usuario) && $tipo_de_usuario === "2") : ?>
			<a class="uk-navbar-item uk-logo" href="<?=base_url('dashboard');?>">
				<img src="<?php echo base_url('public/images/logo.jpg');?>">
			</a>
			<ul class="uk-nav uk-nav-default">
				<li class="uk-parent"><a href="<?=base_url('dashboard')?>">Dashboard</a></li>
				<li class="uk-parent"><a href="<?=base_url('clientes')?>">Clientes</a></li>
				<li class="uk-parent">
						<a>Productos</a>
						<ul class="uk-nav-sub">
							<li><a href="<?=base_url('stock_productos')?>">Stock por tiendas</a></li>
						</ul>
				</li>
				<li class="uk-parent"><a href="<?=base_url('detalle-compra')?>">Detalle de compra</a></li>
				<li class="uk-parent"><a href="<?=base_url('rendicion-caja')?>">Rendición de caja</a></li>
				<li class="uk-nav-divider"></li>
				<li class="uk-parent"><a href="<?=base_url('logout')?>">Cerrar sesión</a></li>
			</ul>
		<?php else: ?>
			<a class="uk-navbar-item uk-logo" href="<?=base_url('dashboard');?>">
				<img src="<?php echo base_url('public/images/logo.jpg');?>">
			</a>
		<?php endif; ?>
	</div>
</div>