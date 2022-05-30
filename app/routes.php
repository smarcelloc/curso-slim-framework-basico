<?php

/**
 * Declaração de rotas de API.
 */

use App\Controllers\HomeController;
use App\Controllers\ProductController;
use App\Controllers\StoreController;

$app = new \Slim\App(SLIM);

$app->get('/', HomeController::class . ':index');

$app->post('/product', ProductController::class . ':store');

$app->get('/store', StoreController::class . ':index');
$app->post('/store', StoreController::class . ':store');
$app->put('/store/{id:[0-9]+}', StoreController::class . ':update');
$app->delete('/store/{id:[0-9]+}', StoreController::class . ':delete');
$app->get('/store/{id:[0-9]+}', StoreController::class . ':show');

$app->run();
