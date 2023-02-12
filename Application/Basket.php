<?php

class Basket
{
	private $id, $total_amount, $products;

	public function __construct()
	{
		$this->id = uniqid();
	}

	public function addProduct(): void
	{
	}

	public function removeProduct(): void
	{
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
}
