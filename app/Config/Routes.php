<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/login', 'Home::index');
$routes->get('/inscription', 'Home::index');

$routes->get('/base', 'ConnexionController::connexion');

$routes->get('/home', 'Home::home');

$routes->get('/ajout', 'Home::ajout');
$routes->post('/ajout', 'Home::ajout');

$routes->get('/stats', 'Home::stats');
