<?php

declare(strict_types=1);


use App\Basket\Basket;
use App\Product\Product;
use PHPUnit\Framework\TestCase;
use App\Basket\BasketRepository;
use App\Basket\Command\AddCouponToBasketCommand;
use App\Command\SynchronousCommandBus;
use App\Basket\Command\CreateBasketCommand;
use App\Basket\Handler\CreateBasketHandler;
use App\Basket\Command\AddProductToBasketCommand;
use App\Basket\Command\RemoveProductFromBasketCommand;
use App\Basket\Handler\AddCouponToBasketHandler;
use App\Basket\Handler\AddProductToBasketHandler;
use App\Basket\Handler\RemoveProductFromBasketHandler;
use App\Coupon\Coupon;

final class BasketTest extends TestCase
{

    public function testCanCreateABasket(): void
    {

        $commandBus = new SynchronousCommandBus();
        $basketRepository = new BasketRepository;
        $commandBus->register(CreateBasketCommand::class, new CreateBasketHandler($basketRepository));
        $basket = $commandBus->execute(new CreateBasketCommand(new Product(20)));

        $this->assertInstanceOf(Basket::class, $basket);
    }

    public function testCanAddProductsToABasket(): void
    {
        $commandBus = new SynchronousCommandBus();
        $basketRepository = new BasketRepository;
        $commandBus->register(CreateBasketCommand::class, new CreateBasketHandler($basketRepository));
        $basket = $commandBus->execute(new CreateBasketCommand(new Product(20)));
        $commandBus->register(AddProductToBasketCommand::class, new AddProductToBasketHandler($basket->getProductRepository()));
        $commandBus->execute(new AddProductToBasketCommand(new Product(25)));
        $commandBus->execute(new AddProductToBasketCommand(new Product(4.99)));

        $this->assertEquals(3, count($basket->getProducts()));
    }

    public function testCanRemoveProductsFromABasket(): void
    {
        $commandBus = new SynchronousCommandBus();
        $basketRepository = new BasketRepository;
        $commandBus->register(CreateBasketCommand::class, new CreateBasketHandler($basketRepository));
        $basket = $commandBus->execute(new CreateBasketCommand(new Product(20)));
        $commandBus->register(AddProductToBasketCommand::class, new AddProductToBasketHandler($basket->getProductRepository()));
        $commandBus->register(RemoveProductFromBasketCommand::class, new RemoveProductFromBasketHandler($basket->getProductRepository()));

        $product1 = new Product(25);
        $product2 = new Product(4.99);
        $commandBus->execute($basket->addProduct($product1));
        $commandBus->execute($basket->addProduct($product2));
        $commandBus->execute($basket->removeProduct($product1));
        $commandBus->execute($basket->removeProduct($product2));

        $this->assertEquals(1, count($basket->getProducts()));
    }

    public function testBasketTotalAmountIsRight(): void
    {
        $commandBus = new SynchronousCommandBus();
        $basketRepository = new BasketRepository;
        $commandBus->register(CreateBasketCommand::class, new CreateBasketHandler($basketRepository));
        $basket = $commandBus->execute(new CreateBasketCommand(new Product(20)));
        $commandBus->register(AddProductToBasketCommand::class, new AddProductToBasketHandler($basket->getProductRepository()));
        $commandBus->execute($basket->addProduct(new Product(25)));
        $commandBus->execute($basket->addProduct(new Product(4.99)));

        $this->assertEquals(49.99, $basket->getFinalAmount());
    }

    public function testBasketTotalAmountWithValidCoupon()
    {
        $commandBus = new SynchronousCommandBus();
        $basketRepository = new BasketRepository;
        $commandBus->register(CreateBasketCommand::class, new CreateBasketHandler($basketRepository));
        $basket = $commandBus->execute(new CreateBasketCommand(new Product(20)));
        $commandBus->register(AddCouponToBasketCommand::class, new AddCouponToBasketHandler($basket));
        $commandBus->register(AddProductToBasketCommand::class, new AddProductToBasketHandler($basket->getProductRepository()));
        $commandBus->execute($basket->addProduct(new Product(25)));
        $commandBus->execute($basket->addProduct(new Product(50)));


        $coupon = new Coupon(20, 0, "COUPON_20_FIX");
        $commandBus->execute($basket->addCouponToBasket($coupon));
        $this->assertEquals(76, $basket->getFinalAmount());
    }
}
