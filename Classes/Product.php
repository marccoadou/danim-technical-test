<?php

namespace Classes;

use Events\Product\ProductChangedPrice;


class Product
{
	private $id, $price;

	public function __construct(int $price)
	{
		$this->id = uniqid();
		$this->price = $price;
	}

	public function setPrice(float $price): array
	{
		return [new ProductChangedPrice($this, $price)];
	}

	public function getPrice(): float
	{
		return $this->price;
	}

	public function getId()
	{
		return $this->id;
	}
}
