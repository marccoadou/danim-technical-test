<?php

namespace Events\Coupon;

use Classes\Coupon;

class CouponDiscountAmountChanged
{
    public function __construct(Coupon $coupon, $discount)
    {
    }
}
