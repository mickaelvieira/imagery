<?php

/*
 * This file is part of CollectionJson, a php implementation
 * of the Collection+JSON Media Type
 *
 * (c) Mickaël Vieira <contact@mickael-vieira.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Imagery;

use Imagery\Command;

/**
 * Class CommandManager
 * @package Imagery
 */
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
            new Command\Scale(),
            new Command\Resize(),
            new Command\Rotate(),
            new Command\Interlace(),
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
