<?php

namespace App\Product\Handler;

use Exception;
use App\Product\Product;
use App\Command\CommandInterface;
use App\Command\CommandHandlerInterface;
use App\Product\ProductRepositoryInterface;
use App\Product\Command\CreateProductCommand;


class CreateProductHandler implements CommandHandlerInterface
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(CommandInterface $command)
    {
        if (!$command instanceof CreateProductCommand) {
            throw new Exception("CreateProductHandler can only handle CreateProductCommand");
        }

        $product = new Product($command->getPrice());
        $this->productRepository->save($product);
        return $product;
    }
}
