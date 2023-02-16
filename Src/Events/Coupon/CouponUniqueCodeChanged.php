<?php

namespace Src\Events\Coupon;

use Src\Classes\Coupon;

class CouponUniqueCodeChanged
{

    private $coupon, $unique_code;

    public function __construct(Coupon $coupon, string $unique_code)
    {
    }

    public function getCoupon()
    {
        return $this->coupon;
    }

    public function getUniqueCode()
    {
        return $this->unique_code;
    }
}
