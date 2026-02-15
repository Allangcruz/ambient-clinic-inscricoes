<?php

use CodeIgniter\Router\RouteCollection;

use App\Controllers\LoginController;
use App\Controllers\InscricaoController;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
// $routes->post('/auth/autenticar', [LoginController::class, 'autenticar']);

$routes->get('/', [InscricaoController::class, 'index']);
$routes->get('/inscricoes', [InscricaoController::class, 'index']);
$routes->get('/api/inscricoes', [InscricaoController::class, 'listar']);
