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

    public function testCanNotCreateACouponWithTooHighPercentage(): void
    {
        $this->expectExceptionMessage("Discount in PERCENTAGES should not be more than 75%");
        new Coupon(85, 0, 'COUPON123');
    }

    public function testCanNotCreateCouponWithNullPercentage(): void
    {
        $this->expectExceptionMessage("Discount can not be negative or null");
        new Coupon(0, 0, 'COUPON123');
    }

    public function testCanNotCreateCouponWithWrongDiscountType(): void
    {
        $this->expectExceptionMessage("Discount should be either PERCENTAGE or FIXED");
        new Coupon(23, 3, 'COUPON123');
    }
}
