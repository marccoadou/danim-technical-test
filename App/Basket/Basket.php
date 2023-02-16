<?php

namespace App\Basket;

use App\Product\Product;
use App\Product\ProductRepository;

require('./App/Product/ProductRepository.php');



class Basket
{
    public $id, $total_amount, $products;

    public function __construct(Product $product)
    {
        $this->id = uniqid();
        $this->products = new ProductRepository();
        $this->products->save($product);
        $this->total_amount = 0;
    }

    public function addProduct(Product $product): array
    {
        return [];
        // return [new AddProductToBasket($product)];
    }

    // public function onBasketAddedProduct(BasketAddedProduct $event): void
    // {
    //     array_push($this->products, $event->getProduct());
    //     $this->total_amount = self::calculateTotalAmount();
    // }

    // public function removeProduct(Product $product): array
    // {
    //     return [new BasketRemovedProduct($this, $product)];
    // }

    // public function onBasketRemovedProduct(BasketRemovedProduct $event): void
    // {
    //     $index = array_search($event->getProduct(), $this->products, true);
    //     if ($index !== false) {
    //         unset($this->products[$index]);
    //         $this->total_amount = self::calculateTotalAmount();
    //     } else {
    //         throw new Exception("Can not remove an item that's not in the basket");
    //     }
    // }

    public function getId()
    {
        return $this->id;
    }

    public function getProducts()
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

    // public function getTotalAmountWithCouponReduction(Coupon $coupon): float
    // {
    //     if ($coupon->isValid($this)) {
    //         return $coupon->calculateDiscountForBasket($this);
    //     } else {
    //         throw new Exception("Invalid coupon for this basket");
    //     }
    // }
}
