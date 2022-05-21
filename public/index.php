<?php

use Slim\Http\Request;
use Slim\Http\Response;

require __DIR__ . '/../vendor/autoload.php';

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$container = new \Slim\Container($configuration);
$app = new \Slim\App($container);

// Primeira Forma - Middleware (Função de 1ª Classe - são funções que armazena na variável)
$middleware01 = function (Request $req, Response $res, $next) {
    $user = $req->getParsedBodyParam('user', null);
    $password = $req->getParsedBodyParam('password', null);

    if ($user !== 'admin' || $password !== 'password') {
        return $res->withJson(['status' => false, 'message' => 'Not Authorization !!!'], 403);
    }

    return $next($req, $res);
};

$app->post('/produto/listar', function (Request $req, Response $res) {
    $data = [
        'status' => true,
        'response' => [
            [
                'name' => 'PC',
                'price' => 300.23
            ],
            [
                'name' => 'Notebook',
                'price' => 1233.32
            ]
        ],
    ];

    return $res->withJson($data);
})->add($middleware01);


$app->group('/people', function () use ($app) {
    $app->get('/listar', function (Request $req, Response $res) {
        return $res->withJson(['status' => true, 'message' => 'people listar']);
    });

    $app->get('/new', function (Request $req, Response $res) {
        return $res->withJson(['status' => true, 'message' => 'people new']);
    });
})->add($middleware01);

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

    return $res->withJson(['status' => true, 'message' => 'Parâmetro limit = ' . $limit]);
});

$app->delete('/produto/{id:[0-9]+}', function (Request $req, Response $res, array $args) {
    return $res->withJson(['status' => true, 'response' => $args], 200);
});


$app->run();
