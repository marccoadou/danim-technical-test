<?php

namespace App\Coupon;

use App\Coupon\Coupon;

interface CouponUsageRepositoryInterface
{
    public function save(Coupon $coupon);
    public function find(string $id): ?Coupon;
}
