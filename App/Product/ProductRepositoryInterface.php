<?php

namespace App\Product;

use App\Product\Product;

interface ProductRepositoryInterface
{
    public function save(Product $product);
    public function find(string $id): ?Product;
    public function remove(string $id): bool;
}
