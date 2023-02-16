<?php

use UseCouponOnBasketCommand;
use Ecotone\Modelling\EventBus;
use Src\Events\Coupon\CouponWasUsedOnBasket;
use Ecotone\Modelling\Attribute\CommandHandler;

class useCouponOnBasketCommandHanlder
{

    #[CommandHandler]
    public function useCouponOnBasket(CouponWasUsedOnBasket $command, EventBus $eventBus): void
    {
        $eventBus->publish(new CouponWasUsedOnBasket($command->getCoupon(), $command->getBasket()));
    }
}
