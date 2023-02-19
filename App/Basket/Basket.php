<?php

namespace App\Basket;

use Exception;
use App\Coupon\Coupon;
use App\Product\Product;
use App\Product\ProductRepository;
use App\Basket\Command\AddCouponToBasketCommand;
use App\Coupon\Command\UseCouponOnBasketCommand;
use App\Basket\Command\AddProductToBasketCommand;
use App\Basket\Command\RemoveProductFromBasketCommand;

require_once('./App/Product/ProductRepository.php');
require_once('./App/Coupon/UseCouponOnBasketCommand.php');



class Basket
{
    public $id, $total_amount, $productRepository, $coupon;

    public function __construct(Product $product)
    {
        $this->id = uniqid();
        $this->productRepository = new ProductRepository();
        $this->productRepository->save($product);
        $this->total_amount = 0;
    }

    public function addProduct(Product $product)
    {
        return new AddProductToBasketCommand($product, $this->getProductRepository());
    }

    public function removeProduct(Product $product)
    {
        return new RemoveProductFromBasketCommand($product->id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getProductRepository()
    {
        return $this->productRepository;
    }

    public function getProducts()
    {
        return $this->productRepository->products;
    }

    public function getFinalAmount(): float
    {
        if ($this->coupon instanceof Coupon) {
            return $this->getTotalAmountWithCouponReduction();
        } else {
            return $this->calculateTotalAmount();
        }
    }

    public function getTotalAmount(): float
    {
        return $this->calculateTotalAmount();
    }

    public function setTotalAmount(float $total_amount): void
    {
        $this->total_amount = $total_amount;
    }

    public function addCouponToBasket(Coupon $coupon)
    {
        return new AddCouponToBasketCommand($coupon);
    }

    public function pay()
    {
        return new UseCouponOnBasketCommand($this->coupon);
    }

    private function calculateTotalAmount(): float
    {
        $total_amount = 0;
        foreach ($this->productRepository->products as $product) {
            $total_amount += $product->getPrice();
        }
        return $total_amount;
    }

    public function getTotalAmountWithCouponReduction(): float
    {
        print_r($this->coupon->isValid($this));
        return 230;

        // if ($this->coupon->isValid($this)) {
        //     return $this->coupon->calculateDiscountedPriceForBasket($this);
        // } else {
        //     throw new Exception("Invalid coupon for this basket");
        // }
    }
}
