<?php

namespace App\Basket;

require('./App/Basket/BasketRepositoryInterface.php');

use App\Basket\Basket;

class BasketRepository implements BasketRepositoryInterface
{
    public $baskets = [];

    public function create(Basket $basket)
    {
        array_push($this->baskets, $basket);
        echo "Basket with id {$basket->id} was created." . PHP_EOL;
    }
}
