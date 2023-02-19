<?php

namespace App\Coupon\Handler;

require_once('./App/Command/CommandHandlerInterface.php');


use Exception;
use App\Basket\Basket;
use App\Command\CommandInterface;
use App\Coupon\CouponUsageRepository;
use App\Command\CommandHandlerInterface;
use App\Coupon\Command\UseCouponOnBasketCommand;

class UseCouponOnBasketHandler implements CommandHandlerInterface
{
    private $couponUsageRepository;

    public function __construct(CouponUsageRepository $couponUsageRepository)
    {
        $this->couponUsageRepository = $couponUsageRepository;
    }

    public function handle(CommandInterface $command)
    {
        if (!$command instanceof UseCouponOnBasketCommand) {
            throw new Exception("UseCouponOnBasketHandler can only handle UseCouponOnBasketCommand");
        }

        $this->couponUsageRepository->save($command->getCoupon());
    }
}
