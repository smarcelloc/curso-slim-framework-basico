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

    /**
     * Construtor da classe.
     *
     * @param \Doctrine\ORM\EntityManager|null $manager
     */
    public function __construct($manager = null)
    {
        if (is_null($manager)) {
            $this->manager = (new EntityManagerFactory())->getEntityManager();
        } else {
            $this->manager = $manager;
        }
    }

    /**
     * Inserir uma loja
     *
     * @param array $data
     * @return integer Retorna o ID cadastrado.
     */
    public function insert(array $data)
    {
        $store = new Store($data);
        $store->validate();
        $this->manager->persist($store);
        $this->manager->flush();
        return $store->getId();
    }

    /**
     * Atualização de uma loja
     *
     * @param int $id
     * @param array $data
     * @return integer Retorna o ID cadastrado.
     */
    public function update(int $id, array $data)
    {
        $store = $this->getId($id);
        $store->set($data);
        $store->validate();
        $this->manager->persist($store);
        $this->manager->flush();
    }

    /**
     * Consultar loja por ID
     *
     * @param integer $id
     * @throws \InvalidArgumentException
     * @return \App\Entities\Store
     */
    public function getId(int $id)
    {
        if ($id > 0) {
            if ($store = $this->manager->getRepository(Store::class)->find($id)) {
                return $store;
            }
        }

        throw new \InvalidArgumentException('Loja não encontrado !!!');
    }

    /**
     * Deleta uma loja
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id)
    {
        $store = $this->getId($id);
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
        return array_map(function ($store) {
            return $store->toArray();
        }, $stores);
    }
}
