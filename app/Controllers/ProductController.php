<?php

namespace App\Controllers;

use App\Repositories\ProductRepository;
use Slim\Http\Request;
use Slim\Http\Response;

class ProductController
{
    /**
     * Mostrar todos produtos
     *
     * @param Request $req
     * @param Response $res
     * @return Response
     */
    public function index(Request $req, Response $res)
    {
        $productRepository = new ProductRepository();
        $products = $productRepository->getAll();
        return $res->withJson(['status' => true, 'response' => $products]);
    }

    /**
     * Inserir um produto
     *
     * @param Request $req
     * @param Response $res
     * @return Response
     */
    public function store(Request $req, Response $res)
    {
        $body = $req->getParsedBody();
        $product = new ProductRepository();
        $id = $product->insert($body);
        return $res->withJson(['status' => true, 'message' => 'Registro cadastrado com sucesso !!!', 'id' =>  $id]);
    }

    /**
     * Atualizar um produto
     *
     * @param Request $req
     * @param Response $res
     * @return Response
     */
    public function update(Request $req, Response $res, array $args)
    {
        $body = $req->getParsedBody();
        $productRepository = new ProductRepository();
        $productRepository->update($args['id'] ?? 0, $body);
        return $res->withJson(['status' => true, 'message' => 'Registro atualizado com sucesso !!!']);
    }

    /**
     * Deletar um produto
     *
     * @param Request $req
     * @param Response $res
     * @param array $args
     * @return Response
     */
    public function delete(Request $req, Response $res, array $args)
    {
        $productRepository = new ProductRepository();
        $productRepository->delete($args['id'] ?? 0);
        return $res->withJson(['status' => true, 'message' => 'Registro deletado com sucesso !!!']);
    }

    /**
     * Mostrar um produto
     *
     * @param Request $req
     * @param Response $res
     * @param array $args
     * @return Response
     */
    public function show(Request $req, Response $res, array $args)
    {
        $productRepository = new ProductRepository();
        $product = $productRepository->getId($args['id'] ?? 0);
        return $res->withJson(['status' => true, 'response' => $product->toArray()]);
    }

    /**
     * Filtrar os produtos que pertencem a sua loja.
     *
     * @param Request $req
     * @param Response $res
     * @param array $args
     * @return void
     */
    public function storeBy(Request $req, Response $res, array $args)
    {
        $productRepository = new ProductRepository();
        $products = $productRepository->storeBy($args['store_id'] ?? 0);
        return $res->withJson(['status' => true, 'response' => $products]);
    }
}
