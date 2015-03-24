<?php


namespace Imagery;


use Imagery\Command;

final class CommandManager
{

    /**
     * @var array
     */
    private $commands;

    /**
     *
     */
    public function __construct()
    {
        $this->commands = [
            new Command\Crop(),
            new Command\Flip(),
            new Command\Interlace(),
            new Command\Resize(),
            new Command\Rotate()
        ];
    }

    /**
     * @param $name
     * @return \Imagery\Command|false
     */
    public function find($name)
    {
        $commands = array_filter($this->commands, function (Command $command) use ($name) {
            return ($command->getName() === $name);
        });
        return (current($commands)) ?: null;
    }
}
