<?php

use App\Controllers\HomeController;
use App\Controllers\ProductController;
use App\Controllers\StoreController;
use App\Middleware\SanitizeMiddleware;
use App\Supports\Application;

$app = new Application();

// Middleware padrão
$app->add(new SanitizeMiddleware());

// Rota principal
$app->get('/', HomeController::class . ':index');

// Rota de loja
$app->get('/store', StoreController::class . ':index');
$app->get('/store/{id:[0-9]+}', StoreController::class . ':show');
$app->post('/store', StoreController::class . ':store');
$app->put('/store/{id:[0-9]+}', StoreController::class . ':update');
$app->delete('/store/{id:[0-9]+}', StoreController::class . ':delete');

// Rota de produtos
$app->get('/product', ProductController::class . ':index');
$app->get('/product/{id:[0-9]+}', ProductController::class . ':show');
$app->post('/product', ProductController::class . ':store');
$app->put('/product/{id:[0-9]+}', ProductController::class . ':update');
$app->delete('/product/{id:[0-9]+}', ProductController::class . ':delete');
$app->get('/product/store/{store_id:[0-9]+}', ProductController::class . ':storeBy');

// Executar a aplicação
$app->run();
