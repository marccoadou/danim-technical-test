<?php

class Coupon
{
	const MINIMUM_AMOUNT = 50;
	const DISCOUNT_TYPE_PERCENTAGE = 0;
	const DISCOUNT_TYPE_FIXED = 1;

	public $id, $unique_code, $discount, $discount_type, $creation_date, $usages, $is_revoked;

	public function __construct($discount, $discount_type)
	{
		$this->id = uniqid();
		$this->creation_date = new DateTime('now');
		$this->usages = 0;
		$this->discount = $discount;
		$this->discount_type = $discount_type;
		$this->is_revoked = false;
	}

	public function use(Basket $basket)
	{
		if ($this->isValid($basket)) {
			$this->usages += 1;
		} else {
			// this should have more depth to it, as in different errors for each problem: total amount, time limit, usages
			throw new Exception("Coupon is invalid");
		}
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
		$creation = $this->creation_date;
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

	public function revoke(): void
	{
		$this->is_revoked = true;
	}
}
