<?php


declare(strict_types=1);

use Src\Classes\Product;
use PHPUnit\Framework\TestCase;


final class ProductTest extends TestCase
{
    public function testCanCreateANewProduct(): void
    {
        $product = new Product(250);

        $this->assertSame(250.0, $product->getPrice());
    }
}
