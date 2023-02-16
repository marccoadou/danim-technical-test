<?php

namespace Src\Classes;

use Exception;
use Src\Classes\Coupon;
use Src\Classes\Product;
use Src\Events\Basket\BasketAddedProduct;
use Src\Events\Basket\BasketRemovedProduct;
use Ecotone\Modelling\WithAggregateVersioning;
use Ecotone\Modelling\Attribute\CommandHandler;
use Ecotone\Modelling\Attribute\AggregateIdentifier;
use Ecotone\Modelling\Attribute\EventSourcingHandler;
use Ecotone\Modelling\Attribute\EventSourcingAggregate;



class Basket
{
	private $id, $total_amount, $products;

	public function __construct(Product $product)
	{
		$this->id = uniqid();
		$this->products = array();
		// array_push($this->products, $product); 
		$this->addProduct($product);
		$this->total_amount = 0;
	}

	public function addProduct(Product $product): array
	{
		return [new BasketAddedProduct($this, $product)];
	}

	public function onBasketAddedProduct(BasketAddedProduct $event): void
	{
		array_push($this->products, $event->getProduct());
		$this->total_amount = self::calculateTotalAmount();
	}

	public function removeProduct(Product $product): array
	{
		return [new BasketRemovedProduct($this, $product)];
	}

	public function onBasketRemovedProduct(BasketRemovedProduct $event): void
	{
		$index = array_search($event->getProduct(), $this->products, true);
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
		return $this->calculateTotalAmount();
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
		// if ($coupon->isValid($this)) {
		return $coupon->calculateDiscountForBasket($this);
		// } else {
		// throw new Exception("Invalid coupon for this basket");
		// }
	}
}
