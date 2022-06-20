<?php

namespace App\Controllers;

use App\Repositories\StoreRepository;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Classe de controller da loja
 */
class StoreController
{
    /**
     * Mostrar todas as lojas
     *
     * @param Request $req
     * @param Response $res
     * @return Response
     */
    public function index(Request $req, Response $res)
    {
        $storeRepository = new StoreRepository();
        $stores = $storeRepository->getAll();
        return $res->withJson(['status' => true, 'response' => $stores]);
    }

    /**
     * Inserir uma loja
     *
     * @param Request $req
     * @param Response $res
     * @return Response
     */
    public function store(Request $req, Response $res)
    {
        $body = $req->getParsedBody();
        $storeRepository = new StoreRepository();
        $id = $storeRepository->insert($body ?? []);
        return $res->withJson(['status' => true, 'message' => 'Registrado com sucesso !!!', 'id' =>  $id]);
    }

    /**
     * Atualizar uma loja
     *
     * @param Request $req
     * @param Response $res
     * @return Response
     */
    public function update(Request $req, Response $res, array $args)
    {
        $body = $req->getParsedBody();
        $storeRepository = new StoreRepository();
        $storeRepository->update($args['id'] ?? 0, $body);
        return $res->withJson(['status' => true, 'message' => 'Registro atualizado com sucesso !!!']);
    }

    /**
     * Deletar a loja
     *
     * @param Request $req
     * @param Response $res
     * @param array $args
     * @return Response
     */
    public function delete(Request $req, Response $res, array $args)
    {
        $storeRepository = new StoreRepository();
        $storeRepository->delete($args['id'] ?? 0);
        return $res->withJson(['status' => true, 'message' => 'Registro deletado com sucesso !!!']);
    }

    /**
     * Mostrar uma loja
     *
     * @param Request $req
     * @param Response $res
     * @param array $args
     * @return Response
     */
    public function show(Request $req, Response $res, array $args)
    {
        $storeRepository = new StoreRepository();
        $store = $storeRepository->getId($args['id'] ?? 0);
        return $res->withJson(['status' => true, 'response' => $store->toArray()]);
    }
}
