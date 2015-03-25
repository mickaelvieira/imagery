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

namespace Imagery\Parameters;

use Imagery\Parameters\AbstractFactory as ParametersFactory;

/**
 * Class Manager
 * @package Imagery\Parameters
 */
class Manager
{
    /**
     * @var array
     */
    private $parameters;

    /**
     *
     */
    public function __construct()
    {
        $this->parameters = [
            new Crop(),
            new Flip(),
            new Interlace(),
            new Resize(),
            new Rotate(),
            new Scale()
        ];
    }

    /**
     * @param string $name
     * @param array $parameters
     * @return \Imagery\Parameters
     */
    public function find($name, array $parameters)
    {
        /** @var ParametersFactory $factory */
        $factories = array_filter($this->parameters, function (ParametersFactory $command) use ($name) {
            return ($command->getName() === $name);
        });

        if (empty($factories)) {
            throw new \LogicException(sprintf("Parameters factory %s does not exist", $name));
        }

        $factory = current($factories);

        return $factory->getParameters($parameters);
    }
}
