<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Page d'accueil
$routes->get('/', 'Home::home');

// Routes d'authentification
$routes->get('/login', 'ConnexionController::login');
$routes->post('/connexion/do-login', 'ConnexionController::doLogin');
$routes->get('/inscription', 'ConnexionController::register');
$routes->post('/connexion/do-register', 'ConnexionController::doRegister');
$routes->get('/connexion/logout', 'ConnexionController::logout');
$routes->get('/connexion/profile', 'ConnexionController::profile');
$routes->post('/connexion/update-profile', 'ConnexionController::updateProfile');

// Routes des réservations
$routes->get('/reservation/available-slots', 'ReservationController::availableSlots');
$routes->get('/reservation/my-reservations', 'ReservationController::myReservations');
$routes->post('/reservation/create-reservation', 'ReservationController::createReservation');
$routes->post('/reservation/cancel-reservation', 'ReservationController::cancelReservation');
$routes->get('/reservation/slot-details/(:num)', 'ReservationController::slotDetails/$1');

// Pages anciennes
$routes->get('/home', 'Home::home');
$routes->get('/stats', 'Home::stats');
$routes->get('/add-food', 'Home::addFood');

// ============ ROUTES ADMINISTRATEUR ============
$routes->group('admin', function(RouteCollection $routes) {
    // Dashboard
    $routes->get('/', 'AdminController::dashboard');
    $routes->get('dashboard', 'AdminController::dashboard');

    // Gestion des creneaux
    $routes->get('creneaux', 'AdminController::listCreneaux');
    $routes->get('creneaux/create', 'AdminController::createCreneauForm');
    $routes->post('creneaux/store', 'AdminController::storeCreneauForm');
    $routes->get('creneaux/(:num)/edit', 'AdminController::editCreneauForm/$1');
    $routes->post('creneaux/(:num)/update', 'AdminController::updateCreneauForm/$1');
    $routes->post('creneaux/(:num)/delete', 'AdminController::deleteCreneauForm/$1');

    // Gestion des réservations
    $routes->get('reservations', 'AdminController::listReservations');
    $routes->post('reservations/(:num)/status', 'AdminController::changeReservationStatus/$1');

    // Gestion des ressources
    $routes->get('ressources', 'AdminController::listRessources');
    $routes->get('ressources/create', 'AdminController::createRessourceForm');
    $routes->post('ressources/store', 'AdminController::storeRessource');

    // Gestion des utilisateurs
    $routes->get('users', 'AdminController::listUsers');
});
