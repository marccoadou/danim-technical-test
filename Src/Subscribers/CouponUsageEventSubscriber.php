<?php

use Ecotone\Modelling\Attribute\EventHandler;
use Src\Events\Coupon\CouponWasUsedOnBasket;

class CouponUsageEventSubscriber
{
    #[EventHandler]
    public function applyCouponReductionToBasket(CouponWasUsedOnBasket $event)
    {
        return $event->getCoupon()->calculateDiscountForBasket($event->getBasket());
    }
}
