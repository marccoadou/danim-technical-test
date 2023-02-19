<?php

namespace App\Product;

require_once('./App/Product/ProductRepositoryInterface.php');


use App\Product\Product;
use App\Product\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public $products = [];

    public function save(Product $product)
    {
        $this->products[$product->id] = $product;
    }

    public function find(string $id): ?Product
    {
        return $this->products[$id] ?? null;
    }

    public function remove(string $id): bool
    {
        if (isset($this->products[$id])) {
            unset($this->products[$id]);
            return true;
        }
        return false;
    }
}
