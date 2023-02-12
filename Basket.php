<?php

class Basket
{
	private $id, $total_amount, $products;

	public function __construct(Product $product)
	{
		$this->id = uniqid();
		$this->products = array();
		$this->addProduct($product);
		$this->total_amount = 0;
	}

	public function addProduct(Product $product): void
	{
		array_push($this->products, $product);
		$this->total_amount = self::calculateTotalAmount();
	}

	public function removeProduct(Product $product): void
	{
		$index = array_search($product, $this->products, true);
		if ($index !== false) {
			unset($this->products[$index]);
			$this->total_amount = self::calculateTotalAmount();
		} else {
			throw new Exception("Can not remove an item that's not in the basket");
		}
	}

	public function getId()
	{
		return $this->id;
	}

	public function getProducts(): array
	{
		return $this->products;
	}

	public function getTotalAmount(): float
	{
		return $this->total_amount;
	}

	public function setTotalAmount(float $total_amount): void
	{
		$this->total_amount = $total_amount;
	}

	private function calculateTotalAmount(): float
	{
		$total_amount = 0;
		foreach ($this->products as $product) {
			$total_amount += $product->getPrice();
		}
		return $total_amount;
	}

	public function getTotalAmountWithCouponReduction(Coupon $coupon): float
	{
		if ($coupon->isValid($this)) {
			return $coupon->calculateDiscount($this);
		} else {
			throw new Exception("Invalid coupon for this basket");
		}
	}
}
