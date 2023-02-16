<?php

namespace Src\Classes;

use Src\Events\Product\ProductChangedPrice;
use Ecotone\Modelling\Attribute\CommandHandler;
use Ecotone\Modelling\Attribute\EventSourcingHandler;
use Ecotone\Modelling\Attribute\EventSourcingAggregate;

class Product
{
	private $id, $price;

	public function __construct(float $price)
	{
		$this->id = uniqid();
		$this->price = $price;
	}

	public function setPrice(float $price): array
	{
		return [new ProductChangedPrice($this, $price)];
	}

	public function onProductChangedPrice(ProductChangedPrice $event)
	{
		$this->price = $event->getPrice();
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
