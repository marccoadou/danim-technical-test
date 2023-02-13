<?php

namespace Events\Product;

use Classes\Product;


class ProductChangedPrice
{

    public function __construct(Product $product, float $price)
    {
    }
}
