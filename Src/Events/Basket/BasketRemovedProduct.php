<?php

namespace Src\Events\Basket;

use Src\Classes\Basket;
use Src\Classes\Product;


class BasketRemovedProduct
{
    private $basket, $product;

    public function __construct(Basket $basket, Product $product)
    {
        $this->basket = $basket;
        $this->product = $product;
    }

    public function getBasket()
    {
        return $this->basket;
    }

    public function getProduct()
    {
        return $this->product;
    }
}
