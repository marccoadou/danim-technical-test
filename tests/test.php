<?php

require('./App/Command/SynchronousCommandBus.php');
require('./App/Basket/BasketRepository.php');
require('./App/Basket/CreateBasketHandler.php');
require('./App/Basket/CreateBasketCommand.php');
require('./App/Product/Product.php');
require('./App/Basket/Basket.php');

use App\Product\Product;
use App\Basket\BasketRepository;
use App\Command\SynchronousCommandBus;
use App\Basket\Command\CreateBasketCommand;
use App\Basket\Handler\CreateBasketHandler;

$commandBus = new SynchronousCommandBus();


$basketRepository = new BasketRepository;
$commandHandler = new CreateBasketHandler($basketRepository);


$commandBus->register(CreateBasketCommand::class, $commandHandler);
$command = new CreateBasketCommand(new Product(204.3));
$commandBus->execute($command);
