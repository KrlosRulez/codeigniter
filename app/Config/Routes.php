<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Pages;  // Es como un include de Controllers/Pages.php
use App\Controllers\News;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('news', [News::class, 'index']);

$routes->get('news/new', 'News::new');
$routes->post('news/create', [News::class, 'create']);

$routes->get('news/del/(:segment)', [News::class, 'delete']);

$routes->post('news/update/updated/(:segment)', [News::class, 'updatedItem']);
$routes->get('news/update/(:segment)', [News::class, 'update']);

$routes->get('news/(:segment)', [News::class, 'show']); 


$routes->get('pages', 'Pages::index');  // == $routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);

$routes->setAutoRoute(false);