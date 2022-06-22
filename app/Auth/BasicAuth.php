<?php

namespace App\Auth;

use Slim\Http\Response;
use Tuupola\Middleware\HttpBasicAuthentication;

class BasicAuth
{
    /**
     * Usuários permitidos para acessar o sistema.
     *
     * @var array
     */
    private $users = [
        'admin' => 'admin',
        'root' => 'password',
        'fernanda' => 'ff03',
        'thiago' => 'tt06'
    ];

    /**
     * Executar a autenticação Basic Auth
     *
     * @return HttpBasicAuthentication
     */
    public function run()
    {
        return new HttpBasicAuthentication([
            'users' => $this->users,
            'error' => function (Response $res, array $args) {
                return $this->handlerUnauthorized($res);
            }
        ]);
    }

    /**
     * Body da requisição não autorizada
     *
     * @param Response $res
     * @return Response
     */
    private function handlerUnauthorized(Response $res): Response
    {
        return $res->withJson(['status' => false, 'message' => 'Acesso não autorizado'], 401);
    }
}
