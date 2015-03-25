<?php

namespace Imagery\Parameters;

use \Imagery\Parameters\AbstractFactory as ParametersFactory;

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
