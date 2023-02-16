<?php

namespace Src\Events\Coupon;

use Src\Classes\Coupon;

class CouponDiscountAmountChanged
{
    private $coupon, $discount;

    public function __construct(Coupon $coupon, float $discount)
    {
        $this->coupon = $coupon;
        $this->discount = $discount;
    }

    public function getCoupon()
    {
        return $this->coupon;
    }

    public function getDiscount()
    {
        return $this->discount;
    }
}
