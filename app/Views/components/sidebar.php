<h2 class="my-2 mx-3 flex-none uppercase">Menú principal</h2>
<ul class="uk-nav uk-nav-default mx-3 text-lg text-black">
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
    <!-- <li class="uk-parent"><a href="<?=base_url('sobre')?>">Registro sobre</a></li> -->
    <li class="uk-nav-divider"></li>
    <li class="uk-parent"><a href="<?=base_url('password')?>">Cambiar contraseña personal</a></li>
    <li class="uk-parent"><a href="<?=base_url('registro')?>">Usuarios</a></li>
    <li class="uk-nav-divider"></li>
    <li class="uk-parent"><a href="<?=base_url('logout')?>">Cerrar sesión</a></li>
</ul>
