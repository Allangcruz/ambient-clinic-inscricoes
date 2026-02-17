<?php

use App\Controllers\InscricaoController;

$routes->get('/', [InscricaoController::class, 'viewInscricoes']);

$routes->resource('/api/inscricoes', [
    'namespace' => '',
    'controller'=> InscricaoController::class,
    'only' => ['index', 'show', 'delete', 'update'],
]);
