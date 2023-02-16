<?php

namespace App\Command;

require('./App/Command/CommandBusInterface.php');


use Exception;
use App\Command\CommandInterface;
use App\Command\CommandBusInterface;
use App\Command\CommandHandlerInterface;

class SynchronousCommandBus implements CommandBusInterface
{
    private $handlers = [];

    public function execute(CommandInterface $command)
    {
        $commandName = get_class($command);

        if (!array_key_exists($commandName, $this->handlers)) {
            throw new Exception("{$commandName} is not supported by the SynchronousCommandBus");
        }

        return $this->handlers[$commandName]->handle($command);
    }

    public function register($commandName, CommandHandlerInterface $command)
    {
        $this->handlers[$commandName] = $command;
        return $this;
    }
}
