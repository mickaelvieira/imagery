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

namespace Imagery\Command;

use Imagery\Command;

/**
 * Class Manager
 * @package Imagery
 */
final class Manager
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
            new Crop(),
            new Flip(),
            new Scale(),
            new Resize(),
            new Rotate(),
            new Interlace(),
        ];
    }

    /**
     * @param $name
     * @return \Imagery\Command
     * @throw \LogicException
     */
    public function find($name)
    {
        $commands = array_filter($this->commands, function (Command $command) use ($name) {
            return ($command->getName() === $name);
        });

        if (empty($commands)) {
            throw new \LogicException(sprintf("Command %s does not exist", $name));
        }

        return current($commands);
    }
}
