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
