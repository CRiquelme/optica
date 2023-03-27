<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
$routes->get('inicio', 'Home::index');
$routes->get('nuevo', 'Home::create');
$routes->get('registro', 'Registro::index');
$routes->get('logout', 'Registro::logout');
$routes->get('password', 'Registro::password');
$routes->get('perfil', 'Perfil::index');
$routes->get('login', 'Login::index');
$routes->get('dashboard', 'Dashboard::index');
$routes->get('clientes', 'Dashboard::clientes');
$routes->get('productos', 'ProductosController::index');

$routes->get('cristales', 'CristalesController::index');
$routes->get('salida_cristales', 'CristalesController::salida_cristales');

$routes->get('convenios', 'ConveniosController::index');

$routes->get('facturas_emitidas', 'FacturasEmitidasController::index');

$routes->get('clientes_empresas', 'ClientesEmpresasController::index');



$routes->get('sobre', 'SobreController::index');
$routes->get('sobre/(:any)', 'SobreController::cliente/$1');
$routes->get('libros', 'LibrosController::index');
$routes->get('libro/(:any)', 'LibrosController::libro/$1');

$routes->get('rendicion-caja', 'RendicionCajaController::index');

$routes->get('traslados', 'TrasladosController::index');
$routes->get('informe-traslados', 'TrasladosController::informeTraslados');
$routes->get('stock_productos', 'StockController::index');
$routes->get('informe-stock-precios', 'StockController::informeStockPrecios');
$routes->get('ingreso_productos', 'ProductosController::ingreso_productos');
$routes->get('lista-productos', 'ProductosController::listProducts');
$routes->get('salida_productos', 'ProductosController::salida_productos');
$routes->get('informe-salidas-diaria', 'ProductosController::salidasDiaria');
$routes->get('consulta_salida_productos', 'ConsultasController::cSalidaProductos');


// REST
// Primero las routes más específicas y luego las genéricas
$routes->get('rest-traslados/tiendas/', 'RestTraslados::tiendas'); // específica
$routes->get('rest-traslados/productos/', 'RestTraslados::productos'); // específica
$routes->get('rest-traslados/informeTraslados/(:any)', 'RestTraslados::informeTraslados/$1'); // específica
$routes->resource('rest-traslados', ['controller' => 'RestTraslados']); // genérica

// $routes->get('rest-salida-productos/fechas/(:any)', 'RestSalidaProductos::fechas/$1');
$routes->get('rest-rendicion-caja/fecha/(:any)', 'RestRendicionCaja::fecha/$1');
$routes->get('rest-rendicion-caja/fecha-tienda/(:any)/(:any)', 'RestRendicionCaja::fecha/$1/$2');
$routes->put('rest-rendicion-caja/eliminar-tbk-sombras/(:any)', 'RestRendicionCaja::eliminarTbkSombras/$1');
$routes->resource('rest-rendicion-caja', ['controller' => 'RestRendicionCaja']); // genérica

$routes->get('cliente_info/fromRut/(:any)', 'RestClientes::fromRut/$1');
$routes->resource('rest-clientes', ['controller' => 'RestClientes']); // genérica

$routes->get('rest-stock/show-codigo/(:num)', 'RestStock::showCodigo/$1'); // específica
$routes->get('rest-stock/estadisticaStock/', 'RestStock::estadisticaStock'); // específica
// $routes->get('rest-stock/stock-producto-tienda/(:num)/(:num)', 'RestStock::stockProductoTienda/$1/$1'); // específica
$routes->resource('rest-stock', ['controller' => 'RestStock']); // genérica

$routes->resource('rest-productos', ['controller' => 'RestProductos']); // genérica

$routes->resource('rest-cristales', ['controller' => 'RestCristales']); // genérica
$routes->get('rest-salida-cristales/ultimo/(:any)', 'RestSalidaCristales::ultimo/$1');
$routes->get('resumen-cristales', 'RestCristales::resumenCristales');
$routes->resource('rest-salida-cristales', ['controller' => 'RestSalidaCristales']);

$routes->get('rest-libros/cliente/(:num)', 'RestLibros::cliente/$1'); // genérica
$routes->get('rest-libros/fecha/(:any)', 'RestLibros::fecha/$1'); // genérica
$routes->resource('rest-libros', ['controller' => 'RestLibros']); // genérica

$routes->resource('rest-convenios', ['controller' => 'RestConvenios']); // genérica

$routes->resource('rest-facturas-emitidas', ['controller' => 'RestFacturasEmitidas']); // genérica

$routes->resource('rest-clientes-empresas', ['controller' => 'RestClientesEmpresas']); // genérica

$routes->put('rest-usuario/update-password', ['controller' => 'RestUsuario']); // genérica
$routes->resource('rest-usuario', ['controller' => 'RestUsuario']); // genérica

$routes->get('rest-ingreso-productos/total_factura/(:any)', 'RestIngresoProductos::totalFatura/$1');
$routes->get('rest-ingreso-productos/detalle_factura/(:any)', 'RestIngresoProductos::detalleFatura/$1');
$routes->resource('rest-ingreso-productos', ['controller' => 'RestIngresoProductos']); // genérica

$routes->get('rest-salida-productos/informeSalidasDiarias/(:any)', 'RestSalidaProductos::salidasDiaria/$1'); // específica
$routes->get('rest-salida-productos/fechas/(:any)', 'RestSalidaProductos::fechas/$1');
$routes->resource('rest-salida-productos', ['controller' => 'RestSalidaProductos']);

$routes->get('rest-sobre/cliente/(:num)', 'RestSobre::cliente/$1');
$routes->resource('rest-sobre', ['controller' => 'RestSobre']); // genérica


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}