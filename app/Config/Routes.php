<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
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

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/', 'Ppdb/Home::index', ['filter' => 'userlogin']);
$routes->get('/', 'Ppdb/Data::index', ['filter' => 'userlogin']);
$routes->get('/', 'Datapendaftar::add', ['filter' => 'userlogin']);
// $routes->get('admin/pengaturan', 'Backend/pengaturan::index', ['filter' => 'role-permission']);

$routes->group('admin', function ($routes) {
    /**
     * Admin routes.
     **/
    $routes->group('/', [
        'filter'    => config('Boilerplate')->dashboard['filter'],
        'namespace' => config('Boilerplate')->dashboard['namespace'],
    ], function ($routes) {
        $routes->get('/', config('Boilerplate')->dashboard['controller']);
    });

    $routes->resource('pengaturan', [
        'filter'     => 'permission:back-office',
        'namespace'  => 'App\Controllers\Backand',
        'controller' => 'Pengaturan',
        'except'     => 'show',
    ]);
    $routes->resource('datapendaftar', [
        'filter'     => 'permission:back-office',
        'namespace'  => 'App\Controllers\Backand',
        'controller' => 'Datapendaftar',
        'except'     => 'show',
    ]);
    /**
     * User routes.
     **/
    $routes->group('user', [
        'filter'    => 'permission:back-office',
        'namespace' => 'App\Controllers\Users',
    ], function ($routes) {
        $routes->match(['get', 'post'], 'profile', 'UserController::profile', ['as' => 'user-profile']);
        $routes->resource('manage', [
            'filter'     => 'permission:manage-user',
            'namespace'  => 'App\Controllers\Users',
            'controller' => 'UserController',
            'except'     => 'show',
        ]);
    });

    /**
     * Permission routes.
     */
    $routes->resource('permission', [
        'filter'     => 'permission:role-permission',
        'namespace'  => 'App\Controllers\Users',
        'controller' => 'PermissionController',
        'except'     => 'show,new',
    ]);

    /**
     * Role routes.
     */
    $routes->resource('role', [
        'filter'     => 'permission:role-permission',
        'namespace'  => 'App\Controllers\Users',
        'controller' => 'RoleController',
    ]);

    /**
     * Menu routes.
     */
    $routes->resource('menu', [
        'filter'     => 'permission:menu-permission',
        'namespace'  => 'App\Controllers\Users',
        'controller' => 'MenuController',
        'except'     => 'new,show',
    ]);

    $routes->put('menu-update', 'MenuController::new', [
        'filter'    => 'permission:menu-permission',
        'namespace' => 'App\Controllers\Users',
        'except'    => 'show',
        'as'        => 'menu-update',
    ]);
});

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
