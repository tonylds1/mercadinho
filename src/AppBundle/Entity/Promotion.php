<?php
namespace AppBundle\Entity;

class Promotion
{
    private $product;
    private $desconto;

    public function __construct(Product $product, $desconto)
    {
        $this->product = $product;
        $this->desconto = $desconto;
    }

    public function getPromotionalPrice()
    {
        return $this->product->getPreco() - ($this->product->getPreco() * $this->desconto);
    }
}
