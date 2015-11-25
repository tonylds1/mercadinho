<?php
namespace AppBundle\Entity;

class Product
{
    private $description;
    private $price;

    public function __construct($description, $price)
    {
        $this->description  = $description;
        $this->price        = $price;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }
}
