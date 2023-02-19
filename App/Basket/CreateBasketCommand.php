<?php

namespace App\Basket\Command;

// require_once('./App/Command/CommandInterface.php');


use App\Product\Product;
use App\Command\CommandInterface;

class CreateBasketCommand implements CommandInterface
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
