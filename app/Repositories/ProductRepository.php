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
        $store = (new StoreRepository($this->manager))->getId($data['store_id'] ?? 0);

        $product = new Product($data);
        $product->setStore($store);
        $product->validate();

        $this->manager->persist($product);
        $this->manager->flush();
        return $product->getId();
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
        $product = $this->getId($id);
        $product->set($data);

        if (isset($data['store_id']) && $product->getStore()->getId() != $data['store_id']) {
            $store = (new StoreRepository($this->manager))->getId($data['store_id']);
            $product->setStore($store);
        }

        $product->validate();
        $this->manager->persist($product);
        $this->manager->flush();
    }

    /**
     * Consultar produto por ID
     *
     * @param integer $id
     * @throws \InvalidArgumentException
     * @return \App\Entities\Product
     */
    public function getId(int $id)
    {
        if ($id > 0) {
            if ($product = $this->manager->getRepository(Product::class)->find($id)) {
                return $product;
            }
        }

        throw new \InvalidArgumentException('Produto não encontrado !!!');
    }

    /**
     * Deleta um produto
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id)
    {
        $product = $this->getId($id);
        $this->manager->remove($product);
        $this->manager->flush();
    }

    /**
     * Trazer todos os dados
     *
     * @return \App\Entities\Product[]
     */
    public function getAll()
    {
        $products = $this->manager->getRepository(Product::class)->findAll();
        return array_map(function ($product) {
            return $product->toArray();
        }, $products);
    }

    /**
     *  Filtrar os produtos que pertencem a sua loja.
     *
     * @param integer $store_id
     * @return void
     */
    public function storeBy(int $store_id)
    {
        $store = (new StoreRepository($this->manager))->getId($store_id);
        $products = $this->manager->getRepository(Product::class)->findBy(['store' => $store]);

        return array_map(function ($product) {
            return $product->toArray();
        }, $products);
    }
}
