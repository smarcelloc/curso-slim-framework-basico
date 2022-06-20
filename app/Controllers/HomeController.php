<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Classe de controller do Home
 */
class HomeController
{
    /**
     * Exibir informação inicial ao usuário final.
     * 
     * @param Request $req
     * @param Response $res
     * @return Response
     */
    public function index(Request $req, Response $res): Response
    {
        return $res->withJson([
            'status' => true,
            'response' => [
                'name' => APP['name'],
                'version' => APP['version'],
            ]
        ]);
    }
}
