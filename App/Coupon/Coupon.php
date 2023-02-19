<?php

namespace App\Coupon;

use DateTime;
use Exception;
use DateInterval;
use App\Basket\Basket;
use App\Coupon\CouponUsageRepository;
use App\Coupon\Command\UseCouponOnBasketCommand;

require_once('./App/Coupon/CouponUsageRepository.php');

class Coupon
{
    const MINIMUM_AMOUNT = 50;
    const DISCOUNT_TYPE_PERCENTAGE = 0;
    const DISCOUNT_TYPE_FIXED = 1;

    public $id, $unique_code, $discount, $discount_type, $creation_date, $limit_date, $usageRepository, $is_revoked;

    public function __construct(int $discount, int $discount_type, $unique_code)
    {
        if ($discount < 0) {
            throw new \InvalidArgumentException("Discount can not be negative or null");
        }
        if (!in_array($discount_type, [self::DISCOUNT_TYPE_FIXED, self::DISCOUNT_TYPE_PERCENTAGE])) {
            throw new \InvalidArgumentException("Discount should be either PERCENTAGE or FIXED");
        }
        $this->id = uniqid();
        $this->creation_date = new DateTime('now');
        $this->limit_date = new DateTime('+2 months');

        $this->usageRepository = new CouponUsageRepository();
        $this->unique_code = $unique_code;
        $this->discount = $discount;
        $this->discount_type = $discount_type;
        $this->is_revoked = false;
    }

    public function use(Basket $basket)
    {
        echo $this->isValid($basket);
        // if ($this->isValid($basket)) {
        //     return new UseCouponOnBasketCommand($this);
        // } else {
        //     throw new Exception("Coupon is invalid");
        // }
    }

    public function getUsageRepository(): CouponUsageRepository
    {
        return $this->usageRepository;
    }

    public function getCreationDate(): DateTime
    {
        return $this->creation_date;
    }

    private function isTimeValid(): bool
    {

        if ($this->limit_date > new DateTime('now')) {
            return true;
        } else {
            return false;
        };
    }

    private function hasNotReachedUsagesLimit(): bool
    {
        if (count($this->usageRepository->usages) > 9) {
            return true;
        }
        return false;
    }

    public function calculateDiscountedPriceForBasket(Basket $basket): float
    {
        $discounted_price = $basket->getTotalAmount();

        if ($this->discount_type === self::DISCOUNT_TYPE_FIXED) {
            return $discounted_price - $this->discount;
        } else if ($this->discount_type === self::DISCOUNT_TYPE_PERCENTAGE) {
            return $discounted_price - (($this->discount / 100) * $discounted_price);
        }
    }

    public function isValid(Basket $basket)
    {
        if (
            self::isTimeValid() &&
            self::hasNotReachedUsagesLimit() &&
            ($basket->getTotalAmount() >= self::MINIMUM_AMOUNT) &&
            ($this->is_revoked === false)
        ) {
            return true;
        } else {
            return false;
        }
    }

    public function setUniqueCode(string $unique_code)
    {
        // return [new CouponUniqueCodeChanged($this, $unique_code)];
    }

    public function getUniqueCode()
    {
        return $this->unique_code;
    }

    public function revoke(): void
    {
        $this->is_revoked = true;
    }
}
