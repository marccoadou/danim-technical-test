<?php

namespace App\Coupon;

require_once('./App/Coupon/CouponUsageRepositoryInterface.php');


use App\Coupon\Coupon;
use App\Coupon\CouponUsageRepositoryInterface;

class CouponUsageRepository implements CouponUsageRepositoryInterface
{
    public $usages = [];

    public function save(Coupon $coupon)
    {
        $this->usages[$coupon->id] = $coupon;
    }

    public function find(string $id): ?Coupon
    {
        return $this->usages[$id] ?? null;
    }
}
