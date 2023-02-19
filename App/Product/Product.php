<?php

namespace App\Product;

class Product
{
    public $id, $price;

    public function __construct(float|int $price)
    {
        $this->id = uniqid();
        $this->price = floatval($price);
    }

    // public function setPrice(float $price): array
    // {
    //     // return [new ProductChangedPrice($this, $price)];
    // }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getId()
    {
        return $this->id;
    }
}
