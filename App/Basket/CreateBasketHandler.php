<?php

namespace App\Basket\Handler;

require('./App/Command/CommandHandlerInterface.php');


use Exception;
use App\Basket\Basket;
use App\Command\CommandInterface;
use App\Command\CommandHandlerInterface;
use App\Basket\BasketRepositoryInterface;
use App\Basket\Command\CreateBasketCommand;


class CreateBasketHandler implements CommandHandlerInterface
{
    private $basketRepository;

    public function __construct(BasketRepositoryInterface $basketRepository)
    {
        $this->basketRepository = $basketRepository;
    }

    public function handle(CommandInterface $command)
    {
        if (!$command instanceof CreateBasketCommand) {
            throw new Exception("CreateBasketHandler can only handle CreateBasketCommand");
        }

        $basket = new Basket($command->getProduct());
        $this->basketRepository->create($basket);
    }
}
