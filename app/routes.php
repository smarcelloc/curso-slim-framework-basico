<?php

/**
 * Declaração de rotas de API.
 */

use App\Controllers\HomeController;

$app = new \Slim\App();

$app->get('/', HomeController::class . ':index');

$app->run();
