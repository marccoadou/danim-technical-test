<?php

namespace App\Basket;

use App\Basket\Basket;



interface BasketRepositoryInterface
{
    public function create(Basket $basket);
}
