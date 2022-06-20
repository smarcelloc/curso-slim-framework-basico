<?php

namespace App\Supports\HandlerError;

use Slim\Http\Request;
use Slim\Http\Response;

class CustomPhpErrorHandler
{
    public function __invoke(Request $req, Response $res, \Throwable $th)
    {
        $body = ['status' => false, 'message' => 'Ocorreu algum erro no servidor !!!'];
        if (!isProduction()) {
            $body = array_merge($body, ['exception' => getException($th)]);
        }

        return $res->withJson($body, 500);
    }
}
