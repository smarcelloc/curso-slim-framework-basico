<?php

namespace App\Controllers;

use App\Repositories\StoreRepository;
use Respect\Validation\Exceptions\NestedValidationException;
use Slim\Http\Request;
use Slim\Http\Response;

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
        try {
            $body = $req->getParsedBody();
            $storeRepository = new StoreRepository();
            $id = $storeRepository->insert($body ?? []);
            return $res->withJson(['status' => true, 'message' => 'Loja cadastrada com sucesso !!!', 'id' =>  $id]);
        } catch (NestedValidationException $ex) {
            return $res->withJson(['status' => false, 'message' => 'Validação inválida', 'errors' => $ex->getMessages()], 422);
        } catch (\Exception $ex) {
            return $res->withJson(['status' => false, 'message' => 'Erro ao cadastrar uma loja'], 400);
        }
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
        try {
            $body = $req->getParsedBody();
            $storeRepository = new StoreRepository();
            $storeRepository->update($args['id'] ?? 0, $body);
            return $res->withJson(['status' => true, 'message' => 'Loja atualizado com sucesso !!!']);
        } catch (NestedValidationException $ex) {
            return $res->withJson(['status' => false, 'message' => 'Validação inválida', 'errors' => $ex->getMessages()], 422);
        } catch (\InvalidArgumentException $ex) {
            return $res->withJson(['status' => false, 'message' => $ex->getMessage()], 400);
        } catch (\Exception $ex) {
            return $res->withJson(['status' => false, 'message' => 'Erro ao cadastrar uma loja'], 400);
        }
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
        try {
            $storeRepository = new StoreRepository();
            $store = $storeRepository->findById($args['id'] ?? 0);
            if (!$store) {
                return $res->withJson(['status' => false, 'message' => 'Registro não encontrado !!!'], 400);
            }

            $storeRepository->delete($store);
            return $res->withJson(['status' => true, 'message' => 'Loja deletado com sucesso !!!']);
        } catch (\Exception $ex) {
            return $res->withJson(['status' => false, 'message' => 'Erro ao deletar a loja'], 400);
        }
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
        try {
            $storeRepository = new StoreRepository();
            $store = $storeRepository->findById($args['id'] ?? 0);
            if (!$store) {
                return $res->withJson(['status' => false, 'message' => 'Registro não encontrado !!!'], 400);
            }

            return $res->withJson(['status' => true, 'response' => $store->toArray()]);
        } catch (\Exception $ex) {
            return $res->withJson(['status' => false, 'message' => 'Erro ao buscar uma loja'], 400);
        }
    }
}
