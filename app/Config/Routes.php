<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
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

$routes->get('sobre', 'SobreController::index');
$routes->get('traslados', 'TrasladosController::index');
$routes->get('stock_productos', 'StockController::index');
$routes->get('ingreso_productos', 'ProductosController::ingreso_productos');
$routes->get('salida_productos', 'ProductosController::salida_productos');
$routes->get('consulta_salida_productos', 'ConsultasController::cSalidaProductos');

// REST
// Primero las routes más específicas y luego las genéricas
$routes->get('rest-traslados/tiendas', 'RestTraslados::tiendas'); // específica
$routes->get('rest-traslados/productos', 'RestTraslados::productos'); // específica
$routes->resource('rest-traslados', ['controller' => 'RestTraslados']); // genérica

$routes->get('rest-stock/show-codigo/(:num)', 'RestStock::showCodigo/$1'); // específica
$routes->resource('rest-stock', ['controller' => 'RestStock']); // genérica

$routes->resource('rest-productos', ['controller' => 'RestProductos']); // genérica

$routes->resource('rest-cristales', ['controller' => 'RestCristales']); // genérica
$routes->get('rest-salida-cristales/ultimo/(:any)', 'RestSalidaCristales::ultimo/$1');
$routes->resource('rest-salida-cristales', ['controller' => 'RestSalidaCristales']);

$routes->put('rest-usuario/update-password', ['controller' => 'RestUsuario']); // genérica
$routes->resource('rest-usuario', ['controller' => 'RestUsuario']); // genérica

$routes->resource('rest-ingreso-productos', ['controller' => 'RestIngresoProductos']); // genérica

$routes->get('rest-salida-productos/fechas/(:any)', 'RestSalidaProductos::fechas/$1');
$routes->resource('rest-salida-productos', ['controller' => 'RestSalidaProductos']);

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
