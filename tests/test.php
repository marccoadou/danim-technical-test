<?php

require('./App/Command/SynchronousCommandBus.php');
require('./App/Basket/BasketRepository.php');
require('./App/Basket/CreateBasketHandler.php');
require_once('./App/Basket/AddProductToBasketCommand.php');
require_once('./App/Basket/AddProductToBasketHandler.php');
require('./App/Basket/CreateBasketCommand.php');
require('./App/Product/Product.php');
require('./App/Basket/Basket.php');

use App\Product\Product;
use App\Basket\BasketRepository;
use App\Product\ProductRepository;
use App\Command\SynchronousCommandBus;
use App\Basket\Command\AddProductToBasket;
use App\Basket\Command\CreateBasketCommand;
use App\Basket\Handler\CreateBasketHandler;
use App\Basket\Command\AddProductToBasketCommand;
use App\Basket\Handler\AddProductToBasketHandler;

$commandBus = new SynchronousCommandBus();

$basketRepository = new BasketRepository;
$productRepository = new ProductRepository;

$commandBus->register(CreateBasketCommand::class, new CreateBasketHandler($basketRepository));
$basket = $commandBus->execute(new CreateBasketCommand(new Product(204.3)));

$commandBus->register(AddProductToBasketCommand::class, new AddProductToBasketHandler($basket->getProductRepository()));
$commandBus->execute(new AddProductToBasketCommand(new Product(2233.2)));
$commandBus->execute(new AddProductToBasketCommand(new Product(123.2)));

print_r($basket);
// $commandBus->execute(new CreateBasketCommand(new Product(24324.3)));
// $commandBus->execute(new CreateBasketCommand(new Product(203322.3)));


// The idea here would be to get the ID from the command that creates the basket
// use the ID in the different commands to modify this particular basket