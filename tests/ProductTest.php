<?php

declare(strict_types=1);


use App\Product\Product;
use PHPUnit\Framework\TestCase;
use App\Command\SynchronousCommandBus;
use App\Product\Command\CreateProductCommand;
use App\Product\Handler\CreateProductHandler;
use App\Product\ProductRepository;

final class ProductTest extends TestCase
{

    public function testCanCreateAProduct(): void
    {
        $product = new Product(20);

        $this->assertInstanceOf(Product::class, $product);
    }
}
