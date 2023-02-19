<?php

namespace App\Coupon\Handler;

use Exception;
use App\Coupon\Coupon;
use App\Command\CommandInterface;
use App\Command\CommandHandlerInterface;
use App\Coupon\Command\CreateCouponCommand;
use App\Coupon\CouponUsageRepositoryInterface;


class CreateCouponHandler implements CommandHandlerInterface
{
    private $couponUsageRepository;

    public function __construct(CouponUsageRepositoryInterface $couponUsageRepository)
    {
        $this->couponUsageRepository = $couponUsageRepository;
    }

    public function handle(CommandInterface $command)
    {
        if (!$command instanceof CreateCouponCommand) {
            throw new Exception("CreateCouponHandler can only handle CreateCouponCommand");
        }

        $coupon = new Coupon($command->getDiscount(), $command->getDiscountType(), $command->getUniqueCode());
        $this->couponUsageRepository->save($coupon);
        return $coupon;
    }
}
