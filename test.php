<?php

use App\Coupon\Coupon;
use App\Product\Product;
use App\Basket\BasketRepository;
use App\Command\SynchronousCommandBus;
use App\Basket\Command\CreateBasketCommand;
use App\Basket\Handler\CreateBasketHandler;
use App\Basket\Command\AddCouponToBasketCommand;
use App\Basket\Handler\AddCouponToBasketHandler;
use App\Coupon\Command\UseCouponOnBasketCommand;
use App\Coupon\Handler\UseCouponOnBasketHandler;
use App\Basket\Command\AddProductToBasketCommand;
use App\Basket\Handler\AddProductToBasketHandler;

require_once('./App/Command/SynchronousCommandBus.php');
require_once('./App/Basket/BasketRepository.php');
require_once('./App/Basket/CreateBasketHandler.php');
require_once('./App/Basket/AddProductToBasketCommand.php');
require_once('./App/Basket/AddProductToBasketHandler.php');
require_once('./App/Basket/AddCouponToBasketCommand.php');
require_once('./App/Basket/AddCouponToBasketHandler.php');

require_once('./App/Coupon/UseCouponOnBasketCommand.php');
require_once('./App/Coupon/UseCouponOnBasketHandler.php');

require_once('./App/Basket/CreateBasketCommand.php');
require_once('./App/Product/Product.php');
require_once('./App/Basket/Basket.php');
require_once('./App/Coupon/Coupon.php');



$commandBus = new SynchronousCommandBus();
$basketRepository = new BasketRepository;
$commandBus->register(CreateBasketCommand::class, new CreateBasketHandler($basketRepository));
$basket = $commandBus->execute(new CreateBasketCommand(new Product(20)));
$commandBus->register(AddCouponToBasketCommand::class, new AddCouponToBasketHandler($basket));
$commandBus->register(AddProductToBasketCommand::class, new AddProductToBasketHandler($basket->getProductRepository()));
$commandBus->execute($basket->addProduct(new Product(25)));
$commandBus->execute($basket->addProduct(new Product(50)));

$coupon = new Coupon(20, 0, "COUPON_20_FIX");
$commandBus->register(UseCouponOnBasketCommand::class, new UseCouponOnBasketHandler($coupon->getUsageRepository()));
$commandBus->execute($basket->addCouponToBasket($coupon));
echo "Total amount before discount : " .  $basket->getTotalAmount() . PHP_EOL;
echo "Final amount after discount : " . $basket->getFinalAmount() . PHP_EOL;
$commandBus->execute($basket->pay());

print_r($coupon->getUsageRepository());


// The idea here would be to get the ID from the command that creates the basket
// use the ID in the different commands to modify this particular basket