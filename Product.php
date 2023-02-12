<?php

class Product
{
	private $id, $price, $type;

	public function __construct(int $price, $type)
	{
		$this->id = uniqid();
		$this->type = $type;
		$this->price = $price;
	}

	public function setPrice(float $price): void
	{
		$this->price = $price;
	}

	public function getPrice(): float
	{
		return $this->price;
	}

	public function setType(float $type): void
	{
		$this->type = $type;
	}

	public function getType(): int
	{
		return $this->type;
	}
}
