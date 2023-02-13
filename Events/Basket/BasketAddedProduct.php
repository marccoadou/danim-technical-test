<?php

namespace Events\Basket;

use Classes\Basket;
use Classes\Product;


class BasketAddedProduct
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
