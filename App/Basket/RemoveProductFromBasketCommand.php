<?php

namespace App\Basket\Command;

require_once('./App/Command/CommandInterface.php');


use App\Basket\Basket;
use App\Product\Product;
use App\Command\CommandInterface;

class RemoveProductFromBasketCommand implements CommandInterface
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}
