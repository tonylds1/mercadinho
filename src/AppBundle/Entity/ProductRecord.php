<?php
namespace AppBundle\Entity;

class ProductRecord implements Persistable
{
    private $id;
    private $product;

    public function __construct(Product $product)
    {
        $this->product          = $product;
    }

    public function getDataToPersist()
    {
        return array(
            'id'            => $this->id,
            'productName'   => $this->product->getDescription(),
            'productPrice'  => $this->product->getPrice()
        );
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getProduct()
    {
        return $this->product;
    }
}
