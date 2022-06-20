<?php

namespace App\Supports\HandlerError;

use Respect\Validation\Exceptions\NestedValidationException;
use Slim\Http\Request;
use Slim\Http\Response;

class CustomExceptionHandler
{
    public function __invoke(Request $req, Response $res, \Exception $ex)
    {
        if ($ex instanceof NestedValidationException) {
            return $res->withJson(['status' => false, 'message' => 'Validação inválida', 'errors' => $ex->getMessages()], 422);
        }

        if ($ex instanceof \InvalidArgumentException) {
            return $res->withJson(['status' => false, 'message' => $ex->getMessage()], 400);
        }

        $body = ['status' => false, 'message' => 'Ocorreu algum erro inesperável !!!'];
        if (!isProduction()) {
            $body = array_merge($body, ['exception' => getException($ex)]);
        }

        return $res->withJson($body, 400);
    }
}
