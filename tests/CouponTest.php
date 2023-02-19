<?php

declare(strict_types=1);


use PHPUnit\Framework\TestCase;
use App\Coupon\CouponRepository;
use App\Command\SynchronousCommandBus;
use App\Coupon\Command\CreateCouponCommand;
use App\Coupon\Coupon;
use App\Coupon\Handler\CreateCouponHandler;

final class CouponTest extends TestCase
{

    public function testCanCreateACoupon(): void
    {
        $coupon = new Coupon(20, 0, 'COUPON123');
        $this->assertInstanceOf(Coupon::class, $coupon);
    }
}
