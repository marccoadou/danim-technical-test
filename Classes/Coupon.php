<?php

namespace Classes;

use DateTime;
use Exception;
use DateInterval;
use Classes\Basket;
use CouponUniqueCodeChanged;
use Events\Coupon\CouponWasUsedOnBasket;


class Coupon
{
	const MINIMUM_AMOUNT = 50;
	const DISCOUNT_TYPE_PERCENTAGE = 0;
	const DISCOUNT_TYPE_FIXED = 1;

	private $id, $unique_code, $discount, $discount_type, $creation_date, $usages, $is_revoked;

	public function __construct(int $discount, int $discount_type, string $unique_code)
	{
		if ($discount < 0) {
			throw new \InvalidArgumentException("Discount can not be negative or null");
		}
		if (!in_array($discount_type, [self::DISCOUNT_TYPE_FIXED, self::DISCOUNT_TYPE_PERCENTAGE])) {
			throw new \InvalidArgumentException("Discount should be either PERCENTAGE or FIXED");
		}
		if (!($unique_code instanceof string)) {
			throw new \InvalidArgumentException("unique_code must be string");
		}

		$this->id = uniqid();
		$this->creation_date = new DateTime('now');
		$this->usages = 0;
		$this->unique_code = $unique_code;
		$this->discount = $discount;
		$this->discount_type = $discount_type;
		$this->is_revoked = false;
	}

	public function use(Basket $basket)
	{
		if ($this->isValid($basket)) {
			return new CouponWasUsedOnBasket($this->id, $basket->id);
		} 			// this should have more depth to it, as in different errors for each problem: total amount, time limit, usages
		throw new Exception("Coupon is invalid");
	}

	public function getCouponUsages(): int
	{
		return $this->usages;
	}

	public function getCreationDate(): DateTime
	{
		return $this->creation_date;
	}

	private function isTimeValid(): bool
	{
		$creation = $this->creation_date; // here I assume this is a deep copy, I'm not actually sure if php does it like this anymore or I should clone?
		$creation->add(new DateInterval('2M'));
		$now = new DateTime('now');
		if ($creation > $now) {
			return false;
		};
		return true;
	}

	private function hasReachedUsagesLimit(): bool
	{
		if ($this->usages > 9) {
			return true;
		}
		return false;
	}

	public function calculateDiscountForBasket(Basket $basket): float
	{
		$discounted_price = $basket->getTotalAmount();

		if ($this->discount_type === self::DISCOUNT_TYPE_FIXED) {
			return $discounted_price - $this->discount;
		} else if ($this->discount_type === self::DISCOUNT_TYPE_PERCENTAGE) {
			return ($this->discount / 100) * $discounted_price;
		}
	}

	public function isValid(Basket $basket)
	{
		if (
			self::isTimeValid()
			&& self::hasReachedUsagesLimit()
			&& ($basket->getTotalAmount() >= self::MINIMUM_AMOUNT)
			&& ($this->is_revoked != false)
		) {
			return true;
		} else {
			return false;
		}
	}

	public function setUniqueCode(string $unique_code)
	{
		return [new CouponUniqueCodeChanged($this, $unique_code)];
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
