<?php

namespace Src\Services;

use Src\Classes\Basket;
use Src\Classes\Coupon;
use Ecotone\Modelling\EventBus;
use Src\Events\Coupon\CouponWasUsedOnBasket;

class CouponUsageService
{
    public function __construct(private EventBus $event)
    {
    }

    public function useCouponOnBasket(Coupon $coupon, Basket $basket)
    {
        $this->event->publish(new CouponWasUsedOnBasket($coupon, $basket));
    }
}
