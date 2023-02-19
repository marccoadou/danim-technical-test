<?php

namespace App\Basket\Handler;

require_once('./App/Command/CommandHandlerInterface.php');


use Exception;
use App\Basket\Basket;
use App\Command\CommandInterface;
use App\Command\CommandHandlerInterface;
use App\Basket\BasketRepositoryInterface;
use App\Basket\Command\CreateBasketCommand;
use App\Basket\Command\AddCouponToBasketCommand;


class AddCouponToBasketHandler implements CommandHandlerInterface
{
    private $basket;

    public function __construct(Basket $basket)
    {
        $this->basket = $basket;
    }

    public function handle(CommandInterface $command)
    {
        if (!$command instanceof AddCouponToBasketCommand) {
            throw new Exception("AddCouponToBasketHandler can only handle AddCouponToBasketCommand");
        }

        $this->basket->coupon = $command->getCoupon();
    }
}
