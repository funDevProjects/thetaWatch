<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
$routes->setDefaultController('ThetaExplorer');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);	//217 Studios Edit

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'ThetaExplorer::index/homepage');
$routes->get('/donate-to-thetawatch', 'ThetaExplorer::index/donate');
$routes->get('/browse-thetawatch-guides', 'ThetaExplorer::index/guides');
$routes->get('/explore-charts-on-thetawatch', 'ThetaExplorer::index/reports');
$routes->get('/contact-thetawatch', 'ThetaExplorer::index/contact');
$routes->get('/features/(:any)', 'ThetaExplorer::content/$1');
$routes->get('/charts/guardian-snapshot/(:any)', 'ThetaExplorer::reports/$1');

$routes->match(['get', 'post'], '/jaxContactform', 'ThetaExplorer::app_formish/contact');
$routes->match(['get', 'post'], 'jaxReports/(:segment)', 'ThetaExplorer::app_reports/$1');
$routes->match(['get', 'post'], 'jaxReports/(:segment)', 'ThetaExplorer::app_reports/$1');

$routes->match(['get', 'post'], 'explore-theta/(:segment)', 'ThetaExplorer::app_reports/$1');

/*
$routes->get('/streaming-on-theta-network', 'ThetaExplorer::pages/streaming');
$routes->get('/staking-and-rewards-on-theta-network', 'ThetaExplorer::pages/staking');
$routes->get('/exploring-theta-network', 'ThetaExplorer::pages/exploring');
$routes->get('/exploring-theta-network/reports/(:segment)', 'ThetaExplorer::pages/exploring/$1');

$routes->match(['get', 'post'], 'explore-theta/(:segment)', 'ThetaExplorer::explorer_api/$1');
$routes->match(['get', 'post'], 'pull-stakes', 'ThetaExplorer::fetch_validators');
*/
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
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
