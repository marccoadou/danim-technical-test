<?php

namespace App\Basket\Handler;

require_once('./App/Command/CommandHandlerInterface.php');

use App\Basket\Command\RemoveProductFromBasketCommand;
use Exception;
use App\Command\CommandInterface;
use App\Product\ProductRepository;
use App\Command\CommandHandlerInterface;

class RemoveProductFromBasketHandler implements CommandHandlerInterface
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(CommandInterface $command)
    {
        if (!$command instanceof RemoveProductFromBasketCommand) {
            throw new Exception("CreateBasketHandler can only handle CreateBasketCommand");
        }

        $this->productRepository->remove($command->getId());
    }
}
