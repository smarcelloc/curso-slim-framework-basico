<?php

namespace App\Supports\HandlerError;

use Slim\Http\Request;
use Slim\Http\Response;

class CustomNotAllowedHandler
{
    public function __invoke(Request $req, Response $res, array $methods)
    {
        return $res->withJson(['status' => false, 'message' => 'Método não permitido !!!'], 405);
    }
}
