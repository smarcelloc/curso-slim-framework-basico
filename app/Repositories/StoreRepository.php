<?php

namespace App\Repositories;

use App\Entities\Store;
use App\Supports\EntityManagerFactory;

class StoreRepository
{
    /**
     * Gerenciamento da Entidade do ORM
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $manager;

    public function __construct()
    {
        $this->manager = (new EntityManagerFactory())->getEntityManager();
    }

    /**
     * Inserir uma loja
     *
     * @param array $properties
     * @return integer Retorna o ID cadastrado.
     */
    public function insert(array $properties)
    {
        $store = new Store($properties);
        $store->validate();
        $this->manager->persist($store);
        $this->manager->flush();
        return $store->getId();
    }

    /**
     * Atualização de uma loja
     *
     * @param int $id
     * @param array $properties
     * @return integer Retorna o ID cadastrado.
     */
    public function update(int $id, array $properties)
    {
        $store = $this->manager->find(Store::class, $id);
        if (!$store) {
            throw new \InvalidArgumentException('Registro não encontrado !!!');
        }

        $store->set($properties);
        $store->validate();
        $this->manager->persist($store);
        $this->manager->flush();
    }

    /**
     * Consultar loja por ID
     *
     * @param integer $id
     * @return \App\Entities\Store|null
     */
    public function findById(int $id)
    {
        if ($id > 0) {
            return $this->manager->getRepository(Store::class)->find($id);
        }
    }

    /**
     * Deleta uma loja
     *
     * @param Store $store
     * @return void
     */
    public function delete(Store $store)
    {
        $this->manager->remove($store);
        $this->manager->flush();
    }

    /**
     * Trazer todos os dados
     *
     * @return \App\Entities\Store[]
     */
    public function getAll()
    {
        $stores = $this->manager->getRepository(Store::class)->findAll();

        $arrayStores = [];
        foreach ($stores as $store) {
            array_push($arrayStores, $store->toArray());
        }

        return $arrayStores;
    }
}
