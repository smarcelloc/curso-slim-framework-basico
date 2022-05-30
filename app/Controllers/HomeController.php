<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class HomeController
{
    public function index(Request $req, Response $res): Response
    {
        return $res->withJson([
            'status' => true,
            'response' => [
                'name' => 'API Lojas',
                'version' => 'v1.0',
            ]
        ]);
    }
}
