<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\Index;
use Respect\Validation\Validator;

/**
 * @Entity
 * @Table(name="product", indexes={@Index(columns={"name"})})
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="decimal")
     *
     * @var float
     */
    private $price;

    /**
     * @ORM\Column(type="integer", options={"unsigned":true, "default":0})
     *
     * @var integer
     */
    private $amount;

    /**
     * @ManyToOne(targetEntity="App\Entities\Store", cascade={"persist"})
     * @JoinColumn(onDelete="CASCADE", nullable=false, unique=false)
     * @var \App\Entities\Store
     */
    private $store;

    /**
     * Construtor da classe
     *
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        $this->set($properties);
    }

    /**
     * Transforma array em propriedade
     *
     * @param array $properties
     * @return void
     */
    public function set(array $properties)
    {
        foreach ($properties as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * Get the value of id
     *
     * @return  integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of price
     *
     * @return  float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param  float  $price
     *
     * @return  self
     */
    public function setPrice(float $price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of amount
     *
     * @return  integer
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @param  integer  $amount
     *
     * @return  self
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get the value of store
     *
     * @return  \App\Entities\Store
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * Set the value of store
     *
     * @param  \App\Entities\Store  $store
     *
     * @return  self
     */
    public function setStore(Store $store)
    {
        $this->store = $store;
        return $this;
    }

    /**
     * Transformar propriedade para Array
     *
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }

    // /**
    //  * Regra de validação.
    //  *
    //  * @throws \Respect\Validation\Exceptions\NestedValidationException
    //  * @return void
    //  */
    // public function validate()
    // {
    //     $validator = new Validator();
    //     $validator->attribute('name', Validator::stringType()->length(null, 254)->notBlank());
    //     $validator->attribute('decimal', Validator::->notBlank());
    //     $validator->attribute('address', Validator::stringType()->length(null, 254)->notBlank());
    //     $validator->assert($this);
    // }
}
