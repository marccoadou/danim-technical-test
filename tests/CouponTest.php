<?php


declare(strict_types=1);

use Src\Classes\Basket;
use Src\Classes\Coupon;
use Src\Classes\Product;
use PHPUnit\Framework\TestCase;
use Src\Enum\CouponDiscountTypeEnum;
use Src\Events\Coupon\CouponDiscountAmountChanged;

final class CouponTest extends TestCase
{
    public function testCanCreateANewCoupon(): void
    {
        $coupon = new Coupon(10, CouponDiscountTypeEnum::PERCENTAGE, 'DISCOUNTCODE');

        $this->assertSame(10, $coupon->getDiscount());
        $this->assertSame(0, $coupon->getDiscountType());
        $this->assertSame('DISCOUNTCODE', $coupon->getUniqueCode());
    }

    public function testUseCouponOnBasket(): void
    {
        $product = new Product(320.0);
        $basket = new Basket($product);

        $coupon = new Coupon(10, CouponDiscountTypeEnum::PERCENTAGE, 'DISCOUNTCODE');
        $this->assertSame(320 - ((10 / 100) * 320), $basket->getTotalAmountWithCouponReduction($coupon));
    }
}
