<?php

class Coupon
{
	public $id, $unique_code, $discount, $discount_type;

	public function __construct($discount, $discount_type)
	{
		$this->id = uniqid();
		$this->discount = $discount;
		$this->discount_type = $discount_type;
	}
}
