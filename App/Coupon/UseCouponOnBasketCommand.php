<?php

namespace App\Coupon\Command;

require_once('./App/Command/CommandInterface.php');


use App\Coupon\Coupon;
use App\Command\CommandInterface;

class UseCouponOnBasketCommand implements CommandInterface
{
    public $coupon;

    public function __construct(Coupon $coupon)
    {
        $this->coupon = $coupon;
    }

    public function getCoupon()
    {
        return $this->coupon;
    }
}
