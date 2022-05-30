<?php

namespace App\Repositories;

use App\Entities\Product;
use App\Entities\Store;
use App\Supports\EntityManagerFactory;

class ProductRepository
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

    public function insert(array $data)
    {
        $store = $this->manager->find(Store::class, $data['store_id'] ?? 0);
        if (!$store) {
            throw new \InvalidArgumentException('A loja não foi encontrada !!!');
        }

        $product = new Product($data);
        $product->setStore($store);
        $this->manager->persist($product);
        $this->manager->flush();
        return $product->getId();
    }

    public function update(int $id, array $data)
    {
    }

    public function delete(int $id)
    {
    }
}
