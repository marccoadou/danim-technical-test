<?php

namespace App\Basket\Handler;

require_once('./App/Command/CommandHandlerInterface.php');


use Exception;
use App\Basket\Basket;
use App\Command\CommandInterface;
use App\Product\ProductRepository;
use App\Command\CommandHandlerInterface;
use App\Basket\Command\AddProductToBasketCommand;

class AddProductToBasketHandler implements CommandHandlerInterface
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(CommandInterface $command)
    {
        if (!$command instanceof AddProductToBasketCommand) {
            throw new Exception("CreateBasketHandler can only handle CreateBasketCommand");
        }

        $this->productRepository->save($command->getProduct());
    }
}
