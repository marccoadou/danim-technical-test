<?php

class Product
{
	private $id, $price, $type, $is_discountable;

	public function __construct(int $price, ProductTypeEnum $type, bool $is_discountable = false)
	{
		$this->id = uniqid();
		$this->type = $type;
		$this->price = $price;
		$this->is_discountable = $is_discountable;
	}

	public function setPrice(float $price): void
	{
		$this->price = $price;
	}

	public function getPrice(): float
	{
		return $this->price;
	}
}
