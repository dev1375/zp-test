<?php

namespace commands;

/**
 * Class MainCommand
 * @package commands
 */
class MainCommand extends AbstractConsoleCommand
{
    /**
     *
     */
    public function execute()
    {
        echo "How to: ", "\n";
        echo "php main.php rubrics - подготовить отчет по рубрикам", "\n";
    }
}
