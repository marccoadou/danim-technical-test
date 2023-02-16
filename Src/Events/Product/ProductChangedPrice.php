<?php

namespace Src\Events\Product;

use Src\Classes\Product;

class ProductChangedPrice
{

    private $product, $price;

    public function __construct(Product $product, float $price)
    {
        $this->product = $product;
        $this->price = $price;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getPrice()
    {
        return $this->price;
    }
}
