<?php

namespace App\Supports\HandlerError;

use Slim\Http\Request;
use Slim\Http\Response;

class CustomNotFoundHandler
{
    public function __invoke(Request $req, Response $res)
    {
        return $res->withJson(['status' => false, 'message' => 'Não foi encontrado !!!'], 404);
    }
}
