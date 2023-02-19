<?php

namespace App\Basket\Command;

require_once('./App/Command/CommandInterface.php');


use App\Basket\Basket;
use App\Product\Product;
use App\Command\CommandInterface;

class AddProductToBasketCommand implements CommandInterface
{
    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProduct()
    {
        return $this->product;
    }
}
