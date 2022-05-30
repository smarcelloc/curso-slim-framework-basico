<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Index;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;

/**
 * @Entity
 * @Table(name="store", indexes={@Index(columns={"name"})})
 */
class Store
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
     * @ORM\Column(type="string", length=20)
     * @var string
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $address;

    /**
     * Transforma array em propriedade
     *
     * @param array $properties
     * @return void
     */
    public function set(array $properties)
    {
        foreach ($properties as $key => $value) {
            $this->{$key} = $value;
        }
    }

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
     * Get the value of phone
     *
     * @return  string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @param  string  $phone
     *
     * @return  self
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of address
     *
     * @return  string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @param  string  $address
     *
     * @return  self
     */
    public function setAddress(string $address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Regra de validação.
     *
     * @throws \Respect\Validation\Exceptions\NestedValidationException
     * @return void
     */
    public function validate()
    {
        $validator = new Validator();
        $validator->attribute('name', Validator::stringType()->length(null, 254)->notBlank());
        $validator->attribute('phone', Validator::stringType()->length(null, 20)->notBlank());
        $validator->attribute('address', Validator::stringType()->length(null, 254)->notBlank());
        $validator->assert($this);
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
}
