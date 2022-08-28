<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Output\NullOutput;

/**
 * Class BaseCommand
 * @package App\Console\Commands
 */
abstract class BaseCommand extends Command
{
    /**
     * @return void
     */
    public function initializeInput(): void
    {
        $this->input = new ArrayInput([]);
    }

    /**
     * @return void
     */
    public function initializeOutput(): void
    {
        $this->output = new NullOutput();
    }

    /**
     * @param InputDefinition $inputDefinition
     */
    public function bindDefinition(InputDefinition $inputDefinition)
    {
        $this->input->bind($inputDefinition);
    }
}
