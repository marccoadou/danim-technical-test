<?php

namespace App\Command;

use App\Command\CommandInterface;



interface CommandBusInterface
{
    public function execute(CommandInterface $command);
}
