<?php

namespace App\Controllers;

use App\Repositories\ProductRepository;
use App\Repositories\StoreRepository;
use Slim\Http\Request;
use Slim\Http\Response;

class ProductController
{
    public function store(Request $req, Response $res)
    {
        try {
            $body = $req->getParsedBody();
            $product = new ProductRepository();
            $id = $product->insert($body);

            return $res->withJson(['status' => true, 'message' => 'Produto cadastrado com sucesso !!!', 'id' =>  $id]);
        } catch (\InvalidArgumentException $ex) {
            return $res->withJson(['status' => false, 'message' => $ex->getMessage()], 400);
        }
    }
}
