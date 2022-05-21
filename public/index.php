<?php

use Slim\Http\Request;
use Slim\Http\Response;

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App();

// HELLO WORLD!
$app->get('/', function (Request $req, Response $res) {
    return $res->withJson(['status' => true, 'message' => 'Bem-vindo ao Slim']);
});

// Captura de parâmetro GET
$app->get('/produto', function (Request $req, Response $res) {
    // Ex: /produto?limit=10

    // Primeira Forma
    // $query = $req->getQueryParams();
    // $limit = $query['limit'] ?? null;

    // Segunda Forma
    //$limit = $req->getParam('limit', null); Body ou Query ('?=limit=100')

    // Terceira Forma
    //$limit = $_GET['limit'] ?? null;

    // Quarta Forma
    $limit = $req->getQueryParam('limit', null);


    if (!$limit || !is_numeric($limit)) {
        return $res->withJson(['status' => false, 'message' => 'O parâmetro é obrigatório e numérico \'?limit=100\''], 400);
    }

    return $res->withJson(['status' => true, 'message' => 'Parametro limit = ' . $limit]);
});

$app->delete('/produto/{id:[0-9]+}', function (Request $req, Response $res, array $args) {
    return $res->withJson(['status' => true, 'response' => $args], 200);
});


$app->run();
