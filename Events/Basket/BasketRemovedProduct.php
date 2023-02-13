<?php

namespace Events\Basket;

use Classes\Basket;
use Classes\Product;


class BasketRemovedProduct
{
    public function __construct(Basket $basket, Product $product)
    {
    }
}
