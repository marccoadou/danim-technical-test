<?php

use Src\Classes\Basket;
use Src\Classes\Coupon;

class UseCouponOnBasketCommand
{
    private $coupon, $basket;

    public function __construct(Coupon $coupon, Basket $basket)
    {
        $this->coupon = $coupon;
        $this->basket = $basket;
    }

    public function getCoupon()
    {
        return $this->coupon;
    }

    public function getBasket()
    {
        return $this->basket;
    }
}
