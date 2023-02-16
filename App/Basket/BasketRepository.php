<?php

namespace App\Basket;

require('./App/Basket/BasketRepositoryInterface.php');

use App\Basket\Basket;

class BasketRepository implements BasketRepositoryInterface
{
    public $baskets = [];

    public function save(Basket $basket)
    {
        $this->baskets[$basket->id] = $basket;
    }

    public function find(string $id): ?Basket
    {
        return $this->baskets[$id] ?? null;
    }
}
