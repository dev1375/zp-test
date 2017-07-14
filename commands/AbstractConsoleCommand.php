<?php

namespace commands;

/**
 * Class AbstractConsoleCommand
 * @package commands
 */
abstract class AbstractConsoleCommand
{
    /**
     * @return mixed
     */
    abstract public function execute();
}