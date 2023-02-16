<?php

namespace App\Product;

require('./App/Product/ProductRepositoryInterface.php');


use App\Product\Product;
use App\Product\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public $products = [];

    public function save(Product $product)
    {
        $this->products[$product->id] = $product;
        print_r($this->products);
    }

    public function find(string $id): ?Product
    {
        return $this->products[$id] ?? null;
    }
}
