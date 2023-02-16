<?php

namespace App\Product\Command;

require('./App/Command/CommandInterface.php');


use App\Command\CommandInterface;

class CreateProductCommand implements CommandInterface
{
    public $price;

    public function __construct(float $price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }
}
