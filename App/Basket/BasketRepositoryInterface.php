<?php

namespace App\Basket;

use App\Basket\Basket;

interface BasketRepositoryInterface
{
    public function save(Basket $basket);
    public function find(string $id): ?Basket;
}
