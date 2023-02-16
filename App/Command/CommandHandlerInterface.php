<?php

namespace App\Command;

use App\Command\CommandInterface;

interface CommandHandlerInterface
{
    public function handle(CommandInterface $command);
}
